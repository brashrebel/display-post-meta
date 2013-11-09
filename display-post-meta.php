<?php
/*
Plugin Name: Display Post Meta
Description: This plugin allows you to display the meta data for a post. Just add the [show_meta] shortcode in the body of the post you wish to view the meta data for or add ?show_meta to the end of your page's URL.
Version: 1.1
Author: Kyle Maurer
Author URI: http://realbigmarketing.com/staff/kyle
*/

/*
Credit for taxonomies part goes here http://stackoverflow.com/questions/14956624/show-all-taxonomies-for-a-specific-post-type
Check if URL contains https://forums.digitalpoint.com/threads/if-url-contains-x-then.1045579/
Idea for the ?show_meta URL trick from Peter Shackelford http://twitter.com/pixelplow
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


//Create shortcode
function display_meta( $atts ){
if ( is_user_logged_in() ) {
$display_meta_url = site_url();
$display_it = "<link rel='stylesheet' type='text/css' href='".$display_meta_url."/wp-content/plugins/display-post-meta/style.css'>";
$meta = get_post_meta_all(get_the_ID());
   echo $display_it;
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
if (stripos($_SERVER['REQUEST_URI'],'?show_meta') !== false) {
add_action('wp', 'display_meta');
}

?>