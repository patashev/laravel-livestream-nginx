@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Edit the ' . $item->name . ' entry': 'Create a new Page' }}</span>
                    </h3>
                </div>


                <div class="box-body no-padding">
                    <form method="POST" action="{{$selectedNavigation->url . (isset($item)? "/{$item->id}" : '')}}" accept-charset="UTF-8">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

                        <fieldset>
                            <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group {{ form_error_class('cities', $errors) }}">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <div class="form-group {{ form_error_class('cities', $errors) }}">
                                              <label for="type">Choose city</label>
                                              {!! form_select('cities', ([0 => 'Please select a Type'] + $cities), isset($item)? ($errors && $errors->any()? old('cities') : $item->cities_id) : old('cities'), ['class' => 'select2 form-control ']) !!}
                                              {!! form_error_message('cities', $errors) !!}
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col col-xs-12">
                                    <div class="form-group {{ form_error_class('date', $errors) }}">
                                        <label for="date">Date</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="date" data-date-format="YYYY-MM-DD" name="date" placeholder="Please insert the Date for forcast" value="{{ ($errors && $errors->any()? old('date') : (isset($item)? $item->date : '')) }}">
                                            <span class="input-group-addon" style="margin-left: 5px;font-size: xx-large;">
                                              <i class="fa fa-calendar"></i>
                                            </span>
                                        </div>
                                        {!! form_error_message('date', $errors) !!}
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group {{ form_error_class('weather_type', $errors) }}">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group {{ form_error_class('weather_type', $errors) }}">
                                                <label for="weather_type">Choose type</label>
                                                {!! form_select('weather_type', ([0 => 'Please select a Type'] + $weather_type), isset($item)? ($errors && $errors->any()? old('weather_type') : $item->weather_type) : old('weather_type'), ['class' => 'select2 form-control ']) !!}
                                                {!! form_error_message('weather_type', $errors) !!}
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                              <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('min-temp', $errors) }}">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group {{ form_error_class('min-temp', $errors) }}">
                                                <label for="type">Min temp</label>
                                                <input type="text" class="form-control input-generate-slug" id="min-temp" name="min-temp" placeholder="Please insert min-temp" value="{{ ($errors && $errors->any()? old('min-temp') : (isset($item)? $item->min-temp : '')) }}">
                                                {!! form_error_message('min-temp', $errors) !!}
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('max-temp', $errors) }}">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group {{ form_error_class('max-temp', $errors) }}">
                                                <label for="type">Max temp</label>
                                                <input type="text" class="form-control input-generate-slug" id="max-temp" name="max-temp" placeholder="Please insert max-temp" value="{{ ($errors && $errors->any()? old('max-temp') : (isset($item)? $item->max-temp : '')) }}">
                                                {!! form_error_message('max-temp', $errors) !!}
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                        </fieldset>
                        @include('admin.partials.form_footer')
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('admin.partials.sidebarable')
@endsection


@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
          setDateTimePickerRange('#date');
            //initSidebarableMenu(3, "{{ request()->url().'/order' }}");
        })
    </script>
@endsection
