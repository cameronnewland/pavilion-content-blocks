<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0.14
 */
$prostart_header_video = prostart_get_header_video();
$prostart_embed_video = '';
if (!empty($prostart_header_video) && !prostart_is_from_uploads($prostart_header_video)) {
	if (prostart_is_youtube_url($prostart_header_video) && preg_match('/[=\/]([^=\/]*)$/', $prostart_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$prostart_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($prostart_header_video) . '[/embed]' ));
			$prostart_embed_video = prostart_make_video_autoplay($prostart_embed_video);
		} else {
			$prostart_header_video = str_replace('/watch?v=', '/embed/', $prostart_header_video);
			$prostart_header_video = prostart_add_to_url($prostart_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$prostart_embed_video = '<iframe src="' . esc_url($prostart_header_video) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php prostart_show_layout($prostart_embed_video); ?></div><?php
	}
}
?>