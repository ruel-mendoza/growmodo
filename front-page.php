<?php
/**
 * Front Page Template
 *
 * @package Estatein
 */

get_header();
?>

<!-- =====================================================
     HERO SECTION
     ===================================================== -->
<section class="hero">
	<div class="hero__main">
		<div class="hero-circular-badge">
            <svg viewBox="0 0 100 100" class="badge-text-path">
                <path id="circlePath" d="M 50, 50 m -37, 0 a 37,37 0 1,1 74,0 a 37,37 0 1,1 -74,0" fill="transparent"></path>
                <text font-size="8" fontweight="600" fill="white">
                    <textPath href="#circlePath">
                        • DISCOVER YOUR DREAM PROPERTY • DISCOVER YOUR DREAM PROPERTY
                    </textPath>
                </text>
            </svg>

            <div class="inner-arrow">
                <svg width="60" height="60" viewBox="0 0 24 24" fill="none">
                    <path d="M7 17L17 7M17 7H7M17 7V17" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
        </div>
		<div class="hero__content">
			<div class="hero__heading-group">
				<h1><?php echo esc_html( get_theme_mod( 'estatein_hero_heading', __( 'Discover Your Dream Property with Estatein', 'estatein' ) ) ); ?></h1>
				<p><?php echo esc_html( get_theme_mod( 'estatein_hero_subtext', __( 'Your journey to finding the perfect property begins here. Explore our listings to find the home that matches your dreams.', 'estatein' ) ) ); ?></p>
			</div>

			<div class="hero__cta">
				<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="btn btn-ghost">
					<?php esc_html_e( 'Learn More', 'estatein' ); ?>
				</a>
				<a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>" class="btn btn-primary">
					<?php esc_html_e( 'Browse Properties', 'estatein' ); ?>
				</a>
			</div>

			<div class="hero__stats">
				<?php
				$stats = array(
					array(
						'value' => get_theme_mod( 'estatein_stat_1_value', '200+' ),
						'label' => get_theme_mod( 'estatein_stat_1_label', __( 'Happy Customers', 'estatein' ) ),
					),
					array(
						'value' => get_theme_mod( 'estatein_stat_2_value', '10k+' ),
						'label' => get_theme_mod( 'estatein_stat_2_label', __( 'Properties For Clients', 'estatein' ) ),
					),
					array(
						'value' => get_theme_mod( 'estatein_stat_3_value', '16+' ),
						'label' => get_theme_mod( 'estatein_stat_3_label', __( 'Years of Experience', 'estatein' ) ),
					),
				);
				foreach ( $stats as $stat ) : ?>
					<div class="hero__stat-card">
						<div class="hero__stat-value"><?php echo esc_html( $stat['value'] ); ?></div>
						<div class="hero__stat-label"><?php echo esc_html( $stat['label'] ); ?></div>
					</div>
				<?php endforeach; ?>
			</div>
			
		</div>
					
		<?php
$hero_image_id  = get_theme_mod( 'estatein_hero_image' );
$hero_image_url = $hero_image_id ? wp_get_attachment_image_url( $hero_image_id, 'estatein-hero' ) : '';

// Define the background style: either the dynamic image or your fallback gradient
$hero_bg_style = $hero_image_url 
    ? "background-image: url('" . esc_url( $hero_image_url ) . "'); background-size: cover; background-position: center;" 
    : "background: linear-gradient(135deg,#1a1a1a 0%,#211e2f 50%,#141414 100%);";
?>

<div class="hero__image" style="<?php echo $hero_bg_style; ?> display:flex; align-items:center; justify-content:center; font-size:8rem; border-radius:12px; min-height:600px; flex:1;">
    <?php if ( ! $hero_image_url ) : ?>
        🏙️
    <?php endif; ?>
</div>
		
	</div>

	<!-- Feature cards bar -->
	<div class="hero__features">
		<?php
		$features = array(
			array(
				'icon'  => '🏡',
				'title' => __( 'Find Your Dream Home', 'estatein' ),
			),
			array(
				'icon'  => '💰',
				'title' => __( 'Unlock Property Value', 'estatein' ),
			),
			array(
				'icon'  => '🔑',
				'title' => __( 'Effortless Property Management', 'estatein' ),
			),
			array(
				'icon'  => '📊',
				'title' => __( 'Smart Investments, Informed Decisions', 'estatein' ),
			),
		);
		foreach ( $features as $feature ) : ?>
			<div class="hero__feature-card">
				<div style="font-size:2.5rem;line-height:1;"><?php echo esc_html( $feature['icon'] ); ?></div>
				<p class="hero__feature-title"><?php echo esc_html( $feature['title'] ); ?></p>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<!-- =====================================================
     FEATURED PROPERTIES
     ===================================================== -->
<section class="section" id="featured-properties">
	<div class="section__header">
		<div class="section__header-text">
			<h2><?php esc_html_e( 'Featured Properties', 'estatein' ); ?></h2>
			<p><?php esc_html_e( 'Explore our handpicked selection of featured properties. Each listing offers a glimpse into exceptional homes and investments available through Estatein. Click "View Details" for more information.', 'estatein' ); ?></p>
		</div>
		<a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>" class="btn btn-outline">
			<?php esc_html_e( 'View All Properties', 'estatein' ); ?>
		</a>
	</div>

	<?php
	$featured_args = array(
		'post_type'      => 'properties',
		'posts_per_page' => 3,
		'post_status'    => 'publish',
		'meta_key'       => '_property_featured',
		'meta_value'     => '1',
	);

	$featured_query = new WP_Query( $featured_args );

	if ( ! $featured_query->have_posts() ) {
		$featured_args['meta_key']   = '';
		$featured_args['meta_value'] = '';
		$featured_query = new WP_Query( $featured_args );
	}

	if ( $featured_query->have_posts() ) :
	?>
	<div class="carousel-wrapper">
		<div class="properties-grid">
			<?php
			while ( $featured_query->have_posts() ) {
				$featured_query->the_post();
				echo estatein_render_property_card( get_the_ID() );
			}
			wp_reset_postdata();
			?>
		</div>
	</div>
		<?php
		// Get actual count from your query
		$total_count = $featured_query->post_count;
		$total_formatted = str_pad($total_count, 2, '0', STR_PAD_LEFT);
		?>

		<div class="carousel-nav">
			<div class="carousel-counter">
				<span class="current" id="property-current">01</span> 
				<span class="total">of <?php echo esc_html($total_formatted); ?></span>
			</div>
			
			<div class="carousel-arrows">
				<button class="arrow-btn prev" id="prop-prev" aria-label="Previous">←</button>
				<button class="arrow-btn next" id="prop-next" aria-label="Next">→</button>
			</div>
		</div>
	<?php else : ?>
	<div style="text-align:center;padding:80px 20px;background:var(--grey-08);border:1px solid var(--neutral-800);border-radius:12px;">
		<div style="font-size:4rem;margin-bottom:20px;">🏠</div>
		<h3 style="color:white;margin-bottom:12px;"><?php esc_html_e( 'No Properties Yet', 'estatein' ); ?></h3>
		<p><?php esc_html_e( 'Properties will appear here once added. Go to the admin panel and add your first property!', 'estatein' ); ?></p>
		<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=properties' ) ); ?>" class="btn btn-primary" style="display:inline-flex;margin-top:24px;">
			<?php esc_html_e( 'Add First Property', 'estatein' ); ?>
		</a>
	</div>
	<?php endif; ?>
</section>

<!-- =====================================================
     CLIENT TESTIMONIALS
     ===================================================== -->
<section class="section" id="testimonials" style="background:var(--grey-08);border-top:1px solid var(--neutral-800);">
	<div class="section__header">
		<div class="section__header-text">
			<h2><?php esc_html_e( 'What Our Clients Say', 'estatein' ); ?></h2>
			<p><?php esc_html_e( 'Read the success stories and heartfelt testimonials from our valued clients. Discover why they chose Estatein for their real estate needs.', 'estatein' ); ?></p>
		</div>
		<?php if ( get_page_by_path( 'testimonials' ) ) : ?>
		<a href="<?php echo esc_url( home_url( '/testimonials/' ) ); ?>" class="btn btn-outline">
			<?php esc_html_e( 'View All Testimonials', 'estatein' ); ?>
		</a>
		<?php endif; ?>
	</div>

	<div class="testimonials-grid">
		<?php
		$testimonials = array(
			array(
				'title'    => __( 'Exceptional Service!', 'estatein' ),
				'text'     => __( 'Our experience with Estatein was outstanding. Their team\'s dedication and professionalism made finding our dream home a breeze. Highly recommended!', 'estatein' ),
				'name'     => 'Wade Warren',
				'location' => 'USA, California',
				'avatar'   => '👤',
				'stars'    => 5,
			),
			array(
				'title'    => __( 'Efficient and Reliable', 'estatein' ),
				'text'     => __( 'Estatein provided us with top-notch service. They helped us sell our property quickly and at a great price. We couldn\'t be happier with the results.', 'estatein' ),
				'name'     => 'Emelie Thomson',
				'location' => 'USA, Florida',
				'avatar'   => '👤',
				'stars'    => 5,
			),
			array(
				'title'    => __( 'Trusted Advisors', 'estatein' ),
				'text'     => __( 'The Estatein team guided us through the entire buying process. Their knowledge and commitment to our needs were impressive.', 'estatein' ),
				'name'     => 'John Mans',
				'location' => 'USA, Nevada',
				'avatar'   => '👤',
				'stars'    => 5,
			),
		);

		foreach ( $testimonials as $testimonial ) :
		?>
		<div class="testimonial-card">
			<div class="testimonial-card__stars">
				<?php for ( $i = 0; $i < $testimonial['stars']; $i++ ) : ?>
					<span>★</span>
				<?php endfor; ?>
			</div>
			<div class="testimonial-card__content">
				<h3><?php echo esc_html( $testimonial['title'] ); ?></h3>
				<p><?php echo esc_html( $testimonial['text'] ); ?></p>
			</div>
			<div class="testimonial-card__author">
				<div class="testimonial-card__avatar-placeholder"><?php echo esc_html( mb_substr( $testimonial['name'], 0, 1 ) ); ?></div>
				<div>
					<div class="testimonial-card__name"><?php echo esc_html( $testimonial['name'] ); ?></div>
					<div class="testimonial-card__location"><?php echo esc_html( $testimonial['location'] ); ?></div>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</section>

<!-- =====================================================
     FREQUENTLY ASKED QUESTIONS
     ===================================================== -->
<section class="section" id="faq">
	<div class="section__header">
		<div class="section__header-text">
			<h2><?php esc_html_e( 'Frequently Asked Questions', 'estatein' ); ?></h2>
			<p><?php esc_html_e( 'Find answers to common questions about Estatein\'s services, property listings, and the real estate process. We\'re here to provide clarity and assist you every step of the way.', 'estatein' ); ?></p>
		</div>
		<?php if ( get_page_by_path( 'faq' ) ) : ?>
		<a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>" class="btn btn-outline">
			<?php esc_html_e( 'View All FAQs', 'estatein' ); ?>
		</a>
		<?php endif; ?>
	</div>

	<div class="faq-grid">
		<?php
		$faq_items = array(
			array(
				'question' => __( 'How do I search for properties on Estatein?', 'estatein' ),
				'answer'   => __( 'Learn how to use our user-friendly search tools to find properties that match your criteria.', 'estatein' ),
			),
			array(
				'question' => __( 'What documents do I need to sell my property through Estatein?', 'estatein' ),
				'answer'   => __( 'Find out about the necessary documentation for listing your property with us.', 'estatein' ),
			),
			array(
				'question' => __( 'How can I contact an Estatein agent?', 'estatein' ),
				'answer'   => __( 'Discover the different ways you can get in touch with our experienced agents.', 'estatein' ),
			),
		);

		foreach ( $faq_items as $faq ) :
		?>
		<div class="faq-card">
			<h3><?php echo esc_html( $faq['question'] ); ?></h3>
			<p><?php echo esc_html( $faq['answer'] ); ?></p>
			<a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>" class="btn btn-outline">
				<?php esc_html_e( 'Read More', 'estatein' ); ?>
			</a>
		</div>
		<?php endforeach; ?>
	</div>
</section>

<?php get_footer(); ?>
