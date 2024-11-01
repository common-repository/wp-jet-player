<?php 
if ( ! defined( 'WP_JET_PLAYER_VERSION' ) ) exit;

if ( ! class_exists( 'WP_Jet_Player_HTML' ) ) :
    class WP_Jet_Player_HTML
    {
        public static function empty_setting()
        {
            return '';
        }

        public static function player_general_setting( $post )
        {
            $data = get_post_meta( $post->ID, 'wp-jet-player-setting', true );
            $skins = get_posts( array(
                'posts_per_page'   => -1,
                'orderby'          => 'title',
                'order'            => 'ASC',
                'post_type'        => 'wp-jet-skin',
                'post_status'      => 'publish'
            ) );
            require_once WP_JET_PLAYER_INC_DIR . 'html/player-admin-setting/player-general-settings.php';
        }

        public static function video_general_setting( $post )
        {
            $data = get_post_meta( $post->ID, 'wp-jet-video-setting', true );
            require_once WP_JET_PLAYER_INC_DIR . 'html/video-admin-setting/video-general.php';
        }

        public static function video_player_setting( $post )
        {
            $data = get_post_meta( $post->ID, 'wp-jet-video-setting', true );
            $players = get_posts( array(
                'posts_per_page'   => -1,
                'orderby'          => 'title',
                'order'            => 'ASC',
                'post_type'        => 'wp-jet-player',
                'post_status'      => 'publish'
            ) );
            require_once WP_JET_PLAYER_INC_DIR . 'html/video-admin-setting/video-player.php';
        }

        public static function video_subtitles_setting( $post )
        {
            $data = get_post_meta( $post->ID, 'wp-jet-video-setting', true );
            require_once WP_JET_PLAYER_INC_DIR . 'html/video-admin-setting/video-subtitles.php';
        }

        public static function skin_general_setting( $post )
        {
            $data = get_post_meta( $post->ID, 'wp-jet-skin-setting', true );
            require_once WP_JET_PLAYER_INC_DIR . 'html/skin-admin-setting/skin-general.php';
        }
    }
endif;