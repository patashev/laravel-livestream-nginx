@extends('layouts.admin')

@section('styles')
<style>
.file {
  visibility: hidden;
  position: absolute;
}

</style>

@endsection
@section('content')

<div class="row">
  <form method="POST" action="{{$selectedNavigation->url.(isset($player_settings) ? "/".$player_settings->id : '')}}" accept-charset="UTF-8" enctype="multipart/form-data">
    <input name="_token" type="hidden" value="{{ csrf_token() }}">
    <input name="_method" type="hidden" value="{{isset($player_settings)? 'PUT':'POST'}}">
    <div class="col-lg-6">
      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">
            <span><i class="fa fa-edit"></i></span>
            Създай / Редактирай настройки на плеара
          </h3>
        </div>
        <div class="box-body">
          <!-- previwe  -->
          <div class="" id="previwe">
            <div class="box box-primary box-solid well well-sm bg-gray-light">
              <div class="media-wrapper">
                <div class="live-player" id="live-player">
                  <video id="video-js" class="video-js video-js-custom-skin" data-setup=
                  '{ "fluid": true,
                            "sources": [{
                            "type": "application/x-mpegURL",
                            "src": "{{ ($player_settings->video_id != null ? '/hls/'.$player_settings->videoEntry($player_settings->video_id)->apy_key.'/'.$player_settings->videoEntry($player_settings->video_id)->file_name.'/index.m3u8' : '/hls/Demo video - Samsonite Lite-Shock.mp4/index.m3u8' ) }}"
                          }] }'
                         poster = "{{ ($player_settings->video_id != null ? $player_settings->getCoverPhoto($player_settings->videoEntry($player_settings->video_id)->videos) : '/images/demo.jpg' ) }}"
                         controls preload
                  >
                  </video>
                  <ul class="vjs-playlist overflow-hidden" style="max-height: 300px;"></ul>
                </div>
              </div>
            </div>
          </div>
          <!-- previwe  -->
        </div>
      </div>
    </div>


    <div class="col-lg-6">
      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">
            <span><i class="fa fa-edit"></i></span>
            Създай / Редактирай настройки на плеара
          </h3>
        </div>
        <div class="box-body">
          <fieldset>
            <!-- General  -->
            <!--Change Video Previwe-->
            <div class="form-group mb-2">
              <label for="modalButon"> Смени видео превюто </label>
              <button type="button" class="btn btn-primary btn-lg float-lg-right" data-toggle="modal" data-target="#myModal" id="modalButon" style="float: right;">
                      <span>
                        Смени видео превюто
                      </span>
              </button>
            </div>

            <div class="clearfix"></div>

            <div class="form-group {{ form_error_class('with_logo', $errors) }} mb-2"
                 onchange='getEnableLogo(this, $("#with_logo"), $("#img-logo-previwe"), $("#logo_file_name_btn")); sladerChange(this, $("#slider"), $("#custom-handle"), $("#logo_opacity"), $("#hidden_logo_url").val(), $("#logo_href").val(), $("#with_logo") );'
            >
              <label class="form-check-label pull-left" for="with_logo">Добави лого</label>
              <input type="hidden" name="with_logo" value="0">
              <input type="checkbox" name="with_logo" id="with_logo" value="1" class="pull-right"
                {{ ($errors && $errors->any()? old('with_logo') : ((isset($player_settings) && $player_settings->with_logo == 'true')? 'checked' : '')) }}
              >
              {!! form_error_message('with_logo', $errors) !!}
            </div>

            <div class="clearfix"></div>



            <div class="form-group mb-2">
              <input type="file" name="logo_file_name" id="logo_file_name" class="file">
              {!! form_error_message('logo_file_name', $errors) !!}
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                <input type="text" class="form-control input-lg logo_file_name-text" disabled placeholder="Upload Logo">
                <span class="input-group-btn">
                             <button class="browse btn btn-primary input-lg" id="logo_file_name_btn" type="button">
                               <i class="glyphicon glyphicon-search"></i> Browse</button>
                           </span>
              </div>
              <img width="150px"  class="img pull-right" id="img-logo-previwe" src="/{{ ($errors && $errors->any()? old('logo_file_name') : (isset($player_settings)? $player_settings->logo_file_name : '')) }}">
            </div>

            <div class="form-group {{ form_error_class('logo_href', $errors) }}">
              <input id="hidden_logo_url" type="hidden" value="/{{ ($errors && $errors->any()? old('logo_file_name') : (isset($player_settings)? $player_settings->logo_file_name : '')) }}">
              <div class="input-group col-lg-12 col-md-12">
                <label for="logo_href">Линк за пренасочване</label>
                <input type="text" class="form-control" id="logo_href" name="logo_href" value="{{ ($errors && $errors->any()? old('logo_href') : (isset($player_settings)? $player_settings->logo_href : '')) }}">
              </div>

              {!! form_error_message('logo_href', $errors) !!}
            </div>



            <div class="form-group">
              <label class="form-check-label" for="slider">Видимост</label>
              <div id="slider">
                <input type="hidden" id="logo_opacity" name="logo_opacity" class="ui-slider-range ui-corner-all ui-widget-header ui-slider-range-max"
                       value="{{ ($errors && $errors->any()? old('logo_opacity') : (isset($player_settings)? $player_settings->logo_opacity : '')) }}">
                <div id="custom-handle" class="ui-slider-handle"></div>
              </div>
            </div>

          </fieldset>









              </div>

            </div>
            <!-- Logo  -->


            <!-- ob6ti nastroiki  ;-->
            <div class="box box-primary box-solid well well-sm bg-gray-light">
              <h5 class="box-header"><label>Настройки</label></h5>
              <div class="box-body">


                <div class="form-group {{ form_error_class('name', $errors) }}">
                  <label for="name">Име</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ ($errors && $errors->any()? old('name') : (isset($player_settings)? $player_settings->name : '')) }}">
                  <i></i>
                  {!! form_error_message('name', $errors) !!}
                </div>

                <div class="form-group {{ form_error_class('description', $errors) }}">
                  <label for="article-content">Описание</label>
                  <textarea class="form-control summernote" id="description" name="description" rows="18">{{ ($errors && $errors->any()? old('description') : (isset($player_settings)? $player_settings->description : '')) }}</textarea>
                  {!! form_error_message('description', $errors) !!}
                </div>



                <div class="form-group">
                  <div class="row">
                    <div class="col-lg-4 col-md-4 {{ form_error_class('player_width', $errors) }}">
                      <label for="player_width">Широчина</label>
                      <input type="hidden" name="player_width_hidden" id="player_width_hidden" value="{{ ($errors && $errors->any()? old('player_width') : (isset($player_settings)? $player_settings->player_width : '')) }}">
                      <input type="text" class="form-control" id="player_width" name="player_width" placeholder="Please insert the Player Width" value="{{ ($errors && $errors->any()? old('player_width') : (isset($player_settings)? $player_settings->player_width : '')) }}">
                      <i></i>
                      {!! form_error_message('player_width', $errors) !!}
                    </div>
                    <div class="col-lg-4 col-md-4 {{ form_error_class('player_heigh', $errors) }}">
                      <label for="player_heigh">Височина</label>
                      <input type="hidden" name="player_heigh_hidden" id="player_heigh_hidden" value="{{ ($errors && $errors->any()? old('player_heigh') : (isset($player_settings)? $player_settings->player_heigh : '')) }}">
                      <input type="text" class="form-control" id="player_heigh" name="player_heigh" placeholder="Please insert the Player Height"
                             value="{{ ($errors && $errors->any()? old('player_heigh') : (isset($player_settings)? $player_settings->player_heigh : '')) }}"
                        {{ ($errors && $errors->any()? old('constrain_proportions') : ((isset($player_settings) && $player_settings->constrain_proportions == "true")? 'readonly' : '')) }}
                      >
                      <i></i>
                      {!! form_error_message('player_heigh', $errors) !!}
                    </div>

                    <div class="col-lg-4 col-md-4 {{ form_error_class('constrain_proportions', $errors) }} pull-right">
                      <label class="form-check-label pull-right" for="constrain_proportions">Заключи пропорциите</label>
                      <input type="hidden" name="constrain_proportions" value="0">
                      <input type="checkbox" name="constrain_proportions" id="constrain_proportions" value="1"
                        {{ ($errors && $errors->any()? old('constrain_proportions') : ((isset($player_settings) && $player_settings->constrain_proportions == "true")? 'readonly' : '')) }}>
                      <i></i>
                      {!! form_error_message('constrain_proportions', $errors) !!}
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="form-select-label" for="theme">Тема</label>
                  <div class="select">
                    <input type="hidden" name="theme" value="0">
                    {{ Form::select(
                      'size',
                      array(
                        '0' => 'По подразбиране',
                        '1' => 'Дизайнерска'
                        ),
                      '',
                      ['class'=>'form-control browser-default custom-select', 'onchange' => '']
                      ) }}
                    <i style="margin-bottom:18px !important;"></i>
                  </div>
                </div>



                <div class="row {{ form_error_class('bootstrap', $errors) }} padding-bottom">
                  <div class="col-lg-10 col-md-10">
                    <label class="form-check-label pull-left" for="bootstrap">Bootstrap</label>
                  </div>
                  <div class="col-lg-2 col-md-2">
                    <input type="hidden" name="bootstrap" value="0">
                    <input type="checkbox" name="bootstrap" id="bootstrap" value="1" class="pull-right"
                           {{ ($errors && $errors->any()? old('bootstrap') : ((isset($player_settings) && $player_settings->bootstrap == 'true')? 'checked' : '')) }}
                           onclick='getBootstrap(this, $("#player_heigh"), $("#player_heigh_hidden"), $("#player_width"), $("#player_width_hidden"), $("#slider"));'
                    >
                    {!! form_error_message('bootstrap', $errors) !!}
                  </div>
                </div>


                <div class="row {{ form_error_class('autoplay', $errors) }} padding-bottom">
                  <div class="col-lg-10 col-md-10">
                    <label class="form-check-label pull-left" for="autoplay">Автоматично стариране</label>
                  </div>
                  <div class="col-lg-2 col-md-2">
                    <input type="hidden" name="autoplay" value="0">
                    <input type="checkbox" name="autoplay" id="autoplay" value="1" class="pull-right"
                      {{ ($errors && $errors->any()? ('autoplay') : ((isset($player_settings) && $player_settings->autoplay == 'true')? 'checked' : '')) }}
                    >
                    {!! form_error_message('autoplay', $errors) !!}
                  </div>
                </div>



                <div class="row {{ form_error_class('sharing', $errors) }} padding-bottom">
                  <div class="col-lg-10 col-md-10">
                    <label class="form-check-label pull-left" for="sharing">Разреши споделяне</label>
                  </div>
                  <div class="col-lg-2 col-md-2">
                    <input type="hidden" name="sharing" value="0">
                    <input type="checkbox" name="sharing" id="sharing" value="1" class="pull-right"
                      {{ ($errors && $errors->any()? old('sharing') : ((isset($player_settings) && $player_settings->sharing == "true")? 'checked' : '')) }}
                    >
                    {!! form_error_message('sharing', $errors) !!}
                  </div>
                </div>


                <div class="row {{ form_error_class('playlist', $errors) }} padding-bottom">
                  <div class="col-lg-10 col-md-10">
                    <label class="form-check-label pull-left" for="playlist">Разреши плейлисти</label>
                  </div>
                  <div class="col-lg-2 col-md-2">
                    <input type="hidden" name="playlist" value="0">
                    <input type="checkbox" name="playlist" id="playlist" value="1" class="pull-right"
                      {{ ($errors && $errors->any()? old('playlist') : ((isset($player_settings) && $player_settings->playlist =="true")? 'checked' : '')) }}
                    >
                    {!! form_error_message('playlist', $errors) !!}
                  </div>
                </div>

                <!-- Reklami  -->
                <div class="row {{ form_error_class('with_ads', $errors) }} padding-bottom">
                  <div class="col-lg-10 col-md-10">
                    <label class="form-check-label pull-left" for="with_ads">Добави реклами</label>
                  </div>
                  <div class="col-lg-2 col-md-2">
                    <input type="hidden" name="name_test" value="0">
                    <input type="checkbox" name="with_ads" value="1" class="pull-right"
                      {{ ($errors && $errors->any()? old('with_ads') : ((isset($player_settings) && $player_settings->with_ads == "true")? 'checked' : '')) }}
                    >
                    {!! form_error_message('with_ads', $errors) !!}
                  </div>
                </div>
                <!-- Reklami  -->



              </div>
            </div>
            <!-- ob6ti nastroiki  -->
          </fieldset>
        </div>

    <div class="col-lg-12">
      @include('admin.partials.form_footer')
    </div>
  </form>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <table id="datatable" data-server="true" class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Title</th>
                <th>Cover Photo</th>
                <th></th>
            </tr>
            </thead>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="update_video_previwe">Insert</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
@endsection
@section('scripts')
  @parent
  <script type="text/javascript" charset="utf-8" src="/js/video-script.js"></script>
	<script>
    'use strict';
  	$(document).on('click', '.browse', function(){
  		var file = $(this).parent().parent().parent().find('.file');
  		file.trigger('click');
  	});
  	$(document).on('change', '.file', function(){
  		$(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
  	});

    var videoId = $('#videoId').val();
    var poster = $('#coverPhoto').val();

    var logo = function(){
      var height = $('#player_heigh').val();
      return height / 2;
    };


    if($("#autoplay").is(':checked')){
      var player = videojs('video-js',{
          "poster": poster,
          "src": "https://newlive.bta.bg/hls/MONSTERS.mp4/index.m3u8",
          "fluid": true,
          "type": "application/x-mpegURL",
          "autoplay" : true,
        });
    }else {
      var player = videojs('video-js',{
          "poster": poster,
          "src": "https://newlive.bta.bg/hls/MONSTERS.mp4/index.m3u8",
          "fluid": true,
          "type": "application/x-mpegURL",
          "autoplay" : false,
        });
    }

    let  videoUrl = "{{ ($player_settings->video_id != null ? '/hls/'.$player_settings->videoEntry($player_settings->video_id)->apy_key.'/'.$player_settings->videoEntry($player_settings->video_id)->file_name.'/index.m3u8' : '/hls/Demo video - Samsonite Lite-Shock.mp4/index.m3u8' ) }}";

  		$( function() {
        var table = $('.datatable').dataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            responsive: true,
            preventCache: true,
            order: getOrderBy('.datatable'),
            sDom: "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            },
            ajax: {
              url : '{{ route('datatable/getVideos') }}',
              dataType: "json"
            },
            columns: [
                {
                  data: 'title',
                  name: 'title',
                  searchable: true
                },
                {
                  name: 'thumb',
                  data: 'thumb',
                  'searchable': false
                },
                {data: 'checkbox_action', name: 'checkbox_action', orderable: false, searchable: false}
            ]
        });


        $("#update_video_previwe").on('click', function(){
          var matches = [];
          var checkedcollection = table.$(".checkbox_action_checkbox:checked", { "page": "all" });
          checkedcollection.each(function (index, elem) {
              matches.push($(elem).val());
          });
          $.getJSON( '{{ url('admin/video-records/datatable/getvideo') }}/'+matches[0], function( data ) {
              $.each(data, function(index,value){
                var apend_file_name = value['video']['file_name'];
                 player.src({
                   type: 'application/x-mpegURL',
                   src: '/hls/'+value['video']['apy_key']+'/'+apend_file_name+'/index.m3u8'
                 });
                 $.each(value['video_cover'], function(i,v){
                    if (v['is_cover'] == true) {
                      player.poster("/uploads/videos/"+v['filename']);
                    }
                 });
                 $.post( '/'+value['video']['id']);
              });
          });
        });


        table.$('[data-toggle="tooltip"]').tooltip();

        initSummerNote('.summernote');
        sladerChange( $("#slider"), $("#slider"), $("#custom-handle"), $("#logo_opacity"), $("#hidden_logo_url").val(), $("#logo_href").val(), $("#with_logo"));
        getBootstrap($("#bootstrap"), $("#player_heigh"), $("#player_heigh_hidden"), $("#player_width"), $("#player_width_hidden"), $("#slider"));
        getEnableLogo($("#with_logo"), $("#with_logo"), $("#img-logo-previwe"), $("#logo_file_name_btn"));
        constrainProportions($("#constrain_proportions"), $("#player_width"), $("#player_heigh"), $("#bootstrap"));
        getSharing('#sharing');
        checkForConstrainedProportiomns( $("#constrain_proportions"), $("#player_width"), $("#player_heigh"));
        getPlaylistOptions('#playlist', videoUrl);
  		});



      function videoHTML(skin) {
        $("#live-player").empty();
        return '<video id="video-js" class="video-js video-js-box vjs-big-play-centered '+skin+' vjs-16-9" data-setup="{}"'+
          'controls preload>'+
          '<input id="coverPhoto" type="hidden" value="/uploads/YOKO_ZAHARIEFF.png">'+
          '<input id="videoId" type="hidden" value="">'+
          '<source src="{{ ($player_settings->video_id != null ? '/hls/'.$player_settings->videoEntry($player_settings->video_id)->apy_key.'/'.$player_settings->videoEntry($player_settings->video_id)->file_name.'/index.m3u8' : '/hls/Demo video - Samsonite Lite-Shock.mp4/index.m3u8' ) }}" type="application/x-mpegURL">'+
          '</video>';
      }

	</script>



  <div id="hidden_scripts">
  </div>
@endsection
