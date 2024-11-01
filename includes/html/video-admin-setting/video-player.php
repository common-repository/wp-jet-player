<?php if ( ! defined( 'WP_JET_PLAYER_VERSION' ) ) exit ?>
<table class="jet-player-setting-tbl">
    <tr>
        <td>
            <table class="wp-jet-video-row">
                <tr>
                    <td class="first">
                        <label>Select Video Player:</label>
                    </td>
                    <td>
                        <p class="description">
                            <select name="wp-jet-video[player]" id="wp-jet-video[player]">
                                <?php foreach ($players as $player) :?>
                                <option value="<?php echo $player->ID; ?>" <?php selected( set_value( $data, 'player', '' ), $player->ID ); ?>>
                                    <?php echo $player->post_title; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>