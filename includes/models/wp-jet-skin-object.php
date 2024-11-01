<?php
if ( ! defined( 'WP_JET_PLAYER_VERSION' ) ) exit;

/**
 * @since 1.0
 * @version 1.0
 */
if ( ! class_exists( 'WP_Jet_Skin_Object' ) ) :
	final class WP_Jet_Skin_Object {

		public $id            = 0;

		public $title         = '';
		
		public $color         = '';

		public $loading       = array();

		public $play          = array();

		public $pause         = array();

		public $volume        = array();

		public $volumeClose   = array();

		public $subtitle      = array();

		public $screenshot    = array();

		public $setting       = array();

		public $fullscreen    = array();

		public $fullscreenWeb = array();

		public $pip           = array();

		public $prev          = array();

		public $next          = array();

		/**
		 * Construct
		 */
		function __construct( $skin_id = NULL ) {

			if ( ! is_numeric( $skin_id ) || $skin_id == NULL || $skin_id == 0 ) return false;

			$this->populate( $skin_id );

		}

		/**
		 * Populate
		 * @since 1.0
		 * @version 1.0
		 */
		protected function populate( $skin_id ) {

			$skin_post = get_post( $skin_id );

			if ( $skin_post == null || $skin_post->post_status != 'publish' || $skin_post->post_type != 'wp-jet-skin' ) return;

			$skin_data = get_post_meta( $skin_id, 'wp-jet-skin-setting', true );

			$this->id            = intval( $skin_id );
			$this->title         = $skin_post->post_title;

			if ( !empty( $skin_data['color'] ) )
				$this->color         = $skin_data['color'];

			if ( !empty( $skin_data['loading'] ) )
				$this->loading       = $skin_data['loading'];
	
			if ( !empty( $skin_data['play'] ) )
				$this->play          = $skin_data['play'];
	
			if ( !empty( $skin_data['pause'] ) )
				$this->pause         = $skin_data['pause'];
	
			if ( !empty( $skin_data['volume'] ) )
				$this->volume        = $skin_data['volume'];
	
			if ( !empty( $skin_data['volumeClose'] ) )
				$this->volumeClose   = $skin_data['volumeClose'];
	
			if ( !empty( $skin_data['subtitle'] ) )
				$this->subtitle      = $skin_data['subtitle'];
				
			if ( !empty( $skin_data['screenshot'] ) )
				$this->screenshot    = $skin_data['screenshot'];
				
			if ( !empty( $skin_data['setting'] ) )
				$this->setting       = $skin_data['setting'];
				
			if ( !empty( $skin_data['fullscreen'] ) )
				$this->fullscreen    = $skin_data['fullscreen'];
				
			if ( !empty( $skin_data['fullscreenWeb'] ) )
				$this->fullscreenWeb = $skin_data['fullscreenWeb'];
				
			if ( !empty( $skin_data['pip'] ) )
				$this->pip           = $skin_data['pip'];
				
			if ( !empty( $skin_data['prev'] ) )
				$this->prev          = $skin_data['prev'];
				
			if ( !empty( $skin_data['next'] ) )
				$this->next          = $skin_data['next'];
			
		}

	}
endif;
