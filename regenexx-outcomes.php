<?php
/**
 * Plugin Name:       Regenexx Outcomes
 * Description:       Regenexx Outcome Data for Regenexx Provider Sites. Use shortcode [regenexx_outcomes].
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.2.2
 * Author:            Klein New Media
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       targetdna
 *
 * @package           create-block
 */

// KNM5bad45a491b6c
define('ROP_VERSION', '0.2.2');

include_once 'partials/setup.php';

  $slm_status = set_status();

add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'targetdna_license_settings_link');

function targetdna_license_settings_link( $links ) {
  $links[] = '<a href="' .
  admin_url( 'options-general.php?page=knm-license' ) .
  '">' . __('License Key') . '</a>';
  return $links;
}


if ($slm_status != 'active' || "" == get_option('license_key') ) {

function sample_admin_notice__error() {
	$class = 'notice notice-error';
	$message = '<strong>Regenexx Outcomes Plugin:</strong> <a href="/wp-admin/options-general.php?page=knm-license">License key required.</a> Please contact <a href="email:support@kleinnewmedia.com">support@kleinnewmedia.com</a> to request a license.';

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

}


