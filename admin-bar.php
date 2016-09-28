<?php
// Exit if loaded directly
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * Adds the DPM button to the toolbar
 */
function dpm_menu_bar() {

	if ( current_user_can( 'manage_options' ) && ! is_archive() && ! is_admin() && ! is_search() && ! is_404() && ! is_home() && is_singular() ) {
		global $wp_admin_bar;
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
