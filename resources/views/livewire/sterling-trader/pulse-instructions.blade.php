<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead>
              <tr>
                <th class="p-2 bg-gray-50">
                </th>
                <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Event
                </th>
                <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Excluded Symbols
                </th>
                <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Source Account
                </th>
                <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Target Account
                </th>
                <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Side
                </th>
                <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Quantity
                </th>
                <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Price Mode
                </th>
                <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Price Shift
                </th>
                <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Destination
                </th>
                <th class="p-2 bg-gray-50 text-center ">
                    <span class="inline-flex rounded-md shadow-sm">
                        <button wire:click='addInstruction' type="button" class="inline-flex items-center px-2 py-1 border border-transparent text-xs leading-2 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                          Add
                        </button>
                      </span>
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($instructions as $instruction)
                    @livewire('sterling-trader.pulse-instruction-row',['instruction' => $instruction], key($instruction->id))
                @empty
                  <tr>
                    <td colspan='11' class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                        No instructions found
                    </td>
                  </tr>
                @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
