(function () {
  'use strict';

  document.documentElement.classList.add('js');

  var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  var header = document.getElementById('header');

  if (header) {
    var onScroll = function () {
      header.classList.toggle('is-scrolled', window.scrollY > 8);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  var navToggle = document.getElementById('nav-toggle');
  var nav = document.getElementById('main-nav');
  var navClose = document.getElementById('nav-close');
  var navOverlay = document.getElementById('nav-overlay');
  var desktopNav = window.matchMedia('(min-width: 992px)');

  function navIsOpen() {
    return Boolean(nav) && nav.classList.contains('is-open');
  }

  if (navToggle && nav) {

    function setNav(open) {
      nav.classList.toggle('is-open', open);
      if (navOverlay) navOverlay.classList.toggle('is-visible', open);
      document.body.classList.toggle('nav-locked', open);
      navToggle.setAttribute('aria-expanded', String(open));
      navToggle.setAttribute('aria-label', open ? 'Close Menu' : 'Open Menu');
    }

    navToggle.addEventListener('click', function () {
      var open = !navIsOpen();
      setNav(open);
      if (open && navClose) navClose.focus();
    });

    if (navClose) {
      navClose.addEventListener('click', function () {
        setNav(false);
        navToggle.focus();
      });
    }

    if (navOverlay) {
      navOverlay.addEventListener('click', function () {
        setNav(false);
        navToggle.focus();
      });
    }

    nav.addEventListener('click', function (event) {
      if (event.target.closest('a')) setNav(false);
    });

    document.addEventListener('keydown', function (event) {
      if (!navIsOpen() || desktopNav.matches) return;

      if (event.key === 'Escape') {
        setNav(false);
        navToggle.focus();
      } else if (event.key === 'Tab') {
        /* Keep focus inside the open panel */
        var focusables = nav.querySelectorAll('a[href], button:not([disabled])');
        if (!focusables.length) return;
        var first = focusables[0];
        var last = focusables[focusables.length - 1];
        if (!nav.contains(document.activeElement)) {
          event.preventDefault();
          first.focus();
        } else if (event.shiftKey && document.activeElement === first) {
          event.preventDefault();
          last.focus();
        } else if (!event.shiftKey && document.activeElement === last) {
          event.preventDefault();
          first.focus();
        }
      }
    });

    function onNavBreakpointChange() {
      if (desktopNav.matches && navIsOpen()) setNav(false);
    }
    if (typeof desktopNav.addEventListener === 'function') {
      desktopNav.addEventListener('change', onNavBreakpointChange);
    } else if (typeof desktopNav.addListener === 'function') {
      desktopNav.addListener(onNavBreakpointChange);
    }
  }

  var revealItems = document.querySelectorAll('[data-reveal]');

  if (!prefersReducedMotion && 'IntersectionObserver' in window) {
    var revealObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          revealObserver.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

    revealItems.forEach(function (item, index) {
      item.style.transitionDelay = (index % 4) * 70 + 'ms';
      revealObserver.observe(item);
    });
  } else {
    revealItems.forEach(function (item) {
      item.classList.add('is-visible');
    });
  }

  var stickyCta = document.getElementById('sticky-cta');
  var hero = document.querySelector('.hero');
  var enquireSection = document.getElementById('enquire');
  var heroPassed = false;
  var enquireVisible = false;

  if (stickyCta && hero) {
    var updateStickyCta = function () {
      var show = heroPassed && !enquireVisible;
      stickyCta.classList.toggle('is-visible', show);
      stickyCta.setAttribute('aria-hidden', String(!show));
      stickyCta.tabIndex = show ? 0 : -1;
    };

    if ('IntersectionObserver' in window) {
      new IntersectionObserver(function (entries) {
        heroPassed = !entries[0].isIntersecting;
        updateStickyCta();
      }, { threshold: 0.05 }).observe(hero);

      if (enquireSection) {
        new IntersectionObserver(function (entries) {
          enquireVisible = entries[0].isIntersecting;
          updateStickyCta();
        }, { threshold: 0.15 }).observe(enquireSection);
      }
    }

    stickyCta.addEventListener('click', function (event) {
      if (!enquireSection) return; /* fall back to default anchor behavior */
      event.preventDefault();
      enquireSection.scrollIntoView({
        behavior: prefersReducedMotion ? 'auto' : 'smooth'
      });
      var firstInput = enquireSection.querySelector('input');
      if (firstInput) {
        window.setTimeout(function () {
          firstInput.focus({ preventScroll: true });
        }, prefersReducedMotion ? 0 : 600);
      }
    });
  }

  var validators = {
    name: function (value) {
      if (value.trim().length < 2) return 'Please Enter Your Full Name.';
      return '';
    },
    phone: function (value) {
      if (!/^\+?[0-9 ()-]{7,18}$/.test(value.trim())) return 'Please Enter A Valid Phone Number.';
      return '';
    },
    email: function (value) {
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(value.trim())) return 'Please Enter A Valid Email Address.';
      return '';
    },
    message: function (value, input) {
      if (input && input.hasAttribute('required') && value.trim().length < 2) {
        return 'Please Tell Us Briefly What Your Enquiry Is About.';
      }
      return '';
    }
  };

  function validateField(input) {
    var field = input.closest('.field');
    if (!field) return true; /* not a visible user-editable field (e.g. a hidden attribution input) — nothing to validate */

    var errorEl = field.querySelector('.field__error');
    var validate = validators[input.name];
    var message = validate ? validate(input.value, input) : '';

    field.classList.toggle('has-error', Boolean(message));
    if (errorEl) errorEl.textContent = message;
    input.setAttribute('aria-invalid', message ? 'true' : 'false');
    return !message;
  }

  function setupForm(form) {
    if (!form) return;
    var successPanel = form.parentElement.querySelector('.lead-form__success');

    form.addEventListener('submit', function (event) {
      event.preventDefault();

      var inputs = form.querySelectorAll('.field input, .field textarea');
      var valid = true;
      var firstInvalid = null;

      inputs.forEach(function (input) {
        if (!validateField(input) && !firstInvalid) {
          valid = false;
          firstInvalid = input;
        }
      });

      if (!valid) {
        firstInvalid.focus();
        return;
      }

      form.hidden = true;
      successPanel.hidden = false;
      successPanel.setAttribute('tabindex', '-1');
      successPanel.focus();
    });

    form.querySelectorAll('.field input, .field textarea').forEach(function (input) {
      input.addEventListener('blur', function () {
        if (input.closest('.field').classList.contains('has-error') || input.value !== '') {
          validateField(input);
        }
      });
      input.addEventListener('input', function () {
        if (input.closest('.field').classList.contains('has-error')) {
          validateField(input);
        }
      });
    });
  }

  setupForm(document.getElementById('hero-form'));
  setupForm(document.getElementById('main-form'));

  var lightbox = document.getElementById('gallery-lightbox');
  var galleryTriggers = document.querySelectorAll('.gallery__item-trigger');

  if (lightbox && galleryTriggers.length) {
    var lbDialog = lightbox.querySelector('.lightbox__dialog');
    var lbStage = lightbox.querySelector('.lightbox__stage');
    var lbImage = lightbox.querySelector('.lightbox__image');
    var lbCounter = lightbox.querySelector('.lightbox__counter');
    var lbClose = lightbox.querySelector('.lightbox__close');
    var lbPrev = lightbox.querySelector('.lightbox__prev');
    var lbNext = lightbox.querySelector('.lightbox__next');
    var lbZoomIn = lightbox.querySelector('.lightbox__zoom-in');
    var lbZoomOut = lightbox.querySelector('.lightbox__zoom-out');

    var images = Array.prototype.map.call(galleryTriggers, function (trigger) {
      var img = trigger.querySelector('img');
      return { src: img.currentSrc || img.src, alt: img.alt };
    });

    var MIN_ZOOM = 1;
    var MAX_ZOOM = 3;
    var ZOOM_STEP = 0.5;
    var currentIndex = 0;
    var zoomLevel = 1;
    var lastFocused = null;

    function applyZoom() {
      lbImage.style.transform = zoomLevel === 1 ? '' : 'scale(' + zoomLevel + ')';
    }

    function showImage(index) {
      currentIndex = (index + images.length) % images.length;
      var current = images[currentIndex];
      lbImage.src = current.src;
      lbImage.alt = current.alt;
      zoomLevel = 1;
      applyZoom();
      if (lbCounter) lbCounter.textContent = (currentIndex + 1) + ' / ' + images.length;
    }

    function isOpen() {
      return !lightbox.hidden;
    }

    function openLightbox(index, triggerEl) {
      lastFocused = triggerEl;
      showImage(index);
      lightbox.hidden = false;
      document.body.classList.add('lightbox-open');
      if (lbClose) lbClose.focus();
    }

    function closeLightbox() {
      lightbox.hidden = true;
      document.body.classList.remove('lightbox-open');
      if (lastFocused) lastFocused.focus();
    }

    galleryTriggers.forEach(function (trigger, index) {
      trigger.addEventListener('click', function () {
        openLightbox(index, trigger);
      });
    });

    if (lbClose) lbClose.addEventListener('click', closeLightbox);
    if (lbPrev) lbPrev.addEventListener('click', function () { showImage(currentIndex - 1); });
    if (lbNext) lbNext.addEventListener('click', function () { showImage(currentIndex + 1); });
    if (lbZoomIn) lbZoomIn.addEventListener('click', function () {
      zoomLevel = Math.min(MAX_ZOOM, zoomLevel + ZOOM_STEP);
      applyZoom();
    });
    if (lbZoomOut) lbZoomOut.addEventListener('click', function () {
      zoomLevel = Math.max(MIN_ZOOM, zoomLevel - ZOOM_STEP);
      applyZoom();
    });

    /* Backdrop click: only when the click lands on the dialog's own empty
       area (not the image or any control), so it can't be triggered by a
       click meant for something else. */
    lightbox.addEventListener('click', function (event) {
      if (event.target === lightbox || event.target === lbDialog || event.target === lbStage) {
        closeLightbox();
      }
    });

    document.addEventListener('keydown', function (event) {
      if (!isOpen()) return;

      if (event.key === 'Escape') {
        closeLightbox();
      } else if (event.key === 'ArrowLeft') {
        showImage(currentIndex - 1);
      } else if (event.key === 'ArrowRight') {
        showImage(currentIndex + 1);
      } else if (event.key === 'Tab') {
        var focusables = lightbox.querySelectorAll('button:not([disabled])');
        if (!focusables.length) return;
        var first = focusables[0];
        var last = focusables[focusables.length - 1];
        if (!lightbox.contains(document.activeElement)) {
          event.preventDefault();
          first.focus();
        } else if (event.shiftKey && document.activeElement === first) {
          event.preventDefault();
          last.focus();
        } else if (!event.shiftKey && document.activeElement === last) {
          event.preventDefault();
          first.focus();
        }
      }
    });
  }

  var yearEl = document.getElementById('year');
  if (yearEl) yearEl.textContent = String(new Date().getFullYear());
})();
