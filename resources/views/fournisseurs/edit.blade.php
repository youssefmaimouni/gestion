<x-bar-nav>
    <div class="mb-48 bg-gray-100">
        <main>
            <div class="mx-4">
                <div class="bg-gray-50 border border-gray-200 shadow-md p-10 rounded max-w-lg mx-auto mt-24">
                    <header class="text-center">
                        <h2 class="text-3xl font-bold uppercase mb-1">
                            Modifier un fournisseur
                        </h2>
                    </header>
    
                    <form action="{{ route('fournisseurs.update',$fournisseur) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                       @method('PUT')
                        <div class="mb-6">
                            <label for="title" class="inline-block text-lg mb-2">Nom du fournisseur </label>
                            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="nom" value="{{$fournisseur->nom}}"
                            placeholder="nom"  />
                            @error('nom')
                            <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="title" class="inline-block text-lg mb-2">telephone</label>
                            <input type="number" class="border border-gray-200 rounded p-2 w-full" name="telephone" value="{{$fournisseur->telephone}}"
                            placeholder="title"  />
                            @error('telephone')
                            <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="title" class="inline-block text-lg mb-2">adresse</label>
                            <textarea name="adresse" id="" class="border border-gray-200 rounded p-2 w-full h-52" value="{{$fournisseur->adresse}}" placeholder="description"></textarea>
                            @error('adresse')
                            <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="title" class="inline-block text-lg mb-2">email</label>
                            <input type="number" class="border border-gray-200 rounded p-2 w-full" name="email" value="{{$fournisseur->email}}"
                            placeholder="title"  />
                            @error('email')
                            <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="title" class="inline-block text-lg mb-2">num fiscal</label>
                            <input type="text" class="border border-gray-200 rounded p-2 w-full" name="num_fiscal" value="{{$fournisseur->num_fiscal}}"
                                placeholder="title"  />
                            @error('num_fiscal')
                            <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="categorie" class="inline-block text-lg mb-2"> cordonnées bancaire </label>
                            <input type="text" id="writeIn" class="border border-gray-200 rounded mt-2 p-2 w-full" name="compt_bancaire" value="{{$fournisseur->compt_bancaire}}" placeholder="Nouvelle Catégorie"  />
                            @error('compt_bancaire')
                            <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="title" class="inline-block text-lg mb-2">remarque</label>
                            <textarea name="remarque" id="" class="border border-gray-200 rounded p-2 w-full h-52" value="{{$fournisseur->remarque}}" placeholder="description"></textarea>
                            @error('remarque')
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
            </div>
        </main>
    </div>
    <script>
        const select = document.getElementById('categorier');
        const writeIn = document.getElementById('writeIn');
    
        select.addEventListener('change', function() {
        if (select.value === '-1') {
            writeIn.type="text"
        } else {
            writeIn.type="hidden"
        }
        });
    </script>
    <script>
        const img = document.querySelector('#photo');
        const file = document.querySelector('#fileToUpload');
        file.addEventListener('change', function () {
            const choosedFile = this.files[0];
    
            if (choosedFile) {
    
                const reader = new FileReader();
    
                reader.addEventListener('load', function () {
                    img.setAttribute('src', reader.result);
                    img.setAttribute('style', "background-image: url('" + reader.result + "')");
                });
    
                reader.readAsDataURL(choosedFile);
    
            }
        });
    </script>
    </x-bar-nav>