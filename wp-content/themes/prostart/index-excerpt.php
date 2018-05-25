<?php
/**
 * The template for homepage posts with "Excerpt" style
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0
 */

prostart_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	prostart_show_layout(get_query_var('blog_archive_start'));

	?><div class="posts_container"><?php
	
	$prostart_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$prostart_sticky_out = prostart_get_theme_option('sticky_style')=='columns' 
							&& is_array($prostart_stickies) && count($prostart_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($prostart_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	while ( have_posts() ) { the_post(); 
		if ($prostart_sticky_out && !is_sticky()) {
			$prostart_sticky_out = false;
			?></div><?php
		}
		get_template_part( 'content', $prostart_sticky_out && is_sticky() ? 'sticky' : 'excerpt' );
	}
	if ($prostart_sticky_out) {
		$prostart_sticky_out = false;
		?></div><?php
	}
	
	?></div><?php

	prostart_show_pagination();

	prostart_show_layout(get_query_var('blog_archive_end'));

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>