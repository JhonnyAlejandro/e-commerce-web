<div x-data="{ alert: false }" x-init="setTimeout(() => { alert = true }, 400)" class="relative z-50">
    <div x-show="alert" x-transition.opacity.duration.300ms class="fixed inset-0 bg-gray-900/[0.8] opacity-100" style="display: none;"></div>
    <div x-show="alert" x-transition.origin.top.right class="fixed inset-0 flex items-end py-6 px-4 md:items-start md:p-6" style="display: none;">
        <div class="flex flex-col items-center w-full md:items-end">
            <div x-on:click.outside="alert = false" class="overflow-hidden w-full max-w-lg bg-white rounded-lg">
                <div class="flex items-start p-4">
                    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 text-green-400">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"></path>
                    </svg>
                    <p class="mx-3 text-lg font-semibold text-gray-900">{{ $slot }}</p>
                    <button x-on:click="alert = false" class="inline-flex ml-auto text-gray-400 hover:text-gray-500">
                        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
