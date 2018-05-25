<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0.10
 */

// Logo
if (prostart_is_on(prostart_get_theme_option('logo_in_footer'))) {
	$prostart_logo_image = '';
	if (prostart_is_on(prostart_get_theme_option('logo_retina_enabled')) && prostart_get_retina_multiplier() > 1)
		$prostart_logo_image = prostart_get_theme_option( 'logo_footer_retina' );
	if (empty($prostart_logo_image)) 
		$prostart_logo_image = prostart_get_theme_option( 'logo_footer' );
	$prostart_logo_text   = get_bloginfo( 'name' );
	if (!empty($prostart_logo_image) || !empty($prostart_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($prostart_logo_image)) {
					$prostart_attr = prostart_getimagesize($prostart_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($prostart_logo_image).'" class="logo_footer_image" alt=""'.(!empty($prostart_attr[3]) ? ' ' . wp_kses_data($prostart_attr[3]) : '').'></a>' ;
				} else if (!empty($prostart_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($prostart_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>