<?php
if (($prostart_slider_sc = prostart_get_theme_option('front_page_title_shortcode')) != '' && strpos($prostart_slider_sc, '[')!==false && strpos($prostart_slider_sc, ']')!==false) {

	?><div class="front_page_section front_page_section_title front_page_section_slider front_page_section_title_slider"><?php
		// Add anchor
		$prostart_anchor_icon = prostart_get_theme_option('front_page_title_anchor_icon');	
		$prostart_anchor_text = prostart_get_theme_option('front_page_title_anchor_text');	
		if ((!empty($prostart_anchor_icon) || !empty($prostart_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
			echo do_shortcode('[trx_sc_anchor id="front_page_section_title"'
											. (!empty($prostart_anchor_icon) ? ' icon="'.esc_attr($prostart_anchor_icon).'"' : '')
											. (!empty($prostart_anchor_text) ? ' title="'.esc_attr($prostart_anchor_text).'"' : '')
											. ']');
		}
		// Show slider (or any other content, generated by shortcode)
		echo do_shortcode($prostart_slider_sc);
	?></div><?php

} else {

	?><div class="front_page_section front_page_section_title<?php
				$prostart_scheme = prostart_get_theme_option('front_page_title_scheme');
				if (!prostart_is_inherit($prostart_scheme)) echo ' scheme_'.esc_attr($prostart_scheme);
				echo ' front_page_section_paddings_'.esc_attr(prostart_get_theme_option('front_page_title_paddings'));
			?>"<?php
			$prostart_css = '';
			$prostart_bg_image = prostart_get_theme_option('front_page_title_bg_image');
			if (!empty($prostart_bg_image)) 
				$prostart_css .= 'background-image: url('.esc_url(prostart_get_attachment_url($prostart_bg_image)).');';
			if (!empty($prostart_css))
				echo ' style="' . esc_attr($prostart_css) . '"';
	?>><?php
		// Add anchor
		$prostart_anchor_icon = prostart_get_theme_option('front_page_title_anchor_icon');	
		$prostart_anchor_text = prostart_get_theme_option('front_page_title_anchor_text');	
		if ((!empty($prostart_anchor_icon) || !empty($prostart_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
			echo do_shortcode('[trx_sc_anchor id="front_page_section_title"'
											. (!empty($prostart_anchor_icon) ? ' icon="'.esc_attr($prostart_anchor_icon).'"' : '')
											. (!empty($prostart_anchor_text) ? ' title="'.esc_attr($prostart_anchor_text).'"' : '')
											. ']');
		}
		?>
		<div class="front_page_section_inner front_page_section_title_inner<?php
			if (prostart_get_theme_option('front_page_title_fullheight'))
				echo ' prostart-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
				$prostart_css = '';
				$prostart_bg_mask = prostart_get_theme_option('front_page_title_bg_mask');
				$prostart_bg_color = prostart_get_theme_option('front_page_title_bg_color');
				if (!empty($prostart_bg_color) && $prostart_bg_mask > 0)
					$prostart_css .= 'background-color: '.esc_attr($prostart_bg_mask==1
																		? $prostart_bg_color
																		: prostart_hex2rgba($prostart_bg_color, $prostart_bg_mask)
																	).';';
				if (!empty($prostart_css))
					echo ' style="' . esc_attr($prostart_css) . '"';
		?>>
			<div class="front_page_section_content_wrap front_page_section_title_content_wrap content_wrap">
				<?php
				// Caption
				$prostart_caption = prostart_get_theme_option('front_page_title_caption');
				if (!empty($prostart_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h1 class="front_page_section_caption front_page_section_title_caption front_page_block_<?php echo !empty($prostart_caption) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post($prostart_caption); ?></h1><?php
				}
			
				// Description (text)
				$prostart_description = prostart_get_theme_option('front_page_title_description');
				if (!empty($prostart_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_title_description front_page_block_<?php echo !empty($prostart_description) ? 'filled' : 'empty'; ?>"><?php echo wp_kses_post(wpautop($prostart_description)); ?></div><?php
				}
				
				// Buttons
				if (prostart_get_theme_option('front_page_title_button1_link')!='' || prostart_get_theme_option('front_page_title_button2_link')!='') {
					?><div class="front_page_section_buttons front_page_section_title_buttons"><?php
						prostart_show_layout(prostart_customizer_partial_refresh_front_page_title_button1_link());
						prostart_show_layout(prostart_customizer_partial_refresh_front_page_title_button2_link());
					?></div><?php
				}
				?>
			</div>
		</div>
	</div>
	<?php
}