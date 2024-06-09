@extends('layouts.app')

@section('content')

@if(request()->has('query'))
<section class="h-max mb-8">
    <h2 class="font-bold text-lg">Search Results</h2>
    @if($results->isEmpty())
    <p>No books found.</p>
    @else
    <div id="card-book-container" class="flex gap-4 flex-wrap">
        @foreach ($results as $file)
        <a href="#" class="w-56 h-96 p-4 bg-[#fafaf9] shadow-lg rounded-lg">
            <img class="w-full h-4/5 rounded-md" src="{{ asset('images/card-book-placeholder.jpg') }}" alt="book" />
            <div>
                <h4 class="font-bold">{{ $file->Title }}</h4>
                <p>Published by <span class="text-sky-500">{{ $file->user->First_Name ?? 'Unknown' }}</span></p>
                <form action="{{ route('likeFile', $file) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sky-500">Like</button>
                    <span>{{ $file->likes }} likes</span>
                </form>
            </div>
        </a>
        @endforeach
    </div>
    @endif
</section>
@endif


@endsection