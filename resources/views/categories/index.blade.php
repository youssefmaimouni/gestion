<x-nav-bar>
    <div class=" flex">
        <p class="text-2xl w-2/3 m-3 pl-6 underline underline-offset-4">categories</p>
        <p class="text-xl w-1/3  m-3 pl-6"><a href="{{ route('categories.create') }}" class="text-blue-600 hover:text-blue-900">Ajouter categorie</a> </p>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto  ">
          

            <div class=" gap-3 grid grid-cols-2 sm:grid-cols-3 justify-items-center ml-1">
            @foreach($categories as $categorie)
               <a href="{{ route('categories.entre_sortie', $categorie) }}" class="h-52 w-full bg-white shadow-lg hover:bg-gray-50 rounded border min-w-20  flex items-center flex-col   text-center justify-center">
                <svg width="60px" height="60px" viewBox="0 0 24 24" fill="none" class="mt-2"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M4 19V6.2C4 5.0799 4 4.51984 4.21799 4.09202C4.40973 3.71569 4.71569 3.40973 5.09202 3.21799C5.51984 3 6.0799 3 7.2 3H16.8C17.9201 3 18.4802 3 18.908 3.21799C19.2843 3.40973 19.5903 3.71569 19.782 4.09202C20 4.51984 20 5.0799 20 6.2V17H6C4.89543 17 4 17.8954 4 19ZM4 19C4 20.1046 4.89543 21 6 21H20M9 7H15M9 11H15M19 17V21"
                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
                <p class="text-center text-black text-2xl ">{{ $categorie->nom }}</p><br>
                <div class="justify-between gap-1 flex min-w-1/3"><p>entré:{{ $categorie->total_achetes }}</p>  
                <p>sortié:{{ $categorie->total_vendus }} </p></div>
               </a>
               
               @endforeach
            </div>
        </div>
    </div>
    {{-- <div class="center-modal bg-white p-4 rounded-lg shadow-lg">
        
        @if(session('success'))
            <div class="p-3 mb-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        <table class="w-full text-sm text-left text-gray-500 mb-14">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-6">Nom du categorie</th>
                    <th scope="col" class="py-3 px-6">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $categorie)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="py-4 px-6">{{ $categorie->nom }}</td>
                        <td class="py-4 px-6">
                            <form action="{{ route('categories.delete', $categorie) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                            </form>
                            <a href="{{ route('categories.edit', $categorie) }}" class="text-blue-600 hover:text-blue-900 ml-4">Modifier</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('categories.create') }}" class="px-4 py-2  bg-blue-500 text-white font-semibold rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 ml-96">ajouter</a>
    </div> --}}
</x-nav-bar>
