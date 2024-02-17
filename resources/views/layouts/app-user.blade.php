<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        .my-shadow {
            box-shadow: 0px 4px 4px 0px #00000040;
        }
        .w-card {
            width: 30rem;
        }

        /* Tablet */
        @media screen and (max-width: 768px) {
            .w-card {
                width: 100%;
                margin: 15px;
            }
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">

        {{-- Alert Success --}}
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show mx-5 my-4" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Alert Success --}}

        {{-- Alert Error --}}
        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show mx-5 my-4" role="alert">
                {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Alert Error --}}

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
