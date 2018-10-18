@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

                    @if(isset($item))
                    <div class="callout callout-info callout-help">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="title">Stram inclusion settings</h4>
                                <div class="form-group {{ form_error_class('name', $errors) }}">
                                    <p>RTMP Server: rtmp://{{ request()->server->get('SERVER_NAME') }}/live/</p>
                                    <p>RTMP Stream Key: {{ $item->slug }}?key={{ $item->key }}</p>
                                    <p>Player: <a href="{!! $selectedNavigation->url.'/player/'.$item->slug !!}">https://{{ request()->server->get('SERVER_NAME') }}{!! $selectedNavigation->url.'/player/'.$item->slug !!}</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif


                    @if(isset($item))
                    <div class="callout callout-info callout-help">
                        <div class="row">

                          <div class="col-md-12" >
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">
                                    Default checkbox
                                </label>
                            </div>
                          </div>
                            <div class="col-md-12" >
                                <h4 class="title">Stram inclusion code</h4>
                                <div class="form-group {{ form_error_class('name', $errors) }}">
                                    <textarea class="form-control" rows="15" id="embed-content"></textarea>
                                    <br>
                                    <a class="btn btn-success" style="width:100%;" name="submitsave" id="downloadLink">
                                        Save Embed Code as File
                                    <div class="ripple-container"></div></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif


                        <form method="POST" action="{{$selectedNavigation->url . (isset($item)? "/{$item->id}" : '')}}" accept-charset="UTF-8">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">


                        <fieldset>
                            <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{ form_error_class('name', $errors) }}">
                                            <label for="name">Stream name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ ($errors && $errors->any()? old('name') : (isset($item)? $item->name : '')) }}">
                                        {!! form_error_message('name', $errors) !!}
                                        </div>
                                        <div class="form-group {{ form_error_class('title', $errors) }}">
                                            <label for="title">Video title</label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{ ($errors && $errors->any()? old('title') : (isset($item)? $item->title : '')) }}">
                                            {!! form_error_message('title', $errors) !!}
                                        </div>
                                        <div class="form-group {{ form_error_class('slug', $errors) }}">
                                            <label for="slug">Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug" value="{{ ($errors && $errors->any()? old('slug') : (isset($item)? $item->slug : '')) }}">
                                            {!! form_error_message('slug', $errors) !!}
                                        </div>
                                        <div class="form-group {{ form_error_class('fbPageID', $errors) }}">
                                            <label for="fbPageID">Facebook Page ID</label>
                                            <input type="text" class="form-control" id="fbPageID" name="fbPageID" value="{{ ($errors && $errors->any()? old('fbPageID') : (isset($item)? $item->fbPageID : '')) }}"/>
                                        </div>
                                    </div>
                                    <div class="col col-md-6">
                                        <div class="form-group {{ form_error_class('fbPageToken', $errors) }}">
                                            <label for="fbPageToken">Facebook Page Token</label>
                                            <input type="text" class="form-control" id="fbPageToken" name="fbPageToken" value="{{ ($errors && $errors->any()? old('fbPageToken') : (isset($item)? $item->fbPageToken : '')) }}"/>
                                        </div>
                                    </div>
                                    <div class="col col-md-6">
                                    <div class="form-group {{ form_error_class('fbStreamURL', $errors) }}">
                                        <label for="fbStreamURL">Facebook Page URL</label>
                                        <input type="text" class="form-control" id="fbStreamURL" name="fbStreamURL" value="{{ ($errors && $errors->any()? old('fbStreamURL') : (isset($item)? $item->fbStreamURL : '')) }}"/>
                                    </div>
                                    </div>


                                    <div class="col col-md-12">
                                    <div class="form-group {{ form_error_class('category_id', $errors) }}">
                                        <label for="category">Category</label>
                                        {!! form_select('category_id', ([0 => 'Please select a Category'] + $categories), ($errors && $errors->any()? old('category_id') : (isset($item)? $item->category_id : '')), ['class' => 'select2 form-control']) !!}
                                        {!! form_error_message('category_id', $errors) !!}
                                    </div>
                                    </div>





                                <div class="col col-md-6">
                                    <div class="form-group {{ form_error_class('active_from', $errors) }}">
                                        <label for="active_from">Active From</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="active_from" data-date-format="YYYY-MM-DD HH:mm:ss" name="active_from" placeholder="Please insert the Active From" value="{{ ($errors && $errors->any()? old('active_from') : (isset($item)? $item->active_from : '')) }}">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        {!! form_error_message('active_from', $errors) !!}
                                    </div>
                                </div>

                                <div class="col col-md-6">
                                    <div class="form-group {{ form_error_class('active_to', $errors) }}">
                                        <label for="active_to">Active To</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="active_to" data-date-format="YYYY-MM-DD HH:mm:ss" name="active_to" placeholder="Please insert the Active To" value="{{ ($errors && $errors->any()? old('active_to') : (isset($item)? $item->active_to : '')) }}">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        {!! form_error_message('active_to', $errors) !!}
                                    </div>
                                </div>

                                <div class="col col-md-12">
                                    <div class="form-group {{ form_error_class('key', $errors) }}">
                                        <label for="key">Key</label>
                                        <input type="text" class="form-control" id="key" name="key" value="{{ ($errors && $errors->any()? old('key') : (isset($item)? $item->key : '')) }}" readonly />
                                    </div>
                                </div>


                                <div class="col-md-12">
                                  <div class="form-group {{ form_error_class('description', $errors) }}">
                                      <label for="article-content">Description</label>
                                      <textarea class="form-control summernote" id="description" name="description" rows="18">{{ ($errors && $errors->any()? old('description') : (isset($item)? $item->description : '')) }}</textarea>
                                      {!! form_error_message('description', $errors) !!}
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
@endsection
@section('scripts')
    @parent
    @if(isset($item))
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
            $.get( "/admin/video-records/live-stream/player/{{ $item->id }}/saveAsTxt/{{ $item->slug }}/key/{{ $item->slug }}?key={{ $item->key }}", function( data ) {
                var head = data.replace('<head>', '');
                var head_end = head.replace('</head>', '');
                var body = head_end.replace('<body>', '');
                $("textarea#embed-content").val(body);
            });
        });
        fileName = "text.html";

        function downloadInnerHtml(filename, mimeType) {
            var elHtml = $('#embed-content').val();
            var link = document.createElement('a');
            mimeType = mimeType || 'text/plain';

            link.setAttribute('download', filename);
            link.setAttribute('href', 'data:' + mimeType  +  ';charset=utf-8,' + encodeURIComponent(elHtml));
            console.log(link);
            link.click();
        }
        $('#downloadLink').click(function(){
            downloadInnerHtml(fileName,'text/html');
        });
    </script>
    @endif
    <script type="text/javascript" charset="utf-8">
        $(function ()
        {
          setDateTimePickerRange('#active_from', '#active_to');
          initSummerNote('.summernote');
        })
    </script>
@endsection
