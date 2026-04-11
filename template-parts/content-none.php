<?php
/**
 * Content template part — no results
 *
 * @package Estatein
 */
?>
<div style="text-align:center;padding:80px 20px;background:var(--grey-08);border:1px solid var(--neutral-800);border-radius:12px;">
	<div style="font-size:4rem;margin-bottom:20px;">🔍</div>
	<h3 style="color:white;margin-bottom:12px;"><?php esc_html_e( 'Nothing Found', 'estatein' ); ?></h3>
	<?php if ( is_search() ) : ?>
		<p><?php esc_html_e( 'Sorry, no results matched your search. Try different keywords.', 'estatein' ); ?></p>
	<?php else : ?>
		<p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for.', 'estatein' ); ?></p>
	<?php endif; ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary" style="display:inline-flex;margin-top:24px;">
		<?php esc_html_e( 'Back to Home', 'estatein' ); ?>
	</a>
</div>
