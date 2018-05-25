<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0
 */

$prostart_args = get_query_var('prostart_logo_args');

// Site logo
$prostart_logo_type   = isset($prostart_args['type']) ? $prostart_args['type'] : '';
$prostart_logo_image  = prostart_get_logo_image($prostart_logo_type);
$prostart_logo_text   = prostart_is_on(prostart_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$prostart_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($prostart_logo_image) || !empty($prostart_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($prostart_logo_image)) {
			if (empty($prostart_logo_type) && function_exists('the_custom_logo') && (int) $prostart_logo_image > 0) {
				the_custom_logo();
			} else {
				$prostart_attr = prostart_getimagesize($prostart_logo_image);
				echo '<img src="'.esc_url($prostart_logo_image).'" alt=""'.(!empty($prostart_attr[3]) ? ' '.wp_kses_data($prostart_attr[3]) : '').'>';
			}
		} else {
			prostart_show_layout(prostart_prepare_macros($prostart_logo_text), '<span class="logo_text">', '</span>');
			prostart_show_layout(prostart_prepare_macros($prostart_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>