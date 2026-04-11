	</main><!-- #primary -->

	<!-- =====================================================
	     JOURNEY / CTA SECTION
	     ===================================================== -->
	<section class="journey-section">
		<div class="journey-card">
			<div class="journey-card__content">
				<h2><?php esc_html_e( "Start Your Real Estate Journey Today", 'estatein' ); ?></h2>
				<p><?php esc_html_e( "Your dream property is just a click away. Whether you're buying, selling, or renting, Estatein is here to guide you every step of the way.", 'estatein' ); ?></p>
			</div>
			<div class="journey-card__cta">
				<a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>" class="btn btn-primary">
					<?php esc_html_e( 'Explore Properties', 'estatein' ); ?>
				</a>
			</div>
		</div>
	</section>

	<!-- =====================================================
	     SITE FOOTER
	     ===================================================== -->
	<footer id="colophon" class="site-footer">

		<div class="footer__top">
			<!-- Brand Column -->
			<div class="footer__brand">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="display:inline-flex;align-items:center;gap:12px;margin-bottom:16px;text-decoration:none;">
					<svg width="40" height="40" viewBox="0 0 48 48" fill="none"><rect width="48" height="48" rx="10" fill="#703BF7"/><path d="M24 10L10 20V38H20V28H28V38H38V20L24 10Z" fill="white"/></svg>
					<span style="font-size:1.5rem;font-weight:700;color:white;"><?php bloginfo( 'name' ); ?></span>
				</a>
				<p><?php esc_html_e( 'Your trusted partner in real estate. We help you find the perfect property that matches your lifestyle and investment goals.', 'estatein' ); ?></p>
				<div class="footer__social">
					<a href="#" aria-label="<?php esc_attr_e( 'Facebook', 'estatein' ); ?>">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
					</a>
					<a href="#" aria-label="<?php esc_attr_e( 'Twitter', 'estatein' ); ?>">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/></svg>
					</a>
					<a href="#" aria-label="<?php esc_attr_e( 'Instagram', 'estatein' ); ?>">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
					</a>
					<a href="#" aria-label="<?php esc_attr_e( 'LinkedIn', 'estatein' ); ?>">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
					</a>
				</div>
			</div>

			<!-- Home Column -->
			<div class="footer__col">
				<h4><?php esc_html_e( 'Home', 'estatein' ); ?></h4>
				<?php
				if ( has_nav_menu( 'footer-1' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'footer-1',
						'container'      => false,
						'menu_class'     => '',
						'fallback_cb'    => false,
						'depth'          => 1,
					) );
				} else {
				?>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Hero Section', 'estatein' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'Featured Properties', 'estatein' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/#testimonials' ) ); ?>"><?php esc_html_e( 'Testimonials', 'estatein' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/#faq' ) ); ?>"><?php esc_html_e( 'FAQ', 'estatein' ); ?></a></li>
				</ul>
				<?php } ?>
			</div>

			<!-- Services Column -->
			<div class="footer__col">
				<h4><?php esc_html_e( 'Services', 'estatein' ); ?></h4>
				<?php
				if ( has_nav_menu( 'footer-2' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'footer-2',
						'container'      => false,
						'menu_class'     => '',
						'fallback_cb'    => false,
						'depth'          => 1,
					) );
				} else {
				?>
				<ul>
					<li><a href="#"><?php esc_html_e( 'Buy a Home', 'estatein' ); ?></a></li>
					<li><a href="#"><?php esc_html_e( 'Sell Your Home', 'estatein' ); ?></a></li>
					<li><a href="#"><?php esc_html_e( 'Rent a Property', 'estatein' ); ?></a></li>
					<li><a href="#"><?php esc_html_e( 'Property Management', 'estatein' ); ?></a></li>
				</ul>
				<?php } ?>
			</div>

			<!-- Contact Column -->
			<div class="footer__col">
				<h4><?php esc_html_e( 'Contact Us', 'estatein' ); ?></h4>
				<?php
				if ( has_nav_menu( 'footer-3' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'footer-3',
						'container'      => false,
						'menu_class'     => '',
						'fallback_cb'    => false,
						'depth'          => 1,
					) );
				} else {
				?>
				<ul>
					<li><a href="tel:+1234567890"><?php esc_html_e( '+1 (234) 567-890', 'estatein' ); ?></a></li>
					<li><a href="mailto:hello@estatein.com"><?php esc_html_e( 'hello@estatein.com', 'estatein' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Form', 'estatein' ); ?></a></li>
				</ul>
				<?php } ?>
			</div>
		</div>

		<div class="footer__bottom">
			<p class="footer__copyright">
				&copy; <?php echo esc_html( date( 'Y' ) ); ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>.
				<?php esc_html_e( 'All rights reserved.', 'estatein' ); ?>
			</p>
			<nav class="footer__legal" aria-label="<?php esc_attr_e( 'Legal', 'estatein' ); ?>">
				<a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>"><?php esc_html_e( 'Terms & Conditions', 'estatein' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'estatein' ); ?></a>
			</nav>
		</div>

	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

<script>
(function() {
	var toggle = document.getElementById('nav-toggle');
	var menu   = document.getElementById('primary-menu');
	if (toggle && menu) {
		toggle.addEventListener('click', function() {
			var isOpen = menu.classList.toggle('is-open');
			toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
		});
	}
})();
</script>
</body>
</html>
