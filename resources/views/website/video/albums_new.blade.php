@extends('layouts.website')

@section('content')
    <section class="content p-3">
        @include('website.partials.page_header')
<?php
$text = substr('В Регионалния пресклуб на БТА - Стара Загора в защита на инициативата "Гневните боси" в подкрепа на Николай Колев Босия се обяви бившият служебен премиер Ренета Инджова, бившият военен разузнавач и дипломат Радион Попов, офицерът от резерва Неделчо Неделчев, собственикът на фирма за шофьорски курсове Митко Трайков и българският мюсюлманин Айдън Даил.', 0, 170);
?>

<div class="row pb-3">
<div class="col-md-6">
    <div class="news">
        <figure class="container">
            <a href="">
                <img src="https://newlive.bta.bg/uploads/videos/video_KqldUkfQie-1535536898-0_5o739nji.png">
            </a>
        </figure>
        <div class="media mt-2">
            <div class="media-left mr-2">
                <div class="date bg-primary mr-2">
                  03 May 2018
                </div>
            </div>
            <div class="media-body">
                <h5 class="media-heading text-primary" style="overflow: unset !important; white-space: unset !important;">
                  <?php
                  echo $text."...";
                  ?>
                </h5>
                <div class="text limit">
                    <p>В Регионалния пресклуб на БТА в Стара Загора в защита на инициативата "Гневните боси" в подкрепа на Николай Колев- Босия се обявиха бившият служебен премиер</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="news">
        <figure class="container">
            <a href="">
                <img src="https://newlive.bta.bg/uploads/videos/video_KqldUkfQie-1535536898-0_5o739nji.png">
            </a>
        </figure>
        <div class="media mt-2">
            <div class="media-left mr-2">
                <div class="date bg-primary mr-2">
                  03 May 2018
                </div>
            </div>
            <div class="media-body">
                <h5 class="media-heading text-primary" style="overflow: unset !important; white-space: unset !important;">
                  <?php
                  echo $text."...";
                  ?>
                </h5>
                <div class="text limit">
                    <p>В Регионалния пресклуб на БТА в Стара Загора в защита на инициативата "Гневните боси" в подкрепа на Николай Колев- Босия се обявиха бившият служебен премиер</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
















        <div class="row">
          <div class="body col-sm-7 col-lg-8">


            <div class="card bg-light">
                <div class="card-body">
                    <h2 class="side-heading">Categories</h2>
                    <ul>
                        @foreach($categories as $key => $value)
                            <li><a href="{{ route('vid', [ 'category' => $value['name'], 'category_id' => $value['id']]) }}">{{$value['name']}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>




            @include('website.partials.breadcrumb')
              <div class="box box-primary box-solid">
                  <div class="box-header with-border">
                      <h3 class="box-title">
                          <span><i class="fa fa-table"></i></span>
                          <span>List All Photo Albums</span>
                      </h3>
                  </div>

                  <div class="box-body">

                      <table id="datatableNew" data-server="true" class="datatable table" cellspacing="0" width="100%">
                      </table>
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

    .bottom-right {
        position: absolute;
        bottom: 8px;
        left: 16px;
        word-wrap: break-word;
    }



        #datatable > tbody > tr > td{
          padding: 0px !important;
          border: none;
          radius:none;
        }

        .dataTables_wrapper table thead{
          display:none;
        }

        .card-no-padding-no-borders{
          border: none !important;
          border-radius: none !important;
        }

        .card-no-padding-no-borders > .card-header{
          border-bottom: none !important;
          border-top: 1px solid rgba(0, 0, 0, 0.125);
        }

        .table th, .table td{ border-top: none !important; }


    </style>
    <script type="text/javascript">

    $(function() {
        table = $('#datatableNew').dataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            responsive: true,
            preventCache: true,
            pageLength: 5,
            sDom: "<'dt-toolbar'<'col-xs-12 col-sm-6'><'col-sm-6 col-xs-12 hidden-xs'>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            },
            ajax: {
              @if(\Request::get('category') != 'null')
                url : "{{ route('getVideos', [ 'category' => \Request::get('category_id')]) }}",
              @else
                url : "{{ route('getVideos') }}",
              @endif
              dataType: "json"
            },
            columns: [
                {
                  data: 'title',
                  name: 'title',
                  orderable:	true
                }
            ]
        });
        table.$('[data-toggle="tooltip"]').tooltip();

        $('#customInputTextField').on('keyup click', function(){
          table.api().search($('#customInputTextField').val()).draw() ;
          //console.log($('#customInputTextField').val());
        });

    });

    </script>
@endsection
