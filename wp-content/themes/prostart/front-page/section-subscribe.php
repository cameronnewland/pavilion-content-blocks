<div class="front_page_section front_page_section_subscribe<?php
			$prostart_scheme = prostart_get_theme_option('front_page_subscribe_scheme');
			if (!prostart_is_inherit($prostart_scheme)) echo ' scheme_'.esc_attr($prostart_scheme);
			echo ' front_page_section_paddings_'.esc_attr(prostart_get_theme_option('front_page_subscribe_paddings'));
		?>"<?php
		$prostart_css = '';
		$prostart_bg_image = prostart_get_theme_option('front_page_subscribe_bg_image');
		if (!empty($prostart_bg_image)) 
			$prostart_css .= 'background-image: url('.esc_url(prostart_get_attachment_url($prostart_bg_image)).');';
		if (!empty($prostart_css))
			echo ' style="' . esc_attr($prostart_css) . '"';
?>><?php
	// Add anchor
	$prostart_anchor_icon = prostart_get_theme_option('front_page_subscribe_anchor_icon');	
	$prostart_anchor_text = prostart_get_theme_option('front_page_subscribe_anchor_text');	
	if ((!empty($prostart_anchor_icon) || !empty($prostart_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_subscribe"'
										. (!empty($prostart_anchor_icon) ? ' icon="'.esc_attr($prostart_anchor_icon).'"' : '')
										. (!empty($prostart_anchor_text) ? ' title="'.esc_attr($prostart_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_subscribe_inner<?php
			if (prostart_get_theme_option('front_page_subscribe_fullheight'))
				echo ' prostart-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$prostart_css = '';
			$prostart_bg_mask = prostart_get_theme_option('front_page_subscribe_bg_mask');
			$prostart_bg_color = prostart_get_theme_option('front_page_subscribe_bg_color');
			if (!empty($prostart_bg_color) && $prostart_bg_mask > 0)
				$prostart_css .= 'background-color: '.esc_attr($prostart_bg_mask==1
																	? $prostart_bg_color
																	: prostart_hex2rgba($prostart_bg_color, $prostart_bg_mask)
																).';';
			if (!empty($prostart_css))
				echo ' style="' . esc_attr($prostart_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_subscribe_content_wrap content_wrap">
			<?php
			// Caption
			$prostart_caption = prostart_get_theme_option('front_page_subscribe_caption');
			if (!empty($prostart_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><h2 class="front_page_section_caption front_page_section_subscribe_caption front_page_block_<?php echo !empty($prostart_caption) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post($prostart_caption); ?></h2><?php
			}
		
			// Description (text)
			$prostart_description = prostart_get_theme_option('front_page_subscribe_description');
			if (!empty($prostart_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_description front_page_section_subscribe_description front_page_block_<?php echo !empty($prostart_description) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post(wpautop($prostart_description)); ?></div><?php
			}
			
			// Content
			$prostart_sc = prostart_get_theme_option('front_page_subscribe_shortcode');
			if (!empty($prostart_sc) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_output front_page_section_subscribe_output front_page_block_<?php echo !empty($prostart_sc) ? 'filled' : 'empty'; ?>"><?php
					prostart_show_layout(do_shortcode($prostart_sc));
				?></div><?php
			}
			?>
		</div>
	</div>
</div>