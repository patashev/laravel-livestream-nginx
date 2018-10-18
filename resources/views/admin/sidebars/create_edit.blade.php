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
                                    <div class="form-group {{ form_error_class('name', $errors) }}">
                                        <label for="sidebar_name">Name</label>
                                        <input type="text" class="form-control input-generate-slug" id="sidebar_name" name="sidebar_name" placeholder="Please insert the Name" value="{{ ($errors && $errors->any()? old('name') : (isset($item)? $item->sidebar_name : '')) }}">
                                        {!! form_error_message('sidebar_name', $errors) !!}
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12">
                                <div class="form-group {{ form_error_class('name', $errors) }}">
                                    <label for="sidebar_type">Type</label>
                                    <input type="text" class="form-control input-generate-slug" id="sidebar_type" name="sidebar_type" placeholder="Please insert the Name" value="{{ ($errors && $errors->any()? old('name') : (isset($item)? $item->sidebar_type : '')) }}">
                                    {!! form_error_message('sidebar_type', $errors) !!}
                                </div>
                              </div>
                            </div>
                            <div class="row">
                            <div class="col col-12">
                                <div class="form-group {{ form_error_class('moduls_id', $errors) }}">
                                    <label for="moduls_id">List Moduls</label>


                                    <div class="well well-sm well-toolbar" id="nestable-menu">

                                        <button type="button" class="btn btn-labeled btn-default text-primary" data-action="create-new" data-id="{{(isset($item)) ? $item->id : '' }}">
                                            <span class="btn-label"><i class="fa fa-fw fa-plus-circle"></i></span>Create New
                                        </button>
                                    </div>

                                    @if(isset($item))
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="dd" id="dd-navigation" style="max-width: 100%">
                                                {!! $itemsHtml !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
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
            initSidebarableMenu(3, "{{ request()->url().'/order' }}");
        })
    </script>
@endsection
