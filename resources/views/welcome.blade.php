<x-guest-layout>
    <div class="bg-indigo-50">
        <div class="max-w-screen-xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl leading-9 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
                <span class="block">The Pulse Plus</span>                
            </h2>
            <div class="mt-8 flex lg:flex-shrink-0 lg:mt-0">
                @if (Route::has('login'))
                    @auth
                        <div class="inline-flex rounded-md shadow">
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                                Dashboard
                            </a>
                        </div>
                    @else
                        <div class="inline-flex rounded-md shadow">
                            <a href="{{ url('/login') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                                Login
                            </a>
                        </div>                       
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </x-guest-layout>
