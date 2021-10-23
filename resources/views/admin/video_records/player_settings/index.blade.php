@extends('layouts.admin')

@section('content')
<style>
.vjs-social-share{ top: 0px; right: 0; margin: 5px; position: absolute; }
.vjs-watermark img { max-height: 100px !important; margin: 10px !important; }
</style>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-table"></i></span>
                        <span>List All News</span>
                    </h3>
                </div>

                <div class="box-body">
                    @include('admin.partials.info')

                    @include('admin.partials.toolbar')
                    <table id="tbl-list" data-server="false" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th class="desktop">Description</th>
                            <th>Created At</th>
                            <th style="min-width: 200px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{!! $item->description !!}</td>
                                <td>{{ format_date($item->created_at) }}</td>
                                <td>
                                  <div class="btn-toolbar">
                                          <div class="btn-group">
                                              <form id="impersonate-login-form-{{ $item->id }}" action="{{ route('datatable/showPlaylist', $item->id) }}" method="post">
                                                  <input type="hidden" value="{{$item->id}}" id="itemId">
                                                  <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                                  <a data-form="{{ $item->id }}"
                                                      data-title="{{ $item->name }}"
                                                      data-video_url='{{ App\Models\VideoRecords::where("id",$item->video_id)->first() ?
                                                      "/hls/".App\Models\VideoRecords::where("id",$item->video_id)->first()->apy_key."/"
                                                      .App\Models\VideoRecords::where("id",$item->video_id)->first()->file_name."/index.m3u8"
                                                      : "/hls/Demo video - Samsonite Lite-Shock.mp4/index.m3u8" }}'
                                                      data-video_poster="{{ ($item->video_id != null ? $item->getCoverPhoto($item->videoEntry($item->video_id)->videos) : '/images/demo.jpg' ) }}"
                                                      data-video_width="{{ $item->player_width }}"
                                                      data-video_height="{{ $item->player_height }}"
                                                      data-with_logo="{{ $item->with_logo }}"
                                                      data-logo_file_name="{{ $item->logo_file_name }}"
                                                      data-sharing="{{ $item->sharing }}"
                                                    class="btn btn-success btn-xs"
                                                    data-toggle="modal" data-target="#modal-showSettings"
                                                    title="Impersonate {{ $item->id }}"
                                                    >
                                                      <i class="fa fa-user-secret">
                                                      </i>
                                                      Show
                                                  </a>
                                              </form>
                                          </div>
                                      {!! action_row($selectedNavigation->url, $item->id, $item->title, ['edit', 'delete']) !!}
                                  </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@parent
  <script type="text/javascript" charset="utf-8" src="/js/video-script.js"></script>
    <script type="text/javascript" charset="utf-8">

    $(function(){
      loadVideoJsModal('#modal-showSettings');
    });
    </script>
@endsection
