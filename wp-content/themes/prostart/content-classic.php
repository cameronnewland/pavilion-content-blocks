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
$prostart_columns = empty($prostart_blog_style[1]) ? 2 : max(2, $prostart_blog_style[1]);
$prostart_expanded = !prostart_sidebar_present() && prostart_is_on(prostart_get_theme_option('expand_content'));
$prostart_post_format = get_post_format();
$prostart_post_format = empty($prostart_post_format) ? 'standard' : str_replace('post-format-', '', $prostart_post_format);
$prostart_animation = prostart_get_theme_option('blog_animation');
$prostart_components = prostart_array_get_keys_by_value(prostart_get_theme_option('meta_parts'));
$prostart_counters = prostart_array_get_keys_by_value(prostart_get_theme_option('counters'));

?><div class="<?php echo $prostart_blog_style[0] == 'classic' ? 'column' : 'masonry_item masonry_item'; ?>-1_<?php echo esc_attr($prostart_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_format_'.esc_attr($prostart_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($prostart_columns)
					. ' post_layout_'.esc_attr($prostart_blog_style[0]) 
					. ' post_layout_'.esc_attr($prostart_blog_style[0]).'_'.esc_attr($prostart_columns)
					); ?>
	<?php echo (!prostart_is_off($prostart_animation) ? ' data-animation="'.esc_attr(prostart_get_animation_classes($prostart_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	prostart_show_post_featured( array( 'thumb_size' => prostart_get_thumb_size($prostart_blog_style[0] == 'classic'
													? (strpos(prostart_get_theme_option('body_style'), 'full')!==false 
															? ( $prostart_columns > 2 ? 'big' : 'huge' )
															: (	$prostart_columns > 2
																? ($prostart_expanded ? 'med' : 'small')
																: ($prostart_expanded ? 'big' : 'med')
																)
														)
													: (strpos(prostart_get_theme_option('body_style'), 'full')!==false 
															? ( $prostart_columns > 2 ? 'masonry-big' : 'full' )
															: (	$prostart_columns <= 2 && $prostart_expanded ? 'masonry-big' : 'masonry')
														)
								) ) );

	if ( !in_array($prostart_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('prostart_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

			do_action('prostart_action_before_post_meta'); 

			// Post meta
			if (!empty($prostart_components))
				prostart_show_post_meta(apply_filters('prostart_filter_post_meta_args', array(
					'components' => $prostart_components,
					'counters' => $prostart_counters,
					'seo' => false
					), $prostart_blog_style[0], $prostart_columns)
				);

			do_action('prostart_action_after_post_meta'); 
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$prostart_show_learn_more = false; //!in_array($prostart_post_format, array('link', 'aside', 'status', 'quote'));
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
			if (!empty($prostart_components))
				prostart_show_post_meta(apply_filters('prostart_filter_post_meta_args', array(
					'components' => $prostart_components,
					'counters' => $prostart_counters
					), $prostart_blog_style[0], $prostart_columns)
				);
		}
		// More button
		if ( $prostart_show_learn_more ) {
			?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'prostart'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>