<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Readmy') }}</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <!-- Scripts -->
    <!-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) -->
    @vite('resources/css/app.css')
</head>
<body>
    <div
      id="app"
      class="w-full min-h-screen h-max p-12 flex justify-center items-center bg-[url('../images/bg-login.jpg')] bg-no-repeat bg-cover bg-center"
    >
      <div
        id="wrapper"
        class="bg-white bg-opacity-80 p-8 w-[32rem] rounded-lg border-2 border-white"
      >
        <form method="POST" action="{{ route('admin.register.submit') }}" class="flex flex-col items-center px-8">
        @csrf
          <div class="w-full flex gap-4 justify-between items-center">
            <label for="firstName" class="relative mb-4 w-1/2">
              <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-primary"></i>
              <input type="text" id="firstName" placeholder="First Name" class="w-full pl-10 pr-4 py-2 rounded-full shadow outline-primary @error('First_Name') is-invalid @enderror" name="First_Name" value="admin" readonly required autocomplete="First_Name" autofocus>

                @error('First_Name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </label>
            
            <label for="lastName" class="relative mb-4 w-1/2">
              <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-primary"></i>
              <input type="text" id="lastName"placeholder="Last Name" class="w-full pl-10 pr-4 py-2 rounded-full shadow outline-primary @error('Last_Name') is-invalid @enderror" name="Last_Name" value="{{ old('Last_Name') }}" required autocomplete="Last_Name" autofocus>

                @error('Last_Name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </label>
          </div>
          <label for="birth" class="relative mb-4 w-full">
            <i
              class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-primary"
            ></i>
            <input type="date" id="birth" placeholder="Tanggal Lahir" class="w-full pl-10 pr-4 py-2 rounded-full shadow outline-primary @error('Date') is-invalid @enderror" name="Date" value="{{ old('Date') }}" required autocomplete="Date" autofocus>

            @error('Date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </label>
          <label for="Gender" class="relative mb-4 w-full">
              <!-- <i class="fa-solid fa-user absolute left-4 top-1/2 -translate-y-1/2 text-primary"></i> -->
              <select class="form-control @error('Gender') is-invalid @enderror" id="exampleFormControlSelect1" name="Gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Not set">Prefer not to say</option>
                </select>
                @error('Gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </label>

          <label for="email" class="relative mb-4 w-full">
            <i
              class="fa-solid fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-primary"></i>
            <input type="email" id="email" placeholder="Email" class="w-full pl-10 pr-4 py-2 rounded-full shadow outline-primary @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </label>
          <label for="password" class="relative mb-4 w-full">
            <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-primary"></i>
            <input type="password" id="password" placeholder="Password" class="w-full pl-10 pr-4 py-2 rounded-full shadow outline-primary @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </label>
          <label for="password" class="relative mb-4 w-full">
            <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-primary"></i>
            <input type="password" id="password" placeholder="Confirm Password" id="password-confirm" type="password" class="w-full pl-10 pr-4 py-2 rounded-full shadow outline-primary" name="password_confirmation" required autocomplete="new-password">
          </label>
            <button
            type="submit"
            class="px-6 py-2 mb-2 rounded-full bg-primary text-white font-bold hover:bg-green-600 duration-300"
          >
            Add
          </button>
        </form>
      </div>
    </div>
    <script src="assets/scripts/main.js"></script>
</body>
</html>
