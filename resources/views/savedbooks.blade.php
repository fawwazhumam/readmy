@extends('layouts.app')

@section('content')

<section class="h-max mb-8">
    <h2 class="font-bold text-lg">Saved Books</h2>
    <div id="card-book-container" class="flex gap-4 flex-wrap">
        @foreach ($savedBooks as $file)
        <a href="#" class="w-56 h-96 p-4 bg-[#fafaf9] shadow-lg rounded-lg">
            <img class="w-full h-4/5 rounded-md" src="{{ asset('images/card-book-placeholder.jpg') }}" alt="book" />
            <div>
                <h4 class="font-bold">{{ $file->Title }}</h4>
                <p>Published by <span class="text-sky-500">{{ $file->user->First_Name }}</span></p>
                <p>{{ $file->created_at->format('d M Y') }}</p>
                <form action="{{ route('removeBook', $file->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-500">Remove</button>
                </form>
            </div>
        </a>
        @endforeach
    </div>
</section>

@endsection