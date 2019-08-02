@php
    $views_path = 'resources/views/master/superadmin/dashboard';
@endphp

@extends('master.superadmin.layouts.app')

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
                    <a href="{{ route('web.master.superadmin.tenant.register') }}">{{ __($views_path . '.click_here') }}</a> {{ __($views_path . '.for_registering_new_tenant') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
