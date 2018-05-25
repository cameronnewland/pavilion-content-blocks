<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0.1
 */
 
$prostart_theme_obj = wp_get_theme();
?>
<div class="update-nag" id="prostart_admin_notice">
	<h3 class="prostart_notice_title"><?php
		// Translators: Add theme name and version to the 'Welcome' message
		echo esc_html(sprintf(__('Welcome to %1$s v.%2$s', 'prostart'),
				$prostart_theme_obj->name . (PROSTART_THEME_FREE ? ' ' . __('Free', 'prostart') : ''),
				$prostart_theme_obj->version
				));
	?></h3>
	<?php
	if (!prostart_exists_trx_addons()) {
		?><p><?php echo wp_kses_data(__('<b>Attention!</b> Plugin "ThemeREX Addons is required! Please, install and activate it!', 'prostart')); ?></p><?php
	}
	?><p>
		<a href="<?php echo esc_url(admin_url().'themes.php?page=prostart_about'); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> <?php
			// Translators: Add theme name
			echo esc_html(sprintf(__('About %s', 'prostart'), $prostart_theme_obj->name));
		?></a>
		<?php
		if (prostart_get_value_gp('page')!='tgmpa-install-plugins') {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-plugins"></i> <?php esc_html_e('Install plugins', 'prostart'); ?></a>
			<?php
		}
		if (function_exists('prostart_exists_trx_addons') && prostart_exists_trx_addons() && class_exists('trx_addons_demo_data_importer')) {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=trx_importer'); ?>" class="button button-primary"><i class="dashicons dashicons-download"></i> <?php esc_html_e('One Click Demo Data', 'prostart'); ?></a>
			<?php
		}
		?>
        <a href="<?php echo esc_url(admin_url().'customize.php'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Customizer', 'prostart'); ?></a>
		<span> <?php esc_html_e('or', 'prostart'); ?> </span>
        <a href="<?php echo esc_url(admin_url().'themes.php?page=theme_options'); ?>" class="button button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Options', 'prostart'); ?></a>
        <a href="#" class="button prostart_hide_notice"><i class="dashicons dashicons-dismiss"></i> <?php esc_html_e('Hide Notice', 'prostart'); ?></a>
	</p>
</div>