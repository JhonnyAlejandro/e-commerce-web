<button {{ $attributes->merge(['class' => 'py-2 px-3 text-lg font-semibold text-white bg-red-600 rounded-md hover:bg-red-500']) }}>
    {{ $slot }}
</button>
