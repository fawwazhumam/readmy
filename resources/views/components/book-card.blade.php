<div class="min-w-56 w-56 h-max bg-[#fafaf9] shadow-lg p-2 rounded-lg">
    <!-- still no image -->
    <a href="{{ route('ReadBook', ['id' => $file->id]) }}" class="w-full h-3/4">
        <img class="w-full h-full rounded-md" src="{{ asset('images/card-book-placeholder.jpg') }}" alt="book" />
    </a>
    <!-- still no image -->
    <div class="flex justify-between items-center pt-2">
        <div>
            <div class="tooltip" data-tip="{{ $file->Title }}">
                <a href="{{ route('ReadBook', ['id' => $file->id]) }}" class="font-semibold hover:underline">{{ Str::limit($file->Title, 16) }}</a>
            </div>
            <p class="text-gray-500 text-xs">Published by <span class="text-info">{{ $file->user ? $file->user->First_Name : 'Unknown' }}</span></p>
        </div>
        <!-- <p class="text-sm">On {{ $file->created_at->format('d M Y') }}</p> -->
        <!-- <div class="flex items-center justify-between mt-2">
            <form action="{{ route('likeFile', $file->id) }}" method="POST">
                @csrf
                <span class="tooltip" data-tip="Like book">
                    <button type="submit" class="text-error fa-solid fa-heart text-lg btn btn-ghost"><span class="text-black">{{ $file->likes }}</span></button>
                </span>
            </form>
            @auth
            @if(Auth::user()->savedBooks->contains($file->id))
            <form action="{{ route('removeBook', $file->id) }}" method="POST">
                @csrf
                <span class="tooltip" data-tip="Remove from saved book">
                    <button type="submit" class="btn btn-ghost text-green-500">
                        <i class="fa-solid fa-bookmark text-lg"></i>
                    </button>
                </span>
            </form>
            @else
            <form action="{{ route('saveBook', $file->id) }}" method="POST">
                @csrf
                <span class="tooltip" data-tip="Save this book">
                    <button type="submit" class="btn btn-ghost text-green-500">
                        <i class="fa-regular fa-bookmark text-lg"></i>
                    </button>
                </span>
            </form>
            @endif
            @endauth
        </div> -->
        <div class="flex items-center gap-2">
            @auth
            @if(Auth::user()->savedBooks->contains($file->id))
            <form action="{{ route('likeFile', $file->id) }}" method="POST">
                @csrf
                <span class="tooltip" data-tip="Like book">
                    <button type="submit" class="text-error fa-solid fa-heart text-sm"><span class="text-black"> {{ $file->likes }}</span></button>
                </span>
            </form>
            @else
            <!-- form -->
            @endif
            @endauth
            <div class="dropdown dropdown-top">
                <div tabindex="0" role="button" class="m-1">
                    <i class="fa-solid fa-ellipsis-vertical text-lg"></i>
                </div>
                <ul tabindex="0" class="dropdown-content z-[1] menu w-32 py-2 px-0 bg-base-100 rounded-sm shadow">
                    <li>
                        @auth
                        @if(Auth::user()->savedBooks->contains($file->id))
                        <form action="{{ route('removeBook', $file->id) }}" method="POST" class="rounded-none">
                            @csrf
                            <span class="tooltip" data-tip="Remove from your bookmark">
                                <button type="submit" class="flex items-center gap-2">
                                    <a class="rounded-none">
                                        <i class="fa-solid fa-bookmark"></i> Remove
                                    </a>
                                </button>
                            </span>
                        </form>
                        @else
                        <form action="{{ route('saveBook', $file->id) }}" method="POST" class="rounded-none">
                            @csrf
                            <span class="tooltip" data-tip="Save this book">
                                <button type="submit" class="flex items-center gap-2">
                                    <a class=""><i class="fa-solid fa-bookmark"></i> Save</a>
                                </button>
                            </span>
                        </form>
                        @endif
                        @endauth
                    </li>
                    <li><a class="rounded-none"><i class="fa-solid fa-share"></i> Share</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>