<x-nav-bar>

    <div id="cont" class="">
        <div class="">
            <div class="w-full">
                <p class="text-2xl w-full m-3 pl-6 underline underline-offset-4">Rapport</p>

                <form method="GET" action="/rapports/search" class="max-w-full my-1">
                    <div class="flex  justify-between">
                        <div class="relative">
                            @if (isset($search))
                                <input type="search" name="search" id="default-search" value={{ $search }}
                                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500  "
                                    placeholder="Rechercher Marchandises,Categories ..."  />
                            @else
                                <input type="search" name="search" id="default-search"
                                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500  "
                                    placeholder="Rechercher"  />
                            @endif
                            <button type="submit"
                                class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 "><svg
                                    class="w-4 h-4 text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg></button>
                        </div>
                    <div id="date-range-picker" date-rangepicker class="flex items-center mb-1">
                        @if (isset($start)&&isset($end))
                        <div class="relative">

                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 " aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="start" name="start" type="date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 "
                                placeholder="Select date start" value={{$start}}>
                        </div>
                        <span class="mx-4 text-gray-500">to</span>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 " aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="end" name="end" type="date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 "
                                placeholder="Select date end" value={{$end}}>
                        </div>
                        @else
                        <div class="relative">

                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 " aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="start" name="start" type="date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 "
                                placeholder="Select date start" >
                        </div>
                        <span class="mx-4 text-gray-500">to</span>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 " aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="end"  name="end" type="date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 "
                                placeholder="Select date end">
                        </div>
                        @endif
                        <button type="submit" class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>Search
                        </button>
                    </div>
                    </div>
                </form>
            </div>
            @if (count($marchandises) > 0)
                <div class="overflow-x-auto relative shadow-md w-full sm:rounded-lg mb-10">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                            <tr>
                                <th scope="col" class="py-3 px-6 ">image</th>
                                <th scope="col" class="py-3 px-6 ">nom</th>
                                <th scope="col" class="py-3 px-6 ">barre code</th>
                                <th scope="col" class="py-3 px-6 ">categorie</th>
                                <th scope="col" class="py-3 px-6 ">quantite</th>
                                <th scope="col" class="py-3 px-6 text-center">entre</th>
                                <th scope="col" class="py-3 px-6 text-center">sortie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($marchandises as $marchandise)
                                <tr class="bg-white border-b hover:bg-gray-200 hover:text-black ">
                                    <td class="py-4 px-6">
                                        @if (isset($marchandise->image) && $marchandise->image !== null)
                                            <img class="image w-10 h-10 rounded-full bg-cover"
                                                src="{{ asset('/storage/' . $marchandise->image) }}" alt="" />
                                        @else
                                            <img class="image w-10 h-10 rounded-full bg-cover"
                                                src="{{ asset('/logo.jpg') }}" alt="" />
                                        @endif

                                    </td>
                                    <td class="py-4 px-6  ">{{ $marchandise->nom }}</td>
                                    @if ($marchandise->barre_code)
                                        <td><abbr title="{{ $marchandise->barre_code }}"> {!! DNS1D::getBarcodeHTML($marchandise->barre_code, 'C39') !!}</abbr>
                                        </td>
                                    @else
                                        <td>Pas de code barre</td>
                                    @endif
                                    <td class="py-4 px-6 ">
                                        @if ($marchandise->categories)
                                            {{ $marchandise->categories->nom }}
                                        @else
                                            {{ $marchandise->categories }}
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 ">{{ $marchandise->solde }}</td>
                                    <td class="py-4 px-6 ">
                                        {{ $marchandise->entres }}
                                    </td>
                                    <td class="py-4 px-6 ">
                                        {{ $marchandise->sorties }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <h2 class="text-gray-300 text-8xl select-none text-center mt-32">aucune marchendise</h2>
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
                </script>
        </div>
    </div>
</x-nav-bar>
