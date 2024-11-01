<?php 
if ( ! defined( 'WP_JET_PLAYER_VERSION' ) ) exit;

if ( ! class_exists( 'WP_Jet_Video_Module' ) ) :
    class WP_Jet_Video_Module
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
            
            add_action( 'init',            array( $this, 'wp_jet_video_post_type') );
            add_action( 'admin_menu',      array( $this, 'video_menue') );
            add_action( 'save_post',       array( $this, 'save_meta_boxes' ) );
            add_filter( 'single_template', array( $this, 'wp_jet_video_post_template' ) );
            add_filter( 'manage_wp-jet-video_posts_columns', array( $this, 'video_list_table_head' ) );
            add_action( 'manage_wp-jet-video_posts_custom_column', array( $this, 'video_list_table_content' ), 10, 2 );
            add_filter( 'post_row_actions', array( $this, 'modify_list_row_actions' ), 10, 2 );
            add_action( 'admin_post_wp_jet_video_clone', array( $this, 'wp_jet_video_clone' ) );

        }

        public function wp_jet_video_post_type() {

            $labels = array(
                'name'                  => _x( 'Videos', 'wp-jet-player' ),
                'singular_name'         => _x( 'Video', 'wp-jet-player' ),
                'menu_name'             => __( 'Video', 'wp-jet-player' ),
                'name_admin_bar'        => __( 'Video', 'wp-jet-player' ),
                'archives'              => __( 'Video Archives', 'wp-jet-player' ),
                'attributes'            => __( 'Video Attributes', 'wp-jet-player' ),
                'all_items'             => __( 'Videos', 'wp-jet-player' ),
                'add_new_item'          => __( 'Add New Video', 'wp-jet-player' ),
                'add_new'               => __( 'Add New Video', 'wp-jet-player' ),
                'new_item'              => __( 'New Video', 'wp-jet-player' ),
                'edit_item'             => __( 'Edit Video', 'wp-jet-player' ),
                'update_item'           => __( 'Update Video', 'wp-jet-player' ),
                'view_item'             => __( 'View Video', 'wp-jet-player' ),
                'view_items'            => __( 'View Videos', 'wp-jet-player' ),
                'search_items'          => __( 'Search Video', 'wp-jet-player' ),
                'not_found'             => __( 'Not found', 'wp-jet-player' ),
                'not_found_in_trash'    => __( 'Not found in Trash', 'wp-jet-player' ),
                'featured_image'        => __( 'Featured Image', 'wp-jet-player' ),
                'set_featured_image'    => __( 'Set featured image', 'wp-jet-player' ),
                'remove_featured_image' => __( 'Remove featured image', 'wp-jet-player' ),
                'use_featured_image'    => __( 'Use as featured image', 'wp-jet-player' ),
                'insert_into_item'      => __( 'Insert into item', 'wp-jet-player' ),
                'uploaded_to_this_item' => __( 'Uploaded to this Video', 'wp-jet-player' ),
                'items_list'            => __( 'Video list', 'wp-jet-player' ),
                'items_list_navigation' => __( 'Video list navigation', 'wp-jet-player' ),
                'filter_items_list'     => __( 'Filter Videos list', 'wp-jet-player' ),
            );
            $args = array(
                'label'                 => __( 'Video', 'wp-jet-player' ),
                'labels'                => $labels,
                'supports'              => array( 'title' ),
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => false,
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => false,
                'has_archive'           => true,
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                'capability_type'       => 'page',
                'register_meta_box_cb' => array( $this, 'add_meta_boxes' )
            );
            register_post_type( 'wp-jet-video', $args );

        }

        public function video_menue() {

            add_submenu_page(
                'edit.php?post_type=wp-jet-player',
                __( 'Videos', 'wp-jet-player' ),
                __( 'Videos', 'wp-jet-player' ),
                'manage_options',
                'edit.php?post_type=wp-jet-video'
            );
        }

        public function add_meta_boxes()
        {
            $default_screens = array(
                'wp-jet-video-general-settings' => array(
                    'title'    => __('Video Setting', WP_JET_PLAYER_SLUG), 
                    'callback' => array( 'WP_Jet_Player_HTML', 'video_general_setting' ),
                    'context'  => 'normal',
                    'priority' => 'high'
                ),
                'wp-jet-video-player-setting' => array(
                    'title'    => __('Video Player', WP_JET_PLAYER_SLUG), 
                    'callback' => array( 'WP_Jet_Player_HTML', 'video_player_setting' ),
                    'context'  => 'normal'
                ),
                'wp-jet-video-subtitles-setting' => array(
                    'title'    => __('Video Subtitles', WP_JET_PLAYER_SLUG), 
                    'callback' => array( 'WP_Jet_Player_HTML', 'video_subtitles_setting' ),
                    'context'  => 'normal'
                )
            );

            $jet_player_screens = apply_filters( 'wp_jet_video_setting_screens', $default_screens );

            foreach ( $jet_player_screens as $key => $value ) {

                $screen = set_meta_defaut_values( $value );

                add_meta_box(
                    $key,                       
                    $screen['title'],           
                    $screen['callback'],        
                    'wp-jet-video',            
                    $screen['context'],         
                    $screen['priority'],        
                    $screen['callback_args']  
                );
            }
        }
     
        public function save_meta_boxes( $post_id )
        {

            if ( array_key_exists( 'wp-jet-video', $_POST ) ) {

                $data = $_POST['wp-jet-video'];

                if( ! empty( $data['video'] ) ) {

                    foreach ( $data['video']['src'] as $key => $value ) {
                        $data['video']['src'][ $key ]     = sanitize_text_field( $value );
                        $data['video']['quality'][ $key ] = sanitize_text_field( $data['video']['quality'][ $key ] );
                    }

                }

                if( ! empty( $data['splashImage'] ) )
                    $data['splashImage'] = sanitize_text_field( $data['splashImage'] );

                $data['splashText']  = '';
                $data['description'] = '';

                if( ! empty( $data['player'] ) )
                    $data['player'] = sanitize_text_field( $data['player'] );

                if( ! empty( $data['subtitle'] ) ) {

                    foreach ( $data['subtitle']['file'] as $key => $value ) {
                        $data['subtitle']['file'][ $key ]  = sanitize_text_field( $value );
                        $data['subtitle']['label'][ $key ] = sanitize_text_field( $data['subtitle']['label'][ $key ] );
                    }

                }

                update_post_meta( $post_id, 'wp-jet-video-setting', $data );
            }
        }

        public function wp_jet_video_post_template( $single_template )
        {
            global $post;

            if ( 'wp-jet-video' === $post->post_type ) {
                $single_template = WP_JET_PLAYER_INC_DIR . 'templates/single-wp-jet-video.php';
            }

            return $single_template;
        }

        public function video_list_table_head( $defaults ) {
            $defaults['splash-image']    = __( 'Splash Image', 'wp-jet-player' );
            $defaults['shortcode']  = __( 'Shortcode', 'wp-jet-player' );
            return $defaults;
        }

        public function video_list_table_content( $column_name, $post_id ) {
            if ($column_name == 'splash-image') {
                $video = new WP_Jet_Video_Object( $post_id );
                echo '<img src="'.$video->splash_image_url.'" width="130">';
            }
            if ($column_name == 'shortcode') {
                echo '<input type="text" class="wp-jet-video-shortcode" value="[wp_jet_player_video id='.$post_id.']" readonly><input type="button" value="Copy" class="button wp-jet-video-shortcode-btn"><div class="wp-jet-msg-copy"></div>';
            }

        }

        public function modify_list_row_actions( $actions, $post ) {

            if ( $post->post_type == "wp-jet-video" ) {
                $nonce = wp_create_nonce( 'wp-jet-video-clone-nounce' );
                $actions['clone'] = '<a href="'.esc_attr( admin_url( 'admin-post.php?action=wp_jet_video_clone&post_id='.$post->ID.'&_wpnonce='. $nonce ) ).'">'.__( 'Clone', 'wp-jet-player' ).'</a>';
                unset( $actions['view'] );
                unset( $actions['inline hide-if-no-js'] );
            }
         
            return $actions;
        }

        public function wp_jet_video_clone() {
            
            if ( ! array_key_exists( 'post_id', $_GET ) || ! array_key_exists( '_wpnonce', $_GET ) ) return;


            if( ! wp_verify_nonce( $_GET['_wpnonce'], 'wp-jet-video-clone-nounce' ) ) return;
            
            $video_id = intval( $_GET['post_id'] );
            $video = get_post( $video_id );

            $clone_video_arr = array(
                'post_author'           => get_current_user_id(),
                'post_title'            => $video->post_title,
                'post_status'           => 'draft',
                'post_type'             => 'wp-jet-video',
                'meta_input'   => array(
                    'wp-jet-video-setting' => get_post_meta( $video_id, 'wp-jet-video-setting', true ),
                ),
            );

            $cloned_post_id = wp_insert_post( $clone_video_arr, true );

            if( ! is_wp_error( $cloned_post_id ) ){
                
                $post_id = wp_update_post( array(
                    'ID' => $cloned_post_id,
                    'post_title' => $video->post_title.'_'.$cloned_post_id 
                ), true );    

            }

            wp_redirect( admin_url('edit.php?post_type=wp-jet-video') );
            die();
            
        }

    }
endif;

function wp_jet_video_module() {
    return WP_Jet_Video_Module::instance();
}
wp_jet_video_module();