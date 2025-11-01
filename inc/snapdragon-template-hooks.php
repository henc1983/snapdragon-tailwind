<?php
/**
 * Template hooks.
 *
 * @package snapdragon
 */

defined('ABSPATH') or die('No script kiddies please!');



/**
 * Theme Main Header
 */
add_action( 'snapdragon_custom_logo' , 'snapdragon_custom_brand_logo' , 0 );

add_action( 'snapdragon_main_header' , 'snapdragon_main_header_before' , 0 );
add_action( 'snapdragon_main_header' , 'snapdragon_main_header_section_brand' , 10 );
add_action( 'snapdragon_main_header' , 'snapdragon_main_header_section_navigation' , 30 );
add_action( 'snapdragon_main_header' , 'snapdragon_main_header_after' , 50 );

// add_action( 'snapdragon_main_header_button_group' , 'snapdragon_main_header_button_group_profile' , 10 );
// add_action( 'snapdragon_main_header_button_group' , 'snapdragon_main_header_button_group_wishlist' , 30 );
// add_action( 'snapdragon_main_header_button_group' , 'snapdragon_main_header_button_group_cart' , 50 );
// add_action( 'snapdragon_main_header_button_group' , 'snapdragon_main_header_button_group_translates' , 70 );

add_action( 'snapdragon_main_header_navmenu' , 'snapdragon_main_header_navmenu_toggle' , 10 );
add_action( 'snapdragon_main_header_navmenu' , 'snapdragon_main_header_navmenu_menuitems' , 20 );
// add_action( 'snapdragon_main_header_navmenu' , 'snapdragon_main_header_button_group_profile' , 30 );


/**
 * Theme Important Hooks
 */
// add_action( 'wp_head_meta' , 'snapdragon_google_site_verification' , 10 );
// add_action( 'wp_head_meta' , 'snapdragon_barion_code_inject' , -1 );
// add_action( 'wp_body_open' , 'snapdragon_preloader_animation' , 0 );
add_action( 'wp_body_open' , 'snapdragon_svg_icons' , 0 );
add_action( 'wp_footer' , 'snapdragon_spinner_js_template' , 0 );



/**
 * Pages
 *
 * @see  snapdragon_page_header()
 * @see  snapdragon_page_content()
 * @see  snapdragon_display_comments()
 */
add_action( 'snapdragon_page' , 'snapdragon_page_header' , 10 );
add_action( 'snapdragon_page' , 'snapdragon_page_content' , 20 );
add_action( 'snapdragon_page_after' , 'snapdragon_display_comments' , 10 );

add_action( 'snapdragon_homepage' , 'snapdragon_page_header' , 10 );
add_action( 'snapdragon_homepage' , 'snapdragon_page_content' , 20 );




/**
 * Posts and Single Posts
 *
 * @see  snapdragon_post_header()
 * @see  snapdragon_post_content()
 * @see  snapdragon_edit_post_link()
 * @see  snapdragon_post_taxonomy()
 * @see  snapdragon_post_nav()
 * @see  snapdragon_display_comments()
 * @see  storefront_post_meta()
 */

add_action( 'snapdragon_loop_post' , 'snapdragon_post_header' , 10 );
add_action( 'snapdragon_loop_post' , 'snapdragon_post_content' , 30 );
add_action( 'snapdragon_loop_post' , 'snapdragon_post_taxonomy' , 40 );
add_action( 'snapdragon_loop_after' , 'snapdragon_paging_nav' , 10 );

add_action( 'snapdragon_single_post' , 'snapdragon_post_header' , 10 );
add_action( 'snapdragon_single_post' , 'snapdragon_post_content' , 30 );

add_action( 'snapdragon_single_post_bottom' , 'snapdragon_edit_post_link' , 5 );
add_action( 'snapdragon_single_post_bottom' , 'snapdragon_post_taxonomy' , 5 );
add_action( 'snapdragon_single_post_bottom' , 'snapdragon_post_nav' , 10 );
add_action( 'snapdragon_single_post_bottom' , 'snapdragon_display_comments' , 20 );

add_action( 'storefront_post_header_before' , 'storefront_post_meta', 10 );
add_action( 'storefront_post_content_before' , 'storefront_post_thumbnail', 10 );