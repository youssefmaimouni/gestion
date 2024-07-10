<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="mb-6">
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <div class="relative cursor-pointer">
                <input type="password" class="border border-gray-200 rounded p-2 w-full" name="current_password" id="update_password_current_password" placeholder="password"  class="text-md block px-3 py-2 rounded-lg w-full 
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
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                </div>
        <div class="mb-6">
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <div class="relative cursor-pointer">
                <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password" id="update_password_password" placeholder="password"  class="text-md block px-3 py-2 rounded-lg w-full 
              bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md
              focus:placeholder-gray-500
              focus:bg-white 
              focus:border-gray-600  
              focus:outline-none">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 " onclick="Function()">

                  <svg id="show1" class="h-6 text-gray-700 bg-white" fill="none" xmlns="http://www.w3.org/2000/svg"
                    viewbox="0 0 576 512">
                    <path fill="currentColor"
                      d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z">
                    </path>
                  </svg>

                  <svg id="notshow1" class="hidden h-6 text-gray-700 bg-white" fill="none" xmlns="http://www.w3.org/2000/svg"
                    viewbox="0 0 640 512">
                    <path fill="currentColor"
                      d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z">
                    </path>
                  </svg>

                </div>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" placeholder="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
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
<script>
    function myFunction() {
        var x = document.getElementById("update_password_current_password"); 
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
<script>
    function Function() {
        var x = document.getElementById("update_password_password"); 
        var show = document.getElementById("show1"); 
        var notshow = document.getElementById("notshow1"); 
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