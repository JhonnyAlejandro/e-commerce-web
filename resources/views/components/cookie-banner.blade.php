<div x-data="{ banner: false }" x-init="setTimeout(() => { banner = true }, 400)" class="relative z-50">
    <div x-show="banner" x-transition.opacity.duration.300ms class="fixed inset-0 bg-gray-900/[0.8] opacity-100" style="display: none;"></div>
    <div x-show="banner" x-transition.origin.right.bottom class="fixed inset-0 flex items-end p-6" style="display: none;">
        <div class="w-full max-w-2xl ml-auto p-6 bg-white rounded-xl">
            <p class="text-lg font-semibold text-gray-900">Nuestro sitio web utiliza cookies</p>
            <p class="mt-1 text-lg text-gray-500">Almacenamos cookies necesarias en su dispositivo para mejorar y personalizar el contenido, la publicidad y analizar nuestro tráfico. Consulte nuestra <a href="" class="font-semibold text-indigo-600 hover:text-indigo-500">política de cookies</a>.</p>
            <div class="flex items-center gap-x-5 mt-5">
                <x-button class="inline-flex items-center w-auto">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path>
                    </svg>
                    Aceptar
                </x-button>
                <x-secondary-button x-on:click="banner = false" class="inline-flex items-center w-auto">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Rechazar
                </x-secondary-button>
            </div>
        </div>
    </div>
</div>
