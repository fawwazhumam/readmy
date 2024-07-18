@extends('layouts.app')

@section('content')
<!-- <div>
    <ul>
        @foreach ($followers as $follower)
        <li>
            <img src="{{ asset('Photo/' . $follower->File_Name) }}" alt="profile" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
            {{ $follower->First_Name }} {{ $follower->Last_Name }}

            @if (!in_array($follower->id, $followingIds))
            <form action="{{ route('followBack', $follower->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-primary">Follow Back</button>
            </form>

            <form action="{{ route('removeFollower', $follower->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Remove Follower</button>
            </form>
            @endif

            @if (in_array($follower->id, $followingIds))
            <form action="{{ route('removeFollower', $follower->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Remove Follower</button>
            </form>
            @endif
        </li>
        @endforeach
    </ul>
</div> -->

<ul class="divide-y divide-slate-100">
    @foreach ($followers as $follower)
    <li class="flex h-full items-center gap-4 px-4 py-3 bg-slate-100 rounded">
        <a href="{{ route('showProfile', ['id' => $follower->id]) }}" class="relative inline-flex items-center justify-center w-8 h-8 text-white rounded-full">
            <img src="{{ asset('Photo/' . $follower->File_Name) }}" alt="user name" title="user name" width="32" height="32" class="max-w-full rounded-full" />
        </a>
        <div class="flex flex-col gap-0 min-h-[2rem] items-start justify-center flex-1 overflow-hidden">
            <h4 class="w-full text-base truncate text-slate-700">{{ $follower->First_Name }} {{ $follower->Last_Name }}</h4>
        </div>
        @if (!in_array($follower->id, $followingIds))
        <form action="{{ route('followBack', $follower->id) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-primary">Follow Back</button>
        </form>

        <form action="{{ route('removeFollower', $follower->id) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-error text-white">Remove Follower</button>
        </form>
        @endif

        @if (in_array($follower->id, $followingIds))
        <form action="{{ route('removeFollower', $follower->id) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-error text-white">Remove Follower</button>
        </form>
        @endif
    </li>
    @endforeach
</ul>
@endsection