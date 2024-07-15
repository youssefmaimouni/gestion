<x-nav-bar>
    {{-- <div class="fixed font-mon bg-slate-200 grid hidden rounded-md shadow-md z-50" id="deleteGroupModal"
         style="width: 400px; justify-items: center; align-content: space-evenly; height: 200px; left: 50%; top:50%; transform: translate(-50%, -50%);" tabindex="-1"
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
                </g>
            </svg>
            <h5 class="font-semibold text-lg" id="deleteGroupModalLabel">Confirmation </h5>
        </div>
        <div class="text-sm text-gray-900">
            Êtes-vous sûr de vouloir supprimer cette opération?
        </div>
        <div class="flex w-2/3 justify-around">
            <button type="button" class="btn btn-secondary" onclick="hide()" data-bs-dismiss="modal">Annuler</button>
            <form action="/entres/delete" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" id="deleteGroupId" value="">
                <button type="submit" class="bg-red-500 text-white p-2 rounded-sm hover:scale-110 hover:bg-red-400">retirer</button>
            </form>
        </div>
    </div> --}}
    <style>
        .deleteGroupModal{
            width: 800px;
            height: 250px;
            justify-items: center;
            align-content: space-evenly ;
            left: 50%; top:50%;
        transform: translate(-50%, -50%);
        tabindex="-1";
        }
        @media(max-width: 640px){
    .deleteGroupModal{
        width: 400px;
        height: auto;
    }
}
        </style>
    <div class="fixed font-mon bg-white grid hidden rounded-md shadow-md  deleteGroupModal  z-50" id="deleteGroupModal"
        aria-labelledby="deleteGroupModalLabel" aria-hidden="true">
        <div class="grid justify-items-center w-full">
            <form action="/entres/delete" method="POST" class="p-6 w-full">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Confirmation de la suppression') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Êtes-vous sûr de vouloir supprimer cette marchendise?') }}
                </p>

                <div class="mt-6">
                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                    <x-text-input  name="current_password" type="password" class="mt-1 block w-3/4"
                        placeholder="{{ __('Password') }}" />
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" id="err" />
                </div>
                <input type="hidden" name="id" id="deleteGroupId" value="">
                <div class="mt-6 flex justify-end">
                    <x-secondary-button onclick="hide()">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <button type="submit" class=' ms-3 inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150'id="sub">retirer</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="text-sm font-medium text-center text-gray-500 border-gray-200 dark:text-gray-400 dark:border-gray-700" id='cont'>
        <div class="container  w-full">
            <!-- Error Message -->
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                    role="alert">
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
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                    role="alert">
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
            @if ($errors->userDeletion->get('current_password'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-1 rounded relative" role="alert">
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
        <ul class="flex flex-wrap -mb-px">
            <li class="me-2">
                <a href="{{ route('categories.entre_sortie', $categories) }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Tous</a>
            </li> 
            <li class="me-2">
                <a href="{{ route('categories.entre', $categories) }}" class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500" aria-current="page">Entrés</a>
            </li>
            <li class="me-2">
                <a href="{{ route('categories.sortie', $categories) }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Sorties</a>
            </li>
        </ul>
        
        <table class="w-full text-sm text-left text-gray-500 mb-14">
            <tbody>
                @foreach($entres as $entre)
                    <tr class="bg-white hover:bg-gray-50">
                        <td class="py-4 px-6">{{ $entre->type }}</td>
                        <td class="py-4 px-6">{{ $entre->created_at }}</td>
                        <td class="py-4 px-6">{{ $entre->nom }}</td>
                        <td class="py-4 px-6 sm:justify-center sm:space-x-4 sm:flex">
                                <button  onclick="warnning({{ $entre->id }})" class="text-red-600 hover:text-red-900">retirer</button>
                         
                            <a href="{{ route('categories.index_mar_a', $entre) }}">consulter</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

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
