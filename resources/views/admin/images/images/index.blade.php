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
                        <span>Всички снимки</span>
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
                            <th>Ключови думи</th>
                            <th>Категория</th>
                            <th>Снимка</th>
                            <th>Действия</th>
                            <th style=" overflow: hidden; white-space: nowrap;">
                                <span>Масово</span>
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
@endsection
@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8" src="/js/customJsVideoPlayer.js"></script>
    <script type="text/javascript" charset="utf-8">
    $(function(){
      loadVideoJsModal('#modal-showSettings');

      let options = [];
      options.push({
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false,
            visible: true,
            // columns: ['id','title','action','checkbox_action']
                // [
                //   { data: 'id', name: 'id', searchable: true},
                //   { data: 'title', name: 'title', searchable: true },
                //   { data: 'action', name: 'action', searchable: false },
                //   { data: 'checkbox_action', name: 'checkbox_action', searchable: false }
                // ]
      });

      var colll = [
                  { data: 'id', name: 'id', searchable: true},
                  { data: 'title', name: 'title', searchable: true },
                  { data: 'category', name: 'title', searchable: true },
                  { data: 'thumbnail', name: 'title', searchable: true },
                  { data: 'action', name: 'action', searchable: false },
                  { data: 'checkbox_action', name: 'checkbox_action', searchable: false }
                ];

      // initDatatablesAjaxVideo("{{ (isset($id)? $id: '#tbl-list-video') }}", "{{ (isset($url)? $url: route('archive_images')) }}", 'ddsdss', 'dsdsdds', "{{ (isset($displayLength)? $displayLength: 10) }}", '', options);

      initDatatablesAjax(
                  "{{ (isset($id)? $id: '#tbl-list-video') }}",
                  "{{ (isset($url)? $url: route('archive_images')) }}",
                  colll, "{{ (isset($displayLength)? $displayLength: 10) }}");
        });




    // $("#filter_category").change(function(){
    //   loadVideoJsModal('#modal-showSettings');
    //   let pageLength = $(this).attr('data-page-length');
    //   let category = $(this).children("option:selected").val();
    //   initDatatablesAjaxVideo(
    //     '#tbl-list-video',
    //       '{{ route('archive_images') }}',
    //       'fffdf',
    //       'fdffdfd',
    //       pageLength,
    //     category
    //   );
    // });

    </script>
@endsection
