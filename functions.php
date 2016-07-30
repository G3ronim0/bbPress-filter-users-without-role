<?php
defined( 'ABSPATH' )
	or die( 'No direct load !' );

/**
	* WP Query Get users without forim roles
	*
	* @since 1.0.1
	*/
add_action( 'pre_get_users', 'bbp_user_without_role' );
function bbp_user_without_role( $query ) {
	global $pagenow, $wpdb;

	if ( ! is_admin() && 'users.php' !== $pagenow && ! isset( $_GET['orderby'] ) ) {
			return;
	}

	$filter = $query->get( 'orderby' );

	if ( 'no-forum-role' === $filter ) {
			$query->set( 'meta_key',$wpdb->prefix . 'capabilities' );
			$query->set( 'meta_query' , array(
					array(
									'key' => $wpdb->prefix . 'capabilities',
									'value' => 'bbp_',
									'compare' => 'NOT LIKE',
							),
					)
			);
			$query->set( 'orderby', 'registered' );
			$query->set( 'order', 'ASC' );
	}
}

/**
	* Add link for filter users
	*
	* @since 1.0.1
	*/
function button_no_forum_role_filter() {
	global $pagenow;

	if ( isset( $_GET['orderby'] ) && 'no-forum-role' === $_GET['orderby'] ) {
		echo '<a style="margin: 0 0 0 .5em;" href="'. esc_url( admin_url() . $pagenow ) . '" class="button">' . esc_html__( 'All users', 'bbpress-sfr' ) . '</a>';

	} else {
		echo '<a style="margin: 0 0 0 .5em;" href="'. esc_url( admin_url() . $pagenow ) . '?orderby=no-forum-role" class="button">' . esc_html__( 'Users without forum role', 'bbpress-sfr' ) . '</a>';
	}
}
add_action( 'restrict_manage_users', 'button_no_forum_role_filter', 12, 0 );
