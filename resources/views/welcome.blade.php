<x-guest-layout>
    <div class="bg-indigo-50">
        <div class="max-w-screen-xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl leading-9 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
                <span class="block">Trade Console</span>
                <span class="block text-indigo-600">Add controls to your trade today.</span>
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
                        @if (Route::has('register'))
                            <div class="ml-3 inline-flex rounded-md shadow">
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-indigo-600 bg-white hover:text-indigo-500 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                                    Start for FREE
                                </a>
                            </div>
                        @endif
                    @endif
                @endif
            </div>
        </div>
    </div>

    <div class="bg-gray-900">
        <div class="pt-12 px-4 sm:px-6 lg:px-8 lg:pt-20">
          <div class="text-center">
            <h2 class="text-lg leading-6 font-semibold text-gray-300 uppercase tracking-wider">
              Pricing
            </h2>
            <p class="mt- text-3xl leading-9 font-extrabold text-white sm:text-4xl sm:leading-10 lg:text-5xl lg:leading-none">
              The right price for you, whoever you are
            </p>
            <p class="mt-3 max-w-4xl mx-auto text-xl leading-7 text-gray-300 sm:mt-5 sm:text-2xl sm:leading-8">
              Get started today and enjoy a 7 days free trial.
            </p>
          </div>
        </div>

        <div class="mt-16 bg-white pb-12 lg:mt-20 lg:pb-20">
          <div class="relative z-0">
            <div class="absolute inset-0 h-5/6 bg-gray-900 lg:h-2/3"></div>
            <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
              <div class="relative lg:grid lg:grid-cols-7">
                <div class="mx-auto max-w-md lg:mx-0 lg:max-w-none lg:col-start-1 lg:col-end-3 lg:row-start-2 lg:row-end-3">
                  <div class="h-full flex flex-col rounded-lg shadow-lg overflow-hidden lg:rounded-none lg:rounded-l-lg">
                    <div class="flex-1 flex flex-col">
                      <div class="bg-white px-6 py-10">
                        <div>
                          <h3 class="text-center text-2xl leading-8 font-medium text-gray-900" id="tier-hobby">
                            Skeptic
                          </h3>
                          <div class="mt-4 flex items-center justify-center">
                            <span class="px-3 flex items-start text-6xl leading-none tracking-tight text-gray-900">
                              <span class="mt-2 mr-2 text-4xl font-medium">
                                $
                              </span>
                              <span class="font-extrabold">
                                0
                              </span>
                            </span>
                            <span class="text-xl leading-7 font-medium text-gray-500">
                              /month
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="flex-1 flex flex-col justify-between border-t-2 border-gray-100 p-6 bg-gray-50 sm:p-10 lg:p-6 xl:p-10">
                        <ul>
                          <li class="flex items-start">
                            <div class="flex-shrink-0">
                              <svg class="h-6 w-6 text-green-500" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                              </svg>
                            </div>
                            <p class="ml-3 text-base leading-6 font-medium text-gray-500">
                              2 maximum connections
                            </p>
                          </li>
                          <li class="mt-4 flex items-start">
                            <div class="flex-shrink-0">
                              <svg class="h-6 w-6 text-green-500" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                              </svg>
                            </div>
                            <p class="ml-3 text-base leading-6 font-medium text-gray-500">
                              14 days data retention
                            </p>
                          </li>
                          <li class="mt-4 flex items-start">
                            <div class="flex-shrink-0">
                              <svg class="h-6 w-6 text-green-500" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                              </svg>
                            </div>
                            <p class="ml-3 text-base leading-6 font-medium text-gray-500">
                              Email alerting
                            </p>
                          </li>
                        </ul>
                        <div class="mt-8">
                          <div class="rounded-lg shadow-md">
                            <a href="{{ route('register') }}" class="block w-full text-center rounded-lg border border-transparent bg-white px-6 py-3 text-base leading-6 font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:shadow-outline transition ease-in-out duration-150" aria-describedby="tier-hobby">
                              Start for FREE
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mt-10 max-w-lg mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-start-3 lg:col-end-6 lg:row-start-1 lg:row-end-4">
                  <div class="relative z-10 rounded-lg shadow-xl">
                    <div class="pointer-events-none absolute inset-0 rounded-lg border-2 border-indigo-600"></div>
                    <div class="absolute inset-x-0 top-0 transform translate-y-px">
                      <div class="flex justify-center transform -translate-y-1/2">
                        <span class="inline-flex rounded-full bg-indigo-600 px-4 py-1 text-sm leading-5 font-semibold tracking-wider uppercase text-white">
                          Most Common
                        </span>
                      </div>
                    </div>
                    <div class="bg-white rounded-t-lg px-6 pt-12 pb-10">
                      <div>
                        <h3 class="text-center text-3xl leading-9 font-semibold text-gray-900 sm:-mx-6" id="tier-growth">
                          Believer
                        </h3>
                        <div class="mt-4 flex items-center justify-center">
                          <span class="px-3 flex items-start text-6xl leading-none tracking-tight text-gray-900 sm:text-6xl">
                            <span class="mt-2 mr-2 text-4xl font-medium">
                              $
                            </span>
                            <span class="font-extrabold">
                              200
                            </span>
                          </span>
                          <span class="text-2xl leading-8 font-medium text-gray-500">
                            /month
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="border-t-2 border-gray-100 rounded-b-lg pt-10 pb-8 px-6 bg-gray-50 sm:px-10 sm:py-10">
                      <ul>
                        <li class="flex items-start">
                            <div class="flex-shrink-0">
                              <!-- Heroicon name: check -->
                              <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                              </svg>
                            </div>
                            <p class="ml-3 text-base leading-6 font-medium text-gray-500">
                              7 days FREE trial
                            </p>
                        </li>
                        <li class="mt-4 flex items-start">
                          <div class="flex-shrink-0">
                            <!-- Heroicon name: check -->
                            <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                          </div>
                          <p class="ml-3 text-base leading-6 font-medium text-gray-500">
                            5 maximum connections
                          </p>
                        </li>
                        <li class="mt-4 flex items-start">
                          <div class="flex-shrink-0">
                            <!-- Heroicon name: check -->
                            <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                          </div>
                          <p class="ml-3 text-base leading-6 font-medium text-gray-500">
                            50 days data retention
                          </p>
                        </li>
                        <li class="mt-4 flex items-start">
                          <div class="flex-shrink-0">
                            <!-- Heroicon name: check -->
                            <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                          </div>
                          <p class="ml-3 text-base leading-6 font-medium text-gray-500">
                            Cross platform shadow trading
                          </p>
                        </li>
                        <li class="mt-4 flex items-start">
                          <div class="flex-shrink-0">
                            <!-- Heroicon name: check -->
                            <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                          </div>
                          <p class="ml-3 text-base leading-6 font-medium text-gray-500">
                            Email alerting
                          </p>
                        </li>
                      </ul>
                      <div class="mt-10">
                        <div class="rounded-lg shadow-md">
                          <a href="#" class="block w-full text-center rounded-lg border border-transparent bg-indigo-600 px-6 py-4 text-xl leading-6 font-medium text-white hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition ease-in-out duration-150" aria-describedby="tier-growth">
                            {{-- Get started today --}}
                            Available Soon
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mt-10 mx-auto max-w-md lg:m-0 lg:max-w-none lg:col-start-6 lg:col-end-8 lg:row-start-2 lg:row-end-3">
                  <div class="h-full flex flex-col rounded-lg shadow-lg overflow-hidden lg:rounded-none lg:rounded-r-lg">
                    <div class="flex-1 flex flex-col">
                      <div class="bg-white px-6 py-10">
                        <div>
                          <h3 class="text-center text-2xl leading-8 font-medium text-gray-900" id="tier-scale">
                            Diciple
                          </h3>
                          <div class="mt-4 flex items-center justify-center">
                            <span class="px-3 flex items-start text-6xl leading-none tracking-tight text-gray-900">
                              <span class="mt-2 mr-2 text-4xl font-medium">
                                $
                              </span>
                              <span class="font-extrabold">
                                500
                              </span>
                            </span>
                            <span class="text-xl leading-7 font-medium text-gray-500">
                              /month
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="flex-1 flex flex-col justify-between border-t-2 border-gray-100 p-6 bg-gray-50 sm:p-10 lg:p-6 xl:p-10">
                        <ul>
                            <li class="flex items-start">
                                <div class="flex-shrink-0">
                                    <!-- Heroicon name: check -->
                                    <svg class="h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p class="ml-3 text-base leading-6 font-medium text-gray-500">
                                    7 days FREE trial
                                </p>
                            </li>
                          <li class="mt-4 flex items-start">
                            <div class="flex-shrink-0">
                              <svg class="h-6 w-6 text-green-500" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                              </svg>
                            </div>
                            <p class="ml-3 text-base leading-6 font-medium text-gray-500">
                              12 maximum connections
                            </p>
                          </li>
                          <li class="mt-4 flex items-start">
                            <div class="flex-shrink-0">
                              <svg class="h-6 w-6 text-green-500" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                              </svg>
                            </div>
                            <p class="ml-3 text-base leading-6 font-medium text-gray-500">
                              120 days data retention
                            </p>
                          </li>
                          <li class="mt-4 flex items-start">
                            <div class="flex-shrink-0">
                              <svg class="h-6 w-6 text-green-500" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                              </svg>
                            </div>
                            <p class="ml-3 text-base leading-6 font-medium text-gray-500">
                              Cross platform shadow trading
                            </p>
                          </li>
                          <li class="mt-4 flex items-start">
                            <div class="flex-shrink-0">
                              <svg class="h-6 w-6 text-green-500" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                              </svg>
                            </div>
                            <p class="ml-3 text-base leading-6 font-medium text-gray-500">
                              Email and SMS alerting
                            </p>
                          </li>
                        </ul>
                        <div class="mt-8">
                          <div class="rounded-lg shadow-md">
                            <a href="#" class="block w-full text-center rounded-lg border border-transparent bg-white px-6 py-3 text-base leading-6 font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:shadow-outline transition ease-in-out duration-150" aria-describedby="tier-scale">
                              {{-- Get started today --}}
                              Available Soon
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="bg-gray-800">
        <div class="max-w-screen-xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center">
          <div class="lg:w-0 lg:flex-1">
            <h2 class="text-3xl leading-9 font-extrabold tracking-tight text-white sm:text-4xl sm:leading-10" id="newsletter-headline">
                Want product news and updates?
            </h2>
            <p class="mt-3 max-w-3xl text-lg leading-6 text-gray-300">
                Sign up for our newsletter to stay up to date.
            </p>
          </div>
          <div class="mt-8 lg:mt-0 lg:ml-8">
            <form class="sm:flex" aria-labelledby="newsletter-headline">
              <input aria-label="Email address" type="email" required class="appearance-none w-full px-5 py-3 border border-transparent text-base leading-6 rounded-md text-gray-900 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 transition duration-150 ease-in-out sm:max-w-xs" placeholder="Enter your email">
              <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3 sm:flex-shrink-0">
                <button class="w-full flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-400 focus:outline-none focus:bg-indigo-400 transition duration-150 ease-in-out">
                  Notify me
                </button>
              </div>
            </form>
          </div>
        </div>
    </div>
</x-guest-layout>
