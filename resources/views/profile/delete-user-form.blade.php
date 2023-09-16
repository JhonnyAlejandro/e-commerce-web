<x-action-section>
    <x-slot name="title">
        {{ __('Borrar cuenta') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Borra tu cuenta de forma permanente.') }}
    </x-slot>

    <x-slot name="content">
        <div x-data="{ modal: false }">
            <div class="max-w-xl text-sm text-gray-600">
                {{ __('Una vez que se elimine su cuenta, todos sus recursos y datos se eliminarán de forma permanente. Antes de eliminar su cuenta, descargue cualquier dato o información que desee conservar.') }}
            </div>

            <x-danger-button x-on:click="modal =! modal" type="submit" wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Borrar cuenta') }}
            </x-danger-button>

            <x-dialog-modal >
                <div show="modal">
                    <x-slot name="title">
                        {{ __('Borrar cuenta') }}
                    </x-slot>

                    <x-slot name="content">
                        {{ __('¿Está seguro de que desea eliminar su cuenta? Una vez que borre su cuenta, se pondrá inhabilitada y deberás iniciar sesión para verificar el correo electrónico. Ingrese su contraseña para confirmar que desea eliminar su cuenta de forma permanente.') }}

                        <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                            <x-input type="password" class="mt-1 block w-3/4"
                                        autocomplete="current-password"
                                        placeholder="{{ __('Contraseña') }}"
                                        x-ref="password"
                                        wire:model.defer="password"
                                        wire:keydown.enter="deleteUser" />

                            <x-input-error for="password" class="mt-2" />
                        </div>
                    </x-slot>

                    <x-slot name="footer">
                        <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" @click="modal =! modal" wire:loading.attr="disabled">
                            {{ __('Cancelar') }}
                        </x-secondary-button>

                        <x-danger-button class="ml-3" wire:click="deleteUser" wire:loading.attr="disabled">
                            {{ __('Borrar cuenta') }}
                        </x-danger-button>
                    </x-slot>
                </div>
            </x-dialog-modal>
        </div>
    </x-slot>
</x-action-section>
