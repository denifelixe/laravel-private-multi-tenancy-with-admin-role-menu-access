@php
    $views_path = 'resources/views/master/all_roles/tenant/signin';
@endphp

@extends('master.all_roles.layouts.app')

@section('css')
    <link href="{{ asset('css/' . $views_path . '.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __($views_path . '.sign_in_to_your_tenant') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('web.master.all_roles.tenant.signin') }}">
                            @csrf

                            <p align="center"><b>{{ __($views_path . '.enter_your_tenant_url') }}</b></p>

                            <div class="form-group row tenant-signin">
                                <div class="col-md-4 offset-md-2 subdomain">
                                    <input id="subdomain" type="text" class="form-control @error('subdomain') is-invalid @enderror" name="subdomain" value="{{ old('subdomain') }}" placeholder="{{ __($views_path . '.your_tenant_url') }}" required autocomplete="subdomain" autofocus>

                                    @error('subdomain')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 rootdomain">
                                    <div id="rootdomain-div">
                                        <div id="rootdomain-bottom">
                                            <h4 align="left" id="rootdomain">.{{ env('APP_ROOT_DOMAIN') }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row" id="button-form-group-div">
                                <div class="col-md-8 offset-md-2" id="button-div" align="center">
                                    <button id="submit-button" type="submit" class="btn btn-primary">
                                        {{ __($views_path . '.continue') }}
                                    </button>
                                </div>
                            </div>

                            <div class="form-group row mb-0" id="button-form-group-div">
                                <div class="col-md-8 offset-md-2" id="button-div" align="center">
                                    <p class="mb-0">{{ __($views_path . '.dont_know_your_tenant_url') }}</p>
                                    <p class="mb-0"><a class="btn btn-link" href="#">{{ __($views_path . '.find_your_tenants') }}</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
