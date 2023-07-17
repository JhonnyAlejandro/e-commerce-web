<div class=" flex mx-auto mb-5 p-4 bg-red-50 rounded-md">
    <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6 text-red-400">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z"></path>
    </svg>
    <div class="ml-3">
        <h3 class="text-lg font-semibold text-red-800">{{ $title }}</h3>
        <div class="mt-2 text-lg text-red-700">
            <ul role="list" class="pl-5 list-disc">
                {{ $slot }}
            </ul>
        </div>
    </div>
</div>
