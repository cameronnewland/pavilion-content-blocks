<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the WordPress editor or any Page Builder to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$prostart_content = '';
$prostart_blog_archive_mask = '%%CONTENT%%';
$prostart_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $prostart_blog_archive_mask);
if ( have_posts() ) {
	the_post();
	if (($prostart_content = apply_filters('the_content', get_the_content())) != '') {
		if (($prostart_pos = strpos($prostart_content, $prostart_blog_archive_mask)) !== false) {
			$prostart_content = preg_replace('/(\<p\>\s*)?'.$prostart_blog_archive_mask.'(\s*\<\/p\>)/i', $prostart_blog_archive_subst, $prostart_content);
		} else
			$prostart_content .= $prostart_blog_archive_subst;
		$prostart_content = explode($prostart_blog_archive_mask, $prostart_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) prostart_add_inline_css(strip_tags($vc_custom_css));
	}
}

// Prepare args for a new query
$prostart_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$prostart_args = prostart_query_add_posts_and_cats($prostart_args, '', prostart_get_theme_option('post_type'), prostart_get_theme_option('parent_cat'));
$prostart_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($prostart_page_number > 1) {
	$prostart_args['paged'] = $prostart_page_number;
	$prostart_args['ignore_sticky_posts'] = true;
}
$prostart_ppp = prostart_get_theme_option('posts_per_page');
if ((int) $prostart_ppp != 0)
	$prostart_args['posts_per_page'] = (int) $prostart_ppp;
// Make a new main query
$GLOBALS['wp_the_query']->query($prostart_args);


// Add internal query vars in the new query!
if (is_array($prostart_content) && count($prostart_content) == 2) {
	set_query_var('blog_archive_start', $prostart_content[0]);
	set_query_var('blog_archive_end', $prostart_content[1]);
}

get_template_part('index');
?>