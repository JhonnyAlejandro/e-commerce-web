@extends('layouts.layout')

@section('content')
    <div class="mx-auto px-4 pt-32 pb-24 md:px-6 xl:max-w-7xl xl:px-8">
        <div class="xl:grid xl:grid-cols-7 xl:gap-x-8 xl:gap-y-16">
            <div class="xl:col-span-4">
                <div class="overflow-hidden bg-gray-100 rounded-lg">
                    <img src="{{ asset($product->image) }}" class="w-full h-full object-cover object-center">
                </div>
            </div>
            <div class="max-w-2xl mt-14 mx-auto md:mt-16 xl:col-span-3 xl:max-w-none xl:mt-0">
                <h1 class="text-4xl font-semibold text-gray-900">{{ $product->name }}</h1>
                @if ($product->discount > 0)
                    <div class="flex mt-3">
                        <p class="text-lg font-medium text-gray-500 line-through">${{ number_format($product->price, 0, '.', '.') }}</p>
                        <p class="ml-2 text-3xl font-medium text-gray-900">${{ number_format($product->price - $product->price * ($product->discount / 100), 0, '.', '.') }}</p>
                    </div>
                @else
                    <p class="mt-3 text-3xl font-medium text-gray-900">${{ number_format($product->price, 0, '.', '.') }}</p>
                @endif
                <p class="mt-6 text-lg text-gray-700">{!! nl2br($product->description) !!}</p>
                <x-button class="inline-flex justify-center w-full mt-10 py-3 px-8 focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2">
                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 mr-3">
                        <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"></path>
                    </svg>
                    {{ __('Agregar al carro') }}
                </x-button>
            </div>
            <div class="w-full max-w-2xl mt-24 mx-auto xl:col-span-4 xl:max-w-none xl:mt-0">
                <h2 class="text-2xl font-semibold text-gray-900">Opiniones de los usuarios</h2>
                <div class="mt-6 pb-10 space-y-10 border-gray-200 border-y-2">
                    <div class="pt-10 xl:grid xl:grid-cols-12 xl:gap-x-8">
                        <div class="xl:col-span-8 xl:col-start-5">
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 text-yellow-400">
                                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"></path>
                                    </svg>
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 text-yellow-400">
                                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"></path>
                                    </svg>
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 text-yellow-400">
                                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"></path>
                                    </svg>
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 text-yellow-400">
                                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"></path>
                                    </svg>
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 text-gray-300">
                                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"></path>
                                    </svg>
                                </div>
                                <p class="ml-3 text-lg font-medium text-gray-700">4</p>
                            </div>
                            <div class="mt-4 xl:6 text-lg text-gray-700">Mensaje de prueba.</div>
                        </div>
                        <div class="flex items-center mt-6 xl:flex-col xl:items-start xl:col-span-4 xl:col-start-1 xl:row-start-1 xl:mt-0">
                            <p class="text-lg font-semibold text-gray-900">Jhonny Castaño</p>
                            <p class="ml-4 pl-4 border-gray-200 border-l-2 text-md font-semibold text-gray-700 xl:mt-2 xl:ml-0 xl:pl-0 xl:border-0">Julio 18, 2021</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-2xl mt-16 mx-auto xl:col-span-3 xl:max-w-none xl:mt-0">
                <h2 class="text-2xl font-semibold text-gray-900">Comparte tus pensamientos</h2>
                <p class="mt-1 text-lg text-gray-700">Si ha usado este producto, comparta sus opiniones con otros clientes.</p>
                <form action="">
                    <div class="overflow-hidden mt-6 rounded-lg border-gray-300 border-2 shadow-sm focus-within:ring-2 focus-within:ring-indigo-600">
                        <div class="flex items-center py-3 px-2.5">
                            <input type="radio" id="star1" class="sr-only" name="rating" value="1">
                            <label for="star1" class="cursor-pointer">
                                <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 text-gray-300">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"></path>
                                </svg>
                            </label>
                            <input type="radio" id="star2" class="sr-only" name="rating" value="2">
                            <label for="star2" class="cursor-pointer">
                                <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 text-gray-300">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"></path>
                                </svg>
                            </label>
                            <input type="radio" id="star3" class="sr-only" name="rating" value="3">
                            <label for="star3" class="cursor-pointer">
                                <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 text-gray-300">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"></path>
                                </svg>
                            </label>
                            <input type="radio" id="star4" class="sr-only" name="rating" value="4">
                            <label for="star4" class="cursor-pointer">
                                <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 text-gray-300">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"></path>
                                </svg>
                            </label>
                            <input type="radio" id="star5" class="sr-only" name="rating" value="5">
                            <label for="star5" class="cursor-pointer">
                                <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 text-gray-300">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"></path>
                                </svg>
                            </label>
                        </div>
                        <label for="description"></label>
                        <textarea id="description" class="group block w-full h-40 py-0 text-lg leading-7 text-gray-900 border-0 resize-none focus:ring-0" name="description" placeholder="Agrega tu comentario..."></textarea>
                        <div class="flex justify-end py-2 px-2 border-gray-200 border-t-2 md:px-3">
                            <x-button type="submit" class="inline-flex justify-center w-auto">
                                {{ __('Publicar') }}
                            </x-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
