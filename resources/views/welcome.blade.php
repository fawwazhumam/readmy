@extends('layouts.app')

@section('content')
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
        @foreach($categories as $category)
        <button class="btn-category btn btn-primary btn-outline rounded-full" onclick="filterFiles('{{ $category }}')">
            {{ $category }}
        </button>
        @endforeach
    </div>
    <div id="card-book-container" class="py-4 flex gap-4 overflow-x-auto hide-scrollbar">
        @foreach ($files as $file)
        <x-book-card :file="$file" />
        @endforeach
    </div>
</section>

<!-- popular section -->
<section class="h-max mb-8">
    <h2 class="font-bold text-lg">Popular</h2>
    <div class="py-4 flex gap-4 overflow-x-auto hide-scrollbar">
        @foreach ($popularFiles as $file)
        <x-book-card :file="$file" />
        @endforeach
    </div>
</section>

<!-- update section -->
<section class="h-max mb-8">
    <h2 class="font-bold text-lg">Latest Update</h2>

    <div class="py-4 flex gap-4 overflow-x-auto hide-scrollbar">
        @foreach ($lastestFiles as $file)
        <x-book-card :file="$file" />
        @endforeach
    </div>
</section>

<script src="{{ asset('js/main.js') }}"></script>

<script>
    function clean(text) {
        return text.replace(/\s/g, '');
    }

    function filterFiles(category) {
        fetch(`/files/category/${category}`)
            .then(response => response.json())
            .then(data => {
                const btnCategory = document.querySelectorAll(".btn-category");
                const container = document.getElementById('card-book-container');
                container.innerHTML = '';
                btnCategory.forEach(btn => {
                    if (clean(btn.textContent) === clean(category)) {
                        btn.classList.remove("btn-outline");
                    } else {
                        btn.classList.add('btn-outline')
                    }
                })

                if (data.length < 1) {
                    container.innerHTML = `<p class="w-full text-center py-8 text-xl font-bold">Content not available</p>`;
                    return;
                }

                data.forEach(file => {
                    const card = `
                            <div class="min-w-56 w-56 md:w-56 max-h-96 min-h-96 h-max bg-[#fafaf9] shadow-lg p-2 rounded-lg">
                                <a href="/ReadBook/${file.id}" class="block w-full h-3/4 min-h-[calc(24rem - 75%)] relative">
                                    <img class="w-full h-80 object-center object-cover rounded-md" src="/${file.image_path ? 'Photo/cover/' + file.image_path : 'images/card-book-placeholder.jpg'}" alt="book" />
                                </a>
                                <div class="flex justify-between items-center pt-2">
                                    <div>
                                        <div class="tooltip" data-tip="${file.Title}">
                                            <a href="/ReadBook/${file.id}" class="font-semibold hover:underline">${file.Title.length >= 16 ? file.Title.substring(0, 16) + '...' : file.Title}</a>
                                        </div>
                                        <p class="text-gray-500 text-xs">Published by <a href="/profile/${file.user_id}" class="text-info hover:text-sky-600 hover:underline cursor-pointer">${file.user ? file.user.First_Name : 'Unknown'}</a></p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <!-- Example for handling likes dynamically -->
                                        ${file.likes > 0 ? `
                                        <form action="/file/unlike/${file.id}" method="POST">
                                            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                            <button type="submit" class="text-error fa-solid fa-heart text-sm"><span class="text-black">${file.likes}</span></button>
                                        </form>
                                        ` : `
                                        <form action="/files/${file.id}/like" method="POST">
                                            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                            <span class="tooltip" data-tip="Like book">
                                                <button type="submit" class="text-error fa-regular fa-heart text-sm"><span class="text-black">${file.likes}</span></button>
                                            </span>
                                        </form>
                                        `}
                                       
                                        <div class="dropdown dropdown-top">
                                            <div tabindex="0" role="button" class="m-1">
                                                <i class="fa-solid fa-ellipsis-vertical text-lg"></i>
                                            </div>
                                            <ul tabindex="0" class="dropdown-content z-[1] menu w-32 py-2 px-0 bg-base-100 rounded-sm shadow">
                                                <li>
                                                ${file.user && file.user.savedBooks && file.user.savedBooks.contains(file.id) ? `
                                                <form action="/remove-book/${file.id}" method="POST" class="rounded-none">
                                                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                                    <span class="tooltip" data-tip="Remove from your bookmark">
                                                        <button type="submit" class="flex items-center gap-2">
                                                            <a class="rounded-none">
                                                                <i class="fa-solid fa-bookmark"></i> Remove
                                                            </a>
                                                        </button>
                                                    </span>
                                                </form>
                                                ` : `
                                                <form action="/save-book/${file.id}" method="POST" class="rounded-none">
                                                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                                                    <span class="tooltip" data-tip="Save this book">
                                                        <button type="submit" class="flex items-center gap-2">
                                                            <a><i class="fa-solid fa-bookmark"></i> Save</a>
                                                        </button>
                                                    </span>
                                                </form>
                                                `}
                                                </li>
                                                <li>
                                                    <a class="rounded-none">
                                                        <i class="fa-solid fa-share"></i> Share
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
                    container.insertAdjacentHTML('beforeend', card);
                });
            })
            .catch(error => console.error('Error fetching files:', error));
    }
</script>

@if(session('success'))
<script>
    let timerInterval;
    Swal.fire({
        title: "Success",
        text: "{{ session('success') }}",
        icon: 'success',
        timer: 3000,
        timerProgressBar: true,
        didOpen: () => {
            const timer = Swal.getPopup().querySelector("b");
            timerInterval = setInterval(() => {
                timer.textContent = ``;
            }, 100);
        },
        willClose: () => {
            clearInterval(timerInterval);
        }
    });
</script>
@endif

@if(session('error'))
<script>
    let timerInt;
    Swal.fire({
        title: "Error",
        text: "{{ session('error') }}",
        icon: 'error',
        timer: 3000,
        timerProgressBar: true,
        didOpen: () => {
            const timer = Swal.getPopup().querySelector("b");
            timerInt = setInterval(() => {
                timer.textContent = ``;
            }, 100);
        },
        willClose: () => {
            clearInterval(timerInt);
        }
    });
</script>
@endif

@endsection