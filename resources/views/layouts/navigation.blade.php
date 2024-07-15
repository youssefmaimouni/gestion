<nav x-data="{ open: false }" class="bg-slate-500 h-16 sticky  border-gray-100 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        {{-- <x-application-logo class="block h-9 w-auto fill-current text-gray-800" /> --}}
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Accueil') }}
                    </x-nav-link>
                </div>
            </div>
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 z-50">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden bg-white w-2/3 h-full shadow-sm rounded sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Accueil') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t bg-white border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
                <a href="/marchandises"
                class="flex text-laravel font-medium text items-center hover:bg-slate-300 w-full  p-3 {{ request()->is('marchandises/*') ? 'bg-slate-400' : '' }} {{ request()->is('marchandises') ? 'bg-slate-400' : '' }}">
                <svg width="30px" height="30px" viewBox="0 -0.5 25 25"fill="#1967D2"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M13.05 12.082C13.05 11.6678 12.7142 11.332 12.3 11.332C11.8858 11.332 11.55 11.6678 11.55 12.082H13.05ZM12.3 19H11.55C11.55 19.249 11.6736 19.4818 11.8799 19.6213C12.0862 19.7608 12.3483 19.7888 12.5794 19.696L12.3 19ZM18.044 16.694L18.3234 17.39C18.6077 17.2759 18.794 17.0003 18.794 16.694H18.044ZM18.794 11.9C18.794 11.4858 18.4582 11.15 18.044 11.15C17.6298 11.15 17.294 11.4858 17.294 11.9H18.794ZM12.7554 11.4861C12.4263 11.2346 11.9556 11.2975 11.7041 11.6266C11.4526 11.9557 11.5155 12.4264 11.8446 12.6779L12.7554 11.4861ZM14.348 13.647L13.8926 14.2429C14.1156 14.4133 14.415 14.445 14.6687 14.325L14.348 13.647ZM18.3617 12.578C18.7361 12.4008 18.8961 11.9537 18.719 11.5793C18.5418 11.2049 18.0947 11.0449 17.7203 11.222L18.3617 12.578ZM12.0206 11.386C11.6362 11.5403 11.4497 11.977 11.604 12.3614C11.7583 12.7458 12.195 12.9323 12.5794 12.778L12.0206 11.386ZM18.3234 10.472C18.7078 10.3177 18.8943 9.88097 18.74 9.49658C18.5857 9.11219 18.149 8.92567 17.7646 9.07999L18.3234 10.472ZM17.7647 10.472C18.1491 10.6263 18.5858 10.4397 18.74 10.0553C18.8943 9.6709 18.7077 9.23421 18.3233 9.07995L17.7647 10.472ZM12.5793 6.77495C12.1949 6.62069 11.7582 6.80727 11.604 7.19168C11.4497 7.5761 11.6363 8.01279 12.0207 8.16705L12.5793 6.77495ZM18.4115 9.12322C18.0505 8.92024 17.5932 9.0484 17.3902 9.40947C17.1872 9.77054 17.3154 10.2278 17.6765 10.4308L18.4115 9.12322ZM20.095 10.93L20.4153 11.6082C20.669 11.4884 20.8346 11.237 20.8445 10.9566C20.8545 10.6762 20.7071 10.4137 20.4625 10.2762L20.095 10.93ZM17.7207 11.2218C17.3462 11.3987 17.1859 11.8457 17.3628 12.2203C17.5397 12.5948 17.9867 12.7551 18.3613 12.5782L17.7207 11.2218ZM17.4849 9.27273C17.207 9.57984 17.2306 10.0541 17.5377 10.3321C17.8448 10.61 18.3191 10.5864 18.5971 10.2793L17.4849 9.27273ZM20.5 7.059L21.0561 7.56227C21.2259 7.37459 21.2897 7.11388 21.2255 6.86901C21.1614 6.62413 20.9781 6.42812 20.738 6.34778L20.5 7.059ZM14.348 5L14.586 4.28878C14.2926 4.19056 13.9689 4.28268 13.7711 4.52071L14.348 5ZM11.7181 6.99171C11.4534 7.31031 11.4971 7.78317 11.8157 8.04787C12.1343 8.31258 12.6072 8.26889 12.8719 7.95029L11.7181 6.99171ZM6.27168 9.07995C5.88727 9.23421 5.70069 9.6709 5.85495 10.0553C6.00921 10.4397 6.4459 10.6263 6.83032 10.472L6.27168 9.07995ZM12.5743 8.16705C12.9587 8.01279 13.1453 7.5761 12.991 7.19168C12.8368 6.80727 12.4001 6.62069 12.0157 6.77495L12.5743 8.16705ZM6.91853 10.4298C7.2796 10.2268 7.40776 9.76954 7.20478 9.40847C7.00179 9.0474 6.54454 8.91924 6.18347 9.12222L6.91853 10.4298ZM4.5 10.929L4.13247 10.2752C3.88802 10.4126 3.74065 10.675 3.75046 10.9552C3.76027 11.2355 3.92561 11.4869 4.17908 11.6069L4.5 10.929ZM6.23008 12.5779C6.60445 12.7551 7.05163 12.5953 7.22887 12.2209C7.40611 11.8465 7.2463 11.3994 6.87192 11.2221L6.23008 12.5779ZM6.83042 9.07999C6.44603 8.92567 6.00931 9.11219 5.85499 9.49658C5.70067 9.88097 5.88719 10.3177 6.27158 10.472L6.83042 9.07999ZM12.0156 12.778C12.4 12.9323 12.8367 12.7458 12.991 12.3614C13.1453 11.977 12.9588 11.5403 12.5744 11.386L12.0156 12.778ZM5.9907 10.2746C6.26604 10.584 6.74011 10.6116 7.04956 10.3363C7.35901 10.061 7.38665 9.58689 7.1113 9.27744L5.9907 10.2746ZM4.5 7.471L4.20362 6.78205C3.98226 6.87727 3.82014 7.07305 3.76786 7.30828C3.71558 7.54351 3.77951 7.78954 3.9397 7.96956L4.5 7.471ZM10.244 5L10.8211 4.52099C10.6087 4.26508 10.2531 4.17962 9.94762 4.31105L10.244 5ZM11.7179 7.95001C11.9824 8.26874 12.4553 8.31265 12.774 8.0481C13.0927 7.78355 13.1367 7.31071 12.8721 6.99199L11.7179 7.95001ZM13.045 12.083C13.045 11.6688 12.7092 11.333 12.295 11.333C11.8808 11.333 11.545 11.6688 11.545 12.083H13.045ZM12.295 19L12.0156 19.696C12.2467 19.7888 12.5088 19.7608 12.7151 19.6213C12.9214 19.4818 13.045 19.249 13.045 19H12.295ZM6.551 16.694H5.801C5.801 17.0003 5.9873 17.2759 6.27158 17.39L6.551 16.694ZM7.301 11.9C7.301 11.4858 6.96521 11.15 6.551 11.15C6.13679 11.15 5.801 11.4858 5.801 11.9H7.301ZM12.75 12.6782C13.0793 12.427 13.1425 11.9563 12.8912 11.627C12.64 11.2977 12.1693 11.2345 11.84 11.4858L12.75 12.6782ZM10.244 13.647L9.92328 14.325C10.1768 14.4449 10.476 14.4134 10.699 14.2432L10.244 13.647ZM6.87172 11.222C6.49729 11.0449 6.05016 11.2049 5.87303 11.5793C5.6959 11.9537 5.85585 12.4008 6.23028 12.578L6.87172 11.222ZM11.55 12.082V19H13.05V12.082H11.55ZM12.5794 19.696L18.3234 17.39L17.7646 15.998L12.0206 18.304L12.5794 19.696ZM18.794 16.694V11.9H17.294V16.694H18.794ZM11.8446 12.6779L13.8926 14.2429L14.8034 13.0511L12.7554 11.4861L11.8446 12.6779ZM14.6687 14.325L18.3617 12.578L17.7203 11.222L14.0273 12.969L14.6687 14.325ZM12.5794 12.778L18.3234 10.472L17.7646 9.07999L12.0206 11.386L12.5794 12.778ZM18.3233 9.07995L12.5793 6.77495L12.0207 8.16705L17.7647 10.472L18.3233 9.07995ZM17.6765 10.4308L19.7275 11.5838L20.4625 10.2762L18.4115 9.12322L17.6765 10.4308ZM19.7747 10.2518L17.7207 11.2218L18.3613 12.5782L20.4153 11.6082L19.7747 10.2518ZM18.5971 10.2793L21.0561 7.56227L19.9439 6.55573L17.4849 9.27273L18.5971 10.2793ZM20.738 6.34778L14.586 4.28878L14.11 5.71122L20.262 7.77022L20.738 6.34778ZM13.7711 4.52071L11.7181 6.99171L12.8719 7.95029L14.9249 5.47929L13.7711 4.52071ZM6.83032 10.472L12.5743 8.16705L12.0157 6.77495L6.27168 9.07995L6.83032 10.472ZM6.18347 9.12222L4.13247 10.2752L4.86753 11.5828L6.91853 10.4298L6.18347 9.12222ZM4.17908 11.6069L6.23008 12.5779L6.87192 11.2221L4.82092 10.2511L4.17908 11.6069ZM6.27158 10.472L12.0156 12.778L12.5744 11.386L6.83042 9.07999L6.27158 10.472ZM7.1113 9.27744L5.0603 6.97244L3.9397 7.96956L5.9907 10.2746L7.1113 9.27744ZM4.79638 8.15995L10.5404 5.68895L9.94762 4.31105L4.20362 6.78205L4.79638 8.15995ZM9.6669 5.47901L11.7179 7.95001L12.8721 6.99199L10.8211 4.52099L9.6669 5.47901ZM11.545 12.083V19H13.045V12.083H11.545ZM12.5744 18.304L6.83042 15.998L6.27158 17.39L12.0156 19.696L12.5744 18.304ZM7.301 16.694V11.9H5.801V16.694H7.301ZM11.84 11.4858L9.78904 13.0508L10.699 14.2432L12.75 12.6782L11.84 11.4858ZM10.5647 12.969L6.87172 11.222L6.23028 12.578L9.92328 14.325L10.5647 12.969Z"
                        fill="#000000" />
                </svg>
                <p class="ml-4">
                    Marchandises
                </p>
            </a>
            <a class="flex text-laravel font-medium text items-center hover:bg-slate-300  p-3 w-full {{ request()->is('categories/entre/*') ? 'bg-slate-400' : '' }} {{ request()->is('categories/sortie/*') ? 'bg-slate-400' : '' }} {{ request()->is('categories/*/documents/*') ? 'bg-slate-400' : '' }} {{ request()->is('categories/*/documents') ? 'bg-slate-400' : '' }} {{ request()->is('documents') ? 'bg-slate-400' : '' }}" href="/documents">
                <svg height='30px' enable-background="new 0 0 512 512" version="1.1" viewBox="0 0 512 512"
                    xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Layer_1" />
                    <g id="Layer_2">
                        <g>
                            <path
                                d="M382.6,82h-39.2c-4.1,0-7.5,3.4-7.5,7.5v14.9c0,3.9-3.2,7.1-7.1,7.1s-7.1-3.2-7.1-7.1V89.5c0-4.1-3.4-7.5-7.5-7.5h-41.4    c-4.1,0-7.5,3.4-7.5,7.5v14.9c0,3.9-3.2,7.1-7.1,7.1h-3.4c-3.9,0-7.1-3.2-7.1-7.1V90.6c0-4.1-3.4-7.5-7.5-7.5h-35.8    c-4.1,0-7.5,3.4-7.5,7.5v13.8c0,3.9-3.2,7.1-7.1,7.1h-4.5c-3.9,0-7.1-3.2-7.1-7.1V90.6c0-4.1-3.4-7.5-7.5-7.5h-41.4    c-4.1,0-7.5,3.4-7.5,7.5v330.9c0,4.1,3.4,7.5,7.5,7.5h41.4c4.1,0,7.5-3.4,7.5-7.5v-13.8c0-3.9,3.2-7.1,7.1-7.1h4.5    c3.9,0,7.1,3.2,7.1,7.1v13.8c0,4.1,3.4,7.5,7.5,7.5h35.8c4.1,0,7.5-3.4,7.5-7.5v-13.8c0-3.9,3.2-7.1,7.1-7.1h3.4    c3.9,0,7.1,3.2,7.1,7.1v14.9c0,4.1,3.4,7.5,7.5,7.5h41.4c4.1,0,7.5-3.4,7.5-7.5v-14.9c0-3.9,3.2-7.1,7.1-7.1s7.1,3.2,7.1,7.1v14.9    c0,4.1,3.4,7.5,7.5,7.5h39.2c4.1,0,7.5-3.4,7.5-7.5V89.5C390.1,85.4,386.7,82,382.6,82z M375.1,415h-24.2v-7.4    c0-12.2-9.9-22.1-22.1-22.1c-12.2,0-22.1,9.9-22.1,22.1v7.4h-26.4v-7.4c0-12.2-9.9-22.1-22.1-22.1h-3.4    c-12.2,0-22.1,9.9-22.1,22.1v6.3H212v-6.3c0-12.2-9.9-22.1-22.1-22.1h-4.5c-12.2,0-22.1,9.9-22.1,22.1v6.3h-26.4V98.1h26.4v6.3    c0,12.2,9.9,22.1,22.1,22.1h4.5c12.2,0,22.1-9.9,22.1-22.1v-6.3h20.8v6.3c0,12.2,9.9,22.1,22.1,22.1h3.4    c12.2,0,22.1-9.9,22.1-22.1V97h26.4v7.4c0,12.2,9.9,22.1,22.1,22.1c12.2,0,22.1-9.9,22.1-22.1V97h24.2V415z" />
                            <path
                                d="M282.1,161.5H167.9c-4.1,0-7.5,3.4-7.5,7.5s3.4,7.5,7.5,7.5h114.3c4.1,0,7.5-3.4,7.5-7.5S286.3,161.5,282.1,161.5z" />
                            <path
                                d="M344.1,161.5h-24.6c-4.1,0-7.5,3.4-7.5,7.5s3.4,7.5,7.5,7.5h24.6c4.1,0,7.5-3.4,7.5-7.5S348.3,161.5,344.1,161.5z" />
                            <path
                                d="M282.1,209.3H167.9c-4.1,0-7.5,3.4-7.5,7.5s3.4,7.5,7.5,7.5h114.3c4.1,0,7.5-3.4,7.5-7.5S286.3,209.3,282.1,209.3z" />
                            <path
                                d="M319.5,224.3h24.6c4.1,0,7.5-3.4,7.5-7.5s-3.4-7.5-7.5-7.5h-24.6c-4.1,0-7.5,3.4-7.5,7.5S315.3,224.3,319.5,224.3z" />
                            <path
                                d="M282.1,257.1H167.9c-4.1,0-7.5,3.4-7.5,7.5s3.4,7.5,7.5,7.5h114.3c4.1,0,7.5-3.4,7.5-7.5S286.3,257.1,282.1,257.1z" />
                            <path
                                d="M319.5,272.1h24.6c4.1,0,7.5-3.4,7.5-7.5s-3.4-7.5-7.5-7.5h-24.6c-4.1,0-7.5,3.4-7.5,7.5S315.3,272.1,319.5,272.1z" />
                            <path
                                d="M333.7,308.3c7.7,0,12.7,2.5,15.5,3.7l3.1-12.2c-3.6-1.7-8.4-3.2-15.6-3.5v-9.5h-10.5V297c-11.5,2.3-18.2,9.7-18.2,19.1    c0,10.4,7.9,15.8,19.4,19.7c8,2.7,11.4,5.3,11.4,9.4c0,4.3-4.2,6.7-10.3,6.7c-7,0-13.3-2.3-17.9-4.7l-3.2,12.6    c4.1,2.4,11.1,4.3,18.3,4.6v10.2h10.5v-11c12.4-2.2,19.1-10.3,19.1-19.9c0-9.7-5.2-15.6-18-20.1c-9.1-3.4-12.9-5.7-12.9-9.2    C324.5,311.3,326.7,308.3,333.7,308.3z" />
                        </g>
                    </g>
                </svg>
                <p class="ml-4">
                    Documents
                </p>
            </a>
            {{-- <a class="flex text-laravel font-medium text items-center hover:bg-slate-400  p-3 w-full"
                href="/categories">
                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M4 19V6.2C4 5.0799 4 4.51984 4.21799 4.09202C4.40973 3.71569 4.71569 3.40973 5.09202 3.21799C5.51984 3 6.0799 3 7.2 3H16.8C17.9201 3 18.4802 3 18.908 3.21799C19.2843 3.40973 19.5903 3.71569 19.782 4.09202C20 4.51984 20 5.0799 20 6.2V17H6C4.89543 17 4 17.8954 4 19ZM4 19C4 20.1046 4.89543 21 6 21H20M9 7H15M9 11H15M19 17V21"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <p class="ml-4">
                    categories
                </p>
            </a> --}}
            <a class="flex text-laravel font-medium text items-center hover:bg-slate-300  p-3 w-full {{ request()->is('rapports') ? 'bg-slate-400' : '' }} {{ request()->is('rapports/*') ? 'bg-slate-400' : '' }}" href="/rapports">
                <svg width="30px" height="30px" viewBox="0 0 48 48" data-name="Layer 1" id="Layer_1"
                    xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <style>
                            .cls-1,
                            .cls-2 {
                                fill: none;
                                stroke: #1d1d1b;
                                stroke-linejoin: round;
                                stroke-width: 2px;
                            }

                            .cls-2 {
                                stroke-linecap: round;
                            }
                        </style>
                    </defs>
                    <title />
                    <rect class="cls-1" height="46" rx="4" ry="4"
                        transform="translate(48 48) rotate(180)" width="46" x="1" y="1" />
                    <rect class="cls-2" height="22" width="7" x="4" y="22" />
                    <rect class="cls-2" height="16" width="7" x="15" y="28" />
                    <rect class="cls-2" height="25" width="7" x="26" y="19" />
                    <rect class="cls-2" height="21" width="7" x="37" y="23" />
                    <circle class="cls-2" cx="7" cy="14" r="2" />
                    <circle class="cls-2" cx="19" cy="20" r="2" />
                    <circle class="cls-2" cx="30" cy="11" r="2" />
                    <circle class="cls-2" cx="41" cy="15" r="2" />
                    <line class="cls-2" x1="9" x2="17" y1="15" y2="19" />
                    <line class="cls-2" x1="21" x2="28" y1="19" y2="12" />
                    <line class="cls-2" x1="32" x2="39" y1="12" y2="14" />
                </svg>
                <p class="ml-4">
                    Rapports
                </p>
            </a>
            <div class="h-px  w-full my-4 bg-gray-600">‎</div>
            <a href="/entres/create"
            class="flex text-laravel font-medium text items-center hover:bg-slate-300  p-3 w-full {{ request()->is('entres/create') ? 'bg-slate-400' : '' }}">
            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
            d="M23 18C23 18.75 22.79 19.46 22.42 20.06C22.21 20.42 21.94 20.74 21.63 21C20.93 21.63 20.01 22 19 22C17.78 22 16.69 21.45 15.97 20.59C15.95 20.56 15.92 20.54 15.9 20.51C15.78 20.37 15.67 20.22 15.58 20.06C15.21 19.46 15 18.75 15 18C15 16.74 15.58 15.61 16.5 14.88C17.19 14.33 18.06 14 19 14C20 14 20.9 14.36 21.6 14.97C21.72 15.06 21.83 15.17 21.93 15.28C22.59 16 23 16.95 23 18Z"
            stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
            stroke-linejoin="round" />
            <path d="M20.49 17.98H17.51" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"
            stroke-linecap="round" stroke-linejoin="round" />
            <path d="M19 16.52V19.51" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10"
            stroke-linecap="round" stroke-linejoin="round" />
            <path d="M3.17004 7.43994L12 12.5499L20.7701 7.46991" stroke="#292D32" stroke-width="1.5"
            stroke-linecap="round" stroke-linejoin="round" />
            <path d="M12 21.6099V12.5399" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"
            stroke-linejoin="round" />
            <path
            d="M21.61 9.17V14.83C21.61 14.88 21.61 14.92 21.6 14.97C20.9 14.36 20 14 19 14C18.06 14 17.19 14.33 16.5 14.88C15.58 15.61 15 16.74 15 18C15 18.75 15.21 19.46 15.58 20.06C15.67 20.22 15.78 20.37 15.9 20.51L14.07 21.52C12.93 22.16 11.07 22.16 9.93001 21.52L4.59001 18.56C3.38001 17.89 2.39001 16.21 2.39001 14.83V9.17C2.39001 7.79 3.38001 6.11002 4.59001 5.44002L9.93001 2.48C11.07 1.84 12.93 1.84 14.07 2.48L19.41 5.44002C20.62 6.11002 21.61 7.79 21.61 9.17Z"
            stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <p class="ml-4">
            Ajouter Marchandises
        </p>
    </a>
    <div class="h-px  w-full my-4 bg-gray-600">‎</div>
    @if (auth()->user()->role=='S')
            
                <a href="/register" class="flex text-laravel font-medium text items-center hover:bg-slate-300  p-3 w-full {{ request()->is('register') ? 'bg-slate-400' : '' }}">
                    <svg fill="#000000" height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                        viewBox="0 0 328 328" xml:space="preserve">
                    <g id="XMLID_455_">
                        <path id="XMLID_458_" d="M15,286.75h125.596c19.246,24.348,49.031,40,82.404,40c57.897,0,105-47.103,105-105s-47.103-105-105-105
                            c-34.488,0-65.145,16.716-84.298,42.47c-7.763-1.628-15.694-2.47-23.702-2.47c-63.411,0-115,51.589-115,115
                            C0,280.034,6.716,286.75,15,286.75z M223,146.75c41.355,0,75,33.645,75,75s-33.645,75-75,75s-75-33.645-75-75
                            S181.645,146.75,223,146.75z"/>
                        <path id="XMLID_461_" d="M115,1.25c-34.602,0-62.751,28.15-62.751,62.751S80.398,126.75,115,126.75
                            c34.601,0,62.75-28.148,62.75-62.749S149.601,1.25,115,1.25z"/>
                        <path id="XMLID_462_" d="M193,236.75h15v15c0,8.284,6.716,15,15,15s15-6.716,15-15v-15h15c8.284,0,15-6.716,15-15s-6.716-15-15-15
                            h-15v-15c0-8.284-6.716-15-15-15s-15,6.716-15,15v15h-15c-8.284,0-15,6.716-15,15S184.716,236.75,193,236.75z"/>
                    </g>
                    </svg>
                    <p class="ml-4">
                        Ajouter un admin
                    </p>
                </a>
                <a href="/admin/list" class="flex text-laravel font-medium text items-center hover:bg-slate-300  p-3 w-full {{ request()->is('admin/*') ? 'bg-slate-400' : '' }}">
                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 21C5 17.134 8.13401 14 12 14C15.866 14 19 17.134 19 21M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#000000" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <p class="ml-4">
                        Gérer les admin
                    </p>
                </a>
            @endif
            </div>
        </div>
    </div>
</nav>
