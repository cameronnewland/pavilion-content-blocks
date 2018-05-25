<?php
/**
 * The template to show mobile menu
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0
 */
?>
<div class="menu_mobile_overlay"></div>
<div class="menu_mobile menu_mobile_<?php echo esc_attr(prostart_get_theme_option('menu_mobile_fullscreen') > 0 ? 'fullscreen' : 'narrow'); ?> scheme_dark">
	<div class="menu_mobile_inner">
		<a class="menu_mobile_close icon-cancel"></a><?php

		// Logo
		set_query_var('prostart_logo_args', array('type' => 'mobile'));
		get_template_part( 'templates/header-logo' );
		set_query_var('prostart_logo_args', array());

		// Mobile menu
		$prostart_menu_mobile = prostart_get_nav_menu('menu_mobile');
		if (empty($prostart_menu_mobile)) {
			$prostart_menu_mobile = apply_filters('prostart_filter_get_mobile_menu', '');
			if (empty($prostart_menu_mobile)) $prostart_menu_mobile = prostart_get_nav_menu('menu_main');
			if (empty($prostart_menu_mobile)) $prostart_menu_mobile = prostart_get_nav_menu();
		}
		if (!empty($prostart_menu_mobile)) {
			if (!empty($prostart_menu_mobile))
				$prostart_menu_mobile = str_replace(
					array('menu_main', 'id="menu-', 'sc_layouts_menu_nav', 'sc_layouts_hide_on_mobile', 'hide_on_mobile'),
					array('menu_mobile', 'id="menu_mobile-', '', '', ''),
					$prostart_menu_mobile
					);
			if (strpos($prostart_menu_mobile, '<nav ')===false)
				$prostart_menu_mobile = sprintf('<nav class="menu_mobile_nav_area">%s</nav>', $prostart_menu_mobile);
			prostart_show_layout(apply_filters('prostart_filter_menu_mobile_layout', $prostart_menu_mobile));
		}
        // Social icons
        prostart_show_layout(prostart_get_socials_links(), '<div class="socials_mobile">', '</div>');
		?>
	</div>
</div>
