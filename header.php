<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

	<!-- =====================================================
	     ANNOUNCEMENT BAR
	     ===================================================== -->
	<div class="announcement-bar" id="estatein-announcement" role="banner">
		<span class="announcement-bar__text">
			✨ <?php esc_html_e( 'Discover Your Dream Property with Estatein', 'estatein' ); ?>
		</span>
		<a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>" class="announcement-bar__link">
			<?php esc_html_e( 'Learn More', 'estatein' ); ?>
		</a>
		<button
			class="announcement-bar__close"
			aria-label="<?php esc_attr_e( 'Close announcement', 'estatein' ); ?>"
			onclick="this.parentElement.style.display='none'"
		>
			<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
				<line x1="18" y1="6" x2="6" y2="18"/>
				<line x1="6" y1="6" x2="18" y2="18"/>
			</svg>
		</button>
	</div>

	<!-- =====================================================
	     SITE HEADER / NAVIGATION
	     ===================================================== -->
	<header id="masthead" class="site-header">
		<nav class="site-nav" aria-label="<?php esc_attr_e( 'Primary Navigation', 'estatein' ); ?>">

			<!-- Logo -->
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
				<?php
				if ( has_custom_logo() ) {
					the_custom_logo();
				} else {
				?>
				<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect width="48" height="48" rx="10" fill="#703BF7"/>
					<path d="M24 10L10 20V38H20V28H28V38H38V20L24 10Z" fill="white"/>
				</svg>
				<span class="site-logo__text"><?php bloginfo( 'name' ); ?></span>
				<?php } ?>
			</a>

			<!-- Primary Menu -->
			<button
				class="nav-toggle"
				id="nav-toggle"
				aria-controls="primary-menu"
				aria-expanded="false"
				aria-label="<?php esc_attr_e( 'Toggle navigation', 'estatein' ); ?>"
			>
				<span></span>
				<span></span>
				<span></span>
			</button>

			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'container'      => false,
					'menu_class'     => 'nav-menu',
					'fallback_cb'    => false,
					'depth'          => 2,
				) );
			} else {
				?>
				<ul class="nav-menu" id="primary-menu">
					<li class="current-menu-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'estatein' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About Us', 'estatein' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"><?php esc_html_e( 'Properties', 'estatein' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Services', 'estatein' ); ?></a></li>
				</ul>
				<?php
			}
			?>

			<!-- Contact CTA -->
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="nav-contact-btn">
				<?php esc_html_e( 'Contact Us', 'estatein' ); ?>
			</a>

		</nav>
	</header>

	<main id="primary" class="site-main">
