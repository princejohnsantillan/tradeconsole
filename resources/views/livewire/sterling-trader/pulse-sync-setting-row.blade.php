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
              <input wire:model.lazy="weight" type="number" step=".01" min="0" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
            </div>
        </div>
    </td>
    <td class="px-2 py-2 whitespace-no-wrap text-center text-sm leading-5 font-medium ">
        <button  wire:click='removeSetting' class="text-indigo-600 hover:text-indigo-900">Remove</button>
    </td>
</tr>
