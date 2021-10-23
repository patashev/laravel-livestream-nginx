
function loadVideoJsModal( modalWindowid ){
    $( modalWindowid ).on('show.bs.modal', function (event) {
      let button = $(event.relatedTarget);
      let title = button.data('title');
      let modal = $(this);
      modal.find('.modal-title').text(title);
      let node = document.createElement("source");
        node.src = button.data('video_url');
        node.type = 'application/x-mpegURL';
      let container = modal.find('.modal-body .media-wrapper .live-player');
      video = document.createElement("video");
      video.classList.add('video-js', 'video-js-custom-skin');
      video.setAttribute('id', 'video-js');
      video.setAttribute('style','width:100%;');
      video.setAttribute('controls', 'true');
      video.setAttribute('preload', 'true');

      video.setAttribute('poster', button.data('video_poster'));
      video.append(node);
      videoContainer = container.append(video);
      let player = videojs('video-js',{
          "src": button.data('video_url'),
          "fluid": true,
          "type": "application/x-mpegURL",
          "autoplay" : false,
        });
      if(button.data('sharing') == true){
        getLogo(player);
      }
      if (button.data('with_logo') == true) {
        player.watermark({
              file: '/'+button.data('logo_file_name'),
              xpos: 40,
              ypos: 40,
              width: 90,
              clickable: true,
              url: +button.data('logo_url'),
              xrepeat: 0,
              opacity: (5/10),
              debug: true
          });
      }
    });
    $( modalWindowid ).on('hidden.bs.modal', function () {
      $(this).removeData('bs.modal');
      $( modalWindowid + '.modal-body .media-wrapper .live-player').empty();
       videojs('video-js').dispose();
    });
  }

function getDataTableByVideoModal( modalWindowid ){
    $( modalWindowid ).on('show.bs.modal', function (event) {
      let button = $(event.relatedTarget);
      let table = $('.datatable').dataTable({
          processing: true,
          serverSide: true,
          bServerSide: button.data('modal_destroy'),
          stateSave: true,
          responsive: true,
          preventCache: true,
          bDestroy: button.data('modal_destroy'),
          sDom: "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
              "t" +
              "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
          drawCallback: function(settings) { $('[data-toggle="tooltip"]').tooltip();},
          ajax: { url : button.data('modal_route'), type: button.data('modal_method') },
          columns: [
              { data: 'title', name: 'title', searchable: true },
              { name: 'thumb', data: 'thumb', searchable: false },
              { data: 'checkbox_action', name: 'checkbox_action', orderable: false, searchable: false }
            ]
          });
          $('#bulk_delete_from_playlist').on('click', function(){
            var id = [];
            //url = "/admin/video-records/video-record-playlists/mass_delete";
            if(confirm("Are you sure you want to Remove this videos from playlist?")){
              $('.checkbox_remove_from_playlist_checkbox:checked').each(function(){
                console.log($(this).val());
                id.push($(this).val());
              });
              if(id.length > 0){
                $.ajax({
                  url: button.data('modal_delete_url'),
                  method: "GET",
                  data: { user_id: button.data('user_id'), playlist_id: button.data('playlist_id'), id:id},
                  success:function(data){
                    $('.datatable').DataTable().ajax.reload();
                  }
                });
              }
              else{
                alert("select atleast one");
              }
            }
          });
    });
  }

function getLogo(player){
  player.socialShare({
      facebook: { // optional, includes a Facebook share button (See the [Facebook documentation](https://developers.facebook.com/docs/sharing/reference/share-dialog) for more information)
        shareUrl: '', // optional, defaults to window.location.href
        shareImage: '', // optional, defaults to the Facebook-scraped image
        shareText: '',  // optional
        app_id: '', // optional, facebook app_id to use (if not specified, the plugin will try to
                    // use an existing FB Javascript object, or it will try to scrape the app_id from the
                    // <meta property="fb:app_id"> element in the document
      },
      twitter: { // optional, includes a Twitter share button (See the [Twitter documentation](https://dev.twitter.com/web/tweet-button/web-intent) for more information)
        handle: '', // optional, appends `via @handle` to the end of the tweet
        shareUrl: '', // optional, defaults to window.location.href
        shareText: ''
      },
      embed: { // optional, includes an embed code button
        embedMarkup: player.currentTime() // required
      }
    });
}

function constrainProportions(constrain_proportions, player_width, player_heigh, bootstrap){
  constrain_proportions.on('change', function(){
    if(constrain_proportions.is(':checked')){
      var height = Math.round(player_width.val() * 9/16);
      player_heigh.attr('readonly', true);
      player_heigh.attr('value', height);
    }else{
      if (bootstrap.is(':checked')) {
        player_heigh.attr('readonly', true);
      }else{
        player_heigh.attr('readonly', false);
      }
    }
  })
}

function getBootstrap(sel, player_heigh, player_heigh_hidden, player_width, player_width_hidden){
  if($("#bootstrap").is(':checked')){
    player_heigh.attr('readonly', true);
    player_width.attr('readonly', true);
    player_heigh.attr('value', '405');
    player_width.attr('value', '720');
  } else {
    player_width.attr('readonly', false);
    player_heigh.attr('value', player_heigh_hidden.val());
    player_width.attr('value', player_width_hidden.val());
  }
}

function getPlaylistOptions(sel, videoUrl){
  if($("#playlist").is(':checked')){
    player.playlist([{
      name: 'Disney\'s Oceans 1',
      description: 'Explore',
      duration: 45,
      sources: [
        { src: 'videoUrl', type: 'video/mp4' },
      ],

      // you can use <picture> syntax to display responsive images
      thumbnail: [
        {
          srcset: 'https://www.elegantthemes.com/blog/wp-content/uploads/2020/09/divi-transparent-sticky-global-header-featured-image.jpg',
          type: 'image/png',
          media: '(max-width: 400px;)'
        },
        {
          src: 'https://www.elegantthemes.com/blog/wp-content/uploads/2020/09/divi-transparent-sticky-global-header-featured-image.jpg'
        }
      ]
    },
      {
        name: 'Disney\'s Oceans 2',
        description: 'Explore',
        duration: 45,
        sources: [
          { src: 'http://vjs.zencdn.net/v/oceans.mp4?2', type: 'video/mp4' },
          { src: 'http://vjs.zencdn.net/v/oceans.webm?2', type: 'video/webm' },
        ],

        // you can use <picture> syntax to display responsive images
        thumbnail: [
          {
            srcset: 'https://pluginsmarket.com/wp-content/uploads/edd/2016/06/header-footer-1.jpg',
            type: 'image/jpeg',
            media: '(min-width: 400px;)'
          },
          {
            src: 'https://pluginsmarket.com/wp-content/uploads/edd/2016/06/header-footer-1.jpg'
          }
        ]
      },
      {
        name: 'Disney\'s Oceans 3',
        description: 'Explore',
        duration: 45,
        sources: [
          { src: 'http://vjs.zencdn.net/v/oceans.mp4?3', type: 'video/mp4' },
          { src: 'http://vjs.zencdn.net/v/oceans.webm?3', type: 'video/webm' },
        ],

        // you can use <picture> syntax to display responsive images
        thumbnail: [
          {
            srcset: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQyXsYUq6PcER9dy4NonKjkiCx9csFtSMe59g&usqp=CAU',
            type: 'image/jpeg',
            media: '(min-width: 400px;)'
          },
          {
            src: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQyXsYUq6PcER9dy4NonKjkiCx9csFtSMe59g&usqp=CAU'
          }
        ]
      },
    ]);
    player.playlistUi();
  }
}

function getSharing(sel){
  if($("#sharing").is(':checked')){
    player.socialShare({
        facebook: { // optional, includes a Facebook share button (See the [Facebook documentation](https://developers.facebook.com/docs/sharing/reference/share-dialog) for more information)
          shareUrl: '', // optional, defaults to window.location.href
          shareImage: '', // optional, defaults to the Facebook-scraped image
          shareText: '',  // optional
          app_id: '', // optional, facebook app_id to use (if not specified, the plugin will try to
                      // use an existing FB Javascript object, or it will try to scrape the app_id from the
                      // <meta property="fb:app_id"> element in the document
        },
        twitter: { // optional, includes a Twitter share button (See the [Twitter documentation](https://dev.twitter.com/web/tweet-button/web-intent) for more information)
          handle: '', // optional, appends `via @handle` to the end of the tweet
          shareUrl: '', // optional, defaults to window.location.href
          shareText: ''
        },
        embed: { // optional, includes an embed code button
          embedMarkup: player.currentTime() // required
        }
      });
  }else{
    player.socialShare();
    $(".vjs-social-share").remove();
  }
}

function checkForConstrainedProportiomns(constrain_proportions,player_width,player_heigh){
  if(constrain_proportions.is(':checked')){
    player_width.on('change',function(){
      var width = player_width.val();
      var height = Math.round(width * 9/16);
      player_heigh.attr('value', height);
    });
  }
}

function getEnableLogo(sel, with_logo, imgLogoPreviwe, logo_file_name){
  if(with_logo.is(':checked')){
    logo_file_name.prop('disabled', false);
    $('#slider').slider({ disabled: false });
    imgLogoPreviwe.css('opacity', '1');
    //$(".vjs-watermark").css('opacity', '1');
    $("#logo_href").prop('readonly', false);
  }else {
    logo_file_name.prop('disabled', true);
    $('#slider').slider({ disabled: true });
    imgLogoPreviwe.css('opacity', '0.5');
    //$(".vjs-watermark").css('opacity', '0');
    $("#logo_href").prop('readonly', true);
  }
}

function sladerChange(sel, slider, handle, opacity, fileUrl, logoUrl, with_logo){
  if(with_logo.is(':checked')){
    slider.slider({
      range: "max",
      min: 1,
      max: 10,
      value: opacity.val(),
      create: function() {
        handle.text( $( this ).slider( "value" ) );
        player.watermark({
              file: fileUrl,
              xpos: 80,
              ypos: 80,
              width: 160,
              clickable: true,
              url: logoUrl,
              xrepeat: 0,
              opacity: (opacity.val()/10),
              debug: true
          });

      },
      slide: function( event, ui ) {
        player.watermark({
              file: fileUrl,
              xpos: 80,
              ypos: 80,
              width: 160,
              clickable: true,
              url: logoUrl,
              xrepeat: 0,
              opacity: (ui.value/10),
              debug: true
          });
        opacity.attr('value', ui.value);
        handle.text( ui.value );
      }
    });
  }else {
    player.watermark({
          file: '',
          xpos: 80,
          ypos: 80,
          width: 160,
          clickable: false,
          url: '',
          xrepeat: 0,
          opacity: 0,
          debug: false
    });
  }
}

function videoAds(sel){
  if($("#with_ads").is(':checked')){
    player.ads()
  }
}
