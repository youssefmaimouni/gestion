<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body style="height: 100vh" class="bg-gray-100 text-gray-900 flex justify-center">
    <div class="max-w-screen-xl m-0 sm:m-10 bg-white shadow sm:rounded-lg flex justify-center flex-1">
        <div class="flex-1 text-center hidden lg:flex">
            <div class=" w-full h-full bg-center bg-gray-800 bg-no-repeat" style="background-image: url('https://i.pinimg.com/564x/32/72/53/3272534ec28e93725aa4c5c0a44ef088.jpg');">
            </div>
        </div>
        <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
            <div class="mt-12 flex flex-col items-center ">
                <div class="w-full flex-1 mt-16 ">
                    <div class="">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    </body>
</html>
