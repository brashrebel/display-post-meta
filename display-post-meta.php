<?php
/*
Plugin Name: Display Post Meta
Description: This plugin allows you to display the meta data for a post. Just click the DPM link in the toolbar to show meta info.
Version: 1.1.2
Author: Kyle Maurer
Author URI: http://realbigmarketing.com/staff/kyle
*/

/*
Credit for taxonomies part goes here http://stackoverflow.com/questions/14956624/show-all-taxonomies-for-a-specific-post-type
*/
function get_post_meta_all($post_id){
    global $wpdb;
    $data   =   array();
    $wpdb->query("
        SELECT `meta_key`, `meta_value`
        FROM $wpdb->postmeta
        WHERE `post_id` = $post_id
    ");
    foreach($wpdb->last_result as $k => $v){
        $data[$v->meta_key] =   $v->meta_value;
    };
    return $data;
}
// Register stylesheet
function dpm_register_style() {
  $show_meta = $_GET['show_meta'];
  wp_register_style( 'DPMstyle', plugins_url('style.css', __FILE__) );
    if ($show_meta == 'true') {
      wp_enqueue_style( 'DPMstyle' );
    }
}
add_action('wp_enqueue_scripts', 'dpm_register_style');
//Create shortcode
function dpm_display( $atts ){
if ( is_user_logged_in() ) {
$meta = get_post_meta_all(get_the_ID());
   echo '<div class="show-meta"><span class="meta-tab">All post meta data</span><p class="meta-data">';
   print("<pre>".print_r($meta,true)."</pre>");
//Taxonomies
  $id = get_the_ID();
  foreach ( get_object_taxonomies( 'post' ) as $taxonomy ) {
    $terms_list = get_the_term_list( $id, $taxonomy, '<ul class="entry-taxonomies"><ul class="tax-terms"><li>', ''.__( '', '' ).'</li><li>','</li></ul></div>' );
    if ( $terms_list ) {?>                  
     <div class="tax-tab"><span class="tax-taxonomy"><?php echo $taxonomy; ?></span><?php echo $terms_list; ?><?php
	}
  }?>

  </ul></p></div></div>
<?php
}
}

add_shortcode( 'show_meta', 'display_meta' );
function dpm_activate() {
  $show_meta = $_GET['show_meta'];
  if ($show_meta == 'true') {
    dpm_display();
  }
}
add_action('wp', 'dpm_activate');

include('admin-bar.php');
?>