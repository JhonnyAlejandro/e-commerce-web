<x-modal>
    <div class="py-3 px-4 md:p-6">
        <form action="{{ route('references.destroy', $reference->id) }}" method="POST">
            @method('DELETE')
            @csrf
            <div>
                <div class="flex justify-center items-center w-16 h-16 mx-auto bg-red-100 rounded-full">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-6 h-6 text-red-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"></path>
                    </svg>
                </div>
                <div class="mt-5 text-center">
                    <h3 class="text-xl font-bold">Eliminar referencia</h3>
                    <p class="mt-4 text-lg text-gray-500">¿Está seguro de que desea eliminar la referencia? Todos los datos serán eliminados permanentemente de la base de datos. Esta acción no se puede deshacer.</p>
                </div>
            </div>
            <div class="mt-5 md:grid md:grid-cols-2 md:grid-flow-row-dense md:gap-3 md:mt-6">
                <x-danger-button type="submit" class="inline-flex justify-center w-full md:col-start-2">
                    {{ __('Eliminar categoría') }}
                </x-danger-button>
                <x-secondary-button x-on:click="modal = false" type="button" class="inline-flex justify-center w-full mt-3 md:mt-0">
                    {{ __('Cancelar') }}
                </x-secondary-button>
            </div>
        </form>
    </div>
</x-modal>
