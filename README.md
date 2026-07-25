# Panna Wild Tour

WordPress plugin to run a complete wild tour travel-agency website.

## Features

- Archive and taxonomy discovery pages with frontend filters.
- Payment intent portal with advance-payment reference submission and admin status tracking.

## Quick Setup

- `[pwt_payment_page]` Customer payment portal page.

- `[pwt_homepage]` Full homepage sections.
- `[pwt_packages]` Package listing section.
- `[pwt_safaris]` Safari listing section.
- `[pwt_destinations]` Destination listing section.
- `[pwt_testimonials]` Testimonial cards.
- `[pwt_faq]` FAQ accordion.
- `[pwt_contact_card]` Contact details block.
- `[pwt_booking_form]` AJAX booking form.
7. Create a payment page with shortcode `[pwt_payment_page]` and save its URL in plugin settings.

## Booking Workflow

## Seasonal Estimate Logic

- Peak season: Nov-Feb (default multiplier 1.2)
- Shoulder season: Mar-Jun (default multiplier 1.0)
- Monsoon season: Jul-Oct (default multiplier 0.85)
1. Customer submits booking inquiry.
2. Plugin creates a payment intent for the configured advance percentage.
3. Customer opens the secure payment page link.
4. Customer pays via UPI/bank method and submits UTR/reference.
5. Admin verifies payment and updates booking payment status.
- Estimate formula: `package_base_price * persons * season_multiplier`

Per-package multipliers can be overridden in Package fields.

