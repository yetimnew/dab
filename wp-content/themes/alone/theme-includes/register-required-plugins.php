<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

if ( ! class_exists( 'TGM_Plugin_Activation' ) ) {
	/**
	 * Include the TGM_Plugin_Activation class.
	 */
	require_once get_template_directory() . '/includes/class-tgm-plugin-activation.php';
}

add_action( 'tgmpa_register', 'fw_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function fw_register_required_plugins() {

	$plugins = array(
		array(
			'name'     => esc_html__('Unyson', 'alone'),
			'slug'     => 'unyson',
			'required' => true,
		),
		array(
			'name'   => 'Visual Composer',
			'slug'   => 'js_composer',
			'source' => 'http://download.bearsthemes.com/js_composer.zip',
			'required' => true,
		),
		array(
			'name'     => esc_html__('Revolution Slider', 'alone'),
			'slug'     => 'revslider',
			'source'   => esc_url('http://download.bearsthemes.com/revslider.zip'),
			'required' => true,
		),
	);

	$config = array(
		'domain'       => 'alone',
		'dismissable'  => true,
		'is_automatic' => true
	);
	tgmpa( $plugins, $config );

}
