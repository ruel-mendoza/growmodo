<?php
/**
 * Contact Form Handler
 *
 * @package Estatein
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handle contact form submission.
 */
function estatein_handle_contact_form() {
	if ( ! isset( $_POST['estatein_contact_nonce'] ) ||
	     ! wp_verify_nonce( $_POST['estatein_contact_nonce'], 'estatein_contact_form' ) ) {
		wp_die( esc_html__( 'Security check failed.', 'estatein' ) );
	}

	$first_name = sanitize_text_field( $_POST['first_name'] ?? '' );
	$last_name  = sanitize_text_field( $_POST['last_name'] ?? '' );
	$email      = sanitize_email( $_POST['email'] ?? '' );
	$phone      = sanitize_text_field( $_POST['phone'] ?? '' );
	$interest   = sanitize_text_field( $_POST['interest'] ?? '' );
	$message    = sanitize_textarea_field( $_POST['message'] ?? '' );

	if ( empty( $first_name ) || empty( $email ) || empty( $message ) ) {
		wp_redirect( add_query_arg( 'contact', 'error', wp_get_referer() ) );
		exit;
	}

	if ( ! is_email( $email ) ) {
		wp_redirect( add_query_arg( 'contact', 'invalid-email', wp_get_referer() ) );
		exit;
	}

	$admin_email = get_option( 'admin_email' );
	$subject     = sprintf(
		/* translators: 1: first name, 2: last name */
		__( 'New Enquiry from %1$s %2$s', 'estatein' ),
		$first_name,
		$last_name
	);

	$body  = sprintf( __( 'Name: %s %s', 'estatein' ), $first_name, $last_name ) . "\n";
	$body .= sprintf( __( 'Email: %s', 'estatein' ), $email ) . "\n";
	$body .= sprintf( __( 'Phone: %s', 'estatein' ), $phone ) . "\n";
	$body .= sprintf( __( 'Interest: %s', 'estatein' ), $interest ) . "\n\n";
	$body .= __( 'Message:', 'estatein' ) . "\n" . $message;

	$headers = array(
		'Content-Type: text/plain; charset=UTF-8',
		'Reply-To: ' . $first_name . ' ' . $last_name . ' <' . $email . '>',
	);

	$sent = wp_mail( $admin_email, $subject, $body, $headers );

	if ( $sent ) {
		wp_redirect( add_query_arg( 'contact', 'success', wp_get_referer() ) );
	} else {
		wp_redirect( add_query_arg( 'contact', 'error', wp_get_referer() ) );
	}
	exit;
}
add_action( 'admin_post_estatein_contact', 'estatein_handle_contact_form' );
add_action( 'admin_post_nopriv_estatein_contact', 'estatein_handle_contact_form' );
