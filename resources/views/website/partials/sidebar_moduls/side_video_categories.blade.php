<div class="card bg-light">
    <div class="card-body latest-news">
        <h3 class="side-heading">@lang('videos.categories')</h3>
        <ul>
            @foreach($categories as $key => $value)
                <li>
                  @if(Config::get('app.locale') == 'bg')
                    <a href="{{ route('by_video_categories', ['category_id' => $value['id']]) }}">
                      {{$value['title_bg']}}
                    </a>
                  @else
                    <a href="{{ route('by_video_categories', ['category_id' => $value['id']]) }}">
                      {{$value['title_en']}}
                    </a>
                  @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
