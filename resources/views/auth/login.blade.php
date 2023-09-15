<x-guest-layout>

        <div class="bg-white dark:bg-gray-900">
            
            <div class="flex justify-center h-screen">
                
                <div class="hidden bg-cover lg:block lg:w-2/3" style="background-image: url(https://img.freepik.com/foto-gratis/ninos-jugando-sobre-cesped_1098-504.jpg?w=1380&t=st=1694789535~exp=1694790135~hmac=ecd98f2e90fc274be0d060c81f8be49926780b115a6d98601acd2daad95652c2)">
                    <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
                        <div>
                            <h2 class=" font-bold text-white text-6xl">Estacion Arcoiris Kids</h2>

                            <p class=" max-w-full mt-3 text-gray-200 text-3xl">
                            "Inflables y juegos: ¡la receta perfecta para la diversión!"
                            </p>
                        </div>
                    </div>
                </div>
                   
               
                    
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
                    <div class=" mt-8">
                    
                    </div>
                
                    <div class="flex-1">
                        <div class="text-center">
                        <x-validation-errors />
                                <div class="flex justify-center items-center ">
                                     <img src="{{ asset('images/logo.png') }}" width="350px">
                                </div>

                            <p class="mt-3 text-gray-500 dark:text-gray-300">Ingresa en tu cuenta</p>
                        </div>

                        <div class="mt-8">
                            <form  method="POST" action="{{ route('login') }}">
                                @csrf
                                <div>
                                    <x-label for="email" value="{{ __('Correo') }}" class="hidden mb-2 text-sm text-gray-600 dark:text-gray-200" />
                                    <x-input id="email" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                </div>

                                <div class="mt-6">
                                    <div class="flex justify-between mb-2">
                                        <x-label for="password" value="{{ __('Contraseña') }}" class="text-sm text-gray-600 dark:text-gray-200"/>
                                    </div>
                                    <x-input id="password" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-lg dark:placeholder-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 focus:border-blue-400 dark:focus:border-blue-400 focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" type="password" name="password" required autocomplete="current-password" />
                                </div>

                                <div class="mt-6">
                                    <label for="remember_me" class="flex items-center">
                                        <x-checkbox id="remember_me" name="remember" />
                                        <span class="ml-2 text-sm text-gray-600">{{ __('Recuérdame') }}</span>
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                        {{ __('¿Olvidaste tu contraseña?') }}
                                    </a>
                                @endif

                                <x-button class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:bg-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                    {{ __('Iniciar sesión') }}
                                 </x-button>
                            </form>
                            <p class="mt-6 text-sm text-center text-gray-400">No tienes una cuenta aun? <a href="{{route('register')}}" class="text-blue-500 focus:outline-none focus:underline hover:underline">Registrarse</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-guest-layout>