<nav class="flex flex-col flex-1">
    <ul role="list">
        <li>
            <a href="{{ route('home') }}" class="group flex gap-x-3 p-2 text-lg font-semibold leading-7 text-gray-700 rounded-md hover:text-indigo-600 hover:bg-gray-50">
                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="shrink-0 w-7 h-7 text-gray-400 group-hover:text-indigo-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path>
                </svg>
                Inicio
            </a>
        </li>
        <li class="mt-1">
            <div x-data="{ open: false }">
                <button x-on:click="open =! open" class="group flex gap-x-3 w-full p-2 text-lg font-semibold leading-7 text-gray-700 rounded-md hover:text-indigo-600 hover:bg-gray-50">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="shrink-0 w-7 h-7 text-gray-400 group-hover:text-indigo-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"></path>
                    </svg>
                    Gestión de productos
                </button>
                <ul x-show="open" x-on:click.outside="open = false" x-transition.origin.top role="list" class="mt-1 px-2" style="display: none;">
                    <li>
                        <a href="{{ route('products.index') }}" class="block p-2 text-lg leading-7 text-gray-700 rounded-md hover:text-indigo-600 hover:bg-gray-50">Productos</a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}" class="block p-2 text-lg leading-7 text-gray-700 rounded-md hover:text-indigo-600 hover:bg-gray-50">Categorías</a>
                    </li>
                    <li>
                        <a href="{{ route('references.index') }}" class="block p-2 text-lg leading-7 text-gray-700 rounded-md hover:text-indigo-600 hover:bg-gray-50">Referencias</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="mt-1">
            <a href="{{ route('sales') }}" class="group flex gap-x-3 p-2 text-lg font-semibold leading-7 text-gray-700 hover:text-indigo-600 rounded-md hover:bg-gray-50">
                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="shrink-0 w-7 h-7 text-gray-400 group-hover:text-indigo-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"></path>
                </svg>
                Ventas
            </a>
        </li>
    </ul>
</nav>
