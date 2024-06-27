<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier marchandise</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-xl p-5 bg-white rounded-lg shadow">
        <h1 class="text-xl font-semibold text-gray-700 mb-5">Modifier marchandise</h1>
        @if(session('success'))
            <div class="mb-4 text-sm text-green-600 bg-green-100 border border-green-200 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('marchandises.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <center>
                    <label for="fileToUpload">
                        <div class="profile-pic" id="photo" style="background-image: url('logo.jpg')">
                            <!-- <span class="glyphicon glyphicon-camera"></span> -->
                            <span>Add Image</span>
                        </div>
                    </label>
                </center>
            </div>
            <input type="File" name="image" accept="image/png, image/gif, image/jpeg,image/jpg" id="fileToUpload">
            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2">Nom du marchandise </label>
                <input type="text" class="border  border-gray-200 rounded p-2 w-full" value="{{ $marchandise->nom }}" name="nom"
                placeholder="title"  />
                @error('nom')
                <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2">Code barre</label>
                <input type="number" class="border border-gray-200 rounded p-2 w-full"  value="{{ $marchandise->barre_code }}" name="barre_code"
                placeholder="title"  />
                @error('barre_code')
                <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2">description</label>
                <textarea name="description" id=""  value="{{ $marchandise->description }}" class="border border-gray-200 rounded p-2 w-full h-52" placeholder="description"></textarea>
                @error('description')
                <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2">quantite</label>
                <input type="number"  value="{{ $marchandise->quantite }}" class="border border-gray-200 rounded p-2 w-full" name="quantite"
                placeholder="title"  />
                @error('quantite')
                <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2">unité</label>
                <input type="text" value="{{ $marchandise->unite }}" class="border   border-gray-200 rounded p-2 w-full" name="unite"
                    placeholder="title"  />
                @error('unite')
                <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label for="categorie" class="inline-block text-lg mb-2">Catégorie </label>
                <select name="categorie" value="{{ $marchandise->categorie}}" class="border border-gray-200 rounded p-2 w-full" id="categorie">
                    @foreach ($categorie as $item)
                    <option value="{{$item->id}}">{{$item->nom}} </option>
                    @endforeach
                    <option value="-1">Autre </option>
                </select>
                <input type="hidden" id="writeIn" class="border border-gray-200 rounded mt-2 p-2 w-full" name="new_cat" placeholder="Nouvelle Catégorie"  />
                @error('categorie')
                <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-6">
                <button class="bg-blue-500 text-white rounded py-2 px-4 hover:bg-gray-600 text-lg">
                    Soumettre
                </button>
            </div>
        </form>
    </div>
</body>
</html>
