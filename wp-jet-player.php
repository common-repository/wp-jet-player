<?php
/**
 * Plugin Name: WP Jet Player
 * Description: Customizable Video Player.
 * Version: 1.0
 * Author Email: support@codersjet.com
 * Plugin URI: player.codersjet.com
 * Author: codersjet
 * Author URI: codersjet.com
 * Requires at least: WP 4.8
 * Tested up to: WP 5.3
 * Text Domain: wp-jet-player
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! class_exists( 'Wp_Jet_Player' ) ) :
	final class Wp_Jet_Player {

		// Plugin Version
		public $version             = '1.0';

		// Instnace
		protected static $_instance = NULL;

		/**
		 * Setup Instance
		 * @since 1.1.2
		 * @version 1.0
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Not allowed
		 * @since 1.1.2
		 * @version 1.0
		 */
		public function __clone() { _doing_it_wrong( __FUNCTION__, 'Cheatin&#8217; huh?', '1.1.2' ); }

		/**
		 * Not allowed
		 * @since 1.1.2
		 * @version 1.0
		 */
		public function __wakeup() { _doing_it_wrong( __FUNCTION__, 'Cheatin&#8217; huh?', '1.1.2' ); }

		/**
		 * Define
		 * @since 1.1.2
		 * @version 1.0
		 */
		private function define( $name, $value, $definable = true ) {
			if ( ! defined( $name ) )
				define( $name, $value );
			elseif ( ! $definable && defined( $name ) )
				_doing_it_wrong( 'Wp_Jet_Player->define()', 'Could not define: ' . $name . ' as it is already defined somewhere else!', '1.1.2' );
		}

		/**
		 * Require File
		 * @since 1.1.2
		 * @version 1.0
		 */
		public function file( $required_file ) {
			if ( file_exists( $required_file ) )
				require_once $required_file;
			else
				_doing_it_wrong( 'Wp_Jet_Player->file()', 'Requested file ' . $required_file . ' not found.', '1.1.2' );
		}

		/**
		 * Construct
		 * @since 1.0
		 * @version 1.0
		 */
		public function __construct() {

			$this->define_constants();
			$this->includes();
			$this->pre_init_globals();

			register_activation_hook( WP_JET_PLAYER, array( $this, 'wp_jet_palyer_activated' ) );
			
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );

			add_action( 'wp_enqueue_scripts',    array( $this, 'enqueue_front_before' ) );
			add_action( 'wp_footer',             array( $this, 'enqueue_front_after' ) );

		}

		/**
		 * Define Constants
		 * @since 1.1.2
		 * @version 1.0
		 */
		private function define_constants() {

			$this->define( 'WP_JET_PLAYER_VERSION',        '1.0' );
			$this->define( 'WP_JET_PLAYER_SLUG',           'wp-jet-player' );

			$this->define( 'WP_JET_PLAYER',         __FILE__ );
			$this->define( 'WP_JET_PLAYER_ROOT',    plugin_dir_path( WP_JET_PLAYER ) );
			$this->define( 'WP_JET_PLAYER_INC_DIR', WP_JET_PLAYER_ROOT . 'includes/' );
			$this->define( 'WP_JET_PLAYER_ASSET',   plugins_url('assets/', WP_JET_PLAYER) );

		}

		/**
		 * Include Plugin Files
		 * @since 1.0
		 * @version 1.0
		 */
		public function includes() {
			
			$this->file( WP_JET_PLAYER_INC_DIR . 'models/wp-jet-video-object.php' );
			$this->file( WP_JET_PLAYER_INC_DIR . 'models/wp-jet-player-object.php' );
			$this->file( WP_JET_PLAYER_INC_DIR . 'models/wp-jet-skin-object.php' );

			$this->file( WP_JET_PLAYER_INC_DIR . 'wp-jet-player-functions.php' );

			$this->file( WP_JET_PLAYER_INC_DIR . 'wp-jet-video-module.php' );
			$this->file( WP_JET_PLAYER_INC_DIR . 'wp-jet-player-module.php' );
			$this->file( WP_JET_PLAYER_INC_DIR . 'wp-jet-skin-module.php' );
			
			$this->file( WP_JET_PLAYER_INC_DIR . 'wp-jet-player-html.php' );
			
			$this->file( WP_JET_PLAYER_INC_DIR . 'wp-jet-shortcodes.php' );

		}

		private function pre_init_globals() {

			global $wp_jet_player_video_instance;

			$wp_jet_player_video_instance = 100;

		}

		public function enqueue_admin_assets( $hook ) {

			global $post;

			$wp_jet_post_types = array( 'wp-jet-player', 'wp-jet-skin', 'wp-jet-video');

			if( ( !empty( $_GET['post_type'] ) && in_array( $_GET['post_type'], $wp_jet_post_types ) ) || ( !empty( $post ) && in_array( $post->post_type, $wp_jet_post_types ) ) ) 
			{
				wp_enqueue_media();
	        	
	        	wp_register_script( 'wp-jet-player-js-admin', WP_JET_PLAYER_ASSET.'js/wp-jet-admin-script.js', array('jquery'), '1.0', true );
	    		wp_enqueue_script( 'wp-jet-player-js-admin' );
			}

			wp_register_style( 'wp-jet-player-css-admin', WP_JET_PLAYER_ASSET.'css/wp-jet-admin-style.css', false, '1.0' );
        	wp_enqueue_style( 'wp-jet-player-css-admin' );
		}

		public function enqueue_front_before() {

			global $wp_jet_player_videos;

			$wp_jet_player_videos = array();

			wp_register_script( 'wp-jet-player-core', WP_JET_PLAYER_ASSET.'js/libraries/wp-jet-player-core.js', array('jquery'), '1.0', true );

			wp_register_script( 'wp-jet-player', WP_JET_PLAYER_ASSET.'js/wp-jet-script.js', array('jquery', 'wp-jet-player-core'), '1.0', true );

			wp_register_style( 'wp-jet-player', WP_JET_PLAYER_ASSET.'css/wp-jet-style.css', false, '1.0' );

        	wp_enqueue_style( 'wp-jet-player' );

			wp_register_style( 'wp-jet-player-core', WP_JET_PLAYER_ASSET.'css/libraries/wp-jet-player-core.css', false, '1.0' );

        	wp_enqueue_style( 'wp-jet-player-core' );

			do_action( 'wp_jet_player_front_enqueue' );
			
		}

		public function enqueue_front_after() {

			global $wp_jet_player_videos;

			wp_localize_script( 'wp-jet-player', 'wp_jet_player_data', array(
				'videos' => $wp_jet_player_videos
			) );

    		wp_enqueue_script( 'wp-jet-player-core' );

    		wp_enqueue_script( 'wp-jet-player' );

			do_action( 'wp_jet_player_front_enqueue_footer' );
		}

		public function wp_jet_palyer_activated() {
			wp_jet_default_posts();
		}
		
	}
endif;

function wp_jet_player_plugin() {
	return Wp_Jet_Player::instance();
}
wp_jet_player_plugin();