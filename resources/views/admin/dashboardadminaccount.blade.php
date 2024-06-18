<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Readmy') }}</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <!-- Scripts -->
    <!-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) -->
    @vite('resources/css/app.css')
</head>
<body>
    <div id="app">

    <!-- main section -->

    <main class="flex gap-6 min-h-screen p-6 bg-white">
        <aside id="sidebar" class="w-1/6 px-4 flex flex-col justify-between">
                        <div>
                            <ul class="flex flex-col justify-center gap-2 mb-12">
                            <li
                                class="flex items-center gap-4 py-2 px-4 rounded-md hover:bg-secondary hover:text-white transition duration-300"
                            >
                                <i class="fa-solid fa-book"></i>
                                <a href="{{ route('admin.reports') }}">Reports</a>
                            </li>
                            <div class="border-[1px] border-secondary"></div>

                            <li
                                class="flex items-center gap-4 py-2 px-4 rounded-md hover:bg-secondary hover:text-white transition duration-300"
                            >
                                <i class="fa-solid fa-file"></i>
                                <a href="{{ route('admin.viewFiles') }}">All files</a>
                            </li>
                            <div class="border-[1px] border-secondary"></div>

                            <li
                                class="flex items-center gap-4 py-2 px-4 rounded-md hover:bg-secondary hover:text-white transition duration-300"
                            >
                                <i class="fa-solid fa-users"></i>
                                <a href="{{ route('admin.viewUsers') }}">Accounts</a>
                            </li>
                            <div class="border-[1px] border-secondary"></div>

                            <li
                                class="flex items-center gap-4 py-2 px-4 rounded-md hover:bg-secondary hover:text-white transition duration-300"
                            >
                                <i class="fa-solid fa-plus"></i>
                                <a href="{{ route('admin.register') }}">Add admin</a>
                            </li>
                            </ul>
                        </div>
                        <div>
                                <li
                                class="flex items-center gap-4 py-2 px-4 rounded-md hover:bg-secondary hover:text-white transition duration-300"
                                >
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                                </form>
                                </li>
                        </div>
            </aside>
        <div class="flex-1 px-24 py-12">

            <section class="h-max mb-8">
                <h2 class="font-bold text-lg">Dashboard Admin</h2>
                <div id="category-container" class="flex gap-4 my-4">
                  <button class="px-5 py-2 bg-green-600 text-white rounded-full">
                    ALL
                  </button>
                  <button
                    class="px-5 py-2 bg-green-600 bg-opacity-70 text-white rounded-full">
                    ...
                  </button>
                </div>
               
            </section>
                <tbody>
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
    </div>
</body>
</html>