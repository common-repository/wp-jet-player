<?php 
if ( ! defined( 'WP_JET_PLAYER_VERSION' ) ) exit;

if ( ! class_exists( 'WP_Jet_Player_Module' ) ) :
    class WP_Jet_Player_Module
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
            
            add_action( 'init',             array( $this, 'wp_jet_player_post_type') );
            add_action( 'save_post',        array( $this, 'save_meta_boxes' ) );
            add_filter( 'post_row_actions', array( $this, 'modify_list_row_actions' ), 10, 2 );
            add_action( 'admin_post_wp_jet_player_clone', array( $this, 'wp_jet_player_clone' ) );

        }

        public function wp_jet_player_post_type() {

            $labels = array(
                'name'                  => _x( 'WP Jet Players', WP_JET_PLAYER_SLUG ),
                'singular_name'         => _x( 'WP Jet Player', WP_JET_PLAYER_SLUG ),
                'menu_name'             => __( 'WP Jet Player', WP_JET_PLAYER_SLUG ),
                'name_admin_bar'        => __( 'WP Jet Player', WP_JET_PLAYER_SLUG ),
                'archives'              => __( 'Player Archives', WP_JET_PLAYER_SLUG ),
                'attributes'            => __( 'Player Attributes', WP_JET_PLAYER_SLUG ),
                'parent_item_colon'     => __( 'Parent Player:', WP_JET_PLAYER_SLUG ),
                'all_items'             => __( 'Players', WP_JET_PLAYER_SLUG ),
                'add_new_item'          => __( 'Add New Player', WP_JET_PLAYER_SLUG ),
                'add_new'               => __( 'Add New Player', WP_JET_PLAYER_SLUG ),
                'new_item'              => __( 'New Player', WP_JET_PLAYER_SLUG ),
                'edit_item'             => __( 'Edit Player', WP_JET_PLAYER_SLUG ),
                'update_item'           => __( 'Update Player', WP_JET_PLAYER_SLUG ),
                'view_item'             => __( 'View Player', WP_JET_PLAYER_SLUG ),
                'view_items'            => __( 'View Players', WP_JET_PLAYER_SLUG ),
                'search_items'          => __( 'Search Player', WP_JET_PLAYER_SLUG ),
                'not_found'             => __( 'Not found', WP_JET_PLAYER_SLUG ),
                'not_found_in_trash'    => __( 'Not found in Trash', WP_JET_PLAYER_SLUG ),
                'featured_image'        => __( 'Featured Image', WP_JET_PLAYER_SLUG ),
                'set_featured_image'    => __( 'Set featured image', WP_JET_PLAYER_SLUG ),
                'remove_featured_image' => __( 'Remove featured image', WP_JET_PLAYER_SLUG ),
                'use_featured_image'    => __( 'Use as featured image', WP_JET_PLAYER_SLUG ),
                'insert_into_item'      => __( 'Insert into item', WP_JET_PLAYER_SLUG ),
                'uploaded_to_this_item' => __( 'Uploaded to this Player', WP_JET_PLAYER_SLUG ),
                'items_list'            => __( 'Players list', WP_JET_PLAYER_SLUG ),
                'items_list_navigation' => __( 'Players list navigation', WP_JET_PLAYER_SLUG ),
                'filter_items_list'     => __( 'Filter Players list', WP_JET_PLAYER_SLUG ),
            );
            $args = array(
                'label'                 => __( 'WP Jet Player', WP_JET_PLAYER_SLUG ),
                'labels'                => $labels,
                'supports'              => array( 'title' ),
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_position'         => 5,
                'menu_icon'             => 'dashicons-format-video',
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => false,
                'has_archive'           => true,
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                'capability_type'       => 'page',
                'register_meta_box_cb' => array( $this, 'add_meta_boxes')
            );
            register_post_type( 'wp-jet-player', $args );

        }

        public function add_meta_boxes()
        {
            $default_screens = array(
                'wp-jet-player-general-settings' => array(
                    'title'    => __( 'Player Setting', WP_JET_PLAYER_SLUG ), 
                    'callback' => array( 'WP_Jet_Player_HTML', 'player_general_setting' ),
                    'context'  => 'normal',
                    'priority' => 'high'
                )
            );

            $jet_player_screens = apply_filters( 'wp_jet_player_setting_screens', $default_screens );

            foreach ( $jet_player_screens as $key => $value ) {

                $screen = set_meta_defaut_values( $value );

                add_meta_box(
                    $key,                       
                    $screen['title'],           
                    $screen['callback'],        
                    'wp-jet-player',            
                    $screen['context'],         
                    $screen['priority'],        
                    $screen['callback_args']  
                );
            }
        }
     
        public function save_meta_boxes( $post_id )
        {

            if ( array_key_exists( 'wp-jet-player', $_POST ) ) {

                $data = $_POST['wp-jet-player'];
                
                foreach ( $data as $key => $value ) {
                    $data[ $key ] = sanitize_text_field( $value );
                }

                update_post_meta( $post_id, 'wp-jet-player-setting', $data );
            }
        }

        public function modify_list_row_actions( $actions, $post ) {

            if ( $post->post_type == "wp-jet-player" ) {
                $nonce = wp_create_nonce( 'wp-jet-player-clone-nounce' );
                $actions['clone'] = '<a href="'.esc_attr( admin_url( 'admin-post.php?action=wp_jet_player_clone&post_id='.$post->ID.'&_wpnonce='. $nonce ) ).'">'.__( 'Clone', 'wp-jet-player' ).'</a>';
                unset( $actions['view'] );
                unset( $actions['inline hide-if-no-js'] );
            }
         
            return $actions;
        }

        public function wp_jet_player_clone() {
            
            if ( ! array_key_exists( 'post_id', $_GET ) || ! array_key_exists( '_wpnonce', $_GET ) ) return;


            if( ! wp_verify_nonce( $_GET['_wpnonce'], 'wp-jet-player-clone-nounce' ) ) return;
            
            $player_id = intval( $_GET['post_id'] );
            $player = get_post( $player_id );

            $clone_player_arr = array(
                'post_author'           => get_current_user_id(),
                'post_title'            => $player->post_title,
                'post_status'           => 'draft',
                'post_type'             => 'wp-jet-player',
                'meta_input'   => array(
                    'wp-jet-player-setting' => get_post_meta( $player_id, 'wp-jet-player-setting', true ),
                ),
            );

            $cloned_post_id = wp_insert_post( $clone_player_arr, true );

            if( ! is_wp_error( $cloned_post_id ) ){
                
                $post_id = wp_update_post( array(
                    'ID' => $cloned_post_id,
                    'post_title' => $player->post_title.'_'.$cloned_post_id 
                ), true );    

            }

            wp_redirect( admin_url('edit.php?post_type=wp-jet-player') );
            die();
            
        }

    }
endif;

function wp_jet_player_module() {
    return WP_Jet_Player_Module::instance();
}
wp_jet_player_module();