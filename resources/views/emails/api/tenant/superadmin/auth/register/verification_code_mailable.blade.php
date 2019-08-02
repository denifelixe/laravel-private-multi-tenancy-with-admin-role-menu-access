@php
    $views_path = 'resources/views/emails/api/master/superadmin/auth/register/verification_code_mailable';
@endphp

@component('mail::message')
	# Email Verification Code ({{ subdomain() }})

	{{ __($views_path . '.message', ['email' => $email, 'email_verification_code' => $email_verification_code]) }}

	Thanks,
	{{ config('app.name') }}
@endcomponent
