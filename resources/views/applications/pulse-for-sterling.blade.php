<x-app-layout>
    <div class="py-8 space-y-4">
        <div class="max-w-4xl  px-4 sm:px-6 lg:px-8">
            @livewire('sterling-trader.activate-adapter')
        </div>

        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mt-10 mb-2 pb-2 border-b border-gray-200">
                <h3 class="text-lg leading-4 font-medium text-gray-900">
                    Copy Trading Instructions
                </h3>
            </div>
            @livewire('sterling-trader.pulse-instructions')
        </div>


        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mt-10 mb-2 pb-2 border-b border-gray-200">
                <h3 class="text-lg leading-4 font-medium text-gray-900">
                    Position Syncing Settings
                </h3>
            </div>
            <div class="lg:grid lg:grid-cols-10 lg:gap-2 space-y-4 lg:space-y-0">
                <div class="lg:col-span-5 space-y-4">
                    @livewire('sterling-trader.pulse-sync-settings')
                    {{-- @livewire('sterling-trader.pulse-positions') --}}
                </div>
                <div class="lg:col-span-5">
                    @livewire('sterling-trader.pulse-sync-map')
                </div>
            </div>
        </div>

        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mt-10 mb-2 pb-2 border-b border-gray-200">
                <h3 class="text-lg leading-4 font-medium text-gray-900">
                    Sterling Trader Rejects
                </h3>
            </div>
            @livewire('sterling-trader.pulse-rejects')
        </div>
    </div>
</x-app-layout>
