@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-xs-6">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <span><i class="fa fa-align-center"></i></span>
                    <span>{{ ucfirst($resource) }} Категории изображения от стар архив</span>
                </h3>
            </div>

            <div class="box-body">

                @include('admin.partials.info')

                <div class="well well-sm well-toolbar" id="nestable-menu">
                    <button type="button" class="btn btn-labeled btn-default text-primary" data-action="expand-all">
                        <span class="btn-label"><i class="fa fa-fw fa-plus-circle"></i></span>Разтвори всички
                    </button>

                    <button type="button" class="btn btn-labeled btn-default text-primary" data-action="collapse-all">
                        <span class="btn-label"><i class="fa fa-fw fa-minus-circle text-red"></i></span>Затвори всички
                    </button>
                </div>

                <div class="row">
                    @include('admin.images.partials._partial_catogory_tree')
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection
