<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Magasin</title>
    @vite('resources/css/app.css')
</head>
<body>
@include('layouts.navigation')
<div class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-700 mb-6">Ajouter un Magasin</h1>
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-200 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('magazins.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom :</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="flex items-center">
                <input type="hidden" name="cacher" value="false">
                <input type="checkbox" id="cacher" name="cacher" {{ old('cacher') ? 'checked' : '' }} value="true" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="cacher" class="ml-2 block text-sm text-gray-900">Cacher :</label>
            </div>
            <button type="submit" class="px-4 py-2  bg-blue-500 text-white font-semibold rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Ajouter</button>
        </form>
    </div>
</div>
</body>
</html>
