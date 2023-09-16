@extends('dashboard')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>

                <x-section-border />
            @endif


            <div class="mt-10 sm:mt-0">
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-danger-button class="" wire:click="deleteUser" wire:loading.attr="disabled">
                        {{ __('Cerrar sesión') }}
                    </x-danger-button>

                </form>
            </div>
            <x-section-border />
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var phoneInput = document.getElementById("phone");
            phoneInput.type = "number";
        });
    </script>
@endsection
