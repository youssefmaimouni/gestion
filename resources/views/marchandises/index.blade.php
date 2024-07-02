<x-nav-bar>
    <div class="container mt-4">
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Il y avait quelques problèmes avec vos données saisies.</span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="fixed font-mon bg-slate-200 grid hidden rounded-md shadow-md z-50" id="deleteGroupModal"
        style="width: 400px; justify-items: center; align-content: space-evenly ;height: 200px; left: 50%; top:50%; transform: translate(-50%, -50%); tabindex="-1"
        aria-labelledby="deleteGroupModalLabel" aria-hidden="true">
        <div class="grid justify-items-center">
            <svg fill="#000" height="60px" width="60px" version="1.1" id="Capa_1"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 27.963 27.963" xml:space="preserve">
                <g>
                    <g id="c129_exclamation">
                        <path d="M13.983,0C6.261,0,0.001,6.259,0.001,13.979c0,7.724,6.26,13.984,13.982,13.984s13.98-6.261,13.98-13.984
                   C27.963,6.259,21.705,0,13.983,0z M13.983,26.531c-6.933,0-12.55-5.62-12.55-12.553c0-6.93,5.617-12.548,12.55-12.548
                   c6.931,0,12.549,5.618,12.549,12.548C26.531,20.911,20.913,26.531,13.983,26.531z" />
                        <polygon points="15.579,17.158 16.191,4.579 11.804,4.579 12.414,17.158 		" />
                        <path d="M13.998,18.546c-1.471,0-2.5,1.029-2.5,2.526c0,1.443,0.999,2.528,2.444,2.528h0.056c1.499,0,2.469-1.085,2.469-2.528
                    C16.441,19.575,15.468,18.546,13.998,18.546z" />
                    </g>
                    <g id="Capa_1_207_">
                    </g>
                </g>
            </svg>
            <h5 class="font-semibold text-lg" id="deleteGroupModalLabel">Confirmation de la suppression</h5>
        </div>
        <div class="text-sm text-gray-900">
            Êtes-vous sûr de vouloir supprimer cette marchendise?
        </div>
        <div class="flex w-2/3 justify-around">
            <button type="button" class="btn btn-secondary" onclick="hide()" data-bs-dismiss="modal">Annuler</button>
            <form action="/marchandises/delete" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" id="deleteGroupId" value="">
                <button type="submit"
                    class="bg-red-500 text-white p-2 rounded-sm hover:scale-110 hover:bg-red-400">Supprimer</button>
            </form>
        </div>
    </div>
    <div class="fixed font-mono bg-slate-200 grid hidden rounded-md shadow-md z-50" id="ajoutEtnte"
        style="width: 400px; justify-items: center; align-content: space-evenly; height: 300px; left: 50%; top: 50%; transform: translate(-50%, -50%);"
        tabindex="-1" aria-labelledby="deleteGroupModalLabel" aria-hidden="true">
        <div class="grid justify-items-center">
            <svg fill="#000" height="60px" width="60px" version="1.1" id="Capa_1"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 27.963 27.963" xml:space="preserve">
                <!-- SVG content omitted for brevity -->
            </svg>
            <h5 class="font-semibold text-lg" id="deleteGroupModalLabel">Quantité</h5>
            <form action="{{ route('entres.store') }}" method="POST" class="space-y-6">
                @csrf
                <!-- Hidden fields for ID and ID_CAT -->
                <input type="hidden" id="id_en" name="id_mar" value="">

                <div>
                    <label for="quantite" class="block text-sm font-medium text-gray-700">Quantité :</label>
                    <input type="number" id="quantite" name="quantite" value=0 required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('quantite')
                        <script>
                            alert('{{ $message }}'); // Show alert if there's an error
                        </script>
                    @enderror
                </div>
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Ajouter</button>
            </form>
        </div>
    </div>
    <div class="fixed font-mono bg-slate-200 grid hidden rounded-md shadow-md z-50" id="ajoutSortier"
        style="width: 400px; justify-items: center; align-content: space-evenly; height: 300px; left: 50%; top: 50%; transform: translate(-50%, -50%);"
        tabindex="-1" aria-labelledby="deleteGroupModalLabel" aria-hidden="true">
        <div class="grid justify-items-center">
            <svg fill="#000" height="60px" width="60px" version="1.1" id="Capa_1"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 27.963 27.963" xml:space="preserve">
                <!-- SVG content omitted for brevity -->
            </svg>
            <h5 class="font-semibold text-lg" id="deleteGroupModalLabel">Quantité</h5>
            <form action="{{ route('sorties.store') }}" method="POST" class="space-y-6">
                @csrf
                <!-- Hidden fields for ID and ID_CAT -->
                <input type="hidden" id="id_sor" name="id_mar" value="">

                <div>
                    <label for="quantite" class="block text-sm font-medium text-gray-700">Quantité :</label>
                    <input type="number" id="quantite" name="quantite" value=0 required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('quantite')
                        <script>
                            alert('{{ $message }}'); // Show alert if there's an error
                        </script>
                    @enderror
                </div>
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Ajouter</button>
            </form>
        </div>
    </div>
    <div id="cont" class="">
        <div class=" flex">
            <p class="text-2xl w-2/3 m-3 pl-6 underline underline-offset-4">marchandises</p>
            <p class="text-xl w-1/3  m-3 pl-6"><a href="/marchandises/create"
                    class="text-blue-600 hover:text-blue-900">Ajouter
                    Marchendise</a> </p>
        </div>
        @if (count($marchandises) > 0)
            <div class="overflow-x-auto relative shadow-md w-full sm:rounded-lg mb-10">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                        <tr>
                            <th scope="col" class="py-3 px-6 ">image</th>
                            <th scope="col" class="py-3 px-6 ">nom</th>
                            <th scope="col" class="py-3 px-6 ">barre code</th>
                            <th scope="col" class="py-3 px-6 ">categorie</th>
                            <th scope="col" class="py-3 px-6 ">quantite</th>
                            <th scope="col" class="py-3 px-6 ">description</th>
                            <th scope="col" class="py-3 px-6 text-center">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($marchandises as $marchandise)
                            <tr class="bg-white border-b hover:bg-gray-300 hover:text-black ">
                                <td class="py-4 px-6 ">
                                    @if ($marchandise->image)
                                        <img class="image w-10 h-10 rounded-full bg-cover"
                                            src="{{ asset('/storage/' . $marchandise->image) }}" alt="" />
                                    @else
                                        <img class="image w-10 h-10 rounded-full bg-cover"
                                            src="{{ url('/logo.jpg') }}" alt="" />
                                    @endif
                                </td>
                                <td class="py-4 px-6  ">{{ $marchandise->nom }}</td>
                                <td class="py-4 px-6 ">{{ $marchandise->barre_code }}</td>
                                <td class="py-4 px-6 ">
                                    @if ($marchandise->categories)
                                        {{ $marchandise->categories->nom }}
                                    @else
                                        {{ $marchandise->categories }}
                                    @endif
                                </td>
                                <td class="py-4 px-6 ">{{ $marchandise->quantite }}</td>
                                <td class="py-4 px-6 ">{{ $marchandise->description }}</td>
                                <td class="py-4 px-6 justify-between flex text-center">
                                    <p onclick="warnning2({{ $marchandise->id }})"
                                        class="text-green-400 hover:text-green-700 cursor-pointer">ajout</p>
                                        
                                        <p onclick="warnning({{ $marchandise->id }})"
                                            class="text-red-600 hover:text-red-900 cursor-pointer">Supprimer</p>
                                            <a
                                            href="/marchandises/{{ $marchandise->id }}/edit"class="text-blue-600 hover:text-blue-900 ml-4 cursor-pointer">Modifier</a>
                                            <p onclick="warnning3({{ $marchandise->id }})"
                                                class="text-green-400 hover:text-green-700 cursor-pointer">sortier</p>
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
    </div>
</x-nav-bar>
