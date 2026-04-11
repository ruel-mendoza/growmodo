<?php
/**
 * Contact Page Template
 * Template Name: Contact Page
 *
 * @package Estatein
 */

get_header();
?>

<div class="page-hero">
	<h1><?php esc_html_e( "Get in Touch", 'estatein' ); ?></h1>
	<p><?php esc_html_e( "We're here to help. Send us a message and our team will get back to you as soon as possible.", 'estatein' ); ?></p>
</div>

<section class="section" style="padding-top:0;">
	<div style="display:grid;grid-template-columns:1fr 1.5fr;gap:60px;align-items:start;">

		<!-- Contact Info -->
		<div style="display:flex;flex-direction:column;gap:30px;">
			<div style="background:var(--grey-08);border:1px solid var(--neutral-800);border-radius:12px;padding:40px;">
				<div style="font-size:2rem;margin-bottom:16px;">📞</div>
				<h3 style="font-size:1.25rem;margin-bottom:8px;"><?php esc_html_e( 'Phone', 'estatein' ); ?></h3>
				<a href="tel:+1234567890" style="color:var(--grey-60);font-size:1rem;">+1 (234) 567-890</a>
			</div>

			<div style="background:var(--grey-08);border:1px solid var(--neutral-800);border-radius:12px;padding:40px;">
				<div style="font-size:2rem;margin-bottom:16px;">✉️</div>
				<h3 style="font-size:1.25rem;margin-bottom:8px;"><?php esc_html_e( 'Email', 'estatein' ); ?></h3>
				<a href="mailto:hello@estatein.com" style="color:var(--grey-60);font-size:1rem;">hello@estatein.com</a>
			</div>

			<div style="background:var(--grey-08);border:1px solid var(--neutral-800);border-radius:12px;padding:40px;">
				<div style="font-size:2rem;margin-bottom:16px;">📍</div>
				<h3 style="font-size:1.25rem;margin-bottom:8px;"><?php esc_html_e( 'Office', 'estatein' ); ?></h3>
				<p style="color:var(--grey-60);font-size:1rem;">123 Property Lane<br>San Francisco, CA 94105</p>
			</div>
		</div>

		<!-- Contact Form -->
		<div class="contact-form">
			<h2 style="margin-bottom:8px;"><?php esc_html_e( 'Send a Message', 'estatein' ); ?></h2>
			<p style="margin-bottom:40px;"><?php esc_html_e( "Fill out the form and we'll be in touch within 24 hours.", 'estatein' ); ?></p>

			<?php
			if ( function_exists( 'wpcf7_contact_form' ) ) {
				echo do_shortcode( '[contact-form-7 id="' . esc_attr( get_theme_mod( 'estatein_cf7_id', '1' ) ) . '" title="Contact Form"]' );
			} else {
				?>
				<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate>
					<?php wp_nonce_field( 'estatein_contact_form', 'estatein_contact_nonce' ); ?>
					<input type="hidden" name="action" value="estatein_contact">

					<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">
						<div class="form-group">
							<label for="contact_first_name"><?php esc_html_e( 'First Name', 'estatein' ); ?></label>
							<input type="text" id="contact_first_name" name="first_name" placeholder="<?php esc_attr_e( 'John', 'estatein' ); ?>" required>
						</div>
						<div class="form-group">
							<label for="contact_last_name"><?php esc_html_e( 'Last Name', 'estatein' ); ?></label>
							<input type="text" id="contact_last_name" name="last_name" placeholder="<?php esc_attr_e( 'Doe', 'estatein' ); ?>" required>
						</div>
					</div>

					<div class="form-group">
						<label for="contact_email"><?php esc_html_e( 'Email Address', 'estatein' ); ?></label>
						<input type="email" id="contact_email" name="email" placeholder="john@example.com" required>
					</div>

					<div class="form-group">
						<label for="contact_phone"><?php esc_html_e( 'Phone Number', 'estatein' ); ?></label>
						<input type="tel" id="contact_phone" name="phone" placeholder="+1 (234) 567-890">
					</div>

					<div class="form-group">
						<label for="contact_interest"><?php esc_html_e( "I'm interested in", 'estatein' ); ?></label>
						<select id="contact_interest" name="interest">
							<option value=""><?php esc_html_e( 'Select an option', 'estatein' ); ?></option>
							<option value="buying"><?php esc_html_e( 'Buying a Property', 'estatein' ); ?></option>
							<option value="selling"><?php esc_html_e( 'Selling a Property', 'estatein' ); ?></option>
							<option value="renting"><?php esc_html_e( 'Renting a Property', 'estatein' ); ?></option>
							<option value="other"><?php esc_html_e( 'Other', 'estatein' ); ?></option>
						</select>
					</div>

					<div class="form-group">
						<label for="contact_message"><?php esc_html_e( 'Message', 'estatein' ); ?></label>
						<textarea id="contact_message" name="message" rows="5" placeholder="<?php esc_attr_e( 'Tell us about your requirements...', 'estatein' ); ?>" required></textarea>
					</div>

					<button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">
						<?php esc_html_e( 'Send Message', 'estatein' ); ?>
					</button>
				</form>
				<?php
			}
			?>
		</div>

	</div>
</section>

<?php get_footer(); ?>
