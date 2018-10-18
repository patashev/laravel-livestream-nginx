@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        function initSidebarableMenu(maxDepth, path)
        {
          $('#dd-navigation').nestable({
            group: 1,
            maxDepth: maxDepth
          }).on('change', updateList);

          $('.buttonEdit').on('click', function(e){
            var target = $(e.target), action = target.data('action');
            var targetId = target.data('id');
            //var parentId = target.data('parent-id');
            window.location.href = 'moduls/'+targetId+'/edit';
          });

            $('#nestable-menu').click(function (e)
            {
                var target = $(e.target), action = target.data('action');
                var targetId = $(e.target);
                //var parentId = $(e.target), parentId = target.data('parent-id');
                if (action === 'create-new') {
                  window.location.href = 'moduls';
                }
            });

            function updateList(e)
            {
                var list = e.length ? e : $(e.target);
                var nestableString = window.JSON.stringify(list.nestable('serialize'));

                console.log(nestableString + path);

                $.post(path, {'list': nestableString}, function (data)
                {
                    if (data && data.result == 'success') {
                        notify('Successfully', 'The Order has been updated', null, null, 5000);
                    }
                    else {
                        notifyError();
                    }
                }, "json");
            }
        }

    </script>
@endsection
