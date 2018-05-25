<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0
 */

prostart_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	prostart_show_layout(get_query_var('blog_archive_start'));

	$prostart_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$prostart_sticky_out = prostart_get_theme_option('sticky_style')=='columns' 
							&& is_array($prostart_stickies) && count($prostart_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$prostart_cat = prostart_get_theme_option('parent_cat');
	$prostart_post_type = prostart_get_theme_option('post_type');
	$prostart_taxonomy = prostart_get_post_type_taxonomy($prostart_post_type);
	$prostart_show_filters = prostart_get_theme_option('show_filters');
	$prostart_tabs = array();
	if (!prostart_is_off($prostart_show_filters)) {
		$prostart_args = array(
			'type'			=> $prostart_post_type,
			'child_of'		=> $prostart_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $prostart_taxonomy,
			'pad_counts'	=> false
		);
		$prostart_portfolio_list = get_terms($prostart_args);
		if (is_array($prostart_portfolio_list) && count($prostart_portfolio_list) > 0) {
			$prostart_tabs[$prostart_cat] = esc_html__('All', 'prostart');
			foreach ($prostart_portfolio_list as $prostart_term) {
				if (isset($prostart_term->term_id)) $prostart_tabs[$prostart_term->term_id] = $prostart_term->name;
			}
		}
	}
	if (count($prostart_tabs) > 0) {
		$prostart_portfolio_filters_ajax = true;
		$prostart_portfolio_filters_active = $prostart_cat;
		$prostart_portfolio_filters_id = 'portfolio_filters';
		?>
		<div class="portfolio_filters prostart_tabs prostart_tabs_ajax">
			<ul class="portfolio_titles prostart_tabs_titles">
				<?php
				foreach ($prostart_tabs as $prostart_id=>$prostart_title) {
					?><li><a href="<?php echo esc_url(prostart_get_hash_link(sprintf('#%s_%s_content', $prostart_portfolio_filters_id, $prostart_id))); ?>" data-tab="<?php echo esc_attr($prostart_id); ?>"><?php echo esc_html($prostart_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$prostart_ppp = prostart_get_theme_option('posts_per_page');
			if (prostart_is_inherit($prostart_ppp)) $prostart_ppp = '';
			foreach ($prostart_tabs as $prostart_id=>$prostart_title) {
				$prostart_portfolio_need_content = $prostart_id==$prostart_portfolio_filters_active || !$prostart_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $prostart_portfolio_filters_id, $prostart_id)); ?>"
					class="portfolio_content prostart_tabs_content"
					data-blog-template="<?php echo esc_attr(prostart_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(prostart_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($prostart_ppp); ?>"
					data-post-type="<?php echo esc_attr($prostart_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($prostart_taxonomy); ?>"
					data-cat="<?php echo esc_attr($prostart_id); ?>"
					data-parent-cat="<?php echo esc_attr($prostart_cat); ?>"
					data-need-content="<?php echo (false===$prostart_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($prostart_portfolio_need_content) 
						prostart_show_portfolio_posts(array(
							'cat' => $prostart_id,
							'parent_cat' => $prostart_cat,
							'taxonomy' => $prostart_taxonomy,
							'post_type' => $prostart_post_type,
							'page' => 1,
							'sticky' => $prostart_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		prostart_show_portfolio_posts(array(
			'cat' => $prostart_cat,
			'parent_cat' => $prostart_cat,
			'taxonomy' => $prostart_taxonomy,
			'post_type' => $prostart_post_type,
			'page' => 1,
			'sticky' => $prostart_sticky_out
			)
		);
	}

	prostart_show_layout(get_query_var('blog_archive_end'));

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>