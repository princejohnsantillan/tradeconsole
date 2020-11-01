<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="pb-5 border-b border-gray-200 mb-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                  Application List
                </h3>
            </div>

            <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <li class="col-span-1 bg-white rounded-lg shadow">
                    <div class="w-full flex items-center justify-between p-6 space-x-6">
                        <div class="flex-1 truncate">
                            <div class="flex items-center space-x-3">
                                <h3 class="text-gray-900 text-sm leading-5 font-medium truncate">Debugger</h3>
                                <span class="flex-shrink-0 inline-block px-2 py-0.5 text-indigo-800 text-xs leading-4 font-medium bg-indigo-100 rounded-full">Trade Console</span>
                            </div>
                            <p class="mt-1 text-gray-500 text-sm leading-5 truncate">Debugging tool for development.</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-200">
                        <div class="-mt-px flex">
                            <div class="w-0 flex-1 flex border-r border-gray-200">
                                <a href="{{route('pulse-for-sterling')}}" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm leading-5 text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 transition ease-in-out duration-150">
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 5C2 3.89543 2.89543 3 4 3H16C17.1046 3 18 3.89543 18 5V15C18 16.1046 17.1046 17 16 17H4C2.89543 17 2 16.1046 2 15V5ZM5.29289 6.29289C5.68342 5.90237 6.31658 5.90237 6.70711 6.29289L9.70711 9.29289C10.0976 9.68342 10.0976 10.3166 9.70711 10.7071L6.70711 13.7071C6.31658 14.0976 5.68342 14.0976 5.29289 13.7071C4.90237 13.3166 4.90237 12.6834 5.29289 12.2929L7.58579 10L5.29289 7.70711C4.90237 7.31658 4.90237 6.68342 5.29289 6.29289ZM11 12C10.4477 12 10 12.4477 10 13C10 13.5523 10.4477 14 11 14H14C14.5523 14 15 13.5523 15 13C15 12.4477 14.5523 12 14 12H11Z" fill="#4B5563"/>
                                    </svg>
                                    <span class="ml-3">Open</span>
                                </a>
                            </div>
                            <div class="-ml-px w-0 flex-1 flex">
                                <a href="#" class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm leading-5 text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 transition ease-in-out duration-150">
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18 10C18 14.4183 14.4183 18 10 18C5.58172 18 2 14.4183 2 10C2 5.58172 5.58172 2 10 2C14.4183 2 18 5.58172 18 10ZM11 6C11 6.55228 10.5523 7 10 7C9.44772 7 9 6.55228 9 6C9 5.44772 9.44772 5 10 5C10.5523 5 11 5.44772 11 6ZM9 9C8.44772 9 8 9.44772 8 10C8 10.5523 8.44772 11 9 11V14C9 14.5523 9.44772 15 10 15H11C11.5523 15 12 14.5523 12 14C12 13.4477 11.5523 13 11 13V10C11 9.44772 10.5523 9 10 9H9Z" fill="#4A5568"/>
                                    </svg>
                                    <span class="ml-3">Tell me more</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="col-span-1 bg-white rounded-lg shadow">
                    <div class="w-full flex items-center justify-between p-6 space-x-6">
                        <div class="flex-1 truncate">
                            <div class="flex items-center space-x-3">
                                <h3 class="text-gray-900 text-sm leading-5 font-medium truncate">Pulse</h3>
                                <span class="flex-shrink-0 inline-block px-2 py-0.5 text-indigo-800 text-xs leading-4 font-medium bg-indigo-100 rounded-full">Sterling Trader</span>
                            </div>
                            <p class="mt-1 text-gray-500 text-sm leading-5 truncate">A copy trading solution for Sterling Trader.</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-200">
                        <div class="-mt-px flex">
                            <div class="w-0 flex-1 flex border-r border-gray-200">
                                <a href="{{route('pulse-for-sterling')}}" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm leading-5 text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 transition ease-in-out duration-150">
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 5C2 3.89543 2.89543 3 4 3H16C17.1046 3 18 3.89543 18 5V15C18 16.1046 17.1046 17 16 17H4C2.89543 17 2 16.1046 2 15V5ZM5.29289 6.29289C5.68342 5.90237 6.31658 5.90237 6.70711 6.29289L9.70711 9.29289C10.0976 9.68342 10.0976 10.3166 9.70711 10.7071L6.70711 13.7071C6.31658 14.0976 5.68342 14.0976 5.29289 13.7071C4.90237 13.3166 4.90237 12.6834 5.29289 12.2929L7.58579 10L5.29289 7.70711C4.90237 7.31658 4.90237 6.68342 5.29289 6.29289ZM11 12C10.4477 12 10 12.4477 10 13C10 13.5523 10.4477 14 11 14H14C14.5523 14 15 13.5523 15 13C15 12.4477 14.5523 12 14 12H11Z" fill="#4B5563"/>
                                    </svg>
                                    <span class="ml-3">Open</span>
                                </a>
                            </div>
                            <div class="-ml-px w-0 flex-1 flex">
                                <a href="#" class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm leading-5 text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 transition ease-in-out duration-150">
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18 10C18 14.4183 14.4183 18 10 18C5.58172 18 2 14.4183 2 10C2 5.58172 5.58172 2 10 2C14.4183 2 18 5.58172 18 10ZM11 6C11 6.55228 10.5523 7 10 7C9.44772 7 9 6.55228 9 6C9 5.44772 9.44772 5 10 5C10.5523 5 11 5.44772 11 6ZM9 9C8.44772 9 8 9.44772 8 10C8 10.5523 8.44772 11 9 11V14C9 14.5523 9.44772 15 10 15H11C11.5523 15 12 14.5523 12 14C12 13.4477 11.5523 13 11 13V10C11 9.44772 10.5523 9 10 9H9Z" fill="#4A5568"/>
                                    </svg>
                                    <span class="ml-3">Tell me more</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="col-span-1 bg-white rounded-lg shadow">
                    <div class="w-full flex items-center justify-between p-6 space-x-6">
                        <div class="flex-1 truncate">
                            <div class="flex items-center space-x-3">
                                <h3 class="text-gray-900 text-sm leading-5 font-medium truncate">Reporting</h3>
                                <span class="flex-shrink-0 inline-block px-2 py-0.5 text-indigo-800 text-xs leading-4 font-medium bg-indigo-100 rounded-full">Sterling Trader</span>
                            </div>
                            <p class="mt-1 text-gray-500 text-sm leading-5 truncate">Statistics and Reports for Sterling Trader.</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-200">
                        <div class="-mt-px flex">
                            <div class="w-0 flex-1 flex border-r border-gray-200">
                                <a href="{{route('reporting-for-sterling')}}" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm leading-5 text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 transition ease-in-out duration-150">
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 5C2 3.89543 2.89543 3 4 3H16C17.1046 3 18 3.89543 18 5V15C18 16.1046 17.1046 17 16 17H4C2.89543 17 2 16.1046 2 15V5ZM5.29289 6.29289C5.68342 5.90237 6.31658 5.90237 6.70711 6.29289L9.70711 9.29289C10.0976 9.68342 10.0976 10.3166 9.70711 10.7071L6.70711 13.7071C6.31658 14.0976 5.68342 14.0976 5.29289 13.7071C4.90237 13.3166 4.90237 12.6834 5.29289 12.2929L7.58579 10L5.29289 7.70711C4.90237 7.31658 4.90237 6.68342 5.29289 6.29289ZM11 12C10.4477 12 10 12.4477 10 13C10 13.5523 10.4477 14 11 14H14C14.5523 14 15 13.5523 15 13C15 12.4477 14.5523 12 14 12H11Z" fill="#4B5563"/>
                                    </svg>
                                    <span class="ml-3">Open</span>
                                </a>
                            </div>
                            <div class="-ml-px w-0 flex-1 flex">
                                <a href="#" class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm leading-5 text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 transition ease-in-out duration-150">
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18 10C18 14.4183 14.4183 18 10 18C5.58172 18 2 14.4183 2 10C2 5.58172 5.58172 2 10 2C14.4183 2 18 5.58172 18 10ZM11 6C11 6.55228 10.5523 7 10 7C9.44772 7 9 6.55228 9 6C9 5.44772 9.44772 5 10 5C10.5523 5 11 5.44772 11 6ZM9 9C8.44772 9 8 9.44772 8 10C8 10.5523 8.44772 11 9 11V14C9 14.5523 9.44772 15 10 15H11C11.5523 15 12 14.5523 12 14C12 13.4477 11.5523 13 11 13V10C11 9.44772 10.5523 9 10 9H9Z" fill="#4A5568"/>
                                    </svg>
                                    <span class="ml-3">Tell me more</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</x-app-layout>