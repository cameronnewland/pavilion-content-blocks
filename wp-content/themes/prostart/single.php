<?php
/**
 * The template to display single post
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0
 */

get_header();

while ( have_posts() ) { the_post();

	get_template_part( 'content', get_post_format() );


	// Previous/next post navigation.
	?><div class="nav-links-single"><?php
		the_post_navigation( array(
			'next_text' => '<span class="nav-arrow"></span>'
				. '<span class="screen-reader-text">' . esc_html__( 'Next Post', 'prostart' ) . '</span> '
				. '<h6 class="post-title">%title</h6>'
				. '<span class="post_date">%date</span>',
			'prev_text' => '<span class="nav-arrow"></span>'
				. '<span class="screen-reader-text">' . esc_html__( 'Prev Post', 'prostart' ) . '</span> '
				. '<h6 class="post-title">%title</h6>'
				. '<span class="post_date">%date</span>'
		) );
	?></div><?php

    // Author bio.
    if ( prostart_get_theme_option('show_author_info')==1 && is_single() && !is_attachment() && get_the_author_meta( 'description' ) ) {	// && is_multi_author()
        do_action('prostart_action_before_post_author');
        get_template_part( 'templates/author-bio' );
        do_action('prostart_action_after_post_author');
    }

    // Related posts
	if ((int) prostart_get_theme_option('show_related_posts') && ($prostart_related_posts = (int) prostart_get_theme_option('related_posts')) > 0) {
		prostart_show_related_posts(array('orderby' => 'rand',
										'posts_per_page' => max(1, min(9, $prostart_related_posts)),
										'columns' => max(1, min(4, prostart_get_theme_option('related_columns')))
										),
									2
									);
	}

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
}

get_footer();
?>