<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0.10
 */

// Footer menu
$prostart_menu_footer = prostart_get_nav_menu(array(
											'location' => 'menu_footer',
											'class' => 'sc_layouts_menu sc_layouts_menu_default'
											));
if (!empty($prostart_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php prostart_show_layout($prostart_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>