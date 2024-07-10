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
                    <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email" value="{{old('email')}}" placeholder="Name@email.com" />
                    <!-- Error Example -->
                    @error('email')
                    <p class="text-red-500 text-xs w-80 mt-1">{{$message}} </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="inline-block text-lg mb-2">
                        Mot de passe
                    </label>
                    <div class="relative cursor-pointer">
                        <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password" id="password" placeholder="password"  class="text-md block px-3 py-2 rounded-lg w-full 
                      bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md
                      focus:placeholder-gray-500
                      focus:bg-white 
                      focus:border-gray-600  
                      focus:outline-none">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 " onclick="myFunction()">
      
                          <svg id="show" class="h-6 text-gray-700 bg-white" fill="none" xmlns="http://www.w3.org/2000/svg"
                            viewbox="0 0 576 512">
                            <path fill="currentColor"
                              d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                            </path>
                          </svg>
      
                          <svg id="notshow" class="hidden h-6 text-gray-700 bg-white" fill="none" xmlns="http://www.w3.org/2000/svg"
                            viewbox="0 0 640 512">
                            <path fill="currentColor"
                              d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                            </path>
                          </svg>
      
                        </div>
                    </div>
                    @error('password')
                    <p class="text-red-500 text-xs w-80 mt-1">{{$message}} </p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password2" class="inline-block text-lg mb-2">
                        Confirmez le mot de passe
                    </label>
                    <input type="password" class="border border-gray-200 rounded p-2 w-full"
                        name="password_confirmation" placeholder="password" />
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
    <script>
        function myFunction() {
            var x = document.getElementById("password"); 
            var show = document.getElementById("show"); 
            var notshow = document.getElementById("notshow"); 
            if (x.type === "password") {
                x.type = "text";
                show.classList.toggle('hidden');
                notshow.classList.toggle('hidden');
            } else {
                x.type = "password";
                show.classList.toggle('hidden');
                notshow.classList.toggle('hidden');
            }
        }
    </script>
</x-nav-bar>