<?php
/**
 * Content template part — default (post)
 *
 * @package Estatein
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'card card--dark' ); ?> style="padding:30px;margin-bottom:24px;">
	<div style="display:flex;flex-direction:column;gap:16px;">
		<div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
			<?php
			$categories = get_the_category();
			if ( $categories ) {
				$cat = $categories[0];
				echo '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" style="padding:3px 12px;border-radius:999px;font-size:0.8rem;font-weight:600;background:#703bf722;color:#a685fa;border:1px solid #703bf744;">' . esc_html( $cat->name ) . '</a>';
			}
			?>
			<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>" style="color:var(--grey-60);font-size:0.875rem;">
				<?php echo esc_html( get_the_date() ); ?>
			</time>
		</div>

		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'estatein-card', array( 'style' => 'width:100%;height:240px;object-fit:cover;border-radius:8px;' ) ); ?>
			</a>
		<?php endif; ?>

		<h2 style="font-size:1.5rem;">
			<a href="<?php the_permalink(); ?>" style="color:white;text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#a685fa'" onmouseout="this.style.color='white'">
				<?php the_title(); ?>
			</a>
		</h2>

		<p style="color:var(--grey-60);"><?php the_excerpt(); ?></p>

		<a href="<?php the_permalink(); ?>" class="btn btn-outline" style="align-self:flex-start;">
			<?php esc_html_e( 'Read More', 'estatein' ); ?>
		</a>
	</div>
</article>
