@extends('layouts.app')

@section('content')

<section class="h-max mb-8">
    <h2 class="font-bold text-lg">Saved Books</h2>
    <div id="card-book-container" class="flex gap-4 flex-wrap">
        @foreach ($savedBooks as $file)
        <x-book-card :file=$file />
        @endforeach
    </div>
</section>


@endsection