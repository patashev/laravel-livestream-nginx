@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-table"></i></span>
                        <span>List All Photos</span>
                    </h3>
                </div>


                <div class="box-body">

                    @include('admin.partials.info')

                    @include('admin.partials.toolbar')

                    <table id="datatable" data-server="true" class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
    $(function() {
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
              url : '{{ route('datatable/getVideoImages') }}',
              dataType: "json"
            },
            columns: [
                {
                  data: 'name',
                  name: 'name'
                },
                {
                  name: 'Image',
                  data: 'Image',
                  'searchable': false,
                  orderable: false
                },
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        initActionDeleteClickDatatable();
        table.$('[data-toggle="tooltip"]').tooltip();
    });


    function initActionDeleteClickDatatable(element)
    {
        $('.datatable').off('click', '.btn-delete-row');
        $('.datatable').off('click', '.btn-confirm-modal-row');
        if(element) {
            element.off('click', '.btn-delete-row');
            element.off('click', '.btn-confirm-modal-row');
        }

        // DELETE ROW LINK
        $('.datatable').on('click', '.btn-delete-row', onActionDeleteClick);
        $('.datatable').on('click', '.btn-confirm-modal-row', onConfirmRowlick);

        if(element) {
            element.on('click', '.btn-delete-row', onActionDeleteClick);
            element.on('click', '.btn-confirm-modal-row', onConfirmRowlick);
        }

        function onActionDeleteClick(e)
        {
            e.preventDefault();
            var formId = $(this).attr('data-form');
            var title = $(this).attr('data-original-title');
            if (title.length > 7) {
                title = '<strong>' + title.substring(0, 6).toLowerCase() + '</strong> the <strong>' + title.slice(7) + '</strong>';
            }

            var content = "Are you sure you want to " + title + " entry? ";
            $('#modal-confirm').find('.modal-body').find('p').html(content);
            $('#modal-confirm').find('.modal-footer').find('.btn-primary').on('click', function (e)
            {
                $('#' + formId).submit();
                console.log($('#' + formId));
            });
            $('#modal-confirm').modal('show');

            return false;
        }

        function onConfirmRowlick(e)
        {
            e.preventDefault();
            var formId = $(this).attr('data-form');
            var title = $(this).attr('data-original-title');
            title = '<strong>' + title + '</strong>';

            var content = "Are you sure you want to " + title + "? ";
            $('#modal-confirm').find('.modal-body').find('p').html(content);
            $('#modal-confirm').find('.modal-footer').find('.btn-primary').on('click', function (e)
            {
                $('#' + formId).submit();
            });
            $('#modal-confirm').modal('show');
            return false;
        }
    }

    </script>
@endsection
