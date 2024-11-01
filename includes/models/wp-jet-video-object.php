<?php
if ( ! defined( 'WP_JET_PLAYER_VERSION' ) ) exit;

/**
 * @since 1.0
 * @version 1.0
 */
if ( ! class_exists( 'WP_Jet_Video_Object' ) ) :
	final class WP_Jet_Video_Object {

		public $id               = 0;

		public $title            = '';
		
		public $videos           = array();

		public $splash_image_id  = 0;

		public $splash_image_url = '';

		public $splash_text      = '';

		public $description      = '';

		public $player_id        = 0;

		public $subtitles        = array();

		/**
		 * Construct
		 */
		function __construct( $video_id = NULL ) {

			if ( ! is_numeric( $video_id ) || $video_id == NULL || $video_id == 0 ) return false;

			$this->populate( $video_id );

		}

		/**
		 * Populate
		 * @since 1.0
		 * @version 1.0
		 */
		protected function populate( $video_id ) {

			$video_post = get_post( $video_id );

			if ( $video_post == null || $video_post->post_status != 'publish' || $video_post->post_type != 'wp-jet-video' ) return;

			$video_data = get_post_meta( $video_id, 'wp-jet-video-setting', true );

			$this->id    = intval( $video_id );
			$this->title = $video_post->post_title;

			if ( !empty( $video_data['video'] ) )
				$this->videos = $this->get_formated_data( $video_data['video'], 'src', 'quality' );

			if ( !empty( $video_data['splashImage'] ) ) {
				$this->splash_image_id  = intval( $video_data['splashImage'] );
				$this->splash_image_url = wp_get_attachment_url( intval( $video_data['splashImage'] ) );
			}
			
			if ( !empty( $video_data['splashText'] ) )
				$this->splash_text = $video_data['splashText'];

			if ( !empty( $video_data['description'] ) )
				$this->description = $video_data['description'];

			if ( !empty( $video_data['player'] ) )
				$this->player_id = intval( $video_data['player'] );

			if ( !empty( $video_data['subtitle'] ) )
				$this->subtitles = $this->get_formated_data( $video_data['subtitle'], 'file', 'label' );
			
		}


		protected function get_formated_data( $data, $index1, $index2 ) {
			
			$formated_data = array();

			foreach ( $data[$index1] as $key => $value ) {

				if ( !empty( $value ) ) {
					
					$formated_data[] = array( 
						'id'    => intval( $value ),
						'url'   => wp_get_attachment_url( intval( $value ) ),
						$index2 => $data[$index2][$key] 
					);
				
				}

			}

			return $formated_data;
		}

	}
endif;
