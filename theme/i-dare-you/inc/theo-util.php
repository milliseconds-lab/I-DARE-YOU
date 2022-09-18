<?php
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );
if ( ! function_exists( 'remove_jquery_migrate' ) ) {
	function remove_jquery_migrate( $scripts ) {
		if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
			$script = $scripts->registered['jquery'];
			if ( $script->deps ) {
				$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
			}
		}
	}
}

if ( ! function_exists( 'get_post_type_link' ) ) {
	function get_post_type_link( $archive = 'post', $post_name = null, $query = null ) {
		$url = get_post_type_archive_link( $archive );
		if ( substr( $url, - 1 ) != "/" ) {
			$url .= "/";
		}
		if ( $query != null ) {
			$url .= $query . '/';
		}
		if ( $post_name != null ) {
			$url .= $post_name . '/';
		}

		return $url;
	}
}

add_action( 'nav_menu_css_class', 'add_current_nav_class', 10, 2 );
if ( ! function_exists( 'add_current_nav_class' ) ) {
	function add_current_nav_class( $classes, $item ) {
		global $post;
		$current_post_type      = get_post_type_object( get_post_type( $post->ID ) );
		$current_post_type_slug = $current_post_type->rewrite[ slug ];
		$menu_slug              = strtolower( trim( $item->url ) );
		if ( strpos( $menu_slug, $current_post_type_slug ) !== false ) {
			$classes[] = 'current-menu-item';
		}

		return $classes;
	}
}