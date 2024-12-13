<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="post" action="{{ route('store.image') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')
                        @php
                            $generes = App\Models\Genere::all();
                        @endphp
                        <div>
                            <x-text-input id="image" name="image" type="file" class="mt-1 block w-full" autofocus autocomplete="image" />
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />

                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" name="description" type="text" class="mt-1 block w-full" required autofocus />

                            <!-- Dropdown for genre selection -->
                            <select id="genere" name="genere" class="mt-1 block w-auto text-black" required>
                                @foreach($generes as $genere)
                                    <option value="{{ $genere->id }}">{{ $genere->name }}</option>
                                @endforeach
                            </select>

                            <!-- valoration with stars -->
                            <x-input-label for="valoration" :value="__('Valoració')" />
                            <div class="flex items-center" id="star-rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="star text-gray-400 cursor-pointer" data-value="{{ $i }}">★</span>
                                @endfor
                            </div>
                            <input type="hidden" id="valoration" name="valoration" value="" required>
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const stars = document.querySelectorAll('#star-rating .star');
                                    const valorationInput = document.getElementById('valoration');
                                    
                                    stars.forEach(star => {
                                        star.addEventListener('click', function () {
                                            const value = this.getAttribute('data-value');
                                            valorationInput.value = value;
                                            
                                            stars.forEach(s => {
                                                if (s.getAttribute('data-value') <= value) {
                                                    s.classList.add('text-yellow-500');
                                                    s.classList.remove('text-gray-400');
                                                } else {
                                                    s.classList.add('text-gray-400');
                                                    s.classList.remove('text-yellow-500');
                                                }
                                            });
                                        });
                                    });
                                });
                            </script>
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'profile-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600 dark:text-gray-400"
                            >{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
</x-app-layout>