<?php

function dpm_menu_bar() {

	global $wp_admin_bar;
	$dpm_link = add_query_arg( 'show_meta', 'true' );
	$args = array(
		'parent' => false,
		'id' => 'show_meta',
		'title' => __('DPM', 'text_domain'),
		'href' => $dpm_link,
		'meta' => array(
				'title' => __('DPM')
				)
		);
	$wp_admin_bar->add_menu( $args );
}
add_action( 'wp_before_admin_bar_render', 'dpm_menu_bar', 299 );