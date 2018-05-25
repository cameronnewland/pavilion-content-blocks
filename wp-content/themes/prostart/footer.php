<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0
 */

						// Widgets area inside page content
						prostart_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					prostart_create_widgets_area('widgets_below_page');

					$prostart_body_style = prostart_get_theme_option('body_style');
					if ($prostart_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$prostart_footer_type = prostart_get_theme_option("footer_type");
			if ($prostart_footer_type == 'custom' && !prostart_is_layouts_available())
				$prostart_footer_type = 'default';
			get_template_part( "templates/footer-{$prostart_footer_type}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (prostart_is_on(prostart_get_theme_option('debug_mode')) && prostart_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(prostart_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>