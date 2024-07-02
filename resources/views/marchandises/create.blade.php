<x-nav-bar>
    <style>
        .tabAnim {
            z-index: 1;
        }
    
        #private:checked~div {
            --tw-translate-x: 0%;
        }
    
        #public:checked~div {
            --tw-translate-x: 100%;
        }
        
        .profile-pic {
            border-radius: 50%;
            height: 150px;
            width: 150px;
            background-size: cover;
            background-position: center;
            background-blend-mode: multiply;
            vertical-align: middle;
            text-align: center;
            color: transparent;
            transition: all .3s ease;
            text-decoration: none;
            cursor: pointer;
            border: solid 1px black;
        }
    
        .profile-pic:hover {
            background-color: rgba(0, 0, 0, .5);
            z-index: 10000;
            color: #fff;
            transition: all .3s ease;
            text-decoration: none;
        }
    
        .profile-pic span {
            display: inline-block;
            padding-top: 4.5em;
            padding-bottom: 4.5em;
        }
    
        form input[type="file"] {
            display: none;
            cursor: pointer;
        }
    </style>
    
    <div class="mb-48 bg-gray-100">
        <main>
            <div class="mx-4">
                <div class="bg-gray-50 border border-gray-200 shadow-md p-10 rounded max-w-lg mx-auto mt-24">
                    <header class="text-center">
                        <h2 class="text-3xl font-bold uppercase mb-1">
                            Ajouter une Marchandise
                        </h2>
                    </header>
    
                    <form action="{{ route('marchandises.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-6">
                            <center>
                                <label for="fileToUpload">
                                    <div class="profile-pic" id="photo" style="background-image: url('/logo.jpg')">
                                        <span>Add Image</span>
                                    </div>
                                </label>
                            </center>
                        </div>
                        <input type="file" name="image" accept="image/png, image/gif, image/jpeg,image/jpg" id="fileToUpload">
                        <div class="mb-6">
                            <label for="title" class="inline-block text-lg mb-2">Nom du marchandise</label>
                            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="nom" placeholder="title"  />
                            @error('nom')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="title" class="inline-block text-lg mb-2">Code barre</label>
                            <input type="number" class="border border-gray-200 rounded p-2 w-full" name="barre_code" placeholder="title" />
                            @error('barre_code')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="title" class="inline-block text-lg mb-2">Description</label>
                            <textarea name="description" class="border border-gray-200 rounded p-2 w-full h-52" placeholder="description"></textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="categorie" class="inline-block text-lg mb-2">Catégorie</label>
                            <select name="categorie" class="border border-gray-200 rounded p-2 w-full" id="categorie">
                                @foreach ($categorie as $item)
                                    <option value="{{$item->id}}">{{$item->nom}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="writeIn" class="border border-gray-200 rounded mt-2 p-2 w-full" name="new_cat" placeholder="Nouvelle Catégorie" />
                            @error('categorie')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="title" class="inline-block text-lg mb-2">Quantité</label>
                            <input type="number" class="border border-gray-200 rounded p-2 w-full" value=0 name="quantite" placeholder="title" id="quantite" onchange="toggleEntranceFields()" />
                            @error('quantite')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div id="additionalFields" style="display: none;">
                            
                            <div class="mb-6">
                                <label for="date_doc" class="inline-block text-lg mb-2">Date du Document</label>
                                <input type="date" class="border border-gray-200 rounded p-2 w-full" name="date_doc" id="date_doc" />
                                @error('date_doc')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-6">
                                <label for="id_four" class="inline-block text-lg mb-2">Fournisseur</label>
                                <select name="id_four" class="border border-gray-200 rounded p-2 w-full" id="fournisseur">
                                    @foreach ($fournisseurs as $item)
                                        <option value="{{$item->id}}">{{$item->nom}}</option>
                                    @endforeach
                                </select>
                                @error('id_four')
                                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-6">
                            <button class="bg-blue-500 text-white rounded py-2 px-4 hover:bg-gray-600 text-lg">
                                Soumettre
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const quantiteInput = document.getElementById('quantite');
        const additionalFields = document.getElementById('additionalFields');
        const select = document.getElementById('categorie');
        const writeIn = document.getElementById('writeIn');
    
        function toggleEntranceFields() {
            const quantity = parseInt(quantiteInput.value, 10);
            additionalFields.style.display = quantity > 0 ? 'block' : 'none';
        }
    
        quantiteInput.addEventListener('change', toggleEntranceFields);
        toggleEntranceFields();
    
        select.addEventListener('change', function() {
            if (this.value === 'Autre') {
                writeIn.type = "text";
            } else {
                writeIn.type = "hidden";
            }
        });
    
        const img = document.querySelector('#photo');
        const file = document.querySelector('#fileToUpload');
        file.addEventListener('change', function () {
            const choosedFile = this.files[0];
    
            if (choosedFile) {
                const reader = new FileReader();
    
                reader.addEventListener('load', function () {
                    img.style.backgroundImage = "url('" + reader.result + "')";
                });
    
                reader.readAsDataURL(choosedFile);
            }
        });
    });
    </script>
</x-nav-bar>
    