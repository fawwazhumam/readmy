@extends('layouts.app')

@section('content')

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<div class="hero rounded-box min-h-[40vh]" style="background-image: url(https://images.pexels.com/photos/694740/pexels-photo-694740.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1);">
    <div class="hero-overlay bg-opacity-60 rounded-box"></div>
    <div class="hero-content text-center text-neutral-content">
        <div class="max-w-md">
            <h1 class="mb-5 text-5xl font-bold">Read Book Easily With Readmi</h1>
            <p class="mb-5">"A room without books is like a body without a soul." - Marcus Tullius Cicero</p>
            <a href="#read" class="btn btn-primary">Get Started</a>
        </div>
    </div>
</div>

<section class="h-max mb-8 max-h-full">
    <h1 class="text-3xl text-center font-bold my-4">Easy to Read and Upload Your Books</h1>
    <div id="how-to-container" class="flex flex-col items-center gap-4 lg:flex-row lg:justify-evenly p-4">
        <div class="w-full lg:w-1/3 flex flex-col items-center">
            <div id="box" class="bg-primary relative w-36 h-36 flex justify-center items-center rounded-md shadow-md">
                <i class="fa-solid fa-upload text-white text-5xl"></i>
                <span class="absolute left-1/2 -translate-x-1/2 -bottom-4 w-0 h-0 border-l-[20px] border-l-transparent border-t-[30px] border-t-primary border-r-[20px] border-r-transparent"></span>
            </div>
            <div class="flex gap-4 items-center my-4">
                <div class="w-10 h-10 bg-primary rounded-full text-white text-center leading-10 font-bold">
                    1
                </div>
                <p class="font-bold text-lg">Upload Your Book</p>
            </div>
        </div>

        <div class="w-full lg:w-1/3 flex flex-col items-center">
            <div id="box" class="bg-primary relative w-36 h-36 flex justify-center items-center rounded-md shadow-md">
                <i class="fa-solid fa-square-plus text-white text-5xl"></i>
                <span class="absolute left-1/2 -translate-x-1/2 -bottom-4 w-0 h-0 border-l-[20px] border-l-transparent border-t-[30px] border-t-primary border-r-[20px] border-r-transparent"></span>
            </div>
            <div class="flex gap-4 items-center my-4">
                <div class="w-10 h-10 bg-primary rounded-full text-white text-center leading-10 font-bold">
                    2
                </div>
                <p class="font-bold text-lg">Add Title & Category</p>
            </div>
        </div>

        <div class="w-full lg:w-1/3 flex flex-col items-center">
            <div id="box" class="bg-primary relative w-36 h-36 flex justify-center items-center rounded-md shadow-md">
                <i class="fa-solid fa-book text-white text-5xl"></i>
                <span class="absolute left-1/2 -translate-x-1/2 -bottom-4 w-0 h-0 border-l-[20px] border-l-transparent border-t-[30px] border-t-primary border-r-[20px] border-r-transparent"></span>
            </div>
            <div class="flex gap-4 items-center my-4">
                <div class="w-10 h-10 bg-primary rounded-full text-white text-center leading-10 font-bold">
                    3
                </div>
                <p class="font-bold text-lg">Publish and Read More Book</p>
            </div>
        </div>
    </div>
</section>

<!-- categories book section -->
<section id="read" class="h-max mb-8">
    <h2 class="font-bold text-lg">Categories</h2>
    <div id="category-container" class="flex gap-2 my-4 max-w-full overflow-auto hide-scrollbar">
        <!-- categories -->
    </div>
    <div id="card-book-container" class="p-4 flex gap-4 overflow-x-auto hide-scrollbar">
        @foreach ($files as $file)
        <x-book-card :file="$file" />
        @endforeach
    </div>
</section>

<!-- popular section -->
<section class="h-max mb-8">
    <h2 class="font-bold text-lg">Popular</h2>
    <div class="p-4 flex gap-4 overflow-x-auto hide-scrollbar">
        @foreach ($popularFiles as $file)
        <x-book-card :file="$file" />
        @endforeach
    </div>
</section>

<!-- update section -->
<section class="h-max mb-8">
    <h2 class="font-bold text-lg">Latest Update</h2>

    <div class="p-4 flex gap-4 overflow-x-auto hide-scrollbar">
        @foreach ($lastestFiles as $file)
        <x-book-card :file="$file" />
        @endforeach
    </div>
</section>

<script src="{{ asset('js/main.js') }}"></script>

<script>
    function filterFiles(category) {
        fetch(`/files/category/${category}`)
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('card-book-container');
                container.innerHTML = '';

                data.forEach(file => {
                    const fileElement = `
                                <a href="/ReadBook/${file.id}" class="w-56 p-4 bg-[#fafaf9] shadow-lg rounded-lg">
                                    <img class="w-full h-4/5 rounded-md" src="/images/card-book-placeholder.jpg" alt="book"/>
                                    <div>
                                        <h4 class="font-bold">${file.Title}</h4>
                                        <p>Published by <span class="text-sky-500">${file.user.First_Name}</span></p>
                                        <p>${new Date(file.created_at).toLocaleDateString()}</p>
                                        <form action="/files/${file.id}/like" method="POST">
                                            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                            <button type="submit" class="text-sky-500 fa-solid fa-heart"></button>
                                            <span>${file.likes}</span>
                                        </form>
                                        ${file.saved ? 
                                            `<form action="/remove-book/${file.id}" method="POST">
                                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                                <button type="submit" class="text-red-500">Remove</button>
                                            </form>` : 
                                            `<form action="/save-book/${file.id}" method="POST">
                                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                                <button type="submit" class="text-green-500">Save</button>
                                            </form>`}
                                    </div>
                                </a>
                            `;
                    container.insertAdjacentHTML('beforeend', fileElement);
                });
            })
            .catch(error => console.error('Error fetching files:', error));
    }
</script>

@endsection