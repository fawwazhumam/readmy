@extends('layouts.app')

@section('content')

<section class="h-max mb-8">
    <h2 class="font-bold text-lg">Latest Update</h2>

    <div id="card-book-container" class="flex gap-4 my-4 flex-wrap">
        @foreach ($lastestFiles as $file)
        <x-book-card :file="$file" />
        @endforeach
    </div>
</section>


@endsection