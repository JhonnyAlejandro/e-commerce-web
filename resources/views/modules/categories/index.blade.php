@extends('dashboard')

@section('content')
    @if ($categories->isEmpty())

    @else
        <div class="overflow-hidden bg-white shadow-lg rounded-lg">
            <div class="py-5 px-6 border-gray-200 border-b-2">
                <x-card-header>
                    Categorías registradas

                    <x-slot name="button">
                        Crear nueva categoría
                    </x-slot>
                </x-card-header>
            </div>
            <ul class="grid grid-cols-1 gap-5 py-12 px-8 lg:grid-cols-2 lg:gap-6 xl:grid-cols-4" role="list">
                @foreach ($categories as $category)
                    <li>
                        <div class="flex justify-between items-center rounded-md border-gray-200 border-2">
                            <div class="flex-1 overflow-hidden py-2 px-4 font-semibold text-gray-900 whitespace-nowrap text-ellipsis">{{ $category->name }}</div>
                            <button class="pr-2 text-gray-400 hover:text-gray-500">
                                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z"></path>
                                </svg>
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
@stop
