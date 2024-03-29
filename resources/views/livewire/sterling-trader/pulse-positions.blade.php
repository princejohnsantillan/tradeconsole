<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                    <tr>
                        <th wire:click="sortPosition('Account')" class="cursor-pointer p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Account
                        </th>
                        <th wire:click="sortPosition('Symbol')" class="cursor-pointer p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Symbol
                        </th>
                        <th wire:click="sortPosition('Position')" class="cursor-pointer p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Postion
                        </th>
                        <th wire:click="sortPosition('Real')" class="cursor-pointer p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Real
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($positions as $position)
                            <tr>
                                <td class="px-4 py-2 text-left whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                    {{ $position['Account'] }}
                                </td>
                                <td class="px-4 py-2 text-left whitespace-no-wrap text-sm leading-5 text-gray-500">
                                    {{ $position['Symbol'] }}
                                </td>
                                <td class="px-4 py-2 text-right whitespace-no-wrap text-sm leading-5 ">
                                    <span class="{{ $position['Position'] === 0 ? 'text-gray-500' : ($position['Position'] > 0 ? 'text-green-800' : 'text-red-800') }}">
                                        {{ $position['Position'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 text-right whitespace-no-wrap text-sm leading-5 ">
                                    <span class="{{ $position['Real'] === 0 ? 'text-gray-500' : ($position['Real'] > 0 ? 'text-green-800' : 'text-red-800') }}">
                                        {{ number_format($position['Real'],4) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center whitespace-no-wrap text-sm leading-5 font-medium text-gray-800">
                                No positions found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
