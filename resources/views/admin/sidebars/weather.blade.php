@extends('layouts.admin')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">
						<span><i class="fa fa-table"></i></span>
						<span>List All Tags</span>
					</h3>
				</div>

				<div class="box-body">



					@include('admin.partials.toolbar')

					<table id="tbl-list" data-server="false" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
              <th>City</th>
              <th>Forcast</th>
							<th>Date</th>
              <th width="8%"></th>
							<th></th>
						</tr>
						</thead>
						<tbody>
						@foreach ($items as $item)
							<tr>
								<td>{{ $item->cities->title }}</td>
                <td>{{ $item->weather_types->name }}</td>
                <td>{{ $item->created_at }}</td>
                <td><img src="/images/{{ $item->weather_types->icon_name }}" class="mx-auto text-center d-block" width="100"></td>
								<td>{!! action_row($selectedNavigation->url, $item->id, $item->name, ['edit', 'delete', 'show']) !!}</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
