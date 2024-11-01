<?php if ( ! defined( 'WP_JET_PLAYER_VERSION' ) ) exit ?>
<table class="jet-player-setting-tbl">
    <tbody>
        <tr>
            <td class="first">
                <label for="wp-jet-player[skin]">Select skin:</label>
            </td>
            <td>
                <p class="description">
                    <select name="wp-jet-player[skin]" id="wp-jet-player[skin]">
                        <?php foreach ($skins as $skin) :?>
                        <option value="<?php echo $skin->ID; ?>" <?php selected( set_value( $data, 'skin', '' ), $skin->ID ); ?>>
                            <?php echo $skin->post_title; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </p>
            </td>
        </tr>
        <tr style="display: none;">
            <td class="first">
                <label for="wp-jet-player[controllbar]">Controllbar:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[controllbar]" value="false">
                    <input type="checkbox" name="wp-jet-player[controllbar]" value="true" id="wp-jet-player[controllbar]" <?php checked( set_value( $data, 'controllbar', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr style="display: none;">
            <td class="first">
                <label for="wp-jet-player[controllbarVisible]">Controllbar always visible:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[controllbarVisible]" value="false">
                    <input type="checkbox" name="wp-jet-player[controllbarVisible]" id="wp-jet-player[controllbarVisible]" value="true" <?php checked( set_value( $data, 'controllbarVisible', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr>
            <td class="first">
                <label for="wp-jet-player[setting]">Setting button:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[setting]" value="false">
                    <input type="checkbox" name="wp-jet-player[setting]" value="true" id="wp-jet-player[setting]" <?php checked( set_value( $data, 'setting', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr style="display: none;">
            <td class="first">
                <label for="wp-jet-player[embed]">Embed button:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[embed]" value="false">
                    <input type="checkbox" name="wp-jet-player[embed]" value="true" id="wp-jet-player[embed]"  <?php checked( set_value( $data, 'embed', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr style="display: none;">
            <td class="first">
                <label for="wp-jet-player[sharing]">Sharing buttons:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[sharing]" value="false">
                    <input type="checkbox" name="wp-jet-player[sharing]" value="true" id="wp-jet-player[sharing]" <?php checked( set_value( $data, 'sharing', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr style="display: none;">
            <td class="first">
                <label for="wp-jet-player[link]">Video link button:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[link]" value="false">
                    <input type="checkbox" name="wp-jet-player[link]" value="true" id="wp-jet-player[link]" <?php checked( set_value( $data, 'link', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr style="display: none;">
            <td class="first">
                <label for="wp-jet-player[volume]">Volume option:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[volume]" value="false">
                    <input type="checkbox" name="wp-jet-player[volume]" value="true" id="wp-jet-player[volume]" <?php checked( set_value( $data, 'volume', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr>
            <td class="first">
                <label for="wp-jet-player[volumeLevel]">Default Volume Level:</label>
            </td>
            <td>
                <p class="description">
                    <input type="range" name="wp-jet-player[volumeLevel]" id="wp-jet-player[volumeLevel]" value="<?php echo set_value( $data, 'volumeLevel', 50 ); ?>">
                </p>
            </td>
        </tr>
        <tr>
            <td class="first">
                <label for="wp-jet-player[webFullscreen]">Web fullscreen button:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[webFullscreen]" value="false">
                    <input type="checkbox" name="wp-jet-player[webFullscreen]" value="true" id="wp-jet-player[webFullscreen]" <?php checked( set_value( $data, 'webFullscreen', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr>
            <td class="first">
                <label for="wp-jet-player[fullscreen]">Fullscreen button:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[fullscreen]" value="false">
                    <input type="checkbox" name="wp-jet-player[fullscreen]" value="true" id="wp-jet-player[fullscreen]" <?php checked( set_value( $data, 'fullscreen', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr>
            <td class="first">
                <label for="wp-jet-player[miniPlayer]">Mini player button:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[miniPlayer]" value="false">
                    <input type="checkbox" name="wp-jet-player[miniPlayer]" value="true" id="wp-jet-player[miniPlayer]" <?php checked( set_value( $data, 'miniPlayer', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr>
            <td class="first">
                <label for="wp-jet-player[autoMiniscreen]">Auto miniscreen:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[autoMiniscreen]" value="false">
                    <input type="checkbox" name="wp-jet-player[autoMiniscreen]" value="true" id="wp-jet-player[autoMiniscreen]" <?php checked( set_value( $data, 'autoMiniscreen', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr>
            <td class="first">
                <label for="wp-jet-player[screenshot]">Take a screenshot button:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[screenshot]" value="false">
                    <input type="checkbox" name="wp-jet-player[screenshot]" value="true" id="wp-jet-player[screenshot]" <?php checked( set_value( $data, 'screenshot', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr style="display: none;">
            <td class="first">
                <label for="wp-jet-player[play]">Play/Pause button:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[play]" value="false">
                    <input type="checkbox" name="wp-jet-player[play]" value="true" id="wp-jet-player[play]" <?php checked( set_value( $data, 'play', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr style="display: none;">
            <td class="first">
                <label for="wp-jet-player[repeat]">Repeat button:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[repeat]" value="false">
                    <input type="checkbox" name="wp-jet-player[repeat]" value="true" id="wp-jet-player[repeat]" <?php checked( set_value( $data, 'repeat', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr style="display: none;">
            <td class="first">
                <label for="wp-jet-player[rewind]">Rewind/Forward Button:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[rewind]" value="false">
                    <input type="checkbox" name="wp-jet-player[rewind]" value="true" id="wp-jet-player[rewind]" <?php checked( set_value( $data, 'rewind', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr>
            <td class="first">
                <label for="wp-jet-player[speed]">Speed Option:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[speed]" value="false">
                    <input type="checkbox" name="wp-jet-player[speed]" value="true" id="wp-jet-player[speed]" <?php checked( set_value( $data, 'speed', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr style="display: none;">
            <td class="first">
                <label for="wp-jet-player[speedStep]">Speed step:</label>
            </td>
            <td>
                <p class="description">
                    <select name="wp-jet-player[speedStep]" id="wp-jet-player[speedStep]">
                        <option value="half" <?php selected( set_value( $data, 'speedStep', '' ), 'half' ); ?>>0.5</option>  
                        <option value="one" <?php selected( set_value( $data, 'speedStep', '' ), 'one' ); ?>>1</option>    
                    </select>
                </p>
            </td>
        </tr>
        <tr style="display: none;">
            <td class="first">
                <label for="wp-jet-player[subtitle]">Subtitle button:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[subtitle]" value="false">
                    <input type="checkbox" name="wp-jet-player[subtitle]" value="true" id="wp-jet-player[subtitle]" <?php checked( set_value( $data, 'subtitle', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr style="display: none;">
            <td class="first">
                <label for="wp-jet-player[subtitleEnable]">Subtitle on by default:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[subtitleEnable]" value="false">
                    <input type="checkbox" name="wp-jet-player[subtitleEnable]" value="true" id="wp-jet-player[subtitleEnable]" <?php checked( set_value( $data, 'subtitleEnable', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr style="display: none;">
            <td class="first">
                <label for="wp-jet-player[rememberPosition]">Remember video position:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[rememberPosition]" value="false">
                    <input type="checkbox" name="wp-jet-player[rememberPosition]" value="true" id="wp-jet-player[rememberPosition]" <?php checked( set_value( $data, 'rememberPosition', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr style="display: none;">
            <td class="first">
                <label>Default video size:</label>
            </td>
            <td>
                <p class="description">
                    <label for="wp-jet-player[width]">Width:</label>&nbsp;
                    <input type="text" class="small" name="wp-jet-player[width]" id="wp-jet-player[width]" value="<?php echo set_value( $data, 'width', 640 ); ?>" maxlength="4" size="4">
                    <label for="wp-jet-player[height]">Height:</label>&nbsp;
                    <input type="text" class="small" name="wp-jet-player[height]" id="wp-jet-player[height]" value="<?php echo set_value( $data, 'height', 360 ); ?>" maxlength="4" size="4">
                    Enter values in pixels or 100%.                
                </p>
            </td>
        </tr>
        <tr>
            <td class="first">
                <label for="wp-jet-player[logo]">Logo:</label>
            </td>
            <td>
                <p class="description">
                    <?php wp_jet_media_field( 'img', set_value( $data, 'logo', '' ) , 'wp-jet-player[logo]', 'Add Image', 115, 115, 'Add Logo', 'Select Logo', array( 'image' ) ); ?>
                </p>
            </td>
        </tr>
        <tr style="display: none;">
            <td class="first">
                <label for="wp-jet-player[logoPosition]">Logo position:</label>
            </td>
            <td>
                <p class="description">
                    <select name="wp-jet-player[logoPosition]" id="wp-jet-player[logoPosition]">
                        <option value="bottom-right" <?php selected( set_value( $data, 'logoPosition', '' ), 'bottom-right' ); ?>>Bottom Right</option>  
                        <option value="bottom-left" <?php selected( set_value( $data, 'logoPosition', '' ), 'bottom-left' ); ?>>Bottom Left</option>    
                        <option value="top-right" <?php selected( set_value( $data, 'logoPosition', '' ), 'top-right' ); ?>>Top Right</option>    
                        <option value="top-left" <?php selected( set_value( $data, 'logoPosition', '' ), 'top-left' ); ?>>Top Left</option>    
                    </select>
                </p>
            </td>
        </tr>
        <tr style="display: none;">
            <td class="first">
                <label for="wp-jet-player[videoLength]">Video length Visible:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[videoLength]" value="false">
                    <input type="checkbox" name="wp-jet-player[videoLength]" value="true" id="wp-jet-player[videoLength]" <?php checked( set_value( $data, 'videoLength', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr>
            <td class="first">
                <label for="wp-jet-player[ratio]">Screen ratio option:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[ratio]" value="false">
                    <input type="checkbox" name="wp-jet-player[ratio]" value="true" id="wp-jet-player[ratio]"  <?php checked( set_value( $data, 'ratio', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr>
            <td class="first">
                <label for="wp-jet-player[flip]">Flip video button:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[flip]" value="false">
                    <input type="checkbox" name="wp-jet-player[flip]" value="true" id="wp-jet-player[flip]" <?php checked( set_value( $data, 'flip', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr style="display: none;">
            <td class="first">
                <label for="wp-jet-player[quality]">Quality button:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[quality]" value="false">
                    <input type="checkbox" name="wp-jet-player[quality]" value="true" id="wp-jet-player[quality]" <?php checked( set_value( $data, 'quality', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr>
            <td class="first">
                <label for="wp-jet-player[muted]">Muted:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[muted]" value="false">
                    <input type="checkbox" name="wp-jet-player[muted]" value="true" id="wp-jet-player[muted]" <?php checked( set_value( $data, 'muted', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
        <tr>
            <td class="first">
                <label for="wp-jet-player[miniScrollbar]">Mini scrollbar:</label>
            </td>
            <td>
                <p class="description">
                    <input type="hidden" name="wp-jet-player[miniScrollbar]" value="false">
                    <input type="checkbox" name="wp-jet-player[miniScrollbar]" value="true" id="wp-jet-player[miniScrollbar]" <?php checked( set_value( $data, 'miniScrollbar', '' ), 'true' ); ?>>
                </p>
            </td>
        </tr>
    </tbody>
</table>