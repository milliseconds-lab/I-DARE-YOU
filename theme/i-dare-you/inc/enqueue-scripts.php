<?php
add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );

if ( ! function_exists( 'enqueue_scripts' ) ) {
	function enqueue_scripts() {
		wp_enqueue_script( 'jquery', get_template_directory_uri() . '/vendor/jquery/jquery.min.js', '', '', true );


		if ( is_home() ) {
			// 첫 페이지 일 때
		}

		if ( is_page( 'about' ) ) {
			// about page 일 때
		}

		if ( is_single() ) {
			// single.php 일 때
			if ( is_singular( 'venues' ) ) {
				// venues post type - single 일 때
				// wp_enqueue_script('venues_detail', get_template_directory_uri() . '/js/app_detail_jquery.js', array('jquery'), '', true);
				wp_enqueue_script( 'venues_detail', get_template_directory_uri() . '/js/app_detail.js', '', '', true );
			}
		}

		if ( is_post_type_archive( 'venues' ) ) {
			// venues post type - archive 일 때
			// wp_enqueue_script('venues_list', get_template_directory_uri() . '/js/app_list_jquery.js', array('jquery'), '', true);
			wp_enqueue_script( 'venues_list', get_template_directory_uri() . '/js/app_list.js', '', '', true );
		}

		if ( is_tax( 'series' ) ) {
			// series  taxonomy 일 때
		}
	}
}