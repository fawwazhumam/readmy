@extends('layouts.admin')

@section('content')

<section class="h-max mb-8">
    <h2 class="font-bold text-lg">Dashboard Admin</h2>
</section>

<div class="overflow-x-auto w-full max-h-[680px]">
    <table class="w-full min-w-[540px]" data-tab-for="book" data-page="Published">
        <thead class="bg-primary">
            <tr>
                <th class="text-[18px] uppercase font-medium text-white py-6 px-8 text-left rounded-tl-md rounded-bl-md">No</th>
                <th class="text-[18px] uppercase font-medium text-white py-6 px-8 text-left">Book</th>
                <th class="text-[18px] uppercase font-medium text-white py-6 px-8 text-left">Title</th>
                <th class="text-[18px] uppercase font-medium text-white py-6 px-8 text-center">Status</th>
                <th class="text-[18px] uppercase font-medium text-white py-6 px-4 text-center">Like</th>
                <th class="text-[18px] uppercase font-medium text-white py-6 px-4 text-center">Date Log</th>
                <th class="text-[18px] uppercase font-medium text-white py-6 px-4 text-center">Report Approved</th>
                <th class="text-[18px] uppercase font-medium text-white py-6 px-4 text-center rounded-tr-md rounded-br-md">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($files as $file)
            <tr>
                <td class="py-4 px-4 border-b border-b-gray-200 shadow-sm">
                    <div class="flex items-center">
                        <a href="#" class="text-gray-800 text-sm font-medium ml-2 truncate">{{ $loop->iteration }}</a>
                    </div>
                </td>
                <td class="py-4 px-4 border-b border-b-gray-200 shadow-sm">
                    <div class="flex items-center">
                        <img src="{{ asset('images/card-book-placeholder.jpg') }}" alt="" class="w-24 h-32 rounded object-cover block">
                    </div>
                </td>

                <td class="py-2 px-4 border-b border-b-gray-200 shadow-sm text-center">
                    <span class="inline-block p-1 rounded-lg bg-pink-500/10 text-pink-500 font-medium text-[12px] px-4 py-2 leading-none">{{ $file->Title }}</span>
                </td>
                <td class="py-2 px-4 border-b border-b-gray-200 shadow-sm text-center">
                    <span class="inline-block p-1 rounded-lg bg-pink-500/10 text-pink-500 font-medium text-[12px] px-4 py-2 leading-none">{{ $file->Type }}</span>
                </td>
                <td class="py-2 px-4 border-b border-b-gray-200 shadow-sm text-center">
                    <span class="inline-block p-1 rounded-lg bg-pink-500/10 text-pink-500 font-medium text-[12px] px-4 py-2 leading-none">{{ $file->likes }}</span>
                </td>
                <td class="py-2 px-4 border-b border-b-gray-200 shadow-sm text-center">
                    <span class="inline-block p-1 rounded-lg bg-pink-500/10 text-pink-500 font-medium text-[12px] px-4 py-2 leading-none">{{ $file->created_at }}</span>
                </td>
                <td class="py-2 px-4 border-b border-b-gray-200 shadow-sm text-center">
                    <span class="inline-block p-1 rounded-lg bg-pink-500/10 text-pink-500 font-medium text-[12px] px-4 py-2 leading-none">{{ $file->report_approved }}</span>
                </td>
                <td class="py-2 px-4 border-b-gray-200 shadow-sm text-center">
                    <div>
                        <form action="{{ route('admin.deleteFile', $file->id) }}" method="POST" onsubmit="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete File</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<script>
    function confirmDelete() {
        Swal.fire({
            title: 'Delete File!',
            text: 'Are you sure you want to delete this file?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, clear it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Cleared!',
                    'Your changes have been cleared.',
                    'success'
                );
                return true;
            } else {
                return;
            }
        });
    }
</script>


@endsection