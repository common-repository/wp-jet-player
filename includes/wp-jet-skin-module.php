<?php 
if ( ! defined( 'WP_JET_PLAYER_VERSION' ) ) exit;

if ( ! class_exists( 'WP_Jet_Skin_Module' ) ) :
    class WP_Jet_Skin_Module
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
            
            add_action( 'init',       array( $this, 'wp_jet_skin_post_type') );
            add_action( 'admin_menu', array( $this, 'skin_menue') );
            add_action( 'save_post',  array( $this, 'save_meta_boxes' ) );
            add_filter( 'post_row_actions', array( $this, 'modify_list_row_actions' ), 10, 2 );
            add_action( 'admin_post_wp_jet_skin_clone', array( $this, 'wp_jet_skin_clone' ) );

        }

        public function wp_jet_skin_post_type() {

            $labels = array(
                'name'                  => _x( 'Skins', 'wp-jet-player' ),
                'singular_name'         => _x( 'Skin', 'wp-jet-player' ),
                'menu_name'             => __( 'Skin', 'wp-jet-player' ),
                'name_admin_bar'        => __( 'Skin', 'wp-jet-player' ),
                'archives'              => __( 'Skin Archives', 'wp-jet-player' ),
                'attributes'            => __( 'Skin Attributes', 'wp-jet-player' ),
                'parent_item_colon'     => __( 'Parent Skin:', 'wp-jet-player' ),
                'all_items'             => __( 'All Skins', 'wp-jet-player' ),
                'add_new_item'          => __( 'Add New Skin', 'wp-jet-player' ),
                'add_new'               => __( 'Add New Skin', 'wp-jet-player' ),
                'new_item'              => __( 'New Skin', 'wp-jet-player' ),
                'edit_item'             => __( 'Edit Skin', 'wp-jet-player' ),
                'update_item'           => __( 'Update Skin', 'wp-jet-player' ),
                'view_item'             => __( 'View Skin', 'wp-jet-player' ),
                'view_items'            => __( 'View Skins', 'wp-jet-player' ),
                'search_items'          => __( 'Search Skin', 'wp-jet-player' ),
                'not_found'             => __( 'Not found', 'wp-jet-player' ),
                'not_found_in_trash'    => __( 'Not found in Trash', 'wp-jet-player' ),
                'featured_image'        => __( 'Featured Image', 'wp-jet-player' ),
                'set_featured_image'    => __( 'Set featured image', 'wp-jet-player' ),
                'remove_featured_image' => __( 'Remove featured image', 'wp-jet-player' ),
                'use_featured_image'    => __( 'Use as featured image', 'wp-jet-player' ),
                'insert_into_item'      => __( 'Insert into item', 'wp-jet-player' ),
                'uploaded_to_this_item' => __( 'Uploaded to this Skin', 'wp-jet-player' ),
                'items_list'            => __( 'Skins list', 'wp-jet-player' ),
                'items_list_navigation' => __( 'Skins list navigation', 'wp-jet-player' ),
                'filter_items_list'     => __( 'Filter Skins list', 'wp-jet-player' ),
            );
            $args = array(
                'label'                 => __( 'Skin', 'wp-jet-player' ),
                'labels'                => $labels,
                'supports'              => array( 'title' ),
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => false,
                'menu_position'         => 5,
                'menu_icon'             => 'dashicons-format-video',
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => false,
                'has_archive'           => true,
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                'capability_type'       => 'page',
                'register_meta_box_cb' => array( $this, 'add_meta_boxes' )
            );
            register_post_type( 'wp-jet-skin', $args );

        }

        public function skin_menue() {

            add_submenu_page(
                'edit.php?post_type=wp-jet-player',
                __( 'Skins', 'wp-jet-player' ),
                __( 'Skins', 'wp-jet-player' ),
                'manage_options',
                'edit.php?post_type=wp-jet-skin'
            );
        }

        public function add_meta_boxes()
        {
            $default_screens = array(
                'wp-jet-skin-general-settings' => array(
                    'title'    => __('Skin Setting', WP_JET_PLAYER_SLUG), 
                    'callback' => array( 'WP_Jet_Player_HTML', 'skin_general_setting' ),
                    'context'  => 'normal',
                    'priority' => 'high'
                )
            );

            $jet_player_screens = apply_filters( 'wp_jet_skin_setting_screens', $default_screens );

            foreach ( $jet_player_screens as $key => $value ) {

                $screen = set_meta_defaut_values( $value );

                add_meta_box(
                    $key,                       
                    $screen['title'],           
                    $screen['callback'],        
                    'wp-jet-skin',            
                    $screen['context'],         
                    $screen['priority'],        
                    $screen['callback_args']  
                );
            }
        }
     
        public function save_meta_boxes( $post_id )
        {

            if ( array_key_exists( 'wp-jet-skin', $_POST ) ) {

                $data = $_POST['wp-jet-skin'];

                unset( $data['color'] );

                foreach ( $data as $key => $value ) {
                    $data[ $key ][ 'type' ]        = sanitize_text_field( $value['type'] );
                    $data[ $key ][ 'custom_icon' ] = sanitize_text_field( htmlentities( $value['custom_icon'] ) );
                }

                if( ! empty( $_POST['wp-jet-skin']['color'] ) ) {
                    $data['color'] = sanitize_text_field( $_POST['wp-jet-skin']['color'] );
                }

                update_post_meta( $post_id, 'wp-jet-skin-setting', $data );
            }
        }

        public function modify_list_row_actions( $actions, $post ) {

            if ( $post->post_type == "wp-jet-skin" ) {
                $nonce = wp_create_nonce( 'wp-jet-skin-clone-nounce' );
                $actions['clone'] = '<a href="'.esc_attr( admin_url( 'admin-post.php?action=wp_jet_skin_clone&post_id='.$post->ID.'&_wpnonce='. $nonce ) ).'">'.__( 'Clone', 'wp-jet-player' ).'</a>';
                unset( $actions['view'] );
                unset( $actions['inline hide-if-no-js'] );
            }
         
            return $actions;
        }

        public function wp_jet_skin_clone() {
            
            if ( ! array_key_exists( 'post_id', $_GET ) || ! array_key_exists( '_wpnonce', $_GET ) ) return;

            if( ! wp_verify_nonce( $_GET['_wpnonce'], 'wp-jet-skin-clone-nounce' ) ) return;
            
            $skin_id = intval( $_GET['post_id'] );
            $skin = get_post( $skin_id );

            $clone_skin_arr = array(
                'post_author'           => get_current_user_id(),
                'post_title'            => $skin->post_title,
                'post_status'           => 'draft',
                'post_type'             => 'wp-jet-skin',
                'meta_input'   => array(
                    'wp-jet-skin-setting' => get_post_meta( $skin_id, 'wp-jet-skin-setting', true ),
                ),
            );

            $cloned_post_id = wp_insert_post( $clone_skin_arr, true );

            if( ! is_wp_error( $cloned_post_id ) ){
                
                $post_id = wp_update_post( array(
                    'ID' => $cloned_post_id,
                    'post_title' => $skin->post_title.'_'.$cloned_post_id 
                ), true );    

            }

            wp_redirect( admin_url('edit.php?post_type=wp-jet-skin') );
            die();
            
        }

    }
endif;

function wp_jet_skin_module() {
    return WP_Jet_Skin_Module::instance();
}
wp_jet_skin_module();