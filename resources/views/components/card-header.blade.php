<div x-data="{ modal: false }" class="sm:flex sm:justify-between sm:items-center">
    <h3 class="text-2xl font-semibold leading-7">{{ $slot }}</h3>
    <x-button x-on:click="modal =! modal" type="button" class="relative inline-flex items-center gap-x-2 mt-4 sm:mt-0">
        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
        </svg>
        {{ $button }}
    </x-button>
    <template x-teleport="body">
        {{ $modal }}
    </template>
</div>
