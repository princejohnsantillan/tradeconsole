@if($show)
    <tr>
        <td class="py-2 px-1 whitespace-no-wrap text-sm leading-5 text-gray-500">
            <div class="flex items-center h-5 justify-center">
                <input wire:model="activated" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
            </div>
        </td>
        <td class="py-2 px-1 whitespace-no-wrap text-sm leading-5 text-gray-500">
            <div class="mt-1 sm:mt-0 sm:col-span-2">
                <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                <select wire:model="event" class="block form-select w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    <option value="">Choose an Event</option>
                    <option value='OrderUpdate'>On Order</option>
                    <option value='TradeUpdate'>On Trade</option>
                </select>
                </div>
            </div>
        </td>
        <td class="py-2 px-1 whitespace-no-wrap text-sm leading-5 text-gray-500">
            <div class="mt-1 sm:mt-0 sm:col-span-2">
                <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                <input wire:model.lazy="excludedSymbols" type="text" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                </div>
            </div>
        </td>
        <td class="py-2 px-1 whitespace-no-wrap text-sm leading-5 text-gray-500">
            <div class="mt-1 sm:mt-0 sm:col-span-2">
                <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                <input wire:model.lazy="sourceAccount" type="text" required class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                </div>
            </div>
        </td>
        <td class="py-2 px-1 whitespace-no-wrap text-sm leading-5 text-gray-500">
            <div class="mt-1 sm:mt-0 sm:col-span-2">
                <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                <input wire:model.lazy="targetAccount" type="text" required class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" >
                </div>
            </div>
        </td>
        <td class="py-2 px-1 whitespace-no-wrap text-sm leading-5 text-gray-500">
            <div class="mt-1 sm:mt-0 sm:col-span-2">
                <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                <select wire:model="side" class="block form-select w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    <option value="copy">Copy</option>
                    <option value="reverse">Reverse</option>
                </select>
                </div>
            </div>
        </td>
        <td class="py-2 px-1 whitespace-no-wrap text-sm leading-5 text-gray-500">
            <div class="mt-1 sm:mt-0 sm:col-span-2">
                <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                <input wire:model.lazy="quantity" type="number" step=".01" min="0" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                </div>
            </div>
        </td>
        <td class="py-2 px-1 whitespace-no-wrap text-sm leading-5 text-gray-500">
            <div class="mt-1 sm:mt-0 sm:col-span-2">
                <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                <select wire:model="priceType" class="block form-select w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    <option value='copy'>Copy</option>
                    <option value='market'>Market</option>
                    <option value='limit'>Limit</option>                    
                </select>
                </div>
            </div>
        </td>
        <td class="py-2 px-1 whitespace-no-wrap text-sm leading-5 text-gray-500">
            <div class="mt-1 sm:mt-0 sm:col-span-2">
                <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                <input wire:model.lazy="priceShift" type="number" step=".01" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" >
                </div>
            </div>
        </td>
        <td class="py-2 px-1 whitespace-no-wrap text-sm leading-5 text-gray-500">
            <div class="mt-1 sm:mt-0 sm:col-span-2">
                <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                <input wire:model.lazy="timeInForce" type="text" required class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                </div>
            </div>
        </td>
        <td class="py-2 px-1 whitespace-no-wrap text-sm leading-5 text-gray-500">
            <div class="mt-1 sm:mt-0 sm:col-span-2">
                <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                <input wire:model.lazy="destination" type="text" required class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                </div>
            </div>
        </td>
        <td class="py-2 px-2 whitespace-no-wrap text-center text-sm leading-5 font-medium ">
            <svg wire:loading class="animate-spin mt-2 mb-1 h-4 w-4  text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <button wire:loading.remove wire:click='removeInstruction' class="text-indigo-600 hover:text-indigo-900">Remove</button>
        </td>
    </tr>
@endif
