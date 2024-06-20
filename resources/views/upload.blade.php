@extends('layouts.app')

@section('content')

<h1 class="font-bold text-lg pb-8">Upload Your Book</h1>

<section id="upload" class="flex justify-center">
    <form class="w-4/5 max-w-7xl" action="/Upload" method="post" enctype="multipart/form-data">
        @csrf
        <div class="bg-gray-100 w-full h-72 mb-8 flex flex-col items-center gap-4 bg-opacity-70 rounded-lg border-2 border-dashed">
            <label class="w-full max-w-[50vw] h-full flex flex-col items-center justify-center px-4 py-6 rounded-lg">
                <img src="{{ asset('images/icon-upload.png') }}" alt="upload" />
                <p>
                    Drag and drop here or
                    <span class="cursor-pointer text-primary underline">Choose file</span>
                </p>
                <input type="file" name="file" class="hidden" id="fileInput" />
            </label>
        </div>

        <div class="mb-8" id="fileDisplayContainer">
            <div class="bg-gray-100 bg-opacity-70 flex p-4 justify-between items-center shadow-md rounded-md">
                <p id="fileName"><i class="fa-solid fa-file mr-2 text-lg"></i> NamaFile.pdf</p>
                <button type="button" class="px-4 py-2 bg-red-600 text-white font-bold rounded-md hover:bg-red-800 duration-300" id="deleteButton">
                    Delete
                </button>
            </div>
        </div>

        <div class="flex flex-col gap-4 mb-8">
            <label for="title">Title</label>
            <input class="p-4 rounded-md bg-gray-100 bg-opacity-70 shadow outline-primary" type="text" id="title" name="title" />

            <label for="category">Category</label>
            <select name="category" class="form-control p-4 rounded-md bg-gray-100 bg-opacity-70 shadow outline-primary" id="exampleFormControlSelect1">
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

            <label for="description">Type</label>
            <select name="type" class="form-control p-4 rounded-md bg-gray-100 bg-opacity-70 shadow outline-primary" id="examplecategoryFormControlSelect1">
                <option value="Public">Public</option>
                <option value="Private">Private</option>
            </select>

            <label for="description">Description</label>
            <textarea class="h-50 p-4 rounded-md bg-gray-100 bg-opacity-70 shadow outline-primary resize-none" type="text" id="description" name="desc"></textarea>
        </div>

        <div class="flex items-center justify-end gap-4 mb-8">
            <button type="reset" class="px-4 py-2 rounded-full bg-red-600 text-white hover:bg-red-800">
                Clear
            </button>
            <button type="submit" class="px-4 py-2 rounded-full bg-primary text-white hover:bg-green-600">
                Upload
            </button>
        </div>
    </form>
</section>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const fileInput = document.getElementById('fileInput');
        const fileNameElement = document.getElementById('fileName');
        const fileDisplayContainer = document.getElementById('fileDisplayContainer');
        const deleteButton = document.getElementById('deleteButton');

        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                fileNameElement.textContent = file.name;
            }
        });

        deleteButton.addEventListener('click', () => {
            fileInput.value = ''; // Clear the input file
            fileNameElement.textContent = 'NamaFile.pdf'; // Reset the file name display
        });
    });
</script>



@endsection