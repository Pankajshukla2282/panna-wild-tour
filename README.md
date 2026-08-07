# Panna Wild Tour

WordPress plugin for running a Panna-focused wildlife travel website with custom content types, booking flow, and payment confirmation portal.

## Core Capabilities

- Custom post types for packages, safaris, destinations, FAQs, testimonials, reviews, resorts, and vehicles.
- Conversion-oriented shortcodes for homepage sections and lead capture.
- Booking request workflow with seasonal estimate support.
- Payment portal with tokenized link and reference submission.
- Archive/taxonomy filter pages for discovery and browsing.
- One-click starter content importer from admin for fast launch setup.
- Admin settings for company profile, SEO, payment instructions, and API key controls.

### Starter Import Options

From `Panna Wild Tour > Content Forms`, the starter importer now supports:

- Profile mode:
	- `Basic`: essential launch content
	- `Full`: adds resort, vehicle, and review samples
- Per-post-type inclusion toggles
- Optional featured image assignment using:
	- explicit media ID, or
	- latest uploaded image fallback

## Shortcodes

- `[pwt_homepage]` Full homepage stack (hero, services, packages, safaris, destinations, social proof, FAQ, booking).
- `[pwt_packages]` Package cards section.
- `[pwt_safaris]` Safari cards section.
- `[pwt_destinations]` Destination cards section.
- `[pwt_testimonials]` Testimonials section.
- `[pwt_reviews]` Verified reviews section.
- `[pwt_faq]` FAQ accordion.
- `[pwt_contact_card]` Contact information card.
- `[pwt_booking_form]` Booking request form.
- `[pwt_payment_page]` Payment reference portal (for tokenized payment links).

## Recommended Launch Setup

1. Activate plugin and ensure permalinks are saved once.
2. Configure business settings in PWT admin settings:
	- company name
	- contact details
	- WhatsApp number
	- hero title/subtitle
	- payment instructions and methods
3. Create or import launch content using the content seed file:
	- `CONTENT-SEED-PANNA-WILD-TOUR.md`
	- or use `Panna Wild Tour > Content Forms > Import Starter Content`
4. Create key pages:
	- Home (use `[pwt_homepage]`)
	- Booking (use `[pwt_booking_form]`)
	- Payment (use `[pwt_payment_page]`)
5. Save Payment Page URL back in settings.
6. Publish at least 2 to 3 items for each major post type before launch.

## Booking and Payment Flow

1. Guest submits booking form.
2. Plugin creates booking + payment intent.
3. Guest receives/opens secure payment portal link.
4. Guest pays and submits UTR/reference.
5. Admin verifies and marks payment status.

## Seasonal Estimate Logic

- Peak: Nov-Feb (default multiplier 1.2)
- Shoulder: Mar-Jun (default multiplier 1.0)
- Monsoon: Jul-Oct (default multiplier 0.85)

Estimate formula:

`package_base_price * persons * season_multiplier`

Per-package multipliers can be overridden in package fields.

## Developer Notes

- Keep business/domain logic in this plugin.
- Keep visual/layout customizations in theme/child theme.
- Use child theme templates for presentational overrides instead of modifying plugin template files directly.

