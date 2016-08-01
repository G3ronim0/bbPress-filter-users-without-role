<?php
defined( 'ABSPATH' )
	or die( 'No direct load !' );

/**
	* Display dependency notice
	*
	* @since 1.0.0
	*/
function bbpress_sfr_admin_notices() {
	echo '<div class="error"><p>' . esc_html__( 'bbPress is not activated or not installed ! bbPress Filter Users Without Role cannot work without it. Please install or activate it.', 'bbpress-sfr' ) . '</p></div>';
}

/**
	* Check bbPress dependency
	*
	* @since 1.0.0
	*/
add_action( 'admin_init', 'bbpress_sfr_admin_init' );
function bbpress_sfr_admin_init() {

	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return;
	}

	unset( $_GET['activate'] );

	if ( current_user_can( 'activate_plugins' ) ) {

		add_action( 'admin_notices', 'bbpress_sfr_admin_notices' );

		deactivate_plugins( BBPRESS_SFR_DIR . 'bbpress-filter-users-without-role.php' );
	}

}
