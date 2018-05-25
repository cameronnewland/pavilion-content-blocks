<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0
 */

$prostart_header_css = '';
$prostart_header_image = get_header_image();
$prostart_header_video = prostart_get_header_video();
if (!empty($prostart_header_image) && prostart_trx_addons_featured_image_override(is_singular() || prostart_storage_isset('blog_archive') || is_category())) {
	$prostart_header_image = prostart_get_current_mode_image($prostart_header_image);
}

?><header class="top_panel top_panel_default<?php
					echo !empty($prostart_header_image) || !empty($prostart_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($prostart_header_video!='') echo ' with_bg_video';
					if ($prostart_header_image!='') echo ' '.esc_attr(prostart_add_inline_css_class('background-image: url('.esc_url($prostart_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (prostart_is_on(prostart_get_theme_option('header_fullheight'))) echo ' header_fullheight prostart-full-height';
					if (!prostart_is_inherit(prostart_get_theme_option('header_scheme')))
						echo ' scheme_' . esc_attr(prostart_get_theme_option('header_scheme'));
					?>"><?php

	// Background video
	if (!empty($prostart_header_video)) {
		get_template_part( 'templates/header-video' );
	}
	
	// Main menu
	if (prostart_get_theme_option("menu_style") == 'top') {
		get_template_part( 'templates/header-navi' );
	}

	// Mobile header
	if (prostart_is_on(prostart_get_theme_option("header_mobile_enabled"))) {
		get_template_part( 'templates/header-mobile' );
	}
	
	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );

	// Display featured image in the header on the single posts
	// Comment next line to prevent show featured image in the header area
	// and display it in the post's content
//	get_template_part( 'templates/header-single' );

?></header>