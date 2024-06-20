@extends('layouts.app')

@section('content')

<h1 class="text-2xl text-center my-4 mb-8 font-bold">
  "Books weave a tapestry of boundless fantasies, where every page whispers secrets of
  enchanted realms waiting to be explored."
</h1>
<!-- how to section -->
<section class="h-max mb-8">
  <h1 class="text-2xl text-center font-bold my-4">Easy to Read and Upload Your Books</h1>
  <!-- container -->
  <div id="how-to-container" class="flex justify-evenly p-4">
    <div class="w-1/3 flex flex-col items-center">
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

    <div class="w-1/3 flex flex-col items-center">
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

    <div class="w-1/3 flex flex-col items-center">
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

@endsection