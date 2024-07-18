@extends('layouts.app')

@section('content')
<!-- About Section -->
<section class="my-12 text-center">
  <h2 class="text-4xl font-bold mb-4 text-center">About Readmi</h2>
  <p class="mb-4">ReadMi is a cutting-edge application designed to enhance your reading experience. Whether you are a book lover or just looking for a new way to enjoy content, ReadMi has something for everyone.</p>
  <p>Our mission is to make reading more accessible and enjoyable through innovative features and a user-friendly interface. Explore the world of books and articles with ReadMi, where every read is a new adventure.</p>
</section>

<!-- Features Section -->
<section class="mb-12">
  <h2 class="text-2xl font-bold mb-4">Key Features</h2>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <div class="bg-white p-6 rounded-lg">
      <img src="{{asset('Photo/upload.png')}}" alt="Personalized Recommendations" class="w-64 h-64 object-cover mb-4 rounded-lg">
      <h3 class="text-xl font-bold mb-2">Upload Book</h3>
      <p>Upload buku atau majalah untuk dibaca secara online.</p>
    </div>
    <div class="bg-white p-6 rounded-lg">
      <img src="{{asset('Photo/flipbook.png')}}" alt="Offline Reading" class="w-64 h-64 object-cover mb-4 rounded-lg">
      <h3 class="text-xl font-bold mb-2">Flip Book View</h3>
      <p>Membaca buku secara online dengan pengalaman seperti membaca buku pada umumnya.</p>
    </div>
    <div class="bg-white p-6 rounded-lg">
      <img src="{{asset('Photo/book1.png')}}" alt="Interactive Notes" class="w-64 h-64 object-cover mb-4 rounded-lg">
      <h3 class="text-xl font-bold mb-2">Add to Library</h3>
      <p>Simpan buku yang ingin dibaca nanti atau dibaca ulang.</p>
    </div>
    <div class="bg-white p-6 rounded-lg">
      <img src="{{asset('Photo/like.png')}}" alt="Social Sharing" class="w-64 h-64 object-cover mb-4 rounded-lg">
      <h3 class="text-xl font-bold mb-2">Like and Comment</h3>
      <p>Sukai dan beri komentar pada buku yang telah dibaca untuk mendukung Publisher.</p>
    </div>
    <div class="bg-white p-6 rounded-lg">
      <img src="{{asset('Photo/setprofile.png')}}" alt="Reading Progress Tracker" class="w-64 h-64 object-cover mb-4 rounded-lg">
      <h3 class="text-xl font-bold mb-2">Custom Profile</h3>
      <p>Custom profilmu sendiri untuk tampilan yang lebih indah.</p>
    </div>
    <div class="bg-white p-6 rounded-lg">
      <img src="{{asset('Photo/anywhere.png')}}" alt="Multi-Device Sync" class="w-64 h-64 object-cover mb-4 rounded-lg">
      <h3 class="text-xl font-bold mb-2">Read In Anytime Anywhere</h3>
      <p>Membaca buku kapanpun dan dimanapun dengan mudah.</p>
    </div>
  </div>
</section>

<!-- Team Section -->
<section class="mb-12">
  <h2 class="text-2xl font-bold mb-4">Meet the Team</h2>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
    <div class="text-center">
      <img src="{{asset('Photo/wisnu.jpg')}}" alt="Team Member" class="rounded-full mx-auto mb-4 min-w-48 h-48 object-cover object-top">
      <h3 class="text-xl font-bold">Wisnu Sasongko</h3>
      <p>Frontend Developer</p>
    </div>
    <div class="text-center">
      <img src="{{asset('Photo/ilyaz.jpg')}}" alt="Team Member" class="rounded-full mx-auto mb-4 min-w-48 h-48 object-cover object-top">
      <h3 class="text-xl font-bold">Illyaz Arya Shihab Kusuma</h3>
      <p>Backend Developer</p>
    </div>
    <div class="text-center">
      <img src="{{asset('Photo/profile.jpeg')}}" alt="Team Member" class="rounded-full mx-auto mb-4 min-w-48 h-48 object-cover object-top">
      <h3 class="text-xl font-bold">Muh. Afiq Ma'mun</h3>
      <p>Frontend Developer</p>
    </div>
    <div class="text-center">
      <img src="{{asset('Photo/humambaru.jpg')}}" alt="Team Member" class="rounded-full mx-auto mb-4 min-w-48 h-48 object-cover object-top">
      <h3 class="text-xl font-bold">Muhammad Fawwaz Humam</h3>
      <p>Frontend Developer</p>
    </div>
    <div class="text-center">
      <img src="{{asset('Photo/brilyan2.jpg')}}" alt="Team Member" class="rounded-full mx-auto mb-4 min-w-48 h-48 object-cover object-top">
      <h3 class="text-xl font-bold">Brilyan Harwan</h3>
      <p>Frontend Developer</p>
    </div>
  </div>
</section>
@endsection