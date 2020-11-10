<div class="space-y-4">
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <!-- Heroicon name: exclamation -->
                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm leading-5 text-yellow-700">
                    Temporarily disabled. This feature is currently being worked on.
                </p>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Account
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Symbol
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Postion
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Real
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($positions as $position)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                            {{ $position['Account'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                {{ $position['Symbol'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                {{ $position['Real'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $position['Position'] === 0 ? 'bg-gray-100 text-gray-800' : $position['Position'] > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $position['Position'] }}
                                </span>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
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
</div>
