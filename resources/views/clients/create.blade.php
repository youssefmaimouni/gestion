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

<div class="mb-48 bg-gray-100">
    <main>
        <div class="mx-4">
            <div class="bg-gray-50 border border-gray-200 shadow-md p-10 rounded max-w-lg mx-auto mt-3">
                <header class="text-center">
                    <h2 class="text-3xl font-bold uppercase mb-1">
                        Ajouter un client
                    </h2>
                </header>

                <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                   
                    <div class="mb-6">
                        <label for="title" class="inline-block text-lg mb-2">Nom du client </label>
                        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="nom"
                        placeholder="nom"  />
                        @error('nom')
                        <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="title" class="inline-block text-lg mb-2">telephone</label>
                        <input type="number" class="border border-gray-200 rounded p-2 w-full" name="telephone"
                        placeholder="title"  />
                        @error('telephone')
                        <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="title" class="inline-block text-lg mb-2">adresse</label>
                        <textarea name="adresse" id="" class="border border-gray-200 rounded p-2 w-full h-52" placeholder="description"></textarea>
                        @error('adresse')
                        <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="title" class="inline-block text-lg mb-2">email</label>
                        <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email"
                        placeholder="title"  />
                        @error('email')
                        <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="title" class="inline-block text-lg mb-2">num fiscal</label>
                        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="num_fiscal"
                            placeholder="title"  />
                        @error('num_fiscal')
                        <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="categorie" class="inline-block text-lg mb-2"> cordonnées bancaire </label>
                        <input type="text" id="writeIn" class="border border-gray-200 rounded mt-2 p-2 w-full" name="compt_bancaire" placeholder="Nouvelle Catégorie"  />
                        @error('compt_bancaire')
                        <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="categorie" class="inline-block text-lg mb-2"> remise </label>
                        <input type="text" id="writeIn" class="border border-gray-200 rounded mt-2 p-2 w-full" name="remise" placeholder="Nouvelle Catégorie"  />
                        @error('remise')
                        <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="title" class="inline-block text-lg mb-2">remarque</label>
                        <textarea name="remarque" id="" class="border border-gray-200 rounded p-2 w-full h-52" placeholder="description"></textarea>
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
</x-nav-bar>