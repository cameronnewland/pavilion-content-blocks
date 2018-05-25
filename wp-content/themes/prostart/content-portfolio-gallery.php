<?php
/**
 * The Gallery template to display posts
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0
 */

$prostart_blog_style = explode('_', prostart_get_theme_option('blog_style'));
$prostart_columns = empty($prostart_blog_style[1]) ? 2 : max(2, $prostart_blog_style[1]);
$prostart_post_format = get_post_format();
$prostart_post_format = empty($prostart_post_format) ? 'standard' : str_replace('post-format-', '', $prostart_post_format);
$prostart_animation = prostart_get_theme_option('blog_animation');
$prostart_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($prostart_columns).' post_format_'.esc_attr($prostart_post_format) ); ?>
	<?php echo (!prostart_is_off($prostart_animation) ? ' data-animation="'.esc_attr(prostart_get_animation_classes($prostart_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($prostart_image[1]) && !empty($prostart_image[2])) echo intval($prostart_image[1]) .'x' . intval($prostart_image[2]); ?>"
	data-src="<?php if (!empty($prostart_image[0])) echo esc_url($prostart_image[0]); ?>"
	>

	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$prostart_image_hover = 'icon';	//prostart_get_theme_option('image_hover');
	if (in_array($prostart_image_hover, array('icons', 'zoom'))) $prostart_image_hover = 'dots';
	$prostart_components = prostart_array_get_keys_by_value(prostart_get_theme_option('meta_parts'));
	$prostart_counters = prostart_array_get_keys_by_value(prostart_get_theme_option('counters'));
	prostart_show_post_featured(array(
		'hover' => $prostart_image_hover,
		'thumb_size' => prostart_get_thumb_size( strpos(prostart_get_theme_option('body_style'), 'full')!==false || $prostart_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. (!empty($prostart_components)
										? prostart_show_post_meta(apply_filters('prostart_filter_post_meta_args', array(
											'components' => $prostart_components,
											'counters' => $prostart_counters,
											'seo' => false,
											'echo' => false
											), $prostart_blog_style[0], $prostart_columns))
										: '')
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'prostart') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>