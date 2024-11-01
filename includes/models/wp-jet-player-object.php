<?php
if ( ! defined( 'WP_JET_PLAYER_VERSION' ) ) exit;

/**
 * @since 1.0
 * @version 1.0
 */
if ( ! class_exists( 'WP_Jet_Player_Object' ) ) :
	final class WP_Jet_Player_Object {

		public $id                    = 0;

		public $title                 = '';

		public $skin_id               = 0;

		public $is_controllbar        = false;
		
		public $is_controllbar_always = false;

		public $is_setting 		      = false;

		public $is_embed 			  = false;

		public $is_sharing 		      = false;

		public $is_link 			  = false;

		public $is_volume  		      = false;

		public $volume_level          = 50;

		public $is_web_fullscreen     = false;

		public $is_fullscreen  	      = false;

		public $is_mini_player  	  = false;

		public $is_screenshot         = false;

		public $is_play               = false;

		public $is_repeat             = false;

		public $is_rewind             = false;

		public $is_speed              = false;

		public $speed_step            = 'half';

		public $is_subtitle           = false;

		public $is_subtitle_enable    = false;

		public $is_remember_position  = false;

		public $width                 = 0;

		public $height                = 0;

		public $logo_id               = 0;

		public $logo_url              = '';

		public $logo_position         = 'bottom-right';

		public $is_video_length       = false;

		public $is_screen_ratio       = false;

		public $is_flip    		      = false;

		public $is_quality   	      = false;

		public $is_auto_miniscreen    = false;

		public $is_muted   		      = false;

		public $is_mini_scrollbar     = false;

		/**
		 * Construct
		 */
		function __construct( $player_id = NULL ) {

			if ( ! is_numeric( $player_id ) || $player_id == NULL || $player_id == 0 ) return false;

			$this->populate( $player_id );

		}

		/**
		 * Populate
		 * @since 1.0
		 * @version 1.0
		 */
		protected function populate( $player_id ) {

			$player_post = get_post( $player_id );

			if ( $player_post == null || $player_post->post_status != 'publish' || $player_post->post_type != 'wp-jet-player' ) return;

			$player_data = get_post_meta( $player_id, 'wp-jet-player-setting', true );

			$this->id                         = intval( $player_id );
			$this->title        	          = $player_post->post_title;

			if ( !empty( $player_data['skin'] ) )
				$this->skin_id                = intval( $player_data['skin'] );
				
			if ( !empty( $player_data['controllbar'] ) )
				$this->is_controllbar         = $player_data['controllbar'];
				
			if ( !empty( $player_data['controllbarVisible'] ) )
				$this->is_controllbar_always  = $player_data['controllbarVisible'];
				
			if ( !empty( $player_data['setting'] ) )
				$this->is_setting 		      = $player_data['setting'];
				
			if ( !empty( $player_data['embed'] ) )
				$this->is_embed 			  = $player_data['embed'];
				
			if ( !empty( $player_data['sharing'] ) )
				$this->is_sharing 		      = $player_data['sharing'];
				
			if ( !empty( $player_data['link'] ) )
				$this->is_link 			      = $player_data['link'];
				
			if ( !empty( $player_data['volume'] ) )
				$this->is_volume  		      = $player_data['volume'];
				
			if ( !empty( $player_data['volumeLevel'] ) )
				$this->volume_level           = intval( $player_data['volumeLevel'] );
				
			if ( !empty( $player_data['webFullscreen'] ) )
				$this->is_web_fullscreen      = $player_data['webFullscreen'];
				
			if ( !empty( $player_data['fullscreen'] ) )
				$this->is_fullscreen  	      = $player_data['fullscreen'];
				
			if ( !empty( $player_data['miniPlayer'] ) )
				$this->is_mini_player  	      = $player_data['miniPlayer'];
				
			if ( !empty( $player_data['screenshot'] ) )
				$this->is_screenshot          = $player_data['screenshot'];
				
			if ( !empty( $player_data['play'] ) )
				$this->is_play                = $player_data['play'];
				
			if ( !empty( $player_data['repeat'] ) )
				$this->is_repeat              = $player_data['repeat'];
				
			if ( !empty( $player_data['rewind'] ) )
				$this->is_rewind              = $player_data['rewind'];
				
			if ( !empty( $player_data['speed'] ) )
				$this->is_speed               = $player_data['speed'];
				
			if ( !empty( $player_data['speedStep'] ) )
				$this->speed_step             = $player_data['speedStep'];
				
			if ( !empty( $player_data['subtitle'] ) )
				$this->is_subtitle            = $player_data['subtitle'];
				
			if ( !empty( $player_data['subtitleEnable'] ) )
				$this->is_subtitle_enable     = $player_data['subtitleEnable'];
				
			if ( !empty( $player_data['rememberPosition'] ) )
				$this->is_remember_position   = $player_data['rememberPosition'];
				
			if ( !empty( $player_data['width'] ) )
				$this->width                  = intval( $player_data['width'] );
				
			if ( !empty( $player_data['height'] ) )
				$this->height                 = intval( $player_data['height'] );
				
			if ( !empty( $player_data['logo'] ) ) {
				$this->logo_id                = intval( $player_data['logo'] );
				$this->logo_url               = wp_get_attachment_url( intval( $player_data['logo'] ) );
			}
				
			if ( !empty( $player_data['logoPosition'] ) )
				$this->logo_position          = $player_data['logoPosition'];
				
			if ( !empty( $player_data['videoLength'] ) )
				$this->is_video_length        = $player_data['videoLength'];
				
			if ( !empty( $player_data['ratio'] ) )
				$this->is_screen_ratio        = $player_data['ratio'];
				
			if ( !empty( $player_data['flip'] ) )
				$this->is_flip    		      = $player_data['flip'];
				
			if ( !empty( $player_data['quality'] ) )
				$this->is_quality   		  = $player_data['quality'];
				
			if ( !empty( $player_data['autoMiniscreen'] ) )
				$this->is_auto_miniscreen     = $player_data['autoMiniscreen'];
				
			if ( !empty( $player_data['muted'] ) )
				$this->is_muted   		      = $player_data['muted'];
				
			if ( !empty( $player_data['miniScrollbar'] ) )
				$this->is_mini_scrollbar     = $player_data['miniScrollbar'];
			
		}

	}
endif;
