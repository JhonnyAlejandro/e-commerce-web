@extends('dashboard')

@section('content')
    @if (session('notification'))
        <x-notification>
            {{ session('notification') }}
        </x-notification>
    @endif
    @if ($categories->isEmpty())
    <x-empty-states>
        <x-slot name="modal">
            @include('modules.categories.create')
        </x-slot>
    </x-empty-states>
    @else
        <div class="bg-white shadow-lg rounded-lg">
            <div class="py-5 px-6 border-gray-200 border-b-2">
                <x-card-header>
                    <x-slot name="title">Categorías registradas</x-slot>
                    <x-slot name="modal">
                        @include('modules.categories.create')
                    </x-slot>
                </x-card-header>
            </div>
            <ul class="grid grid-cols-1 gap-5 py-12 px-8 lg:grid-cols-2 lg:gap-6 xl:grid-cols-4" role="list">
                @foreach ($categories as $category)
                    <li>
                        <div x-data="{ dropdowns: false, category: {} }" class="flex justify-between items-center rounded-md border-gray-200 border-2">
                            <div class="flex-1 overflow-hidden py-2 px-4 font-semibold text-gray-900 whitespace-nowrap text-ellipsis">{{ $category->name }}</div>
                            <div class="relative">
                                <button x-on:click="dropdowns =! dropdowns" class="block pr-2 text-gray-400 hover:text-gray-500">
                                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z"></path>
                                    </svg>
                                </button>
                                <div x-show="dropdowns" x-on:click.outside="dropdowns = false" x-transition.origin.top.right class="absolute right-0 z-10 overflow-hidden w-40 mt-2 py-2 bg-white ring-1 ring-black/[0.1] rounded-md shadow-lg" style="display: none;">
                                    <div x-data="{ modal: false }">
                                        <button x-on:click="modal =! modal; dropdowns = false" class="flex items-center w-full py-3 px-4 text-lg leading-6 text-gray-700 hover:text-gray-900 hover:bg-gray-100">
                                            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6 mr-3">
                                                <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z"></path>
                                                <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z"></path>
                                            </svg>
                                            Editar
                                        </button>
                                        <template x-teleport="body">
                                            @include('modules.categories.edit')
                                        </template>
                                    </div>
                                    <div x-data="{ modal: false }">
                                        <button x-on:click="modal =! modal; dropdowns = false" class="flex items-center w-full py-3 px-4 text-lg leading-6 text-gray-700 hover:text-gray-900 hover:bg-gray-100">
                                            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6 mr-3">
                                                <path clip-rule="evenodd" fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z"></path>
                                            </svg>
                                            Eliminar
                                        </button>
                                        <template x-teleport="body">
                                            @include('modules.categories.delete')
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@stop
