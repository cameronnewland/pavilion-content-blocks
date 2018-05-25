<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0.06
 */

$prostart_header_css = '';
$prostart_header_image = get_header_image();
$prostart_header_video = prostart_get_header_video();
if (!empty($prostart_header_image) && prostart_trx_addons_featured_image_override(is_singular() || prostart_storage_isset('blog_archive') || is_category())) {
	$prostart_header_image = prostart_get_current_mode_image($prostart_header_image);
}

$prostart_header_id = str_replace('header-custom-', '', prostart_get_theme_option("header_style"));
if ((int) $prostart_header_id == 0) {
	$prostart_header_id = prostart_get_post_id(array(
												'name' => $prostart_header_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
												)
											);
} else {
	$prostart_header_id = apply_filters('prostart_filter_get_translated_layout', $prostart_header_id);
}
$prostart_header_meta = get_post_meta($prostart_header_id, 'trx_addons_options', true);

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($prostart_header_id); 
				?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($prostart_header_id)));
				echo !empty($prostart_header_image) || !empty($prostart_header_video) 
					? ' with_bg_image' 
					: ' without_bg_image';
				if ($prostart_header_video!='') 
					echo ' with_bg_video';
				if ($prostart_header_image!='') 
					echo ' '.esc_attr(prostart_add_inline_css_class('background-image: url('.esc_url($prostart_header_image).');'));
				if (!empty($prostart_header_meta['margin']) != '') 
					echo ' '.esc_attr(prostart_add_inline_css_class('margin-bottom: '.esc_attr(prostart_prepare_css_value($prostart_header_meta['margin'])).';'));
				if (is_single() && has_post_thumbnail()) 
					echo ' with_featured_image';
				if (prostart_is_on(prostart_get_theme_option('header_fullheight'))) 
					echo ' header_fullheight prostart-full-height';
				if (!prostart_is_inherit(prostart_get_theme_option('header_scheme')))
					echo ' scheme_' . esc_attr(prostart_get_theme_option('header_scheme'));
				?>"><?php

	// Background video
	if (!empty($prostart_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('prostart_action_show_layout', $prostart_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );
		
?></header>