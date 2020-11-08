<div class="space-y-4">
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Manually trigger an event
            </h3>
            <div class="mt-2 max-w-xl text-sm leading-5 text-gray-500">
                <p>
                    JSON string requires "event" and "data" fields
                </p>
            </div>
            <div class="mt-5 sm:flex flex-col sm:items-left">
                <div class="w-full lg:w-1/2 xl:w-1/3">
                    <label for="email" class="sr-only">Data</label>
                    <div class="relative rounded-md shadow-sm">
                        <textarea wire:model.lazy='data'
                            class="form-textarea block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            rows="5">
                        </textarea>
                    </div>
                </div>
                <span class="mt-4 w-full lg:w-1/2 flex items-center">
                    <select id="country" wire:model="trader"
                        class="block form-select w-1/2 md:w-1/2 xl:1/4 mr-2 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <option disabled selected>Choose a Trader</option>
                        @foreach ($connections as $trader => $key)
                        <option value="{{ $trader }}">{{ $trader }}</option>
                        @endforeach
                    </select>

                    <button type="button" wire:click="sendData"
                        class="px-4 py-2 border border-transparent font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150 sm:w-auto sm:text-sm sm:leading-5">
                        Send Data
                    </button>
                </span>
            </div>
        </div>
    </div>

    <div class="pb-5 border-b border-gray-200 space-y-3 sm:space-y-4 sm:pb-0">
        <div>
            <!-- Dropdown menu on small screens -->
            <div class="sm:hidden">
                <select aria-label="Selected tab"
                    class="form-select block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5 transition ease-in-out duration-150">
                    <option wire:click="switchTab('messages')" {{ $tab === 'messages' ? 'selected' : '' }}>Messages
                    </option>

                    <option wire:click="switchTab('errors')" {{ $tab === 'errors' ? 'selected' : '' }}>Errors</option>
                </select>
            </div>
            <!-- Tabs at small breakpoint and up -->
            <div class="hidden sm:block">
                <nav class="-mb-px flex space-x-8">
                    <button wire:click="switchTab('messages')"
                        class="whitespace-no-wrap pb-4 px-1 border-b-2 font-medium text-sm leading-5 focus:outline-none {{ $tab === 'messages' ? 'border-indigo-500 text-indigo-600 focus:text-indigo-800 focus:border-indigo-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:text-gray-700 focus:border-gray-300' }}">
                        Messages
                    </button>

                    <button wire:click="switchTab('errors')"
                        class="whitespace-no-wrap pb-4 px-1 border-b-2 font-medium text-sm leading-5 focus:outline-none {{ $tab === 'errors' ? 'border-indigo-500 text-indigo-600 focus:text-indigo-800 focus:border-indigo-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:text-gray-700 focus:border-gray-300' }}">
                        Errors
                    </button>
                </nav>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    @if ($tab === 'messages')
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Adapter Version
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Trader
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Event
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Created At
                                </th>
                                <th class="px-6 py-3 bg-gray-50"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($messages as $message)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                    {{ $message->adapter_version }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                    {{ $message->trader_id }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                    {{ $message->getFromMessage('event') }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                    {{ $message->created_at }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Details</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">No messages found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if($messages instanceof \Illuminate\Contracts\Pagination\Paginator)
                    <div class="m-2">
                        {{ $messages->links() }}
                    </div>
                    @endif
                    @elseif($tab === 'errors')
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Socket ID
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Class
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Code
                                </th>
                                <th
                                    class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Created At
                                </th>
                                <th class="px-6 py-3 bg-gray-50"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($websocketErrors as $websocketError)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                    {{ $websocketError->socket_id }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                    {{ $websocketError->class }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                    {{ $websocketError->code }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                    {{ $websocketError->created_at }}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Details</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">No errors found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if($messages instanceof \Illuminate\Contracts\Pagination\Paginator)
                    <div class="m-2">
                        {{ $websocketErrors->links() }}
                    </div>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>