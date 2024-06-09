@extends('layouts.app')

@section('content')

<div class="px-48 py-12">
    <section id="hero" class="relative bg-slate-400 bg-no-repeat bg-cover bg-center flex items-center rounded-lg">
        <img class="w-full rounded-xl" src="{{ asset('Photo/' . Auth::user()->Header_File_Name) }}">
    </section>
    <section class="absolute px-24 left-4 transform translate-x-1/2 -translate-y-1/2 mb-2 z-10">
        <img class="w-48 h-48 shadow-lg text-center rounded-full border-4 bg-slate-500 border-white" style="object-fit: cover; object-position: center;" src="{{ asset('Photo/' . Auth::user()->File_Name) }}">
    </section>
</div>
<div class="px-48 py-24">
    <section class="px-24 py-4 flex justify-between items-center">
        <div>
            <h2 class="py-4 font-bold text-xl">{{ Auth::user()->First_Name }}</h2>
            <p><a href="{{ route('viewFollowings') }}">Following: </a> {{ Auth::user()->followings_count }}</p>
            <p><a href="{{ route('viewFollowers') }}">Followers: </a> {{ Auth::user()->followers_count }}</p>
            <br>

            <p>Student at Universitas Amikom Yogyakarta,
                @if (Auth::user()->Gender == 'Male')
                (he/him)
                @elseif (Auth::user()->Gender == 'Female')
                (she/her)
                @else
                (prefer not to say)
                @endif
            </p>
        </div>
        <div class="flex items-center gap-4">
            <a href="/editProfile">Edit Profile</a>
            <button class="px-4 py-2 font-semibold shadow-lg bg-gray-50 hover:bg-green-600 hover:text-white text-black rounded-full">Message</button>
        </div>
    </section>
    <section class="px-24">
        <div>
            <a>Joined {{Auth::user()->created_at->format('d M Y') }}</a>
            <a class="px-2">📍 {{ Auth::user()->Address }}</a>
            <a class="px-2">❤️ {{ $totalLikes }}</a>
        </div>
        <h2 class="py-4 font-bold">About</h2>
        <p>{{ Auth::user()->Bio }}</p>
        <h2 class="py-4 font-bold">Tag</h2>
        <div id="category-container" class="flex gap-4 my-2">
            <button class="px-5 py-2 bg-green-600 text-white rounded-full">ALL</button>
            <button class="px-5 py-2 bg-green-600 bg-opacity-70 text-white rounded-full">Adult</button>
            <button class="px-5 py-2 bg-green-600 bg-opacity-70 text-white rounded-full">Children</button>
        </div>
    </section>

    <section class="py-12">
        <h2 class="font-bold text-lg">My Books</h2>
        <div id="card-book-container" class="flex gap-4 my-4">
            @foreach($files as $file)
            <a href="{{ route('viewFile', ['fileName' => $file->File_Name]) }}" class="w-56 h-96 p-4 bg-[#fafaf9] shadow-lg rounded-lg">
                <img class="w-full h-4/5 rounded-md" src="{{ asset('images/card-book-placeholder.jpg') }}" alt="book" />
                <div>
                    <h4 class="font-bold">{{$file->Title}}</h4>
                    <p>Published by <span class="text-sky-500">{{ Auth::user()->First_Name }}</span></p>
                    @if ($file->Type == 'Public')
                    🟢 Published
                    @else
                    🔴 Private
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </section>
</div>

@endsection