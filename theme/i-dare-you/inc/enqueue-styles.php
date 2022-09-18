<?php
add_action( 'wp_enqueue_scripts', 'enqueue_styles' );

if ( ! function_exists( 'enqueue_styles' ) ) {
	function enqueue_styles() {
		wp_enqueue_style( 'i-dare-you', get_template_directory_uri() . '/css/i-dare-you.css', array(), false );
	}
}
