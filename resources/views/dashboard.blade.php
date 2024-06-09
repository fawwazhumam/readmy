@extends('layouts.app')

@section('content')

<section class="h-max mb-8">
    <h2 class="font-bold text-lg">Dashboard</h2>
    <div id="category-container" class="flex gap-4 my-4">
        <button class="px-5 py-2 bg-green-600 text-white rounded-full">
            ALL
        </button>
        <button class="px-5 py-2 bg-green-600 bg-opacity-70 text-white rounded-full">
            ...
        </button>
    </div>

</section>
<tbody>
    <div class="overflow-x-auto w-full max-h-[680px]">
        <table class="w-full min-w-[540px]" data-tab-for="book" data-page="Published">
            <thead class="sticky top-0 bg-green-600 z-10">
                <tr>
                    <!-- Kolom checkbox -->
                    <th class="text-[12px] uppercase font-medium text-white py-4 px-8 text-center rounded-tl-md rounded-bl-md">
                        <!-- Checkbox di header -->
                    </th>

                    <!-- Kolom lainnya -->
                    <th class="text-[18px] uppercase font-medium text-white py-6 px-8 text-left">Book</th>
                    <th class="text-[18px] uppercase font-medium text-white py-6 px-8 text-center">Status</th>
                    <th class="text-[18px] uppercase font-medium text-white py-6 px-4 text-center">Like</th>
                    <th class="text-[18px] uppercase font-medium text-white py-6 px-4 text-center rounded-tr-md rounded-br-md">Tools</th>
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
                        <span class="inline-block p-1 rounded-lg bg-emerald-500/10 text-emerald-500 font-medium text-[12px] px-4 py-2 leading-none">
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
                        <div>
                            <button type="button" onclick="window.location.href='{{ route('editFile', ['id' => $file->id]) }}'" class="bg-green-600 hover:bg-slate-600 text-white font-bold py-2 px-10 rounded-full mb-2">Edit</button>
                        </div>
                        <div>
                            <form action="{{ route('delete', $file->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-slate-600 text-white font-bold py-2 px-8 rounded-full" onclick="return confirm('Are you sure you want to delete this file?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>



</tbody>
</table>
</div>

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



</div>

@endsection