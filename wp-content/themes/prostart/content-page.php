<?php
/**
 * The default template to display the content of the single page
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0
 */

$prostart_seo = prostart_is_on(prostart_get_theme_option('seo_snippets'));
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post_item_single post_type_page' ); 
	if ($prostart_seo) {
		?> itemscope="itemscope" 
		   itemprop="mainEntityOfPage" 
		   itemtype="http://schema.org/<?php echo esc_attr(prostart_get_markup_schema()); ?>" 
		   itemid="<?php echo esc_url(get_the_permalink()); ?>"
		   content="<?php echo esc_attr(get_the_title()); ?>"<?php
	}
?>>

	<?php
	do_action('prostart_action_before_post_data'); 

	// Structured data snippets
	if ($prostart_seo)
		get_template_part('templates/seo');

	// Now featured image used as header's background
	// Uncomment next rows (or remove false from the condition) to show featured image for the pages
	if ( false && !prostart_sc_layouts_showed('featured') && strpos(get_the_content(), '[trx_widget_banner]')===false) {
		do_action('prostart_action_before_post_featured'); 
		prostart_show_post_featured();
		do_action('prostart_action_after_post_featured'); 
	} else if (has_post_thumbnail()) {
		?><meta itemprop="image" "http://schema.org/ImageObject" content="<?php echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>"><?php
	}

	do_action('prostart_action_before_post_content'); 
	?>

	<div class="post_content entry-content">
		<?php
			the_content( );

			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'prostart' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'prostart' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php
	do_action('prostart_action_after_post_content'); 

	do_action('prostart_action_after_post_data'); 
	?>

</article>
