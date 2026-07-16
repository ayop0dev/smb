# Implementation Rules

> Version: 1.0
> Status: Approved
> Last Updated: 2026-07-15

---

# Technology

Build using:

- HTML5
- CSS3
- Vanilla JavaScript

Do not use:

- Bootstrap
- Tailwind CSS
- jQuery
- Page Builders

---

# Code Style

- Write clean and reusable code.
- Keep HTML semantic.
- Use meaningful class names.
- Avoid duplicated code.
- Separate HTML, CSS, and JavaScript whenever possible.

---

# Layout

- Mobile First.
- Responsive on all screen sizes.
- Maximum content width: 1280px.
- Use Flexbox and CSS Grid where appropriate.
- Keep spacing consistent across all sections.

---

# Performance

- Optimize images.
- Lazy load non-critical images.
- Avoid unnecessary JavaScript.
- Keep CSS and JavaScript lightweight.

---

# Accessibility

- Use semantic HTML.
- Keep proper heading hierarchy.
- Every form field must have a label.
- Every image must have an alt attribute.
- Keyboard navigation should work correctly.

---

# SEO

- One H1 per page.
- Use proper heading order.
- Use descriptive image alt text.
- Keep HTML clean and semantic.

---

# Animations

- Keep animations minimal.
- Prefer CSS transitions.
- Avoid excessive motion.

---

# Assets

- Use project assets whenever available.
- Store all assets locally.
- Do not use placeholder services.
- Do not generate fake project content.

---

# Output

Generate production-ready code.

Do not generate:

- Lorem Ipsum
- Placeholder images
- Fake project data
- TODO comments

---

# Development Workflow

During the design phase, build and maintain the website as a static preview using HTML, CSS, and Vanilla JavaScript only.

The `preview` directory is the single source of truth for all design iterations.

All visual changes, layout improvements, animations, and user experience refinements must be made in the preview version until every page of the website has been approved.

Do not generate or modify any WordPress theme files during this phase unless explicitly requested.

Once the complete website design has been approved, convert the final preview into a production-ready WordPress Custom Theme.

The WordPress implementation must preserve the approved design without introducing visual changes.

The WordPress theme should then be built using:

- WordPress Custom Theme
- PHP
- WordPress Template Hierarchy
- WordPress Coding Standards