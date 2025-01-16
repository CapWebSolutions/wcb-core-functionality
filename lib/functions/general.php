<?php
/**
 * General
 *
 * This file contains any general functions
 *
 * @package      Core_Functionality
 * @since        1.1.0
 * @link         https://github.com/capwebsolutions/fflassist-core-functionality
 * @author       Matt Ryan <matt@capwebsolutions.com>
 * @copyright    Copyright (c) 2024, Matt Ryan
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
namespace capweb;

/** 
 * Move Yoast to the Bottom of editor screen
 */
function move_yoast_to_bottom() {
    return 'low';
}
add_filter( 'wpseo_metabox_prio', __NAMESPACE__ . '\move_yoast_to_bottom');


/**	
 * Redirect non-admin users to home page on logout. 
 */
function logout_redirect( $redirect_to, $requested_redirect, $user ) {
    if ( ! is_wp_error( $user ) && ! current_user_can( 'administrator' ) ) {
        // Redirect non-admin users to the home page after logout
        $redirect_to = home_url();
    }
    return $redirect_to;
}
add_filter( 'logout_redirect', __NAMESPACE__ . '\logout_redirect', 10, 3 );