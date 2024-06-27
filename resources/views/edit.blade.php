@extends('layouts.app')

@section('content')

<!-- <div class="px-48 py-12">
    </div> -->
<div class="flex flex-col items-center py-8">
    <x-book-card :file=$file />
    <form class="w-4/5 max-w-7xl" action="{{ route('updateFile', ['id' => $file->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <section class="flex py-4 gap-4">
            <div class="w-full px-4 md:mb-0">
                <label class="block tracking-wide text-gray-700 font-bold mb-2" for="file-upload">
                    Drag & Upload File
                </label>
                <div class="relative">
                    <label for="file-upload" class="flex gap-4 justify-between cursor-pointer bg-gray-50 text-gray-700 shadow-lg border rounded-full py-3 px-4 leading-tight focus:outline-none focus:bg-white">
                        <input type="file" class="hidden" id="file-upload" name="file">
                        <span id="file-name" class="bg-gray-50">Drag and Drop here</span>
                        <a class="px-4 py-2 rounded-full bg-primary text-white shadow-lg border-2">Upload</a>
                    </label>

                    <button type="button" class="hidden bg-red-600 text-white font-semibold rounded-full px-4 py-2 hover:bg-secondary hover:text-white absolute top-0 right-0 -mt-3 -mr-3" id="delete-file-btn">Delete</button>
                </div>
            </div>
        </section>

        <section class="flex py-4 gap-4">
            <div class="relative w-full px-4 md:mb-0">
                <label class="block tracking-wide text-gray-700 font-bold mb-2" for="grid-first-name">
                    Title Book
                </label>
                <input class="appearance-none block w-full bg-gray-50 shadow-lg border rounded-full py-3 px-4 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" value="{{$file->Title}}" name="title">
            </div>
        </section>

        <section class="flex py-4 gap-4">
            <div class="relative w-full px-4 md:mb-0">
                <label class="block tracking-wide text-gray-700 font-bold mb-2" for="selected-tags">
                    Type
                </label>
                <select name="type" class="w-full p-4 rounded-md bg-gray-100 bg-opacity-70 shadow outline-primary" id="examplecategoryFormControlSelect1">
                    <option value="{{ $file->Type }}">{{ $file->Type }}</option>
                    <option value="{{ $file->Type === 'Public' ? 'Private' : 'Public' }}">{{ $file->Type === 'Public' ? 'Private' : 'Public' }}</option>
                </select>
            </div>
        </section>

        <section class="flex py-4 gap-4">
            <div class="w-full px-4 mb-6 md:mb-0">
                <label class="block tracking-wide text-gray-700 font-bold mb-2" for="selected-tags">
                    Category
                </label>
                <select name="category" class="w-full p-4 rounded-md bg-gray-100 bg-opacity-70 shadow outline-primary" id="exampleFormControlSelect1">
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

        <section class="flex py-4 gap-4">
            <div class="w-full px-4 md:mb-0">
                <label class="block tracking-wide text-gray-700 font-bold mb-2" for="file-upload">Description</label>
                <textarea class="w-full h-50 p-4 rounded-md bg-gray-100 bg-opacity-70 shadow outline-primary resize-none" type="text" id="description" name="desc">{{ $file->Desc }}</textarea>
            </div>
        </section>

        <section class="py-4">
            <div class="px-4 items-center flex justify-end gap-4">
                <button type="button" onclick="history.back()" class="btn btn-error text-white rounded-full">Back</button>
                <button type="submit" class="btn btn-primary text-white rounded-full">Save</button>
            </div>
        </section>
    </form>

</div>


<script>
    document.getElementById('file-upload').addEventListener('change', function() {
        var fileName = this.files[0].name;
        document.getElementById('file-name').textContent = fileName;
    });
</script>

@endsection