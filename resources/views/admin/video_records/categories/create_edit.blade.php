@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Edit the ' . $item->name . ' entry': 'Create a new Video Category' }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    <form method="POST" action="{{$selectedNavigation->url . (isset($item)? "/{$item->id}" : '')}}" accept-charset="UTF-8">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

                        <fieldset>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ form_error_class('name', $errors) }}">
                                        <label for="name">Category</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Please insert the Category" value="{{ ($errors && $errors->any()? old('name') : (isset($item)? $item->name : '')) }}">
                                        {!! form_error_message('name', $errors) !!}
                                    </div>
                                    <div class="form-group {{ form_error_class('title_en', $errors) }}">
                                        <label for="title_en">Title English</label>
                                        <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Please insert the Category" value="{{ ($errors && $errors->any()? old('title_en') : (isset($item)? $item->title_en : '')) }}">
                                        {!! form_error_message('title_en', $errors) !!}
                                    </div>
                                    <div class="form-group {{ form_error_class('title_bg', $errors) }}">
                                        <label for="title_bg">Title Bulgarian</label>
                                        <input type="text" class="form-control" id="title_bg" name="title_bg" placeholder="Please insert the Category" value="{{ ($errors && $errors->any()? old('title_bg') : (isset($item)? $item->title_bg : '')) }}">
                                        {!! form_error_message('title_en', $errors) !!}
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
