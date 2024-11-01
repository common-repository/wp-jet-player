<?php if ( ! defined( 'WP_JET_PLAYER_VERSION' ) ) exit ?>
<table class="jet-player-setting-tbl">
    <tbody>
        <tr>
            <td>
                <table class="wp-jet-video-row">
                    <?php

                    $video_src     = array('');
                    $video_quality = array('');

                    if ( isset( $data['video']['src'] ) && count( $data['video']['src'] ) > 0 ) {
                        $video_src     = $data['video']['src'];
                        $video_quality = $data['video']['quality'];
                    }
                    foreach ( $video_src as $key => $value ) :?>
                        <tr>
                            <td class="first">
                                <label>Video:</label>
                            </td>
                            <td>
                                <p class="description">
                                <?php
                                    wp_jet_media_field( 'input', $value, 'wp-jet-video[video][src][]', 'Add Video', 33, 0, 'Add Video', 'Select Video', array( 'video' )  );?>
                                    <input type="text" size="25" name="wp-jet-video[video][quality][]" placeholder="Quality Label e.g HD 720P" value="<?php echo $video_quality[$key] ?>">
                                    <a href="#add-quality" class="wp-jet-add-quality">Add another Quality</a>
                                    &nbsp;
                                    <a href="#remove-quality" class="wp-jet-remove-quality">Remove Quality</a>
                                </p>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table class="wp-jet-video-row">
                    <tr>
                        <td class="first">
                            <label>Splash Image:</label>
                        </td>
                        <td>
                            <p class="description">
                            <?php 
                                wp_jet_media_field( 'img', set_value( $data, 'splashImage', '' ) , 'wp-jet-video[splashImage]', 'Add Image', 115, 115, 'Add Splash Image', 'Select Splash Image', array( 'image' )  ); 
                            ?>
                            </p>
                        </td>
                    </tr>
                    <tr style="display: none;">
                        <td class="first">
                            <label>Splash Text:</label>
                        </td>
                        <td>
                            <p class="description">
                                <input type="text" name="wp-jet-video[splashText]" id="wp-jet-video[splashText]" value="<?php echo set_value( $data, 'splashText', '' ); ?>" size="48">
                            </p>
                        </td>
                    </tr>
                    <tr style="display: none;">
                        <td class="first">
                            <label>Description:</label>
                        </td>
                        <td>
                            <p class="description">
                                <textarea name="wp-jet-video[description]" id="wp-jet-video[description]" rows="4" cols="50"><?php echo set_value( $data, 'description', '' ); ?></textarea>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>