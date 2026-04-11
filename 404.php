<?php
/**
 * 404 Template
 *
 * @package Estatein
 */

get_header();
?>

<section class="section" style="min-height:70vh;display:flex;align-items:center;justify-content:center;text-align:center;">
	<div>
		<div style="font-size:8rem;line-height:1;margin-bottom:30px;">🏚️</div>
		<h1 style="font-size:clamp(3rem,8vw,8rem);font-weight:700;color:var(--purple-60);line-height:1;margin-bottom:20px;">404</h1>
		<h2 style="font-size:2rem;margin-bottom:16px;"><?php esc_html_e( 'Property Not Found', 'estatein' ); ?></h2>
		<p style="color:var(--grey-60);font-size:1.125rem;margin-bottom:40px;max-width:480px;margin-left:auto;margin-right:auto;">
			<?php esc_html_e( "Looks like this property has been sold or doesn't exist. Let's find you something better.", 'estatein' ); ?>
		</p>
		<div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-ghost">
				<?php esc_html_e( '← Back to Home', 'estatein' ); ?>
			</a>
			<a href="<?php echo esc_url( home_url( '/properties/' ) ); ?>" class="btn btn-primary">
				<?php esc_html_e( 'Browse Properties', 'estatein' ); ?>
			</a>
		</div>
	</div>
</section>

<?php get_footer(); ?>
