<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0
 */

if (prostart_sidebar_present()) {
	ob_start();
	$prostart_sidebar_name = prostart_get_theme_option('sidebar_widgets');
	prostart_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($prostart_sidebar_name) ) {
		dynamic_sidebar($prostart_sidebar_name);
	}
	$prostart_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($prostart_out)) {
		$prostart_sidebar_position = prostart_get_theme_option('sidebar_position');
		?>
		<div class="sidebar <?php echo esc_attr($prostart_sidebar_position); ?> widget_area<?php if (!prostart_is_inherit(prostart_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(prostart_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'prostart_action_before_sidebar' );
				prostart_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $prostart_out));
				do_action( 'prostart_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>