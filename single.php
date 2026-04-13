<?php
/**
 * Single Post Template
 *
 * @package Estatein
 */

get_header();

while ( have_posts() ) :
	the_post();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="page-hero">
		<div style="display:flex;align-items:center;gap:16px;margin-bottom:16px;flex-wrap:wrap;">
			<?php
			$categories = get_the_category();
			if ( $categories ) {
				foreach ( $categories as $cat ) {
					echo '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" style="padding:4px 14px;border-radius:999px;font-size:0.875rem;font-weight:600;background:#703bf722;color:#a685fa;border:1px solid #703bf744;">' . esc_html( $cat->name ) . '</a>';
				}
			}
			?>
			<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>" style="color:var(--grey-60);font-size:0.9rem;">
				<?php echo esc_html( get_the_date() ); ?>
			</time>
		</div>
		
		<?php if ( has_excerpt() ) : ?>
			<p><?php the_excerpt(); ?></p>
			<?php else : ?>
				<h1><?php the_title(); ?></h1>
		<?php endif; ?>
	</div>

	<section class="section" style="padding-top:0;">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'estatein-hero', array( 'style' => 'width:100%;height:440px;object-fit:cover;border-radius:12px;margin-bottom:40px;' ) ); ?>
		<?php endif; ?>

		<div class="property-single__content" style="max-width:860px;">
			<?php the_content(); ?>
		</div>

		<!-- Author bio -->
		<div style="display:flex;align-items:center;gap:20px;padding:30px;background:var(--grey-08);border:1px solid var(--neutral-800);border-radius:12px;margin-top:50px;max-width:860px;">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 80, '', '', array( 'style' => 'border-radius:50%;' ) ); ?>
			<div>
				<p style="font-weight:600;color:white;font-size:1.125rem;margin-bottom:4px;"><?php the_author(); ?></p>
				<p style="color:var(--grey-60);font-size:0.9rem;"><?php the_author_meta( 'description' ); ?></p>
			</div>
		</div>

		<!-- Post Navigation -->
		<div style="display:flex;justify-content:space-between;gap:20px;margin-top:40px;max-width:860px;flex-wrap:wrap;">
			<?php
			$prev_post = get_previous_post();
			$next_post = get_next_post();
			if ( $prev_post ) :
			?>
				<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="btn btn-outline" style="flex:1;justify-content:flex-start;">
					&#8592; <?php echo esc_html( get_the_title( $prev_post->ID ) ); ?>
				</a>
			<?php endif; if ( $next_post ) : ?>
				<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="btn btn-outline" style="flex:1;justify-content:flex-end;">
					<?php echo esc_html( get_the_title( $next_post->ID ) ); ?> &#8594;
				</a>
			<?php endif; ?>
		</div>

		<!-- Comments -->
		<?php if ( comments_open() || get_comments_number() ) : ?>
			<div style="margin-top:60px;max-width:860px;">
				<?php comments_template(); ?>
			</div>
		<?php endif; ?>
	</section>

</article>

<?php
endwhile;
get_footer();
?>
