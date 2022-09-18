<?php
add_action( 'init', 'register_taxonomies', 0 );

if ( ! function_exists( 'register_taxonomies' ) ) {
	function register_taxonomies() {
		$taxonomies = array(
			array(
				'slug'        => 'series',
				'single_name' => 'Series',
				'plural_name' => 'Series',
				'post_type'   => array(
					'venues'
				) //,
				// 'hierarchical' => false
			)
		);

		foreach ( $taxonomies as $taxonomy ) {
			$labels       = array(
				'name'              => $taxonomy['plural_name'],
				'singular_name'     => $taxonomy['single_name'],
				'search_items'      => 'Search ' . $taxonomy['plural_name'],
				'all_items'         => 'All ' . $taxonomy['plural_name'],
				'parent_item'       => 'Parent ' . $taxonomy['single_name'],
				'parent_item_colon' => 'Parent ' . $taxonomy['single_name'] . ':',
				'edit_item'         => 'Edit ' . $taxonomy['single_name'],
				'update_item'       => 'Update ' . $taxonomy['single_name'],
				'add_new_item'      => 'Add New ' . $taxonomy['single_name'],
				'new_item_name'     => 'New ' . $taxonomy['single_name'] . ' Name',
				'menu_name'         => $taxonomy['plural_name']
			);
			$rewrite      = isset( $taxonomy['rewrite'] ) ? $taxonomy['rewrite'] : array(
				'slug' => $taxonomy['slug']
			);
			$hierarchical = isset( $taxonomy['hierarchical'] ) ? $taxonomy['hierarchical'] : true;
			$has_archive  = isset( $post_type['has_archive'] ) ? $post_type['has_archive'] : true;
			$args         = array(
				'hierarchical'      => $hierarchical,
				'labels'            => $labels,
				'show_ui'           => true,
				'query_var'         => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'has_archive'       => $has_archive,
				'rewrite'           => $rewrite,
			);
			register_taxonomy( $taxonomy['slug'], $taxonomy['post_type'], $args );
		}
	}
}