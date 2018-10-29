<div class="side d-none d-sm-block col-sm-5 col-lg-4">
    {{--<div class="well">
        <div class="side-heading">{!! $activePageTiers->name !!}</div>
        <ul>
            @foreach($activePageTiers->items as $item)
                <li><a href="{{ $item->url }}" class="{{ $item->id == $page->id? 'active':'' }}">{!! $item->name !!}</a></li>
            @endforeach
        </ul>
    </div>--}}

    @if($sidebar != null)

    <style>
        .text-only { background: #fff; -moz-border-radius: 2px; -webkit-border-radius: 2px; border-radius: 2px; }
        .currency, .text-only { border: 1px solid #D9D9D9; }
        .text-only .bc { margin: 10px 18px; overflow: hidden; padding: 0 0 10px; }
        .banner, .block { margin: 0 0 10px; }
        .text-left { text-align: left; }
    </style>
      @foreach($sidebar as $key => $val)
        @switch($val)
          @case($val->sidebar_types_id == '7')
              @include('website.partials.side_news')
            @break
          @case($val->sidebar_types_id == '6')
              <div class="card bg-light">
                  <div class="card-body">
                      <h2 class="side-heading">Popular Links</h2>
                      <ul>
                          @foreach($popularPages as $item)
                              <li><a href="{{ $item->url }}">{!! $item->name !!}</a></li>
                          @endforeach
                      </ul>
                  </div>
              </div>
            @break


          @case($val->sidebar_types_id == '5')
              @include('website.partials.sidebar_moduls.side_weather')
            @break


          @case($val->sidebar_types_id == '2')
            @include('website.partials.sidebar_moduls.side_video_categories')
            @break

        @endswitch
      @endforeach
    @endif



    @if(Request::is('videos*'))

    @else


    @endif

</div>
