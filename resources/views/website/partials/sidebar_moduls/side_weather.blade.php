<style>
.weather .city {
    width: 100px;
    float: left;
    text-align: center;
    color: #999;
}

.city img {

    display: inline-block;
    height: auto !important;
    max-width: 100%;
}
</style>
<div class="card bg-light">
    <div class="card-body block weather">
      <div class="block weather">
        <div class="bh">
          <h5>Времето за 16 октомври 2018</h5>
        </div>
        <div class="bc" style="margin-left:auto; margin-right:auto; width:300px;">

          @foreach($weather as $key => $val)
            @foreach($val as $key => $value)
              <?php $array[$value->cities->title][$key] = $value; ?>
            @endforeach
          @endforeach
          @foreach($array as $key => $val)
            <div class="city">
                <h5>{{ $key }}</h5>
                @foreach($val as $item)
                  @if ($item === reset($val))
                    <div class="today-icon">
                      <img src="/images/{{ $item->weather_types->icon_name }}" title="" alt="">
                    </div>
                    <div class="temp">
                      <span class="low">{{ $item['min-temp'] }}°</span>/<span class="high">{{ $item['max-temp'] }}°</span>
                    </div>
                  @else
                    <div class="forecast">
                      <span class="day">{{ \Carbon\Carbon::parse($item->date)->format('D')}}</span>
                      <span class="low">{{ $item['min-temp'] }}°</span>/<span class="high">{{ $item['max-temp'] }}°</span>
                      <span class="icon">
                        <img src="/images/{{ $item->weather_types->icon_name }}" title="" alt="" width="30">
                      </span>
                    </div>
                  @endif
                @endforeach
            </div>
          @endforeach
      </div>
    </div>
  </div>
</div>
