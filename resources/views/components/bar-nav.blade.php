<!DOCTYPE html>
<html style="height: 100%">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="images/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('img/logo.png') }}" rel="icon">

    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#1967D2",
                    },
                },
            },
        };
    </script>
    <style>
         .calc{
            height: 91%;
        }
    </style>
     <style>
        ::-webkit-scrollbar {
            width: 7px;
            height: 7px;
            border-radius: 10px;
    
        }
    
        /* Track */
        ::-webkit-scrollbar-track {
            background-color: #97c5d9;
            box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.2);
        }
    
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background:   #64748b  ;
            border-radius: 10px;
        }
    
        ::-webkit-scrollbar-corner {
            display: none;
        }
    </style>
    <title>Ajouter Site</title>
</head>

<body style="height: 100%; background-color: #f5f5f5" class="overflow-hidden">
    @include('layouts.navigation')
    <main class="overflow-auto calc">
        {{ $slot }}
    </main>
</body>
</html>