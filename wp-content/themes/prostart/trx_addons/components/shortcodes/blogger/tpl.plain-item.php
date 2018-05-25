<?php
/**
 * The style "plain" of the Blogger
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.4.3
 */

$args = get_query_var('trx_addons_args_sc_blogger');

if ($args['slider']) {
	?><div class="slider-slide swiper-slide"><?php
} else if ($args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?>"><?php
}

$post_format = get_post_format();
$post_format = empty($post_format) ? 'standard' : str_replace('post-format-', '', $post_format);
$post_link = get_permalink();
$post_title = get_the_title();

?><div <?php post_class( 'sc_blogger_item post_format_'.esc_attr($post_format) ); ?>><?php

	// Post content
	?><div class="sc_blogger_item_content entry-content"><?php

		// Post title
		the_title( sprintf( '<h5 class="sc_blogger_item_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );

        // Post content
        if (!isset($args['hide_excerpt']) || $args['hide_excerpt']==0) {
            ?><div class="sc_blogger_item_excerpt">
            <div class="sc_blogger_item_excerpt_text">
                <?php
                $show_more = !in_array($post_format, array('link', 'aside', 'status', 'quote'));
                if (has_excerpt()) {
                    the_excerpt();
                } else if (strpos(get_the_content('!--more'), '!--more')!==false) {
                    the_content( '' );
                } else if (!$show_more) {
                    the_content();
                } else {
                    echo mb_substr( get_the_excerpt(), 0, 60 ).' ...';
                }
                ?>
            </div>
            <?php

        // Post meta
        trx_addons_sc_show_post_meta('sc_blogger', apply_filters('trx_addons_filter_show_post_meta', array(
                'components' => 'date,counters',
                'counters' => 'comments,likes'
            ), 'sc_blogger_plain', $args['columns'])
        );
        ?></div><!-- .sc_blogger_item_excerpt --><?php

        }


	?></div><!-- .entry-content --><?php
	
?></div><!-- .sc_blogger_item --><?php

if ($args['slider'] || $args['columns'] > 1) {
	?></div><?php
}
?>