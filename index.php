<?php
/**
 * Main Template File (Fallback)
 *
 * @package Estatein
 */

get_header();
?>

<div class="page-hero">
	<h1>
		<?php
		if ( is_home() ) {
			esc_html_e( 'Latest Posts', 'estatein' );
		} elseif ( is_search() ) {
			/* translators: %s: search query */
			printf( esc_html__( 'Search Results for: %s', 'estatein' ), '<span>' . get_search_query() . '</span>' );
		} elseif ( is_404() ) {
			esc_html_e( 'Page Not Found', 'estatein' );
		} else {
			the_title();
		}
		?>
	</h1>
</div>

<section class="section" style="padding-top:0;">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', get_post_type() );
		endwhile;

		the_posts_navigation( array(
			'prev_text' => '&#8592; ' . __( 'Older posts', 'estatein' ),
			'next_text' => __( 'Newer posts', 'estatein' ) . ' &#8594;',
		) );

	else :
		get_template_part( 'template-parts/content', 'none' );
	endif;
	?>
</section>

<?php get_footer(); ?>
