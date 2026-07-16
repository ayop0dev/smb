/* ==========================================================================
   SMB Real Estate Brokers — DAMAC Islands 2 Landing Page
   Vanilla JavaScript: header state, mobile nav, scroll reveals,
   sticky CTA visibility, lead form validation.
   ========================================================================== */
(function () {
  'use strict';

  document.documentElement.classList.add('js');

  var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- Header scroll state ---------- */
  var header = document.getElementById('header');

  if (header) {
    var onScroll = function () {
      header.classList.toggle('is-scrolled', window.scrollY > 8);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ---------- Mobile navigation (right side panel) ---------- */
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
      navToggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
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

  /* ---------- Scroll reveal ---------- */
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

  /* ---------- Sticky CTA ---------- */
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

  /* ---------- Lead form validation ---------- */
  var validators = {
    name: function (value) {
      if (value.trim().length < 2) return 'Please enter your full name.';
      return '';
    },
    phone: function (value) {
      if (!/^\+?[0-9 ()-]{7,18}$/.test(value.trim())) return 'Please enter a valid phone number.';
      return '';
    },
    email: function (value) {
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(value.trim())) return 'Please enter a valid email address.';
      return '';
    },
    message: function (value, input) {
      if (input && input.hasAttribute('required') && value.trim().length < 2) {
        return 'Please tell us briefly what your enquiry is about.';
      }
      return '';
    }
  };

  function validateField(input) {
    var field = input.closest('.field');
    var errorEl = field.querySelector('.field__error');
    var validate = validators[input.name];
    var message = validate ? validate(input.value, input) : '';

    field.classList.toggle('has-error', Boolean(message));
    errorEl.textContent = message;
    input.setAttribute('aria-invalid', message ? 'true' : 'false');
    return !message;
  }

  function setupForm(form) {
    if (!form) return;
    var successPanel = form.parentElement.querySelector('.lead-form__success');

    form.addEventListener('submit', function (event) {
      event.preventDefault();

      var inputs = form.querySelectorAll('input, textarea');
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

      /* Static preview: no backend endpoint is connected yet. */
      form.hidden = true;
      successPanel.hidden = false;
      successPanel.setAttribute('tabindex', '-1');
      successPanel.focus();
    });

    form.querySelectorAll('input, textarea').forEach(function (input) {
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

  /* ---------- Footer year ---------- */
  var yearEl = document.getElementById('year');
  if (yearEl) yearEl.textContent = String(new Date().getFullYear());
})();
