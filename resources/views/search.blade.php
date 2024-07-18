@extends('layouts.app')

@section('content')

@if(request()->has('query'))
<section class="h-max mb-8">
    <h2 class="font-bold text-lg">Search Results</h2>

    <!-- File Results -->
    <h3 class="font-bold text-md mt-4">Books</h3>
    @if($fileResults->isEmpty())
    <p>No books found.</p>
    @else
    <div id="card-book-container" class="flex gap-4 flex-wrap">
        @foreach ($fileResults as $file)
        <x-book-card :file=$file />
        @endforeach
    </div>
    @endif

    <!-- User Results -->
    <h3 class="font-bold text-md mt-4">Users</h3>
    @if($userResults->isEmpty())
    <p>No users found.</p>
    @else
    <div id="user-list-container" class="flex gap-4 flex-wrap">
        @foreach ($userResults as $user)
        <div class="w-56 p-4 bg-[#fafaf9] shadow-lg rounded-lg">
            <div>
                <a href="{{ route('showProfile', $user->id) }}" class="flex gap-2 items-center">
                    <img src="{{ asset('Photo/' . Auth::user()->File_Name) }}" style="width: 50px; height: 50px; object-fit: cover; object-position: center; border-radius: 50%" alt="profile" />
                    <h4 class="font-bold">{{ $user->First_Name }} {{ $user->Last_Name }}</h4>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</section>
@endif


@endsection