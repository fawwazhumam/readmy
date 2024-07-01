@extends('layouts.app')

@section('content')

<body>
    <div id="app">

    <!-- main section -->

    <main class="flex gap-6 min-h-screen p-6 bg-white">
        <!-- sidebar -->

        <aside id="sidebar" class="w-1/6 px-4 flex flex-col justify-between">
            <!-- Sidebar content -->
        </aside>
        <!-- End of sidebar -->
        
        <!-- Start content -->
        <div class="flex-1 relative">
            <!-- Hero section -->
            <div class="px-48 py-12">
                <div id="card-book-container" class="flex px-24 gap-4">
                    <a href="#" class="w-56 h-96 p-4 bg-[#fafaf9] shadow-lg rounded-lg">
                      <img class="w-full h-4/5 rounded-md" src="{{ asset('images/card-book-placeholder.jpg') }}" alt="book" />
                      <div>
                        <h4 class="font-bold">{{$file->Title}}</h4>
                        <p>Published by <span class="text-sky-500">{{ Auth::user()->First_Name }}</span></p>
                      </div>
                    </a>
                  </div>
                <!-- Profile section -->
            </div>
            <div class="px-48 py-4">
                <form action="{{ route('updateFile', ['id' => $file->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- Upload file section -->
                    <section class="flex px-24 py-4 gap-4">
                        <div class="w-full px-4 mb-6 md:mb-0">
                            <label class="block tracking-wide text-gray-700 font-bold mb-2" for="file-upload">
                                Drag & Upload File
                            </label>
                            <div class="relative">
                                <input type="file" class="hidden" id="file-upload" name="file">
                                <label for="file-upload" class="flex gap-4 justify-between cursor-pointer bg-gray-50 text-gray-700 shadow-lg border rounded-full py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                                    <span id="file-name" class="bg-gray-50">Drag and Drop here</span>
                                    <a class="px-4 py-2 rounded-full bg-green-600 text-white shadow-lg border-2">Click to upload</a>
                                </label>
                                <button type="button" class="hidden bg-red-600 text-white font-semibold rounded-full px-4 py-2 hover:bg-secondary hover:text-white absolute top-0 right-0 -mt-3 -mr-3" id="delete-file-btn">Delete</button>
                            </div>
                        </div>
                    </section>

                    <!-- Upload photo section -->
                    <section class="flex px-24 py-4 gap-4">
                        <div class="w-full px-4 mb-6 md:mb-0">
                            <label class="block tracking-wide text-gray-700 font-bold mb-2" for="photo-upload">
                                Drag & Upload Photo
                            </label>
                            <div class="relative">
                                <input type="file" class="hidden" id="photo-upload" name="photo" accept="image/*">
                                <label for="photo-upload" class="flex gap-4 justify-between cursor-pointer bg-gray-50 text-gray-700 shadow-lg border rounded-full py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white">
                                    <span id="photo-name" class="bg-gray-50">Drag and Drop here</span>
                                    <a class="px-4 py-2 rounded-full bg-green-600 text-white shadow-lg border-2">Click to upload</a>
                                </label>
                                <button type="button" class="hidden bg-red-600 text-white font-semibold rounded-full px-4 py-2 hover:bg-secondary hover:text-white absolute top-0 right-0 -mt-3 -mr-3" id="delete-photo-btn">Delete</button>
                            </div>
                        </div>
                    </section>

                    <!-- Other form sections -->
                    <!-- Title section -->
                    <section class="flex px-24 py-4 gap-4">
                        <div class="relative w-full md:w-1/2 px-4 mb-6 md:mb-0">
                            <label class="block tracking-wide text-gray-700 font-bold mb-2" for="grid-first-name">
                                Title Book
                            </label>
                            <input class="appearance-none block w-full bg-gray-50 shadow-lg border rounded-full py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" value="{{$file->Title}}" name="title">
                        </div>
                    </section>

                    <!-- Type section -->
                    <section class="flex px-24 py-4 gap-4">
                        <div class="relative w-full md:w-1/2 px-4 mb-6 md:mb-0">
                            <label class="block tracking-wide text-gray-700 font-bold mb-2" for="selected-tags">
                                Type
                            </label>
                            <select name="type" class="form-control p-4 rounded-md bg-gray-100 bg-opacity-70 shadow outline-primary" id="examplecategoryFormControlSelect1">
                                <option value="{{ $file->Type }}">{{ $file->Type }}</option>
                                <option value="Public">Public</option>
                                <option value="Private">Private</option>
                            </select>
                        </div>
                    </section>

                    <!-- Category section -->
                    <section class="flex px-24 py-4 gap-4">
                        <div class="w-full md:w-1/2 px-4 mb-6 md:mb-0">
                            <label class="block tracking-wide text-gray-700 font-bold mb-2" for="selected-tags">
                                Category
                            </label>
                            <select name="category" class="p-4 rounded-md bg-gray-100 bg-opacity-70 shadow outline-primary" id="exampleFormControlSelect1">
                                <option value="{{ $file->Category }}">{{ $file->Category }}</option>
                                <option value="Children">Children</option>
                                <option value="Adult">Adult</option>
                                <option value="Sport">Sport</option>
                                <option value="Game">Game</option>
                                <option value="Politics">Politics</option>
                                <option value="History">History</option>
                                <option value="Comedy">Comedy</option>
                                <option value="Horror">Horror</option>
                                <option value="Conspiracy">Conspiracy</option>
                            </select>
                        </div>
                    </section>

                    <!-- Description section -->
                    <section class="flex px-24 py-4 gap-4">
                        <div class="w-full md:w-1/2 px-4 mb-6 md:mb-0">
                            <label class="block tracking-wide text-gray-700 font-bold mb-2" for="description">Description</label>
                            <textarea class="h-50 p-4 rounded-md bg-gray-100 bg-opacity-70 shadow outline-primary resize-none" type="text" id="description" name="desc">{{ $file->Desc }}</textarea>
                        </div>
                    </section>

                    <!-- Save and Back buttons -->
                    <section class="px-24 py-4">
                        <div class="px-4 items-center gap-4">
                            <button type="button" onclick="history.back()" class="shadow-lg bg-red-600 text-white font-semibold rounded-full px-4 py-2 hover:bg-secondary hover:text-white">Back</button>
                            <button type="submit" class="shadow-lg bg-green-600 text-white font-semibold rounded-full px-4 py-2 hover:bg-secondary hover:text-white">Save</button>
                        </div>
                    </section>
                </form>
            </div>
        </div>
        <!-- End of content -->
    </div>
</body>

<script>
    document.getElementById('file-upload').addEventListener('change', function() {
        var fileName = this.files[0].name;
        document.getElementById('file-name').textContent = fileName;
    });

    document.getElementById('photo-upload').addEventListener('change', function() {
        var photoName = this.files[0].name;
        document.getElementById('photo-name').textContent = photoName;
    });
</script>

@endsection