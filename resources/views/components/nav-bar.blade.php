<nav class="sticky top-0 flex justify-between items-center mb-4 h-16 w-full bg-slate-500">
    <a href="/home">
        <p class="text-2xl font-medium text-white ml-4">Polynet</p>
    </a>
    <ul class="flex space-x-6 mr-6 text-lg text-white">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-dropdown-link>
        </form>
    </ul>
</nav>