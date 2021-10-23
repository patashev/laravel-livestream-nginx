

@section('styles')
@parent
<style>
.dd-handle-new:hover {
  background: #FDDFB3 !important;
  border: 1px solid #FAA937;
  color: #333 !important;
}
</style>
@endsection
<div class="col-xs-12">
    <div class="drag_disabled dd" id="dd-navigation" style="max-width: 100%">
        {!! $itemsHtml !!}
    </div>
</div>
  @include('admin.images.partials.nestable')


@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
            initNestableMenu(4, "{{ request()->url() }}");
        })
    </script>
@endsection
