@extends('layouts.app')

@section('content')

<ul>
    @foreach ($followings as $following)
    <li>
        <img src="{{ asset('Photo/' . $following->File_Name) }}" alt="profile" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
        {{ $following->First_Name }} {{ $following->Last_Name }}

        <form action="{{ route('unfollow', $following->id) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-warning">Unfollow</button>
        </form>

        @if ($followers->contains('id', $following->id))
        <form action="{{ route('removeFollower', $following->id) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Remove Follower</button>
        </form>
        @endif
    </li>
    @endforeach
</ul>

<!--<div class="flex w-1/2 items-center justify-center mt-4">
            
            <button class="bg-gray-600 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mr-2">&lt;</button>
        
            
            <div class="flex items-center">
                <button class="bg-gray-400 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mx-1">1</button>
                <button class="bg-gray-400 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mx-1">2</button>
                <button class="bg-gray-400 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mx-1">3</button>
                <button class="bg-gray-400 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mx-1">4</button>
                <button class="bg-gray-400 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mx-1">5</button>
            </div>
        
            <button class="bg-gray-600 hover:bg-green-600 text-white font-bold py-2 px-4 rounded ml-2">&gt;</button>
        </!--</div>-->


@endsection