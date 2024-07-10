<x-nav-bar>
     <div class="container  w-full">
        <!-- Warning Message -->
        @if (session('warning'))
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Attention!</strong>
                <span class="block sm:inline">{{ session('warning') }}</span>
            </div>
        @endif

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Succès!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- General Validation Errors -->

        @if ($errors->userDeletion->get('current_password'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-1 rounded relative" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Il y avait quelques problèmes avec vos données
                    saisies.</span>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
    <div class="fixed font-mon bg-white grid hidden rounded-md shadow-md z-50" id="deleteGroupModal"
        style="width: 800px; justify-items: center; align-content: space-evenly ;height: 250px; left: 50%; top:50%; transform: translate(-50%, -50%); tabindex="-1"
        aria-labelledby="deleteGroupModalLabel" aria-hidden="true">
        <div class="grid justify-items-center">
            <form method="post" action="/admin/delete" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mt-6">
                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                    <x-text-input  name="current_password" type="password" class="mt-1 block w-3/4"
                        placeholder="{{ __('Password') }}" />

                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" id="err" />
                </div>
                <input type="hidden" name="id" id="deleteGroupId" value="">
                <div class="mt-6 flex justify-end">
                    <x-secondary-button onclick="hide()">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3">
                        {{ __('Delete Account') }}
                    </x-danger-button>
                </div>
            </form>
        </div>
    </div>
    <div class="fixed font-mon bg-white p-4 mr-3 grid hidden rounded-md shadow-md z-50" id="modifPass"
        style="width: 800px; justify-items: center; align-content: space-evenly ;height: 300px; left: 50%; top:50%; transform: translate(-50%, -50%); tabindex="-1"
        aria-labelledby="deleteGroupModalLabel" aria-hidden="true">
        <div class="grid justify-items-center">
            <form method="post" action="{{ route('user.password',$user) }}" class="mt-6 space-y-6">
                @csrf
                @method('put')

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mt-6">
                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
    
                    <x-text-input
                        id="password"
                        name="current_password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="{{ __('Password') }}"
                    />
    
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>
                <input type="hidden" name="id" id="deleteGroupId" value="">
                <input type="hidden" name="password" id="pass" value="">
                <input type="hidden" name="password_confirmation" id="password_confirmation" value="">
                <div class="mt-6 flex justify-end">
                    <x-secondary-button onclick="hide2()">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <button type="submit" class="ms-3 inline-flex items-center hover:bg-blue-500 px-4 py-2 bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest   transition ease-in-out duration-150'">
                        {{ __('modifier') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div id="list" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Profile Information') }}
                            </h2>
                    
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Update your account's profile information and email address.") }}
                            </p>
                        </header>
                    
                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>
                    
                        <form method="post" action="{{ route('user.update',$user)}}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                    
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                            <div class="mb-6">
                                <div class="flex w-full m-auto items-center">
                                    <p class="w-full inline-block text-lg">Rôle:</p>
                                    <div class="w-full">
                                        <label for="A">Admin</label>
                                        <input type="radio" id='A' class="border border-gray-200 rounded p-2" name="role" value="A" {{ $user->role == 'A' ? 'checked ' : ' ' }} />
                                    </div>
                                    <div class="w-full">
                                        <label for="S">Super Admin</label>
                                        <input type="radio" id='S' class="border border-gray-200 rounded p-2" name="role" value="S" {{ $user->role == 'S' ? 'checked ' : ' ' }}/>
                                    </div>
                                </div>
                                </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                    
                                @if (session('status') === 'profile-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Update Password') }}
                        </h2>
                
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Ensure your account is using a long, random password to stay secure.') }}
                        </p>
                    </header>
                
                    <div class="mt-6 space-y-6">
                        
                
                        <div class="mb-6">
                            <x-input-label for="update_password_password" :value="__('New Password')" />
                            <div class="relative cursor-pointer">
                                <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password" id="update_password_password" placeholder="password"  class="text-md block px-3 py-2 rounded-lg w-full 
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
        
                        <div>
                            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" placeholder="password" class="mt-1 block w-full" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        </div>
                
                        <div class="flex items-center gap-4">
                            <button  onclick="warnning2({{ $user->id }})" title="Supprimer"
                                aria-label="Supprimer" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Save</button>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <section class="space-y-6">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Delete Account') }}
                        </h2>
                
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                        </p>
                    </header>
                
                    <button onclick="warnning({{ $user->id }})" title="Supprimer"
                        aria-label="Supprimer" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150'">Delete Account</button>
                </section>
                
            </div>
        </div>
    </div>
</div>
<script>
    function warnning(id) {
        document.getElementById('deleteGroupModal').classList.remove('hidden');
        const deleteGroupIdInput = document.getElementById('deleteGroupId');
        // Set the hidden input field's value to the retrieved group ID
        deleteGroupIdInput.value = id;
        document.getElementById('list').classList.add('blur-sm');
        document.getElementById('list').classList.add('pointer-events-none');
    }
</script>
<script>
    function hide() {
        document.getElementById('deleteGroupModal').classList.add('hidden');
        document.getElementById('list').classList.remove('blur-sm');
        document.getElementById('list').classList.remove('pointer-events-none');
    }
</script>
<script>
    function warnning2(id) {
        document.getElementById('modifPass').classList.remove('hidden');
        const deleteGroupIdInput = document.getElementById('deleteGroupId');
        const password = document.getElementById('update_password_password');
        const password_confirmation = document.getElementById('update_password_password_confirmation');

        deleteGroupIdInput.value = id;
        document.getElementById('list').classList.add('blur-sm');
        document.getElementById('list').classList.add('pointer-events-none');
        document.getElementById('pass').value=password.value;
        document.getElementById('password_confirmation').value=password_confirmation.value;

    }
</script>
<script>
    function hide2() {
        document.getElementById('modifPass').classList.add('hidden');
        document.getElementById('list').classList.remove('blur-sm');
        document.getElementById('list').classList.remove('pointer-events-none');
    }
</script>
<script>
    function myFunction() {
        var x = document.getElementById("update_password_password"); 
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