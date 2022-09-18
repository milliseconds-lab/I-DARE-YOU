<?php
add_action( 'init', 'register_post_types' );

if ( ! function_exists( 'register_post_types' ) ) {
	function register_post_types() {
		$post_types = array(
			array(
				'slug'            => 'venues',
				'single_name'     => 'Venues',
				'plural_name'     => 'Venues',
				'capability_type' => 'venues'
			)
		);

		foreach ( $post_types as $post_type ) {
			$labels          = array(
				'name'               => $post_type['plural_name'],
				'singular_name'      => $post_type['single_name'],
				'search_items'       => 'Search ' . $post_type['plural_name'],
				'all_items'          => 'All ' . $post_type['plural_name'],
				'parent_item'        => 'Parent ' . $post_type['single_name'],
				'parent_item_colon'  => 'Parent ' . $post_type['single_name'] . ':',
				'update_item'        => 'Update ' . $post_type['single_name'],
				'add_new'            => 'Add New ' . $post_type['single_name'],
				'add_new_item'       => 'Add New ' . $post_type['single_name'],
				'new_item_name'      => 'New ' . $post_type['single_name'] . ' Name',
				'edit_item'          => 'Edit ' . $post_type['single_name'],
				'view_item'          => 'View ' . $post_type['single_name'],
				'not_found'          => 'No ' . $post_type['plural_name'] . ' found',
				'not_found_in_trash' => 'No ' . $post_type['plural_name'] . ' found in Trash',
				'name_admin_bar'     => $post_type['single_name'],
				'menu_name'          => $post_type['plural_name']
			);
			$hierarchical    = isset( $post_type['hierarchical'] ) ? $post_type['hierarchical'] : true;
			$has_archive     = isset( $post_type['has_archive'] ) ? $post_type['has_archive'] : true;
			$description     = isset( $post_type['description'] ) ? $post_type['description'] : '';
			$menu_position   = isset( $post_type['menu_position'] ) ? $post_type['menu_position'] : 30;
			$menu_icon       = isset( $post_type['menu_icon'] ) ? $post_type['menu_icon'] : null;
			$rewrite         = isset( $post_type['rewrite'] ) ? $post_type['rewrite'] : array(
				'slug' => $post_type['slug']
			);
			$capability_type = isset( $post_type['capability_type'] ) ? $post_type['capability_type'] : 'post';
			$capabilities    = ( $capability_type != 'post' ) ? array(
				'publish_posts'       => 'publish_' . $capability_type,
				'edit_posts'          => 'edit_' . $capability_type,
				'edit_others_posts'   => 'edit_others_' . $capability_type,
				'delete_posts'        => 'delete_' . $capability_type,
				'delete_others_posts' => 'delete_others_' . $capability_type,
				'read_private_posts'  => 'read_private_' . $capability_type,
				'edit_post'           => 'edit_' . $capability_type,
				'delete_post'         => 'delete_' . $capability_type,
				'read_post'           => 'read_' . $capability_type
			) : '';
			$supports        = isset( $post_type['supports'] ) ? $post_type['supports'] : array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'custom-fields',
				'trackbacks',
				'comments',
				'revisions',
				'page-attributes',
				'post-formats'
			);
			$args = array(
				'labels'              => $labels,
				'hierarchical'        => $hierarchical,
				'description'         => $description,
				'public'              => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'menu_position'       => $menu_position,
				'menu_icon'           => $menu_icon,
				'show_in_nav_menus'   => true,
				'publicly_queryable'  => true,
				'exclude_from_search' => false,
				'has_archive'         => $has_archive,
				'query_var'           => true,
				'can_export'          => true,
				'rewrite'             => $rewrite,
				'show_in_rest'        => true,
				'supports'            => $supports
			);
			register_post_type( $post_type['slug'], $args );
		}
	}
}