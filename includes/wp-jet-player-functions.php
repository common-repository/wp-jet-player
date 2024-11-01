<?php
if ( ! defined( 'WP_JET_PLAYER_VERSION' ) ) exit;

/**
 * Image Uploader 
 * @version 1.0
 */
if ( ! function_exists( 'wp_jet_image_uploader' ) ) :
	function wp_jet_image_uploader( $option_value, $option_name, $name, $width = 0, $height = 0, $frame_title = 'Add Media', $button_text = 'Select', $file_types = array('image', 'video') ) {

	    $default_image = WP_JET_PLAYER_ASSET.'images/default_logo.png';

	    if ( !empty( $option_value ) ) {
	        $image_attributes = wp_get_attachment_image_src( $option_value, array( $width, $height ) );
	        $src = $image_attributes[0];
	        $value = $option_value;
	    } else {
	        $src = $default_image;
	        $value = '';
	    }


	    // Print HTML field
	    echo '
	        <div class="upload">
	            <img data-src="' . $default_image . '" src="' . $src . '" width="' . $width . 'px" height="' . $height . 'px" />
	            <div>
	                <input type="hidden" name="'. $option_name .'[' . $name . ']" id="'. $option_name .'[' . $name . ']" value="' . $value . '" />
	                <button type="button" class="upload_image_button button" data-frametitle="'. $frame_title .'" data-framebutton="'. $button_text .'" data-frametypes="'. $types .'" >' . $text . '</button>
	                <button type="button" class="remove_image_button button">&times;</button>
	            </div>
	        </div>
	    ';

	}
endif;

//types (input, img)
//wp_jet_media_field( 'input', $data['logo'], "wp-jet-player['logo']", 'Add Video')
if ( ! function_exists( 'wp_jet_media_field' ) ) :
	function wp_jet_media_field( $type, $meta_value, $meta_key, $button_text = 'Upload', $width = 0, $height = 0, $frame_title = 'Add Media', $frame_button = 'Select', $file_types = null ) {

		$deault_url = ( ( $type == 'img' ) ? WP_JET_PLAYER_ASSET.'images/default_logo.png' : '' );

		if ( !empty( $meta_value ) ) {
			if ( $type == 'img' ) {
				$url = wp_get_attachment_image_src( $meta_value, array( $width, $height ) )[0];
			}
			else {
				$url =  wp_get_attachment_url( $meta_value );
			}
		}
		else {
			$url = $deault_url;
		}

	    $file_types = str_replace( '"' , "'", json_encode( $file_types ) );

	    // Print HTML field
	    echo '
	        <div class="wp-jet-upload-media">
	            '. ( $type == 'img' ? 
	            	'<img data-src="' . $deault_url . '" src="' . $url . '" width="' . $width . 'px" height="' . $height . 'px" class="wp-jet-media-field" />' : 
	            	'<input type="text" readonly value="' . $url . '" class="wp-jet-media-field" size="'. $width .'" />' ) .'
	            <div>
	                <input type="hidden" name="'. $meta_key. '" id="'. $meta_key. '" value="' . $meta_value . '" />
	                <button type="button" class="wp-jet-upload-image-button button" data-type="'. $type .'" data-frametitle="'. $frame_title .'" data-framebutton="'. $frame_button .'" data-frametypes="'. $file_types .'" >' . $button_text . '</button>
	                '. ( $type == 'img' ? '<button type="button" class="wp-jet-remove-image-button button">&times;</button>' : '' ) .'
	            </div>
	        </div>
	    ';

	}
endif;

if ( ! function_exists( 'set_value' ) ) :
	function set_value( $var, $index, $default, $subindex = null ) {

		if ( $subindex == null ) {
			return ( ( isset( $var[$index] ) && $var[$index] != '' ) ? $var[$index] : $default );
		}
		else {
			return ( ( isset( $var[$index] ) && isset( $var[$index][$subindex] ) && $var[$index][$subindex] != '' ) ? $var[$index][$subindex] : $default );
		}

	}
endif;


if ( ! function_exists( 'set_meta_defaut_values' ) ) :
	function set_meta_defaut_values( $setting ) 
    {
        return shortcode_atts ( 
            array (
                'title'         => 'Custom Meta Box', 
                'callback'      => array( 'WP_Jet_Player_HTML', 'empty_setting' ),
                'context'       => 'advanced',
                'priority'      => 'default',
                'callback_args' => null
            ),
            $setting
        );
    }
endif;


if ( ! function_exists( 'jet_isset' ) ) :
	function jet_isset( $left_exp, $right_exp, $if_return, $else_return )
    {
        if ( isset( $left_exp ) && $left_exp == $right_exp ) {
        	return $if_return;
        }
        else {
        	return $else_return;
        }
    }
endif;


if ( ! function_exists( 'wp_jet_default_posts' ) ) :
	function wp_jet_default_posts()
    {
        $player = get_posts( array( 'numberposts' => 1, 'post_type' => 'wp-jet-player' ) );
		$skin = get_posts( array( 'numberposts' => 1, 'post_type' => 'wp-jet-skin' ) );

		if( empty( $players ) && empty( $skins ) ) {
			$skin_arr = array(
                'post_author' => get_current_user_id(),
                'post_title'  => 'Default Skin',
                'post_status' => 'publish',
                'post_type'   => 'wp-jet-skin',
                'meta_input'  => array(
                    'wp-jet-skin-setting' => array(
						'loading' => array ( 'type' => 'default', 'custom_icon' => '' ),
						'play' => array ( 'type' => 'default', 'custom_icon' => '' ),
					    'pause' => array ( 'type' => 'default', 'custom_icon' => '' ),
						'volume' => array ( 'type' => 'default', 'custom_icon' => '' ),
						'volumeClose' => array ( 'type' => 'default', 'custom_icon' => '' ),
						'subtitle' => array ( 'type' => 'default', 'custom_icon' => '' ),
						'screenshot' => array ( 'type' => 'default', 'custom_icon' => '' ),
						'setting' => array ( 'type' => 'default', 'custom_icon' => '' ),
						'fullscreen' => array ( 'type' => 'default', 'custom_icon' => '' ),
						'fullscreenWeb' =>array ( 'type' => 'default', 'custom_icon' => '' ),
						'pip' => array ( 'type' => 'default', 'custom_icon' => '' ),
						'prev' => array ( 'type' => 'default', 'custom_icon' => '' ),
						'next' => array ( 'type' => 'default', 'custom_icon' => '' ),
						'color' => '#ffad00'
                    ),
                ),
            );

            $skin_id = wp_insert_post( $skin_arr, true );

            if( ! is_wp_error( $skin_id ) ){
                $player_arr = array(
	                'post_author' => get_current_user_id(),
	                'post_title'  => 'Default Player',
	                'post_status' => 'publish',
	                'post_type'   => 'wp-jet-player',
	                'meta_input'  => array(
	                    'wp-jet-player-setting' => array(
							'skin' => $skin_id,
						    'controllbar' => 'false',
						    'controllbarVisible' => 'false',
						    'setting' => 'true',
						    'embed' => 'false',
						    'sharing' => 'false',
						    'link' => 'false',
						    'volume' => 'false',
						    'volumeLevel' => '50',
						    'webFullscreen' => 'true',
						    'fullscreen' => 'true',
						    'miniPlayer' => 'true',
						    'autoMiniscreen' => 'true',
						    'screenshot' => 'false',
						    'play' => 'false',
						    'repeat' => 'false',
						    'rewind' => 'false',
						    'speed' => 'true',
						    'speedStep' => 'half',
						    'subtitle' => 'false',
						    'subtitleEnable' => 'false',
						    'rememberPosition' => 'false',
						    'width' => '640',
						    'height' => '360',
						    'logo' => '',
						    'logoPosition' => 'bottom-right',
						    'videoLength' => 'false',
						    'ratio' => 'false',
						    'flip' => 'false',
						    'quality' => 'false',
						    'muted' => 'false',
						    'miniScrollbar' => 'true'
	                    ),
	                ),
	            );
	            wp_insert_post( $player_arr );
            }
		}
    }
endif;