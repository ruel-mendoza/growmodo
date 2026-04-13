<?php
/**
 * Inner Page Hero Template Part
 *
 * Three layout modes controlled by the ACF 'hero_image_position' field:
 *   right  — text left, image panel right (default)
 *   left   — image panel left, text right
 *   full   — full-width image banner above left-aligned text
 *
 * Fields registered via ACF in functions.php (group_estatein_inner_page_hero).
 *
 * @package Estatein
 */

$has_acf = function_exists( 'get_field' );

// Heading: ACF textarea (HTML allowed) → page title fallback.
$hero_heading = $has_acf ? get_field( 'hero_custom_heading' ) : '';
if ( empty( $hero_heading ) ) {
	$hero_heading = get_the_title();
}

// Background image URL — handle URL string, attachment array, or attachment ID.
$hero_bg_raw = $has_acf ? get_field( 'hero_background_image' ) : false;
if ( is_array( $hero_bg_raw ) ) {
	$hero_bg_url = ! empty( $hero_bg_raw['url'] ) ? $hero_bg_raw['url'] : '';
} elseif ( is_numeric( $hero_bg_raw ) && $hero_bg_raw > 0 ) {
	$hero_bg_url = (string) wp_get_attachment_image_url( (int) $hero_bg_raw, 'estatein-hero' );
} else {
	$hero_bg_url = is_string( $hero_bg_raw ) ? $hero_bg_raw : '';
}

// Image position: 'right' (default), 'left', or 'full'.
$hero_image_side = $has_acf ? get_field( 'hero_image_position' ) : '';
if ( empty( $hero_image_side ) ) {
	$hero_image_side = 'right';
}
$is_full_width = ( 'full' === $hero_image_side );

// Overlay toggle.
$hero_overlay = $has_acf ? get_field( 'hero_enable_overlay' ) : true;

// Build class list.
$hero_classes = array( 'inner-page-hero' );
if ( ! empty( $hero_bg_url ) ) {
	$hero_classes[] = 'has-image';
	if ( $is_full_width ) {
		$hero_classes[] = 'image-full-width';
	} else {
		$hero_classes[] = 'image-' . ( 'left' === $hero_image_side ? 'left' : 'right' );
	}
}
if ( $hero_overlay ) {
	$hero_classes[] = 'has-overlay';
}
?>
<section
	class="<?php echo esc_attr( implode( ' ', $hero_classes ) ); ?>"
	aria-label="<?php esc_attr_e( 'Page hero banner', 'estatein' ); ?>"
>
	<?php if ( $is_full_width ) : ?>

		<?php /* Full-width: image banner on top, left-aligned text below */ ?>
		<?php if ( ! empty( $hero_bg_url ) ) : ?>
			<div
				class="inner-page-hero__image"
				style="background-image: url('<?php echo esc_url( $hero_bg_url ); ?>');"
				role="img"
				aria-hidden="true"
			></div>
		<?php endif; ?>

		<div class="inner-page-hero__content">
			<h1 class="inner-page-hero__heading">
				<?php echo wp_kses_post( $hero_heading ); ?>
			</h1>
			<?php if ( has_excerpt() ) : ?>
				<p class="inner-page-hero__subtext"><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
			<?php endif; ?>
		</div>

	<?php else : ?>

		<?php /* Split layout: content panel + optional side image panel */ ?>
		<div class="inner-page-hero__content">
			<h1 class="inner-page-hero__heading">
				<?php echo wp_kses_post( $hero_heading ); ?>
			</h1>
			<?php if ( has_excerpt() ) : ?>
				<p class="inner-page-hero__subtext"><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( ! empty( $hero_bg_url ) ) : ?>
			<div
				class="inner-page-hero__image"
				style="background-image: url('<?php echo esc_url( $hero_bg_url ); ?>');"
				role="img"
				aria-hidden="true"
			></div>
		<?php endif; ?>

	<?php endif; ?>
</section>
