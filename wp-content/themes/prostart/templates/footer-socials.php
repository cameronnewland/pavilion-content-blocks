<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0.10
 */


// Socials
if ( prostart_is_on(prostart_get_theme_option('socials_in_footer')) && ($prostart_output = prostart_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php prostart_show_layout($prostart_output); ?>
		</div>
	</div>
	<?php
}
?>