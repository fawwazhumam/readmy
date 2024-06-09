@extends('layouts.app')

@section('content')

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

@endsection