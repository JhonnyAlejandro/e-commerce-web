<div class="p-6 text-center">
    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-12 h-12 mx-auto text-gray-400">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    <h3 class="mt-2 text-lg font-bold text-gray-900">No hay registros</h3>
    <p class="mt-1 text-lg text-gray-500">Comience por crear una nuevo registro.</p>
    <div x-data="{ modal: false }" class="mt-6">
        <x-button x-on:click="modal =! modal" type="button" class="inline-flex items-center">
            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6 mr-1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
            </svg>
            {{ __('Agregar') }}
        </x-button>
        <template x-teleport="body">
            {{ $modal }}
        </template>
    </div>
</div>
