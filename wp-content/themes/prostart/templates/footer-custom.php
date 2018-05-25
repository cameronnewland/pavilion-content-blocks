<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0.10
 */

$prostart_footer_id = str_replace('footer-custom-', '', prostart_get_theme_option("footer_style"));
if ((int) $prostart_footer_id == 0) {
	$prostart_footer_id = prostart_get_post_id(array(
												'name' => $prostart_footer_id,
												'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
												)
											);
} else {
	$prostart_footer_id = apply_filters('prostart_filter_get_translated_layout', $prostart_footer_id);
}
$prostart_footer_meta = get_post_meta($prostart_footer_id, 'trx_addons_options', true);
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($prostart_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($prostart_footer_id))); 
						if (!empty($prostart_footer_meta['margin']) != '') 
							echo ' '.esc_attr(prostart_add_inline_css_class('margin-top: '.prostart_prepare_css_value($prostart_footer_meta['margin']).';'));
						if (!prostart_is_inherit(prostart_get_theme_option('footer_scheme')))
							echo ' scheme_' . esc_attr(prostart_get_theme_option('footer_scheme'));
						?>">
	<?php
    // Custom footer's layout
    do_action('prostart_action_show_layout', $prostart_footer_id);
	?>
</footer><!-- /.footer_wrap -->
