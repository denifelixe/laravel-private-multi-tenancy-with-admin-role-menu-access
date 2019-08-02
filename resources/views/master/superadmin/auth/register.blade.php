@php
    $views_path = 'resources/views/master/superadmin/auth/register';
@endphp

@extends('master.superadmin.layouts.app')

@section('css')
    <link href="{{ asset('css/' . $views_path . '.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __($views_path . '.register_to') . ' ' . strtoupper(subdomain()) }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('web.master.superadmin.register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __($views_path . '.name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __($views_path . '.email_address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __($views_path . '.password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __($views_path . '.confirm_password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sms-verification-code" class="col-md-4 col-form-label text-md-right">{{ __($views_path . '.sms_verification_code') }} <span class="red-asterisk">*</span></label>

                                <div class="col-md-6">
                                    <input id="sms-verification-code" type="text" class="form-control @error('sms_verification_code') is-invalid @enderror" name="sms_verification_code" value="{{ old('sms_verification_code') }}" required>

                                    @error('sms_verification_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email-verification-code" class="col-md-4 col-form-label text-md-right">{{ __($views_path . '.email_verification_code') }} <span class="red-asterisk">*</span></label>

                                <div class="col-md-6">
                                    <input id="email-verification-code" type="text" class="form-control @error('email_verification_code') is-invalid @enderror" name="email_verification_code" value="{{ old('email_verification_code') }}" required>

                                    @error('email_verification_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-md-4 col-md-6">
                                    <small><i>Click <a href="javascript:void(0);" id="store-verification-code">here</a> to send sms and email verification code.</i></small>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __($views_path . '.register') }}
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

@section('js')
    <script src="{{ asset('js/' . $views_path . '.js') }}"></script>
@endsection
