<x-modal>
    <div class="p-6 border-gray-200 border-b-2">
        <h3 class="text-2xl font-semibold leading-7 text-center md:text-left">Agregar una nueva referencia</h3>
    </div>
    <form action="{{ route('references.update', $reference->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="py-5 px-6">
            @if ($errors->any())
                <x-alert>
                    <x-slot name="title">Se {{ $errors->count() > 1 ? 'encontraron' : 'encontró' }} {{ $errors->count() }} {{ $errors->count() > 1 ? 'errores' : 'error' }}:</x-slot>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </x-alert>
            @endif
            <div class="grid grid-cols-1 gap-x-6 gap-y-8 md:grid-cols-6">
                <div class="md:col-span-full">
                    <x-label for="create-name" value="{{ __('Nombre') }}" />
                    <x-input id="create-name" class="block mt-1 w-full" type="text" name="name" value="{{ $reference->name }}" required />
                </div>
            </div>
        </div>
        <div class="py-3 px-4 bg-gray-50 md:flex md:flex-row-reverse md:px-6">
            <x-button type="submit" class="inline-flex justify-center w-full md:w-auto md:ml-3">
                {{ __('Agregar referencia') }}
            </x-button>
            <x-secondary-button x-on:click="modal = false" type="button" class="inline-flex justify-center w-full mt-3 md:w-auto md:mt-0">
                {{ __('Cancelar') }}
            </x-secondary-button>
        </div>
    </form>
</x-modal>
