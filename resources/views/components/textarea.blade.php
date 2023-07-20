@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block w-full h-52 text-lg text-gray-900 border-0 ring-2 ring-inset ring-gray-300 rounded-md focus:ring-2 focus:ring-inset focus:ring-indigo-600']) !!}>{{ $slot }}</textarea>
