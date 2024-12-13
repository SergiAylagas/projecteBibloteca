<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-grey-500 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-20">
                        <div calss='bg-gray-300'>
                            <div class="p-3 px-6 min-h-48 flex justify-center items-center" style="cursor: auto;">
                                @php
                                $images = App\Models\Image::all();
                                @endphp
                                @csrf
                                @method('patch')
                                @php
                                    $generes = App\Models\Genere::all();
                                @endphp
                                <div class="overflow-y-auto h-auto">
                                    <div class="flex flex-col gap-10">
                                        <div class="flex items-center justify-between">
                                            <button id="search-button" class="text-white bg-transparent border-0 cursor-pointer ml-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17a6 6 0 100-12 6 6 0 000 12zm0 0l6 6m-6-6h-6" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div id="search-container" class="hidden">
                                            <select id="genere" name="genere" class="mt-1 block w-auto text-black " required onchange="filterByGenre()">
                                                <option value="">Selecciona genere</option>
                                                @foreach($generes as $genere)
                                                    <option value="{{ $genere->id }}">{{ $genere->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div id="images-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                            @foreach ($images as $image)
                                            <div class="rounded-md shadow-md bg-coolGray-900 text-coolGray-100 p-4" data-genere="{{ $image->genere_id }}">
                                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="" class="object-cover object-center w-full h-48 bg-coolGray-500 mb-4">
                                                <div class="flex items-center space-x-2 mb-2">
                                                    <img src="{{ asset('storage/' . ($image->user->imatge ?? 'default.png')) }}"
                                                        alt="{{ $image->user->nick }}" class="object-cover object-center w-8 h-8 rounded-full shadow-sm bg-coolGray-500 border-coolGray-700">
                                                    <div>
                                                        <h2 class="text-sm font-semibold leading-none">{{ $image->user->name }} {{ $image->user->surname }}</h2>
                                                        <span class="text-lg font-light text-grey-100">{{ '@'.$image->user->name }} | {{ $image->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                                <p class="text-base font-semibold mb-2">{{ $image->description }}</p>
                                                <div class="flex items-center space-x-2">
                                                    <a href="{{ route('detail.image', ['image_id' => $image->id]) }}" title="Add a comment" class="flex items-center justify-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-5 h-5 fill-current">
                                                            <path d="M496,496H480a273.39,273.39,0,0,1-179.025-66.782l-16.827-14.584C274.814,415.542,265.376,416,256,416c-63.527,0-123.385-20.431-168.548-57.529C41.375,320.623,16,270.025,16,216S41.375,111.377,87.452,73.529C132.615,36.431,192.473,16,256,16S379.385,36.431,424.548,73.529C470.625,111.377,496,161.975,496,216a171.161,171.161,0,0,1-21.077,82.151,201.505,201.505,0,0,1-47.065,57.537,285.22,285.22,0,0,0,63.455,97L496,457.373ZM294.456,381.222l27.477,23.814a241.379,241.379,0,0,0,135,57.86,317.5,317.5,0,0,1-62.617-105.583v0l-4.395-12.463,9.209-7.068C440.963,305.678,464,262.429,464,216c0-92.636-93.309-168-208-168S48,123.364,48,216s93.309,168,208,168a259.114,259.114,0,0,0,31.4-1.913Z"></path>
                                                        </svg>
                                                    </a>
                                                    <span class="text-sm">{{ $image->comments->isNotEmpty() ? count($image->comments) : '0' }} comentarios</span>
                                                </div>
                                                @if ($image->comments->isNotEmpty())
                                                <div class="mt-2">
                                                    <label class="w-full py-0.5 bg-transparent border-none rounded text-sm pl-0 text-coolGray-100">
                                                        {{ '@'.$image->comments->first()->user->nick }} | {{ $image->comments->first()->content }}
                                                    </label>
                                                </div>
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                        <div id="no-books-message" class="hidden text-center text-red-500 mt-4">
                                            No hi ha llibres d'aquesta categoria.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('search-button').addEventListener('click', function() {
            var searchContainer = document.getElementById('search-container');
            if (searchContainer.classList.contains('hidden')) {
                searchContainer.classList.remove('hidden');
            } else {
                searchContainer.classList.add('hidden');
            }
        });

        function filterByGenre() {
            var selectedGenre = document.getElementById('genere').value;
            var images = document.querySelectorAll('#images-container .rounded-md');
            var noBooksMessage = document.getElementById('no-books-message');
            var visibleImages = 0;

            images.forEach(function(image) {
                if (selectedGenre === "" || image.getAttribute('data-genere') === selectedGenre) {
                    image.style.display = "block";
                    visibleImages++;
                } else {
                    image.style.display = "none";
                }
            });

            if (visibleImages === 0) {
                noBooksMessage.classList.remove('hidden');
            } else {
                noBooksMessage.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>