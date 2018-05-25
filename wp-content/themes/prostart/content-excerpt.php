<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0
 */

$prostart_post_format = get_post_format();
$prostart_post_format = empty($prostart_post_format) ? 'standard' : str_replace('post-format-', '', $prostart_post_format);
$prostart_animation = prostart_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($prostart_post_format) ); ?>
	<?php echo (!prostart_is_off($prostart_animation) ? ' data-animation="'.esc_attr(prostart_get_animation_classes($prostart_animation)).'"' : ''); ?>
	><?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

    do_action('prostart_action_before_post_meta');

    // Post meta
    $prostart_components = prostart_array_get_keys_by_value(prostart_get_theme_option('meta_parts'));
    $prostart_counters = prostart_array_get_keys_by_value(prostart_get_theme_option('counters'));
    $res = prostart_get_post_meta_array(apply_filters('prostart_filter_post_meta_args', array(
            'components' => $prostart_components,
            'counters' => $prostart_counters,
            'seo' => false,
            'echo' => false
        ), 'excerpt', 1)
    );

    // Title and post meta
    if ($prostart_post_format == 'audio') {
        ?>
        <div class="post_header entry-header">
        <?php
        do_action('prostart_action_before_post_title');

        // Post title
        the_title(sprintf('<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');

        if (!empty($res['date']) || !empty($res['author'])) { ?>
                <div class="common_block">
                <div class="post_meta_components"><?php
                // Post meta date, author  (after title)

                if (!empty($res['categories'])) {
                    prostart_show_layout($res['categories']);
                }
                if (!empty($res['date'])) {
                    prostart_show_layout($res['date']);
                }
                if (!empty($res['author'])) {
                    prostart_show_layout($res['author']);
                }
                ?></div><?php
                if (!empty($res['counters'])) { ?>
                    <div class="post_meta_counters">
                        <?php if (!empty($res['share'])) {
                            prostart_show_layout($res['share']);
                        } ?>
                        <?php if (!empty($res['views'])) {
                            prostart_show_layout($res['views']);
                        } ?>
                        <?php if (!empty($res['comments'])) {
                            prostart_show_layout($res['comments']);
                        } ?>
                        <?php if (!empty($res['likes'])) {
                            prostart_show_layout($res['likes']);
                        } ?>
                    </div>
                <?php } ?>
                </div><?php
                ?></div><?php


        }
    }

    // Featured image
	prostart_show_post_featured(array(
	        'thumb_size' => prostart_get_thumb_size( strpos(prostart_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ),
            'post_info' => (in_array($prostart_post_format, array('standard', 'image', 'video', 'gallery')) || (has_post_thumbnail())
            ? '<div class="post_info_top">'
            . '<div class="post_categories_block">'.(!empty($res['categories']) ? $res['categories'] : '').'</div>'
            . '</div>'
            : '')
    ));

	// Title and post meta
	if ((get_the_title() != '') && ($prostart_post_format !== 'audio')) {
		?>
		<div class="post_header entry-header">
			<?php
			do_action('prostart_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			?>

            <?php
            if (!has_post_thumbnail() && !in_array($prostart_post_format, array('standard', 'audio', 'quote', 'gallery', 'image', 'video', 'chat', 'link', 'aside', 'status'))) { ?>
               <div class="post_categories"><?php
                    if (!empty($res['categories'])) {
                        prostart_show_layout($res['categories']);
                    }
             ?></div><?php

            }

            if(!empty($res['date']) || !empty($res['author'])) {
                if (in_array($prostart_post_format, array('quote', 'chat', 'link', 'aside', 'status'))) {?>
                    <div class="common_block">
                        <div class="post_meta_components"><?php
                        // Post meta date, author  (after title)

                        if (!empty($res['categories'])) {
                            prostart_show_layout($res['categories']);
                        }
                        if (!empty($res['date'])) {
                            prostart_show_layout($res['date']);
                        }
                        if (!empty($res['author'])) {
                            prostart_show_layout($res['author']);
                        }
                        ?></div><?php
                        if (!empty($res['counters'])) {
                            ?>
                            <div class="post_meta_counters">
                                <?php if (!empty($res['share'])){ prostart_show_layout($res['share']); } ?>
                                <?php if (!empty($res['views'])){ prostart_show_layout($res['views']); } ?>
                                <?php if (!empty($res['comments'])){ prostart_show_layout($res['comments']);} ?>
                                <?php if (!empty($res['likes'])){ prostart_show_layout($res['likes']);} ?>
                            </div>
                        <?php } ?>
                    </div><?php
                }
                else {
                      ?><div class="post_meta_components"><?php
                            // Post meta date, author  (after title)
                            if (!empty($res['date'])) {
                                prostart_show_layout($res['date']);
                            }
                            if (!empty($res['author'])) {
                                prostart_show_layout($res['author']);
                            }
                      ?></div><?php
                }
            }
            ?>


            <?php
            // Post meta
//			$prostart_components = prostart_array_get_keys_by_value(prostart_get_theme_option('meta_parts'));
//			$prostart_counters = prostart_array_get_keys_by_value(prostart_get_theme_option('counters'));
//
//			if (!empty($prostart_components))
//				prostart_show_post_meta(apply_filters('prostart_filter_post_meta_args', array(
//					'components' => $prostart_components,
//					'counters' => $prostart_counters,
//					'seo' => false
//					), 'excerpt', 1)
//				);
			?>
		</div><!-- .post_header --><?php
	}
	
	// Post content
	?><div class="post_content entry-content"><?php
		if (prostart_get_theme_option('blog_content') == 'fullpost') {
			// Post content area
			?><div class="post_content_inner"><?php
				the_content( '' );
			?></div><?php
			// Inner pages
			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'prostart' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'prostart' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		} else {

			$prostart_show_learn_more = !in_array($prostart_post_format, array('link', 'aside', 'status', 'quote', 'audio'));

			// Post content area
			?><div class="post_content_inner"><?php
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
			?></div><?php
			// More button

            if ($prostart_show_learn_more)  {
              ?><div class="common_block">
                <div class="more_link_block"><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read More', 'prostart'); ?></a></div><?php
                     if (!empty($res['counters'])) {
                         ?>
                            <div class="post_meta_counters">
                                <?php if (!empty($res['share'])){ prostart_show_layout($res['share']); } ?>
                                <?php if (!empty($res['views'])){ prostart_show_layout($res['views']); } ?>
                                <?php if (!empty($res['comments'])){ prostart_show_layout($res['comments']); } ?>
                                <?php if (!empty($res['likes'])){ prostart_show_layout($res['likes']); } ?>
                            </div>
                    <?php } ?>
                </div>
            <?php } ?>
       <?php
		}
	?></div><!-- .entry-content -->
</article>