@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-users"></i></span>
                        <span>List All {{ ucfirst(str_plural($resource)) }}</span>
                    </h3>
                </div>

                <div class="box-body">

                    @include('admin.partials.info')

                    <table id="tbl-list" data-server="false" data-page-length="25" class="dt-table table nowrap table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th><i class="fa fa-fw fa-user text-muted"></i> Name</th>
                            <th><i class="fa fa-fw fa-envelope text-muted"></i> Email</th>
                            <th><i class="fa fa-fw fa-envelope text-muted"></i> Api Key</th>
                            <th><i class="fa fa-fw fa-mobile-phone text-muted"></i> Cellphone</th>
                            <th>Roles</th>
                            <th><i class="fa fa-fw fa-calendar text-muted"></i> Last Login</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->fullname }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->api_key }}</td>
                                <td>{{ $item->cellphone }}</td>
                                <td>{{ $item->roles_string }}</td>
                                <td>{{ ($item->logged_in_at)? $item->logged_in_at->diffForHumans():'-' }}</td>
                                <td>
                                    @if($item->id >= 1)
                                        <div class="btn-toolbar">
                                            @if($item->confirmed_at)
                                                <div class="btn-group">
                                                    <form id="impersonate-login-form-{{ $item->id }}" action="{{ route('impersonate.login', $item->id) }}" method="post">
                                                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                                        <a data-form="impersonate-login-form-{{ $item->id }}" class="btn btn-warning btn-xs btn-confirm-modal-row" data-toggle="tooltip" title="Impersonate {{ $item->fullname }}">
                                                            <i class="fa fa-user-secret"></i>
                                                        </a>
                                                    </form>
                                                </div>
                                            @endif

                                            {!! action_row($selectedNavigation->url, $item->id, $item->fullname, ['edit', 'delete'], false) !!}

                                            <div class="btn-group">
                                            <span class="label label-{{ $item->confirmed_at ? 'success':'warning' }}">
                                                {{ $item->confirmed_at ? 'Confirmed ' . $item->confirmed_at->format('d M Y') : 'Not confirmed yet' }}
                                            </span>
                                            </div>
                                        </div>
                                    @else
                                        <span class="label label-info">No Action (primary user)</span>
                                    @endif
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
