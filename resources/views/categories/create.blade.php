<x-nav-bar>
    <div class="h-full w-full flex justify-center items-center">

        
        <div class="w-full max-w-md p-6 bg-white rounded-lg  shadow-md">
            
            <h1 class="text-2xl font-bold text-gray-700 mb-6">Ajouter une Categorie</h1>
            @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-200 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom :</label>
                    <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <button type="submit" class="px-4 py-2  bg-blue-500 text-white font-semibold rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Ajouter</button>
            </form>
        </div>
    </div>
    </x-nav-bar>