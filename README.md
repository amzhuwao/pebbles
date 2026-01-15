## Pebbles Elementary Website

Modern, warm, and playful multi-page site for an elementary school (ages 5–12). Built with HTML5, CSS3, and vanilla JS; includes PHP stub for contact form handling.

### Quick start

1. Open `index.html` in a browser (or serve via any static server).
2. For the contact form, point the `action` to your mailer endpoint; `contact.php` contains a placeholder handler.

### Structure

- `index.html` — home, about, academics, admissions, testimonials.
- `life.html` — Life at School page.
- `staff.html` — Staff profiles.
- `parents.html` — Parents’ section.
- `contact.html` — Contact and tour request.
- `assets/css/style.css` — styling, layout, responsive rules, micro-animations.
- `assets/js/main.js` — nav toggle, smooth scroll, reveal-on-scroll.
- `contact.php` — basic POST handler; swap for PHPMailer/SMTP.
- `assets/forms/*.pdf` — placeholder downloads to be replaced with real forms.

### Customization

- Update colors, spacing, and shadows via CSS variables at the top of `assets/css/style.css`.
- Replace imagery with school photography/illustrations; keep alt text meaningful.
- Swap placeholder PDF files with official documents (matching filenames or update links in HTML).

### Accessibility & performance tips

- Use descriptive link text and labels; maintain sufficient contrast.
- Compress and resize images; prefer modern formats (WebP/AVIF) for production.
- Add proper meta tags (OG/Twitter) for sharing; adjust `description` to your copy.
