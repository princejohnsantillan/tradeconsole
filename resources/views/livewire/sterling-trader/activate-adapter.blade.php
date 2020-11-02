<div class="bg-white shadow sm:rounded-lg">
  <div class="px-4 py-5 sm:p-6">
    <h3 class="text-lg leading-6 font-medium text-gray-900">
      Your Console Address
    </h3>
    @isset($consoleAddress)
      <div>
        <div class="mt-2 max-w-2xl text-sm leading-5 text-gray-500">
          <p>
              Download the latest Sterling Trader adapter and connect to Trade Console using this address.
          </p>
        </div>
        <div class="mt-5 sm:flex sm:items-center">
          <div class="max-w-xl w-full">
            <label for="console-address" class="sr-only">Console Address</label>
            <div class="relative rounded-md shadow-sm">
              <input id="console-address" class="form-input block w-full sm:text-sm sm:leading-5" readonly value="{{$consoleAddress}}">
            </div>
          </div>
          <span class="mt-3 inline-flex rounded-md shadow-sm sm:mt-0 sm:ml-3 sm:w-auto">
            <a href='{{$downloadLink}}' type="button" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150 sm:w-auto sm:text-sm sm:leading-5">
              Download v{{ config('sterlingtrader.adapter_version') }}
            </a>
          </span>
        </div>
      </div>
    @else
      <span class="mt-2 inline-flex rounded-md shadow-sm">
        <button wire:click='activate' type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
          <!-- Heroicon name: mail -->
          <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.3006 1.04621C11.7169 1.17743 12 1.56348 12 1.99995V6.99995L16 6.99995C16.3729 6.99995 16.7148 7.20741 16.887 7.53814C17.0592 7.86887 17.0331 8.26794 16.8192 8.57341L9.81924 18.5734C9.56894 18.931 9.11564 19.0849 8.69936 18.9537C8.28309 18.8225 8 18.4364 8 18L8 13H4C3.62713 13 3.28522 12.7925 3.11302 12.4618C2.94083 12.131 2.96694 11.732 3.18077 11.4265L10.1808 1.42649C10.4311 1.06892 10.8844 0.914992 11.3006 1.04621Z" />
          </svg>
          Activate
        </button>
      </span>
    @endisset
  </div>
</div>