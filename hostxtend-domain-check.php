<?php
/**
 * Plugin Name: HostXtend Domain Manager
 * Plugin URI: https://hostxtend.org/plugins/domain-check
 * Description: Check (whois) domain names for availability. Easy integration via shortcode or widget.
 * Version: 1.10.11
 * Author: HostXtend
 * Author URI: https://hostxtend.com
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: hostxtend-domain-check
 * Domain Path: /languages
 */

if (! defined( 'ABSPATH' ) ) {
    exit();
}

if (! defined( 'HOSTXTEND_DOMAIN_CHECK_VERSION' ) ) {
    define( 'HOSTXTEND_DOMAIN_CHECK_VERSION', '1.10.11' );
}

if (! defined( 'HOSTXTEND_DOMAIN_CHECK_DATABASE_VERSION' ) ) {
    define( 'HOSTXTEND_DOMAIN_CHECK_DATABASE_VERSION', '1.3.0' );
}

// textdomain for translations
load_plugin_textdomain( 'hostxtend-domain-check', false, dirname( plugin_basename( __FILE__ ) ). '/languages/' );

if (! class_exists( 'HostXtend_Domain_Check' ) ) {
    require_once( plugin_dir_path( __FILE__ ). '/includes/class-hostxtend-domaincheck.php' );
}
if (! class_exists( 'HostXtend_Domain_Check_Options' ) ) {
    require_once( plugin_dir_path( __FILE__ ). '/includes/class-hostxtend-options.php' );
}
if (! class_exists( 'HostXtend_Domain_Check_Widget' ) ) {
    require_once( plugin_dir_path( __FILE__ ). '/includes/class-hostxtend-widget.php' );
}

// create and init domain check
$HOSTXTEND_DOMAIN_CHECK = new HostXtend_Domain_Check();
$HOSTXTEND_DOMAIN_CHECK->init();

if ( is_admin() ) {
    if (! class_exists( 'HostXtend_Domain_Check_Settings' ) ) {
        require_once( plugin_dir_path( __FILE__ ). '/includes/class-hostxtend-settings.php' );
    }

    // create and init settings
    $HOSTXTEND_DOMAIN_CHECK_settings = new HostXtend_Domain_Check_Settings();
    $HOSTXTEND_DOMAIN_CHECK_settings->init();
}

register_uninstall_hook( __FILE__, array( 'HostXtend_Domain_Check_Settings', 'uninstall' ) );