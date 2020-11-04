<x-app-layout>
    <div class="py-8">
        <div class="max-w-full  px-4 sm:px-6 lg:px-8 space-y-5">

            <div class="pb-5 border-b border-gray-200 space-y-3 sm:space-y-4 sm:pb-0">
                <div>
                    <!-- Dropdown menu on small screens -->
                    <div class="sm:hidden">
                        <select aria-label="Selected tab" class="form-select block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5 transition ease-in-out duration-150">
                            <option selected>Messages</option>

                            <option>Errors</option>
                        </select>
                    </div>
                    <!-- Tabs at small breakpoint and up -->
                    <div class="hidden sm:block">
                        <nav class="-mb-px flex space-x-8">
                            <a href="#messages" class="whitespace-no-wrap pb-4 px-1 border-b-2 border-indigo-500 font-medium text-sm leading-5 text-indigo-600 focus:outline-none focus:text-indigo-800 focus:border-indigo-700" aria-current="page">
                                Messages
                            </a>

                            <a href="#errors" class="whitespace-no-wrap pb-4 px-1 border-b-2 border-transparent font-medium text-sm leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">
                                Errors
                            </a>
                        </nav>
                    </div>
                </div>
            </div>

            @livewire('sterling-trader.messages-table')

            @livewire('sterling-trader.websocket-errors-table')
        </div>
    </div>
</x-app-layout>
