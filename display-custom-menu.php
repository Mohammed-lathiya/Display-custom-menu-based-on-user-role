<?php

function _custom_nav_menu_item( $title, $url, $order, $parent = 0 ){
	$item = new stdClass();
	$item->ID = 1000000 + $order + $parent;
	$item->db_id = $item->ID;
	$item->title = $title;
	$item->url = $url;
	$item->menu_order = $order;
	$item->menu_item_parent = $parent;
	$item->type = '';
	$item->object = '';
	$item->object_id = '';
	$item->classes = array();
	$item->target = '';
	$item->attr_title = '';
	$item->description = '';
	$item->xfn = '';
	$item->status = '';
	return $item;
}

add_filter( 'wp_get_nav_menu_items', 'ms_custom_nav_menu', 20, 2 );
function ms_custom_nav_menu( $items, $menu ) {
	if( is_user_logged_in() ){
		if ( $menu->slug == 'main-menu' ) {
			$user = wp_get_current_user();
			$roles = ( array ) $user->roles;
			if( !empty($roles) ){
				if( in_array('organizer_role', $roles) ){
					$top 	= _custom_nav_menu_item( 'My Contest', '/my-contest/1', 300 );
					$items[] = $top;
					$items[] = _custom_nav_menu_item( 'Profile', '/user/1', 301, $top->ID );
					$items[] = _custom_nav_menu_item( 'Logout', wp_logout_url( home_url() ), 302, $top->ID );
				}else{
					$items[] = _custom_nav_menu_item( 'Logout', wp_logout_url( home_url() ), 300 );
				}
			}
			
  		}
  	}
  	return $items;
}
?>
