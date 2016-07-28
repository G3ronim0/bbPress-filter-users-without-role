<?php
defined( 'ABSPATH' )
	or die( 'No direct load !' );

function bbpress_sfr_admin_notices() {
	echo '<div class="error"><p>' . esc_html__( 'bbPress is not activated or not installed ! bbPress Filter Users Without Role cannot work without it. Please install or activate it.', 'bbpress-sfr' ) . '</p></div>';
}

add_action( 'admin_init', 'bbpress_sfr_admin_init' );
function bbpress_sfr_admin_init() {

	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return;
	}

	unset( $_GET['activate'] );

	if ( current_user_can( 'activate_plugins' ) ) {

		load_plugin_textdomain( 'bbpress-sfr', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );

		add_action( 'admin_notices', 'bbpress_sfr_admin_notices' );

		deactivate_plugins( BBPRESS_SFR_DIR . 'bbpress-sortable-forum-role.php' );
	}

}
