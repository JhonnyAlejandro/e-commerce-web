<x-guest-layout>
  <section class="border-red-500 bg-gray-200 min-h-screen flex items-center justify-center">
     

      @if (session('status'))
          <div class="mb-4 font-medium text-sm text-green-600">
              {{ session('status') }}
          </div>
      @endif
      <div class="bg-gray-100 p-5 flex rounded-2xl shadow-lg max-w-3xl">
        <div class="md:w-1/2 px-5">
          <a href="{{route('home')}}">
            <img src="{{asset('images/logo.png')}}" width="100px" class="hover:scale-110">
          </a>
          

          <p class="text-sm mt-4 text-[#002D74]">Ingresa a tu cuenta</p>
          <form class="mt-6" method="POST" action="{{ route('login') }}">
              @csrf
            <div>
              <x-label for="email" value="{{ __('Correo') }}" />
              <x-input id="email" class="block  w-full px-4 py-3 rounded-lg bg-gray-200 mt-2  focus:border-indigo-700" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>
  
            <div class="mt-4">
              <x-label for="password" value="{{ __('Contraseña') }}" />
              <x-input id="password" class="block mt-1 w-full rounded-lg bg-gray-200 mt-2  focus:border-indigo-700" type="password" name="password" required autocomplete="current-password" />
            </div>
  
            <div class="text-right mt-2">
              @if (Route::has('password.request'))
              <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                  {{ __('¿Olvidaste tu contraseña?') }}
              </a>
          @endif
            </div>

            <div class=" mt-2">
              <label for="remember_me" class="flex items-center">
                  <x-checkbox id="remember_me" name="remember" />
                  <span class="ml-2 text-sm text-gray-600">{{ __('Recuérdame') }}</span>
              </label>
          </div>
  
            <button type="submit" class="w-full block bg-indigo-600 hover:bg-indigo-500 focus:bg-indigo-800 text-white font-semibold rounded-lg
                  px-4 py-3 mt-6">Ingresar</button>
          </form>
  
          <x-validation-errors class="m-4" />
  
  
          <div class="text-sm flex justify-between items-center mt-3">
            <p>Si no tienes una cuenta...</p>
            <button class="py-2 px-5 ml-3 bg-white border rounded-xl hover:scale-110 duration-300 border-indigo-700  "> <a href="{{route('register')}}">Registrarse</a> </button>
          </div>
        </div>
  
        <div class=" w-2/2 md:block hidden ">
          <img src="https://st4.depositphotos.com/1023249/23696/i/600/depositphotos_236966598-stock-photo-kids-having-fun-trampolines.jpg" class="rounded-2xl" alt="page img">
        </div>
  
      </div>
    </section>
</x-guest-layout>