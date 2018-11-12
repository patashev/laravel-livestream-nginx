<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-table"></i></span>
                        <span>List All Photo Albums</span>
                    </h3>
                </div>

                <div class="box-body">
                    <?php echo $__env->make('admin.partials.info', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <?php echo $__env->make('admin.partials.toolbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    <table id="datatable" data-server="true" class="datatable table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th width="10%">Category</th>
                            <th>Cover Photo</th>
                            <th>Created</th>
                            <th>Action</th>
                            <th>
                              <button type="button" name="bulk_delete" id="bulk_delete" class="btn btn-danger btn-xs">
                                <i class="glyphicon glyphicon-remove"></i>
                              </button>
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
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
              url : '<?php echo e(route('datatable/getVideos')); ?>',
              dataType: "json"
            },
            columns: [
                {
                  data: 'id',
                  name: 'id',
                  searchable: true
                },
                {
                  data: 'title',
                  name: 'title',
                  searchable: true
                },
                {
                  name: 'Category',
                  data: 'Category',
                },
                {
                  name: 'thumb',
                  data: 'thumb',
                  'searchable': false
                },
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
                {data: 'checkbox_action', name: 'checkbox_action', orderable: false, searchable: false}
            ]
        });
        initActionDeleteClickDatatable();
        table.$('[data-toggle="tooltip"]').tooltip();



        $(document).on('click','#bulk_delete', function(){
        	var id = [];
        	if(confirm("Are you sure you want to delete this Data?"))
        	{
        		$('.checkbox_action_checkbox:checked').each(function(){
        			id.push($(this).val());
        		});
        		if(id.length > 0){
              $.ajax({
                url:"<?php echo e(route('datatable.massDelete')); ?>",
                method:"get",
                data:{id:id},
                success:function(data){
                  $('.datatable').DataTable().ajax.reload();
                }
              })

        		}
        		else{
              alert("select atleast one");
        		}
        	}
        });
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>