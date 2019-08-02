@php
    $views_path = 'resources/views/tenant/superadmin/admin_role_menu_web_access/edit';
@endphp

@extends('tenant.superadmin.layouts.app')

@section('css')
    <!-- DataTable -->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    
    <link href="{{ asset('css/' . $views_path . '.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">{{ __($views_path . '.admin_role_menu_web_access') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('web.tenant.superadmin.admin_role_menu_web_access.update', ['tenant' => subdomain(), 'admin_role_id' => $admin_role['id']]) }}" method="POST">

                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="display-table height-full">
                                        <div class="display-table-cell vertical-align-middle">
                                            <h4 class="m-b-0">{{ $admin_role['name'] }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 align-right">
                                    <button type="submit" class="btn btn-success">
                                        {{ __($views_path . '.submit') }}
                                    </button>
                                </div>
                            </div>

                            <hr>

                            <table id="role-menus-access-table">
                                <thead>
                                    <tr>
                                        <th>{{ __($views_path . '.menu') }}</th>
                                        <th>{{ __($views_path . '.access') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menus_web as $menu_web)
                                        <tr>
                                            <td>{{ $menu_web['name'] }}</td>
                                            <td>
                                                <input type="hidden" name="{{ "menu_web_ids[{$menu_web['id']}]" }}" value="0">
                                                <input class="form-control" type="checkbox" name="{{ "menu_web_ids[{$menu_web['id']}]" }}" value="1" {{ old('menu_web_ids') ? (old('menu_web_ids')[$menu_web['id']] !== "0" ? 'checked' : '') : (isset($menus_web_access[$menu_web['id']]) ? 'checked' : '') }}>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
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