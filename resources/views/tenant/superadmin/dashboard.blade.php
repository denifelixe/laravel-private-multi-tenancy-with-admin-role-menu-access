@php
    $views_path = 'resources/views/tenant/superadmin/dashboard';
@endphp

@extends('tenant.superadmin.layouts.app')

@section('css')
    <link href="{{ asset('css/' . $views_path . '.css') }}" rel="stylesheet">

    <!-- DataTable -->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">{{ __($views_path . '.dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __($views_path . '.you_are_logged_in') }} <br>
                        <a href="{{ route('web.tenant.superadmin.admin_role.create', ['tenant' => subdomain()]) }}">{{ __($views_path . '.click_here') }}</a> {{ __($views_path . '.for_registering_new_admin_role') }} <br>
                        <a href="{{ route('web.tenant.admin.register', ['tenant' => subdomain()]) }}">{{ __($views_path . '.click_here') }}</a> {{ __($views_path . '.for_registering_new_admin') }}
                    </div>
                </div>

                <div class="card m-t-15">
                    <div class="card-header">{{ __($views_path . '.admin_roles') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table id="roles-table">
                            <thead>
                                <tr>
                                    <th>{{ __($views_path . '.name') }}</th>
                                    <th>{{ __($views_path . '.menu_access') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin_roles as $admin_role)
                                    <tr>
                                        <td>{{ $admin_role['name'] }}</td>
                                        <td><a href="{{ route('web.tenant.superadmin.admin_role_menu_web_access', ['tenant' => subdomain(), 'admin_role_id' => $admin_role['id']]) }}">{{ __($views_path . '.menu_access') }}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card m-t-15">
                    <div class="card-header">{{ __($views_path . '.admins') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table id="admins-table">
                            <thead>
                                <tr>
                                    <th>{{ __($views_path . '.name') }}</th>
                                    <th>{{ __($views_path . '.email') }}</th>
                                    <th>{{ __($views_path . '.role') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $admin['name'] }}</td>
                                        <td>{{ $admin['email'] }}</td>
                                        <td>{{ $admin['role']['name'] ?: '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- DataTable -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    
    <script src="{{ asset('js/' . $views_path . '.js') }}"></script>    
@endsection