@extends('layouts.app')

@section('content')


<section class="h-max mb-8">
    <h2 class="font-bold text-lg">Dashboard</h2>
</section>

<div class="overflow-x-auto w-full max-h-[680px]">
    <table class="w-full min-w-[540px]" data-tab-for="book" data-page="Published">
        <thead class="bg-primary">
            <tr>
                <!-- Kolom checkbox -->
                <th class="text-[12px] uppercase font-medium text-white py-4 px-8 text-center rounded-tl-md rounded-bl-md">
                    <!-- Checkbox di header -->
                </th>

                <!-- Kolom lainnya -->
                <th class="text-[18px] uppercase font-medium text-white py-6 px-8 text-left">Book</th>
                <th class="text-[18px] uppercase font-medium text-white py-6 px-8 text-center">Status</th>
                <th class="text-[18px] uppercase font-medium text-white py-6 px-4 text-center">Like</th>
                <th class="text-[18px] uppercase font-medium text-white py-6 px-4 text-center rounded-tr-md rounded-br-md">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($files as $file)
            <tr>
                <!-- Kolom checkbox -->
                <td class="border-b border-b-gray-200 shadow-sm text-center">
                    <input type="checkbox" class="rounded-full size-6"> <!-- Checkbox di setiap baris -->
                </td>

                <!-- Kolom lainnya -->
                <td class="py-4 px-4 border-b border-b-gray-200 shadow-sm">
                    <div class="flex items-center">
                        <img src="{{ asset('images/card-book-placeholder.jpg') }}" alt="" class="w-24 h-32 rounded object-cover block">
                        <a href="#" class="text-gray-800 text-sm font-medium ml-2 truncate">{{$file->Title}}</a>
                    </div>
                </td>
                <td class="py-2 px-4 border-b border-b-gray-200 shadow-sm text-center">
                    <span class="inline-block p-1 rounded-lg bg-primary/10 text-primary font-medium text-[12px] px-4 py-2 leading-none">
                        @if ($file->Type == 'Public')
                        🟢 Published
                        @else
                        🔴 Private
                        @endif
                    </span>
                </td>
                <td class="py-2 px-4 border-b border-b-gray-200 shadow-sm text-center">
                    <span class="inline-block p-1 rounded-lg bg-pink-500/10 text-pink-500 font-medium text-[12px] px-4 py-2 leading-none">♥️ {{ $file->likes }}</span>
                </td>
                <td class="py-2 px-4 border-b-gray-200 shadow-sm text-center">
                    <div class="mb-2">
                        <a href="{{ route('editFile', ['id' => $file->id]) }}" class="btn btn-primary text-white rounded-full w-24">Edit</a>
                    </div>
                    <div>
                        <form action="{{ route('delete', $file->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-error text-white w-24 rounded-full" onclick="return confirm('Are you sure you want to delete this file?')">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection