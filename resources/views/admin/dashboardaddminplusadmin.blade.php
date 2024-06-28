@extends('layouts.admin')

@section('content')
<div class="min-h-screen flex-col flex justify-center items-center">
  <form method="POST" action="{{ route('admin.register.submit') }}" class="flex flex-col items-center max-w-xl p-4 bg-gray-100 rounded-lg shadow-lg">
    <h1 class="font-bold text-3xl text-center mb-8">Add New Admin</h1>
    @csrf
    <div class="w-full flex gap-4 justify-between items-center">
      <label for="firstName" class="relative mb-4 w-1/2">
        <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-primary"></i>
        <input type="text" id="firstName" placeholder="First Name" class="input input-bordered input-primary w-full pl-10 rounded-full border-none shadow @error('First_Name') is-invalid @enderror" name="First_Name" value="admin" disabled required autocomplete="First_Name" autofocus>

        @error('First_Name')
        <span class="invalid-feedback" role="alert">
          <p class="text-error text-sm">{{ $message }}</p>
        </span>
        @enderror
      </label>

      <label for="lastName" class="relative mb-4 w-1/2">
        <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-primary"></i>
        <input type="text" id="lastName" placeholder="Last Name" class="input input-bordered input-primary w-full pl-10 rounded-full border-none shadow @error('Last_Name') is-invalid @enderror" name="Last_Name" value="{{ old('Last_Name') }}" required autocomplete="Last_Name" autofocus>

        @error('Last_Name')
        <span class="invalid-feedback" role="alert">
          <p class="text-error text-sm">{{ $message }}</p>
        </span>
        @enderror
      </label>
    </div>
    <label for="birth" class="relative mb-4 w-full">
      <i class="fa-solid fa-cake-candles absolute left-4 top-1/2 -translate-y-1/2 text-primary"></i>
      <input type="date" id="birth" placeholder="Tanggal Lahir" class="input input-bordered input-primary w-full pl-10 rounded-full border-none shadow @error('Date') is-invalid @enderror" name="Date" value="{{ old('Date') }}" required autocomplete="Date" autofocus>

      @error('Date')
      <span class="invalid-feedback" role="alert">
        <p class="text-error text-sm">{{ $message }}</p>
      </span>
      @enderror
    </label>
    <label for="Gender" class="relative mb-4 w-full">
      <i class="fa-solid fa-venus-mars absolute left-4 top-1/2 -translate-y-1/2 text-primary"></i>
      <select class="select select-bordered w-full select-primary border-none shadow rounded-full pl-10 @error('Gender') is-invalid @enderror" id="exampleFormControlSelect1" name="Gender">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Not set">Prefer not to say</option>
      </select>
      @error('Gender')
      <span class="invalid-feedback" role="alert">
        <p class="text-error text-sm">{{ $message }}</p>
      </span>
      @enderror
    </label>

    <label for="email" class="relative mb-4 w-full">
      <i class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-primary"></i>
      <input type="email" id="email" placeholder="Email" class="input input-bordered input-primary w-full pl-10 rounded-full border-none shadow @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

      @error('email')
      <span class="invalid-feedback" role="alert">
        <p class="text-error text-sm">{{ $message }}</p>
      </span>
      @enderror
    </label>
    <label for="password" class="relative mb-4 w-full">
      <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-primary"></i>
      <input type="password" id="password" placeholder="Password" class="input input-bordered input-primary w-full pl-10 rounded-full border-none shadow @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

      @error('password')
      <span class="invalid-feedback" role="alert">
        <p class="text-error text-sm">{{ $message }}</p>
      </span>
      @enderror
    </label>
    <label for="password" class="relative mb-4 w-full">
      <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-primary"></i>
      <input type="password" id="password" placeholder="Confirm Password" id="password-confirm" type="password" class="input input-bordered input-primary w-full pl-10 rounded-full border-none shadow" name="password_confirmation" required autocomplete="new-password">
    </label>
    <button type="submit" class="btn btn-primary rounded-full w-32 text-white duration-300">
      Add New Admin
    </button>
  </form>
</div>

@endsection