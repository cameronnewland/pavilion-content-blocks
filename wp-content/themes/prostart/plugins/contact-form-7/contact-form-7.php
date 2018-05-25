<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('prostart_cf7_theme_setup9')) {
	add_action( 'after_setup_theme', 'prostart_cf7_theme_setup9', 9 );
	function prostart_cf7_theme_setup9() {
		
		add_filter( 'prostart_filter_merge_styles',							'prostart_cf7_merge_styles' );

		if (is_admin()) {
			add_filter( 'prostart_filter_tgmpa_required_plugins',			'prostart_cf7_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'prostart_cf7_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('prostart_filter_tgmpa_required_plugins',	'prostart_cf7_tgmpa_required_plugins');
	function prostart_cf7_tgmpa_required_plugins($list=array()) {
		if (prostart_storage_isset('required_plugins', 'contact-form-7')) {
			// CF7 plugin
			$list[] = array(
					'name' 		=> prostart_storage_get_array('required_plugins', 'contact-form-7'),
					'slug' 		=> 'contact-form-7',
					'required' 	=> false
			);
			// CF7 extension - datepicker 
//			if (!PROSTART_THEME_FREE) {
//				$params = array(
//					'name' 		=> esc_html__('Contact Form 7 Datepicker', 'prostart'),
//					'slug' 		=> 'contact-form-7-datepicker',
//					'required' 	=> false
//				);
//				$path = prostart_get_file_dir('plugins/contact-form-7/contact-form-7-datepicker.zip');
//				if ($path != '')
//					$params['source'] = $path;
//				$list[] = $params;
//			}
		}
		return $list;
	}
}



// Check if cf7 installed and activated
if ( !function_exists( 'prostart_exists_cf7' ) ) {
	function prostart_exists_cf7() {
		return class_exists('WPCF7');
	}
}
	
// Merge custom styles
if ( !function_exists( 'prostart_cf7_merge_styles' ) ) {
	//Handler of the add_filter('prostart_filter_merge_styles', 'prostart_cf7_merge_styles');
	function prostart_cf7_merge_styles($list) {
		if (prostart_exists_cf7()) {
			$list[] = 'plugins/contact-form-7/_contact-form-7.scss';
		}
		return $list;
	}
}
?>