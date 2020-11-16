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
              <input wire:model.lazy="sourceAccount" type="text" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
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
              <input wire:model.lazy="account" type="text" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" >
            </div>
        </div>
    </td>
    <td class="py-2 px-1 whitespace-no-wrap text-sm leading-5 text-gray-500">
        <div class="mt-1 sm:mt-0 sm:col-span-2">
            <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
              <select wire:model="side" class="block form-select w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                <option value="same">Same Side</option>
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
              <select wire:model="priceMode" class="block form-select w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                <option value='shift'>Shift</option>
                <option value='market'>Market</option>
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
              <input wire:model.lazy="destination" type="text" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
            </div>
        </div>
    </td>
    <td class="py-2 px-1 whitespace-no-wrap text-center text-sm leading-5 font-medium ">
        <button  wire:click='removeInstruction' class="text-indigo-600 hover:text-indigo-900">Remove</button>
    </td>
</tr>
