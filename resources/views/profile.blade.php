@extends('layouts.app')

@section('content')
<section id="hero" class="relative bg-slate-400 bg-no-repeat bg-cover bg-center flex items-center rounded-lg">
    <img class="max-h-36 md:max-h-96 object-cover object-center w-full rounded-xl" src="{{ asset('Photo/' . Auth::user()->Header_File_Name) }}">
</section>

<div>
    <section class="py-4 flex flex-col">
        <div class="flex gap-4 items-center justify-between mb-4">
            <div class="flex gap-4 items-center md:px-8 py-4">
                <div class="avatar">
                    <div class="w-28 md:w-36 shadow-lg rounded-full">
                        <img src="{{ asset('Photo/' . Auth::user()->File_Name) }}" />
                    </div>
                </div>
                <div>
                    <span class="py-4 flex items-center gap-1">
                        <h2 class="font-bold text-xl md:text-2xl">{{ Auth::user()->First_Name . " " . Auth::user()->Last_Name }}</h2>
                        <p>
                            @if (Auth::user()->Gender == 'Male')
                            (he/him)
                            @elseif (Auth::user()->Gender == 'Female')
                            (she/her)
                            @else
                            (prefer not to say)
                            @endif
                        </p>
                    </span>
                    <div class="flex gap-4">
                        <p class="hover:text-primary hover:underline duration-300">{{ Auth::user()->followers_count }}<a href="{{ route('viewFollowers') }}"> Followers</a></p>
                        <p class="hover:text-primary hover:underline duration-300">{{ Auth::user()->followings_count }}<a href="{{ route('viewFollowings') }}"> Following</a></p>
                    </div>
                </div>
            </div>
            <a class="btn btn-primary rounded-full text-white hidden md:inline-flex mr-20" href="/editProfile">Edit Profile</a>
        </div>
        <a class="btn btn-primary w-full rounded-full text-white md:hidden" href="/editProfile">Edit Profile</a>
        <div class="divider md:hidden"></div>
    </section>
    <section>
        <div>
            <a>Joined {{Auth::user()->created_at->format('d M Y') }}</a>
            <a class="px-2">📍 {{ Auth::user()->Address }}</a>
            <a class="px-2">❤️ {{ $totalLikes }}</a>
        </div>
        <h2 class="py-4 font-bold">About</h2>
        <p>{{ Auth::user()->Bio }}</p>
        <div class="divider invisible md:visible"></div>
    </section>

    <section>
        <h2 class="font-bold text-lg">Published Books</h2>
        <div class="py-4 flex gap-4 overflow-x-auto hide-scrollbar">
            @foreach ($files as $file)
            <x-book-card :file="$file" />
            @endforeach
        </div>
    </section>
</div>


@endsection