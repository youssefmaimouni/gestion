<x-nav-bar>
    <div class=" flex">
        <p class="text-2xl w-2/3 m-3 pl-6 underline underline-offset-4">categories</p>
        <p class="text-xl w-1/3  m-3 pl-6"><a href="{{ route('categories.create') }}" class="text-blue-600 hover:text-blue-900">Ajouter categorie</a> </p>
    </div>
    
    <div class="center-modal bg-white  rounded-lg shadow-lg">
        
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
                    <tr class="bg-white border-b hover:bg-gray-50" >
                        <td class="py-4 px-6">{{ $categorie->nom }}</td>
                        <td class="py-4 px-6">
                            <form action="{{ route('categories.delete', $categorie) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                            </form>
                            <a href="{{ route('categories.edit', $categorie) }}" class="text-blue-600 hover:text-blue-900 ml-4">Modifier</a>
                            <a  href="{{ route('categories.index_mar', $categorie) }}"class="text-blue-600 hover:text-blue-900 ml-4">consulter</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-nav-bar>