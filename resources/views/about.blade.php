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
    <div class="bg-white p-6 rounded-lg shadow">
      <img src="https://images.pexels.com/photos/415078/pexels-photo-415078.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Personalized Recommendations" class="w-full h-40 object-cover mb-4 rounded-lg">
      <h3 class="text-xl font-bold mb-2">Personalized Recommendations</h3>
      <p>Get book and article suggestions tailored to your preferences.</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
      <img src="https://images.pexels.com/photos/415078/pexels-photo-415078.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Offline Reading" class="w-full h-40 object-cover mb-4 rounded-lg">
      <h3 class="text-xl font-bold mb-2">Offline Reading</h3>
      <p>Download content to read offline, anytime and anywhere.</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
      <img src="https://images.pexels.com/photos/415078/pexels-photo-415078.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Interactive Notes" class="w-full h-40 object-cover mb-4 rounded-lg">
      <h3 class="text-xl font-bold mb-2">Interactive Notes</h3>
      <p>Take notes and highlight important sections within the app.</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
      <img src="https://images.pexels.com/photos/415078/pexels-photo-415078.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Social Sharing" class="w-full h-40 object-cover mb-4 rounded-lg">
      <h3 class="text-xl font-bold mb-2">Social Sharing</h3>
      <p>Share your favorite reads with friends and family on social media.</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
      <img src="https://images.pexels.com/photos/415078/pexels-photo-415078.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Reading Progress Tracker" class="w-full h-40 object-cover mb-4 rounded-lg">
      <h3 class="text-xl font-bold mb-2">Reading Progress Tracker</h3>
      <p>Track your reading progress and set goals to stay motivated.</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
      <img src="https://images.pexels.com/photos/415078/pexels-photo-415078.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Multi-Device Sync" class="w-full h-40 object-cover mb-4 rounded-lg">
      <h3 class="text-xl font-bold mb-2">Multi-Device Sync</h3>
      <p>Sync your reading progress across all your devices seamlessly.</p>
    </div>
  </div>
</section>

<!-- Team Section -->
<section class="mb-12">
  <h2 class="text-2xl font-bold mb-4">Meet the Team</h2>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
    <div class="text-center">
      <img src="https://st3.depositphotos.com/15648834/17930/v/450/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" alt="Team Member" class="rounded-full mx-auto mb-4">
      <h3 class="text-xl font-bold">Wisnu Sasongko</h3>
      <p>Frontend Developer</p>
    </div>
    <div class="text-center">
      <img src="https://st3.depositphotos.com/15648834/17930/v/450/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" alt="Team Member" class="rounded-full mx-auto mb-4">
      <h3 class="text-xl font-bold">Illyaz Arya Shihab Kusuma</h3>
      <p>Backend Developer</p>
    </div>
    <div class="text-center">
      <img src="https://st3.depositphotos.com/15648834/17930/v/450/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" alt="Team Member" class="rounded-full mx-auto mb-4">
      <h3 class="text-xl font-bold">Muh. Afiq Ma'mun</h3>
      <p>Frontend Developer</p>
    </div>
    <div class="text-center">
      <img src="https://st3.depositphotos.com/15648834/17930/v/450/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" alt="Team Member" class="rounded-full mx-auto mb-4">
      <h3 class="text-xl font-bold">Muhammad Fawwaz Humam</h3>
      <p>Project Manager</p>
    </div>
    <div class="text-center">
      <img src="https://st3.depositphotos.com/15648834/17930/v/450/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" alt="Team Member" class="rounded-full mx-auto mb-4">
      <h3 class="text-xl font-bold">Brilyan Harwan</h3>
      <p>Frontend Developer</p>
    </div>
  </div>
</section>
@endsection