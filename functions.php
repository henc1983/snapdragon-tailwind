<?php
/**
 * Snapdragon engine room
 *
 * @package snapdragon
 */

defined('ABSPATH') or die('No script kiddies please!');
defined( 'THEME_DIR' ) or define( 'THEME_DIR' , untrailingslashit( get_template_directory() ) );
defined( 'THEME_URI' ) or define( 'THEME_URI' , untrailingslashit( get_template_directory_uri() ) );



// Include theme functions
require_once  THEME_DIR . '/inc/snapdragon-functions.php';


/**
 * @class Snapdragon()
 * @return class (object)
 * @var (object) $snapdragon
 */
require_once THEME_DIR . '/inc/class-snapdragon.php';


// Include template hooks
require_once  THEME_DIR . '/inc/snapdragon-template-functions.php';
require_once  THEME_DIR . '/inc/snapdragon-template-hooks.php';