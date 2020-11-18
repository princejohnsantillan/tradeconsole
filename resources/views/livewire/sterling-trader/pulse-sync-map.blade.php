<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                    <tr>
                        <th wire:click="sortPosition('Symbol')" class="cursor-pointer p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Symbol
                        </th>
                        <th wire:click="sortPosition('SourceAccount')" class="cursor-pointer p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Source Account
                        </th>
                        <th wire:click="sortPosition('SourcePosition')" class="cursor-pointer p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Source Position
                        </th>
                        <th wire:click="sortPosition('TargetAccount')" class="cursor-pointer p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Target Account
                        </th>
                        <th wire:click="sortPosition('TargetPosition')" class="cursor-pointer p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Target Position
                        </th>
                        <th wire:click="sortPosition('Weight')" class="cursor-pointer p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Weight
                        </th>
                        <th wire:click="sortPosition('Discrepancy')" class="cursor-pointer p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Discrepancy
                            <span class="inline-flex rounded-md shadow-sm ml-2">
                                <button wire:click='alignPositions' type="button" class="inline-flex items-center px-2 py-1 border border-transparent text-xs leading-2 font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-700 transition ease-in-out duration-150">
                                    Align
                                </button>
                              </span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($positionMap as $position)
                            <tr>
                                <td class="px-4 py-2 text-left whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                    {{ $position['Symbol'] }}
                                </td>
                                <td class="px-4 py-2 text-left whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                    {{ $position['SourceAccount'] }}
                                </td>
                                <td class="px-4 py-2 text-right whitespace-no-wrap text-sm leading-5 font-medium">
                                    <span class="{{ $position['SourcePosition'] === 0 ? 'text-gray-500' : ($position['SourcePosition'] > 0 ? 'text-green-800' : 'text-red-800') }}">
                                        {{ $position['SourcePosition'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 text-left whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                    {{ $position['TargetAccount'] }}
                                </td>
                                <td class="px-4 py-2 text-right whitespace-no-wrap text-sm leading-5 font-medium">
                                    <span class="{{ $position['TargetPosition'] === 0 ? 'text-gray-500' : ($position['TargetPosition'] > 0 ? 'text-green-800' : 'text-red-800') }}">
                                        {{ $position['TargetPosition'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 text-left whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                    {{ $position['Weight'] }}
                                </td>
                                <td class="px-4 py-2 text-right whitespace-no-wrap text-sm leading-5 font-medium">
                                    <span class="{{ $position['Discrepancy'] === 0 ? 'text-gray-500' : ($position['Discrepancy'] > 0 ? 'text-green-800' : 'text-red-800') }}">
                                        {{ $position['Discrepancy'] }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-2 text-center whitespace-no-wrap text-sm leading-5 font-medium text-gray-800">
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
