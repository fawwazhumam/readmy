@extends('layouts.app')

@section('content')
<ul class="divide-y divide-slate-100">
    @foreach ($followings as $following)
    <li class="flex h-full items-center gap-4 px-4 py-3 bg-slate-100 rounded">
        <a href="{{ route('showProfile', ['id' => $following->id]) }}" class="relative inline-flex items-center justify-center w-8 h-8 text-white rounded-full">
            <img src="{{ asset('Photo/' . $following->File_Name) }}" alt="user name" title="user name" width="32" height="32" class="max-w-full rounded-full" />
        </a>
        <div class="flex flex-col gap-0 min-h-[2rem] items-start justify-center flex-1 overflow-hidden">
            <h4 class="w-full text-base truncate text-slate-700">{{ $following->First_Name }} {{ $following->Last_Name }}</h4>
        </div>
        <form action="{{ route('unfollow', $following->id) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-error text-white">Unfollow</button>
        </form>
        @if ($followers->contains('id', $following->id))
        <form action="{{ route('removeFollower', $following->id) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-neutral">Remove Follower</button>
        </form>
        @endif
    </li>
    @endforeach
</ul>
@endsection