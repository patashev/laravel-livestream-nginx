<div class="pull-right box-tools">

    <button type="button" class="btn btn-default btn-sm btn-warning" onclick="printContainer()"  title="Принтирай">
        <i class="fa fa-print"></i>
    </button>

    <button type="button" class="btn {{ isset($btnDateClass)? $btnDateClass: 'btn-primary' }}  btn-sm daterange" data-toggle="tooltip" title="Дата от - до">
        <i class="fa fa-calendar"></i>
    </button>

    <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Смали">
        <i class="fa fa-minus"></i>
    </button>
</div>

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
    function printContainer() {
        window.print();
    }
    </script>
    @endsection
