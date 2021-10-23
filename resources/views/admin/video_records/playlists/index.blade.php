@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <span><i class="fa fa-table"></i></span>
                    <span>List All Playlists</span>
                </h3>
            </div>
            <div class="box-body">

                @include('admin.partials.info')

                @include('admin.partials.toolbar')

                <table id="tbl-list" data-server="false" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="desktop">Title</th>
                        <th>User</th>
                        <th style="min-width: 25%;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>
                              {{ $item->title }}
                            </td>
                            <td>{{ $item->createdBy()->first()->fullname }}</td>
                            <td>
                              <div class="btn-toolbar">
                                      <div class="btn-group">
                                          <form id="impersonate-login-form-{{ $item->id }}" action="{{ route('datatable/showPlaylist', $item->id) }}" method="post">
                                              <input type="hidden" value="{{$item->id}}" id="itemId">
                                              <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                              <a data-form="{{ $item->id }}"
                                                  data-playlist_id = "{{ $item->id }}"
                                                  data-modal_route = '/admin/video-records/video-record-playlists/show_modal/{!!$item->id!!}'
                                                  data-modal_destroy = 'true'
                                                  data-modal_method = 'GET'
                                                  data-modal_delete_url = "{{route('video-record-playlists.massRemoveFromPlaylist')}}"
                                                  data-user_id = '{{ \Auth::user()->id }}'

                                                class="btn btn-success btn-xs"
                                                data-toggle="modal" data-target="#modal-datatable"
                                                title="Impersonate {{ $item->id }}"
                                                >
                                                  <i class="fa fa-user-secret">
                                                  </i>
                                                  Show Videos
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
    <script type="text/javascript" charset="utf-8" src="/js/customJsVideoPlayer.js"></script>
    <script type="text/javascript" charset="utf-8">
      getDataTableByVideoModal('#modal-datatable');
    </script>
@endsection
