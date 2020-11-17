<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                    <tr>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Source Account
                        </th>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Target Account
                        </th>
                        <th class="p-2 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Weight
                        </th>
                        <th class="p-2 bg-gray-50 text-center ">
                            <span class="inline-flex rounded-md shadow-sm">
                                <button wire:click='addSetting' type="button" class="inline-flex items-center px-2 py-1 border border-transparent text-xs leading-2 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                                    Add
                                </button>
                              </span>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($settings as $setting)
                            @livewire('sterling-trader.pulse-sync-setting-row', ['setting' => $setting], key($setting->id))
                        @empty
                        <tr>
                            <td colspan="4" class="px-2 py-3 text-center whitespace-no-wrap text-sm leading-5 font-medium text-gray-800">
                                No sync setting found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>