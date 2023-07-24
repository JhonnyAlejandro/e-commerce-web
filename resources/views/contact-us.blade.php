@extends('layouts.layout')

@section('content')
    <div class="relative isolate">
        <div class="grid grid-cols-1 max-w-7xl mx-auto xl:grid-cols-2">
            <div class="relative pt-32 px-6 pb-20 xl:static xl:py-48 xl:px-8">
                <div class="max-w-xl mx-auto xl:max-w-lg xl:mx-0">
                    <div class="absolute inset-y-0 left-0 -z-10 overflow-hidden w-full bg-gray-100 border-gray-900/[0.1] border-r-2 xl:w-1/2"></div>
                    <h2 class="text-4xl font-semibold text-gray-900">Contactanos</h2>
                    <p class="mt-6 text-xl text-gray-700">
                        Vive la experiencia de las atracciones infantiles más increíbles de Colombia. Escribenos y estaremos complacidos en atender todas tus inquietudes.
                    </p>
                    <dl class="space-y-6 mt-10 text-lg text-gray-700">
                        <div class="flex gap-x-4">
                            <dt class="flex-none">
                                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z"></path>
                                </svg>
                            </dt>
                            <dd>
                                Cra 29 #5a - 28
                                <br>
                                Palmira, Valle del Cauca
                            </dd>
                        </div>
                        <div class="flex gap-x-4">
                            <dt class="flex-none">
                                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"></path>
                                </svg>
                            </dt>
                            <dd>
                                <a href="https://wa.me/3177908872" target="_blank" class="hover:text-gray-900">+57 317 7908872</a>
                            </dd>
                        </div>
                        <div class="flex gap-x-4">
                            <dt class="flex-none">
                                <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"></path>
                                </svg>
                            </dt>
                            <dd>
                                <a href="mailto:erika.cuaran@correounivalle.edu.co" class="hover:text-gray-900">erika.cuaran@correounivalle.edu.co</a>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
            <form action="" class="pt-20 px-6 pb-24 md:pb-32 xl:py-48 xl:px-8">
                <div class="max-w-xl mx-auto xl:max-w-lg xl:mr-0">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-6 md:grid-cols-2">
                        <div>
                            <x-label for="first_name" value="{{ __('Nombre') }}" />
                            <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" required />
                        </div>
                        <div>
                            <x-label for="last_name" value="{{ __('Apellido') }}" />
                            <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" required />
                        </div>
                        <div class="md:col-span-2">
                            <x-label for="email" value="{{ __('Correo electrónico') }}" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" required />
                        </div>
                        <div class="md:col-span-2">
                            <x-label for="phone" value="{{ __('Número de teléfono') }}" />
                            <x-input id="phone" class="block mt-1 w-full" type="email" name="phone" required />
                        </div>
                        <div class="md:col-span-2">
                            <x-label for="message" value="{{ __('Mensaje') }}" />
                            <x-textarea id="message" class="block mt-1 w-full" name="message" required />
                        </div>
                    </div>
                    <div class="flex justify-end mt-8">
                        <x-button type="submit" class="py-3 px-4">
                            {{ __('Enviar mensaje') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
