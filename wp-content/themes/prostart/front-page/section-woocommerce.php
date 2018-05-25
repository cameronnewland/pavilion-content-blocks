<div class="front_page_section front_page_section_woocommerce<?php
			$prostart_scheme = prostart_get_theme_option('front_page_woocommerce_scheme');
			if (!prostart_is_inherit($prostart_scheme)) echo ' scheme_'.esc_attr($prostart_scheme);
			echo ' front_page_section_paddings_'.esc_attr(prostart_get_theme_option('front_page_woocommerce_paddings'));
		?>"<?php
		$prostart_css = '';
		$prostart_bg_image = prostart_get_theme_option('front_page_woocommerce_bg_image');
		if (!empty($prostart_bg_image)) 
			$prostart_css .= 'background-image: url('.esc_url(prostart_get_attachment_url($prostart_bg_image)).');';
		if (!empty($prostart_css))
			echo ' style="' . esc_attr($prostart_css) . '"';
?>><?php
	// Add anchor
	$prostart_anchor_icon = prostart_get_theme_option('front_page_woocommerce_anchor_icon');	
	$prostart_anchor_text = prostart_get_theme_option('front_page_woocommerce_anchor_text');	
	if ((!empty($prostart_anchor_icon) || !empty($prostart_anchor_text)) && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="front_page_section_woocommerce"'
										. (!empty($prostart_anchor_icon) ? ' icon="'.esc_attr($prostart_anchor_icon).'"' : '')
										. (!empty($prostart_anchor_text) ? ' title="'.esc_attr($prostart_anchor_text).'"' : '')
										. ']');
	}
	?>
	<div class="front_page_section_inner front_page_section_woocommerce_inner<?php
			if (prostart_get_theme_option('front_page_woocommerce_fullheight'))
				echo ' prostart-full-height sc_layouts_flex sc_layouts_columns_middle';
			?>"<?php
			$prostart_css = '';
			$prostart_bg_mask = prostart_get_theme_option('front_page_woocommerce_bg_mask');
			$prostart_bg_color = prostart_get_theme_option('front_page_woocommerce_bg_color');
			if (!empty($prostart_bg_color) && $prostart_bg_mask > 0)
				$prostart_css .= 'background-color: '.esc_attr($prostart_bg_mask==1
																	? $prostart_bg_color
																	: prostart_hex2rgba($prostart_bg_color, $prostart_bg_mask)
																).';';
			if (!empty($prostart_css))
				echo ' style="' . esc_attr($prostart_css) . '"';
	?>>
		<div class="front_page_section_content_wrap front_page_section_woocommerce_content_wrap content_wrap woocommerce">
			<?php
			// Content wrap with title and description
			$prostart_caption = prostart_get_theme_option('front_page_woocommerce_caption');
			$prostart_description = prostart_get_theme_option('front_page_woocommerce_description');
			if (!empty($prostart_caption) || !empty($prostart_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
				// Caption
				if (!empty($prostart_caption) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><h2 class="front_page_section_caption front_page_section_woocommerce_caption front_page_block_<?php echo !empty($prostart_caption) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post($prostart_caption);
					?></h2><?php
				}
			
				// Description (text)
				if (!empty($prostart_description) || (current_user_can('edit_theme_options') && is_customize_preview())) {
					?><div class="front_page_section_description front_page_section_woocommerce_description front_page_block_<?php echo !empty($prostart_description) ? 'filled' : 'empty'; ?>"><?php
						echo wp_kses_post(wpautop($prostart_description));
					?></div><?php
				}
			}
		
			// Content (widgets)
			?><div class="front_page_section_output front_page_section_woocommerce_output list_products shop_mode_thumbs"><?php 
				$prostart_woocommerce_sc = prostart_get_theme_option('front_page_woocommerce_products');
				if ($prostart_woocommerce_sc == 'products') {
					$prostart_woocommerce_sc_ids = prostart_get_theme_option('front_page_woocommerce_products_per_page');
					$prostart_woocommerce_sc_per_page = count(explode(',', $prostart_woocommerce_sc_ids));
				} else {
					$prostart_woocommerce_sc_per_page = max(1, (int) prostart_get_theme_option('front_page_woocommerce_products_per_page'));
				}
				$prostart_woocommerce_sc_columns = max(1, min($prostart_woocommerce_sc_per_page, (int) prostart_get_theme_option('front_page_woocommerce_products_columns')));
				echo do_shortcode("[{$prostart_woocommerce_sc}"
									. ($prostart_woocommerce_sc == 'products' 
											? ' ids="'.esc_attr($prostart_woocommerce_sc_ids).'"' 
											: '')
									. ($prostart_woocommerce_sc == 'product_category' 
											? ' category="'.esc_attr(prostart_get_theme_option('front_page_woocommerce_products_categories')).'"' 
											: '')
									. ($prostart_woocommerce_sc != 'best_selling_products' 
											? ' orderby="'.esc_attr(prostart_get_theme_option('front_page_woocommerce_products_orderby')).'"'
											  . ' order="'.esc_attr(prostart_get_theme_option('front_page_woocommerce_products_order')).'"' 
											: '')
									. ' per_page="'.esc_attr($prostart_woocommerce_sc_per_page).'"' 
									. ' columns="'.esc_attr($prostart_woocommerce_sc_columns).'"' 
									. ']');
			?></div>
		</div>
	</div>
</div>