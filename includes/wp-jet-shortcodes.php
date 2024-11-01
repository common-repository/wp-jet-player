<?php 
if ( ! defined( 'WP_JET_PLAYER_VERSION' ) ) exit;

if ( ! class_exists( 'WP_Jet_Shortcode' ) ) :
    class WP_Jet_Shortcode
    {
        // Instnace
        protected static $_instance = NULL;

        /**
         * Setup Instance
         * @since 1.0
         * @version 1.0
         */
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
         * Construct
         * @since 1.0
         * @version 1.0
         */
        public function __construct() {
            
            if( ! is_admin() && ! wp_doing_ajax() ) {

                add_shortcode( 'wp_jet_player_video' , array( $this, 'render_wp_jet_player' ) );

            }
        }


        public function render_wp_jet_player( $atts ) {
            
            if ( empty( $atts['id'] ) ) return; 

            $video_id = intval( $atts['id'] );

            $video_data = new WP_Jet_Video_Object( $video_id );

            if ( empty( $video_data->id ) ) return;

            $player_data = new WP_Jet_Player_Object( $video_data->player_id );

            if ( empty( $player_data->id ) ) return;

            $skin_data = new WP_Jet_Skin_Object( $player_data->skin_id );

            if ( empty( $skin_data->id ) ) return;

            global $wp_jet_player_videos;

            $element_id = 'video_'.$video_id.'_'.hash_hmac('md5', time().rand(), $video_id);

            $wp_jet_player_videos[$element_id] = array( 
                'video'  => $video_data,
                'player' => $player_data,
                'skin'   => $skin_data
            );

            return '<div class="wp-jet-video" id="'.$element_id.'"></div>';
        }

    }
endif;

function wp_jet_shortcode() {
    return WP_Jet_Shortcode::instance();
}
wp_jet_shortcode();