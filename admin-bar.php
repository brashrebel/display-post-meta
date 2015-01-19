<?php
// Exit if loaded directly
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * Adds the DPM button to the toolbar
 */
function dpm_menu_bar() {

	if ( current_user_can( 'manage_options' ) && ! is_archive() && ! is_admin() && ! is_search() && ! is_404() && ! is_home() ) {
		global $wp_admin_bar;
		$query = isset( $_GET['show_meta'] ) ? true : false;
		if ( $query === true ) {
			$dpm_link  = remove_query_arg( 'show_meta' );
			$dpm_class = 'dpm-on';
		} else {
			$dpm_link  = add_query_arg( 'show_meta', 'true' );
			$dpm_class = 'dpm-off';
		}
		$args = array(
			'parent' => false,
			'id'     => 'show_meta',
			'title'  => __( 'DPM', 'text_domain' ),
			'href'   => $dpm_link,
			'meta'   => array(
				'title' => __( 'DPM' ),
				'class' => $dpm_class
			)
		);
		$wp_admin_bar->add_menu( $args );
	}
}

add_action( 'wp_before_admin_bar_render', 'dpm_menu_bar', 299 );