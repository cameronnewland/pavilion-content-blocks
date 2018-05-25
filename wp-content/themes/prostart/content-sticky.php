<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0
 */

$prostart_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$prostart_post_format = get_post_format();
$prostart_post_format = empty($prostart_post_format) ? 'standard' : str_replace('post-format-', '', $prostart_post_format);
$prostart_animation = prostart_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($prostart_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($prostart_post_format) ); ?>
	<?php echo (!prostart_is_off($prostart_animation) ? ' data-animation="'.esc_attr(prostart_get_animation_classes($prostart_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	prostart_show_post_featured(array(
		'thumb_size' => prostart_get_thumb_size($prostart_columns==1 ? 'big' : ($prostart_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($prostart_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			prostart_show_post_meta(apply_filters('prostart_filter_post_meta_args', array(), 'sticky', $prostart_columns));
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>