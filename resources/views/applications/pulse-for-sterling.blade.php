<x-app-layout>
    <div class="py-8 space-y-4">
        <div class="max-w-4xl  px-4 sm:px-6 lg:px-8">
            @livewire('sterling-trader.activate-adapter')
        </div>

        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            @livewire('sterling-trader.pulse-instructions')
        </div>


        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-10 gap-2">
                <div class="col-span-4 space-y-4">
                    @livewire('sterling-trader.pulse-sync-configs')
                    @livewire('sterling-trader.pulse-positions')
                </div>
                <div class="col-span-6">
                    @livewire('sterling-trader.pulse-sync-map')
                </div>
            </div>
        </div>


    </div>
</x-app-layout>
