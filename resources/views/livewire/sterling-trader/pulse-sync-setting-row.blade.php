@if($show)
    <tr>
        <td class="py-2 px-1 whitespace-no-wrap text-sm leading-5 text-gray-500">
            <div class="mt-1 sm:mt-0 sm:col-span-2">
                <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                <input wire:model.lazy="source" type="text" required class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                </div>
            </div>
        </td>
        <td class="py-2 px-1 whitespace-no-wrap text-sm leading-5 text-gray-500">
            <div class="mt-1 sm:mt-0 sm:col-span-2">
                <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                <input wire:model.lazy="target" type="text" required class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" >
                </div>
            </div>
        </td>
        <td class="py-2 px-1 whitespace-no-wrap text-sm leading-5 text-gray-500">
            <div class="mt-1 sm:mt-0 sm:col-span-2">
                <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                <input wire:model.lazy="weight" type="number" step=".01" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                </div>
            </div>
        </td>
        <td class="px-2 py-2 whitespace-no-wrap text-center text-sm leading-5 font-medium ">
            <svg wire:loading class="animate-spin mt-2 mb-1 h-4 w-4  text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <button wire:loading.remove wire:click='removeSetting' class="text-indigo-600 hover:text-indigo-900">Remove</button>
        </td>
    </tr>
@endif
