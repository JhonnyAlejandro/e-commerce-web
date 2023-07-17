<x-app-layout>
    <x-slot name="sidebar">
        <x-sidebar-navigation />
    </x-slot>

    <div class="px-4 md:px-6 xl:px-8">
        @yield('content')
    </div>
</x-app-layout>
