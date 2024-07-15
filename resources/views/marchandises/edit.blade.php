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
            /* color: black; */
            padding-top: 4.5em;
            padding-bottom: 4.5em;
        }
    
        form input[type="file"] {
            display: none;
            cursor: pointer;
        }
    </style>
    
    <div class=" bg-gray-100">
        <main>
            <div class="mx-4">
                <div class="bg-gray-50 border border-gray-200 shadow-md p-10 rounded max-w-lg mx-auto mt-4">
                    <header class="text-center">
                        <h2 class="text-3xl font-bold uppercase mb-1">
                            Ajouter une Marchendise
                        </h2>
                    </header>
    
                    <form action="{{ route('marchandises.update',$marchandise) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <center>
                                <label for="fileToUpload">
                                    {{-- @dd($site->logo) --}}
                                        <div class="profile-pic" id="photo" style="background-image: url('/logo.jpg')">
                                            <!-- <span class="glyphicon glyphicon-camera"></span> -->
                                            <span>Changer Image</span>
                                        </div>
                                </label>
                            </center>
                        </div>
                        <input type="File" name="image" accept="image/png, image/gif, image/jpeg,image/jpg" value="$marchandise->image" id="fileToUpload">
                        <div class="mb-6">
                            <label for="title" class="inline-block text-lg mb-2">Nom du marchandise </label>
                            <input type="text" class="border border-gray-200 rounded p-2 w-full" value="{{ $marchandise->nom }}" name="nom"
                            placeholder="title"  />
                            @error('nom')
                            <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        {{-- <div class="mb-6">
                            <label for="title" class="inline-block text-lg mb-2">Code barre</label>
                            <input type="number" class="border border-gray-200 rounded p-2 w-full" value="{{ $marchandise->barre_code }}" name="barre_code"
                            placeholder="Code barre"  />
                            @error('barre_code')
                            <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                            @enderror
                        </div> --}}
                        <div class="mb-6">
                            <label for="title" class="inline-block text-lg mb-2">description</label>
                            <textarea name="description" id="" class="border border-gray-200 rounded p-2 w-full h-52"  placeholder="description">{{ $marchandise->description }}</textarea>
                            @error('description')
                            <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="categorie" class="inline-block text-lg mb-2">Catégorie</label>
                            <select name="categorie" class="border border-gray-200 rounded p-2 w-full"    id="selectOption">
                                @foreach ($categorie as $item)
                                    @if ($marchandise->id_cat==$item->id)
                                    <option value="{{$item->id}}" selected>{{$item->nom}}</option>
                                    @else
                                    <option value="{{$item->id}}">{{$item->nom}}</option>
                                    @endif
                                @endforeach
                                <option value="add">ajouter categorie</option>
                            </select>
                            <div id="inputForm" class="hidden">
                                <label for="newCategorie" class="inline-block text-lg mb-2">Nouvelle catégorie</label>
                                <input type="text" id="newCategorie" name="new_categorie" class="border border-gray-200 rounded p-2 w-full" placeholder="Nouvelle catégorie">
                            </div>
                            @error('categorie')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
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

        document.getElementById('selectOption').addEventListener('change', function () {
            const inputForm = document.getElementById('inputForm');
            if (this.value === 'add') {
                inputForm.classList.remove('hidden');
            } else {
                inputForm.classList.add('hidden');
            }
        });
    </script>
    </x-nav-bar>