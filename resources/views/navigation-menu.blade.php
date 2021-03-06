<div>
    <nav x-data="{ open: false }" class="bg-white dark:bg-gray-900">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('start') }}">
                            <x-jet-application-mark class="block h-9 w-auto fill-current dark:text-white"/>
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-jet-nav-link>
                            <button id="switchTheme"
                                    class="h-12 w-12 flex justify-center items-center focus:outline-none text-black dark:text-gray-300 dark:hover:text-gray-100">
                                <i class="fas fa-lightbulb" id="themeSwitcher"></i>
                            </button>
                            <script src="{{ mix('js/theme-switcher.js') }}" ></script>
                        </x-jet-nav-link>
                        <x-jet-nav-link href="{{ route('start') }}" :active="request()->routeIs('login')">
                        {{ __('Start') }}
                        </x-jet-nav-link>
                        <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-jet-nav-link>
                        <livewire:search.bar/>
                </div>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    @auth
                        <x-jet-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out dark:bg-gray-800 dark:text-gray-300">
                                        <img class="h-8 w-8 rounded-full object-cover"
                                             src="{{ current_user()->profile_photo_url }}"
                                             alt="{{ current_user()->name }}"/>
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                    <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150  dark:bg-gray-800  dark:text-gray-300">
                                        {{current_user()->name}}
                                        <svg class="ml-2 -mr-0.5 mb-2 font-medium leading-tight text-xl w-4"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                    </span>
                                @endif

                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-jet-dropdown-link href="{{ route('profile.show') }}" >
                                    {{ __('Profile') }}
                                </x-jet-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-jet-dropdown-link>
                                @endif

                                <div class="border-t border-gray-100 dark:border-gray-600"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-jet-dropdown-link href="{{ route('logout') }}"
                                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Logout') }}
                                    </x-jet-dropdown-link>
                                </form>
                            </x-slot>
                        </x-jet-dropdown>
                    @elseguest
                        <form action="{{ route('login') }}">
                            <input
                                class="cursor-pointer px-4 py-2 font-medium tracking-wide text-white transition-colors duration-200 transform bg-blue-600 rounded-md dark:bg-gray-800 hover:bg-blue-500 dark:hover:bg-gray-700 focus:outline-none focus:bg-blue-500 dark:focus:bg-gray-700"
                                value="{{ __('Login') }} "
                                type="submit">
                        </form>
                    @endauth
                </div>
            </div>
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out  dark:bg-gray-800">
                    <svg class="font-medium leading-tight text-base w-6" stroke="currentColor" fill="none"
                         viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-jet-responsive-nav-link>

        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link>
                <livewire:search.bar/>
            </x-jet-responsive-nav-link>
        </div>
        <!-- Responsive Settings Options -->
        <x-jet-responsive-nav-link>
            <button id="switchTheme"
                    class="h-12 w-12 flex justify-center items-center focus:outline-none text-black dark:text-gray-300 dark:hover:text-gray-100">
                <i class="fas fa-lightbulb" id="themeSwitcher"></i>
            </button>
        </x-jet-responsive-nav-link>
        @auth
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="flex-shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover"
                             src="{{ current_user()->profile_photo_url }}"
                             alt="{{ current_user()->name }}"/>
                    </div>
                @endif

                <div>
                        <div class="font-medium text-base text-gray-800">{{ current_user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ current_user()->email }}</div>
                    </div>
                </div>
            <div class="space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}"
                                           :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}"
                                               :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
            @endif

            <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-jet-responsive-nav-link>
                </form>
            </div>
        @endauth
    </nav>
    <div class="w-full h-0.5 bg-gradient-to-l from-white to-gray-200 dark:from-blue-800 dark:to-blue-500">
    </div>
</div>
