<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-grey-500 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-20">
                        <div calss='bg-gray-300'>
                            <div class="p-3 px-6 min-h-48 flex justify-center items-center" style="cursor: auto;">
                                <custom-card3 class="w-full">
                                    <div class="rounded-md shadow-md w-full bg-coolGray-900 text-coolGray-100">
                                        <div class="flex items-center justify-between p-3" style="cursor: auto;">
                                            <div class="flex items-center space-x-2" style="cursor: auto;">
                                                <img src="{{ asset('storage/' . ($image->user->image ?? 'default.png')) }}"
                                                    alt="{{ $image->user->username }}" class="object-cover object-center w-8 h-8 rounded-full shadow-sm bg-coolGray-500 border-coolGray-700" style="cursor: auto;">
                                                <div class="-space-y-1" style="cursor: auto;">
                                                    <h2 class="text-sm font-semibold leading-none" style="cursor: auto;">{{ $image->user->username }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="" class="object-cover object-center w-full h-48 bg-coolGray-500 mb-4">
                                        <div class="p-4" style="cursor: auto;">
                                            <div class="space-y-3" style="cursor: auto;">
                                                <p class="text-sm" style="cursor: auto;">
                                                    <span class="text-base font-light">{{ '@'.$image->user->username }} | {{ $image->created_at }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </custom-card3>
                            </div>
                            <div class="p-3 px-6 min-h-48 flex justify-center items-center" style="cursor: auto;">
                                <custom-card3 class="w-full">
                                    <div class="rounded-md shadow-md w-full bg-coolGray-900 text-coolGray-100">
                                        <div class="p-4" style="cursor: auto;">
                                            <div class="flex items-center justify-between p-3" style="cursor: auto;">
                                                <p class="text-sm" style="cursor: auto;">
                                                    <span class="text-xl font-semibold">Comments ({{ count($image->comments) }})</span>
                                                </p>
                                            </div>
                                            @foreach ($image->comments as $comment)
<div class="space-y-1" style="cursor: auto;">
    <p class="text-sm px-3 py-2" style="cursor: auto;">
        <span class="text-base font-light text-grey-100">{{ '@'.$comment->user->nick }} | {{ $comment->created_at->diffForHumans() }}</span>
        <br>
        <span class="text-base font-semibold">{{ $comment->content }}
            @if ($comment->user_id == Auth::user()->id || $image->user_id == Auth::user()->id)
            <form action="{{ route('delete.comment', ['id' => $comment->id]) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" title="Delete comment" style="background:none; border:none; padding:0; cursor:pointer;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline w-5 h-5 fill-current" viewBox="0 0 384 512">
                        <path fill="#ed2602" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                    </svg>
                </button>
            </form>
            @endif
        </span>
        <br>
        <span class="text-base font-light">Rating: 
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= $comment->rating)
                    <i class="fas fa-star text-yellow-500"></i>
                @else
                    <i class="far fa-star text-yellow-500"></i>
                @endif
            @endfor
        </span>
    </p>
    <hr>
</div>
@endforeach
                                            <form action="{{ route('store.comment') }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="image_id" value="{{ $image->id }}">
                                                <div class="space-y-2 px-5">
                                                    <input type="text" name="content" placeholder="Add a comment..." class="w-full py-0.5 bg-transparent border-none rounded text-sm pl-0 text-coolGray-100" style="cursor: auto;">
                                                    <x-input-error class="mt-2" :messages="$errors->get('content')" />
                                                    <div class="flex items-center py-2 gap-4">
                                                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                                                        <div class="flex items-center">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="hidden" />
                                                                <label for="star{{ $i }}" class="cursor-pointer">
                                                                    <i class="far fa-star text-yellow-500"></i>
                                                                </label>
                                                            @endfor
                                                        </div>
                                                        <x-input-error class="mt-2" :messages="$errors->get('rating')" />
                                                        @if (session('status') === 'profile-updated')
                                                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </custom-card3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>