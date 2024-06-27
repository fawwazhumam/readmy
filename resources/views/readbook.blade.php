@extends('layouts.app')

@section('content')

<section class="relative min-h-[32rem] h-[80vh] max-h-[80vh] mb-8 bg-secondary rounded-lg">
  <div id="flipbook" class="h-full relative flex justify-center items-center">
    <i class="fa-solid fa-angle-left py-8 px-2 absolute left-4 top-1/2 -translate-y-1/2 text-white text-5xl cursor-pointer hover:bg-black hover:bg-opacity-40 duration-300 rounded-md"></i>

    <!-- flipbook -->

    <div id="book" class="h-full w-1/4 min-w-48 bg-white shadow-white">a</div>

    <!-- flipbook -->

    <i class="fa-solid fa-angle-right py-8 px-2 absolute right-4 top-1/2 -translate-y-1/2 text-white text-5xl cursor-pointer hover:bg-black hover:bg-opacity-40 duration-300 rounded-md"></i>
  </div>
</section>
<!-- end of flipbook section -->

<!-- profile information -->
<section class="mb-8">
  <div class="mb-6">
    <h1 class="text-2xl font-bold">{{ $file->Title }}</h1>
    <p class="text-sm">by <span>{{ $file->user->First_Name }}</span></p>
  </div>
  <div class="w-96 flex justify-between items-center gap-8 mb-8">
    <div class="w-[40%] flex items-center gap-2 cursor-pointer">
      <a href="{{ route('showProfile', $file->user->id) }}">
        <img class="w-full" src="{{ asset('Photo/' . $file->user->File_Name) }}" style="width: 65px; height: 65px; object-fit: cover; object-position: center; border-radius: 50%" alt="profile" />
        <p>{{ $file->user->First_Name }}</p>
      </a>
    </div>
    <div>
      @auth
      @if(Auth::user()->id !== $file->user_id) <!-- Prevent self-follow -->
      @if(Auth::user()->followings->contains($file->user_id))
      <form action="{{ route('unfollow', $file->user_id) }}" method="POST">
        @csrf
        <button type="submit" class="px-4 py-2 font-semibold shadow-lg bg-red-500 text-white rounded-full hover:bg-gray-200 shadow-sm duration-300">Unfollow</button>
      </form>
      @else
      <form action="{{ route('followUser', $file->user_id) }}" method="POST">
        @csrf
        <button type="submit" class="px-4 py-2 font-semibold shadow-lg bg-green-500 text-white rounded-full hover:bg-gray-200 shadow-sm duration-300">Follow</button>
      </form>
      @endif
      @endif
      @if(Auth::user()->savedBooks->contains($file->id))
      <form action="{{ route('removeBook', $file->id) }}" method="POST">
        @csrf
        <button type="submit" class="px-4 py-2 font-semibold shadow-lg bg-red-500 text-white rounded-full hover:bg-gray-200 shadow-sm duration-300">Remove Bookmark</button>
      </form>
      @else
      <form action="{{ route('saveBook', $file->id) }}" method="POST">
        @csrf
        <button type="submit" class="px-4 py-1 bg-gray-100 font-bold rounded-full hover:bg-gray-200 shadow-sm duration-300"">Bookmark</button>
                      </form>
                  @endif
                  <button id=" reportBtn" class="px-4 py-2 bg-red-500 text-white rounded-full hover:bg-red-700">
          Report
        </button>
        @endauth
    </div>
  </div>

  <div id="reportModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
      <h2 class="text-xl font-bold mb-4">Report Post</h2>
      <form action="{{ route('reportFile', $file->id) }}" method="POST">
        @csrf
        <div class="mb-4">
          <label for="category">Category</label>
          <select name="category" id="category" class="form-control p-4 rounded-md bg-gray-100 bg-opacity-70 shadow outline-primary" required>
            <option value="Violation">Violation</option>
            <option value="Pornography">Pornography</option>
            <option value="Racism">Racism</option>
            <option value="False information">False information</option>
            <option value="Scam">Scam</option>
            <option value="Sale of illegal goods">Sale of illegal goods</option>
          </select>
        </div>
        <div class="mb-4">
          <label for="reason" class="block text-gray-700">Reason:</label>
          <textarea name="reason" id="reason" class="w-full p-2 border border-gray-300 rounded" required></textarea>
        </div>
        <div class="flex justify-end">
          <button type="button" id="closeModalBtn" class="px-4 py-2 bg-gray-300 rounded mr-2 hover:bg-gray-400">Cancel</button>
          <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-700">Submit</button>
        </div>
      </form>
    </div>
  </div>

  <p><i class="fa-solid fa-user"></i> Followers: {{ $file->user->followers_count }}</p>
  <hr class="p-4">

  <div class="w-2/3">
    <h2 class="text-xl font-bold mb-2">About</h2>
    <p>
      {{ $file->Desc }}
    </p>
    <p><i class="fa-solid fa-bookmark"></i> {{ $file->bookmarks_count }} Bookmarks</p>
  </div>
</section>
<!-- end of profile information -->

<!-- more from writer -->
<section class="h-max mb-8">
  <h2 class="font-bold text-lg mb-4">More From Writer</h2>
  <div class="grid grid-cols-2 gap-4 md:flex md:flex-wrap md:gap-4 h-max">
    @foreach ($file->user->files as $otherFile)
    <x-book-card :file=$file />
    @endforeach
  </div>
</section>


<!-- end of main section -->

<script src="/3dflipbook/js/jquery.min.js"></script>
<script src="/3dflipbook/js/html2canvas.min.js"></script>
<script src="/3dflipbook/js/three.min.js"></script>
<script src="/3dflipbook/js/pdf.min.js"></script>
<script type="text/javascript">
  window.PDFJS_LOCALE = {
    pdfJsWorker: '/3dflipbook/js/pdf.worker.js',
    pdfJsCMapUrl: '/3dflipbook/cmaps'
  }
</script>
<script src="/3dflipbook/js/3dflipbook.min.js"></script>
<script type="text/javascript">
  $('#flipbook').FlipBook({
    pdf: "{{ route('viewFile',['fileName' => $file->File_Name]) }}",
    template: {
      html: '/3dflipbook/templates/default-book-view.html',
      styles: [
        '/3dflipbook/css/black-book-view.css'
      ],
      links: [{
        rel: 'stylesheet',
        href: '/3dflipbook/css/font-awesome.min.css'
      }],
      script: '/3dflipbook/js/default-book-view.js',
      printStyle: undefined,
    },
  });
</script>
<script>
  document.getElementById('reportBtn').addEventListener('click', function() {
    document.getElementById('reportModal').classList.remove('hidden');
  });

  document.getElementById('closeModalBtn').addEventListener('click', function() {
    document.getElementById('reportModal').classList.add('hidden');
  });

  window.addEventListener('click', function(event) {
    document.querySelector(".demo-msg").classList.add('hidden')
    if (event.target === document.getElementById('reportModal')) {
      document.getElementById('reportModal').classList.add('hidden');
    }
  });
</script>
@endsection