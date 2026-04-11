<?php
/**
 * Single Property Template
 *
 * @package Estatein
 */

get_header();

while ( have_posts() ) :
	the_post();

	$price     = estatein_get_property_meta( get_the_ID(), '_property_price', '' );
	$bedrooms  = estatein_get_property_meta( get_the_ID(), '_property_bedrooms', '' );
	$bathrooms = estatein_get_property_meta( get_the_ID(), '_property_bathrooms', '' );
	$area      = estatein_get_property_meta( get_the_ID(), '_property_area', '' );
	$address   = estatein_get_property_meta( get_the_ID(), '_property_address', '' );
	$status    = estatein_get_property_meta( get_the_ID(), '_property_status', 'for-sale' );

	$status_labels = array(
		'for-sale' => __( 'For Sale', 'estatein' ),
		'for-rent' => __( 'For Rent', 'estatein' ),
		'sold'     => __( 'Sold', 'estatein' ),
		'rented'   => __( 'Rented', 'estatein' ),
	);
	$status_colors = array(
		'for-sale' => '#703bf7',
		'for-rent' => '#0ea5e9',
		'sold'     => '#ef4444',
		'rented'   => '#22c55e',
	);
	$status_label = isset( $status_labels[ $status ] ) ? $status_labels[ $status ] : __( 'For Sale', 'estatein' );
	$status_color = isset( $status_colors[ $status ] ) ? $status_colors[ $status ] : '#703bf7';
?>

<div class="property-single">

	<!-- Breadcrumb -->
	<nav aria-label="<?php esc_attr_e( 'Breadcrumb', 'estatein' ); ?>" style="margin-bottom:32px;">
		<ol style="display:flex;align-items:center;gap:8px;list-style:none;font-size:0.9rem;color:var(--grey-60);">
			<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color:var(--grey-60);transition:color .2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='var(--grey-60)'"><?php esc_html_e( 'Home', 'estatein' ); ?></a></li>
			<li style="color:var(--grey-40);">/</li>
			<li><a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>" style="color:var(--grey-60);transition:color .2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='var(--grey-60)'"><?php esc_html_e( 'Properties', 'estatein' ); ?></a></li>
			<li style="color:var(--grey-40);">/</li>
			<li style="color:white;"><?php the_title(); ?></li>
		</ol>
	</nav>

	<!-- Hero Image -->
	<?php if ( has_post_thumbnail() ) : ?>
		<?php the_post_thumbnail( 'estatein-hero', array( 'class' => 'property-single__hero-img', 'alt' => get_the_title() ) ); ?>
	<?php else : ?>
		<div class="property-single__hero-img" style="background:linear-gradient(135deg,#1a1a1a 0%,#211e2f 50%,#141414 100%);display:flex;align-items:center;justify-content:center;font-size:8rem;">🏠</div>
	<?php endif; ?>

	<!-- Property Header -->
	<div class="property-single__header">
		<div style="flex:1;">
			<span style="display:inline-block;padding:6px 16px;border-radius:999px;font-size:0.875rem;font-weight:600;background:<?php echo esc_attr( $status_color ); ?>22;color:<?php echo esc_attr( $status_color ); ?>;border:1px solid <?php echo esc_attr( $status_color ); ?>44;margin-bottom:12px;">
				<?php echo esc_html( $status_label ); ?>
			</span>
			<h1 style="font-size:clamp(1.75rem,3vw,2.5rem);margin-bottom:16px;"><?php the_title(); ?></h1>

			<div class="property-single__meta">
				<?php if ( $bedrooms ) : ?>
					<span class="property-badge">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12v4a1 1 0 001 1h16a1 1 0 001-1v-4"/><path d="M2 9h20v3H2z"/><path d="M5 9V5h14v4"/></svg>
						<?php echo esc_html( $bedrooms ); ?> <?php esc_html_e( 'Bedrooms', 'estatein' ); ?>
					</span>
				<?php endif; ?>
				<?php if ( $bathrooms ) : ?>
					<span class="property-badge">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l-4 4H3v7h18v-7h-2L15 6H9z"/></svg>
						<?php echo esc_html( $bathrooms ); ?> <?php esc_html_e( 'Bathrooms', 'estatein' ); ?>
					</span>
				<?php endif; ?>
				<?php if ( $area ) : ?>
					<span class="property-badge">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/></svg>
						<?php echo esc_html( $area ); ?> <?php esc_html_e( 'sq ft', 'estatein' ); ?>
					</span>
				<?php endif; ?>
				<?php if ( $address ) : ?>
					<span class="property-badge">
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
						<?php echo esc_html( $address ); ?>
					</span>
				<?php endif; ?>

				<?php
				$types = get_the_terms( get_the_ID(), 'property_type' );
				if ( $types && ! is_wp_error( $types ) ) :
					foreach ( $types as $type ) :
				?>
					<span class="property-badge">🏠 <?php echo esc_html( $type->name ); ?></span>
				<?php endforeach; endif; ?>
			</div>
		</div>

		<?php if ( $price ) : ?>
		<div class="property-single__price-block">
			<p class="property-single__price-label"><?php esc_html_e( 'Price', 'estatein' ); ?></p>
			<p class="property-single__price">$<?php echo esc_html( $price ); ?></p>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary" style="margin-top:16px;">
				<?php esc_html_e( 'Enquire Now', 'estatein' ); ?>
			</a>
		</div>
		<?php endif; ?>
	</div>

	<!-- Description -->
	<div class="property-single__content">
		<h2><?php esc_html_e( 'About This Property', 'estatein' ); ?></h2>
		<div class="property-entry-content" style="margin-top:20px;">
			<?php the_content(); ?>
		</div>
	</div>

	<!-- Similar Properties -->
	<?php
	$similar_args = array(
		'post_type'      => 'properties',
		'posts_per_page' => 3,
		'post__not_in'   => array( get_the_ID() ),
		'orderby'        => 'rand',
	);

	$similar_query = new WP_Query( $similar_args );

	if ( $similar_query->have_posts() ) :
	?>
	<div style="margin-top:80px;">
		<div class="section__header" style="margin-bottom:40px;">
			<div class="section__header-text">
				<h2><?php esc_html_e( 'Similar Properties', 'estatein' ); ?></h2>
				<p><?php esc_html_e( 'You might also be interested in these properties.', 'estatein' ); ?></p>
			</div>
			<a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>" class="btn btn-outline">
				<?php esc_html_e( 'View All', 'estatein' ); ?>
			</a>
		</div>
		<div class="properties-grid">
			<?php
			while ( $similar_query->have_posts() ) {
				$similar_query->the_post();
				echo estatein_render_property_card( get_the_ID() );
			}
			wp_reset_postdata();
			?>
		</div>
	</div>
	<?php endif; ?>

</div>

<?php
endwhile;
get_footer();
?>
