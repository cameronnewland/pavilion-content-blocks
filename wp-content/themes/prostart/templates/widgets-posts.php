<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0
 */

$prostart_post_id    = get_the_ID();
$prostart_post_date  = prostart_get_date();
$prostart_post_title = get_the_title();
$prostart_post_link  = get_permalink();
$prostart_post_author_id   = get_the_author_meta('ID');
$prostart_post_author_name = get_the_author_meta('display_name');
$prostart_post_author_url  = get_author_posts_url($prostart_post_author_id, '');

$prostart_args = get_query_var('prostart_args_widgets_posts');
$prostart_show_date = isset($prostart_args['show_date']) ? (int) $prostart_args['show_date'] : 1;
$prostart_show_image = isset($prostart_args['show_image']) ? (int) $prostart_args['show_image'] : 1;
$prostart_show_author = isset($prostart_args['show_author']) ? (int) $prostart_args['show_author'] : 1;
$prostart_show_counters = isset($prostart_args['show_counters']) ? (int) $prostart_args['show_counters'] : 1;
$prostart_show_categories = isset($prostart_args['show_categories']) ? (int) $prostart_args['show_categories'] : 1;

$prostart_output = prostart_storage_get('prostart_output_widgets_posts');

$prostart_post_counters_output = '';
if ( $prostart_show_counters ) {
	$prostart_post_counters_output = '<span class="post_info_item post_info_counters">'
								. prostart_get_post_counters('comments')
							. '</span>';
}


$prostart_output .= '<article class="post_item with_thumb">';

if ($prostart_show_image) {
	$prostart_post_thumb = get_the_post_thumbnail($prostart_post_id, prostart_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($prostart_post_thumb) $prostart_output .= '<div class="post_thumb">' . ($prostart_post_link ? '<a href="' . esc_url($prostart_post_link) . '">' : '') . ($prostart_post_thumb) . ($prostart_post_link ? '</a>' : '') . '</div>';
}

$prostart_output .= '<div class="post_content">'
			. ($prostart_show_categories 
					? '<div class="post_categories">'
						. prostart_get_post_categories()
						. $prostart_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($prostart_post_link ? '<a href="' . esc_url($prostart_post_link) . '">' : '') . ($prostart_post_title) . ($prostart_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('prostart_filter_get_post_info', 
								'<div class="post_info">'
									. ($prostart_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($prostart_post_link ? '<a href="' . esc_url($prostart_post_link) . '" class="post_info_date">' : '') 
											. esc_html($prostart_post_date) 
											. ($prostart_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($prostart_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'prostart') . ' ' 
											. ($prostart_post_link ? '<a href="' . esc_url($prostart_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($prostart_post_author_name) 
											. ($prostart_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$prostart_show_categories && $prostart_post_counters_output
										? $prostart_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
prostart_storage_set('prostart_output_widgets_posts', $prostart_output);
?>