@php
    $views_path = 'resources/views/master/superadmin/tenant/register';
@endphp

@extends('master.superadmin.layouts.app')

@section('content')
<div class="container">

    @if ($errors->any())
        <div class="row justify-content-center mb-10">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-danger mb-0">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __($views_path . '.create_tenant') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('web.master.superadmin.tenant.register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="subdomain" class="col-md-4 col-form-label text-md-right">{{ __($views_path . '.subdomain') }}</label>

                            <div class="col-md-6">
                                <input id="subdomain" type="text" class="form-control @error('subdomain') is-invalid @enderror" name="subdomain" value="{{ old('subdomain') }}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="db-connection" class="col-md-4 col-form-label text-md-right">{{ __($views_path . '.db_connection_driver') }}</label>

                            <div class="col-md-6">
                                <select id="db-connection" class="form-control @error('db_connection') is-invalid @enderror" name="db_connection" required>
                                    @foreach ($db_connections as $db_connection_id => $db_connection_name)
                                        <option value="{{ $db_connection_id }}" {{ (old('db_connection') == $db_connection_id) ? 'selected' : '' }}>{{ $db_connection_name }}</option>
                                    @endforeach
                                </select>

                                @error('db_connection')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="db-url" class="col-md-4 col-form-label text-md-right">{{ __($views_path . '.db_url') }}</label>

                            <div class="col-md-6">
                                <input id="db-url" type="text" class="form-control @error('db_url') is-invalid @enderror" name="db_url" value="{{ old('db_url') }}">

                                @error('db_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="db-host" class="col-md-4 col-form-label text-md-right">{{ __($views_path . '.db_host') }}</label>

                            <div class="col-md-6">
                                <input id="db-host" type="text" class="form-control @error('db_host') is-invalid @enderror" name="db_host" value="{{ old('db_host') }}">

                                @error('db_host')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="db-port" class="col-md-4 col-form-label text-md-right">{{ __($views_path . '.db_port') }}</label>

                            <div class="col-md-6">
                                <input id="db-port" type="number" min="1000" max="9999" class="form-control @error('db_port') is-invalid @enderror" name="db_port" value="{{ old('db_port') }}">
                                
                                @error('db_port')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="db-name" class="col-md-4 col-form-label text-md-right">{{ __($views_path . '.db_name') }}</label>

                            <div class="col-md-6">
                                <input id="db-name" type="text" class="form-control @error('db_name') is-invalid @enderror" name="db_name" value="{{ old('db_name') }}" required>

                                @error('db_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="db-username" class="col-md-4 col-form-label text-md-right">{{ __($views_path . '.db_username') }}</label>

                            <div class="col-md-6">
                                <input id="db-username" type="text" class="form-control @error('db_username') is-invalid @enderror" name="db_username" value="{{ old('db_username') }}">

                                @error('db_username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="db-password" class="col-md-4 col-form-label text-md-right">{{ __($views_path . '.db_password') }}</label>

                            <div class="col-md-6">
                                <input id="db-password" type="password" class="form-control @error('db_password') is-invalid @enderror" name="db_password" value="{{ old('db_password') }}">

                                @error('db_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="db-socket" class="col-md-4 col-form-label text-md-right">{{ __($views_path . '.db_socket') }}</label>

                            <div class="col-md-6">
                                <input id="db-socket" type="text" class="form-control @error('db_socket') is-invalid @enderror" name="db_socket" value="{{ old('db_socket') }}">

                                @error('db_socket')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="db-foreign-keys" class="col-md-4 col-form-label text-md-right">{{ __($views_path . '.db_foreign_keys') }}</label>

                            <div class="col-md-6">
                                <input id="db-foreign-keys" type="text" class="form-control @error('db_foreign_keys') is-invalid @enderror" name="db_foreign_keys" value="{{ old('db_foreign_keys') }}">

                                @error('db_foreign_keys')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __($views_path . '.submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
