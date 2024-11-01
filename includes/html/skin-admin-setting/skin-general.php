<?php if ( ! defined( 'WP_JET_PLAYER_VERSION' ) ) exit ?>
<table class="jet-player-setting-tbl wp-jet-skin-tbl">
    <tr>
        <td>
            <label for="wp-jet-skin-basic">Color:</label>
        </td>
        <td>
            <p>
                <input type="color" name="wp-jet-skin[color]" id="wp-jet-skin[color]" value="<?php echo set_value( $data, 'color', '#ffad00' ); ?>">
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <label for="wp-jet-skin-basic">Loading Icon:</label>
        </td>
        <td>
            <p>
                <input type="radio" name="wp-jet-skin[loading][type]" id="loading-def" value="default" checked="checked">
                <label for="loading-def">Default</label>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="wp-jet-skin[loading][type]" id="loading-cus" value="custom" <?php checked( set_value( $data, 'loading', '', 'type' ), 'custom' ); ?>>
                <label for="loading-cus">Custom</label><br>
                <input type="text" <?php echo set_value( $data, 'loading', '', 'type' ) != 'custom' ? 'readonly' : ''; ?> name="wp-jet-skin[loading][custom_icon]" id="loading-custom_icon" value="<?php echo set_value( $data, 'loading', '', 'custom_icon' ); ?>">
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <label for="wp-jet-skin-basic">Play Icon:</label>
        </td>
        <td>
            <p>
                <input type="radio" name="wp-jet-skin[play][type]" id="play-def" value="default" checked="checked">
                <label for="play-def">Default</label>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="wp-jet-skin[play][type]" id="play-cus" value="custom" <?php checked( set_value( $data, 'play', '', 'type' ), 'custom' ); ?>>
                <label for="play-cus">Custom</label><br>
                <input type="text" <?php echo set_value( $data, 'play', '', 'type' ) != 'custom' ? 'readonly' : ''; ?> name="wp-jet-skin[play][custom_icon]" id="play-custom_icon" value="<?php echo set_value( $data, 'play', '', 'custom_icon' ); ?>">
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <label for="wp-jet-skin-basic">Pause Icon:</label>
        </td>
        <td>
            <p>
                <input type="radio" name="wp-jet-skin[pause][type]" id="pause-def" value="default" checked="checked">
                <label for="pause-def">Default</label>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="wp-jet-skin[pause][type]" id="pause-cus" value="custom" <?php checked( set_value( $data, 'pause', '', 'type' ), 'custom' ); ?>>
                <label for="pause-cus">Custom</label><br>
                <input type="text" <?php echo set_value( $data, 'pause', '', 'type' ) != 'custom' ? 'readonly' : ''; ?> name="wp-jet-skin[pause][custom_icon]" id="pause-custom_icon" value="<?php echo set_value( $data, 'pause', '', 'custom_icon' ); ?>">
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <label for="wp-jet-skin-basic">Volume Icon:</label>
        </td>
        <td>
            <p>
                <input type="radio" name="wp-jet-skin[volume][type]" id="volume-def" value="default" checked="checked">
                <label for="volume-def">Default</label>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="wp-jet-skin[volume][type]" id="volume-cus" value="custom" <?php checked( set_value( $data, 'volume', '', 'type' ), 'custom' ); ?>>
                <label for="volume-cus">Custom</label><br>
                <input type="text" <?php echo set_value( $data, 'volume', '', 'type' ) != 'custom' ? 'readonly' : ''; ?> name="wp-jet-skin[volume][custom_icon]" id="volume-custom_icon" value="<?php echo set_value( $data, 'volume', '', 'custom_icon' ); ?>">
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <label for="wp-jet-skin-basic">Mute Icon:</label>
        </td>
        <td>
            <p>
                <input type="radio" name="wp-jet-skin[volumeClose][type]" id="volumeClose-def" value="default" checked="checked">
                <label for="volumeClose-def">Default</label>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="wp-jet-skin[volumeClose][type]" id="volumeClose-cus" value="custom" <?php checked( set_value( $data, 'volumeClose', '', 'type' ), 'custom' ); ?>>
                <label for="volumeClose-cus">Custom</label><br>
                <input type="text" <?php echo set_value( $data, 'volumeClose', '', 'type' ) != 'custom' ? 'readonly' : ''; ?> name="wp-jet-skin[volumeClose][custom_icon]" id="volumeClose-custom_icon" value="<?php echo set_value( $data, 'volumeClose', '', 'custom_icon' ); ?>">
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <label for="wp-jet-skin-basic">Subtitle Icon:</label>
        </td>
        <td>
            <p>
                <input type="radio" name="wp-jet-skin[subtitle][type]" id="subtitle-def" value="default" checked="checked">
                <label for="subtitle-def">Default</label>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="wp-jet-skin[subtitle][type]" id="subtitle-cus" value="custom" <?php checked( set_value( $data, 'subtitle', '', 'type' ), 'custom' ); ?>>
                <label for="subtitle-cus">Custom</label><br>
                <input type="text" <?php echo set_value( $data, 'subtitle', '', 'type' ) != 'custom' ? 'readonly' : ''; ?> name="wp-jet-skin[subtitle][custom_icon]" id="subtitle-custom_icon" value="<?php echo set_value( $data, 'subtitle', '', 'custom_icon' ); ?>">
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <label for="wp-jet-skin-basic">Screenshot Icon:</label>
        </td>
        <td>
            <p>
                <input type="radio" name="wp-jet-skin[screenshot][type]" id="screenshot-def" value="default" checked="checked">
                <label for="screenshot-def">Default</label>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="wp-jet-skin[screenshot][type]" id="screenshot-cus" value="custom" <?php checked( set_value( $data, 'screenshot', '', 'type' ), 'custom' ); ?>>
                <label for="screenshot-cus">Custom</label><br>
                <input type="text" <?php echo set_value( $data, 'screenshot', '', 'type' ) != 'custom' ? 'readonly' : ''; ?> name="wp-jet-skin[screenshot][custom_icon]" id="screenshot-custom_icon" value="<?php echo set_value( $data, 'screenshot', '', 'custom_icon' ); ?>">
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <label for="wp-jet-skin-basic">Setting Icon:</label>
        </td>
        <td>
            <p>
                <input type="radio" name="wp-jet-skin[setting][type]" id="setting-def" value="default" checked="checked">
                <label for="setting-def">Default</label>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="wp-jet-skin[setting][type]" id="setting-cus" value="custom" <?php checked( set_value( $data, 'setting', '', 'type' ), 'custom' ); ?>>
                <label for="setting-cus">Custom</label><br>
                <input type="text" <?php echo set_value( $data, 'setting', '', 'type' ) != 'custom' ? 'readonly' : ''; ?> name="wp-jet-skin[setting][custom_icon]" id="setting-custom_icon" value="<?php echo set_value( $data, 'setting', '', 'custom_icon' ); ?>">
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <label for="wp-jet-skin-basic">Fullscreen Icon:</label>
        </td>
        <td>
            <p>
                <input type="radio" name="wp-jet-skin[fullscreen][type]" id="fullscreen-def" value="default" checked="checked">
                <label for="fullscreen-def">Default</label>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="wp-jet-skin[fullscreen][type]" id="fullscreen-cus" value="custom" <?php checked( set_value( $data, 'fullscreen', '', 'type' ), 'custom' ); ?>>
                <label for="fullscreen-cus">Custom</label><br>
                <input type="text" <?php echo set_value( $data, 'fullscreen', '', 'type' ) != 'custom' ? 'readonly' : ''; ?> name="wp-jet-skin[fullscreen][custom_icon]" id="fullscreen-custom_icon" value="<?php echo set_value( $data, 'fullscreen', '', 'custom_icon' ); ?>">
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <label for="wp-jet-skin-basic">FullscreenWeb Icon:</label>
        </td>
        <td>
            <p>
                <input type="radio" name="wp-jet-skin[fullscreenWeb][type]" id="fullscreenWeb-def" value="default" checked="checked">
                <label for="fullscreenWeb-def">Default</label>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="wp-jet-skin[fullscreenWeb][type]" id="fullscreenWeb-cus" value="custom" <?php checked( set_value( $data, 'fullscreenWeb', '', 'type' ), 'custom' ); ?>>
                <label for="fullscreenWeb-cus">Custom</label><br>
                <input type="text" <?php echo set_value( $data, 'fullscreenWeb', '', 'type' ) != 'custom' ? 'readonly' : ''; ?> name="wp-jet-skin[fullscreenWeb][custom_icon]" id="fullscreenWeb-custom_icon" value="<?php echo set_value( $data, 'fullscreenWeb', '', 'custom_icon' ); ?>">
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <label for="wp-jet-skin-basic">PIP Icon:</label>
        </td>
        <td>
            <p>
                <input type="radio" name="wp-jet-skin[pip][type]" id="pip-def" value="default" checked="checked">
                <label for="pip-def">Default</label>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="wp-jet-skin[pip][type]" id="pip-cus" value="custom" <?php checked( set_value( $data, 'pip', '', 'type' ), 'custom' ); ?>>
                <label for="pip-cus">Custom</label><br>
                <input type="text" <?php echo set_value( $data, 'pip', '', 'type' ) != 'custom' ? 'readonly' : ''; ?> name="wp-jet-skin[pip][custom_icon]" id="pip-custom_icon" value="<?php echo set_value( $data, 'pip', '', 'custom_icon' ); ?>">
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <label for="wp-jet-skin-basic">Prev Icon:</label>
        </td>
        <td>
            <p>
                <input type="radio" name="wp-jet-skin[prev][type]" id="prev-def" value="default" checked="checked">
                <label for="prev-def">Default</label>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="wp-jet-skin[prev][type]" id="prev-cus" value="custom" <?php checked( set_value( $data, 'prev', '', 'type' ), 'custom' ); ?>>
                <label for="prev-cus">Custom</label><br>
                <input type="text" <?php echo set_value( $data, 'prev', '', 'type' ) != 'custom' ? 'readonly' : ''; ?> name="wp-jet-skin[prev][custom_icon]" id="prev-custom_icon" value="<?php echo set_value( $data, 'prev', '', 'custom_icon' ); ?>">
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <label for="wp-jet-skin-basic">Next Icon:</label>
        </td>
        <td>
            <p>
                <input type="radio" name="wp-jet-skin[next][type]" id="next-def" value="default" checked="checked">
                <label for="next-def">Default</label>&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="wp-jet-skin[next][type]" id="next-cus" value="custom" <?php checked( set_value( $data, 'next', '', 'type' ), 'custom' ); ?>>
                <label for="next-cus">Custom</label><br>
                <input type="text" <?php echo set_value( $data, 'next', '', 'type' ) != 'custom' ? 'readonly' : ''; ?> name="wp-jet-skin[next][custom_icon]" id="next-custom_icon" value="<?php echo set_value( $data, 'next', '', 'custom_icon' ); ?>">
            </p>
        </td>
    </tr>
</table>