# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Single-file static website for **Zivande**, an IT consulting company. The design is cloned from the ProZen template (`https://prozen.vercel.app/index.html`) with Zivande-specific branding and content.

**Primary output:** `index.html` — a fully self-contained HTML file (all CSS and JS embedded, no build step).

## Viewing the Site

Open `index.html` directly in a browser, or serve it locally:

```powershell
python -m http.server 8080
# then visit http://localhost:8080
```

## Architecture

Everything lives in `index.html`:

- **`<head>`** — Google Fonts CDN (Plus Jakarta Sans + Oswald), Font Awesome 6.5.0 CDN, embedded `<style>` block
- **`<style>` block** — organized as: CSS variables → reset → layout utilities → component styles (top-bar, navbar, hero, service cards, sections, contact, footer) → responsive breakpoints
- **`<body>`** — 14 sections in order: top-bar → navbar → hero → services-overview → 6 service-detail sections → about → stats → testimonials → CTA → contact → footer
- **`<script>` block** — hamburger toggle, sticky nav shadow, active nav on scroll, back-to-top button, contact form submit handler, newsletter handler

## Theming

All colors and fonts are defined as CSS custom properties at the top of the `<style>` block:

```css
:root {
    --color-primary:       #063231;  /* dark teal — main brand */
    --color-primary-light: #294f4e;  /* dark section backgrounds */
    --color-accent:        #c3df94;  /* lime green — CTAs, highlights */
    --color-orange:        #f75709;  /* section labels, accents */
    --color-light:         #f5f7f7;  /* light section backgrounds */
    --font-body:           'Plus Jakarta Sans', sans-serif;
    --font-heading:        'Oswald', sans-serif;
    --radius-card:         20px;
    --radius-btn:          12px;
}
```

To retheme, only these variables need to change.

## Section Pattern

Dark and light sections alternate throughout the page:
- **Dark sections** (`background: var(--color-primary)` or `var(--color-primary-light)`) use white text — Section 1, 3, 5, stats, CTA, footer
- **Light/white sections** use dark text — Section 2, 4, 6, about, testimonials, contact

## Service Sections

Six service-detail sections follow the services-overview card grid:

| # | Title | Count | Background |
|---|-------|-------|------------|
| 1 | IT Services & Consulting | 8 items | dark |
| 2 | Optimization (Process + Business sub-groups) | 7 items | light |
| 3 | Infrastructure & Compliance | 4 items | dark |
| 4 | Enterprise Operations | 4 items | white |
| 5 | Digital Transformation & Emerging Tech | 7 items | dark |
| 6 | Digital Marketing | 2 items | light |

## Assets

- `assets/` — empty (no local image assets; icon placeholders use Font Awesome)
- `qc/` — QC diff images from the website-cloner process
- `reference.png` — ProZen reference screenshot (1440×900)
- `clone_v1.png` — Zivande v1 screenshot (1440×900)
