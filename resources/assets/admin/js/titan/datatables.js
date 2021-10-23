/* Set the defaults for DataTables initialisation */

$.extend(true, $.fn.dataTable.defaults, {
    "oClasses": {
        "sFilter": 'dataTables_filter input-group ',
        "sLength": 'dataTables_length pull-right',
        "sFilterInput": "form-control custom",
        "sLengthSelect": "form-control"
    },
    "oLanguage": {
        "sLengthMenu": "_MENU_",
        "sSearch": "",
        "sInfo": "Showing <span class='txt-color-darken'>_START_</span> to <span class='txt-color-darken'>_END_</span> of <span class='text-primary'>_TOTAL_</span> entries",
        "sInfoEmpty": "<span class='text-danger'>Showing 0 to 0 of 0 entries</span>",
        "sSearch": "<span class='input-group-addon pull-left form-control'><i class='glyphicon glyphicon-search'></i></span> "
    }
});

$(function ()
{
    $('.dt-table').each(function ()
    {
        var id = $(this).attr('id');
        var ajax = $(this).attr('data-server');
        $('.dataTables_filter').empty(); // clears the content generated
        $('.dataTables_filter').append("<div class='input-group' style='width: 250px'>" +
                "    <input type='search' class='form-control' placeholder='Search..'/>" +
                "    <span class='input-group-addon'>" +
                "        <i class='fa fa-search' style='width: 15px; padding-left: 5px'></i>" +
                "    </span>" +
                "</div>");
        if (ajax == 'false') {
            var pageLength = $(this).attr('data-page-length');
            initDataTables('#' + id, {
                iDisplayLength : pageLength ? 10 : pageLength
            });
        }
    })
    $('.tbl-list-video').each(function ()
    {
      var pageLength = $(this).attr('data-page-length');
      var id = $(this).attr('id');
      var ajax_url = $(this).attr('data-server_url');
      initDatatablesAjaxVideo(id, ajax_url, { iDisplayLength : pageLength ? 10 : pageLength });
    });

    initActionDeleteClick();

});










function initDatatablesAjaxVideoDetailes(selector, url, displayLength, options)
{
    var options = (options ? options : {});
    options.responsive = true;
    options.preventCache = true;
    options.stateSave = true;
		options.responsive = true;
    options.processing = true;
    options.serverSide = true;
    options.paging =   false;
    options.bFilter = false;
    options.ordering = false;
    options.info = false;
    options.ajax = url;
    options.columns = [
      { data: 'Option', name: 'Option', searchable: true},
      { data: 'Value', name: 'Value', searchable: true },
    ];
    options.iDisplayLength = 18;
    options.sDom = "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
        "t" +
        "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>";
    options.drawCallback = function(settings) {
        $('[data-toggle="tooltip"]').tooltip();
    }

    var table = $(selector).DataTable(options);
    table.$('[data-toggle="tooltip"]').tooltip();


    table.on('draw', function () {
      var body = $(table.table().body());

      body.unhighlight();
      body.highlight(table.search());
    });

    return table;
}


function initDatatablesAjaxVideo(selector, url, massDelete, addToPlayList, displayLength, cat, options)
{
    displayLength = (displayLength ? displayLength : 10);

    cat = (cat ? cat : '');
    var options = (options ? options : {});
    options.responsive = true;
    options.preventCache = true;
    options.stateSave = true;
		options.responsive = true;
    options.processing = true;
    options.serverSide = true;

    options.ajax = {
      url: url,
      data:{
        category:cat
      }
    };
    options.destroy = true;
    options.columns = [
      { data: 'id', name: 'id', searchable: true},
      { data: 'title', name: 'title', searchable: true },
      { name: 'Category', data: 'Category' },
      { name: 'thumb', data: 'thumb', 'searchable': false },
      { data: 'created_at', name: 'created_at'},
      { data: 'action', name: 'action', orderable: false, searchable: false},
      { data: 'checkbox_action', name: 'checkbox_action', orderable: false, searchable: false}
    ];
    options.iDisplayLength = (displayLength ? displayLength : 10);
    options.aLengthMenu = [
      [displayLength, 25, 50, -1],
      [displayLength, 25, 50, "All"]
    ];
    options.sDom = "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
        "t" +
        "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>";


    options.drawCallback = function(settings) {
        $('[data-toggle="tooltip"]').tooltip();
    }
    var table = $(selector).DataTable(options);



    table.$('[data-toggle="tooltip"]').tooltip();
  //
  //
  // $("#filter_category").change(function(){
  //   var category = $(this).children("option:selected").val();
  //   $.ajax({
  //     url:url,
  //     method:"GET",
  //     options: options,
  //     data: { category: category },
  //     success:function(data){
  //       table.ajax.reload();
  //     }
  //   })
  // });



      $(document).on('click','#bulk_delete', function(){
              var id = [];
              if(confirm("Are you sure you want to delete this Data?"))
              {
                $('.checkbox_action_checkbox:checked').each(function(){
                  id.push($(this).val());
                });
                if(id.length > 0){
                  $.ajax({
                    url:massDelete,
                    method:"get",
                    data:{id:id},
                    success:function(data){
                      $(selector).DataTable().ajax.reload();
                    }
                  })
                }
                else{
                  alert("select atleast one");
                }
              }
        });
        $(document).on('click','#bulk_add_to_playlist', function(){
          var id = [];
          $('.checkbox_action_checkbox:checked').each(function(){
            id.push($(this).val());
          });
          if(id.length > 0){
            $('#modal-chosePlaylist').modal('show');
            $('#modal-chosePlaylist').on('hide.bs.modal', function (event) {
              $.ajax({
                      url:addToPlayList,
                      method:"get",
                      data:{id:id},
                      success:function(data){
                            $.getJSON( url, null, function ( json ) {
                                table.destroy();
                                $('.datatable').empty(); // empty in case the columns change

                                table = $(selector).DataTable( {
                                    columns: json.columns,
                                    data:    json.rows
                                } );
                            });
                      }
              });
            });
          }
          else{
                alert("select atleast one");
          }
        });
    return table;
}




function initDatatablesAjax(selector, url, columns, displayLength)
{
    displayLength = (displayLength ? displayLength : 10);
    return initDataTables(selector, {
        ajax: url,
        processing: true,
        serverSide: true,
        columns: columns,
        iDisplayLength: (displayLength ? displayLength : 10),
        aLengthMenu: [[displayLength, 25, 50, -1], [displayLength, 25, 50, "All"]]
    });
}

function initDataTables(selector, options)
{
    var options = (options ? options : {});

    console.log(options);
    options.responsive = true;
    options.order = getOrderBy(selector);
    options.aLengthMenu = [[10, 25, 50, -1], [10, 25, 50, "All"]];
    options.iDisplayLength = 10;
    options.preventCache = true;
    options.stateSave = true;
		options.responsive = true;
    options.sDom = "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
        "t" +
        "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>";
    options.drawCallback = function(settings) {
        $('[data-toggle="tooltip"]').tooltip();
    }

    // datatable
    var table = $(selector).DataTable(options);

    // reregister the tooltip events on table
    table.$('[data-toggle="tooltip"]').tooltip();

    return table;
}

function getOrderBy(element)
{
    var orderByVal = $(element).attr('data-order-by');

    var orderBy = [0, 'asc'];
    if (!(orderByVal == 'false' || orderByVal == false || orderByVal == undefined)) {
        var pieces = orderByVal.split('|');
        if (pieces.length == 1) {
            orderBy = [pieces[0], 'asc'];
        }
        else if (pieces.length == 2) {
            orderBy = [pieces[0], pieces[1]];
        }
    }

    return orderBy;
}

function initActionDeleteClick(element)
{
    $('.dt-table').off('click', '.btn-delete-row');
    $('.dt-table').off('click', '.btn-confirm-modal-row');
    if(element) {
        element.off('click', '.btn-delete-row');
        element.off('click', '.btn-confirm-modal-row');
    }

    // DELETE ROW LINK
    $('.dt-table').on('click', '.btn-delete-row', onActionDeleteClick);
    $('.dt-table').on('click', '.btn-confirm-modal-row', onConfirmRowlick);

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
