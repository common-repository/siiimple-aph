<?php
// Action: login_head
function iiiaph_login_head() {
	wp_enqueue_style( 'iiiaph', esc_url( plugin_dir_url( IIIAPH_PLUGIN_FILE ) ) . 'assets/css/login.css' );
}
add_action( 'login_head', 'iiiaph_login_head' );

// Action: login_headertitle
function iiiaph_login_headertitle() {
	return get_bloginfo( 'name' ) . ' &bull; par Siiimple';
}
add_filter( 'login_headertitle', 'iiiaph_login_headertitle' );

// Action: login_headerurl
function iiiaph_login_headerurl() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'iiiaph_login_headerurl' );

// Action: woocommerce_before_main_content
function iiiaph_woocommerce_before_main_content() {
	$cf7_order_form = get_option( 'iiiaph_cf7_order_form' );
	echo do_shortcode('[lightbox id="aph-form-link" width="600px" padding="20px 25px"]' . do_shortcode( '[contact-form-7 id="' . $cf7_order_form . '"]' ) . '[/lightbox]');
}
add_action( 'woocommerce_before_main_content', 'iiiaph_woocommerce_before_main_content', 99 );

// Action: wp_enqueue_scripts
function iiiaph_wp_enqueue_scripts() {
    wp_enqueue_style( 'iiiaph', esc_url( plugin_dir_url( IIIAPH_PLUGIN_FILE ) ) . 'assets/css/aph.css' );
	wp_enqueue_script( 'iiiaph', esc_url( plugin_dir_url( IIIAPH_PLUGIN_FILE ) ) . 'assets/js/aph.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'iiiaph_wp_enqueue_scripts' );

// Action: wp_footer
function iiiaph_wp_footer() {
	include_once( dirname( IIIAPH_PLUGIN_FILE ) . '/services/cookieconsent.php' );
}
add_action( 'wp_footer', 'iiiaph_wp_footer', 99 );

// Action: wp_head
function iiiaph_wp_head() {
	if ( ! current_user_can( 'publish_pages' ) ) : include_once( dirname( IIIAPH_PLUGIN_FILE ) . '/services/googletagmanager.php' ); endif;
}
add_action( 'wp_head', 'iiiaph_wp_head', 99 );