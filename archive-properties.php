<?php
/**
 * Archive Template for Properties
 *
 * @package Estatein
 */

get_header();
?>

<div class="page-hero">
	<h1>
		<?php
		if ( is_tax( 'property_type' ) ) {
			/* translators: %s: taxonomy term name */
			printf( esc_html__( 'Property Type: %s', 'estatein' ), single_term_title( '', false ) );
		} elseif ( is_tax( 'property_location' ) ) {
			/* translators: %s: location term name */
			printf( esc_html__( 'Location: %s', 'estatein' ), single_term_title( '', false ) );
		} else {
			esc_html_e( 'All Properties', 'estatein' );
		}
		?>
	</h1>
	<p><?php esc_html_e( 'Browse our full range of available properties. Filter by type, location, or price to find your perfect match.', 'estatein' ); ?></p>
</div>

<section class="section" style="padding-top:0;">

	<!-- Property Type Filter -->
	<?php
	$property_types = get_terms( array( 'taxonomy' => 'property_type', 'hide_empty' => true ) );
	$locations      = get_terms( array( 'taxonomy' => 'property_location', 'hide_empty' => true ) );

	if ( ( $property_types && ! is_wp_error( $property_types ) ) || ( $locations && ! is_wp_error( $locations ) ) ) :
	?>
	<div style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:40px;">
		<a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>"
		   class="btn <?php echo ( ! is_tax() ) ? 'btn-primary' : 'btn-outline'; ?>"
		   style="padding:10px 20px;font-size:0.875rem;">
			<?php esc_html_e( 'All', 'estatein' ); ?>
		</a>

		<?php if ( $property_types && ! is_wp_error( $property_types ) ) : ?>
			<?php foreach ( $property_types as $term ) : ?>
				<a href="<?php echo esc_url( get_term_link( $term ) ); ?>"
				   class="btn <?php echo ( is_tax( 'property_type', $term->term_id ) ) ? 'btn-primary' : 'btn-outline'; ?>"
				   style="padding:10px 20px;font-size:0.875rem;">
					<?php echo esc_html( $term->name ); ?>
				</a>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<?php if ( have_posts() ) : ?>

		<div class="properties-grid">
			<?php
			while ( have_posts() ) {
				the_post();
				echo estatein_render_property_card( get_the_ID() );
			}
			?>
		</div>

		<!-- Pagination -->
		<div class="pagination-row">
			<p class="pagination-count">
				<?php
				global $wp_query;
				$paged  = max( 1, get_query_var( 'paged' ) );
				$total  = $wp_query->max_num_pages;
				printf(
					/* translators: 1: current page, 2: total pages */
					esc_html__( 'Page %1$s of %2$s', 'estatein' ),
					'<strong>' . absint( $paged ) . '</strong>',
					absint( $total )
				);
				?>
			</p>
			<nav class="pagination-nav" aria-label="<?php esc_attr_e( 'Properties pagination', 'estatein' ); ?>">
				<?php
				echo paginate_links( array(
					'prev_text' => '&#8592;',
					'next_text' => '&#8594;',
					'type'      => 'list',
				) );
				?>
			</nav>
		</div>

	<?php else : ?>

		<div style="text-align:center;padding:80px 20px;background:var(--grey-08);border:1px solid var(--neutral-800);border-radius:12px;">
			<div style="font-size:4rem;margin-bottom:20px;">🏠</div>
			<h3 style="color:white;margin-bottom:12px;"><?php esc_html_e( 'No Properties Found', 'estatein' ); ?></h3>
			<p><?php esc_html_e( 'No properties match your current filters. Try broadening your search.', 'estatein' ); ?></p>
			<a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>" class="btn btn-primary" style="display:inline-flex;margin-top:24px;">
				<?php esc_html_e( 'View All Properties', 'estatein' ); ?>
			</a>
		</div>

	<?php endif; ?>
</section>

<?php get_footer(); ?>
