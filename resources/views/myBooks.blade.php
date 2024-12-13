<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-grey-500 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-20">
                        <div calss='bg-gray-300'>
                            <div class="p-3 px-6 min-h-48 flex justify-center items-center" style="cursor: auto;">
                                @php
                                    $images = App\Models\Image::where('user_id', auth()->id())->get();
                                @endphp
                                <div class="overflow-y-auto h-auto">
                                    <div class="flex flex-col gap-10">
                                        @foreach ($images as $image)

                                        <custom-card3>
                                            <div class="rounded-md shadow-md sm:w-96 bg-coolGray-900 text-coolGray-100">
                                                <div class="flex items-center justify-between p-3" style="cursor: auto;">
                                                    <div class="flex items-center space-x-2" style="cursor: auto;">
                                                        <img src="{{ asset('storage/' . ($image->user->image?? 'default.png')) }}"
                                                            alt="{{ $image->user->nick }}" class="object-cover object-center w-8 h-8 rounded-full shadow-sm bg-coolGray-500 border-coolGray-700" style="cursor: auto;">
                                                        <div class="-space-y-1" style="cursor: auto;">
                                                            <h2 class="text-sm font-semibold leading-none" style="cursor: auto;">{{ $image->user-> name}} {{ $image->user->surname}}</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Imatge -->
                                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="" class="object-cover object-center w-48 h-48 bg-coolGray-500" style="cursor: auto;">
                                                <div class="p-3" style="cursor: auto;">
                                                    <div class="flex items-center justify-between" style="cursor: auto;">
                                                    <!-- Likes  -->
        
                                                    <div class="space-y-3 py-3" style="cursor: auto;">
                                                        <p class="text-sm" style="cursor: auto;">
                                                            <span class="text-lg font-light text-grey-100">{{ '@'.$image->user->name}} | {{ $image->created_at->diffForHumans() }}</span>
                                                        </p>
                                                        <p class="text-sm" style="cursor: auto;">
                                                            <span class="text-base font-semibold px-2">{{ $image->description}}</span>
                                                        </p>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </custom-card3>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>





</x-app-layout>