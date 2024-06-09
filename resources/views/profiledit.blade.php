@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('updateProfile') }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <!-- Hero section -->
    <div class="px-48 py-12">
        <section id="hero" class="relative bg-slate-400 bg-no-repeat bg-cover bg-center flex items-center rounded-lg">
            <img id="hero-image" class="w-full rounded-xl cursor-pointer" src="{{ asset('Photo/' . Auth::user()->Header_File_Name) }}" onclick="document.getElementById('hero-file').click();">
            <input type="file" id="hero-file" name="Header_File_Name" class="hidden" accept="image/*" onchange="previewHeroImage(event)">
            <!-- Isi hero section -->
        </section>

        <!-- Profile section -->
        <section class="absolute px-24 left-4 transform translate-x-1/2 -translate-y-1/2 mb-2 z-10">
            <img id="profile-image" class="w-48 h-48 shadow-lg text-center rounded-full border-4 bg-slate-500 border-white cursor-pointer" style="object-fit: cover; object-position: center;" src="{{ asset('Photo/' . Auth::user()->File_Name) }}" onclick="document.getElementById('profile-file').click();">
            <input type="file" id="profile-file" name="File_Name" class="hidden" accept="image/*" onchange="previewProfileImage(event)">
        </section>
    </div>
    <div class="px-48 py-24">

        <section class="flex px-24 py-4 gap-4">
            <div class="w-full md:w-1/2 px-4 mb-6 md:mb-0">
                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    First Name
                </label>
                <input class="appearance-none block w-full bg-gray-50 shadow-lg border rounded-full py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white @error('First_Name') is-invalid @enderror" name="First_Name" value="{{ $user->First_Name }}" required autocomplete="First_Name" autofocus id="grid-first-name" type="text">
                @error('First_Name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="w-full md:w-1/2 px-4">
                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Last Name
                </label>
                <input class="appearance-none block w-full bg-gray-50 shadow-lg border rounded-full py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white @error('Last_Name') is-invalid @enderror" name="Last_Name" value="{{ $user->Last_Name }}" required autocomplete="Last_Name" autofocus id="grid-first-name" type="text">
                @error('Last_Name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </section>
        <section class="flex px-24 py-4 gap-4">
            <div class="w-full md:w-1/2 px-4">
                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-bird-date">
                    Birth Date
                </label>
                <input class="appearance-none block w-full bg-gray-50 shadow-lg border rounded-full py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white @error('Date') is-invalid @enderror" name="Date" value="{{ $user->Date }}" required autocomplete="Date" autofocus id="grid-bird-date" type="date">
                @error('Date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="w-full md:w-1/2 px-4 mb-6 md:mb-0">
                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Gender
                </label>
                <select class="appearance-none block w-full bg-gray-50 shadow-lg border rounded-full py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white form-control @error('Gender') is-invalid @enderror" id="exampleFormControlSelect1" name="Gender">
                    <option value="Male" {{ $user->Gender == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ $user->Gender == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Not set" {{ $user->Gender == 'Not set' ? 'selected' : '' }}>Prefer not to say</option>
                </select>
                @error('Gender')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </section>
        <section class="flex px-24 py-4 gap-4">
            <div class="w-full md:w-1/2 px-4 mb-6 md:mb-0">
                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Email
                </label>
                <input class="appearance-none block w-full bg-gray-50 shadow-lg border rounded-full py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white @error('email') is-invalid @enderror" value="{{ $user->email }}" readonly autocomplete="email" autofocus id="grid-first-name" type="email">
            </div>

            <div class="w-full md:w-1/2 px-4">
                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Role
                </label>
                <select class="appearance-none block w-full bg-gray-50 shadow-lg border rounded-full py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white form-control @error('Role') is-invalid @enderror" id="exampleFormControlSelect1" name="Role">
                    <option value="Adult" {{ $user->Role == 'Adult' ? 'selected' : '' }}>Adult</option>
                    <option value="Children" {{ $user->Role == 'Children' ? 'selected' : '' }}>Children</option>
                    <option value="Student" {{ $user->Role == 'Student' ? 'selected' : '' }}>Student</option>
                    <option value="Writer" {{ $user->Role == 'Writer' ? 'selected' : '' }}>Writer</option>
                </select>
                @error('Role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </section>
        <section class="flex px-24 py-4 gap-4">
            <div class="relative w-full md:w-1/2 px-4 mb-6 md:mb-0">
                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Bio
                </label>
                <input class="appearance-none block w-full bg-gray-50 shadow-lg border rounded-full py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white @error('Bio') is-invalid @enderror" id="grid-first-name" type="text" value="{{ $user->Bio }}" name="Bio">
            </div>

            <div class="relative w-full md:w-1/2 px-4 mb-6 md:mb-0">
                <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                    Address
                </label>
                <input class="appearance-none block w-full bg-gray-50 shadow-lg border rounded-full py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white @error('Address') is-invalid @enderror" id="grid-first-name" type="text" value="{{ $user->Address }}" name="Address">
                @error('Address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </section>
        <section class="px-24 py-4">
            <div class="px-4 items-center gap-4">
                <button type="button" onclick="history.back()" class="shadow-lg bg-red-600 text-white font-semibold rounded-full px-4 py-2 hover:bg-secondary hover:text-white">Back</button>
                <button type="submit" class="shadow-lg bg-green-600 text-white font-semibold rounded-full px-4 py-2 hover:bg-secondary hover:text-white">{{ __('Save') }}</button>
            </div>
        </section>
</form>

<script>
    function previewHeroImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('hero-image');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    function previewProfileImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('profile-image');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
</body>
@endsection