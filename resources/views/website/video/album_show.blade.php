@extends('layouts.website')

@section('content')
    <section class="content p-3">
        @include('website.partials.page_header')

        <div class="row">
            <div class="body col-sm-7 col-lg-8 col-xs-12 no-gutters" style="margin:0 !important;">
                @include('website.partials.breadcrumb')

                <div class="row-fluid no-gutters">
                    <div class="col-md-12">
                        <h2>{!! $album->title !!}</h2>
                    </div>
                </div>
                <div class="gallery">
                    <div class="row-fluid no-gutters">
                            <div class="col-lg-12">
                              <div class="box box-primary box-solid well well-sm bg-gray-light">
                                <div class="media-wrapper">
                                        <video id="video-js" class="video-js vjs-default-skin vjs-big-play-centered"
                                              poster='/uploads/videos/{{ $album->cover->filename }}'
                                              controls preload="auto">
                                              <source src="/hls/{{$album->apy_key}}/{{$album->file_name}}/index.m3u8" type="application/x-mpegURL">
                                              <input id="videoId" type="hidden" value="{{$album->id}}">
                                              <input id="videoSource" type="hidden" value='/hls/{{$album->apy_key}}/{{$album->file_name}}/index.m3u8'>
                                              <input id="videoPoster" type="hidden" value='{{$album->cover->filename}}'>
                                              <input id="videoTitle" type="hidden" value='{{$album->title}}'>
                                        </video>
                                        @if (!empty($playlist->videos))
                                        <div class="playlist-components">
                                          <div class="panel-group">
                                            <div class="panel panel-default">
                                              <div class="panel-heading playlist-dropdown p-3 bg-dark mt-3" data-toggle="collapse" href="#playlist">
                                                  <h5 class="media-heading text-primary">
                                                    Playlist
                                                    <i class="fa fa-fw fa-th-list"></i>
                                                  </h5>
                                              </div>
                                              <div class="panel-collapse collapse" id="playlist">
                                              <div class="playlist">
                                                <ul></ul>
                                                <!--
                                                  <div class="button-holder">
                                                    <span id="prev">Prev</span>
                                                    <span id="next">Next</span>
                                                  </div>
                                                -->
                                              </div>
                                            </div>
                                            </div>
                                          </div>
                                          </div>
                                        @endif
                                      </div>

                                  </div>
                                  <figure>
                                  <figcaption>{!! $album->title !!}</figcaption>
                                  <div class="mt-3">
                                      <p>{!! $album->description !!}</p>
                                  </div>
                              </figure>
                            </div>
                    </div>
                </div>
            </div>

            @include('website.partials.page_side')
        </div>
    </section>
@endsection
@section('scripts')
    @parent
    <style>
    /* Show the controls (hidden at the start by default) */
.vjs-social-share {
    top: 5px !important;
    position: absolute;
    right: 5px !important;
  }

.vjs-watermark {
    position: absolute;
    margin-left: 10px !important;
    display: inline;
    z-index: 2000;
}

.playlist-dropdown{
  cursor: pointer !important;
  width: 100%;
  overflow-y: auto;
  color: silver !important;
  display: block;
  margin: -2px 0 0 0;
  padding: 0;
  position: relative;
  margin-top: 0px !important;
  border: 1px solid #1a1a18;
}

.playlist-dropdown h5{
  margin: 5px !important;
  padding-left: 5px;
  color: silver !important;
}

.playlist-dropdown h5 i{
  float: right;
}

.vjs-related-video-url {
    width: 195px;
    height: 133px;
    margin-left: 3px;
    margin-right: 3px;
    margin-bottom: 3px;
    position: relative;
    text-decoration: none;
    color: silver !important;
    background-color: rgba(4, 4, 4, 0.35);
    border: 1px solid rgb(27, 23, 29) !important;
    cursor: pointer;
    text-align: center;
    transition: border-color .5s ease;
    padding: 0;
    overflow: hidden;
    display: block;
}
.vjs-related-video-close{ color: silver !important;}
.vjs-related-video-close:hover{ color: #fff !important;}
.vjs-related-video-url-title { color: silver !important; }
.vjs-related-video-img { padding-bottom: 5px !important;}

.playlist {
    height: 264px;
    width: 100%;
    overflow-y: auto;
    color: #c0c0c0;
    display: block;
    margin: -2px 0 0 0;
    padding: 0;
    position: relative;
    background: -moz-linear-gradient(top,#000 0,#212121 19%,#212121 100%);
    background: -webkit-gradient(linear,left top,left bottom,color-stop(0%,#000),color-stop(19%,#212121),color-stop(100%,#212121));
    background: -o-linear-gradient(top,#000 0,#212121 19%,#212121 100%);
    background: -ms-linear-gradient(top,#000 0,#212121 19%,#212121 100%);
    background: linear-gradient(to bottom,#000 0,#212121 19%,#212121 100%);
    box-shadow: 0 1px 1px #1a1a1a inset,0px 1px 1px #454545;
    border: 1px solid #1a1a18;
}

.playlist ul {
    padding: 0;
    margin: 0;
    list-style: none
}
.playlist ul li {
    padding: 10px;
    border-bottom: 1px solid #191919;
    cursor: pointer;
}
.playlist ul li.active {
    background-color: #4f4f4f;
    border-color: #4f4f4f;
    color: white;
}
.playlist ul li:hover {
    border-color: #353535;
    background: #353535;
}

.playlist .poster .img{
  max-width: 150px !important;
  padding-bottom: 8px !important;
}

.playlist .title{
  float: right !important;
}
.playlist .poster, .playlist .title  {
    display: inline-block;
    vertical-align: top
}
.playlist .number {padding-right: 10px; display: none;}
.playlist .poster {
  max-width: 120px !important;
  margin: -5px 5px -15px -5px !important;
  object-fit: cover !important;
  padding: 5px !important;
}
.playlist .title {padding-left: 0; max-width:70% !important;}

.gallery figure:hover img{transform: none !important;}

    </style>

    <script type="text/javascript" charset="utf-8">



function playList(options,arg){
var player = this;
player.pl = player.pl || {};
var index = parseInt(options,10);

player.pl._guessVideoType = function(video){
var videoTypes = {
  'm3u8' : 'application/x-mpegURL',
};
var extension = video.split('.').pop();

return videoTypes[extension] || '';
};

player.pl.init = function(videos, options) {
options = options || {};
player.pl.videos = [];
player.pl.current = 0;
player.on('ended', player.pl._videoEnd);

if (options.getVideoSource) {
  player.pl.getVideoSource = options.getVideoSource;
}

player.pl._addVideos(videos);
};

player.pl._updatePoster = function(posterURL) {
player.poster(posterURL);
player.removeChild(player.posterImage);
player.posterImage = player.addChild("posterImage");
};

player.pl._addVideos = function(videos){
for (var i = 0, length = videos.length; i < length; i++){
  var aux = [];
  for (var j = 0, len = videos[i].src.length; j < len; j++){
    aux.push({
      type : player.pl._guessVideoType(videos[i].src[j]),
      src : videos[i].src[j]
    });
  }
  videos[i].src = aux;
  player.pl.videos.push(videos[i]);
}
};

player.pl._nextPrev = function(func){
var comparison, addendum;

if (func === 'next'){
  comparison = player.pl.videos.length -1;
  addendum = 1;
}
else {
  comparison = 0;
  addendum = -1;
}

if (player.pl.current !== comparison){
  var newIndex = player.pl.current + addendum;
  player.pl._setVideo(newIndex);
  player.trigger(func, [player.pl.videos[newIndex]]);
}
};

player.pl._setVideo = function(index){
if (index < player.pl.videos.length){
  player.pl.current = index;
  player.pl.currentVideo = player.pl.videos[index];

  if (!player.paused()){
    player.pl._resumeVideo();
  }

  if (player.pl.getVideoSource) {
    player.pl.getVideoSource(player.pl.videos[index], function(src, poster) {
      player.pl._setVideoSource(src, poster);
    });
  } else {
    player.pl._setVideoSource(player.pl.videos[index].src, player.pl.videos[index].poster);
  }
}
};

player.pl._setVideoSource = function(src, poster) {
player.src(src);
player.pl._updatePoster(poster);
};

player.pl._resumeVideo = function(){
player.one('loadstart',function(){
  player.play();
});
};

player.pl._videoEnd = function(){
if (player.pl.current === player.pl.videos.length -1){
  player.trigger('lastVideoEnded');
}
else {
  player.pl._resumeVideo();
  player.next();
}
};

if (options instanceof Array){
player.pl.init(options, arg);
player.pl._setVideo(0);
return player;
}
else if (index === index){ // NaN
player.pl._setVideo(index);
return player;
}
else if (typeof options === 'string' && typeof player.pl[options] !== 'undefined'){
player.pl[options].apply(player);
return player;
}
}



(function(){
  var firstVideo = $('#videoSource').val();
  var videoPoster = $('#videoPoster').val();

  var videoTitle = $('#videoTitle').val();
  var videos = [
  {
      src : [
          firstVideo
        ],
        poster : '/uploads/videos/{{ $album->cover->filename }}',
        title : '{!!preg_replace( "/\r|\n/", "", $album->title )!!}',
        thumbnail : '/uploads/videos/{{ $album->cover->filename }}'
  },



  @if ($album->related)
  {{dd($playlist->videos)}}
  @endif

  @if ($album->related)
    @foreach($album->related as $key => $all)
      @foreach($all->videos as $video)
        {
          src : [
            'https://newlive.bta.bg/hls/{{$all->apy_key}}/{{$all->file_name}}/index.m3u8'
          ],
          poster : '{!!"/uploads/videos/".$video->filename!!}',
          title : '{!!preg_replace( "/\r|\n/", "", $all['title'] )!!}',
          thumbnail : '{!!"/uploads/videos/".$video->filename!!}'
      },
      @endforeach
    @endforeach
  @endif
];

var demoModule = {
init : function(){
  this.els = {};
  this.cacheElements();
  this.initVideo();
  @if (!empty($album->related))
    this.createListOfVideos();
  @endif
  this.bindEvents();
  this.overwriteConsole();
},
overwriteConsole : function(){
  console._log = console.log;
  console.log = this.log;
},
log : function(string){
  demoModule.els.log.append('<p>' + string + '</p>');
  console._log(string);
},
cacheElements : function(){
  this.els.$playlist = $('div.playlist > ul');
  this.els.$next = $('#next');
  this.els.$prev = $('#prev');
  this.els.log = $('div.panels > pre');
},
initVideo : function(){
  var videoId = $('#videoId').val();
  this.player = videojs('video-js',{
      type: 'application/x-mpegURL',
      fluid: true
     });

@if($album->player_settings)
  @if($album->player_settings->with_logo == true)
  this.player.watermark({
           file: '/{{$album->player_settings->logo_file_name}}',
           xpos: 80,
           ypos: 80,
           width: 160,
           clickable: true,
           url: '{{$album->player_settings->logo_href}}',
           xrepeat: 0,
           opacity: ('{{$album->player_settings->logo_opacity}}'/10),
           debug: false
       });
  @endif
@endif

@if($album->player_settings)
  @if($album->player_settings->sharing == true)
   this.player.socialShare({
           facebook: { // optional, includes a Facebook share button (See the [Facebook documentation](https://developers.facebook.com/docs/sharing/reference/share-dialog) for more information)
             shareUrl: 'https://newlive.bta.bg/videos/{{$album->id}}', // optional, defaults to window.location.href
             shareImage: 'https://newlive.bta.bg/uploads/videos/{{ $album->cover->filename }}', // optional, defaults to the Facebook-scraped image
             shareText: '{!! $album->title !!}',  // optional
             app_id: '2603994039643326', // optional, facebook app_id to use (if not specified, the plugin will try to
                         // use an existing FB Javascript object, or it will try to scrape the app_id from the
                         // <meta property="fb:app_id"> element in the document
           },
           twitter: { // optional, includes a Twitter share button (See the [Twitter documentation](https://dev.twitter.com/web/tweet-button/web-intent) for more information)
             handle: '', // optional, appends `via @handle` to the end of the tweet
             shareUrl: 'https://newlive.bta.bg/videos/{{$album->id}}', // optional, defaults to window.location.href
             shareText: '{!! $album->title !!}'
           },
           embed: { // optional, includes an embed code button
             embedMarkup: this.player.currentTime() // required
           }
         });
    @endif
  @endif

  videojs.registerPlugin('playList', playList);


  @if (!empty($album->related))

  this.player.playList(videos);

  this.player.related({
            title: 'Related',
            target: 'self',
            list: [
                @foreach($album->related as $key => $all)
                  @foreach($all->videos as $video)
                {
                  title : '{!!preg_replace( "/\r|\n/", "", $all['title'] )!!}',
                  url : ['/videos/video_entry/{{$all->id}}'],
                  image : '{!!"/uploads/videos/".$video->filename!!}',
                  target: 'self'
                },
                  @endforeach
                @endforeach
           ]
        });
    @endif

  this.player.pause();
},
createListOfVideos : function(){
  var html = '';
  for (var i = 0, len = this.player.pl.videos.length; i < len; i++){
    html += '<li data-videoplaylist="'+ i +'">'+
              '<span class="number">' + (i + 1) + '</span>'+
              '<div class="clearfix"></div>'+
              '<span class="poster"><img id="'+videos[i].poster+'" class="img" src="'+ videos[i].poster +'"></span>' +
              '<span class="title">'+ videos[i].title +'</span>' +
            '</li>';
  }
  this.els.$playlist.empty().html(html);
  this.updateActiveVideo();
},
updateActiveVideo : function(){
  var activeIndex = this.player.pl.current;

  this.els.$playlist.find('li').removeClass('active');
  this.els.$playlist.find('li[data-videoplaylist="' + activeIndex +'"]').addClass('active');
},
bindEvents : function(){
  var self = this;
  this.els.$playlist.find('li').on('click', $.proxy(this.selectVideo,this));
  this.els.$next.on('click', $.proxy(this.nextOrPrev,this));
  this.els.$prev.on('click', $.proxy(this.nextOrPrev,this));
  this.player.on('next', function(e){
    console.log('Next video');
    self.updateActiveVideo.apply(self);
  });
  this.player.on('prev', function(e){
    console.log('Previous video');
    self.updateActiveVideo.apply(self);
  });
  this.player.on('lastVideoEnded', function(e){
    console.log('Last video has finished');
  });
},
nextOrPrev : function(e){
  var clicked = $(e.target);
  this.player[clicked.attr('id')]();
},
selectVideo : function(e){
  var clicked = e.target.nodeName === 'LI' ? $(e.target) : $(e.target).closest('li');

  if (!clicked.hasClass('active')){
    console.log('Selecting video');
    var videoIndex = clicked.data('videoplaylist');
    this.player.playList(videoIndex);
    this.updateActiveVideo();
  }
}
};

demoModule.init();
})(jQuery);
    </script>
@endsection
