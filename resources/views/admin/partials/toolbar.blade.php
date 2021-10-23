<div class="well well-sm well-toolbar">
  <div class="row">
    <div class="col col-xs-2">
      <a class="btn btn-labeled btn-primary" href="{{ request()->url().'/create' }}">
        <span class="btn-label"><i class="fa fa-fw fa-plus"></i></span>Създай {{ ucfirst($resource) }}
      </a>
    </div>
    <div class="col col-xs-10">
      @if(isset($order) && $order === true)
        <a class="btn btn-labeled btn-default text-primary" href="{{ request()->url().'/order' }}">
          <span class="btn-label"><i class="fa fa-fw fa-align-center"></i></span>{{ ucfirst($resource) }} Подреди
        </a>
      @endif
    </div>
    @if( request()->url() == 'https://newlive.bta.bg/admin/video-records/videos')
      <div class="form-row" style="margin-right: 15px;">
        <select name="filter_category" id="filter_category" class="form-control">
          <option value="">Избери категория</option>
          @foreach($categories as $key => $category)
            <option value="{{ $key }}">{{ $category }}</option>
          @endforeach
        </select>
      </div>
    @endif
  </div>
</div>
