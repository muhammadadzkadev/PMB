<nav x-data="{ open: false }" class="bg-teal-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ url('img/logo.jpg') }}" alt="Logo" class="h-10 w-10 rounded-full">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-4">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-teal-200 px-3 py-2 text-sm font-medium transition duration-150 ease-in-out">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @role('admin')
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')" class="text-white hover:text-teal-200 px-3 py-2 text-sm font-medium transition duration-150 ease-in-out">
                            {{ __('Manajemen User') }}
                        </x-nav-link>
                    @endrole
                    
                    @role('bidan|petugas')
                        @role('petugas')
                            <x-nav-link :href="route('pendaftaran.pasien-kk')" :active="request()->routeIs('pendaftaran.*') || request()->routeIs('patients.*')" class="text-white hover:text-teal-200 px-3 py-2 text-sm font-medium transition duration-150 ease-in-out">
                                {{ __('Pasien & KK') }}
                            </x-nav-link>
                        @endrole

                        <x-nav-link :href="route('rekam-medis.index')" :active="request()->routeIs('rekam-medis.*')" class="text-white hover:text-teal-200 px-3 py-2 text-sm font-medium transition duration-150 ease-in-out">
                            {{ __('Rekam Medis') }}
                        </x-nav-link>

                        <x-nav-link :href="route('pelayanan-medis.index')" :active="request()->routeIs('pelayanan-medis.*')" class="text-white hover:text-teal-200 px-3 py-2 text-sm font-medium transition duration-150 ease-in-out">
                            {{ __('Pelayanan Rekam Medis') }}
                        </x-nav-link>
                    @endrole
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-white hover:text-teal-200 focus:outline-none transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="hover:bg-teal-50 transition duration-150 ease-in-out">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="hover:bg-teal-50 transition duration-150 ease-in-out">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-teal-200 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-teal-200 transition duration-150 ease-in-out">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @role('admin')
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')" class="text-white hover:text-teal-200 transition duration-150 ease-in-out">
                    {{ __('Manajemen User') }}
                </x-responsive-nav-link>
            @endrole
            @role('bidan|petugas')
                @role('petugas')
                    <x-responsive-nav-link :href="route('pendaftaran.pasien-kk')" :active="request()->routeIs('pendaftaran.*') || request()->routeIs('patients.*')" class="text-white hover:text-teal-200 transition duration-150 ease-in-out">
                        {{ __('Pasien & KK') }}
                    </x-responsive-nav-link>
                @endrole
                <x-responsive-nav-link :href="route('rekam-medis.index')" :active="request()->routeIs('rekam-medis.*')" class="text-white hover:text-teal-200 transition duration-150 ease-in-out">
                    {{ __('Rekam Medis') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('pelayanan-medis.index')" :active="request()->routeIs('pelayanan-medis.*')" class="text-white hover:text-teal-200 transition duration-150 ease-in-out">
                    {{ __('Pelayanan Rekam Medis') }}
                </x-responsive-nav-link>
            @endrole
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-teal-700">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-teal-200">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-white hover:text-teal-200 transition duration-150 ease-in-out">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="text-white hover:text-teal-200 transition duration-150 ease-in-out">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>