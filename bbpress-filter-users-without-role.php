<?php
/**
 * bbPress Filter Users Without Role
 *
 * Make bbPress filter for Users without forum role
 *
 * @package bbPress-filter-users-without-role
 */

/**
 * Plugin Name: bbPress Filter Users Without Role
 * Plugin URI:  https://sadler-jerome.fr
 * Description: Make bbPress filter for Users without forum role
 * Author:      Sadler Jérôme
 * Author URI:  https://sadler-jerome.fr
 * Version:     1.0.3
 * Text Domain: bbpress-sfr
 * Domain Path: /languages/
 */

defined( 'ABSPATH' )
	 or die( 'No direct load !' );

define( 'BBPRESS_SFR_DIR', plugin_dir_path( __FILE__ ) );

add_action( 'plugins_loaded', 'bbpress_sfr_load' );
function bbpress_sfr_load() {

	if ( ! class_exists( 'BBP_Admin' ) ) {
		require_once BBPRESS_SFR_DIR . 'dependency.php';
		return;
	}
	require_once BBPRESS_SFR_DIR . 'functions.php';
}
