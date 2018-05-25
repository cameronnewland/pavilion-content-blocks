<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0.22
 */

if (!defined("PROSTART_THEME_FREE")) define("PROSTART_THEME_FREE", false);
if (!defined("PROSTART_THEME_FREE_WP")) define("PROSTART_THEME_FREE_WP", false);

// Theme storage
$PROSTART_STORAGE = array(
	// Theme required plugin's slugs
	'required_plugins' => array_merge(

		// List of plugins for both - FREE and PREMIUM versions
		//-----------------------------------------------------
		array(
			// Required plugins
			// DON'T COMMENT OR REMOVE NEXT LINES!
			'trx_addons'					=> esc_html__('ThemeREX Addons', 'prostart'),
			//'prostart-addons'				=> esc_html__('ProStart Addons', 'prostart'),
			
			// Recommended (supported) plugins fot both (lite and full) versions
			// If plugin not need - comment (or remove) it
			//'elementor'						=> esc_html__('Elementor', 'prostart'),
			'contact-form-7'				=> esc_html__('Contact Form 7', 'prostart'),
//			'instagram-feed'				=> esc_html__('Instagram Feed', 'prostart'),
			'mailchimp-for-wp'				=> esc_html__('MailChimp for WP', 'prostart'),
//			'woocommerce'					=> esc_html__('WooCommerce', 'prostart')
		),

		// List of plugins for the FREE version only
		//-----------------------------------------------------
		PROSTART_THEME_FREE 
			? array(
					// Recommended (supported) plugins for the FREE (lite) version
//					'siteorigin-panels'			=> esc_html__('SiteOrigin Panels', 'prostart'),
					) 

		// List of plugins for the PREMIUM version only
		//-----------------------------------------------------
			: array(
					// Recommended (supported) plugins for the PRO (full) version
					// If plugin not need - comment (or remove) it
//					'bbpress'					=> esc_html__('BBPress and BuddyPress', 'prostart'),
//					'booked'					=> esc_html__('Booked Appointments', 'prostart'),
//					'calculated-fields-form'	=> esc_html__('Calculated Fields Form', 'prostart'),
//					'content_timeline'			=> esc_html__('Content Timeline', 'prostart'),
//					'easy-digital-downloads'	=> esc_html__('Easy Digital Downloads', 'prostart'),
//					'envato-wordpress-toolkit'	=> esc_html__('Envato WordPress Toolkit', 'prostart'),
					'essential-grid'			=> esc_html__('Essential Grid', 'prostart'),
//					'mp-timetable'				=> esc_html__('MP Time Table', 'prostart'),
					'revslider'					=> esc_html__('Revolution Slider', 'prostart'),
//					'the-events-calendar'		=> esc_html__('The Events Calendar', 'prostart'),
//					'tourmaster'				=> esc_html__('Tour Master', 'prostart'),
//					'trx_donations'				=> esc_html__('ThemeREX Donations', 'prostart'),
//					'ubermenu'					=> esc_html__('UberMenu', 'prostart'),
					'js_composer'				=> esc_html__('Visual Composer', 'prostart'),
//					'vc-extensions-bundle'		=> esc_html__('Visual Composer extensions bundle', 'prostart'),
//					'sitepress-multilingual-cms'=> esc_html__('WPML - Sitepress Multilingual CMS', 'prostart'),
					)
	),

	// Theme-specific URLs (will be escaped in place of the output)
	'theme_demo_url'	=> 'http://prostart.themerex.net',
	'theme_doc_url'		=> 'http://prostart.themerex.net/doc',
	'theme_download_url'=> 'https://themeforest.net/user/themerex/portfolio',

//	'theme_support_url'	=> 'http://axiom.ticksy.com',									// Axiom
//	'theme_support_url'	=> 'http://ancorathemes.ticksy.com',							// Ancora
	'theme_support_url'	=> 'http://themerex.ticksy.com',								// ThemeREX

//	'theme_video_url'	=> 'https://www.youtube.com/channel/UCBjqhuwKj3MfE3B6Hg2oA8Q',	// Axiom
//	'theme_video_url'	=> 'https://www.youtube.com/channel/UCdIjRh7-lPVHqTTKpaf8PLA',	// Ancora
	'theme_video_url'	=> 'https://www.youtube.com/channel/UCnFisBimrK2aIE-hnY70kCA',	// ThemeREX

	// Responsive resolutions
	// Parameters to create css media query: min, max, 
	'responsive' => array(
						// By device
						'desktop'	=> array('min' => 1680),
						'notebook'	=> array('min' => 1280, 'max' => 1679),
						'tablet'	=> array('min' =>  768, 'max' => 1279),
						'mobile'	=> array('max' =>  767),
						// By size
						'xxl'		=> array('max' => 1679),
						'xl'		=> array('max' => 1439),
						'lg'		=> array('max' => 1279),
						'md'		=> array('max' => 1023),
						'sm'		=> array('max' =>  767),
						'sm_wp'		=> array('max' =>  600),
						'xs'		=> array('max' =>  479)
						)
);

// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)

if ( !function_exists('prostart_customizer_theme_setup1') ) {
	add_action( 'after_setup_theme', 'prostart_customizer_theme_setup1', 1 );
	function prostart_customizer_theme_setup1() {

		// -----------------------------------------------------------------
		// -- ONLY FOR PROGRAMMERS, NOT FOR CUSTOMER
		// -- Internal theme settings
		// -----------------------------------------------------------------
		prostart_storage_set('settings', array(
			
			'duplicate_options'		=> 'child',		// none  - use separate options for the main and the child-theme
													// child - duplicate theme options from the main theme to the child-theme only
													// both  - sinchronize changes in the theme options between main and child themes

			'customize_refresh'		=> 'auto',		// Refresh method for preview area in the Appearance - Customize:
													// auto - refresh preview area on change each field with Theme Options
													// manual - refresh only obn press button 'Refresh' at the top of Customize frame

			'max_load_fonts'		=> 5,			// Max fonts number to load from Google fonts or from uploaded fonts

			'comment_maxlength'		=> 1000,		// Max length of the message from contact form

			'comment_after_name'	=> true,		// Place 'comment' field before the 'name' and 'email'

			'socials_type'			=> 'icons',		// Type of socials:
													// icons - use font icons to present social networks
													// images - use images from theme's folder trx_addons/css/icons.png

			'icons_type'			=> 'icons',		// Type of other icons:
													// icons - use font icons to present icons
													// images - use images from theme's folder trx_addons/css/icons.png

			'icons_selector'		=> 'internal',	// Icons selector in the shortcodes:
													// vc (default) - standard VC icons selector (very slow and don't support images)
													// internal - internal popup with plugin's or theme's icons list (fast)
			'check_min_version'		=> true,		// Check if exists a .min version of .css and .js and return path to it
													// instead the path to the original file
													// (if debug_mode is off and modification time of the original file < time of the .min file)
			'autoselect_menu'		=> false,		// Show any menu if no menu selected in the location 'main_menu'
													// (for example, the theme is just activated)
			'disable_jquery_ui'		=> false,		// Prevent loading custom jQuery UI libraries in the third-party plugins
		
			'use_mediaelements'		=> true,		// Load script "Media Elements" to play video and audio
			
			'tgmpa_upload'			=> false,		// Allow upload not pre-packaged plugins via TGMPA
			
			'allow_no_image'		=> false		// Allow use image placeholder if no image present in the blog, related posts, post navigation, etc.
		));


		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		prostart_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Roboto',
				'family' => 'sans-serif',
				'styles' => '300,300italic,400,400italic,700,700italic'		// Parameter 'style' used only for the Google fonts
				),
			// Font-face packed with theme
			array(
				'name'   => 'Montserrat',
				'family' => 'sans-serif'
				)
		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		prostart_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		// Attention! Font name in the parameter 'font-family' will be enclosed in the quotes and no spaces after comma!
		// For example:	'font-family' => '"Roboto",sans-serif'	- is correct
		// 				'font-family' => '"Roboto", sans-serif'	- is incorrect
		// 				'font-family' => 'Roboto,sans-serif'	- is incorrect

		prostart_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'prostart'),
				'description'		=> esc_html__('Font settings of the main text of the site. Attention! For correct display of the site on mobile devices, use only units "rem", "em" or "ex"', 'prostart'),
				'font-family'		=> '"Roboto",sans-serif',
				'font-size' 		=> '1rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.7657em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0.4px',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1.8em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'prostart'),
				'font-family'		=> '"Roboto",sans-serif',
				'font-size' 		=> '2.813em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.05em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '',
				'margin-top'		=> '1.8677em',
				'margin-bottom'		=> '0.7833em'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'prostart'),
				'font-family'		=> '"Roboto",sans-serif',
				'font-size' 		=> '2.500em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.0688em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '',
				'margin-top'		=> '1.3456em',
				'margin-bottom'		=> '0.4946em'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'prostart'),
				'font-family'		=> '"Roboto",sans-serif',
				'font-size' 		=> '1.688em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.1715em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.3px',
				'margin-top'		=> '1.2745em',
				'margin-bottom'		=> '0.669em'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'prostart'),
				'font-family'		=> '"Roboto",sans-serif',
				'font-size' 		=> '1.500em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2467em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0.2px',
				'margin-top'		=> '1.6923em',
				'margin-bottom'		=> '0.7655em'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'prostart'),
				'font-family'		=> '"Roboto",sans-serif',
				'font-size' 		=> '1.250em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.325em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0.1px',
				'margin-top'		=> '1.7em',
				'margin-bottom'		=> '1.3em'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'prostart'),
				'font-family'		=> '"Roboto",sans-serif',
				'font-size' 		=> '1.000em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.4265em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '2.288em',
				'margin-bottom'		=> '0.8876em'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'prostart'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'prostart'),
				'font-family'		=> '"Roboto",sans-serif',
				'font-size' 		=> '1.8em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '1px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'prostart'),
				'font-family'		=> '"Roboto",sans-serif',
				'font-size' 		=> '15px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '22px',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0.5px'
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'prostart'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'prostart'),
				'font-family'		=> 'inherit',
				'font-size' 		=> '14px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',	// Attention! Firefox don't allow line-height less then 1.5em in the select
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'prostart'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'prostart'),
				'font-family'		=> 'inherit',
				'font-size' 		=> '14px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.3em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'prostart'),
				'description'		=> esc_html__('Font settings of the main menu items', 'prostart'),
				'font-family'		=> '"Roboto",sans-serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'prostart'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'prostart'),
				'font-family'		=> '"Roboto",sans-serif',
				'font-size' 		=> '0.875em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		prostart_storage_set('scheme_color_groups', array(
			'main'	=> array(
							'title'			=> __('Main', 'prostart'),
							'description'	=> __('Colors of the main content area', 'prostart')
							),
			'alter'	=> array(
							'title'			=> __('Alter', 'prostart'),
							'description'	=> __('Colors of the alternative blocks (sidebars, etc.)', 'prostart')
							),
			'extra'	=> array(
							'title'			=> __('Extra', 'prostart'),
							'description'	=> __('Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'prostart')
							),
			'inverse' => array(
							'title'			=> __('Inverse', 'prostart'),
							'description'	=> __('Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'prostart')
							),
			'input'	=> array(
							'title'			=> __('Input', 'prostart'),
							'description'	=> __('Colors of the form fields (text field, textarea, select, etc.)', 'prostart')
							),
			)
		);
		prostart_storage_set('scheme_color_names', array(
			'bg_color'	=> array(
							'title'			=> __('Background color', 'prostart'),
							'description'	=> __('Background color of this block in the normal state', 'prostart')
							),
			'bg_hover'	=> array(
							'title'			=> __('Background hover', 'prostart'),
							'description'	=> __('Background color of this block in the hovered state', 'prostart')
							),
			'bd_color'	=> array(
							'title'			=> __('Border color', 'prostart'),
							'description'	=> __('Border color of this block in the normal state', 'prostart')
							),
			'bd_hover'	=>  array(
							'title'			=> __('Border hover', 'prostart'),
							'description'	=> __('Border color of this block in the hovered state', 'prostart')
							),
			'text'		=> array(
							'title'			=> __('Text', 'prostart'),
							'description'	=> __('Color of the plain text inside this block', 'prostart')
							),
			'text_dark'	=> array(
							'title'			=> __('Text dark', 'prostart'),
							'description'	=> __('Color of the dark text (bold, header, etc.) inside this block', 'prostart')
							),
			'text_light'=> array(
							'title'			=> __('Text light', 'prostart'),
							'description'	=> __('Color of the light text (post meta, etc.) inside this block', 'prostart')
							),
			'text_link'	=> array(
							'title'			=> __('Link', 'prostart'),
							'description'	=> __('Color of the links inside this block', 'prostart')
							),
			'text_hover'=> array(
							'title'			=> __('Link hover', 'prostart'),
							'description'	=> __('Color of the hovered state of links inside this block', 'prostart')
							),
			'text_link2'=> array(
							'title'			=> __('Link 2', 'prostart'),
							'description'	=> __('Color of the accented texts (areas) inside this block', 'prostart')
							),
			'text_hover2'=> array(
							'title'			=> __('Link 2 hover', 'prostart'),
							'description'	=> __('Color of the hovered state of accented texts (areas) inside this block', 'prostart')
							),
			'text_link3'=> array(
							'title'			=> __('Link 3', 'prostart'),
							'description'	=> __('Color of the other accented texts (buttons) inside this block', 'prostart')
							),
			'text_hover3'=> array(
							'title'			=> __('Link 3 hover', 'prostart'),
							'description'	=> __('Color of the hovered state of other accented texts (buttons) inside this block', 'prostart')
							)
			)
		);
		prostart_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'prostart'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#ffffff', //ok
					'bd_color'			=> '#edf2f7', //ok
		
					// Text and links colors
					'text'				=> '#7d8693', //ok
					'text_light'		=> '#98a0ac', //ok
					'text_dark'			=> '#1d2734', //ok
					'text_link'			=> '#6ac35e', //ok
					'text_hover'		=> '#1d2734', //ok
					'text_link2'		=> '#18a1fc', //ok
					'text_hover2'		=> '#6ac35e', //ok
					'text_link3'		=> '#7d8693', //ok  7d8693
					'text_hover3'		=> '#1d2734', //ok
		
					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#fafbfc', //ok
					'alter_bg_hover'	=> '#f5f7fa', //ok
					'alter_bd_color'	=> '#edf2f7', //ok
					'alter_bd_hover'	=> '#f5f7fa', //ok essential tabs
					'alter_text'		=> '#7d8693', //ok
					'alter_light'		=> '#98a0ac', //ok
					'alter_dark'		=> '#1d2734', //ok
					'alter_link'		=> '#6ac35e', //ok
					'alter_hover'		=> '#1d2734', //ok
					'alter_link2'		=> '#7d8693', //ok
					'alter_hover2'		=> '#1d2734', //ok
					'alter_link3'		=> '#ffffff', //ok
					'alter_hover3'		=> '#000000', //ok   //use on box-shadow
		
					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#222c39', //ok
					'extra_bg_hover'	=> '#28272e',
					'extra_bd_color'	=> '#343434', //ok
					'extra_bd_hover'	=> '#3d3d3d',
					'extra_text'		=> '#7d8693', //ok
					'extra_light'		=> '#98a0ac', //ok
					'extra_dark'		=> '#ebf1f6', //ok
					'extra_link'		=> '#18a1fc', //ok
					'extra_hover'		=> '#ebf1f6', //ok
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#18a1fc', //ok  // use on extra_title
					'extra_hover3'		=> '#291f5f', //ok  //use on box-shadow
		
					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#ffffff', //ok
					'input_bg_hover'	=> '#ffffff', //ok
					'input_bd_color'	=> '#ededed', //ok
					'input_bd_hover'	=> '#1d2734', //ok
					'input_text'		=> '#7d8693', //ok
					'input_light'		=> '#7d8693', //ok
					'input_dark'		=> '#7d8693', //ok
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#67bcc1',
					'inverse_bd_hover'	=> '#5aa4a9',
					'inverse_text'		=> '#ffffff', //ok
					'inverse_light'		=> '#333333',
					'inverse_dark'		=> '#1d1d1d', //ok
					'inverse_link'		=> '#ffffff', //ok
					'inverse_hover'		=> '#ffffff'  //ok
				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'prostart'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'			=> '#131921', //ok  #1d2734
					'bd_color'			=> '#3b4044', //ok
		
					// Text and links colors
					'text'				=> '#98a5b8', //ok
					'text_light'		=> '#ebf1f6', //ok
					'text_dark'			=> '#ffffff', //ok
					'text_link'			=> '#18a1fc', //ok
					'text_hover'		=> '#ffffff', //ok
					'text_link2'		=> '#83d179', //ok
					'text_hover2'		=> '#18a1fc', //ok
					'text_link3'		=> '#18a1fc', //ok
					'text_hover3'		=> '#83d179', //ok

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'	=> '#1d2734', //ok  #131921
					'alter_bg_hover'	=> '#161d27', //ok
					'alter_bd_color'	=> '#2b2f33', //ok
					'alter_bd_hover'	=> '#1d2734', //ok
					'alter_text'		=> '#98a5b8', //ok
					'alter_light'		=> '#ebf1f6', //ok
					'alter_dark'		=> '#ffffff', //ok
					'alter_link'		=> '#18a1fc', //ok
					'alter_hover'		=> '#ffffff', //ok
					'alter_link2'		=> '#83d179', //ok
					'alter_hover2'		=> '#18a1fc', //ok
					'alter_link3'		=> '#18a1fc', //ok
					'alter_hover3'		=> '#ffffff', //ok     //use on box-shadow

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'	=> '#222c39', //ok
					'extra_bg_hover'	=> '#f3f5f7', //ok
					'extra_bd_color'	=> '#e5e5e5', //ok
					'extra_bd_hover'	=> '#4a4a4a',
					'extra_text'		=> '#333333', //ok
					'extra_light'		=> '#98a0ac', //ok
					'extra_dark'		=> '#7d8693', //ok
					'extra_link'		=> '#18a1fc', //ok
					'extra_hover'		=> '#ebf1f6', //ok
					'extra_link2'		=> '#80d572',
					'extra_hover2'		=> '#8be77c',
					'extra_link3'		=> '#1d2734', //ok // use on extra_title
					'extra_hover3'		=> '#ffffff', //ok  //use on box-shadow

					// Input fields (form's fields and textarea)
					'input_bg_color'	=> '#131921', //ok
					'input_bg_hover'	=> '#19232f', //ok
					'input_bd_color'	=> '#a1d2fc', //ok  #39424f
					'input_bd_hover'	=> '#ffffff', //ok  #223c62
					'input_text'		=> '#ffffff', //ok
					'input_light'		=> '#ffffff', //ok
					'input_dark'		=> '#ebf1f6', //ok
					
					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color'	=> '#e36650',
					'inverse_bd_hover'	=> '#cb5b47',
					'inverse_text'		=> '#f4f4f4', //ok
					'inverse_light'		=> '#5f5f5f',
					'inverse_dark'		=> '#1d1d1d', //ok
					'inverse_link'		=> '#ffffff', //ok
					'inverse_hover'		=> '#1d2734'  //ok
				)
			)
		
		));
		
		// Simple schemes substitution
		prostart_storage_set('schemes_simple', array(
			// Main color	// Slave elements and it's darkness koef.
			'text_link'		=> array('alter_hover' => 1,	'extra_link' => 1, 'inverse_bd_color' => 0.85, 'inverse_bd_hover' => 0.7),
			'text_hover'	=> array('alter_link' => 1,		'extra_hover' => 1),
			'text_link2'	=> array('alter_hover2' => 1,	'extra_link2' => 1),
			'text_hover2'	=> array('alter_link2' => 1,	'extra_hover2' => 1),
			'text_link3'	=> array('alter_hover3' => 1,	'extra_link3' => 1),
			'text_hover3'	=> array('alter_link3' => 1,	'extra_hover3' => 1)
		));

		// Additional colors for each scheme
		// Parameters:	'color' - name of the color from the scheme that should be used as source for the transformation
		//				'alpha' - to make color transparent (0.0 - 1.0)
		//				'hue', 'saturation', 'brightness' - inc/dec value for each color's component
		prostart_storage_set('scheme_colors_add', array(
			'bg_color_0'		=> array('color' => 'bg_color',			'alpha' => 0),
			'bg_color_02'		=> array('color' => 'bg_color',			'alpha' => 0.2),
			'bg_color_07'		=> array('color' => 'bg_color',			'alpha' => 0.7),
			'bg_color_08'		=> array('color' => 'bg_color',			'alpha' => 0.8),
			'bg_color_09'		=> array('color' => 'bg_color',			'alpha' => 0.9),
			'alter_bg_color_07'	=> array('color' => 'alter_bg_color',	'alpha' => 0.7),
			'alter_bg_color_04'	=> array('color' => 'alter_bg_color',	'alpha' => 0.4),
			'alter_bg_color_02'	=> array('color' => 'alter_bg_color',	'alpha' => 0.2),
			'alter_bd_color_02'	=> array('color' => 'alter_bd_color',	'alpha' => 0.2),
			'alter_link_02'		=> array('color' => 'alter_link',		'alpha' => 0.2),
            'alter_hover3_004'	=> array('color' => 'alter_hover3',		'alpha' => 0.04), //use on box-shadow
			'alter_hover3_006'	=> array('color' => 'alter_hover3',		'alpha' => 0.06), //use on box-shadow
			'alter_hover3_008'	=> array('color' => 'alter_hover3',		'alpha' => 0.08), //use on box-shadow
			'extra_hover3_02'	=> array('color' => 'extra_hover3',		'alpha' => 0.2), //use on box-shadow
			'extra_hover3_015'	=> array('color' => 'extra_hover3',		'alpha' => 0.15), //use on box-shadow
			'alter_link_07'		=> array('color' => 'alter_link',		'alpha' => 0.7),
			'extra_bg_color_07'	=> array('color' => 'extra_bg_color',	'alpha' => 0.7),
			'extra_link_02'		=> array('color' => 'extra_link',		'alpha' => 0.2),
			'inverse_link_03'	=> array('color' => 'inverse_link',		'alpha' => 0.3),
			'extra_link_07'		=> array('color' => 'extra_link',		'alpha' => 0.7),
			'text_dark_07'		=> array('color' => 'text_dark',		'alpha' => 0.7),
			'alter_dark_03'		=> array('color' => 'alter_dark',		'alpha' => 0.3),
			'alter_dark_05'		=> array('color' => 'alter_dark',		'alpha' => 0.5),
			'text_link_02'		=> array('color' => 'text_link',		'alpha' => 0.2),
			'text_link_07'		=> array('color' => 'text_link',		'alpha' => 0.7),
			'text_link_blend'	=> array('color' => 'text_link',		'hue' => 2, 'saturation' => -5, 'brightness' => 5),
			'text_link2_blend'	=> array('color' => 'text_link2',		'hue' => 1, 'saturation' => -12, 'brightness' => 12),
			'alter_link_blend'	=> array('color' => 'alter_link',		'hue' => 2, 'saturation' => -5, 'brightness' => 5)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme specific thumb sizes
		// -----------------------------------------------------------------
		prostart_storage_set('theme_thumbs', apply_filters('prostart_filter_add_thumb_sizes', array(
			'prostart-thumb-huge'		=> array(
												'size'	=> array(1170, 658, true),
												'title' => esc_html__( 'Huge image', 'prostart' ),
												'subst'	=> 'trx_addons-thumb-huge'
												),
			'prostart-thumb-big' 		=> array(
												'size'	=> array( 760, 495, true),
												'title' => esc_html__( 'Large image', 'prostart' ),
												'subst'	=> 'trx_addons-thumb-big'
												),

			'prostart-thumb-med' 		=> array(
												'size'	=> array( 370, 208, true),
												'title' => esc_html__( 'Medium image', 'prostart' ),
												'subst'	=> 'trx_addons-thumb-medium'
												),

			'prostart-thumb-tiny' 		=> array(
												'size'	=> array(  90,  90, true),
												'title' => esc_html__( 'Small square avatar', 'prostart' ),
												'subst'	=> 'trx_addons-thumb-tiny'
												),

			'prostart-thumb-masonry-big' => array(
												'size'	=> array( 760,   0, false),		// Only downscale, not crop
												'title' => esc_html__( 'Masonry Large (scaled)', 'prostart' ),
												'subst'	=> 'trx_addons-thumb-masonry-big'
												),

			'prostart-thumb-masonry'		=> array(
												'size'	=> array( 370,   0, false),		// Only downscale, not crop
												'title' => esc_html__( 'Masonry (scaled)', 'prostart' ),
												'subst'	=> 'trx_addons-thumb-masonry'
												),

            'prostart-thumb-card' 		=> array(
                                                'size'	=> array( 370, 260, true),
                                                'title' => esc_html__( 'Card image', 'prostart' ),
                                                'subst'	=> 'trx_addons-thumb-card'
                                                )
			))
		);
	}
}




//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( !function_exists( 'prostart_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options', 'prostart_importer_set_options', 9 );
	function prostart_importer_set_options($options=array()) {
		if (is_array($options)) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url(prostart_get_protocol() . '://demofiles.themerex.net/prostart/');
			// Required plugins
			$options['required_plugins'] = array_keys(prostart_storage_get('required_plugins'));
			// Set number of thumbnails to regenerate when its imported (if demo data was zipped without cropped images)
			// Set 0 to prevent regenerate thumbnails (if demo data archive is already contain cropped images)
			$options['regenerate_thumbnails'] = 3;
			// Default demo
			$options['files']['default']['title'] = esc_html__('ProStart Demo', 'prostart');
			$options['files']['default']['domain_dev'] = '';		                                                  // Developers domain
			$options['files']['default']['domain_demo']= esc_url(prostart_get_protocol().'://prostart.themerex.net'); // Demo-site domain
			// If theme need more demo - just copy 'default' and change required parameter
			// For example:
			// 		$options['files']['dark_demo'] = $options['files']['default'];
			// 		$options['files']['dark_demo']['title'] = esc_html__('Dark Demo', 'prostart');
			// Banners
			$options['banners'] = array(
				array(
					'image' => prostart_get_file_url('theme-specific/theme-about/images/frontpage.png'),
					'title' => esc_html__('Front Page Builder', 'prostart'),
					'content' => wp_kses_post(__("Create your front page right in the WordPress Customizer. There's no need in Visual Composer, or any other builder. Simply enable/disable sections, fill them out with content, and customize to your liking.", 'prostart')),
					'link_url' => esc_url('//www.youtube.com/watch?v=VT0AUbMl_KA'),
					'link_caption' => esc_html__('Watch Video Introduction', 'prostart'),
					'duration' => 20
					),
				array(
					'image' => prostart_get_file_url('theme-specific/theme-about/images/layouts.png'),
					'title' => esc_html__('Layouts Builder', 'prostart'),
					'content' => wp_kses_post(__('Use Layouts Builder to create and customize header and footer styles for your website. With a flexible page builder interface and custom shortcodes, you can create as many header and footer layouts as you want with ease.', 'prostart')),
					'link_url' => esc_url('//www.youtube.com/watch?v=pYhdFVLd7y4'),
					'link_caption' => esc_html__('Learn More', 'prostart'),
					'duration' => 20
					),
				array(
					'image' => prostart_get_file_url('theme-specific/theme-about/images/documentation.png'),
					'title' => esc_html__('Read Full Documentation', 'prostart'),
					'content' => wp_kses_post(__('Need more details? Please check our full online documentation for detailed information on how to use ProStart.', 'prostart')),
					'link_url' => esc_url(prostart_storage_get('theme_doc_url')),
					'link_caption' => esc_html__('Online Documentation', 'prostart'),
					'duration' => 15
					),
				array(
					'image' => prostart_get_file_url('theme-specific/theme-about/images/video-tutorials.png'),
					'title' => esc_html__('Video Tutorials', 'prostart'),
					'content' => wp_kses_post(__('No time for reading documentation? Check out our video tutorials and learn how to customize ProStart in detail.', 'prostart')),
					'link_url' => esc_url(prostart_storage_get('theme_video_url')),
					'link_caption' => esc_html__('Video Tutorials', 'prostart'),
					'duration' => 15
					),
				array(
					'image' => prostart_get_file_url('theme-specific/theme-about/images/studio.png'),
					'title' => esc_html__('Mockingbird Website Customization Studio', 'prostart'),
					'content' => wp_kses_post(__("Need a website fast? Order our custom service, and we'll build a website based on this theme for a very fair price. We can also implement additional functionality such as website translation, setting up WPML, and much more.", 'prostart')),
					'link_url' => esc_url('//mockingbird.ticksy.com/'),
					'link_caption' => esc_html__('Contact Us', 'prostart'),
					'duration' => 25
					)
				);
		}
		return $options;
	}
}




// -----------------------------------------------------------------
// -- Theme options for customizer
// -----------------------------------------------------------------
if (!function_exists('prostart_create_theme_options')) {

	function prostart_create_theme_options() {

		// Message about options override. 
		// Attention! Not need esc_html() here, because this message put in wp_kses_data() below
		$msg_override = __('<b>Attention!</b> Some of these options can be overridden in the following sections (Blog, Plugins settings, etc.) or in the settings of individual pages', 'prostart');

		prostart_storage_set('options', array(
		
			// 'Logo & Site Identity'
			'title_tagline' => array(
				"title" => esc_html__('Logo & Site Identity', 'prostart'),
				"desc" => '',
				"priority" => 10,
				"type" => "section"
				),
			'logo_info' => array(
				"title" => esc_html__('Logo in the header', 'prostart'),
				"desc" => '',
				"priority" => 20,
				"type" => "info",
				),
			'logo_text' => array(
				"title" => esc_html__('Use Site Name as Logo', 'prostart'),
				"desc" => wp_kses_data( __('Use the site title and tagline as a text logo if no image is selected', 'prostart') ),
				"class" => "prostart_column-1_2 prostart_new_row",
				"priority" => 30,
				"std" => 1,
				"type" => PROSTART_THEME_FREE ? "hidden" : "checkbox"
				),
			'logo_retina_enabled' => array(
				"title" => esc_html__('Allow retina display logo', 'prostart'),
				"desc" => wp_kses_data( __('Show fields to select logo images for Retina display', 'prostart') ),
				"class" => "prostart_column-1_2",
				"priority" => 40,
				"refresh" => false,
				"std" => 0,
				"type" => PROSTART_THEME_FREE ? "hidden" : "checkbox"
				),
			'logo_zoom' => array(
				"title" => esc_html__('Logo zoom', 'prostart'),
				"desc" => wp_kses_data( __("Zoom the logo. 1 - original size. Maximum size of logo depends on the actual size of the picture", 'prostart') ),
				"std" => 1,
				"min" => 0.2,
				"max" => 2,
				"step" => 0.1,
				"refresh" => false,
				"type" => PROSTART_THEME_FREE ? "hidden" : "slider"
				),
			// Parameter 'logo' was replaced with standard WordPress 'custom_logo'
			'logo_retina' => array(
				"title" => esc_html__('Logo for Retina', 'prostart'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'prostart') ),
				"class" => "prostart_column-1_2",
				"priority" => 70,
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => PROSTART_THEME_FREE ? "hidden" : "image"
				),
			'logo_mobile_header' => array(
				"title" => esc_html__('Logo for the mobile header', 'prostart'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the mobile header (if enabled in the section "Header - Header mobile"', 'prostart') ),
				"class" => "prostart_column-1_2 prostart_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_mobile_header_retina' => array(
				"title" => esc_html__('Logo for the mobile header for Retina', 'prostart'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'prostart') ),
				"class" => "prostart_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => PROSTART_THEME_FREE ? "hidden" : "image"
				),
			'logo_mobile' => array(
				"title" => esc_html__('Logo mobile', 'prostart'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the mobile menu', 'prostart') ),
				"class" => "prostart_column-1_2 prostart_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_mobile_retina' => array(
				"title" => esc_html__('Logo mobile for Retina', 'prostart'),
				"desc" => wp_kses_data( __('Select or upload site logo used on Retina displays (if empty - use default logo from the field above)', 'prostart') ),
				"class" => "prostart_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => PROSTART_THEME_FREE ? "hidden" : "image"
				),
			'logo_side' => array(
				"title" => esc_html__('Logo side', 'prostart'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu', 'prostart') ),
				"class" => "prostart_column-1_2 prostart_new_row",
				"std" => '',
				"type" => "image"
				),
			'logo_side_retina' => array(
				"title" => esc_html__('Logo side for Retina', 'prostart'),
				"desc" => wp_kses_data( __('Select or upload site logo (with vertical orientation) to display it in the side menu on Retina displays (if empty - use default logo from the field above)', 'prostart') ),
				"class" => "prostart_column-1_2",
				"dependency" => array(
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => PROSTART_THEME_FREE ? "hidden" : "image"
				),
			
		
		
			// 'General settings'
			'general' => array(
				"title" => esc_html__('General Settings', 'prostart'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 20,
				"type" => "section",
				),

			'general_layout_info' => array(
				"title" => esc_html__('Layout', 'prostart'),
				"desc" => '',
				"type" => "info",
				),
			'body_style' => array(
				"title" => esc_html__('Body style', 'prostart'),
				"desc" => wp_kses_data( __('Select width of the body content', 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'prostart')
				),
				"refresh" => false,
				"std" => 'wide',
				"options" => prostart_get_list_body_styles(),
				"type" => "select"
				),
			'boxed_bg_image' => array(
				"title" => esc_html__('Boxed bg image', 'prostart'),
				"desc" => wp_kses_data( __('Select or upload image, used as background in the boxed body', 'prostart') ),
				"dependency" => array(
					'body_style' => array('boxed')
				),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'prostart')
				),
				"std" => '',
				"hidden" => true,
				"type" => "image"
				),
			'remove_margins' => array(
				"title" => esc_html__('Remove margins', 'prostart'),
				"desc" => wp_kses_data( __('Remove margins above and below the content area', 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Content', 'prostart')
				),
				"refresh" => false,
				"std" => 0,
				"type" => "checkbox"
				),

			'general_sidebar_info' => array(
				"title" => esc_html__('Sidebar', 'prostart'),
				"desc" => '',
				"type" => "info",
				),
			'sidebar_position' => array(
				"title" => esc_html__('Sidebar position', 'prostart'),
				"desc" => wp_kses_data( __('Select position to show sidebar', 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'prostart')
				),
				"std" => 'right',
				"options" => array(),
				"type" => "switch"
				),
			'sidebar_widgets' => array(
				"title" => esc_html__('Sidebar widgets', 'prostart'),
				"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'prostart')
				),
				"dependency" => array(
					'sidebar_position' => array('left', 'right')
				),
				"std" => 'sidebar_widgets',
				"options" => array(),
				"type" => "select"
				),
			'expand_content' => array(
				"title" => esc_html__('Expand content', 'prostart'),
				"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'prostart') ),
				"refresh" => false,
				"std" => 1,
				"type" => "checkbox"
				),


			'general_widgets_info' => array(
				"title" => esc_html__('Additional widgets', 'prostart'),
				"desc" => '',
				"type" => PROSTART_THEME_FREE ? "hidden" : "info",
				),
			'widgets_above_page' => array(
				"title" => esc_html__('Widgets at the top of the page', 'prostart'),
				"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'prostart')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => PROSTART_THEME_FREE ? "hidden" : "select"
				),
			'widgets_above_content' => array(
				"title" => esc_html__('Widgets above the content', 'prostart'),
				"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'prostart')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => PROSTART_THEME_FREE ? "hidden" : "select"
				),
			'widgets_below_content' => array(
				"title" => esc_html__('Widgets below the content', 'prostart'),
				"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'prostart')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => PROSTART_THEME_FREE ? "hidden" : "select"
				),
			'widgets_below_page' => array(
				"title" => esc_html__('Widgets at the bottom of the page', 'prostart'),
				"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Widgets', 'prostart')
				),
				"std" => 'hide',
				"options" => array(),
				"type" => PROSTART_THEME_FREE ? "hidden" : "select"
				),

			'general_effects_info' => array(
				"title" => esc_html__('Design & Effects', 'prostart'),
				"desc" => '',
				"type" => "info",
				),
			'border_radius' => array(
				"title" => esc_html__('Border radius', 'prostart'),
				"desc" => wp_kses_data( __('Specify the border radius of the form fields and buttons in pixels or other valid CSS units', 'prostart') ),
				"std" => 0,
				"type" => "hidden"
				),

			'general_misc_info' => array(
				"title" => esc_html__('Miscellaneous', 'prostart'),
				"desc" => '',
				"type" => PROSTART_THEME_FREE ? "hidden" : "info",
				),
			'seo_snippets' => array(
				"title" => esc_html__('SEO snippets', 'prostart'),
				"desc" => wp_kses_data( __('Add structured data markup to the single posts and pages', 'prostart') ),
				"std" => 0,
				"type" => PROSTART_THEME_FREE ? "hidden" : "checkbox"
				),
		
		
			// 'Header'
			'header' => array(
				"title" => esc_html__('Header', 'prostart'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 30,
				"type" => "section"
				),

			'header_style_info' => array(
				"title" => esc_html__('Header style', 'prostart'),
				"desc" => '',
				"type" => "info"
				),
			'header_type' => array(
				"title" => esc_html__('Header style', 'prostart'),
				"desc" => wp_kses_data( __('Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'prostart')
				),
				"std" => 'default',
				"options" => prostart_get_list_header_footer_types(),
				"type" => PROSTART_THEME_FREE || !prostart_exists_trx_addons() ? "hidden" : "switch"
				),
			'header_style' => array(
				"title" => esc_html__('Select custom layout', 'prostart'),
				"desc" => wp_kses_post( __("Select custom header from Layouts Builder", 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'prostart')
				),
				"dependency" => array(
					'header_type' => array('custom')
				),
				"std" => PROSTART_THEME_FREE ? 'header-custom-sow-header-default' : 'header-custom-header-default',
				"options" => array(),
				"type" => "select"
				),
			'header_position' => array(
				"title" => esc_html__('Header position', 'prostart'),
				"desc" => wp_kses_data( __('Select position to display the site header', 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'prostart')
				),
				"std" => 'default',
				"options" => array(),
				"type" => PROSTART_THEME_FREE ? "hidden" : "switch"
				),
			'header_fullheight' => array(
				"title" => esc_html__('Header fullheight', 'prostart'),
				"desc" => wp_kses_data( __("Enlarge header area to fill whole screen. Used only if header have a background image", 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'prostart')
				),
				"std" => 0,
				"type" => PROSTART_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_zoom' => array(
				"title" => esc_html__('Header zoom', 'prostart'),
				"desc" => wp_kses_data( __("Zoom the header title. 1 - original size", 'prostart') ),
				"std" => 1,
				"min" => 0.3,
				"max" => 2,
				"step" => 0.1,
				"refresh" => false,
				"type" => PROSTART_THEME_FREE ? "hidden" : "slider"
				),
			'header_wide' => array(
				"title" => esc_html__('Header fullwidth', 'prostart'),
				"desc" => wp_kses_data( __('Do you want to stretch the header widgets area to the entire window width?', 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'prostart')
				),
				"dependency" => array(
					'header_type' => array('default')
				),
				"std" => 1,
				"type" => PROSTART_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_widgets_info' => array(
				"title" => esc_html__('Header widgets', 'prostart'),
				"desc" => wp_kses_data( __('Here you can place a widget slider, advertising banners, etc.', 'prostart') ),
				"type" => "info"
				),
			'header_widgets' => array(
				"title" => esc_html__('Header widgets', 'prostart'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the header on each page', 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'prostart'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on this page', 'prostart') ),
				),
				"std" => 'hide',
				"options" => array(),
				"type" => "select"
				),
			'header_columns' => array(
				"title" => esc_html__('Header columns', 'prostart'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the Header. If 0 - autodetect by the widgets count', 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'prostart')
				),
				"dependency" => array(
					'header_type' => array('default'),
					'header_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => prostart_get_list_range(0,6),
				"type" => "select"
				),

			'menu_info' => array(
				"title" => esc_html__('Main menu', 'prostart'),
				"desc" => wp_kses_data( __('Select main menu style, position, color scheme and other parameters', 'prostart') ),
				"type" => PROSTART_THEME_FREE ? "hidden" : "info"
				),
			'menu_style' => array(
				"title" => esc_html__('Menu position', 'prostart'),
				"desc" => wp_kses_data( __('Select position of the main menu', 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'prostart')
				),
				"std" => 'top',
				"options" => array(
					'top'	=> esc_html__('Top',	'prostart'),
					'left'	=> esc_html__('Left',	'prostart'),
					'right'	=> esc_html__('Right',	'prostart')
				),
				"type" => PROSTART_THEME_FREE || !prostart_exists_trx_addons() ? "hidden" : "switch"
				),
			'menu_side_stretch' => array(
				"title" => esc_html__('Stretch sidemenu', 'prostart'),
				"desc" => wp_kses_data( __('Stretch sidemenu to window height (if menu items number >= 5)', 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'prostart')
				),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 0,
				"type" => PROSTART_THEME_FREE ? "hidden" : "checkbox"
				),
			'menu_side_icons' => array(
				"title" => esc_html__('Iconed sidemenu', 'prostart'),
				"desc" => wp_kses_data( __('Get icons from anchors and display it in the sidemenu or mark sidemenu items with simple dots', 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Header', 'prostart')
				),
				"dependency" => array(
					'menu_style' => array('left', 'right')
				),
				"std" => 1,
				"type" => PROSTART_THEME_FREE ? "hidden" : "checkbox"
				),
			'menu_mobile_fullscreen' => array(
				"title" => esc_html__('Mobile menu fullscreen', 'prostart'),
				"desc" => wp_kses_data( __('Display mobile and side menus on full screen (if checked) or slide narrow menu from the left or from the right side (if not checked)', 'prostart') ),
				"std" => 1,
				"type" => PROSTART_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_image_info' => array(
				"title" => esc_html__('Header image', 'prostart'),
				"desc" => '',
				"type" => PROSTART_THEME_FREE ? "hidden" : "info"
				),
			'header_image_override' => array(
				"title" => esc_html__('Header image override', 'prostart'),
				"desc" => wp_kses_data( __("Allow override the header image with the page's/post's/product's/etc. featured image", 'prostart') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'prostart')
				),
				"std" => 0,
				"type" => PROSTART_THEME_FREE ? "hidden" : "checkbox"
				),

			'header_mobile_info' => array(
				"title" => esc_html__('Mobile header', 'prostart'),
				"desc" => wp_kses_data( __("Configure the mobile version of the header", 'prostart') ),
				"priority" => 500,
				"dependency" => array(
					'header_type' => array('default')
				),
				"type" => PROSTART_THEME_FREE ? "hidden" : "info"
				),
			'header_mobile_enabled' => array(
				"title" => esc_html__('Enable the mobile header', 'prostart'),
				"desc" => wp_kses_data( __("Use the mobile version of the header (if checked) or relayout the current header on mobile devices", 'prostart') ),
				"dependency" => array(
					'header_type' => array('default')
				),
				"std" => 0,
				"type" => PROSTART_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_additional_info' => array(
				"title" => esc_html__('Additional info', 'prostart'),
				"desc" => wp_kses_data( __('Additional info to show at the top of the mobile header', 'prostart') ),
				"std" => '',
				"dependency" => array(
					'header_type' => array('default'),
					'header_mobile_enabled' => array(1)
				),
				"refresh" => false,
				"teeny" => false,
				"rows" => 20,
				"type" => PROSTART_THEME_FREE ? "hidden" : "text_editor"
				),
			'header_mobile_hide_info' => array(
				"title" => esc_html__('Hide additional info', 'prostart'),
				"std" => 0,
				"dependency" => array(
					'header_type' => array('default'),
					'header_mobile_enabled' => array(1)
				),
				"type" => PROSTART_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_logo' => array(
				"title" => esc_html__('Hide logo', 'prostart'),
				"std" => 0,
				"dependency" => array(
					'header_type' => array('default'),
					'header_mobile_enabled' => array(1)
				),
				"type" => PROSTART_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_login' => array(
				"title" => esc_html__('Hide login/logout', 'prostart'),
				"std" => 0,
				"dependency" => array(
					'header_type' => array('default'),
					'header_mobile_enabled' => array(1)
				),
				"type" => PROSTART_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_search' => array(
				"title" => esc_html__('Hide search', 'prostart'),
				"std" => 0,
				"dependency" => array(
					'header_type' => array('default'),
					'header_mobile_enabled' => array(1)
				),
				"type" => PROSTART_THEME_FREE ? "hidden" : "checkbox"
				),
			'header_mobile_hide_cart' => array(
				"title" => esc_html__('Hide cart', 'prostart'),
				"std" => 0,
				"dependency" => array(
					'header_type' => array('default'),
					'header_mobile_enabled' => array(1)
				),
				"type" => PROSTART_THEME_FREE ? "hidden" : "checkbox"
				),


		
			// 'Footer'
			'footer' => array(
				"title" => esc_html__('Footer', 'prostart'),
				"desc" => wp_kses_data( $msg_override ),
				"priority" => 50,
				"type" => "section"
				),
			'footer_type' => array(
				"title" => esc_html__('Footer style', 'prostart'),
				"desc" => wp_kses_data( __('Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'prostart')
				),
				"std" => 'default',
				"options" => prostart_get_list_header_footer_types(),
				"type" => PROSTART_THEME_FREE || !prostart_exists_trx_addons() ? "hidden" : "switch"
				),
			'footer_style' => array(
				"title" => esc_html__('Select custom layout', 'prostart'),
				"desc" => wp_kses_post( __("Select custom footer from Layouts Builder", 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'prostart')
				),
				"dependency" => array(
					'footer_type' => array('custom')
				),
				"std" => PROSTART_THEME_FREE ? 'footer-custom-sow-footer-default' : 'footer-custom-footer-default',
				"options" => array(),
				"type" => "select"
				),
			'footer_widgets' => array(
				"title" => esc_html__('Footer widgets', 'prostart'),
				"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'prostart')
				),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 'footer_widgets',
				"options" => array(),
				"type" => "select"
				),
			'footer_columns' => array(
				"title" => esc_html__('Footer columns', 'prostart'),
				"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'prostart')
				),
				"dependency" => array(
					'footer_type' => array('default'),
					'footer_widgets' => array('^hide')
				),
				"std" => 0,
				"options" => prostart_get_list_range(0,6),
				"type" => "select"
				),
			'footer_wide' => array(
				"title" => esc_html__('Footer fullwidth', 'prostart'),
				"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'prostart') ),
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Footer', 'prostart')
				),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_in_footer' => array(
				"title" => esc_html__('Show logo', 'prostart'),
				"desc" => wp_kses_data( __('Show logo in the footer', 'prostart') ),
				'refresh' => false,
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => "checkbox"
				),
			'logo_footer' => array(
				"title" => esc_html__('Logo for footer', 'prostart'),
				"desc" => wp_kses_data( __('Select or upload site logo to display it in the footer', 'prostart') ),
				"dependency" => array(
					'footer_type' => array('default'),
					'logo_in_footer' => array(1)
				),
				"std" => '',
				"type" => "image"
				),
			'logo_footer_retina' => array(
				"title" => esc_html__('Logo for footer (Retina)', 'prostart'),
				"desc" => wp_kses_data( __('Select or upload logo for the footer area used on Retina displays (if empty - use default logo from the field above)', 'prostart') ),
				"dependency" => array(
					'footer_type' => array('default'),
					'logo_in_footer' => array(1),
					'logo_retina_enabled' => array(1)
				),
				"std" => '',
				"type" => PROSTART_THEME_FREE ? "hidden" : "image"
				),
			'socials_in_footer' => array(
				"title" => esc_html__('Show social icons', 'prostart'),
				"desc" => wp_kses_data( __('Show social icons in the footer (under logo or footer widgets)', 'prostart') ),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"std" => 0,
				"type" => !prostart_exists_trx_addons() ? "hidden" : "checkbox"
				),
			'copyright' => array(
				"title" => esc_html__('Copyright', 'prostart'),
				"desc" => wp_kses_data( __('Copyright text in the footer. Use {Y} to insert current year and press "Enter" to create a new line', 'prostart') ),
				"translate" => true,
				"std" => esc_html__('Copyright &copy; {Y} by ThemeREX. All rights reserved.', 'prostart'),
				"dependency" => array(
					'footer_type' => array('default')
				),
				"refresh" => false,
				"type" => "textarea"
				),
			
		
		
			// 'Blog'
			'blog' => array(
				"title" => esc_html__('Blog', 'prostart'),
				"desc" => wp_kses_data( __('Options of the the blog archive', 'prostart') ),
				"priority" => 70,
				"type" => "panel",
				),
		
				// Blog - Posts page
				'blog_general' => array(
					"title" => esc_html__('Posts page', 'prostart'),
					"desc" => wp_kses_data( __('Style and components of the blog archive', 'prostart') ),
					"type" => "section",
					),
				'blog_general_info' => array(
					"title" => esc_html__('General settings', 'prostart'),
					"desc" => '',
					"type" => "info",
					),
				'blog_style' => array(
					"title" => esc_html__('Blog style', 'prostart'),
					"desc" => '',
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'prostart')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"std" => 'excerpt',
					"options" => array(),
					"type" => "select"
					),
				'first_post_large' => array(
					"title" => esc_html__('First post large', 'prostart'),
					"desc" => wp_kses_data( __('Make your first post stand out by making it bigger', 'prostart') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'prostart')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
						'blog_style' => array('classic', 'masonry')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				"blog_content" => array( 
					"title" => esc_html__('Posts content', 'prostart'),
					"desc" => wp_kses_data( __("Display either post excerpts or the full post content", 'prostart') ),
					"std" => "excerpt",
					"dependency" => array(
						'blog_style' => array('excerpt')
					),
					"options" => array(
						'excerpt'	=> esc_html__('Excerpt',	'prostart'),
						'fullpost'	=> esc_html__('Full post',	'prostart')
					),
					"type" => "switch"
					),
				'excerpt_length' => array(
					"title" => esc_html__('Excerpt length', 'prostart'),
					"desc" => wp_kses_data( __("Length (in words) to generate excerpt from the post content. Attention! If the post excerpt is explicitly specified - it appears unchanged", 'prostart') ),
					"dependency" => array(
						'blog_style' => array('excerpt'),
						'blog_content' => array('excerpt')
					),
					"std" => 60,
					"type" => "text"
					),
				'blog_columns' => array(
					"title" => esc_html__('Blog columns', 'prostart'),
					"desc" => wp_kses_data( __('How many columns should be used in the blog archive (from 2 to 4)?', 'prostart') ),
					"std" => 2,
					"options" => prostart_get_list_range(2,4),
					"type" => "hidden"
					),
				'post_type' => array(
					"title" => esc_html__('Post type', 'prostart'),
					"desc" => wp_kses_data( __('Select post type to show in the blog archive', 'prostart') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'prostart')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"linked" => 'parent_cat',
					"refresh" => false,
					"hidden" => true,
					"std" => 'post',
					"options" => array(),
					"type" => "select"
					),
				'parent_cat' => array(
					"title" => esc_html__('Category to show', 'prostart'),
					"desc" => wp_kses_data( __('Select category to show in the blog archive', 'prostart') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'prostart')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"refresh" => false,
					"hidden" => true,
					"std" => '0',
					"options" => array(),
					"type" => "select"
					),
				'posts_per_page' => array(
					"title" => esc_html__('Posts per page', 'prostart'),
					"desc" => wp_kses_data( __('How many posts will be displayed on this page', 'prostart') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'prostart')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"hidden" => true,
					"std" => '',
					"type" => "text"
					),
				"blog_pagination" => array( 
					"title" => esc_html__('Pagination style', 'prostart'),
					"desc" => wp_kses_data( __('Show Older/Newest posts or Page numbers below the posts list', 'prostart') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'prostart')
					),
					"std" => "pages",
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"options" => array(
						'pages'	=> esc_html__("Page numbers", 'prostart'),
						'links'	=> esc_html__("Older/Newest", 'prostart'),
						'more'	=> esc_html__("Load more", 'prostart'),
						'infinite' => esc_html__("Infinite scroll", 'prostart')
					),
					"type" => "select"
					),
				'show_filters' => array(
					"title" => esc_html__('Show filters', 'prostart'),
					"desc" => wp_kses_data( __('Show categories as tabs to filter posts', 'prostart') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'prostart')
					),
					"dependency" => array(
						'#page_template' => array('blog.php'),
						'blog_style' => array('portfolio', 'gallery')
					),
					"hidden" => true,
					"std" => 0,
					"type" => PROSTART_THEME_FREE ? "hidden" : "checkbox"
					),
	
				'blog_sidebar_info' => array(
					"title" => esc_html__('Sidebar', 'prostart'),
					"desc" => '',
					"type" => "info",
					),
				'sidebar_position_blog' => array(
					"title" => esc_html__('Sidebar position', 'prostart'),
					"desc" => wp_kses_data( __('Select position to show sidebar', 'prostart') ),
					"std" => 'right',
					"options" => array(),
					"type" => "switch"
					),
				'sidebar_widgets_blog' => array(
					"title" => esc_html__('Sidebar widgets', 'prostart'),
					"desc" => wp_kses_data( __('Select default widgets to show in the sidebar', 'prostart') ),
					"dependency" => array(
						'sidebar_position_blog' => array('left', 'right')
					),
					"std" => 'sidebar_widgets',
					"options" => array(),
					"type" => "select"
					),
				'expand_content_blog' => array(
					"title" => esc_html__('Expand content', 'prostart'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'prostart') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
	
	
				'blog_widgets_info' => array(
					"title" => esc_html__('Additional widgets', 'prostart'),
					"desc" => '',
					"type" => PROSTART_THEME_FREE ? "hidden" : "info",
					),
				'widgets_above_page_blog' => array(
					"title" => esc_html__('Widgets at the top of the page', 'prostart'),
					"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'prostart') ),
					"std" => 'hide',
					"options" => array(),
					"type" => PROSTART_THEME_FREE ? "hidden" : "select"
					),
				'widgets_above_content_blog' => array(
					"title" => esc_html__('Widgets above the content', 'prostart'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'prostart') ),
					"std" => 'hide',
					"options" => array(),
					"type" => PROSTART_THEME_FREE ? "hidden" : "select"
					),
				'widgets_below_content_blog' => array(
					"title" => esc_html__('Widgets below the content', 'prostart'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'prostart') ),
					"std" => 'hide',
					"options" => array(),
					"type" => PROSTART_THEME_FREE ? "hidden" : "select"
					),
				'widgets_below_page_blog' => array(
					"title" => esc_html__('Widgets at the bottom of the page', 'prostart'),
					"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'prostart') ),
					"std" => 'hide',
					"options" => array(),
					"type" => PROSTART_THEME_FREE ? "hidden" : "select"
					),

				'blog_advanced_info' => array(
					"title" => esc_html__('Advanced settings', 'prostart'),
					"desc" => '',
					"type" => "info",
					),
				'no_image' => array(
					"title" => esc_html__('Image placeholder', 'prostart'),
					"desc" => wp_kses_data( __('Select or upload an image used as placeholder for posts without a featured image', 'prostart') ),
					"std" => '',
					"type" => "image"
					),
				'time_diff_before' => array(
					"title" => esc_html__('Easy Readable Date Format', 'prostart'),
					"desc" => wp_kses_data( __("For how many days to show the easy-readable date format (e.g. '3 days ago') instead of the standard publication date", 'prostart') ),
					"std" => 5,
					"type" => "text"
					),
				'sticky_style' => array(
					"title" => esc_html__('Sticky posts style', 'prostart'),
					"desc" => wp_kses_data( __('Select style of the sticky posts output', 'prostart') ),
					"std" => 'inherit',
					"options" => array(
						'inherit' => esc_html__('Decorated posts', 'prostart'),
						'columns' => esc_html__('Mini-cards',	'prostart')
					),
					"type" => PROSTART_THEME_FREE ? "hidden" : "select"
					),
				"blog_animation" => array( 
					"title" => esc_html__('Animation for the posts', 'prostart'),
					"desc" => wp_kses_data( __('Select animation to show posts in the blog. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour (like a "Chess 2 columns")!', 'prostart') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'prostart')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"std" => "none",
					"options" => array(),
					"type" => PROSTART_THEME_FREE ? "hidden" : "select"
					),
				'meta_parts' => array(
					"title" => esc_html__('Post meta', 'prostart'),
					"desc" => wp_kses_data( __("If your blog page is created using the 'Blog archive' page template, set up the 'Post Meta' settings in the 'Theme Options' section of that page. Counters and Share Links are available only if plugin ThemeREX Addons is active", 'prostart')
                    ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'prostart')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'categories=1|date=1|counters=1|author=0|share=0|edit=1',
					"options" => array(
						'categories' => esc_html__('Categories', 'prostart'),
						'date'		 => esc_html__('Post date', 'prostart'),
						'author'	 => esc_html__('Post author', 'prostart'),
						'counters'	 => esc_html__('Views, Likes and Comments', 'prostart'),
						'share'		 => esc_html__('Share links', 'prostart'),
						'edit'		 => esc_html__('Edit link', 'prostart')
					),
					"type" => PROSTART_THEME_FREE ? "hidden" : "checklist"
				),
				'counters' => array(
					"title" => esc_html__('Views, Likes and Comments', 'prostart'),
					"desc" => wp_kses_data( __("Likes and Views are available only if ThemeREX Addons is active", 'prostart') ),
					"override" => array(
						'mode' => 'page',
						'section' => esc_html__('Content', 'prostart')
					),
					"dependency" => array(
						'#page_template' => array('blog.php')
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'views=0|likes=1|comments=1',
					"options" => array(
						'views' => esc_html__('Views', 'prostart'),
						'likes' => esc_html__('Likes', 'prostart'),
						'comments' => esc_html__('Comments', 'prostart')
					),
					"type" => PROSTART_THEME_FREE || !prostart_exists_trx_addons() ? "hidden" : "checklist"
				),

				
				// Blog - Single posts
				'blog_single' => array(
					"title" => esc_html__('Single posts', 'prostart'),
					"desc" => wp_kses_data( __('Settings of the single post', 'prostart') ),
					"type" => "section",
					),
				'hide_featured_on_single' => array(
					"title" => esc_html__('Hide featured image on the single post', 'prostart'),
					"desc" => wp_kses_data( __("Hide featured image on the single post's pages", 'prostart') ),
					"override" => array(
						'mode' => 'page,post',
						'section' => esc_html__('Content', 'prostart')
					),
					"std" => 0,
					"type" => "checkbox"
					),
				'hide_sidebar_on_single' => array(
					"title" => esc_html__('Hide sidebar on the single post', 'prostart'),
					"desc" => wp_kses_data( __("Hide sidebar on the single post's pages", 'prostart') ),
					"std" => 0,
					"type" => "checkbox"
					),
				'show_post_meta' => array(
					"title" => esc_html__('Show post meta', 'prostart'),
					"desc" => wp_kses_data( __("Display block with post's meta: date, categories, counters, etc.", 'prostart') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'meta_parts_post' => array(
					"title" => esc_html__('Post meta', 'prostart'),
					"desc" => wp_kses_data( __("Meta parts for single posts. Counters and Share Links are available only if plugin ThemeREX Addons is active", 'prostart') )
								. '<br>'
								. wp_kses_data( __("<b>Tip:</b> Drag items to change their order.", 'prostart') ),
					"dependency" => array(
						'show_post_meta' => array(1)
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'categories=1|date=1|counters=1|author=0|share=0|edit=1',
					"options" => array(
						'categories' => esc_html__('Categories', 'prostart'),
						'date'		 => esc_html__('Post date', 'prostart'),
						'author'	 => esc_html__('Post author', 'prostart'),
						'counters'	 => esc_html__('Views, Likes and Comments', 'prostart'),
						'share'		 => esc_html__('Share links', 'prostart'),
						'edit'		 => esc_html__('Edit link', 'prostart')
					),
					"type" => PROSTART_THEME_FREE ? "hidden" : "checklist"
				),
				'counters_post' => array(
					"title" => esc_html__('Views, Likes and Comments', 'prostart'),
					"desc" => wp_kses_data( __("Likes and Views are available only if plugin ThemeREX Addons is active", 'prostart') ),
					"dependency" => array(
						'show_post_meta' => array(1)
					),
					"dir" => 'vertical',
					"sortable" => true,
					"std" => 'views=0|likes=1|comments=1',
					"options" => array(
						'views' => esc_html__('Views', 'prostart'),
						'likes' => esc_html__('Likes', 'prostart'),
						'comments' => esc_html__('Comments', 'prostart')
					),
					"type" => PROSTART_THEME_FREE || !prostart_exists_trx_addons() ? "hidden" : "checklist"
				),
				'show_share_links' => array(
					"title" => esc_html__('Show share links', 'prostart'),
					"desc" => wp_kses_data( __("Display share links on the single post", 'prostart') ),
					"std" => 1,
					"type" => !prostart_exists_trx_addons() ? "hidden" : "checkbox"
					),
				'show_author_info' => array(
					"title" => esc_html__('Show author info', 'prostart'),
					"desc" => wp_kses_data( __("Display block with information about post's author", 'prostart') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'blog_single_related_info' => array(
					"title" => esc_html__('Related posts', 'prostart'),
					"desc" => '',
					"type" => "info",
					),
				'show_related_posts' => array(
					"title" => esc_html__('Show related posts', 'prostart'),
					"desc" => wp_kses_data( __("Show section 'Related posts' on the single post's pages", 'prostart') ),
					"override" => array(
						'mode' => 'page,post',
						'section' => esc_html__('Content', 'prostart')
					),
					"std" => 1,
					"type" => "checkbox"
					),
				'related_posts' => array(
					"title" => esc_html__('Related posts', 'prostart'),
					"desc" => wp_kses_data( __('How many related posts should be displayed in the single post? If 0 - no related posts are shown.', 'prostart') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => prostart_get_list_range(1,9),
					"type" => PROSTART_THEME_FREE ? "hidden" : "select"
					),
				'related_columns' => array(
					"title" => esc_html__('Related columns', 'prostart'),
					"desc" => wp_kses_data( __('How many columns should be used to output related posts in the single page (from 2 to 4)?', 'prostart') ),
					"dependency" => array(
						'show_related_posts' => array(1)
					),
					"std" => 2,
					"options" => prostart_get_list_range(1,4),
					"type" => PROSTART_THEME_FREE ? "hidden" : "switch"
					),
			'blog_end' => array(
				"type" => "panel_end",
				),
			
		
		
			// 'Colors'
			'panel_colors' => array(
				"title" => esc_html__('Colors', 'prostart'),
				"desc" => '',
				"priority" => 300,
				"type" => "section"
				),

			'color_schemes_info' => array(
				"title" => esc_html__('Color schemes', 'prostart'),
				"desc" => wp_kses_data( __('Color schemes for various parts of the site. "Inherit" means that this block is used the Site color scheme (the first parameter)', 'prostart') ),
				"type" => "info",
				),
			'color_scheme' => array(
				"title" => esc_html__('Site Color Scheme', 'prostart'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'prostart')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'header_scheme' => array(
				"title" => esc_html__('Header Color Scheme', 'prostart'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'prostart')
				),
				"std" => 'dark',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'menu_scheme' => array(
				"title" => esc_html__('Sidemenu Color Scheme', 'prostart'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'prostart')
				),
				"std" => 'inherit',
				"options" => array(),
				"refresh" => false,
				"type" => PROSTART_THEME_FREE ? "hidden" : "switch"
				),
			'sidebar_scheme' => array(
				"title" => esc_html__('Sidebar Color Scheme', 'prostart'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'prostart')
				),
				"std" => 'default',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),
			'footer_scheme' => array(
				"title" => esc_html__('Footer Color Scheme', 'prostart'),
				"desc" => '',
				"override" => array(
					'mode' => 'page,cpt_team,cpt_services,cpt_dishes,cpt_competitions,cpt_rounds,cpt_matches,cpt_cars,cpt_properties,cpt_courses,cpt_portfolio',
					'section' => esc_html__('Colors', 'prostart')
				),
				"std" => 'dark',
				"options" => array(),
				"refresh" => false,
				"type" => "switch"
				),

			'color_scheme_editor_info' => array(
				"title" => esc_html__('Color scheme editor', 'prostart'),
				"desc" => wp_kses_data(__('Select color scheme to modify. Attention! Only those sections in the site will be changed which this scheme was assigned to', 'prostart') ),
				"type" => "info",
				),
			'scheme_storage' => array(
				"title" => esc_html__('Color scheme editor', 'prostart'),
				"desc" => '',
				"std" => '$prostart_get_scheme_storage',
				"refresh" => false,
				"colorpicker" => "tiny",
				"type" => "scheme_editor"
				),


			// 'Hidden'
			'media_title' => array(
				"title" => esc_html__('Media title', 'prostart'),
				"desc" => wp_kses_data( __('Used as title for the audio and video item in this post', 'prostart') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Content', 'prostart')
				),
				"hidden" => true,
				"std" => '',
				"type" => PROSTART_THEME_FREE ? "hidden" : "text"
				),
			'media_author' => array(
				"title" => esc_html__('Media author', 'prostart'),
				"desc" => wp_kses_data( __('Used as author name for the audio and video item in this post', 'prostart') ),
				"override" => array(
					'mode' => 'post',
					'section' => esc_html__('Content', 'prostart')
				),
				"hidden" => true,
				"std" => '',
				"type" => PROSTART_THEME_FREE ? "hidden" : "text"
				),


			// Internal options.
			// Attention! Don't change any options in the section below!
			// Use huge priority to call render this elements after all options!
			'reset_options' => array(
				"title" => '',
				"desc" => '',
				"std" => '0',
				"priority" => 10000,
				"type" => "hidden",
				),

			'last_option' => array(		// Need to manually call action to include Tiny MCE scripts
				"title" => '',
				"desc" => '',
				"std" => 1,
				"type" => "hidden",
				),

		));


		// Prepare panel 'Fonts'
		$fonts = array(
		
			// 'Fonts'
			'fonts' => array(
				"title" => esc_html__('Typography', 'prostart'),
				"desc" => '',
				"priority" => 200,
				"type" => "panel"
				),

			// Fonts - Load_fonts
			'load_fonts' => array(
				"title" => esc_html__('Load fonts', 'prostart'),
				"desc" => wp_kses_data( __('Specify fonts to load when theme start. You can use them in the base theme elements: headers, text, menu, links, input fields, etc.', 'prostart') )
						. '<br>'
						. wp_kses_data( __('<b>Attention!</b> Press "Refresh" button to reload preview area after the all fonts are changed', 'prostart') ),
				"type" => "section"
				),
			'load_fonts_subset' => array(
				"title" => esc_html__('Google fonts subsets', 'prostart'),
				"desc" => wp_kses_data( __('Specify comma separated list of the subsets which will be load from Google fonts', 'prostart') )
						. '<br>'
						. wp_kses_data( __('Available subsets are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese', 'prostart') ),
				"class" => "prostart_column-1_3 prostart_new_row",
				"refresh" => false,
				"std" => '$prostart_get_load_fonts_subset',
				"type" => "text"
				)
		);

		for ($i=1; $i<=prostart_get_theme_setting('max_load_fonts'); $i++) {
			if (prostart_get_value_gp('page') != 'theme_options') {
				$fonts["load_fonts-{$i}-info"] = array(
					// Translators: Add font's number - 'Font 1', 'Font 2', etc
					"title" => esc_html(sprintf(__('Font %s', 'prostart'), $i)),
					"desc" => '',
					"type" => "info",
					);
			}
			$fonts["load_fonts-{$i}-name"] = array(
				"title" => esc_html__('Font name', 'prostart'),
				"desc" => '',
				"class" => "prostart_column-1_3 prostart_new_row",
				"refresh" => false,
				"std" => '$prostart_get_load_fonts_option',
				"type" => "text"
				);
			$fonts["load_fonts-{$i}-family"] = array(
				"title" => esc_html__('Font family', 'prostart'),
				"desc" => $i==1 
							? wp_kses_data( __('Select font family to use it if font above is not available', 'prostart') )
							: '',
				"class" => "prostart_column-1_3",
				"refresh" => false,
				"std" => '$prostart_get_load_fonts_option',
				"options" => array(
					'inherit' => esc_html__("Inherit", 'prostart'),
					'serif' => esc_html__('serif', 'prostart'),
					'sans-serif' => esc_html__('sans-serif', 'prostart'),
					'monospace' => esc_html__('monospace', 'prostart'),
					'cursive' => esc_html__('cursive', 'prostart'),
					'fantasy' => esc_html__('fantasy', 'prostart')
				),
				"type" => "select"
				);
			$fonts["load_fonts-{$i}-styles"] = array(
				"title" => esc_html__('Font styles', 'prostart'),
				"desc" => $i==1 
							? wp_kses_data( __('Font styles used only for the Google fonts. This is a comma separated list of the font weight and styles. For example: 400,400italic,700', 'prostart') )
								. '<br>'
								. wp_kses_data( __('<b>Attention!</b> Each weight and style increase download size! Specify only used weights and styles.', 'prostart') )
							: '',
				"class" => "prostart_column-1_3",
				"refresh" => false,
				"std" => '$prostart_get_load_fonts_option',
				"type" => "text"
				);
		}
		$fonts['load_fonts_end'] = array(
			"type" => "section_end"
			);

		// Fonts - H1..6, P, Info, Menu, etc.
		$theme_fonts = prostart_get_theme_fonts();
		foreach ($theme_fonts as $tag=>$v) {
			$fonts["{$tag}_section"] = array(
				"title" => !empty($v['title']) 
								? $v['title'] 
								// Translators: Add tag's name to make title 'H1 settings', 'P settings', etc.
								: esc_html(sprintf(__('%s settings', 'prostart'), $tag)),
				"desc" => !empty($v['description']) 
								? $v['description'] 
								// Translators: Add tag's name to make description
								: wp_kses_post( sprintf(__('Font settings of the "%s" tag.', 'prostart'), $tag) ),
				"type" => "section",
				);
	
			foreach ($v as $css_prop=>$css_value) {
				if (in_array($css_prop, array('title', 'description'))) continue;
				$options = '';
				$type = 'text';
				$load_order = 1;
				$title = ucfirst(str_replace('-', ' ', $css_prop));
				if ($css_prop == 'font-family') {
					$type = 'select';
					$options = array();
					$load_order = 2;		// Load this option's value after all options are loaded (use option 'load_fonts' to build fonts list)
				} else if ($css_prop == 'font-weight') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'prostart'),
						'100' => esc_html__('100 (Light)', 'prostart'), 
						'200' => esc_html__('200 (Light)', 'prostart'), 
						'300' => esc_html__('300 (Thin)',  'prostart'),
						'400' => esc_html__('400 (Normal)', 'prostart'),
						'500' => esc_html__('500 (Semibold)', 'prostart'),
						'600' => esc_html__('600 (Semibold)', 'prostart'),
						'700' => esc_html__('700 (Bold)', 'prostart'),
						'800' => esc_html__('800 (Black)', 'prostart'),
						'900' => esc_html__('900 (Black)', 'prostart')
					);
				} else if ($css_prop == 'font-style') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'prostart'),
						'normal' => esc_html__('Normal', 'prostart'), 
						'italic' => esc_html__('Italic', 'prostart')
					);
				} else if ($css_prop == 'text-decoration') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'prostart'),
						'none' => esc_html__('None', 'prostart'), 
						'underline' => esc_html__('Underline', 'prostart'),
						'overline' => esc_html__('Overline', 'prostart'),
						'line-through' => esc_html__('Line-through', 'prostart')
					);
				} else if ($css_prop == 'text-transform') {
					$type = 'select';
					$options = array(
						'inherit' => esc_html__("Inherit", 'prostart'),
						'none' => esc_html__('None', 'prostart'), 
						'uppercase' => esc_html__('Uppercase', 'prostart'),
						'lowercase' => esc_html__('Lowercase', 'prostart'),
						'capitalize' => esc_html__('Capitalize', 'prostart')
					);
				}
				$fonts["{$tag}_{$css_prop}"] = array(
					"title" => $title,
					"desc" => '',
					"class" => "prostart_column-1_5",
					"refresh" => false,
					"load_order" => $load_order,
					"std" => '$prostart_get_theme_fonts_option',
					"options" => $options,
					"type" => $type
				);
			}
			
			$fonts["{$tag}_section_end"] = array(
				"type" => "section_end"
				);
		}

		$fonts['fonts_end'] = array(
			"type" => "panel_end"
			);

		// Add fonts parameters to Theme Options
		prostart_storage_set_array_before('options', 'panel_colors', $fonts);

		// Add Header Video if WP version < 4.7
		if (!function_exists('get_header_video_url')) {
			prostart_storage_set_array_after('options', 'header_image_override', 'header_video', array(
				"title" => esc_html__('Header video', 'prostart'),
				"desc" => wp_kses_data( __("Select video to use it as background for the header", 'prostart') ),
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Header', 'prostart')
				),
				"std" => '',
				"type" => "video"
				)
			);
		}

		// Add option 'logo' if WP version < 4.5
		// or 'custom_logo' if current page is 'Theme Options'
		if (!function_exists('the_custom_logo') || (isset($_REQUEST['page']) && $_REQUEST['page']=='theme_options')) {
			prostart_storage_set_array_before('options', 'logo_retina', function_exists('the_custom_logo') ? 'custom_logo' : 'logo', array(
				"title" => esc_html__('Logo', 'prostart'),
				"desc" => wp_kses_data( __('Select or upload the site logo', 'prostart') ),
				"class" => "prostart_column-1_2 prostart_new_row",
				"priority" => 60,
				"std" => '',
				"type" => "image"
				)
			);
		}
	}
}


// Returns a list of options that can be overridden for CPT
if (!function_exists('prostart_options_get_list_cpt_options')) {
	function prostart_options_get_list_cpt_options($cpt, $title='') {
		if (empty($title)) $title = ucfirst($cpt);
		return array(
					"header_info_{$cpt}" => array(
						"title" => esc_html__('Header', 'prostart'),
						"desc" => '',
						"type" => "info",
						),
					"header_type_{$cpt}" => array(
						"title" => esc_html__('Header style', 'prostart'),
						"desc" => wp_kses_data( __('Choose whether to use the default header or header Layouts (available only if the ThemeREX Addons is activated)', 'prostart') ),
						"std" => 'inherit',
						"options" => prostart_get_list_header_footer_types(true),
						"type" => PROSTART_THEME_FREE ? "hidden" : "switch"
						),
					"header_style_{$cpt}" => array(
						"title" => esc_html__('Select custom layout', 'prostart'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select custom layout to display the site header on the %s pages', 'prostart'), $title) ),
						"dependency" => array(
							"header_type_{$cpt}" => array('custom')
						),
						"std" => 'inherit',
						"options" => array(),
						"type" => PROSTART_THEME_FREE ? "hidden" : "select"
						),
					"header_position_{$cpt}" => array(
						"title" => esc_html__('Header position', 'prostart'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select position to display the site header on the %s pages', 'prostart'), $title) ),
						"std" => 'inherit',
						"options" => array(),
						"type" => PROSTART_THEME_FREE ? "hidden" : "switch"
						),
					"header_image_override_{$cpt}" => array(
						"title" => esc_html__('Header image override', 'prostart'),
						"desc" => wp_kses_data( __("Allow override the header image with the post's featured image", 'prostart') ),
						"std" => 0,
						"type" => PROSTART_THEME_FREE ? "hidden" : "checkbox"
						),
					"header_widgets_{$cpt}" => array(
						"title" => esc_html__('Header widgets', 'prostart'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select set of widgets to show in the header on the %s pages', 'prostart'), $title) ),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
						
					"sidebar_info_{$cpt}" => array(
						"title" => esc_html__('Sidebar', 'prostart'),
						"desc" => '',
						"type" => "info",
						),
					"sidebar_position_{$cpt}" => array(
						"title" => esc_html__('Sidebar position', 'prostart'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select position to show sidebar on the %s pages', 'prostart'), $title) ),
						"std" => 'left',
						"options" => array(),
						"type" => "switch"
						),
					"sidebar_widgets_{$cpt}" => array(
						"title" => esc_html__('Sidebar widgets', 'prostart'),
						// Translators: Add CPT name to the description
						"desc" => wp_kses_data( sprintf(__('Select sidebar to show on the %s pages', 'prostart'), $title) ),
						"dependency" => array(
							"sidebar_position_{$cpt}" => array('left', 'right')
						),
						"std" => 'hide',
						"options" => array(),
						"type" => "select"
						),
					"hide_sidebar_on_single_{$cpt}" => array(
						"title" => esc_html__('Hide sidebar on the single pages', 'prostart'),
						"desc" => wp_kses_data( __("Hide sidebar on the single page", 'prostart') ),
						"std" => 0,
						"type" => "checkbox"
						),
						
					"footer_info_{$cpt}" => array(
						"title" => esc_html__('Footer', 'prostart'),
						"desc" => '',
						"type" => "info",
						),
					"footer_type_{$cpt}" => array(
						"title" => esc_html__('Footer style', 'prostart'),
						"desc" => wp_kses_data( __('Choose whether to use the default footer or footer Layouts (available only if the ThemeREX Addons is activated)', 'prostart') ),
						"std" => 'inherit',
						"options" => prostart_get_list_header_footer_types(true),
						"type" => PROSTART_THEME_FREE ? "hidden" : "switch"
						),
					"footer_style_{$cpt}" => array(
						"title" => esc_html__('Select custom layout', 'prostart'),
						"desc" => wp_kses_data( __('Select custom layout to display the site footer', 'prostart') ),
						"std" => 'inherit',
						"dependency" => array(
							"footer_type_{$cpt}" => array('custom')
						),
						"options" => array(),
						"type" => PROSTART_THEME_FREE ? "hidden" : "select"
						),
					"footer_widgets_{$cpt}" => array(
						"title" => esc_html__('Footer widgets', 'prostart'),
						"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'prostart') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default')
						),
						"std" => 'footer_widgets',
						"options" => array(),
						"type" => "select"
						),
					"footer_columns_{$cpt}" => array(
						"title" => esc_html__('Footer columns', 'prostart'),
						"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'prostart') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default'),
							"footer_widgets_{$cpt}" => array('^hide')
						),
						"std" => 0,
						"options" => prostart_get_list_range(0,6),
						"type" => "select"
						),
					"footer_wide_{$cpt}" => array(
						"title" => esc_html__('Footer fullwidth', 'prostart'),
						"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'prostart') ),
						"dependency" => array(
							"footer_type_{$cpt}" => array('default')
						),
						"std" => 0,
						"type" => "checkbox"
						),
						
					"widgets_info_{$cpt}" => array(
						"title" => esc_html__('Additional panels', 'prostart'),
						"desc" => '',
						"type" => PROSTART_THEME_FREE ? "hidden" : "info",
						),
					"widgets_above_page_{$cpt}" => array(
						"title" => esc_html__('Widgets at the top of the page', 'prostart'),
						"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'prostart') ),
						"std" => 'hide',
						"options" => array(),
						"type" => PROSTART_THEME_FREE ? "hidden" : "select"
						),
					"widgets_above_content_{$cpt}" => array(
						"title" => esc_html__('Widgets above the content', 'prostart'),
						"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'prostart') ),
						"std" => 'hide',
						"options" => array(),
						"type" => PROSTART_THEME_FREE ? "hidden" : "select"
						),
					"widgets_below_content_{$cpt}" => array(
						"title" => esc_html__('Widgets below the content', 'prostart'),
						"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'prostart') ),
						"std" => 'hide',
						"options" => array(),
						"type" => PROSTART_THEME_FREE ? "hidden" : "select"
						),
					"widgets_below_page_{$cpt}" => array(
						"title" => esc_html__('Widgets at the bottom of the page', 'prostart'),
						"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'prostart') ),
						"std" => 'hide',
						"options" => array(),
						"type" => PROSTART_THEME_FREE ? "hidden" : "select"
						)
					);
	}
}


// Return lists with choises when its need in the admin mode
if (!function_exists('prostart_options_get_list_choises')) {
	add_filter('prostart_filter_options_get_list_choises', 'prostart_options_get_list_choises', 10, 2);
	function prostart_options_get_list_choises($list, $id) {
		if (is_array($list) && count($list)==0) {
			if (strpos($id, 'header_style')===0)
				$list = prostart_get_list_header_styles(strpos($id, 'header_style_')===0);
			else if (strpos($id, 'header_position')===0)
				$list = prostart_get_list_header_positions(strpos($id, 'header_position_')===0);
			else if (strpos($id, 'header_widgets')===0)
				$list = prostart_get_list_sidebars(strpos($id, 'header_widgets_')===0, true);
			else if (strpos($id, '_scheme') > 0)
				$list = prostart_get_list_schemes($id!='color_scheme');
			else if (strpos($id, 'sidebar_widgets')===0)
				$list = prostart_get_list_sidebars(strpos($id, 'sidebar_widgets_')===0, true);
			else if (strpos($id, 'sidebar_position')===0)
				$list = prostart_get_list_sidebars_positions(strpos($id, 'sidebar_position_')===0);
			else if (strpos($id, 'widgets_above_page')===0)
				$list = prostart_get_list_sidebars(strpos($id, 'widgets_above_page_')===0, true);
			else if (strpos($id, 'widgets_above_content')===0)
				$list = prostart_get_list_sidebars(strpos($id, 'widgets_above_content_')===0, true);
			else if (strpos($id, 'widgets_below_page')===0)
				$list = prostart_get_list_sidebars(strpos($id, 'widgets_below_page_')===0, true);
			else if (strpos($id, 'widgets_below_content')===0)
				$list = prostart_get_list_sidebars(strpos($id, 'widgets_below_content_')===0, true);
			else if (strpos($id, 'footer_style')===0)
				$list = prostart_get_list_footer_styles(strpos($id, 'footer_style_')===0);
			else if (strpos($id, 'footer_widgets')===0)
				$list = prostart_get_list_sidebars(strpos($id, 'footer_widgets_')===0, true);
			else if (strpos($id, 'blog_style')===0)
				$list = prostart_get_list_blog_styles(strpos($id, 'blog_style_')===0);
			else if (strpos($id, 'post_type')===0)
				$list = prostart_get_list_posts_types();
			else if (strpos($id, 'parent_cat')===0)
				$list = prostart_array_merge(array(0 => esc_html__('- Select category -', 'prostart')), prostart_get_list_categories());
			else if (strpos($id, 'blog_animation')===0)
				$list = prostart_get_list_animations_in();
			else if ($id == 'color_scheme_editor')
				$list = prostart_get_list_schemes();
			else if (strpos($id, '_font-family') > 0)
				$list = prostart_get_list_load_fonts(true);
		}
		return $list;
	}
}
?>