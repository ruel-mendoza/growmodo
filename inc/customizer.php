<?php
/**
 * Theme Customizer Settings
 *
 * @package Estatein
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function estatein_customize_register( $wp_customize ) {

	// ============================================================
	// Hero Section
	// ============================================================
	$wp_customize->add_section( 'estatein_hero', array(
		'title'    => __( 'Hero Section', 'estatein' ),
		'priority' => 30,
	) );

	$wp_customize->add_setting( 'estatein_hero_heading', array(
		'default'           => __( 'Discover Your Dream Property with Estatein', 'estatein' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'estatein_hero_heading', array(
		'label'   => __( 'Hero Heading', 'estatein' ),
		'section' => 'estatein_hero',
		'type'    => 'text',
	) );

	$wp_customize->add_setting( 'estatein_hero_subtext', array(
		'default'           => __( 'Your journey to finding the perfect property begins here.', 'estatein' ),
		'sanitize_callback' => 'sanitize_textarea_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'estatein_hero_subtext', array(
		'label'   => __( 'Hero Subtext', 'estatein' ),
		'section' => 'estatein_hero',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'estatein_hero_image', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'estatein_hero_image', array(
		'label'     => __( 'Hero Background Image', 'estatein' ),
		'section'   => 'estatein_hero',
		'mime_type' => 'image',
	) ) );

	// ============================================================
	// Stats
	// ============================================================
	$wp_customize->add_section( 'estatein_stats', array(
		'title'    => __( 'Hero Stats', 'estatein' ),
		'priority' => 35,
	) );

	$stat_defaults = array(
		1 => array( 'value' => '200+', 'label' => 'Happy Customers' ),
		2 => array( 'value' => '10k+', 'label' => 'Properties For Clients' ),
		3 => array( 'value' => '16+',  'label' => 'Years of Experience' ),
	);

	for ( $i = 1; $i <= 3; $i++ ) {
		$wp_customize->add_setting( "estatein_stat_{$i}_value", array(
			'default'           => $stat_defaults[ $i ]['value'],
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( "estatein_stat_{$i}_value", array(
			'label'   => sprintf( __( 'Stat %d Value', 'estatein' ), $i ),
			'section' => 'estatein_stats',
			'type'    => 'text',
		) );

		$wp_customize->add_setting( "estatein_stat_{$i}_label", array(
			'default'           => $stat_defaults[ $i ]['label'],
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( "estatein_stat_{$i}_label", array(
			'label'   => sprintf( __( 'Stat %d Label', 'estatein' ), $i ),
			'section' => 'estatein_stats',
			'type'    => 'text',
		) );
	}

	// ============================================================
	// Contact / CF7
	// ============================================================
	$wp_customize->add_section( 'estatein_contact', array(
		'title'    => __( 'Contact Settings', 'estatein' ),
		'priority' => 80,
	) );

	$wp_customize->add_setting( 'estatein_cf7_id', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'estatein_cf7_id', array(
		'label'       => __( 'Contact Form 7 Form ID', 'estatein' ),
		'description' => __( 'Enter the ID of your CF7 form (optional — leave blank to use built-in form).', 'estatein' ),
		'section'     => 'estatein_contact',
		'type'        => 'text',
	) );
}
add_action( 'customize_register', 'estatein_customize_register' );
