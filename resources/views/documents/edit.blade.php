<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Magasin</title>
    @vite('resources/css/app.css')
    @include('layouts.navigation')
</head>
<body>
<div class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-xl p-5 bg-white rounded-lg shadow">
        <h1 class="text-xl font-semibold text-gray-700 mb-5">Modifier Magasin</h1>
        @if(session('success'))
            <div class="mb-4 text-sm text-green-600 bg-green-100 border border-green-200 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('magazins.update', $magazin) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom:</label>
                <input type="text" id="nom" name="nom" value="{{ $magazin->nom }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="flex items-center">
                <input type="checkbox" id="cacher" name="cacher" {{ $magazin->cacher ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="cacher" class="ml-2 block text-sm text-gray-900">Cacher</label>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Enregistrer les modifications</button>
        </form>
    </div>
</div>
</body>
</html>
