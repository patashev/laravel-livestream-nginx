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
                        <span>List All Videos</span>
                    </h3>
                </div>

                <div class="box-body">
                    @include('admin.partials.info')
                    @include('admin.partials.toolbar', ['categories' => $categories ])
                    <table id="tbl-list-video" class="table table-striped table-bordered hover" style="width:100%"
                      data-server="true"
                      data-page-length="10"
                    >
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th width="10%">Category</th>
                            <th>Cover Photo</th>
                            <th>Created</th>
                            <th>Action</th>
                            <th style=" overflow: hidden; white-space: nowrap;">
                              <button type="button" name="bulk_delete" id="bulk_delete" class="btn btn-danger btn-xs">
                                <i class="glyphicon glyphicon-remove"></i>
                              </button>
                              <button type="button" name="bulk_add_to_playlist" id="bulk_add_to_playlist" class="btn btn-success btn-xs">
                                <i class="glyphicon glyphicon-check"></i>
                              </button>
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@include('admin.partials.modals')
@endsection
@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8" src="/js/video-script.js"></script>
{{--    <script type="text/javascript" charset="utf-8" src="/js/customJsVideoPlayer.js"></script>--}}
    <script type="text/javascript" charset="utf-8">
      $(function(){
        loadVideoJsModal('#modal-showSettings');
        let pageLength = $(this).attr('data-page-length');
        initDatatablesAjaxVideo(
          '#tbl-list-video',
          '{{ route('datatable/getVideos') }}',
          '{{ route('datatable.massDelete')}}',
          '{{ route('datatable.massAddToPlaylist')}}',
          pageLength
        );
      });




    $("#filter_category").change(function(){
      //loadVideoJsModal('#modal-showSettings');
      let pageLength = $(this).attr('data-page-length');
      let category = $(this).children("option:selected").val();
      initDatatablesAjaxVideo(
        '#tbl-list-video',
        '{{ route('datatable/getVideos') }}',
        '{{ route('datatable.massDelete')}}',
        '{{ route('datatable.massAddToPlaylist')}}',
        pageLength,
        category
      );
    });

    </script>
@endsection
