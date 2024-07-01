<x-bar-nav>

    <div class="mb-48 bg-gray-100">
        <main>
            <div class="mx-4">
                <div class="bg-gray-50 border border-gray-200 shadow-md p-10 rounded max-w-lg mx-auto mt-24">
                    <header class="text-center">
                        <h2 class="text-3xl font-bold uppercase mb-1">
                            Ajouter une Entree
                        </h2>
                    </header>
                    <form action="{{ route('entres.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-6">
                            <label for="attachement" class="inline-block text-lg mb-2">Attachment</label><br>
                            <input type="File" name="attachments" accept="image/png, image/gif, image/jpeg, image/jpg, application/pdf" id="attachement">
                            @error('attachement')
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
                            <label for="remise" class="inline-block text-lg mb-2">Remise</label>
                            <input type="number" class="border border-gray-200 rounded p-2 w-full" name="remise" id="remise" />
                            @error('remise')
                                <p class="text-red-500 test-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="id_client" class="inline-block text-lg mb-2">client </label>
                            <select name="id_client" class="border border-gray-200 rounded p-2 w-full"
                                id="fournisseur">
                                @foreach ($clients as $item)
                                    <option value="{{ $item->id }}">{{ $item->nom }} </option>
                                @endforeach
                                <option value="">Autre </option>
                            </select>
                            @error('id_client')
                                <p class="text-red-500 test-xs mt-1">{{ $message }}</p>
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
                writeIn.type = "text"
            } else {
                writeIn.type = "hidden"
            }
        });
    </script>
    <script>
        const img = document.querySelector('#photo');
        const file = document.querySelector('#fileToUpload');
        file.addEventListener('change', function() {
            const choosedFile = this.files[0];

            if (choosedFile) {

                const reader = new FileReader();

                reader.addEventListener('load', function() {
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
</x-bar-nav>
