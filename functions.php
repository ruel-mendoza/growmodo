<?php
/**
 * Estatein Theme Functions
 *
 * @package Estatein
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
        exit;
}

define( 'ESTATEIN_VERSION', '1.0.0' );
define( 'ESTATEIN_DIR', get_template_directory() );
define( 'ESTATEIN_URI', get_template_directory_uri() );

require_once ESTATEIN_DIR . '/inc/customizer.php';
require_once ESTATEIN_DIR . '/inc/contact-handler.php';

/* ============================================================
   THEME SETUP
   ============================================================ */
function estatein_setup() {
        load_theme_textdomain( 'estatein', ESTATEIN_DIR . '/languages' );

        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'html5', array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
        ) );

        add_theme_support( 'customize-selective-refresh-widgets' );
        add_theme_support( 'wp-block-styles' );
        add_theme_support( 'align-wide' );
        add_theme_support( 'responsive-embeds' );

        add_theme_support( 'editor-color-palette', array(
                array(
                        'name'  => __( 'Purple', 'estatein' ),
                        'slug'  => 'purple',
                        'color' => '#703bf7',
                ),
                array(
                        'name'  => __( 'White', 'estatein' ),
                        'slug'  => 'white',
                        'color' => '#ffffff',
                ),
                array(
                        'name'  => __( 'Dark', 'estatein' ),
                        'slug'  => 'dark',
                        'color' => '#141414',
                ),
        ) );

        add_image_size( 'estatein-hero',      1920, 900,  true );
        add_image_size( 'estatein-card',       600, 400,  true );
        add_image_size( 'estatein-thumbnail',  400, 280,  true );
        add_image_size( 'estatein-square',     200, 200,  true );

        register_nav_menus( array(
                'primary'   => __( 'Primary Navigation', 'estatein' ),
                'footer-1'  => __( 'Footer: Company', 'estatein' ),
                'footer-2'  => __( 'Footer: Services', 'estatein' ),
                'footer-3'  => __( 'Footer: Contact', 'estatein' ),
        ) );
}
add_action( 'after_setup_theme', 'estatein_setup' );

/* ============================================================
   ENQUEUE SCRIPTS & STYLES
   ============================================================ */
function estatein_scripts() {
        wp_enqueue_style(
                'estatein-fonts',
                'https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700&display=swap',
                array(),
                null
        );

        wp_enqueue_style(
                'estatein-style',
                get_stylesheet_uri(),
                array( 'estatein-fonts' ),
                ESTATEIN_VERSION
        );

        wp_enqueue_script(
                'estatein-main',
                ESTATEIN_URI . '/assets/js/main.js',
                array(),
                ESTATEIN_VERSION,
                true
        );

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
        }
}
add_action( 'wp_enqueue_scripts', 'estatein_scripts' );

/* ============================================================
   CUSTOM POST TYPE: PROPERTIES
   ============================================================ */
function estatein_register_post_types() {
        $labels = array(
                'name'                  => _x( 'Properties', 'Post type general name', 'estatein' ),
                'singular_name'         => _x( 'Property', 'Post type singular name', 'estatein' ),
                'menu_name'             => _x( 'Properties', 'Admin Menu text', 'estatein' ),
                'name_admin_bar'        => _x( 'Property', 'Add New on Toolbar', 'estatein' ),
                'add_new'               => __( 'Add New', 'estatein' ),
                'add_new_item'          => __( 'Add New Property', 'estatein' ),
                'new_item'              => __( 'New Property', 'estatein' ),
                'edit_item'             => __( 'Edit Property', 'estatein' ),
                'view_item'             => __( 'View Property', 'estatein' ),
                'all_items'             => __( 'All Properties', 'estatein' ),
                'search_items'          => __( 'Search Properties', 'estatein' ),
                'not_found'             => __( 'No properties found.', 'estatein' ),
                'not_found_in_trash'    => __( 'No properties found in Trash.', 'estatein' ),
                'featured_image'        => __( 'Property Photo', 'estatein' ),
                'set_featured_image'    => __( 'Set property photo', 'estatein' ),
                'remove_featured_image' => __( 'Remove property photo', 'estatein' ),
                'use_featured_image'    => __( 'Use as property photo', 'estatein' ),
        );

        $args = array(
                'labels'             => $labels,
                'public'             => true,
                'publicly_queryable' => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'properties' ),
                'capability_type'    => 'post',
                'has_archive'        => true,
                'hierarchical'       => false,
                'menu_position'      => 5,
                'menu_icon'          => 'dashicons-building',
                'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
                'show_in_rest'       => true,
        );

        register_post_type( 'properties', $args );
}
add_action( 'init', 'estatein_register_post_types' );

/* ============================================================
   CUSTOM TAXONOMIES FOR PROPERTIES
   ============================================================ */
function estatein_register_taxonomies() {
        $property_type_labels = array(
                'name'              => _x( 'Property Types', 'taxonomy general name', 'estatein' ),
                'singular_name'     => _x( 'Property Type', 'taxonomy singular name', 'estatein' ),
                'search_items'      => __( 'Search Property Types', 'estatein' ),
                'all_items'         => __( 'All Property Types', 'estatein' ),
                'edit_item'         => __( 'Edit Property Type', 'estatein' ),
                'update_item'       => __( 'Update Property Type', 'estatein' ),
                'add_new_item'      => __( 'Add New Property Type', 'estatein' ),
                'new_item_name'     => __( 'New Property Type Name', 'estatein' ),
                'menu_name'         => __( 'Property Types', 'estatein' ),
        );

        register_taxonomy( 'property_type', array( 'properties' ), array(
                'hierarchical'      => true,
                'labels'            => $property_type_labels,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => array( 'slug' => 'property-type' ),
                'show_in_rest'      => true,
        ) );

        $location_labels = array(
                'name'          => _x( 'Locations', 'taxonomy general name', 'estatein' ),
                'singular_name' => _x( 'Location', 'taxonomy singular name', 'estatein' ),
                'menu_name'     => __( 'Locations', 'estatein' ),
        );

        register_taxonomy( 'property_location', array( 'properties' ), array(
                'hierarchical' => true,
                'labels'       => $location_labels,
                'show_ui'      => true,
                'query_var'    => true,
                'rewrite'      => array( 'slug' => 'location' ),
                'show_in_rest' => true,
        ) );
}
add_action( 'init', 'estatein_register_taxonomies' );

/* ============================================================
   CUSTOM META BOXES FOR PROPERTIES
   ============================================================ */
function estatein_add_meta_boxes() {
        add_meta_box(
                'estatein_property_details',
                __( 'Property Details', 'estatein' ),
                'estatein_property_details_callback',
                'properties',
                'normal',
                'high'
        );
}
add_action( 'add_meta_boxes', 'estatein_add_meta_boxes' );

function estatein_property_details_callback( $post ) {
        wp_nonce_field( 'estatein_save_property_meta', 'estatein_property_nonce' );

        $price     = get_post_meta( $post->ID, '_property_price', true );
        $bedrooms  = get_post_meta( $post->ID, '_property_bedrooms', true );
        $bathrooms = get_post_meta( $post->ID, '_property_bathrooms', true );
        $area      = get_post_meta( $post->ID, '_property_area', true );
        $address   = get_post_meta( $post->ID, '_property_address', true );
        $status    = get_post_meta( $post->ID, '_property_status', true );
        ?>
        <table class="form-table">
                <tr>
                        <th><label for="property_price"><?php esc_html_e( 'Price ($)', 'estatein' ); ?></label></th>
                        <td><input type="text" id="property_price" name="property_price" value="<?php echo esc_attr( $price ); ?>" class="regular-text" placeholder="e.g. 550,000" /></td>
                </tr>
                <tr>
                        <th><label for="property_bedrooms"><?php esc_html_e( 'Bedrooms', 'estatein' ); ?></label></th>
                        <td><input type="number" id="property_bedrooms" name="property_bedrooms" value="<?php echo esc_attr( $bedrooms ); ?>" class="small-text" min="0" /></td>
                </tr>
                <tr>
                        <th><label for="property_bathrooms"><?php esc_html_e( 'Bathrooms', 'estatein' ); ?></label></th>
                        <td><input type="number" id="property_bathrooms" name="property_bathrooms" value="<?php echo esc_attr( $bathrooms ); ?>" class="small-text" min="0" /></td>
                </tr>
                <tr>
                        <th><label for="property_area"><?php esc_html_e( 'Area (sq ft)', 'estatein' ); ?></label></th>
                        <td><input type="text" id="property_area" name="property_area" value="<?php echo esc_attr( $area ); ?>" class="regular-text" placeholder="e.g. 2,400" /></td>
                </tr>
                <tr>
                        <th><label for="property_address"><?php esc_html_e( 'Address', 'estatein' ); ?></label></th>
                        <td><input type="text" id="property_address" name="property_address" value="<?php echo esc_attr( $address ); ?>" class="regular-text" placeholder="Full address" /></td>
                </tr>
                <tr>
                        <th><label for="property_status"><?php esc_html_e( 'Status', 'estatein' ); ?></label></th>
                        <td>
                                <select id="property_status" name="property_status">
                                        <option value="for-sale" <?php selected( $status, 'for-sale' ); ?>><?php esc_html_e( 'For Sale', 'estatein' ); ?></option>
                                        <option value="for-rent" <?php selected( $status, 'for-rent' ); ?>><?php esc_html_e( 'For Rent', 'estatein' ); ?></option>
                                        <option value="sold" <?php selected( $status, 'sold' ); ?>><?php esc_html_e( 'Sold', 'estatein' ); ?></option>
                                        <option value="rented" <?php selected( $status, 'rented' ); ?>><?php esc_html_e( 'Rented', 'estatein' ); ?></option>
                                </select>
                        </td>
                </tr>
        </table>
        <?php
}

function estatein_save_property_meta( $post_id ) {
        if ( ! isset( $_POST['estatein_property_nonce'] ) ) return;
        if ( ! wp_verify_nonce( $_POST['estatein_property_nonce'], 'estatein_save_property_meta' ) ) return;
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
        if ( ! current_user_can( 'edit_post', $post_id ) ) return;

        $fields = array(
                '_property_price'     => 'property_price',
                '_property_bedrooms'  => 'property_bedrooms',
                '_property_bathrooms' => 'property_bathrooms',
                '_property_area'      => 'property_area',
                '_property_address'   => 'property_address',
                '_property_status'    => 'property_status',
        );

        foreach ( $fields as $meta_key => $field_name ) {
                if ( isset( $_POST[ $field_name ] ) ) {
                        update_post_meta( $post_id, $meta_key, sanitize_text_field( $_POST[ $field_name ] ) );
                }
        }
}
add_action( 'save_post', 'estatein_save_property_meta' );

/* ============================================================
   WIDGETS
   ============================================================ */
function estatein_widgets_init() {
        register_sidebar( array(
                'name'          => __( 'Sidebar', 'estatein' ),
                'id'            => 'sidebar-1',
                'description'   => __( 'Add widgets here.', 'estatein' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
        ) );
}
add_action( 'widgets_init', 'estatein_widgets_init' );

/* ============================================================
   HELPER FUNCTIONS
   ============================================================ */

/**
 * Get property meta value with fallback.
 */
function estatein_get_property_meta( $post_id, $key, $fallback = '' ) {
        $value = get_post_meta( $post_id, $key, true );
        return ! empty( $value ) ? esc_html( $value ) : $fallback;
}

/**
 * Render a property card.
 */
function estatein_render_property_card( $post_id ) {
        $price     = estatein_get_property_meta( $post_id, '_property_price', 'Contact us' );
        $bedrooms  = estatein_get_property_meta( $post_id, '_property_bedrooms', '' );
        $bathrooms = estatein_get_property_meta( $post_id, '_property_bathrooms', '' );
        $status    = estatein_get_property_meta( $post_id, '_property_status', 'for-sale' );

        ob_start();
        ?>
        <article class="property-card">
                <?php if ( has_post_thumbnail( $post_id ) ) : ?>
                        <?php echo get_the_post_thumbnail( $post_id, 'estatein-card', array( 'class' => 'property-card__image' ) ); ?>
                <?php else : ?>
                        <div class="property-card__image-placeholder">🏠</div>
                <?php endif; ?>

                <div class="property-card__info">
                        <div>
                                <h3 class="property-card__title"><?php echo esc_html( get_the_title( $post_id ) ); ?></h3>
                                <p class="property-card__desc">
                                        <?php echo wp_trim_words( get_the_excerpt( $post_id ), 20, '' ); ?>
                                        <a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" class="read-more"><?php esc_html_e( 'Read More', 'estatein' ); ?></a>
                                </p>
                        </div>

                        <div class="property-card__features">
                                <?php if ( $bedrooms ) : ?>
                                        <span class="property-badge">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12v4a1 1 0 001 1h16a1 1 0 001-1v-4"/><path d="M2 9h20v3H2z"/><path d="M5 9V5h14v4"/></svg>
                                                <?php echo esc_html( $bedrooms ); ?>-<?php esc_html_e( 'Bedroom', 'estatein' ); ?>
                                        </span>
                                <?php endif; ?>
                                <?php if ( $bathrooms ) : ?>
                                        <span class="property-badge">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l-4 4H3v7h18v-7h-2L15 6H9z"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                                <?php echo esc_html( $bathrooms ); ?>-<?php esc_html_e( 'Bathroom', 'estatein' ); ?>
                                        </span>
                                <?php endif; ?>
                                <?php
                                $types = get_the_terms( $post_id, 'property_type' );
                                if ( $types && ! is_wp_error( $types ) ) :
                                        foreach ( $types as $type ) :
                                ?>
                                        <span class="property-badge">🏠 <?php echo esc_html( $type->name ); ?></span>
                                <?php endforeach; endif; ?>
                        </div>

                        <div class="property-card__footer">
                                <div>
                                        <p class="property-card__price-label"><?php esc_html_e( 'Price', 'estatein' ); ?></p>
                                        <p class="property-card__price">$<?php echo esc_html( $price ); ?></p>
                                </div>
                                <a href="<?php echo esc_url( get_permalink( $post_id ) ); ?>" class="btn btn-primary" style="flex:1;">
                                        <?php esc_html_e( 'View Property Details', 'estatein' ); ?>
                                </a>
                        </div>
                </div>
        </article>
        <?php
        return ob_get_clean();
}

/**
 * Excerpt length for properties.
 */
function estatein_excerpt_length( $length ) {
        if ( get_post_type() === 'properties' ) {
                return 20;
        }
        return $length;
}
add_filter( 'excerpt_length', 'estatein_excerpt_length' );

/**
 * Body classes.
 */
function estatein_body_classes( $classes ) {
        if ( is_singular() ) {
                $classes[] = 'is-singular';
        }
        return $classes;
}
add_filter( 'body_class', 'estatein_body_classes' );

/**
 * Flush rewrite rules on activation.
 */
function estatein_rewrite_flush() {
        estatein_register_post_types();
        flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'estatein_rewrite_flush' );

/* ============================================================
   ACF: INNER PAGE HERO FIELD GROUP
   Requires Advanced Custom Fields (free or Pro).
   Note: Intelephense reports P1010 on acf_* calls because it
   has no ACF stubs — the acf/init hook guarantees ACF is loaded.
   ============================================================ */
add_action( 'acf/init', 'estatein_register_acf_hero_fields' );
function estatein_register_acf_hero_fields() {
        acf_add_local_field_group( array( // phpcs:ignore -- ACF plugin function, loaded via acf/init hook
                'key'    => 'group_estatein_inner_page_hero',
                'title'  => 'Inner Page Hero',
                'fields' => array(

                        array(
                                'key'           => 'field_hero_background_image',
                                'label'         => 'Background Image',
                                'name'          => 'hero_background_image',
                                'type'          => 'image',
                                'instructions'  => 'Recommended size: 960 × 700 px. Displayed as a panel on the left or right side.',
                                'return_format' => 'url',
                                'preview_size'  => 'estatein-hero',
                                'library'       => 'all',
                        ),

                        array(
                                'key'           => 'field_hero_image_position',
                                'label'         => 'Image Position',
                                'name'          => 'hero_image_position',
                                'type'          => 'select',
                                'instructions'  => 'Right / Left: image panel beside the text. Full Width: image spans the entire width above the text.',
                                'choices'       => array(
                                        'right' => 'Right',
                                        'left'  => 'Left',
                                        'full'  => 'Full Width',
                                ),
                                'default_value' => 'right',
                                'allow_null'    => 0,
                                'ui'            => 1,
                        ),

                        array(
                                'key'          => 'field_hero_custom_heading',
                                'label'        => 'Custom Heading',
                                'name'         => 'hero_custom_heading',
                                'type'         => 'textarea',
                                'instructions' => 'HTML is allowed — e.g. <code>Find Your &lt;em&gt;Dream&lt;/em&gt; Home</code>. Leave blank to use the page title.',
                                'placeholder'  => 'e.g. Find Your <em>Dream</em> Home',
                                'new_lines'    => '',
                                'rows'         => 3,
                        ),

                        array(
                                'key'           => 'field_hero_enable_overlay',
                                'label'         => 'Enable Dark Overlay',
                                'name'          => 'hero_enable_overlay',
                                'type'          => 'true_false',
                                'instructions'  => 'Applies a dark gradient over the background image to improve text legibility.',
                                'message'       => 'Enable overlay',
                                'default_value' => 1,
                                'ui'            => 1,
                        ),

                ),
                'location' => array(
                        array(
                                array(
                                        'param'    => 'post_type',
                                        'operator' => '==',
                                        'value'    => 'page',
                                ),
                                array(
                                        'param'    => 'page_type',
                                        'operator' => '!=',
                                        'value'    => 'front_page',
                                ),
                        ),
                ),
                'menu_order'            => 0,
                'position'              => 'normal',
                'style'                 => 'default',
                'label_placement'       => 'top',
                'instruction_placement' => 'label',
                'active'                => true,
        ) );
}
