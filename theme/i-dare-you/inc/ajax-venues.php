<?php
add_action( 'wp_ajax_get_venues_list', 'get_venues_list_callback' );
add_action( 'wp_ajax_nopriv_get_venues_list', 'get_venues_list_callback' );

if ( ! function_exists( 'get_venues_list_callback' ) ) {
	function get_venues_list_callback() {
		$offset = intval( $_POST['offset'] );
		$limit  = intval( $_POST['limit'] );
		get_posts_venues_list_data( 10, $offset, $limit );
		die();
	}
}

if ( ! function_exists( 'get_posts_venues_list_data' ) ) {
	function get_posts_venues_list_data( $number, $offset, $limit ) {
		if ( $limit > 0 ) {
			if ( $limit <= $number + $offset && $limit >= $offset ) {
				$number = $limit - $offset;
			} else if ( $limit < $offset ) {
				$number = 0;
			}
		}
		if ( $number > 0 ) {
			$posts = wp_get_recent_posts(
				array(
					'post_type'   => 'venues',
					'numberposts' => $number,
					'post_status' => 'publish',
					'offset'      => $offset
				)
			);
		} else {
			$posts = array();
		}
		$_posts_data = array();
		foreach ( $posts as $post ) {
			$post_id     = $post['ID'];
			$post_status = get_post_status( $post_id );
			$post_name   = $post['post_name'];
			$post_title  = $post['post_title'];
			$post_link   = get_post_type_link( 'venues', $post_name );
			// $post_date   = $post['post_date'];
			$post_date   = get_the_time( 'Y년 n월 j일', $post_id );
			$user_data   = get_userdata( $post['post_author'] );
			$author_name = $user_data->data->display_name;
			$author_url  = get_author_posts_url( $post['post_author'] );
			$_author     = array(
				'name' => $author_name,
				'url'  => $author_url
			);
			$_post_data  = array(
				'id'     => $post_id,
				'status' => $post_status,
				'title'  => esc_html( $post_title ),
				'link'   => $post_link,
				'date'   => $post_date,
				'author' => $_author
			);
			array_push( $_posts_data, $_post_data );
		}
		$post_max = count( $posts );
		$fin_bool = ( $post_max < $number ) ? 1 : 0;
		$data     = array(
			'data' => $_posts_data,
			'fin'  => $fin_bool
		);
		header( "Content-type: application/json" );
		echo json_encode( $data );
	}
}


// 로그인 상태 시 ajax action - wp_ajax_{action}
add_action( 'wp_ajax_get_venues_detail', 'get_venues_detail_callback' );
// 로그아웃 상태 시 ajax action - wp_ajax_nopriv_{action}
add_action( 'wp_ajax_nopriv_get_venues_detail', 'get_venues_detail_callback' );

if ( ! function_exists( 'get_venues_detail_callback' ) ) {
	function get_venues_detail_callback() {
		$venue_id = $_POST['id'];
		get_posts_venues_detail_data( $venue_id );
		die();
	}
}

if ( ! function_exists( 'get_posts_venues_detail_data' ) ) {
	function get_posts_venues_detail_data( $venue_id ) {
		$venue         = get_post( $venue_id );
		$venue_status  = $venue->post_status;
		$venue_link    = get_permalink( $venue_id );
		$venue_posts   = get_field( 'post', $venue_id );
		$venue_title   = get_field( 'title', $venue_id );
		$venue_maps    = get_field( 'map', $venue_id );
		$venue_map_lat = $venue_maps['lat'];
		$venue_map_lng = $venue_maps['lng'];
		$_venue_map    = array(
			'name' => $venue_title,
			'lat'  => $venue_map_lat,
			'lng'  => $venue_map_lng
		);
		$venue_data    = array(
			'id'     => $venue_id,
			'status' => $venue_status,
			'title'  => $venue_title,
			'maps'   => $_venue_map
		);
		$data          = array(
			'data' => $venue_data
		);
		header( "Content-type: application/json" );
		echo json_encode( $data );
	}
}
?>