17 files across a complete theme structure:

File	Purpose
style.css	Theme declaration + full CSS design system (dark tokens, Urbanist font, all component styles)
functions.php	Navigation menus, featured images, custom image sizes, Customizer support
header.php	Announcement bar + sticky nav with logo, mobile hamburger
footer.php	Journey CTA section + 4-column footer with social links
front-page.php	Hero with stats, Feature cards, Featured Properties grid, Testimonials, FAQ
archive-properties.php	Properties listing with taxonomy filters + pagination
single-properties.php	Full property detail page with meta, badges, similar properties
page-contact.php	Contact page with form (CF7-compatible or built-in)
page.php / single.php / 404.php	Standard templates
functions.php	Properties custom post type with: price, bedrooms, bathrooms, area, address, status meta boxes
inc/customizer.php	WordPress Customizer — edit hero text, stats, and images from the admin
inc/contact-handler.php	Secure contact form email submission
assets/js/main.js	Mobile nav, smooth scroll, scroll-triggered fade-in animations

To install: Upload estatein-wordpress-theme.tar.gz in your WordPress admin under Appearance → Themes → Add New → Upload Theme, extract the estatein folder, then activate it.

After activating the theme in WordPress, here's what to set up first:

Navigation — Go to Appearance → Menus, create a menu, and assign it to "Primary Navigation"
Properties — A new "Properties" menu item appears in your admin. Add listings with price, bedrooms, bathrooms, address, and featured images
Homepage — Go to Settings → Reading and set a static front page, then set "Front page" to any page you create (the front-page.php template activates automatically)
Hero image — Customize it under Appearance → Customize → Hero Section
Contact page — Create a page, assign the "Contact Page" template from the page attributes panel