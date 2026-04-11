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

<div class="page-hero">
	<h1><?php the_title(); ?></h1>
	<?php if ( has_excerpt() ) : ?>
		<p><?php the_excerpt(); ?></p>
	<?php endif; ?>
</div>

<section class="section" style="padding-top:0;">
	<div class="property-single__content" style="max-width:860px;">
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
