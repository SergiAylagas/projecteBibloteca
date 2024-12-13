<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-grey-500 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-20">
                        <div class='bg-gray-300'>
                            <div class="p-3 px-6 min-h-48 flex justify-center items-center" style="cursor: auto;">
                                @php
                                $users = App\Models\User::all();
                                @endphp
                                <div class="overflow-y-auto h-auto">
                                    <div class="flex flex-col gap-10">
                                        <div class="flex items-center justify-between">
                                            <h1 class="text-2xl font-bold">Administració d'Usuaris</h1>
                                        </div>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                            @foreach ($users as $user)
                                            <div class="rounded-md shadow-md bg-coolGray-900 text-coolGray-100 p-4">
                                                <div class="flex items-center space-x-2 mb-2">
                                                    <img src="{{ asset('storage/' . ($user->imatge ?? 'default.png')) }}"
                                                        alt="{{ $user->nick }}" class="object-cover object-center w-8 h-8 rounded-full shadow-sm bg-coolGray-500 border-coolGray-700">
                                                    <div>
                                                        <h2 class="text-sm font-semibold leading-none">{{ $user->name }} {{ $user->surname }}</h2>
                                                        <span class="text-lg font-light text-grey-100">{{ '@'.$user->name }}</span>
                                                    </div>
                                                </div>
                                                <p class="text-base font-semibold mb-2">Email: {{ $user->email }}</p>
                                                <p class="text-base font-semibold mb-2">Rol: {{ $user->rol }}</p>
                                                <div class="flex items-center space-x-2">
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Editar</a>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </form>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div id="no-users-message" class="hidden text-center text-red-500 mt-4">
                                            No hi ha usuaris.
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
</x-app-layout>