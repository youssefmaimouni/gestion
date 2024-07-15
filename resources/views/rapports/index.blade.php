<x-nav-bar>
    <style>
        abbr {
            text-decoration: none;
        }
        @media(max-width: 640px){
    .desc{
       margin-top: 4px;
    }
}

    </style>
    <style>
        .qr-code {
            transition: transform 0.3s ease-in-out;
        }
        .enlarged {
            transform: scale(2);
            z-index: 1000;
        }
    </style>
    <div id="cont" class="">
        <div class="container  w-full">
            <!-- Error Message -->
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Erreur!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Warning Message -->
            @if (session('warning'))
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative"
                    role="alert">
                    <strong class="font-bold">Attention!</strong>
                    <span class="block sm:inline">{{ session('warning') }}</span>
                </div>
            @endif

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <strong class="font-bold">Succès!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- General Validation Errors -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <span class="block sm:inline">Il y avait quelques problèmes avec vos données
                        saisies.</span>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
        <div class="">
            <div class="w-full">
                <div class=" flex justify-center  sm:justify-end sm:mr-5 mb-10"> 
                <p class="text-2xl w-full m-3   sm:pl-6 underline underline-offset-4">Rapport</p>
                <div class="mr-5 mb-10">
                <a href="{{ route('rapports.courbe') }}" title="courbe"
                    aria-label="Modifier"
                    class="flex items-center text-red-500 bg-red-300 hover:bg-red-400 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-opacity-50 px-3 py-2 rounded shadow-md transition duration-200">
                    <svg fill="#000000" width="50px" height="30px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                        <title>chart3</title>
                        <path d="M3.987 4h-0.987v24h26v-0.963l-24.996-0.050-0.017-22.987zM17 5c0-0.553-0.448-1-1-1h-3c-0.553 0-1 0.447-1 1v20h5v-20zM11 11c0-0.552-0.448-1-1-1h-3c-0.553 0-1 0.448-1 1v14h5v-14zM23 17c0-0.553-0.448-1-1-1h-3c-0.553 0-1 0.447-1 1v8h5v-8zM28 22h-3c-0.553 0-1 0.447-1 1v2h5v-2c0-0.553-0.448-1-1-1z"></path>
                        </svg>
                </a>
                </div>
                
                    
                    <form action="{{ route('rapports.pdf') }}" method="POST" >
                        @csrf
                        @if (isset($search))
                            <input type="search" name="search" id="default-search" value={{ $search }}
                                class="hidden" />
                        @else
                            <input type="search" name="search" id="default-search" class="hidden" />
                        @endif
                        @if (isset($start) && isset($end))
                            <input id="start" name="start" type="date" class="hidden"
                                value={{ $start }}>
                            <input id="end" name="end" type="date" class="hidden"
                                value={{ $end }}>
                        @else
                            <input id="start" name="start" type="date" class="hidden">
                            <input id="end" name="end" type="date" class="hidden">
                        @endif
                        <div class="mr-5 mb-10">
                            <button type='submit' aria-label="pdf"
                                class="flex items-center text-blue-500 bg-blue-200 hover:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-opacity-50 px-3 py-2 rounded shadow-md transition duration-200">
                                <svg width="50px" height="30px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V11C19 11.5523 19.4477 12 20 12C20.5523 12 21 11.5523 21 11V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM10.3078 23.5628C10.4657 23.7575 10.6952 23.9172 10.9846 23.9762C11.2556 24.0316 11.4923 23.981 11.6563 23.9212C11.9581 23.8111 12.1956 23.6035 12.3505 23.4506C12.5941 23.2105 12.8491 22.8848 13.1029 22.5169C14.2122 22.1342 15.7711 21.782 17.287 21.5602C18.1297 21.4368 18.9165 21.3603 19.5789 21.3343C19.8413 21.6432 20.08 21.9094 20.2788 22.1105C20.4032 22.2363 20.5415 22.3671 20.6768 22.4671C20.7378 22.5122 20.8519 22.592 20.999 22.6493C21.0755 22.6791 21.5781 22.871 22.0424 22.4969C22.3156 22.2768 22.5685 22.0304 22.7444 21.7525C22.9212 21.4733 23.0879 21.0471 22.9491 20.5625C22.8131 20.0881 22.4588 19.8221 22.198 19.6848C21.9319 19.5448 21.6329 19.4668 21.3586 19.4187C21.11 19.3751 20.8288 19.3478 20.5233 19.3344C19.9042 18.5615 19.1805 17.6002 18.493 16.6198C17.89 15.76 17.3278 14.904 16.891 14.1587C16.9359 13.9664 16.9734 13.7816 17.0025 13.606C17.0523 13.3052 17.0824 13.004 17.0758 12.7211C17.0695 12.4497 17.0284 12.1229 16.88 11.8177C16.7154 11.4795 16.416 11.1716 15.9682 11.051C15.5664 10.9428 15.1833 11.0239 14.8894 11.1326C14.4359 11.3004 14.1873 11.6726 14.1014 12.0361C14.0288 12.3437 14.0681 12.6407 14.1136 12.8529C14.2076 13.2915 14.4269 13.7956 14.6795 14.2893C14.702 14.3332 14.7251 14.3777 14.7487 14.4225C14.5103 15.2072 14.1578 16.1328 13.7392 17.0899C13.1256 18.4929 12.4055 19.8836 11.7853 20.878C11.3619 21.0554 10.9712 21.2584 10.6746 21.4916C10.4726 21.6505 10.2019 21.909 10.0724 22.2868C9.9132 22.7514 10.0261 23.2154 10.3078 23.5628ZM11.8757 23.0947C11.8755 23.0946 11.8775 23.0923 11.8824 23.0877C11.8783 23.0924 11.8759 23.0947 11.8757 23.0947ZM16.9974 19.5812C16.1835 19.7003 15.3445 19.8566 14.5498 20.0392C14.9041 19.3523 15.2529 18.6201 15.5716 17.8914C15.7526 17.4775 15.9269 17.0581 16.0885 16.6431C16.336 17.0175 16.5942 17.3956 16.8555 17.7681C17.2581 18.3421 17.6734 18.911 18.0759 19.4437C17.7186 19.4822 17.3567 19.5287 16.9974 19.5812ZM16.0609 12.3842C16.0608 12.3829 16.0607 12.3823 16.0606 12.3823C16.0606 12.3822 16.0607 12.3838 16.061 12.3872C16.061 12.386 16.0609 12.385 16.0609 12.3842Z"
                                        fill="#000000" />
                                </svg>
                            </button>
                        </div>
                    </form>

                    <form action="{{ route('rapports.excel') }}" method="POST">
                        @csrf
                        @if (isset($search))
                            <input type="search" name="search" id="default-search" value={{ $search }}
                                class="hidden" />
                        @else
                            <input type="search" name="search" id="default-search" class="hidden" />
                        @endif
                        @if (isset($start) && isset($end))
                            <input id="start" name="start" type="date" class="hidden"
                                value={{ $start }}>
                            <input id="end" name="end" type="date" class="hidden"
                                value={{ $end }}>
                        @else
                            <input id="start" name="start" type="date" class="hidden">
                            <input id="end" name="end" type="date" class="hidden">
                        @endif
                        <div class="mr-5 mb-10">
                            <button type='submit'aria-label="pdf"
                                class="flex items-center text-green-500 bg-green-200 hover:bg-green-300 focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-opacity-50 px-3 py-2 rounded shadow-md transition duration-200">
                                <svg fill="#000000" width="50px" height="30px" viewBox="0 0 14 14" role="img"
                                    focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m 12.7765,2.551 -4.02,0 0,0.744 1.185,0 0,1.177 -1.185,0 0,0.375 1.185,0 0,1.1785 -1.185,0 0,0.3855 1.185,0 0,1.1145 -1.185,0 0,0.4465 1.185,0 0,1.117 -1.185,0 0,0.4465 1.185,0 0,1.1235 -1.185,0 0,0.8195 4.02,0 c 0.0635,-0.019 0.1165,-0.094 0.159,-0.224 C 12.978,11.1235 13,11.017 13,10.9365 L 13,2.687 C 13,2.623 12.978,2.5845 12.9355,2.571 12.893,2.558 12.84,2.551 12.7765,2.551 Z m -0.5215,8.107 -1.9285,0 0,-1.1225 1.9285,0 0,1.1235 0,-0.001 z m 0,-1.569 -1.9285,0 0,-1.1175 1.9285,0 0,1.1175 z m 0,-1.564 -1.9285,0 0,-1.1095 1.9285,0 0,1.1105 0,-10e-4 z m 0,-1.5 -1.9285,0 0,-1.177 1.9285,0 0,1.1775 0,-5e-4 z m 0,-1.5595 -1.9285,0 0,-1.17 1.9285,0 0,1.1775 0,-0.0075 z M 1,2.3655 1,11.666 8.08,12.8905 8.08,1.1095 1,2.3695 1,2.3655 Z M 5.1965,9.401 C 5.1695,9.328 5.0425,9.018 4.8175,8.4695 4.593,7.9215 4.4575,7.6025 4.418,7.5115 l -0.0125,0 L 3.646,9.319 2.631,9.2505 l 1.204,-2.25 -1.1025,-2.25 1.035,-0.0545 0.684,1.7605 0.0135,0 L 5.2375,4.616 6.307,4.5485 5.0335,6.9835 6.346,9.4675 5.1965,9.4 l 0,10e-4 z" />
                                </svg></button>
                        </div>
                    </form>
                </div>
                <form method="GET" action="/rapports/search" class="max-w-full  my-1">
                    <div class="grid  sm:flex  justify-between">
                        <div class="relative w-full sm:w-1/3">
                            @if (isset($search))
                                <input type="search" name="search" id="default-search" value={{ $search }}
                                    class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500  "
                                    placeholder="Rechercher" />
                            @else
                                <input type="search" name="search" id="default-search"
                                    class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500  "
                                    placeholder="Rechercher" />
                            @endif
                            <abbr title="filtre juste par bar de recherch">
                                <button type="submit" name="action" value="filter"
                                    class="text-white absolute end-2.5 bottom-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 ">
                                    <svg class="w-4 h-4 text-white " aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg></button>
                            </abbr>
                        </div>
                        <div id="date-range-picker" date-rangepicker class="grid  sm:flex items-center mb-1">
                            <div class=" sm:relative flex  w-full ">
                            @if (isset($start) && isset($end))
                                <div class="relative">

                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 " aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <abbr title="premier date">
                                        <input id="start" name="start" type="date"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 "
                                            placeholder="Select date start" value={{ $start }}>
                                    </abbr>
                                </div>
                                <span class="mx-4 text-gray-500">to</span>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 " aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <abbr title="dernier date">
                                        <input id="end" name="end" type="date"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 "
                                            placeholder="Select date end" value={{ $end }}>
                                    </abbr>
                                </div>
                            @else
                                <div class="relative">

                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 " aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <abbr title="premier date">
                                        <input id="start" name="start" type="date"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 "
                                            placeholder="Select date start">
                                    </abbr>
                                </div>
                                <span class="mx-4 text-gray-500">to</span>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 " aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <abbr title="dernier date">
                                        <input id="end" name="end" type="date"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 "
                                            placeholder="Select date end">
                                    </abbr>
                                </div>
                            @endif
                            </div>
                            <abbr title="filtre  par bar de recherch et date">
                                <button type="submit" name="action" value="search"
                                    class="desc inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>Search
                                </button>
                            </abbr>
                        </div>
                    </div>
                </form>
            </div>
            @if (count($marchandises) > 0)
                <div class="overflow-x-auto relative shadow-md w-full sm:rounded-lg mb-10">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                            <tr>
                                <th scope="col" class="py-3 px-1 text-center">image</th>
                                <th scope="col" class="py-3 px-1 text-center ">nom</th>
                                <th scope="col" class="py-3 px-1 text-center hidden sm:block">code QR</th>
                                <th scope="col" class="py-3 px-1 text-center ">categorie</th>
                                <th scope="col" class="py-3 px-1 text-center ">quantite</th>
                                <th scope="col" class="py-3 px-1 text-center">entre</th>
                                <th scope="col" class="py-3 px-1 text-center">sortie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($marchandises as $marchandise)
                                <tr class="bg-white border-b hover:bg-gray-200 hover:text-black ">
                                    <td class="py-4 px-6 text-center">
                                        @if (isset($marchandise->image) && $marchandise->image !== null)
                                            <img class="image w-10 h-10 rounded-full bg-cover"
                                                src="{{ asset('/storage/' . $marchandise->image) }}"
                                                alt="" />
                                        @else
                                            <img class="image w-10 h-10 rounded-full bg-cover"
                                                src="{{ asset('/logo.jpg') }}" alt="" />
                                        @endif

                                    </td>
                                    <td class="py-4 px-1 text-center  ">{{ $marchandise->nom }}</td>
                                  
                                    <td class=" justify-center py-4 px-1 hidden sm:block ">
                                        {!! QrCode::size(40)->generate(" le nom: ".$marchandise->nom."\n categorie: ".$marchandise->categories->nom."\n quantite: ".$marchandise->quantite) !!}
                                        
                                        </td>
                                    
                                    <td class="py-4 px-1 text-center ">
                                        @if ($marchandise->categories)
                                            {{ $marchandise->categories->nom }}
                                        @else
                                            {{ $marchandise->categories }}
                                        @endif
                                    </td>
                                    <td class="py-4 px-1 text-center ">{{ $marchandise->solde }}</td>
                                    <td class="py-4 px-1 text-center ">
                                        {{ $marchandise->entres }}
                                    </td>
                                    <td class="py-4 px-1 text-center ">
                                        {{ $marchandise->sorties }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <h2 class="text-gray-300 text-xl sm:text-8xl select-none text-center mt-32">aucune marchendise</h2>
            @endif
            <script>
                function warnning(id) {
                    document.getElementById('deleteGroupModal').classList.remove('hidden');
                    const deleteGroupIdInput = document.getElementById('deleteGroupId');
                    // Set the hidden input field's value to the retrieved group ID
                    deleteGroupIdInput.value = id;
                    document.getElementById('cont').classList.add('blur-sm');
                    document.getElementById('cont').classList.add('pointer-events-none');
                }
            </script>
            <script>
                function hide() {
                    document.getElementById('deleteGroupModal').classList.add('hidden');
                    document.getElementById('cont').classList.remove('blur-sm');
                    document.getElementById('cont').classList.remove('pointer-events-none');
                }
            </script>
            <script>
                function warnning2(id, id_mar) {
                    document.getElementById('ajoutEtnte').classList.remove('hidden');
                    document.getElementById('cont').classList.add('blur-sm');
                    document.getElementById('cont').classList.add('pointer-events-none');

                    // Update hidden inputs
                    document.getElementById('id_en').value = id;
                }

                function hide2() {
                    document.getElementById('ajoutEtnte').classList.add('hidden');
                    document.getElementById('cont').classList.remove('blur-sm');
                    document.getElementById('cont').classList.remove('pointer-events-none');
                }
            </script>
            <script>
                function warnning3(id, id_mar) {
                    document.getElementById('ajoutSortier').classList.remove('hidden');
                    document.getElementById('cont').classList.add('blur-sm');
                    document.getElementById('cont').classList.add('pointer-events-none');

                    // Update hidden inputs
                    document.getElementById('id_sor').value = id;
                }

                function hide3() {
                    document.getElementById('ajoutSortier').classList.add('hidden');
                    document.getElementById('cont').classList.remove('blur-sm');
                    document.getElementById('cont').classList.remove('pointer-events-none');
                }
            </script>
            <script>
                document.getElementById('start').addEventListener('change', function() {
                    var startDate = this.value;
                    document.getElementById('end').setAttribute('min', startDate);
                });

                document.getElementById('end').addEventListener('change', function() {
                    var endDate = this.value;
                    document.getElementById('start').setAttribute('max', endDate);
                });

                document.getElementById('start').addEventListener('input', function() {
                    var startDate = this.value;
                    document.getElementById('end').setAttribute('min', startDate);
                });

                document.getElementById('end').addEventListener('input', function() {
                    var endDate = this.value;
                    document.getElementById('start').setAttribute('max', endDate);
                });
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const qrCodeContainer = document.getElementById('qrCodeContainer');
        
                    qrCodeContainer.addEventListener('click', function() {
                        this.classList.toggle('enlarged');
                    });
                });
            </script>
            {{ $marchandises->links() }}
        </div>
</x-nav-bar>
