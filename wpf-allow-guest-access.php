<?php

/*
Plugin Name: WP Fusion - Allow Guest Access
Description: Adds an option to WP Fusion's meta boxes to allow guest access to protected posts
Plugin URI: https://verygoodplugins.com/
Version: 1.0
Author: Very Good Plugins
Author URI: https://verygoodplugins.com/
*/

function wpf_allow_guest_checkbox( $post, $settings ) {

	echo '<input class="checkbox wpf-restrict-access-checkbox" type="checkbox" data-unlock="wpf-settings-allow_tags wpf-settings-allow_tags_all" id="wpf-guest-access" name="wpf-settings[guest_access]" value="1" ' . checked( $settings['guest_access'], 1, false ) . ' />';
	echo '<label for="wpf-guest-access" class="wpf-restrict-access">Allow guest access</label></p>';

}

add_action( 'wpf_meta_box_content', 'wpf_allow_guest_checkbox', 12, 2 );

function wpf_allow_guest_access( $can_access, $user_id, $post_id ) {

	$settings = get_post_meta( $post_id, 'wpf-settings', true );

	if ( ! is_user_logged_in() && ! empty( $settings ) && ! empty( $settings['guest_access'] ) ) {
		$can_access = true;
	}

	return $can_access;

}

add_filter( 'wpf_user_can_access', 'wpf_allow_guest_access', 10, 3 );