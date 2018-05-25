<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('prostart_mailchimp_get_css')) {
	add_filter('prostart_filter_get_css', 'prostart_mailchimp_get_css', 10, 4);
	function prostart_mailchimp_get_css($css, $colors, $fonts, $scheme='') {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS
form.mc4wp-form .mc4wp-form-fields input[type="email"] {
	{$fonts['input_font-family']}
	{$fonts['input_font-size']}
	{$fonts['input_font-style']}
	{$fonts['input_line-height']}
	{$fonts['input_text-decoration']}
	{$fonts['input_text-transform']}
	{$fonts['input_letter-spacing']}
}
form.mc4wp-form .mc4wp-form-fields input[type="submit"] {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}

CSS;
		
			
			$rad = prostart_get_border_radius();
			$css['fonts'] .= <<<CSS

form.mc4wp-form .mc4wp-form-fields input[type="email"],
form.mc4wp-form .mc4wp-form-fields input[type="submit"] {
	-webkit-border-radius: {$rad};
	    -ms-border-radius: {$rad};
			border-radius: {$rad};
}

CSS;
		}

		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

form.mc4wp-form .mc4wp-alert {
	background-color: transparent;
	border-color: transparent;
	color: {$colors['text_dark']};
}
form.mc4wp-form .mc4wp-alert a {
    color: {$colors['text_dark']};
}
form.mc4wp-form .mc4wp-alert a:hover {
    color: {$colors['extra_link3']};
}
form.mc4wp-form .mc4wp_button  {
     background-color: transparent; 
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
}
form.mc4wp-form .mc4wp_button:after {
    color: {$colors['text_dark']};
}
form.mc4wp-form .mc4wp_button:hover:after {
    color: {$colors['extra_link3']};
}



CSS;
		}

		return $css;
	}
}
?>