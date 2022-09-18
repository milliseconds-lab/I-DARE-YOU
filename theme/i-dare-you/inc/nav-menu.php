<?php
add_action( 'init', 'register_menus' );
if ( ! function_exists( 'register_menus' ) ) {
	function register_menus() {
		register_nav_menus( array(
			'gn_menu' => __( 'Global Navigation Menu', 'i-dare-you' )
		) );
	}
}
add_action( 'admin_head-nav-menus.php', 'register_menus_post_type_archive' );
if ( ! function_exists( 'register_menus_post_type_archive' ) ) {
	function register_menus_post_type_archive() {
		add_meta_box( 'metabox_menus_post_type_archives', __( 'Venues Types' ), 'metabox_menus_post_type_archives', 'nav-menus', 'side', 'default' );
	}
}
if ( ! function_exists( 'metabox_menus_post_type_archives' ) ) {
	function metabox_menus_post_type_archives() {
		$post_types = get_post_types( array( 'show_in_nav_menus' => true, 'has_archive' => true ), 'object' );
		if ( $post_types ) :
			$items      = array();
			$loop_index = 999999;

			foreach ( $post_types as $post_type ) {
				$item = new stdClass();
				$loop_index ++;

				$item->object_id        = $loop_index;
				$item->db_id            = 0;
				$item->object           = 'post_type_' . $post_type->query_var;
				$item->menu_item_parent = 0;
				$item->type             = 'custom';
				$item->title            = $post_type->labels->name;
				$item->url              = get_post_type_archive_link( $post_type->query_var );
				$item->target           = '';
				$item->attr_title       = '';
				$item->classes          = array();
				$item->xfn              = '';

				$items[] = $item;
			}

			$walker = new Walker_Nav_Menu_Checklist( array() );
			echo '<div id="posttype-archive" class="posttypediv">';
			echo '<div id="tabs-panel-posttype-archive" class="tabs-panel tabs-panel-active">';
			echo '<ul id="posttype-archive-checklist" class="categorychecklist form-no-clear">';
			echo walk_nav_menu_tree( array_map( 'wp_setup_nav_menu_item', $items ), 0, (object) array( 'walker' => $walker ) );
			echo '</ul>';
			echo '</div>';
			echo '</div>';
			echo '<p class="button-controls">';
			echo '<span class="add-to-menu">';
			echo '<input type="submit"' . disabled( 1, 0 ) . ' class="button-secondary submit-add-to-menu right" value="' . __( 'Add to Menu', 'andromedamedia' ) . '" name="add-posttype-archive-menu-item" id="submit-posttype-archive" />';
			echo '<span class="spinner"></span>';
			echo '</span>';
			echo '</p>';
		endif;
	}
}
?>