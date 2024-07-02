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
    <div class="fixed font-mono bg-slate-200 grid hidden rounded-md shadow-md z-50" id="deleteGroupModal"
        style="width: 400px; justify-items: center; align-content: space-evenly; height: 300px; left: 50%; top: 50%; transform: translate(-50%, -50%);" tabindex="-1"
        aria-labelledby="deleteGroupModalLabel" aria-hidden="true">
        <div class="grid justify-items-center">
            <svg fill="#000" height="60px" width="60px" version="1.1" id="Capa_1"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 27.963 27.963" xml:space="preserve">
                <!-- SVG content omitted for brevity -->
            </svg>
            <h5 class="font-semibold text-lg" id="deleteGroupModalLabel">Quantité</h5>
            <form action="{{ route('vendres.store') }}" method="POST" class="space-y-6">
                @csrf
                <!-- Hidden fields for ID and ID_CAT -->
                <input type="hidden" id="id" name="id_mar" value="">
                <input type="hidden" name="id_sortie" value="{{ $sorties->id }}">

                <div>
                    <label for="quantite" class="block text-sm font-medium text-gray-700">Quantité :</label>
                    <input type="number" id="quantite" name="quantite" value="0" required
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
        <div class="flex">
            <p class="text-2xl w-2/3 m-3 pl-6 underline underline-offset-4">Marchandises</p>
        </div>
        <div class="overflow-x-auto relative shadow-md w-full sm:rounded-lg mb-10">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3 px-6">Image</th>
                        <th scope="col" class="py-3 px-6">Nom</th>
                        <th scope="col" class="py-3 px-6">Barre code</th>
                        <th scope="col" class="py-3 px-6">Quantité</th>
                        <th scope="col" class="py-3 px-6">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($marchandises as $marchandise)
                    <tr class="bg-white border-b hover:bg-gray-300 hover:text-black" onclick="warnning({{ $marchandise->id }}, {{ $marchandise->id_cat }})">
                        <td class="py-4 px-6">
                            @if ($marchandise->image)
                            <img class="image w-10 h-10 rounded-full bg-cover" src="{{ asset('/storage/' . $marchandise->image) }}" alt="" />
                            @else
                            <img class="image w-10 h-10 rounded-full bg-cover" src="{{ url('/logo.jpg') }}" alt="" />
                            @endif
                        </td>
                        <td class="py-4 px-6">{{ $marchandise->nom }}</td>
                        <td class="py-4 px-6">{{ $marchandise->barre_code }}</td>
                        <td class="py-4 px-6">{{ $marchandise->quantite }}</td>
                        <td class="py-4 px-6">{{ $marchandise->description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <script>
            function warnning(id, id_cat) {
                document.getElementById('deleteGroupModal').classList.remove('hidden');
                document.getElementById('cont').classList.add('blur-sm');
                document.getElementById('cont').classList.add('pointer-events-none');
                
                // Update hidden inputs
                document.getElementById('id').value = id;
            }

            function hide() {
                document.getElementById('deleteGroupModal').classList.add('hidden');
                document.getElementById('cont').classList.remove('blur-sm');
                document.getElementById('cont').classList.remove('pointer-events-none');
            }
        </script>
    </div>
</x-nav-bar>
