<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap<?php
				if (!prostart_is_inherit(prostart_get_theme_option('copyright_scheme')))
					echo ' scheme_' . esc_attr(prostart_get_theme_option('copyright_scheme'));
 				?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$prostart_copyright = prostart_prepare_macros(prostart_get_theme_option('copyright'));
				if (!empty($prostart_copyright)) {
					// Replace {date_format} on the current date in the specified format
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $prostart_copyright, $prostart_matches)) {
						$prostart_copyright = str_replace($prostart_matches[1], date_i18n(str_replace(array('{', '}'), '', $prostart_matches[1])), $prostart_copyright);
					}
					// Display copyright
					echo wp_kses_data(nl2br($prostart_copyright));
				}
			?></div>
		</div>
	</div>
</div>
