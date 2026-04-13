<?php
/**
 * Page Template
 *
 * @package Estatein
 */

get_header();

while ( have_posts() ) :
	the_post();
?>

<?php get_template_part( 'template-parts/inner-page-hero' ); ?>

<section class="section" style="padding-top:0;">
	<div class="property-single__content" >
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'estatein-hero', array( 'style' => 'width:100%;height:400px;object-fit:cover;border-radius:12px;margin-bottom:40px;' ) );
		}
		the_content();
		?>
	</div>
</section>

<?php
endwhile;
get_footer();
?>
