<?php if ( ! defined( 'WP_JET_PLAYER_VERSION' ) ) exit ?>
<table class="jet-player-setting-tbl">
    <tr>
        <td>
            <table class="wp-jet-video-row">
                <?php

                $subtitle_file  = array('');
                $subtitle_label = array('');

                if ( isset( $data['subtitle']['file'] ) && count( $data['subtitle']['file'] ) > 0 ) {
                    $subtitle_file  = $data['subtitle']['file'];
                    $subtitle_label = $data['subtitle']['label'];
                }
                foreach ( $subtitle_file as $key => $value ) :?>
                <tr>
                    <td class="first">
                        <label>Select Subtitle File:</label>
                    </td>
                    <td>
                        <p class="description">
                        <?php 
                            wp_jet_media_field( 'input', $value, 'wp-jet-video[subtitle][file][]', 'Add File', 33, 0, 'Add Subtitle File', 'Select File' ); 
                        ?>
                            <input type="text" size="25" name="wp-jet-video[subtitle][label][]" placeholder="Subtitle Label e.g English" value="<?php echo $subtitle_label[$key] ?>">
                        </p>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </td>
    </tr>
</table>