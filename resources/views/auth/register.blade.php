<x-guest-layout>
    <form method="POST" action="/register">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
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
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
