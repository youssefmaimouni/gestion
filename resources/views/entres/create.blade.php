<x-nav-bar>

    <div class="mb-48 bg-gray-100">
        <main>
            <div class="mx-4">
                <div class="bg-gray-50 border border-gray-200 shadow-md p-10 rounded max-w-lg mx-auto mt-3">
                    <header class="text-center">
                        <h2 class="text-3xl font-bold uppercase mb-1">
                            Ajouter entré
                        </h2>
                    </header>

                    <form action="{{ route('entres.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-6">
                            <label for="attachement" class="inline-block text-lg mb-2">Attachment</label><br>
                            <input type="File" name="attachments" accept="image/png, image/gif, image/jpeg, image/jpg, application/pdf" id="attachement">
                            @error('attachments')
                                <p class="text-red-500 test-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="date_doc" class="inline-block text-lg mb-2">Date du Document</label>
                            <input type="date" class="border border-gray-200 rounded p-2 w-full" name="date_doc" id="date_doc" />
                            @error('date_doc')
                                <p class="text-red-500 test-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="tite" class="inline-block text-lg mb-2">Description du site Web</label>
                            <textarea name="description" id="" class="border border-gray-200 rounded p-2 w-full h-52" placeholder="description"></textarea>
                            @error('description')
                                <p class="text-red-500 test-xs mt-1">{{$message}}</p>
                            @enderror                    
                        </div>
                        <div class="mb-6">
                            <label for="id_four" class="inline-block text-lg mb-2">fournisseur </label>
                            <select name="id_four" class="border border-gray-200 rounded p-2 w-full"
                                id="fournisseur">
                                @foreach ($fournisseurs as $item)
                                    <option value="{{ $item->id }}">{{ $item->nom }} </option>
                                @endforeach
                                <option value="">Autre </option>
                            </select>
                            @error('id_four')
                                <p class="text-red-500 test-xs mt-1">{{ $message }}</p>
                            @enderror
                            <label for="id_cat" class="inline-block text-lg mb-2">categorie </label>
                            <select name="id_cat" class="border border-gray-200 rounded p-2 w-full"
                            id="id_cat">
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->nom }} </option>
                            @endforeach
                        </select>
                            @error('id_cat')
                                <p class="text-red-500 test-xs mt-1">{{ $message }}</p>
                            @enderror
                    </div>
                      
                    <input type="hidden" id="selectedCategory" name="selectedCategory" value="">

                        <div class="mb-6">
                            <button type="submit" class="bg-blue-500 text-white rounded py-2 px-4 hover:bg-gray-600 text-lg">
                                Soumettre
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script>
        const select = document.getElementById('cat');
        const selectedCategoryInput = document.getElementById('selectedCategory');

        select.addEventListener('change', function() {
            selectedCategoryInput.value = select.value;
        });

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
    <script>
        // Get today's date in the format YYYY-MM-DD
        const today = new Date().toISOString().split('T')[0];
      
        // Set the value of the date input field to today's date
        document.getElementById('date_doc').value = today;
      </script>   
</x-nav-bar>
