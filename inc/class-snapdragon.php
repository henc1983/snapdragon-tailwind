<?php
/**
 * Snapdragon Class
 *
 * @since    1.0
 * @package  snapdragon
 */



if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



if ( ! class_exists( 'Snapdragon' ) ) :



	/**
	 * The main Snapdragon class
	 */
	class Snapdragon {



		private static $instance = null;

		public $defaults;
		public $options;
		public $setup;
		
        public $cookies;
		public $translates;
		public $requests;
		public $customizer;
		public $woocommerce;
		
		public $version;
		public $author;



		public static function instance() {
			if ( self::$instance === null ) {
				self::$instance = new self();
			}

			return self::$instance;
		}



		public function __construct() {		
			$GLOBALS['snapdragon'] = $this;
			$theme = wp_get_theme();
			$this->version 		= $theme->get( 'Version' );
			$this->author		= $theme->get( 'Author' );
			return $this;
		}
		       


		private function check_file($file) {
			if ( ! file_exists( $file ) ) {
				die( "Missing file: $file" );
			}

			return require_once $file;
		}
		// End of class
	}



endif;



return Snapdragon::instance();