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
                        <p class="text-lg font-medium text-gray-500 line-through">${{ number_format($product->sale_price, 0, '.', '.') }}</p>
                        <p class="ml-2 text-3xl font-medium text-gray-900">${{ number_format($product->sale_price - $product->sale_price * ($product->discount / 100), 0, '.', '.') }}</p>
                    </div>
                @else
                    <p class="mt-3 text-3xl font-medium text-gray-900">${{ number_format($product->sale_price, 0, '.', '.') }}</p>
                @endif
                <p class="mt-6 text-lg text-gray-700">{!! nl2br($product->description) !!}</p>
                <div class="flex mt-10">
                    
                        @livewire('button', ['product' => $product])
                  
                    @if (auth()->check())
                        @php
                            $favorites = \App\Models\Favorite::where('user', auth()->id())
                                ->where('product', $product->id)
                                ->first();
                        @endphp
                        <form action="{{ route('favorites', ['product' => $product->id]) }}" method="POST">
                            @csrf
                            <button class="group flex justify-center items-center ml-4 p-3 rounded-md hover:bg-gray-100">
                                @if ($favorites)
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 text-red-600 group-hover:text-red-700">
                                        <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"></path>
                                    </svg>
                                @else
                                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 text-gray-400 group-hover:text-gray-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"></path>
                                    </svg>
                                @endif
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            <div class="w-full max-w-2xl mt-24 mx-auto xl:col-span-4 xl:max-w-none xl:mt-0">
                <h2 class="text-2xl font-semibold text-gray-900">Opiniones de los usuarios</h2>
                <div class="mt-6 pb-10 space-y-10 border-gray-200 border-t-2 divide-y-2">
                    @if ($reviews->isEmpty())
                        <p class="mt-8 text-lg text-gray-700">Se la primera persona en dar su opinión sobre este producto.</p>
                    @else
                        @foreach ($reviews as $review)
                            <div class="pt-10 xl:grid xl:grid-cols-12 xl:gap-x-8">
                                <div class="xl:col-span-8 xl:col-start-5">
                                    <div class="flex items-center">
                                        <div class="flex items-center">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rating)
                                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 text-yellow-400">
                                                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"></path>
                                                    </svg>
                                                @else
                                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 text-gray-300">
                                                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"></path>
                                                    </svg>
                                                @endif
                                            @endfor
                                        </div>
                                        <p class="ml-3 text-lg font-medium text-gray-700">{{ $review->rating }}</p>
                                    </div>
                                    <div class="mt-4 xl:6 text-lg text-gray-700">{{ $review->comment }}</div>
                                </div>
                                <div class="flex items-center mt-6 xl:flex-col xl:items-start xl:col-span-4 xl:col-start-1 xl:row-start-1 xl:mt-0">
                                    <p class="text-lg font-semibold text-gray-900">{{ $review->firstName }}</p>
                                    <p class="ml-4 pl-4 border-gray-200 border-l-2 text-md font-semibold text-gray-700 xl:mt-2 xl:ml-0 xl:pl-0 xl:border-0">{{ \Carbon\Carbon::parse($review->created_at)->isoFormat('MMM DD, YYYY') }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="max-w-2xl mt-16 mx-auto xl:col-span-3 xl:max-w-none xl:mt-0">
                <h2 class="text-2xl font-semibold text-gray-900">Comparte tus pensamientos</h2>
                <p class="mt-1 text-lg text-gray-700">Si ha usado este producto, comparta sus opiniones con otros clientes.</p>
                @if (auth()->check())
                    <form action="{{ route('productOverview', ['name' => Str::slug(Str::lower($product->name))]) }}" method="POST">
                        @csrf
                        <div class="overflow-hidden mt-6 rounded-lg border-gray-300 border-2 shadow-sm focus-within:ring-2 focus-within:ring-indigo-600">
                            <div class="stars flex justify-end items-center py-3 px-2.5" dir="rtl">
                                <input type="radio" id="star5" class="sr-only" name="rating" value="5">
                                <label for="star5" class="cursor-pointer">
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
                                <input type="radio" id="star3" class="sr-only" name="rating" value="3">
                                <label for="star3" class="cursor-pointer">
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
                                <input type="radio" id="star1" class="sr-only" name="rating" value="1">
                                <label for="star1" class="cursor-pointer">
                                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 text-gray-300">
                                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"></path>
                                    </svg>
                                </label>
                            </div>
                            <label for="comment"></label>
                            <textarea id="comment" class="group block w-full h-40 py-0 text-lg leading-7 text-gray-900 border-0 resize-none focus:ring-0" name="comment" placeholder="Agrega tu comentario..."></textarea>
                            <div class="flex justify-end py-2 px-2 border-gray-200 border-t-2 md:px-3">
                                <x-button type="submit" class="inline-flex justify-center w-auto">
                                    {{ __('Publicar') }}
                                </x-button>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="flex mt-6 p-4 bg-blue-50 rounded-md">
                        <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 text-blue-400">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"></path>
                        </svg>
                        <p class="ml-3 text-lg text-blue-700">Para comentar debes <a href="{{ route('login') }}" class="font-semibold underline hover:text-blue-600">iniciar sesión</a> o <a href="{{ route('register') }}" class="font-semibold underline hover:text-blue-600">registrarse</a>.</p>
                        @php
                            session(['url.intended' => route('productOverview',$product->name)]);
                        @endphp
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop

@section('styles')
    <style>
        .stars input:hover ~ label svg,
        .stars input:checked ~ label svg {
            color: rgb(250, 204, 21);
        }

        .disabled-button {
            background-color: #ccc;
            color: #666;
        }

        .disabled-button:hover {
            background-color: #ccc;
        }
    </style>
@stop

@section('scripts')
    <script>
        $(document).ready(function() {
            const commentInput = $("#comment");
            const stars = $(".stars input");
            const submitButton = $("form button[type='submit']");

            function checkValidity() {
                const isCommentEmpty = commentInput.val().trim() === "";
                const isStarSelected = $(".stars input:checked").length > 0;


                submitButton.prop("disabled", isCommentEmpty || !isStarSelected);


                if (submitButton.prop("disabled")) {
                    submitButton.addClass("disabled-button");
                } else {
                    submitButton.removeClass("disabled-button");
                }
            }

            commentInput.on("input", checkValidity);

            stars.on("click", function() {
                $(".stars label").removeClass("selected");
                $(this).closest("label").addClass("selected");
                checkValidity();
            });

            checkValidity();
        });
    </script>
@stop
