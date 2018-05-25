<?php
/**
 * The Portfolio template to display the content
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

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($prostart_columns).' post_format_'.esc_attr($prostart_post_format).(is_sticky() && !is_paged() ? ' sticky' : '') ); ?>
	<?php echo (!prostart_is_off($prostart_animation) ? ' data-animation="'.esc_attr(prostart_get_animation_classes($prostart_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$prostart_image_hover = prostart_get_theme_option('image_hover');
	// Featured image
	prostart_show_post_featured(array(
		'thumb_size' => prostart_get_thumb_size(strpos(prostart_get_theme_option('body_style'), 'full')!==false || $prostart_columns < 3 
								? 'masonry-big' 
								: 'masonry'),
		'show_no_image' => true,
		'class' => $prostart_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $prostart_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>