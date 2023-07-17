<button {{ $attributes->merge(['class' => 'py-2 px-3 text-lg font-semibold text-white bg-indigo-600 rounded-md hover:bg-indigo-500']) }}>
    {{ $slot }}
</button>
