<div x-show="modal" class="relative z-50" style="display: none;">
    <div x-show="modal" x-transition.opacity.duration.300ms class="fixed inset-0 bg-gray-900/[0.8] opacity-100"></div>
    <div class="fixed z-50 overflow-y-auto inset-0">
        <div class="flex justify-center p-4 items-start">
            <div x-show="modal" x-on:click.outside="modal = false" x-transition.origin.top class="relative overflow-hidden w-full max-w-5xl bg-white rounded-lg md:my-8">
                <div class="bg-white">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
