<x-nav-bar>
    <div class="mx-4">
        <div class="container  w-full">
            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <strong class="font-bold">Succès!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

        </div>
        <div class="bg-gray-50 shadow-lg  p-10 rounded max-w-lg mx-auto mt-4">
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">
                    REGISTRE
                </h2>
                <p class="mb-4">Créer un compte</p>
            </header>

            <form action="/register" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="name" class="inline-block text-lg mb-2">
                        Nom
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name" value="{{old('name')}}" placeholder="Nom"/>
                    @error('name')
                    <p class="text-red-500 text-xs w-80 mt-1">{{$message}} </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email" class="inline-block text-lg mb-2">Email</label>
                    <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email" value="{{old('email')}}" placeholder="Name@emil.com" />
                    <!-- Error Example -->
                    @error('email')
                    <p class="text-red-500 text-xs w-80 mt-1">{{$message}} </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="inline-block text-lg mb-2">
                        Mot de passe
                    </label>
                    <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password" placeholder="••••••••" />
                    @error('password')
                    <p class="text-red-500 text-xs w-80 mt-1">{{$message}} </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password2" class="inline-block text-lg mb-2">
                        Confirmez le mot de passe
                    </label>
                    <input type="password" class="border border-gray-200 rounded p-2 w-full"
                        name="password_confirmation" placeholder="••••••••" />
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs w-80 mt-1">{{$message}} </p>
                    @enderror 

                </div>
                <div class="mb-6">
                    <div class="flex w-full m-auto items-center">
                        <p class="w-full inline-block text-lg">Rôle:</p>
                        <div class="w-full">
                            <label for="A">Admin</label>
                            <input type="radio" id='A' class="border border-gray-200 rounded p-2" name="role" value="A" />
                        </div>
                        <div class="w-full">
                            <label for="S">Super Admin</label>
                            <input type="radio" id='S' class="border border-gray-200 rounded p-2" name="role" value="S" />
                        </div>
                    </div>
                    @error('role')
                        <p class="text-red-500 text-xs w-80 mt-1">{{$message}} </p>
                    @enderror 
                </div>

                <div class="mb-6">
                    <button type="submit" class="bg-blue-700 text-white rounded py-2 px-4 hover:bg-black">
                        S'inscrire
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-nav-bar>