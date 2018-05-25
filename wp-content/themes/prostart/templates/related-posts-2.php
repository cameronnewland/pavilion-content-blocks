<?php
/**
 * The template 'Style 2' to displaying related posts
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0
 */

$prostart_link = get_permalink();
$prostart_post_format = get_post_format();
$prostart_post_format = empty($prostart_post_format) ? 'standard' : str_replace('post-format-', '', $prostart_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_2 post_format_'.esc_attr($prostart_post_format) ); ?>><?php
	prostart_show_post_featured(array(
		'thumb_size' => apply_filters('prostart_filter_related_thumb_size', prostart_get_thumb_size( (int) prostart_get_theme_option('related_posts') == 1 ? 'huge' : 'card' )),
		'show_no_image' => prostart_get_theme_setting('allow_no_image'),
		'singular' => false
		)
	);
	?><div class="post_header entry-header"><?php
		if ( in_array(get_post_type(), array( 'post', 'attachment' ) ) ) {
            prostart_show_post_meta( array(
                    'components' => 'date,counters',
                    'counters' => 'comments,likes',	//comments,views,likes
                    'seo' => false
                )
            );
		}
		?>
		<h6 class="post_title entry-title"><a href="<?php echo esc_url($prostart_link); ?>"><?php the_title(); ?></a></h6>
	</div>
</div>