@extends('layouts.app')

@section('content')
<section id="hero" class="relative bg-slate-400 bg-no-repeat bg-cover bg-center flex items-center rounded-lg">
    <img class="max-h-36 md:max-h-96 object-cover object-center w-full rounded-xl" src="{{ asset('Photo/' . $user->Header_File_Name) }}">
</section>
<div>
    <section class="py-4 flex flex-col">
        <div class="flex gap-4 items-center justify-between mb-4">
            <div class="flex gap-4 items-center md:px-8 py-4">
                <div class="avatar">
                    <div class="w-28 md:w-36 shadow-lg rounded-full">
                        <img src="{{ asset('Photo/' . $user->File_Name) }}" />
                    </div>
                </div>
                <div>
                    <span class="py-4 flex items-center gap-1">
                        <h2 class="font-bold text-xl md:text-2xl">{{ $user->First_Name . " " . $user->Last_Name }}</h2>
                        <p>
                            @if ($user->Gender == 'Male')
                            (he/him)
                            @elseif ($user->Gender == 'Female')
                            (she/her)
                            @else
                            (prefer not to say)
                            @endif
                        </p>
                    </span>
                    <div class="flex gap-4">
                        <p class="hover:text-primary hover:underline duration-300">{{ $user->followers_count }}<a href="{{ route('viewFollowers') }}"> Followers</a></p>
                        <p class="hover:text-primary hover:underline duration-300">{{ $user->followings_count }}<a href="{{ route('viewFollowings') }}"> Following</a></p>
                    </div>
                </div>
            </div>
            @if(Auth::user())
            @if ($user->id !== Auth::user()->id)
            @if(Auth::user()->isFollowing($user->id))
            <form method="POST" action="{{ route('unfollow', ['id' => $user->id]) }}">
                @csrf
                <button type="submit" class="btn btn-error rounded-full text-white hidden md:inline-flex mr-20">Unfollow</button>
            </form>
            @else
            <form method="POST" action="{{ route('followUser', ['id' => $user->id]) }}">
                @csrf
                <button type="submit" class="btn btn-primary rounded-full text-white hidden md:inline-flex mr-20">Follow</button>
            </form>
            @endif
            @endif
            @else
            <a class="btn btn-primary rounded-full text-white hidden md:inline-flex mr-20" href="/login">Login to Follow</a>
            @endif
        </div>
        @if(Auth::user())
        @if ($user->id !== Auth::user()->id)
        @if(Auth::user()->isFollowing($user->id))
        <form method="POST" action="{{ route('unfollow', ['id' => $user->id]) }}">
            @csrf
            <button type="submit" class="btn btn-error w-full md:hidden text-white rounded-full">Unfollow</button>
        </form>
        @else
        <form method="POST" action="{{ route('followUser', ['id' => $user->id]) }}">
            @csrf
            <button type="submit" class="btn btn-primary w-full md:hidden text-white rounded-full">Follow</button>
        </form>
        @endif
        @endif
        @else
        <a class="btn btn-primary rounded-full text-white md:hidden mr-20" href="/login">Login to Follow</a>
        @endif
        <div class="divider md:hidden"></div>
    </section>
    <section>
        <div>
            <a>Joined {{$user->created_at->format('d M Y') }}</a>
            <a class="px-2">📍 {{ $user->Address }}</a>
            <a class="px-2">❤️ {{ $totalLikes }}</a>
        </div>
        <h2 class="py-4 font-bold">About</h2>
        <p>{{ $user->Bio ?? 'No bio yet' }}</p>
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

<script>

</script>

@endsection