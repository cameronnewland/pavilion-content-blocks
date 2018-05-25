<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0.10
 */

// Footer sidebar
$prostart_footer_name = prostart_get_theme_option('footer_widgets');
$prostart_footer_present = !prostart_is_off($prostart_footer_name) && is_active_sidebar($prostart_footer_name);
if ($prostart_footer_present) { 
	prostart_storage_set('current_sidebar', 'footer');
	$prostart_footer_wide = prostart_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($prostart_footer_name) ) {
		dynamic_sidebar($prostart_footer_name);
	}
	$prostart_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($prostart_out)) {
		$prostart_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $prostart_out);
		$prostart_need_columns = true;	//or check: strpos($prostart_out, 'columns_wrap')===false;
		if ($prostart_need_columns) {
			$prostart_columns = max(0, (int) prostart_get_theme_option('footer_columns'));
			if ($prostart_columns == 0) $prostart_columns = min(4, max(1, substr_count($prostart_out, '<aside ')));
			if ($prostart_columns > 1)
				$prostart_out = preg_replace("/<aside([^>]*)class=\"widget/", "<aside$1class=\"column-1_".esc_attr($prostart_columns).' widget', $prostart_out);
			else
				$prostart_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($prostart_footer_wide) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$prostart_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($prostart_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'prostart_action_before_sidebar' );
				prostart_show_layout($prostart_out);
				do_action( 'prostart_action_after_sidebar' );
				if ($prostart_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$prostart_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>