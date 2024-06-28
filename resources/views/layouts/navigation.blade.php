<nav x-data="{ open: false }" class="bg-slate-500 border-b border-gray-100">
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
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
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
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
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
            </div>
        </div>
    </div>
    <div id="sidebar" class=' flex-col items-start justify-start w-64 fixed left-0 h-calc overflow-auto flex pb-6 bg-gray-100 overflow-x-hidden'>
        @auth
        @if (auth()->user()->role=='S')
        
            <a href="/register" class="flex text-laravel font-medium text items-center pl-4 mt-6">
                <svg fill="#1967D2" height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
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
            <a href="/update/admin" class="flex text-laravel font-medium text items-center pl-4 mt-6">
                <svg width="20px" height="20px" viewBox="0 -1.5 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Dribbble-Light-Preview" transform="translate(-100.000000, -2122.000000)" fill="#1967D2">
                            <g id="icons" transform="translate(56.000000, 160.000000)">
                                <path d="M63.9996063,1963 C63.9996063,1963.552 63.5516063,1964 62.9996063,1964 L56.9996063,1964 C56.4476063,1964 55.9996063,1963.552 55.9996063,1963 C55.9996063,1962.448 56.4476063,1962 56.9996063,1962 L62.9996063,1962 C63.5516063,1962 63.9996063,1962.448 63.9996063,1963 M51.9726063,1970.902 C51.9586063,1970.902 51.9446063,1970.9 51.9306063,1970.9 C51.9156063,1970.9 51.9026063,1970.902 51.8876063,1970.902 C50.8046063,1970.879 49.9306063,1969.995 49.9306063,1968.906 C49.9306063,1967.803 50.8276063,1966.906 51.9306063,1966.906 C53.0326063,1966.906 53.9306063,1967.803 53.9306063,1968.906 C53.9306063,1969.995 53.0556063,1970.879 51.9726063,1970.902 M54.9556063,1971.495 C55.7856063,1970.527 56.1856063,1969.18 55.7546063,1967.724 C55.3576063,1966.38 54.2276063,1965.32 52.8616063,1965.011 C50.2476063,1964.422 47.9306063,1966.393 47.9306063,1968.906 C47.9306063,1969.899 48.3056063,1970.796 48.9036063,1971.495 C46.3206063,1972.55 44.4126063,1974.997 44.0096063,1977.867 C43.9256063,1978.466 44.4036063,1979 45.0086063,1979 C45.5026063,1979 45.9206063,1978.637 45.9906063,1978.147 C46.4026063,1975.24 48.8866063,1972.923 51.8876063,1972.902 C51.9026063,1972.902 51.9156063,1972.906 51.9306063,1972.906 C51.9446063,1972.906 51.9576063,1972.902 51.9726063,1972.902 C54.9736063,1972.923 57.4576063,1975.24 57.8696063,1978.148 C57.9396063,1978.637 58.3576063,1979 58.8526063,1979 C59.4566063,1979 59.9346063,1978.466 59.8506063,1977.867 C59.4476063,1974.997 57.5396063,1972.551 54.9556063,1971.495" id="profile_minus-[#1353]">
                                </path>
                            </g>
                        </g>
                    </g>
                </svg>
                <p class="ml-4">
                    Gérer les admin
                </p>
            </a>
        @endif
            <a href="/marchandises/create" class="flex text-laravel font-medium text items-center  pl-4 mt-6">
                <abbr title="ajouter site">
                    <svg fill="#1967D2" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                        viewBox="0 0 27.963 27.963" xml:space="preserve">
                    <g>
                        <g id="c140__x2B_">
                            <path d="M13.98,0C6.259,0,0,6.26,0,13.982s6.259,13.981,13.98,13.981c7.725,0,13.983-6.26,13.983-13.981
                            C27.963,6.26,21.705,0,13.98,0z M21.102,16.059h-4.939v5.042h-4.299v-5.042H6.862V11.76h5.001v-4.9h4.299v4.9h4.939v4.299H21.102z
                            "/>
                        </g>
                        <g id="Capa_1_9_">
                        </g>
                    </g>
                    </svg>
                </abbr>
                <p class="ml-4">
                   ajouter un marchandise
                </p>
            </a>
            <button onclick="show()" href="/create" class="flex text-laravel font-medium text items-center  pl-4 mt-6">
                <abbr title="ajouter site">
                    <svg fill="#1967D2" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                        viewBox="0 0 27.963 27.963" xml:space="preserve">
                    <g>
                        <g id="c140__x2B_">
                            <path d="M13.98,0C6.259,0,0,6.26,0,13.982s6.259,13.981,13.98,13.981c7.725,0,13.983-6.26,13.983-13.981
                            C27.963,6.26,21.705,0,13.98,0z M21.102,16.059h-4.939v5.042h-4.299v-5.042H6.862V11.76h5.001v-4.9h4.299v4.9h4.939v4.299H21.102z
                            "/>
                        </g>
                        <g id="Capa_1_9_">
                        </g>
                    </g>
                    </svg>
                </abbr>
                <p class="ml-4">
                    Ajouter une catégorie
                </p>
             </button>
            
             <form action="/categorier/store" method="POST" id="add" class="flex items-center justify-around w-full hidden">
                @csrf
                <input type="text" name="categorier" class="flex text-laravel font-medium text items-center border-laravel border focus:border-0 ml-4 my-3 w-44 ">
                <button type="submit" class="bg-laravel p-1 h-fit w-fit rounded-md">
                    <svg fill="#ffff" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                        viewBox="0 0 27.963 27.963" xml:space="preserve">
                    <g>
                        <g id="c140__x2B_">
                            <path d="M13.98,0C6.259,0,0,6.26,0,13.982s6.259,13.981,13.98,13.981c7.725,0,13.983-6.26,13.983-13.981
                            C27.963,6.26,21.705,0,13.98,0z M21.102,16.059h-4.939v5.042h-4.299v-5.042H6.862V11.76h5.001v-4.9h4.299v4.9h4.939v4.299H21.102z
                            "/>
                        </g>
                        <g id="Capa_1_9_">
                        </g>
                    </g>
                    </svg>
                </button>
             </form>
             @error('categorier')
                <p id="error" class="text-red-500 text-xs ml-4 mt-1">{{$message}}</p>
             @enderror 
             <div class="h-px  w-11/12 mt-4 bg-laravel">‎ </div>
              @endauth
             <a class="flex text-laravel font-medium text items-center  pl-4 mt-6">
                
                <?xml version="1.0" encoding="utf-8"?>
                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="Iconly/Curved/Category">
                    <g id="Category">
                    <path id="Stroke 1" fill-rule="evenodd" clip-rule="evenodd" d="M21.0003 6.6738C21.0003 8.7024 19.3551 10.3476 17.3265 10.3476C15.2979 10.3476 13.6536 8.7024 13.6536 6.6738C13.6536 4.6452 15.2979 3 17.3265 3C19.3551 3 21.0003 4.6452 21.0003 6.6738Z" stroke="#1967D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path id="Stroke 3" fill-rule="evenodd" clip-rule="evenodd" d="M10.3467 6.6738C10.3467 8.7024 8.7024 10.3476 6.6729 10.3476C4.6452 10.3476 3 8.7024 3 6.6738C3 4.6452 4.6452 3 6.6729 3C8.7024 3 10.3467 4.6452 10.3467 6.6738Z" stroke="#1967D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path id="Stroke 5" fill-rule="evenodd" clip-rule="evenodd" d="M21.0003 17.2619C21.0003 19.2905 19.3551 20.9348 17.3265 20.9348C15.2979 20.9348 13.6536 19.2905 13.6536 17.2619C13.6536 15.2333 15.2979 13.5881 17.3265 13.5881C19.3551 13.5881 21.0003 15.2333 21.0003 17.2619Z" stroke="#1967D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path id="Stroke 7" fill-rule="evenodd" clip-rule="evenodd" d="M10.3467 17.2619C10.3467 19.2905 8.7024 20.9348 6.6729 20.9348C4.6452 20.9348 3 19.2905 3 17.2619C3 15.2333 4.6452 13.5881 6.6729 13.5881C8.7024 13.5881 10.3467 15.2333 10.3467 17.2619Z" stroke="#1967D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    </g>
                </svg>
                <p class="ml-4">
                    Catégories
                </p>
            </a>
            {{-- @foreach ($categorier as $item)
            <form action="/categorier/update/{{$item->id}}" method="POST" class="w-full">
                <div class="flex items-center justify-between  hover:bg-blue-100 w-full h-full p-2 pl-12">
                        @csrf
                        @method('PUT')
                        @auth
                        <div id="s-{{$item->id}}" class="hidden cursor-pointer" onclick="warnning({{$item->id}})">
                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 11V17" stroke="#1967D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 11V17" stroke="#1967D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M4 7H20" stroke="#1967D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" stroke="#1967D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#1967D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                        </div>
                        @endauth
                        <a href="/{{$item->id}}">
                            <p id="p-{{$item->id}}" class="ml-4 text-laravel capitalize">
                                {{$item->categorier}}
                            </p>
                        </a>
                        @auth
                            <input type="text" name="categorier2" id="input-{{$item->id}}" value="{{$item->categorier}}" class="ml-4 w-full capitalize hidden" />
                            <button type="button" id="b-{{$item->id}}" onclick="toggleEdit({{$item->id}})" class="">
                                <?xml version="1.0" ?>
                                <svg class="feather feather-edit" fill="none" height="24" stroke="#1967D2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg></button>
                            <button type="submit" id="save-{{$item->id}}" class=" hidden">
                                <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.75 6L7.5 5.25H16.5L17.25 6V19.3162L12 16.2051L6.75 19.3162V6ZM8.25 6.75V16.6838L12 14.4615L15.75 16.6838V6.75H8.25Z" fill="#1967D2"/>
                                </svg>
                            </button>
                        @endauth
                    </div>
                    </form>
                    <form action="/categorier/delete/{{$item->id}}" method="POST" id="hadik-{{$item->id}}" onsubmit="warnning({{$item->id}})">
                        @csrf
                        @method('DELETE')
                    </form>
            @endforeach --}}
             @error('marchandises')
                <p id="error" class="text-red-500 text-xs ml-4 mt-1">{{$message}}</p>
            @enderror 
            <div class="h-px  w-11/12 mt-4 bg-laravel">‎ </div>
            @endauth
            <a class="flex text-laravel font-medium text items-center  pl-4 mt-6">
                
                <?xml version="1.0" encoding="utf-8"?>
                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="Iconly/Curved/Category">
                    <g id="marchan">
                    <path id="Stroke 1" fill-rule="evenodd" clip-rule="evenodd" d="M21.0003 6.6738C21.0003 8.7024 19.3551 10.3476 17.3265 10.3476C15.2979 10.3476 13.6536 8.7024 13.6536 6.6738C13.6536 4.6452 15.2979 3 17.3265 3C19.3551 3 21.0003 4.6452 21.0003 6.6738Z" stroke="#1967D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path id="Stroke 3" fill-rule="evenodd" clip-rule="evenodd" d="M10.3467 6.6738C10.3467 8.7024 8.7024 10.3476 6.6729 10.3476C4.6452 10.3476 3 8.7024 3 6.6738C3 4.6452 4.6452 3 6.6729 3C8.7024 3 10.3467 4.6452 10.3467 6.6738Z" stroke="#1967D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path id="Stroke 5" fill-rule="evenodd" clip-rule="evenodd" d="M21.0003 17.2619C21.0003 19.2905 19.3551 20.9348 17.3265 20.9348C15.2979 20.9348 13.6536 19.2905 13.6536 17.2619C13.6536 15.2333 15.2979 13.5881 17.3265 13.5881C19.3551 13.5881 21.0003 15.2333 21.0003 17.2619Z" stroke="#1967D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path id="Stroke 7" fill-rule="evenodd" clip-rule="evenodd" d="M10.3467 17.2619C10.3467 19.2905 8.7024 20.9348 6.6729 20.9348C4.6452 20.9348 3 19.2905 3 17.2619C3 15.2333 4.6452 13.5881 6.6729 13.5881C8.7024 13.5881 10.3467 15.2333 10.3467 17.2619Z" stroke="#1967D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    </g>
                </svg>
                <p class="ml-4">
                    marchandises
                </p>
            </a>
            {{-- @foreach ($marchandises as $item)
            <form action="/marchandises/update/{{$item->id}}" method="POST" class="w-full">
                <div class="flex items-center justify-between  hover:bg-blue-100 w-full h-full p-2 pl-12">
                        @csrf
                        @method('PUT')
                        @auth
                        <div id="s-{{$item->id}}" class="hidden cursor-pointer" onclick="warnning({{$item->id}})">
                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 11V17" stroke="#1967D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 11V17" stroke="#1967D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M4 7H20" stroke="#1967D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" stroke="#1967D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#1967D2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                        </div>
                        @endauth
                        <a href="/{{$item->id}}">
                            <p id="p-{{$item->id}}" class="ml-4 text-laravel capitalize">
                                {{$item->marchandises}}
                            </p>
                        </a>
                        @auth
                            <input type="text" name="marchandises2" id="input-{{$item->id}}" value="{{$item->marchandises}}" class="ml-4 w-full capitalize hidden" />
                            <button type="button" id="b-{{$item->id}}" onclick="toggleEdit({{$item->id}})" class="">
                                <?xml version="1.0" ?>
                                <svg class="feather feather-edit" fill="none" height="24" stroke="#1967D2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg></button>
                            <button type="submit" id="save-{{$item->id}}" class=" hidden">
                                <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.75 6L7.5 5.25H16.5L17.25 6V19.3162L12 16.2051L6.75 19.3162V6ZM8.25 6.75V16.6838L12 14.4615L15.75 16.6838V6.75H8.25Z" fill="#1967D2"/>
                                </svg>
                            </button>
                        @endauth
                    </div>
                    </form>
                    <form action="/marchandises/delete/{{$item->id}}" method="POST" id="hadik-{{$item->id}}" onsubmit="warnning({{$item->id}})">
                        @csrf
                        @method('DELETE')
                    </form>
            @endforeach --}}
        </div>
</nav>
