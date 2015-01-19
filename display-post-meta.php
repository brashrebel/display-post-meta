<?php
/*
Plugin Name: Display Post Meta
Description: This plugin allows you to display the meta data for a post. Just click the DPM link in the toolbar to show meta info.
Version: 1.5
Author: Kyle Maurer
Author URI: http://realbigplugins.com
*/

/*
Credit for taxonomies part goes here http://stackoverflow.com/questions/14956624/show-all-taxonomies-for-a-specific-post-type
*/

class DisplayPostMeta {

	public function __construct() {
		add_action( 'wp_footer', array( $this, 'activate' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_style' ) );
		add_action( 'wp_footer', array( $this, 'scripts' ) );
		add_filter( 'edit_post_link', array( $this, 'add_link' ) );
	}

	// Get all the custom field data
	function get_post_meta_all( $post_id ) {
		global $wpdb;
		$data = array();
		$wpdb->query( "
          SELECT `meta_key`, `meta_value`
          FROM $wpdb->postmeta
          WHERE `post_id` = $post_id
      " );
		foreach ( $wpdb->last_result as $k => $v ) {
			$data[ $v->meta_key ] = $v->meta_value;
		};

		return $data;
	}

	// Register stylesheet
	function register_style() {
		$show_meta = isset( $_GET['show_meta'] ) ? true : false;
		wp_register_style( 'DPMstyle', plugins_url( 'style.css', __FILE__ ), array(), '1.5' );
		if ( $show_meta === true ) {
			wp_enqueue_style( 'DPMstyle' );
		}
	}

	// Display custom field data
	public function custom_fields() {
		$id   = get_the_ID();
		$meta = $this->get_post_meta_all( $id );
		echo '<span class="meta-tab">Custom Fields</span>';
		if ( $meta ) {
			echo '<ul>';
			foreach ( $meta as $key => $value ) {
				echo '<li><strong>' . esc_html( $key ) . '</strong>: ';
				echo wp_kses_post( $value ) . '</li>';
			}
			echo '</ul>';
		} else {
			echo 'This post has no custom field data.';
		}
	}

	// Get and display taxonomies
	public function taxonomies() {
		$post_type = get_post_type();
		$id        = get_the_ID();
		foreach ( get_object_taxonomies( $post_type ) as $taxonomy ) {
			$terms_list = get_the_term_list( $id, $taxonomy, '<ul class="entry-taxonomies"><ul class="tax-terms"><li>', '' . __( '', '' ) . '</li><li>', '</li></ul></div>' );
			if ( $terms_list ) {
				?>
				<div class="tax-tab">
				<span class="tax-taxonomy"><?php echo esc_html( $taxonomy ); ?></span>
				<?php echo wp_kses_post( $terms_list );
			}
		}
	}

	// Get other pertinent data
	public function other() {
		echo '<span class="meta-tab">Other</span>';
		echo '<ul>';
		echo '<li><strong>ID: </strong>' . get_the_id() . '</li>';
		echo '<li><strong>Author: </strong>' . get_the_author() . '</li>';
		echo '<li><strong>Published: </strong>' . get_the_date() . '</li>';
		echo '<li><strong>Last modified: </strong>' . get_the_modified_date() . '</li>';
		echo '<li><strong>Post status: </strong>' . get_post_status() . '</li>';
		echo '<li><strong>Template: </strong>' . basename( get_page_template() ) . '</li>';
		echo '</ul>';
	}

	// Actually display the stuff
	public function activate() {
		$show_meta = isset( $_GET['show_meta'] ) ? true : false;
		if ( $show_meta === true && current_user_can( 'manage_options' ) ) {
			echo '<div class="show-meta">';
			echo '<span class="dpm-close"><a href="' . remove_query_arg( 'show_meta' ) . '">X</a></span>';
			$this->custom_fields();
			$this->other();
			$this->taxonomies();
			echo '</div>';
		}
	}

	/**
	 * Outputs necessary styling and scripts for toolbar button and in content link
	 */
	public function scripts() {
		if ( current_user_can( 'manage_options' ) && ! is_archive() && ! is_admin() && ! is_search() && ! is_404() && ! is_home() ) {
			echo "<script type='text/javascript'>
			<!--
			    function toggle_visibility(id) {
			       var e = document.getElementById(id);
			       if(e.style.display == 'block')
			          e.style.display = 'none';
			       else
			          e.style.display = 'block';
			    }
			//-->
			</script>";
			echo '<style type="text/css">@media screen and (max-width: 782px) {
			#wp-toolbar > ul > li#wp-admin-bar-show_meta {
			display: list-item;
			}
			#wp-toolbar > ul > li#wp-admin-bar-show_meta a {
			font: 18px/44px "Open Sans", sans-serif !important;
			width: auto !important;
			padding: 0 10px !important;
			color: #aaa !important;
			} }</style>';
		}
	}

	/**
	 * Content which is hidden and displayed by link appended to edit post link
	 */
	public function meta_content() {
		echo '<div id="hidden-meta" style="display: none">';
		$this->custom_fields();
		$this->other();
		$this->taxonomies();
		echo '</div>';
	}

	/**
	 * Link that gets appended to the edit post link on the front end
	 */
	public function meta_link() {
		echo '<a href="#" onclick="toggle_visibility(\'hidden-meta\');">Post Meta</a>';
	}

	/**
	 * Filters the edit post link on the front end and adds meta link and content
	 *
	 * @param $url
	 *
	 * @return string
	 */
	public function add_link( $url ) {
		if ( current_user_can( 'manage_options' ) && ! is_archive() && ! is_admin() && ! is_search() && ! is_404() && ! is_home() ) {
			return $url . $this->meta_link() . $this->meta_content();
		} else {
			return $url;
		}
	}
}

$dpm = new DisplayPostMeta;
include( 'admin-bar.php' );