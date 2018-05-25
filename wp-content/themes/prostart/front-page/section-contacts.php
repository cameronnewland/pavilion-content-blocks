<div class="front_page_section front_page_section_contacts<?php
			$prostart_scheme = prostart_get_theme_option('front_page_contacts_scheme');
			if (!prostart_is_inherit($prostart_scheme)) echo ' scheme_'.esc_attr($prostart_scheme);
			echo ' front_page_section_paddings_'.esc_attr(prostart_get_theme_option('front_page_contacts_paddings'));
		?>"<?php
		$prostart_css = '';
		$prostart_bg_image = prostart_get_theme_option('front_page_contacts_bg_image');
		if (!empty($prostart_bg_image)) 
			$prostart_css .= 'background-image: url('.esc_url(prostart_get_attachment_url($prostart_bg_image)).');';
		if (!empty($prostart_css))
			echo ' style="' . esc_attr($prostart_css) . '"';
?>><?php
	// Add anchor
	$prostart_anchor_icon = prostart_get_theme_option('front_page_contacts_anchor_icon');	
	$prostart_anchor_text = prostart_get_theme_option('front_page_contacts_anchor_text');	
	if ((!empty($prostart_anchor_icon) || !empty($prostart_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_contacts"'
										. (!empty($prostart_anchor_icon) ? ' icon="'.esc_attr($prostart_anchor_icon).'"' : '')
										. (!empty($prostart_anchor_text) ? ' title="'.esc_attr($prostart_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_contacts_inner<?php
			if (prostart_get_theme_option('front_page_contacts_fullheight'))
				echo ' prostart-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$prostart_css = '';
			$prostart_bg_mask = prostart_get_theme_option('front_page_contacts_bg_mask');
			$prostart_bg_color = prostart_get_theme_option('front_page_contacts_bg_color');
			if (!empty($prostart_bg_color) && $prostart_bg_mask > 0)
				$prostart_css .= 'background-color: '.esc_attr($prostart_bg_mask==1
																	? $prostart_bg_color
																	: prostart_hex2rgba($prostart_bg_color, $prostart_bg_mask)
																).';';
			if (!empty($prostart_css))
				echo ' style="' . esc_attr($prostart_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_contacts_content_wrap content_wrap">
			<?php

			// Title and description
			$prostart_caption = prostart_get_theme_option('front_page_contacts_caption');
			$prostart_description = prostart_get_theme_option('front_page_contacts_description');
			if (!empty($prostart_caption) || !empty($prostart_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				// Caption
				if (!empty($prostart_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h2 class="front_page_section_caption front_page_section_contacts_caption front_page_block_<?php echo !empty($prostart_caption) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post($prostart_caption);
					?></h2><?php
				}
			
				// Description
				if (!empty($prostart_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_contacts_description front_page_block_<?php echo !empty($prostart_description) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post(wpautop($prostart_description));
					?></div><?php
				}
			}

			// Content (text)
			$prostart_content = prostart_get_theme_option('front_page_contacts_content');
			$prostart_layout = prostart_get_theme_option('front_page_contacts_layout');
			if ($prostart_layout == 'columns' && (!empty($prostart_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?><div class="front_page_section_columns front_page_section_contacts_columns columns_wrap">
					<div class="column-1_3">
				<?php
			}

			if ((!empty($prostart_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?><div class="front_page_section_content front_page_section_contacts_content front_page_block_<?php echo !empty($prostart_content) ? 'filled' : 'empty'; ?>"><?php
					echo wp_kses_post($prostart_content);
				?></div><?php
			}

			if ($prostart_layout == 'columns' && (!empty($prostart_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div><div class="column-2_3"><?php
			}
		
			// Shortcode output
			$prostart_sc = prostart_get_theme_option('front_page_contacts_shortcode');
			if (!empty($prostart_sc) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				?><div class="front_page_section_output front_page_section_contacts_output front_page_block_<?php echo !empty($prostart_sc) ? 'filled' : 'empty'; ?>"><?php
					prostart_show_layout(do_shortcode($prostart_sc));
				?></div><?php
			}

			if ($prostart_layout == 'columns' && (!empty($prostart_content) || (current_user_can('edit_theme_options') && is_customize_preview()))) {
				?></div></div><?php
			}
			?>			
		</div>
	</div>
</div>