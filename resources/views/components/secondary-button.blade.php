<button {{ $attributes->merge(['class' => 'py-2 px-3 text-lg font-semibold text-gray-900 ring-2 ring-inset ring-gray-300 rounded-md hover:bg-gray-50']) }}>
    {{ $slot }}
</button>
