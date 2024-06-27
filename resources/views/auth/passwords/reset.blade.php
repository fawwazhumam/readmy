@extends('layouts.auth')

@section('content')
<div class="min-h-screen py-12 flex justify-center items-center drawer-content p-4 bg-[url('https://images.pexels.com/photos/1029141/pexels-photo-1029141.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')] bg-no-repeat bg-cover">
    <div id="wrapper" class="bg-white bg-opacity-80 p-8 w-[28rem] rounded-lg border-2 border-white shadow-lg">
        <div class="mb-8 text-2xl font-bold text-center">{{ __('Reset Password') }}</div>

        <div>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-4">
                    <label for="email" class="">{{ __('Email Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="input w-full @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="input w-full @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                    <input id="password-confirm" type="password" class="input w-full" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div>
                    <button type="submit" class="btn btn-primary text-white">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection