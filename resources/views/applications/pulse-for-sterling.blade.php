<x-app-layout>
    <div class="py-8 space-y-4">
        <div class="max-w-4xl  px-4 sm:px-6 lg:px-8">
            @livewire('sterling-trader.activate-adapter')
        </div>

        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            @livewire('sterling-trader.pulse-instructions')
        </div>

        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            @livewire('sterling-trader.pulse-positions')
        </div>
    </div>
</x-app-layout>
