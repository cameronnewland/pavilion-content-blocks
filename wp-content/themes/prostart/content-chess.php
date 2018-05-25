<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0
 */

$prostart_blog_style = explode('_', prostart_get_theme_option('blog_style'));
$prostart_columns = empty($prostart_blog_style[1]) ? 1 : max(1, $prostart_blog_style[1]);
$prostart_expanded = !prostart_sidebar_present() && prostart_is_on(prostart_get_theme_option('expand_content'));
$prostart_post_format = get_post_format();
$prostart_post_format = empty($prostart_post_format) ? 'standard' : str_replace('post-format-', '', $prostart_post_format);
$prostart_animation = prostart_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($prostart_columns).' post_format_'.esc_attr($prostart_post_format) ); ?>
	<?php echo (!prostart_is_off($prostart_animation) ? ' data-animation="'.esc_attr(prostart_get_animation_classes($prostart_animation)).'"' : ''); ?>>

	<?php
	// Add anchor
	if ($prostart_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'" icon="'.esc_attr(prostart_get_post_icon()).'"]');
	}

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	prostart_show_post_featured( array(
											'class' => $prostart_columns == 1 ? 'prostart-full-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => prostart_get_thumb_size(
																	strpos(prostart_get_theme_option('body_style'), 'full')!==false
																		? ( $prostart_columns > 1 ? 'huge' : 'original' )
																		: (	$prostart_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('prostart_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			
			do_action('prostart_action_before_post_meta'); 

			// Post meta
			$prostart_components = prostart_array_get_keys_by_value(prostart_get_theme_option('meta_parts'));
			$prostart_counters = prostart_array_get_keys_by_value(prostart_get_theme_option('counters'));
			$prostart_post_meta = empty($prostart_components) 
										? '' 
										: prostart_show_post_meta(apply_filters('prostart_filter_post_meta_args', array(
												'components' => $prostart_components,
												'counters' => $prostart_counters,
												'seo' => false,
												'echo' => false
												), $prostart_blog_style[0], $prostart_columns)
											);
			prostart_show_layout($prostart_post_meta);
		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$prostart_show_learn_more = !in_array($prostart_post_format, array('link', 'aside', 'status', 'quote'));
				if (has_excerpt()) {
					the_excerpt();
				} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
					the_content( '' );
				} else if (in_array($prostart_post_format, array('link', 'aside', 'status'))) {
					the_content();
				} else if ($prostart_post_format == 'quote') {
					if (($quote = prostart_get_tag(get_the_content(), '<blockquote>', '</blockquote>'))!='')
						prostart_show_layout(wpautop($quote));
					else
						the_excerpt();
				} else if (substr(get_the_content(), 0, 1)!='[') {
					the_excerpt();
				}
				?>
			</div>
			<?php
			// Post meta
			if (in_array($prostart_post_format, array('link', 'aside', 'status', 'quote'))) {
				prostart_show_layout($prostart_post_meta);
			}
			// More button
			if ( $prostart_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'prostart'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>