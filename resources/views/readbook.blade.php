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

  <div class="divider"></div>

  <!-- like -->
  <div class="p-4 flex items-center gap-4">
    @auth
    @if($file->likes()->where('user_id', Auth::id())->exists())
    <form action="{{ route('unlikeFile', $file) }}" method="POST">
      @csrf
      <div class="tooltip" data-tip="Remove like">
        <button type="submit" class="text-error fa-solid fa-heart text-lg px-4 py-2 rounded-full bg-white shadow-lg"><span class="text-black"> {{ $file->likes }}</span></button>
      </div>
    </form>
    @else
    <form action="{{ route('likeFile', $file->id) }}" method="POST">
      @csrf
      <span class="tooltip" data-tip="Like book">
        <button type="submit" class="text-error fa-regular fa-heart text-lg px-4 py-2 rounded-full bg-white shadow-lg"><span class="text-black"> {{ $file->likes }}</span></button>
      </span>
    </form>
    @endif
    @endauth
    <div class="tooltip" data-tip="Share book">
      <button class="px-4 py-2 rounded-full bg-white shadow-lg"><i class="fa-solid fa-share"></i> Share</button>
    </div>
  </div>
  <!-- comments -->
  <details class="group mb-8 p-4">
    <summary class="[&::-webkit-details-marker]:hidden relative pr-8 font-medium list-none cursor-pointer text-slate-700 focus-visible:outline-none transition-colors duration-300 group-hover:text-slate-900">
      <div class="flex items-center justify-between mb-4">
        <h1 class="text-xl font-bold">Comments</h1>
        <i class="fa-solid fa-angle-down text-xl"></i>
      </div>
      @if(Auth::user())
      <form action="{{ route('comments.store', $file->id) }}" method="POST" class="mb-4">
        @csrf
        <textarea name="content" required class="w-full input input-bordered p-4 h-16" placeholder="Type your comment here..."></textarea>
        <button type="submit" class="btn bg-blue-500 text-white hover:bg-blue-600">Comment</button>
      </form>
      @else
      <strong class="text-center w-full">You need to login to post a comment.</strong>
      @endif
    </summary>
    <div class="p-2 bg-gray-100 rounded-box">
      <section class="p-4">
        <h2 class="text-xl font-bold mb-4">Comments List</h2>

        <ul aria-label="Nested user feed" role="feed" class="relative flex flex-col gap-4 py-12 pl-8 before:absolute before:top-0 before:left-8 before:h-full before:border before:-translate-x-1/2 before:border-slate-200 before:border-dashed after:absolute after:top-6 after:left-8 after:bottom-6 after:border after:-translate-x-1/2 after:border-slate-200 ">
          @foreach($file->comments()->whereNull('parent_id')->get() as $comment)
          <li role="article" class="relative pl-8 ">
            <div class="flex flex-col flex-1 gap-2">
              <a href="{{ route('showProfile', ['id' => $comment->user->id]) }}" class="absolute z-10 inline-flex items-center justify-center w-8 h-8 text-white rounded-full -left-4 ring-2 ring-white">
                <img src="{{ asset('Photo/' . $comment->user->File_Name) }}" alt="user name" title="user name" width="48" height="48" class="max-w-full rounded-full" />
              </a>
              <h4 class="flex flex-col items-start text-lg font-medium leading-8 lg:items-center md:flex-row text-slate-700"><span class="flex-1">{{ $comment->user->First_Name . " " . $comment->user->Last_Name . '\'s' }}<span class="text-base font-normal text-slate-500"> Comment</span></span><span class="text-sm font-normal text-slate-400">
                  @php
                  $dateParsed = strtotime($comment->created_at);
                  $now = time();
                  $diffInSeconds = $now - $dateParsed;

                  if ($diffInSeconds < 60) { $formattedDate=$diffInSeconds . ' seconds ago' ; } elseif ($diffInSeconds < 3600) { $minutes=floor($diffInSeconds / 60); $formattedDate=$minutes . ' minutes ago' ; } elseif ($diffInSeconds < 86400) { $hours=floor($diffInSeconds / 3600); $formattedDate=$hours . ' hours ago' ; } elseif ($diffInSeconds < 604800) { $days=floor($diffInSeconds / 86400); $formattedDate=$days . ' days ago' ; } else { $formattedDate=date('d/m', $dateParsed); } @endphp {{ $formattedDate }} </span>
              </h4>
              <p class=" text-slate-500">{{ $comment->content }}</p>
              <div class="flex gap-2">
                <form action="{{ route('comments.like', $comment->id) }}" method="POST">
                  @csrf
                  <span class="tooltip" data-tip="Like this comment">
                    <button type="submit" class="text-black"><i class="fa-regular fa-heart"></i> {{ $comment->likes->count() }}</button>
                  </span>
                </form>
                <button type="button" class="text-blue-500 reply-btn" data-id="{{ $comment->id }}" data-author="{{ $comment->user->First_Name }}">Reply</button>
              </div>
            </div>
            @if(count($comment->replies) !== 0)
            <ul role="group" class="relative flex flex-col gap-12 py-4 pl-6 lg:pl-8 after:absolute after:top-12 after:left-6 lg:after:left-8 after:bottom-12 after:border after:-translate-x-1/2 after:border-slate-200 before:absolute before:top-6 before:left-6 lg:before:left-8 before:bottom-6 before:border before:-translate-x-1/2 before:border-slate-200 before:border-dashed">
              @foreach($comment->replies as $reply)
              <li role="article" class="relative pl-6 lg:pl-8 ">
                <div class="flex flex-col flex-1 gap-2">
                  <a href="{{ route('showProfile', $reply->user->id) }}" class="absolute z-10 inline-flex items-center justify-center w-8 h-8 text-white rounded-full -left-4 ring-2 ring-white">
                    <img src="{{ asset('Photo/' . $reply->user->File_Name) }}" alt="user name" title="user name" width="48" height="48" class="max-w-full rounded-full" />
                  </a>
                  <h4 class="flex flex-col items-start text-lg font-medium leading-8 lg:items-center md:flex-row text-slate-700"><span class="flex-1">{{ $reply->user->First_Name . " " . $comment->user->Last_Name . '\'s' }}<span class="text-base font-normal text-slate-500"> reply </span></span><span class="text-sm font-normal text-slate-400">
                      @php
                      $dateParsed = strtotime($reply->created_at);
                      $now = time();
                      $diffInSeconds = $now - $dateParsed;

                      if ($diffInSeconds < 60) { $formattedDate=$diffInSeconds . ' seconds ago' ; } elseif ($diffInSeconds < 3600) { $minutes=floor($diffInSeconds / 60); $formattedDate=$minutes . ' minutes ago' ; } elseif ($diffInSeconds < 86400) { $hours=floor($diffInSeconds / 3600); $formattedDate=$hours . ' hours ago' ; } elseif ($diffInSeconds < 604800) { $days=floor($diffInSeconds / 86400); $formattedDate=$days . ' days ago' ; } else { $formattedDate=date('d/m', $dateParsed); } @endphp {{ $formattedDate }} </span>
                  </h4>
                  <p class=" text-slate-500"><span class="font-semibold text-black">{{ $reply->parent_author_first_name }}</span> {{ $reply->content }}</p>
                </div>
                <form action="{{ route('comments.like', $comment->id) }}" method="POST">
                  @csrf
                  <span class="tooltip" data-tip="Like this comment">
                    <button type="submit" class="text-black"><i class="fa-regular fa-heart"></i> {{ $comment->likes->count() }}</button>
                  </span>
                </form>
              </li>
              @endforeach
            </ul>
            @endif
            <div class="reply-form hidden" id="reply-form-{{ $comment->id }}">
              <p>Replying to <span class="reply-author">{{ $comment->parent_author_first_name }}</span></p>
              <form action="{{ route('comments.store', $file->id) }}" method="POST">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <input type="hidden" name="parent_author_first_name" value="">
                <textarea name="content" required class="w-full p-2 border border-gray-300 rounded mb-2"></textarea>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Reply</button>
              </form>
            </div>
          </li>
          @endforeach
        </ul>
      </section>
    </div>
  </details>
  <div class="divider"></div>
  <!-- more from writer -->
  <section class="h-max mb-8">
    <h2 class="font-bold text-lg mb-4">More From Writer</h2>
    <div class="grid grid-cols-2 gap-4 md:flex md:flex-wrap md:gap-4 h-max">
      @foreach ($file->user->files->where('Type', 'Public') as $otherFile)
      <x-book-card :file=$otherFile />
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

  <script>
    document.querySelectorAll('.reply-btn').forEach(button => {
      button.addEventListener('click', function() {
        const replyForm = document.getElementById(`reply-form-${this.dataset.id}`);
        const authorName = this.dataset.author;
        if (replyForm) {
          replyForm.classList.toggle('hidden');
          replyForm.querySelector('.reply-author').textContent = authorName;
          replyForm.querySelector('input[name="parent_author_first_name"]').value = authorName;
        } else {
          console.error(`Reply form with ID reply-form-${this.dataset.id} not found.`);
        }
      });
    });
    document.querySelectorAll('.report-btn').forEach(button => {
      button.addEventListener('click', () => {
        const reportForm = document.getElementById(`report-form-${button.dataset.id}`);
        reportForm.classList.toggle('hidden');
      });
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