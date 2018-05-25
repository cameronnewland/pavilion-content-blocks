<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0
 */

// Header sidebar
$prostart_header_name = prostart_get_theme_option('header_widgets');
$prostart_header_present = !prostart_is_off($prostart_header_name) && is_active_sidebar($prostart_header_name);
if ($prostart_header_present) { 
	prostart_storage_set('current_sidebar', 'header');
	$prostart_header_wide = prostart_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($prostart_header_name) ) {
		dynamic_sidebar($prostart_header_name);
	}
	$prostart_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($prostart_widgets_output)) {
		$prostart_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $prostart_widgets_output);
		$prostart_need_columns = strpos($prostart_widgets_output, 'columns_wrap')===false;
		if ($prostart_need_columns) {
			$prostart_columns = max(0, (int) prostart_get_theme_option('header_columns'));
			if ($prostart_columns == 0) $prostart_columns = min(6, max(1, substr_count($prostart_widgets_output, '<aside ')));
			if ($prostart_columns > 1)
				$prostart_widgets_output = preg_replace("/<aside([^>]*)class=\"widget/", "<aside$1class=\"column-1_".esc_attr($prostart_columns).' widget', $prostart_widgets_output);
			else
				$prostart_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($prostart_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$prostart_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($prostart_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'prostart_action_before_sidebar' );
				prostart_show_layout($prostart_widgets_output);
				do_action( 'prostart_action_after_sidebar' );
				if ($prostart_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$prostart_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>