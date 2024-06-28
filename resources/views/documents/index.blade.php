<x-nav-bar>
    <div class=" flex">
        <p class="text-2xl w-2/3 m-3 pl-6 underline underline-offset-4">marchandises</p>
        <p class="text-xl w-1/3  m-3 pl-6"><a href="/marchandises/create" class="text-blue-600 hover:text-blue-900">Ajouter Marchendise</a> </p>
    </div>
    <div class="center-modal bg-white p-4 rounded-lg shadow-lg">
        <h1 class="text-lg font-bold text-gray-700 mb-4">Liste des Magazins</h1>
        @if(session('success'))
            <div class="p-3 mb-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        <table class="w-full text-sm text-left text-gray-500 mb-14">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-6">Nom du Magazin</th>
                    <th scope="col" class="py-3 px-6">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($magazins as $magazin)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="py-4 px-6">{{ $magazin->nom }}</td>
                        <td class="py-4 px-6">
                            <form action="{{ route('magazins.delete', $magazin) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                            </form>
                            <a href="{{ route('magazins.edit', $magazin) }}" class="text-blue-600 hover:text-blue-900 ml-4">Modifier</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('magazins.create') }}" class="px-4 py-2  bg-blue-500 text-white font-semibold rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 ml-96">ajouter</a>
    </div>
</x-nav-bar>
