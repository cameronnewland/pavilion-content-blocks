<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0
 */

// Page (category, tag, archive, author) title

if ( prostart_need_page_title() ) {
	prostart_sc_layouts_showed('title', true);
	prostart_sc_layouts_showed('postmeta', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if (false && is_single())  {
							?><div class="sc_layouts_title_meta"><?php
								prostart_show_post_meta(apply_filters('prostart_filter_post_meta_args', array(
									'components' => prostart_array_get_keys_by_value(prostart_get_theme_option('meta_parts')),
									'counters' => prostart_array_get_keys_by_value(prostart_get_theme_option('counters')),
									'seo' => prostart_is_on(prostart_get_theme_option('seo_snippets'))
									), 'header', 1)
								);
							?></div><?php
						}
						
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$prostart_blog_title = prostart_get_blog_title();
							$prostart_blog_title_text = $prostart_blog_title_class = $prostart_blog_title_link = $prostart_blog_title_link_text = '';
							if (is_array($prostart_blog_title)) {
								$prostart_blog_title_text = $prostart_blog_title['text'];
								$prostart_blog_title_class = !empty($prostart_blog_title['class']) ? ' '.$prostart_blog_title['class'] : '';
								$prostart_blog_title_link = !empty($prostart_blog_title['link']) ? $prostart_blog_title['link'] : '';
								$prostart_blog_title_link_text = !empty($prostart_blog_title['link_text']) ? $prostart_blog_title['link_text'] : '';
							} else
								$prostart_blog_title_text = $prostart_blog_title;
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr($prostart_blog_title_class); ?>"><?php
								$prostart_top_icon = prostart_get_category_icon();
								if (!empty($prostart_top_icon)) {
									$prostart_attr = prostart_getimagesize($prostart_top_icon);
									?><img src="<?php echo esc_url($prostart_top_icon); ?>" alt="" <?php if (!empty($prostart_attr[3])) prostart_show_layout($prostart_attr[3]);?>><?php
								}
								echo wp_kses_data($prostart_blog_title_text);
							?></h1>
							<?php
							if (!empty($prostart_blog_title_link) && !empty($prostart_blog_title_link_text)) {
								?><a href="<?php echo esc_url($prostart_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($prostart_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
                        // Breadcrumbs
                        if (prostart_exists_trx_addons()) {
                            ?><div class="sc_layouts_title_breadcrumbs"><?php
                                do_action('prostart_action_breadcrumbs');
                            ?></div><?php
                        }?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>