@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Edit the ' . $item->name . ' entry': 'Create a new Sidebar Module' }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">
                    <form method="POST" action='{{ $selectedNavigation->url."/".$sidebar_id."/moduls".(isset($id)? "/".$id : " ") }}' accept-charset="UTF-8">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

                        <fieldset>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ form_error_class('name', $errors) }}">
                                        <label for="sidebar_name">Name</label>
                                        <input type="text" class="form-control input-generate-slug" id="name" name="name" placeholder="Please insert the Title" value="{{ ($errors && $errors->any()? old('name') : (isset($item)? $item->name : '')) }}">
                                        {!! form_error_message('sidebar_name', $errors) !!}
                                    </div>
                                </div>
                              </div>



                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group {{ form_error_class('type', $errors) }}">
                                    <label for="type">Choose Type</label>
                                    {!! form_select('type', ([0 => 'Please select a Type'] + $type), isset($item)? ($errors && $errors->any()? old('type') : $item->sidebar_types_id) : old('type'), ['class' => 'select2 form-control ']) !!}
                                    {!! form_error_message('type', $errors) !!}
                                </div>
                              </div>
                            </div>



                            <div class="row invisible" id="cities">
                              <div class="col-md-12">
                                <div class="form-group {{ form_error_class('cities', $errors) }}">
                                    <label for="cities">Choose city</label>
                                    {!! form_select('cities', ([0 => 'Please select a Type'] + $cities), isset($item)? ($errors && $errors->any()? old('cities') : $item->cities_id) : old('cities'), ['class' => 'select3 form-control ']) !!}
                                    {!! form_error_message('cities', $errors) !!}
                                </div>
                            </div>
                          </div>




                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group {{ form_error_class('content', $errors) }}">
                                      <label for="article-content">Content</label>
                                      <textarea class="form-control" id="content" name="content" rows="18">
                                        {{ ($errors && $errors->any()? old('content') : (isset($item)? $item->content : '')) }}
                                      </textarea>
                                      {!! form_error_message('content', $errors) !!}
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
@endsection

@section('scripts')
    @parent
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
          $('.select2').on('change', function(){
            if ($( this ).val() == 5) {
              $("#cities").removeClass('invisible');
            }else {
              $("#cities").addClass('invisible');
            }
            console.log($( this ).val());
          });
            //setDateTimePickerRange('#active_from', '#active_to');
            //initSummerNote('.summernote');
        })
    </script>
@endsection
