<?php
/**
* Google Fonts Implementation
*
* @package Seed
* @since Seed 1.0
*
*/

/**
* Register Google Fonts
*
* @since Seed 1.0
*/
function organic_register_fonts() {
	$protocol = is_ssl() ? 'https' : 'http';
	wp_register_style( 'seed_open_sans', "$protocol://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800,800italic,700italic,600italic,400italic,300italic" );
	wp_register_style( 'seed_merriweather', "$protocol://fonts.googleapis.com/css?family=Merriweather:400,700,300,900" );
}
add_action( 'init', 'organic_register_fonts' );

/**
* Enqueue Google Fonts on Front End
*
* @since Seed 1.0
*/

function organic_fonts() {
	wp_enqueue_style( 'seed_open_sans' );
	wp_enqueue_style( 'seed_merriweather' );
}
add_action( 'wp_enqueue_scripts', 'organic_fonts' );

/**
* Enqueue Google Fonts on Custom Header Page
*
* @since Seed 1.0
*/
function organic_admin_fonts( $hook_suffix ) {
	if ( 'appearance_page_custom-header' != $hook_suffix )
	return;
	
	wp_enqueue_style( 'seed_open_sans' );
	wp_enqueue_style( 'seed_merriweather' );
}
add_action( 'admin_enqueue_scripts', 'organic_admin_fonts' );

/**
* Add Google Scripts for use with the editor
*
* @since Seed 2.0
*/
function organic_mce_google_fonts_styles() {
	$protocol = is_ssl() ? 'https' : 'http';
	
	$open_sans_url = "$protocol://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800,800italic,700italic,600italic,400italic,300italic";
		add_editor_style( esc_url_raw( str_replace( ',', '%2C', $open_sans_url ) ) );
	
	$merriweather_url = "$protocol://fonts.googleapis.com/css?family=Merriweather:400,700,300,900";
		add_editor_style( esc_url_raw( str_replace( ',', '%2C', $merriweather_url ) ) );
}
add_action( 'init', 'organic_mce_google_fonts_styles' );