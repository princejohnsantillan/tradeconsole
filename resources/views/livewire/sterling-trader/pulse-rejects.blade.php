<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                    <tr>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Client Order ID
                        </th>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Account
                        </th>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Symbol
                        </th>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Quantity
                        </th>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Side
                        </th>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Destination
                        </th>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Reject Reason
                        </th>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Text
                        </th>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Created At
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($rejects as $reject)
                        <tr>
                            <td class="px-4 py-2 text-left whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                {{ data_get($reject->message, 'data.bstrClOrderId') }}
                            </td>
                            <td class="px-4 py-2 text-left whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                {{ data_get($reject->message, 'data.bstrAccount') }}
                            </td>
                            <td class="px-4 py-2 text-left whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                {{ data_get($reject->message, 'data.bstrSymbol') }}
                            </td>
                            <td class="px-4 py-2 text-left whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                {{ data_get($reject->message, 'data.nQuantity') }}
                            </td>
                            <td class="px-4 py-2 text-left whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                {{ data_get($reject->message, 'data.bstrSide') }}
                            </td>
                            <td class="px-4 py-2 text-left whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                {{ data_get($reject->message, 'data.bstrDestination') }}
                            </td>
                            <td class="px-4 py-2 text-left whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                {{ data_get($reject->message, 'data.nRejectReason') }}
                            </td>
                            <td class="px-4 py-2 text-left whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                {{ data_get($reject->message, 'data.bstrText') }}
                            </td>
                            <td class="px-4 py-2 text-left whitespace-no-wrap text-sm leading-5 font-medium text-gray-500">
                                {{ $reject->created_at }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-4 py-2 text-center whitespace-no-wrap text-sm leading-5 font-medium text-gray-800">
                                No rejects found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
