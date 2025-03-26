<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <img class="h-8 w-8"
                        src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500">
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <x-nav-link :active="request()->is('/')" href="/">Home</x-nav-link>
                        <x-nav-link :active="request()->is('about')" href="/about">About</x-nav-link>
                        <x-nav-link :active="request()->is('notes')" href="/notes">Notes</x-nav-link>
                        <x-nav-link :active="request()->is('contact')" href="/contact">Contact</x-nav-link>
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">

                    <div class="relative ml-5">
                        <div class="gap-5 flex">
                            @auth
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="font-medium text-gray-300 hover:text-white">Log
                                        out</button>
                                </form>
                            @else
                                <a href="{{ route('register') }}"
                                    class="font-medium text-gray-300 hover:text-white">Register</a>
                                <a href="{{ route('login') }}" class="font-medium text-gray-300 hover:text-white">Log in</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            <div class="-mr-2 flex md:hidden">

                <button type="button"
                    class="inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="md:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">

            <x-nav-link :mobile="true" :active="request()->is('/')" href="/">Home</x-nav-link>
            <x-nav-link :mobile="true" :active="request()->is('about')" href="/about">About</x-nav-link>
            <x-nav-link :mobile="true" :active="request()->is('notes')" href="/notes">Notes</x-nav-link>
            <x-nav-link :mobile="true" :active="request()->is('contact')" href="/contact">Contact</x-nav-link>

            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="hover:bg-gray-700 block px-3 py-2 rounded-md text-base font-medium text-gray-300">Log
                        out</button>
                </form>
            @else
                <x-nav-link :mobile="true" :active="request()->is('register')" href="{{ route('register') }}">Register</x-nav-link>
                <x-nav-link :mobile="true" :active="request()->is('login')" href="{{ route('login') }}">Log in</x-nav-link>
            @endauth
        </div>
    </div>
</nav>