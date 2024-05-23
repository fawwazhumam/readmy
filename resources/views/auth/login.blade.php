@extends('layouts.app')

@section('content')
<body>
    <div
      id="app"
      class="w-full min-h-screen h-max p-12 flex justify-center items-center bg-[url('../images/bg-login.jpg')] bg-no-repeat bg-cover bg-center"
    >
      <div
        id="wrapper"
        class="bg-white bg-opacity-80 p-8 w-[28rem] rounded-lg border-2 border-white"
      >
        <div class="flex flex-col items-center my-10">
          <a class="w-full flex justify-center" href="index.html">
            <img src="{{ asset('images/favicon.png') }}" alt="logo" class="mb-4 w-1/2" />
          </a>
          <p class="mb-4">Login ke akunmu untuk menikmati fitur lainnya.</p>
        </div>
        <form method="POST" action="{{ route('login') }}" class="flex flex-col items-center">
        @csrf
          <label for="email" class="relative mb-4 w-4/5">
                <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-primary"></i>
                <input type="email" id="email" placeholder="Email" class="pl-10 pr-4 py-2 rounded-full shadow outline-primary @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror
          </label>
          <label for="password" class="relative mb-4 w-4/5">
            <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-primary"></i>
            <input type="password" id="password" placeholder="Password" class="pl-10 pr-4 py-2 rounded-full shadow outline-primary @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </label>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
        </div>
          <button
            type="submit"
            class="px-6 py-2 mb-2 rounded-full bg-primary text-white font-bold hover:bg-green-600 duration-300"
          >
            Login
          </button>
          <p class="text-sm mb-4">
            Belum punya akun? <a class="text-primary underline" href="{{ route('register') }}">Sign Up</a>
          </p>
          <div
            class="px-8 pt-4 pb-8 border-t-2 border-secondary w-full flex flex-col gap-4 justify-center items-center"
          >
            <p class="font-bold">OR</p>
            <button
              type="button"
              class="px-8 py-2 rounded-full bg-primary text-white font-bold hover:bg-green-600 duration-300"
            >
              <i class="fa-brands fa-google"></i>
              <p class="inline ml-3">Login With Google</p>
            </button>
            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
          </div>
        </form>
      </div>
    </div>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

@endsection
