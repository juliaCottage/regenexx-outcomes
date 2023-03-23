<?php
/**
 * Plugin Name:       Regenexx Outcomes
 * Description:       Regenexx Outcome Data for Provider Sites
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.2
 * Author:            Klein New Media
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       targetdna
 *
 * @package           create-block
 */


define('ROP_VERSION', '0.1.2');

include_once 'partials/setup.php';

  $slm_status = set_status();

add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'targetdna_license_settings_link');

function targetdna_license_settings_link( $links ) {
  $links[] = '<a href="' .
  admin_url( 'options-general.php?page=regenexx-outcomes%2Fpartials%2Fsetup.php' ) .
  '">' . __('License Key') . '</a>';
  return $links;
}


if ($slm_status != 'active' || "" == get_option('license_key') ) {

function sample_admin_notice__error() {
	$class = 'notice notice-error';
	$message = '<strong>Regenexx Outcomes Plugin:</strong> License key required. Please contact <a href="email:support@kleinnewmedia.com">support@kleinnewmedia.com</a> to request a license.';

	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message  );
}
add_action( 'admin_notices', 'sample_admin_notice__error' );

  return;
} else {

// Autoload files in /inc/ directory
  foreach (glob(__DIR__ . '/inc/*.php') as $my_theme_filename) {

    // Exclude files whose names contain -sample
    if (!strpos($my_theme_filename, '-sample')) {
      include_once $my_theme_filename;
    }
  }





 function regenexx_outcomes_register_block() {
      register_block_type_from_metadata( __DIR__ );

  }
  add_action( 'init', 'regenexx_outcomes_register_block' );


 /**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_boilerplate_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'create_block_boilerplate_block_init' );


function blockgallery_frontend_scripts() {
	if ( has_block( 'create-block/boilerplate' ) ) {
  $version = date("d.m.y");

		wp_enqueue_script(
			'regenexx-outcomes',
      'https://targetdna.com/wp-content/targetdna-assets/outcomes/js/targetdna-outcomes-dist.js?layout=app',
			array( 'jquery' ),
			$version,
      true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'blockgallery_frontend_scripts' );

}


