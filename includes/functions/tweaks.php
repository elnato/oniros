<?php 
/**
 * Remove Query String from Static Resources
 * as explained in http://technumero.com/internet/remove-query-strings-from-static-resources/2986
 * This is better for SEO and performance reasons
 */
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function track_post_views($post_id) 
{
    if (!is_single()) return;
    if (empty($post_id)) {
        global $post;
        $post_id = $post->ID;    
    }
    set_post_views($post_id);
}
add_action( 'wp_head', 'track_post_views');
function remove_cssjs_ver( $src ) {
	if( strpos( $src, '?ver=' ) )
	$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );
