<?php
/**
 * Theme Options and meta-boxes support
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0.29
 */


// -----------------------------------------------------------------
// -- Meta-boxes
// -----------------------------------------------------------------

if ( !function_exists('prostart_init_meta_box') ) {
	add_action( 'after_setup_theme', 'prostart_init_meta_box' );
	function prostart_init_meta_box() {
		if ( is_admin() ) {
			add_action('admin_enqueue_scripts',	'prostart_add_meta_box_scripts');
			add_action('save_post',				'prostart_save_meta_box');
			add_action('add_meta_boxes',		'prostart_add_meta_box');
		}
	}
}
	
// Load required styles and scripts for admin mode
if ( !function_exists( 'prostart_add_meta_box_scripts' ) ) {
	//Handler of the add_action("admin_enqueue_scripts", 'prostart_add_meta_box_scripts');
	function prostart_add_meta_box_scripts() {
		// If current screen is 'Edit Page' - load font icons
		$screen = function_exists('get_current_screen') ? get_current_screen() : false;
		if (is_object($screen) && prostart_allow_meta_box(!empty($screen->post_type) ? $screen->post_type : $screen->id)) {
			wp_enqueue_style( 'prostart-icons',  prostart_get_file_url('css/font-icons/css/fontello-embedded.css'), array(), null );
			wp_enqueue_script( 'jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true );
			wp_enqueue_script( 'jquery-ui-accordion', false, array('jquery', 'jquery-ui-core'), null, true );
			wp_enqueue_script( 'prostart-options', prostart_get_file_url('theme-options/theme-options.js'), array('jquery'), null, true );
			wp_localize_script( 'prostart-options', 'prostart_dependencies', prostart_get_theme_dependencies() );
		}
	}
}


// Check if meta box is allow
if (!function_exists('prostart_allow_meta_box')) {
	function prostart_allow_meta_box($post_type) {
		return apply_filters('prostart_filter_allow_meta_box', in_array($post_type, array('page', 'post')), $post_type);
	}
}

// Add meta box
if (!function_exists('prostart_add_meta_box')) {
	//Handler of the add_action('add_meta_boxes', 'prostart_add_meta_box');
	function prostart_add_meta_box() {
		global $post_type;
		if (prostart_allow_meta_box($post_type)) {
			add_meta_box(sprintf('prostart_meta_box_%s', $post_type), 
						esc_html__('Theme Options', 'prostart'),
						'prostart_show_meta_box',
						$post_type,
						$post_type=='post' ? 'side' : 'advanced',
						'default');
		}
	}
}

// Callback function to show fields in meta box
if (!function_exists('prostart_show_meta_box')) {
	function prostart_show_meta_box() {
		global $post, $post_type;
		if (prostart_allow_meta_box($post_type)) {
			// Load saved options 
			$meta = get_post_meta($post->ID, 'prostart_options', true);
			$tabs_titles = $tabs_content = array();
			global $PROSTART_STORAGE;
			// Refresh linked data if this field is controller for the another (linked) field
			// Do this before show fields to refresh data in the $PROSTART_STORAGE
			foreach ($PROSTART_STORAGE['options'] as $k=>$v) {
				if (!isset($v['override']) || strpos($v['override']['mode'], $post_type)===false) continue;
				if (!empty($v['linked'])) {
					$v['val'] = isset($meta[$k]) ? $meta[$k] : 'inherit';
					if (!empty($v['val']) && !prostart_is_inherit($v['val']))
						prostart_refresh_linked_data($v['val'], $v['linked']);
				}
			}
			// Show fields
			foreach ($PROSTART_STORAGE['options'] as $k=>$v) {
				if (!isset($v['override']) || strpos($v['override']['mode'], $post_type)===false) continue;
				if (empty($v['override']['section']))
					$v['override']['section'] = esc_html__('General', 'prostart');
				if (!isset($tabs_titles[$v['override']['section']])) {
					$tabs_titles[$v['override']['section']] = $v['override']['section'];
					$tabs_content[$v['override']['section']] = '';
				}
				$v['val'] = isset($meta[$k]) ? $meta[$k] : 'inherit';
				$tabs_content[$v['override']['section']] .= prostart_options_show_field($k, $v, $post_type);
			}
			if (count($tabs_titles) > 0) {
				?>
				<div class="prostart_options prostart_meta_box">
					<input type="hidden" name="meta_box_post_nonce" value="<?php echo esc_attr(wp_create_nonce(admin_url())); ?>" />
					<input type="hidden" name="meta_box_post_type" value="<?php echo esc_attr($post_type); ?>" />
					<div id="prostart_options_tabs" class="prostart_tabs">
						<ul><?php
							$cnt = 0;
							foreach ($tabs_titles as $k=>$v) {
								$cnt++;
								?><li><a href="#prostart_options_<?php echo esc_attr($cnt); ?>"><?php echo esc_html($v); ?></a></li><?php
							}
						?></ul>
						<?php
							$cnt = 0;
							foreach ($tabs_content as $k=>$v) {
								$cnt++;
								?>
								<div id="prostart_options_<?php echo esc_attr($cnt); ?>" class="prostart_tabs_section prostart_options_section">
									<?php prostart_show_layout($v); ?>
								</div>
								<?php
							}
						?>
					</div>
				</div>
				<?php		
			}
		}
	}
}


// Save data from meta box
if (!function_exists('prostart_save_meta_box')) {
	//Handler of the add_action('save_post', 'prostart_save_meta_box');
	function prostart_save_meta_box($post_id) {

		// verify nonce
		if ( !wp_verify_nonce( prostart_get_value_gp('meta_box_post_nonce'), admin_url() ) )
			return $post_id;

		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		$post_type = wp_kses_data(wp_unslash(isset($_POST['meta_box_post_type']) ? $_POST['meta_box_post_type'] : $_POST['post_type']));

		// check permissions
		$capability = 'page';
		$post_types = get_post_types( array( 'name' => $post_type), 'objects' );
		if (!empty($post_types) && is_array($post_types)) {
			foreach ($post_types  as $type) {
				$capability = $type->capability_type;
				break;
			}
		}
		if (!current_user_can('edit_'.($capability), $post_id)) {
			return $post_id;
		}

		// Save meta
		$meta = array();
		$options = prostart_storage_get('options');
		foreach ($options as $k=>$v) {
			// Skip not overriden options
			if (!isset($v['override']) || strpos($v['override']['mode'], $post_type)===false) continue;
			// Skip inherited options
			if (!empty($_POST['prostart_options_inherit_' . $k])) continue;
			// Get option value from POST
			$meta[$k] = isset($_POST['prostart_options_field_' . $k])
							? prostart_get_value_gp('prostart_options_field_' . $k)
							: ($v['type']=='checkbox' ? 0 : '');
		}
		update_post_meta($post_id, 'prostart_options', $meta);
		
		// Save separate meta options to search template pages
		if ($post_type=='page' && !empty($_POST['page_template']) && $_POST['page_template']=='blog.php') {
			update_post_meta($post_id, 'prostart_options_post_type', isset($meta['post_type']) ? $meta['post_type'] : 'post');
			update_post_meta($post_id, 'prostart_options_parent_cat', isset($meta['parent_cat']) ? $meta['parent_cat'] : 0);
		}
	}
}
?>