<div class="bg-white shadow sm:rounded-lg">
    <div class="px-4 py-5 sm:p-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            Your Console Address
        </h3>
        @isset($consoleAddress)
            <div>
                <div class="mt-2 max-w-2xl text-sm leading-5 text-gray-500">
                    <p>
                        Download the latest Sterling Trader adapter and connect to The Pulse Plus using this address.
                    </p>
                </div>
                <div class="mt-5 sm:flex sm:items-center">
                    <div x-data="{}" class="max-w-xl w-full">
                        <label for="console-address" class="sr-only">Console Address</label>
                        <div x-on:click="$refs.consoleAddress.select(); document.execCommand('copy')" class=" relative rounded-md shadow-sm">
                            <input x-ref="consoleAddress" id="console-address" class="cursor-pointer form-input block w-full pr-10 sm:text-sm sm:leading-5" readonly value="{{ $consoleAddress }}" />
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8 3C8 2.44772 8.44772 2 9 2H11C11.5523 2 12 2.44772 12 3C12 3.55228 11.5523 4 11 4H9C8.44772 4 8 3.55228 8 3Z" />
                                    <path d="M6 3C4.89543 3 4 3.89543 4 5V16C4 17.1046 4.89543 18 6 18H14C15.1046 18 16 17.1046 16 16V5C16 3.89543 15.1046 3 14 3C14 4.65685 12.6569 6 11 6H9C7.34315 6 6 4.65685 6 3Z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <span class="mt-3 inline-flex rounded-md shadow-sm sm:mt-0 sm:ml-3 sm:w-auto">
                        <a href='{{ $downloadLink }}' type="button" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150 sm:w-auto sm:text-sm sm:leading-5">
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
