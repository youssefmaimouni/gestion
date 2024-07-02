<x-nav-bar>
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
            Êtes-vous sûr de vouloir supprimer cette categorie?
        </div>
        <div class="flex w-2/3 justify-around">
            <button type="button" class="btn btn-secondary" onclick="hide()"
                data-bs-dismiss="modal">Annuler</button>
            <form action="/categories/delete" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" id="deleteGroupId" value="">
                <button type="submit"
                    class="bg-red-500 text-white p-2 rounded-sm hover:scale-110 hover:bg-red-400">Supprimer</button>
            </form>
        </div>
    </div>
    <div class=" flex">
        <p class="text-2xl w-2/3 m-3 pl-6 underline underline-offset-4">categories</p>
        <p class="text-xl w-1/3  m-3 pl-6"><a href="{{ route('categories.create') }}" class="text-blue-600 hover:text-blue-900">Ajouter categorie</a> </p>
    </div>
    @if (count($categories)>0)
    <div class="center-modal bg-white  rounded-lg shadow-lg">
        
        @if(session('success'))
            <div class="p-3 mb-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        <table class="w-full text-sm text-left text-gray-500 mb-14">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-6 w-2/3">Nom du categorie</th>
                    <th scope="col" class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $categorie)
                    <tr class="bg-white border-b hover:bg-gray-50" >
                        <td class="py-4 px-6 w-2/3">{{ $categorie->nom }}</td>
                        <td class="py-4 px-6 justify-center flex">
                            <p onclick="warnning({{ $categorie->id }})"
                                class="text-red-600 hover:text-red-900 cursor-pointer">Supprimer</p>
                            <a href="{{ route('categories.edit', $categorie) }}" class="text-blue-600 hover:text-blue-900 ml-4">Modifier</a>
                            <a  href="{{ route('categories.index_mar', $categorie) }}"class="text-blue-600 hover:text-blue-900 ml-4">consulter</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <h2 class="text-gray-300 text-8xl select-none text-center mt-32">aucune categorie</h2>
    @endif
    <script>
        function warnning(id) {
            document.getElementById('deleteGroupModal').classList.remove('hidden');
            const deleteGroupIdInput = document.getElementById('deleteGroupId');
            
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
</x-nav-bar>