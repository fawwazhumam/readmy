@extends('layouts.auth')

@section('content')
<div class="min-h-screen py-12 flex justify-center items-center drawer-content p-4 bg-[url('https://images.pexels.com/photos/159711/books-bookstore-book-reading-159711.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')] bg-no-repeat bg-cover">
  <div id="wrapper" class="bg-white bg-opacity-80 p-8 w-[28rem] rounded-lg border-2 border-white">
    <div class="flex flex-col items-center my-10">
      <a class="w-full flex justify-center" href="/">
        <img src="{{ asset('images/favicon.png') }}" alt="logo" class="mb-4 w-1/2" />
      </a>
      <p class="mb-4 text-center">Login ke akunmu untuk menikmati fitur lainnya.</p>
    </div>
    <form method="POST" action="{{ route('login') }}" class="flex flex-col items-center">
      @csrf
      <label for="email" class="relative mb-4 w-full">
        <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-primary"></i>
        <input type="email" id="email" placeholder="Email" class="input input-bordered input-primary w-full pl-10 rounded-full border-none shadow  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
        @error('email')
        <span class="text-sm text-error" role="alert">
          <p>{{ $message }}</p>
        </span>
        @enderror
      </label>
      <label for="password" class="relative mb-4 w-full">
        <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-primary"></i>
        <input type="password" id="password" placeholder="Password" class="input input-bordered input-primary w-full pl-10 rounded-full border-none shadow @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
        @error('password')
        <span class="text-sm text-error" role="alert">
          <p>{{ $message }}</p>
        </span>
        @enderror
      </label>
      <div class="form-control self-start">
        <label class="label cursor-pointer">
          <input type="checkbox" class="checkbox checkbox-primary mr-2" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
          <label class="form-check-label" for="remember">
            {{ __('Remember Me') }}
          </label>
        </label>
      </div>
      <button type="submit" class="btn btn-primary rounded-full w-32 text-white duration-300">
        Login
      </button>
      <p class="text-sm">
        Belum punya akun? <a class="text-primary underline hover:text-accent" href="{{ route('register') }}">Sign Up</a>
      </p>
      <div class="px-8 pb-8 border-secondary w-full flex flex-col gap-4 justify-center items-center">
        <div class="divider">OR</div>
        <button type="button" class="btn btn-base-100 w-80 rounded-full shadow">
          <i class="fa-brands fa-google"></i>
          <p class="inline ml-3">Login With Google</p>
        </button>
        @if (Route::has('password.request'))
        <a class="text-sm hover:underline duration-300 hover:text-primary" href="{{ route('password.request') }}">
          {{ __('Forgot Your Password?') }}
        </a>
        @endif
      </div>
    </form>
  </div>
</div>


@endsection