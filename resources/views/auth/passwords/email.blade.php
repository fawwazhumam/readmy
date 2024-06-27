@extends('layouts.auth')

@section('content')
<div class="min-h-screen py-12 flex justify-center items-center drawer-content p-4 bg-[url('https://images.pexels.com/photos/1029141/pexels-photo-1029141.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')] bg-no-repeat bg-cover">
    <div id="wrapper" class="bg-white bg-opacity-80 p-8 w-[28rem] rounded-lg border-2 border-white shadow-lg">
        <div class="text-center text-2xl font-bold mb-8">{{ __('Reset Your Password') }}</div>

        <div>
            @if (session('status'))
            <div class="hidden" id="store-message" data-status="{{ session('status') }}"></div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="flex flex-col gap-4">
                    <label for="email">{{ __('Enter Your Email Address') }}</label>

                    <div>
                        <input id=" email" type="email" class="input w-full @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="text-error font-normal text-sm" role="alert">
                            <p>{{ $message }}</p>
                        </span>
                        @enderror
                    </div>

                    <button id="submit-btn" type="submit" class="btn btn-primary text-white self-start">
                        {{ __('Send Me Email Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@if (session('status'))
<script>
    Swal.fire({
        title: 'Success!',
        text: document.getElementById("store-message").getAttribute("data-status") || 'Error',
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif
@endsection