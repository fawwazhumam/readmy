@extends('layouts.admin')

@section('content')
<section class="h-max mb-8">
    <h2 class="font-bold text-lg">Dashboard Admin</h2>
</section>
<div class="overflow-x-auto w-full max-h-[680px]">
    <table class="w-full min-w-[540px]" data-tab-for="book" data-page="Published">
        <thead class="sticky top-0 bg-green-600 z-10">
            <tr>
                <!-- Kolom lainnya -->
                <th class="text-[18px] uppercase font-medium text-white py-6 px-8 text-left">No</th>
                <th class="text-[18px] uppercase font-medium text-white py-6 px-8 text-left">Name</th>
                <th class="text-[18px] uppercase font-medium text-white py-6 px-8 text-left">Role</th>
                <th class="text-[18px] uppercase font-medium text-white py-6 px-8 text-center">Gender</th>
                <th class="text-[18px] uppercase font-medium text-white py-6 px-4 text-center">Usertype</th>
                <th class="text-[18px] uppercase font-medium text-white py-6 px-4 text-center">Email Verified Log</th>
                <th class="text-[18px] uppercase font-medium text-white py-6 px-4 text-center">Post Deleted</th>
                <th class="text-[18px] uppercase font-medium text-white py-6 px-4 text-center rounded-tr-md rounded-br-md">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td class="py-4 px-4 border-b border-b-gray-200 shadow-sm">
                    <div class="flex items-center">
                        <a href="#" class="text-gray-800 text-sm font-medium ml-2 truncate">{{ $loop->iteration }}</a>
                    </div>
                </td>
                <td class="py-4 px-4 border-b border-b-gray-200 shadow-sm">
                    <div class="flex items-center">
                        <span class="text-gray-800 text-sm font-medium ml-2 truncate">{{ $user->First_Name }} {{ $user->Last_Name }}</span>
                    </div>
                </td>
                <td class="py-4 px-4 border-b border-b-gray-200 shadow-sm">
                    <div class="flex items-center">
                        <span class="text-gray-800 text-sm font-medium ml-2 truncate">{{ $user->email }}</span>
                    </div>
                </td>
                <td class="py-2 px-4 border-b border-b-gray-200 shadow-sm text-center">
                    <span class="inline-block p-1 rounded-lg bg-pink-500/10 text-pink-500 font-medium text-[12px] px-4 py-2 leading-none">{{ $user->Gender }}</span>
                </td>
                <td class="py-2 px-4 border-b border-b-gray-200 shadow-sm text-center">
                    <span class="inline-block p-1 rounded-lg bg-pink-500/10 text-pink-500 font-medium text-[12px] px-4 py-2 leading-none">{{ $user->usertype }}</span>
                </td>
                <td class="py-2 px-4 border-b border-b-gray-200 shadow-sm text-center">
                    <span class="inline-block p-1 rounded-lg bg-pink-500/10 text-pink-500 font-medium text-[12px] px-4 py-2 leading-none">{{ $user->email_verified_at }}</span>
                </td>
                <td class="py-2 px-4 border-b border-b-gray-200 shadow-sm text-center">
                    <span class="inline-block p-1 rounded-lg bg-pink-500/10 text-pink-500 font-medium text-[12px] px-4 py-2 leading-none">{{ $user->Post_Deleted }}</span>
                </td>
                <td class="py-2 px-4 border-b-gray-200 shadow-sm text-center">
                    <div>
                        <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete User</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection