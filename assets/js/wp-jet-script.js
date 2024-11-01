var wp_jet_players = [];

jQuery(function($) {
    $(document).ready(function(){
        if( wp_jet_player_data.videos.constructor === Object && Object.entries(wp_jet_player_data.videos).length > 0 ) {
            
            var wp_jet_videos  = wp_jet_player_data.videos;

            $.each(wp_jet_player_data.videos, function(index, ele){

                if ( $('#'+index).length > 0 && ele.video.videos[0].url != undefined && ele.video.videos[0].url != '' ) {

                    wp_jet_players[index] = new Artplayer( populate_video( index, ele ) );
                    wp_jet_players[index].whitelist.isMobile = false;
                
                }
            }); 

        }
    });

    function populate_video( element, data ) {
        var video_obj = {};
        video_obj.container = '#'+element;
        video_obj.whitelist = ['Android', 'webOS', 'iPhone', 'iPad', 'iPod', 'BlackBerry', 'IEMobile', 'Opera Mini'],
        video_obj.url       = data.video.videos[0].url;

        if ( data.video.videos.length > 1 ) 
        {
            video_obj.quality = [];
            jQuery.each( data.video.videos, function( index, ele ){
                video_obj.quality[index] = {
                    name: ele.quality,
                    url: ele.url 
                };
                if( index == 0 ) video_obj.quality[0].default = true;
            });
        }

        if ( data.video.subtitles.length > 0 ) 
        {
            video_obj.subtitle = {
                url: data.video.subtitles[0].url,
                style: {
                    color: '#000000',
                },
            };
        }

        video_obj.icons = {}

        if ( data.skin.color != undefined && data.skin.color != '' )
            video_obj.theme = data.skin.color;
        
        if ( data.player.logo_url != undefined && data.player.logo_url != '' )
            video_obj.icons.state = '<img src="'+data.player.logo_url+'" width="100">';

        if ( data.skin.loading.type != undefined && data.skin.loading.type == 'custom' ) {
            video_obj.icons.loading = $('<textarea />').html( data.skin.loading.custom_icon ).text();
        }
        if ( data.skin.play.type != undefined && data.skin.play.type == 'custom' ) {
            video_obj.icons.play = $('<textarea />').html( data.skin.play.custom_icon ).text();
        }
        if ( data.skin.pause.type != undefined && data.skin.pause.type == 'custom' ) {
            video_obj.icons.pause = $('<textarea />').html( data.skin.pause.custom_icon ).text();
        }
        if ( data.skin.volume.type != undefined && data.skin.volume.type == 'custom' ) {
            video_obj.icons.volume = $('<textarea />').html( data.skin.volume.custom_icon ).text();
        }
        if ( data.skin.volumeClose.type != undefined && data.skin.volumeClose.type == 'custom' ) {
            video_obj.icons.volumeClose = $('<textarea />').html( data.skin.volumeClose.custom_icon ).text();
        }
        if ( data.skin.subtitle.type != undefined && data.skin.subtitle.type == 'custom' ) {
            video_obj.icons.subtitle = $('<textarea />').html( data.skin.subtitle.custom_icon ).text();
        }
        if ( data.skin.screenshot.type != undefined && data.skin.screenshot.type == 'custom' ) {
            video_obj.icons.screenshot = $('<textarea />').html( data.skin.screenshot.custom_icon ).text();
        }
        if ( data.skin.setting.type != undefined && data.skin.setting.type == 'custom' ) {
            video_obj.icons.setting = $('<textarea />').html( data.skin.setting.custom_icon ).text();
        }
        if ( data.skin.fullscreen.type != undefined && data.skin.fullscreen.type == 'custom' ) {
            video_obj.icons.fullscreen = $('<textarea />').html( data.skin.fullscreen.custom_icon ).text();
        }
        if ( data.skin.fullscreenWeb.type != undefined && data.skin.fullscreenWeb.type == 'custom' ) {
            video_obj.icons.fullscreenWeb = $('<textarea />').html( data.skin.fullscreenWeb.custom_icon ).text();
        }
        if ( data.skin.pip.type != undefined && data.skin.pip.type == 'custom' ) {
            video_obj.icons.pip = $('<textarea />').html( data.skin.pip.custom_icon ).text();
        }
        if ( data.skin.prev.type != undefined && data.skin.prev.type == 'custom' ) {
            video_obj.icons.prev = $('<textarea />').html( data.skin.prev.custom_icon ).text();
        }
        if ( data.skin.next.type != undefined && data.skin.next.type == 'custom' ) {
            video_obj.icons.next = $('<textarea />').html( data.skin.next.custom_icon ).text();
        }

        video_obj.title           = data.video.title;
        video_obj.poster          = data.video.splash_image_url;
        video_obj.volume          = data.player.volume_level / 100;
        video_obj.setting         = set_bool( data.player.is_setting );
        video_obj.pip             = set_bool( data.player.is_mini_player );
        video_obj.autoPip         = set_bool( data.player.is_auto_miniscreen );
        video_obj.aspectRatio     = set_bool( data.player.is_screen_ratio );
        video_obj.playbackRate    = set_bool( data.player.is_speed );
        video_obj.muted           = set_bool( data.player.is_muted );
        video_obj.screenshot      = set_bool( data.player.is_screenshot );
        video_obj.flip            = set_bool( data.player.is_flip );
        video_obj.fullscreen      = set_bool( data.player.is_fullscreen );
        video_obj.fullscreenWeb   = set_bool( data.player.is_web_fullscreen );
        video_obj.miniProgressBar = set_bool( data.player.is_mini_scrollbar );

        return video_obj;
    }

});

function set_bool( data ) {
    return data == 'true' ? true : false;
}