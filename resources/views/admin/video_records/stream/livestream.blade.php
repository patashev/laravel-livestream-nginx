
@extends('layouts.admin')
@section('content')


    <div class="row">
        <div class="col-xs-12">

        	@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
            <div class="box box-primary box-solid">
            	<div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-table"></i></span>
                        <span>List All Streams</span>
                    </h3>
                </div>
                <div class="box-body">
                	@include('admin.partials.info')
                	<div class="well well-sm well-toolbar">

                        <a class="btn btn-labeled btn-primary" href="{{ Request::url().'/create' }}">
                            <span class="btn-label"><i class="fa fa-fw fa-plus"></i></span>Create {{ ucfirst($resource) }}
                        </a>
                    </div>
                     <table id="tbl-list" data-server="false" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>RTMP Server</th>
                            <th>RTMP Stream Key</th>
                            <th>Date created</th>
                            <th style="min-width: 100px;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->title }}</td>
                                <td><p>rtmp://{{ request()->server->get('SERVER_NAME') }}/live/</p></td>
                                <td>{{ $item->slug }}?key={{ $item->key }}</td>
                                <td>{{ $item->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="btn-toolbar">
                                        <div class="btn-group">

                                        </div>
                                        {!! action_row($selectedNavigation->url, $item->id, $item->name, ['edit', 'delete'], false) !!}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
              </div>

        </div>
    </div>
@endsection
