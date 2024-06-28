@extends('layouts.app')

@section('content')

<section class="relative min-h-[32rem] h-[80vh] max-h-[80vh] mb-4 bg-secondary rounded-lg">
  <div id="flipbook" class="h-full relative flex justify-center items-center">
    <i class="fa-solid fa-angle-left py-8 px-2 absolute left-4 top-1/2 -translate-y-1/2 text-white text-5xl cursor-pointer hover:bg-black hover:bg-opacity-40 duration-300 rounded-md"></i>

    <!-- flipbook -->

    <div id="book" class="h-full w-1/4 min-w-48 bg-white shadow-white"></div>

    <!-- flipbook -->

    <i class="fa-solid fa-angle-right py-8 px-2 absolute right-4 top-1/2 -translate-y-1/2 text-white text-5xl cursor-pointer hover:bg-black hover:bg-opacity-40 duration-300 rounded-md"></i>
  </div>
</section>
<!-- end of flipbook section -->

<!-- profile information -->
<section>
  <details class="group mb-8 p-4">
    <summary class="[&::-webkit-details-marker]:hidden relative pr-8 font-medium list-none cursor-pointer text-slate-700 focus-visible:outline-none transition-colors duration-300 group-hover:text-slate-900 flex items-center justify-between">
      <h1 class="text-3xl font-bold">{{ Str::title($file->Title) }}</h1>
      <i class="fa-solid fa-angle-down text-xl"></i>
    </summary>
    <div class="p-2 bg-gray-100 rounded-box">
      <strong class="mt-4">Description</strong>
      <p class="mt-4 text-slate-500">
        {{ $file->Desc }}
      </p>
      <p><i class="fa-solid fa-bookmark"></i> This book saved by {{ $file->bookmarks_count }} users.</p>
    </div>
  </details>

  <div class="divider"></div>
  <div class="w-full px-4 flex justify-between items-center gap-8">
    <div class="w-[40%] flex items-center gap-2 cursor-pointer">
      <a href="{{ route('showProfile', $file->user->id) }}" class="flex items-center gap-4">
        <img class="w-full" src="{{ asset('Photo/' . $file->user->File_Name) }}" style="width: 65px; height: 65px; object-fit: cover; object-position: center; border-radius: 50%" alt="profile" />
        <div>
          <h1 class="text-xl font-semibold">{{ $file->user->First_Name }}</h1>
          <p>{{ $file->user->followers_count }} Followers</p>
        </div>
      </a>
    </div>
    <div class="flex items-center gap-4">
      @auth
      @if(Auth::user()->savedBooks->contains($file->id))
      <form action="{{ route('removeBook', $file->id) }}" method="POST">
        @csrf
        <div class="tooltip" data-tip="Remove from saved book">
          <button type="submit"><i class=" fa-solid fa-bookmark text-3xl"></i></button>
        </div>
      </form>
      @else
      <form action="{{ route('saveBook', $file->id) }}" method="POST">
        @csrf
        <div class="tooltip" data-tip="Save this book">
          <button type="submit" class=""><i class=" fa-regular fa-bookmark text-3xl"></i></button>
        </div>
      </form>
      @endif
      @if(Auth::user()->id !== $file->user_id) <!-- Prevent self-follow -->
      @if(Auth::user()->followings->contains($file->user_id))
      <form action="{{ route('unfollow', $file->user_id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-error rounded-full text-white">Unfollow</button>
      </form>
      @else
      <form action="{{ route('followUser', $file->user_id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary rounded-full text-white">Follow</button>
      </form>
      @endif
      @endif
      @if(Auth::user()->id !== $file->user_id)
      <button class=" btn btn-error text-white rounded-full" onclick="my_modal_1.showModal()">Report</button>
      @endif
      @endauth
    </div>
  </div>

  <dialog id="my_modal_1" class="modal">
    <div class="modal-box">
      <h2 class="text-xl font-bold mb-4">Report Post</h2>
      <form action="{{ route('reportFile', $file->id) }}" method="POST">
        @csrf
        <div class="mb-4">
          <label for="category">Category</label>
          <select name="category" id="category" class="select select-bordered" required>
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
        <div class="flex justify-end gap-4">
          <form method="dialog">
            <button type="button" id="closeModalBtn" class="btn btn-error text-white">Cancel</button>
          </form>
          <button type="submit" class="btn btn-primary text-white">Submit</button>
        </div>
      </form>
    </div>
  </dialog>

</section>
<div class="divider"></div>

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
  document.getElementById(' reportBtn').addEventListener('click', function() {
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

@endsection