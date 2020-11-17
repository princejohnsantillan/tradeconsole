<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                    <tr>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Symbol
                        </th>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Source Account
                        </th>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Source Position
                        </th>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Target Account
                        </th>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Target Position
                        </th>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Weight
                        </th>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
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
                                <td class="px-2 py-3 text-left whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                    {{ $position['Symbol'] }}
                                </td>
                                <td class="px-2 py-3 text-left whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                    {{ $position['SourceAccount'] }}
                                </td>
                                <td class="px-2 py-3 text-left whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                    {{ $position['SourcePosition'] }}
                                </td>
                                <td class="px-2 py-3 text-left whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                    {{ $position['TargetAccount'] }}
                                </td>
                                <td class="px-2 py-3 text-left whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                    {{ $position['TargetPosition'] }}
                                </td>
                                <td class="px-2 py-3 text-left whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                    {{ $position['Weight'] }}
                                </td>
                                <td class="px-2 py-3 text-left whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                    {{ $position['Discrepancy'] }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-2 py-3 text-center whitespace-no-wrap text-sm leading-5 font-medium text-gray-800">
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
