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
    {{-- font awesome 5 cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        @php
            $newBookings = App\Models\Booking::where('old', 0)->orderBy('created_at', 'desc')->get();
        @endphp

        {{-- Alert Success --}}
        @if (Session::has('success'))
            <div class="fixed-top alert alert-success alert-dismissible fade show mx-5 my-4" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Alert Success --}}

        {{-- Alert Error --}}
        @if (Session::has('error'))
            <div class="fixed-top alert alert-danger alert-dismissible fade show mx-5 my-4" role="alert">
                {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- End Alert Error --}}

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @if (Auth::check() && Auth::user()->role_id == 1)
                            <li class="nav-item">
                                <a href="{{ route('home') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'home') active @endif"
                                    aria-current="page">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'user') active @endif">Pengguna</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('booking') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'booking') active @endif">Booking</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('booking.rekap_pendapatan') }}"
                                    class="nav-link @if (Route::currentRouteName() == 'booking.rekap_pendapatan') active @endif">Rekap Pendapatan</a>
                            </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @if (Auth::check() && Auth::user()->role_id == 1)
                            <li class="nav-item dropdown">
                                <a id="notifDropdown" class="nav-link dropdown-toggle position-relative" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    @if (isset($newBookings) && count($newBookings))
                                        <span class="badge badge-pill bg-danger">{{ count($newBookings) }}</span>
                                    @endif
                                    <i class="fa fa-bell"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="notifDropdown">
                                    @if (isset($newBookings) && count($newBookings))
                                        @foreach ($newBookings as $key => $booking)
                                            @if ($key < 3)
                                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('form-booking-{{ $booking->id }}').submit();">
                                                    <div class="d-flex justify-content-between gap-5">
                                                        <span class="fw-bold fs-6">{{ $booking->namalengkap }}</span>
                                                        <span class="text-sm text-secondary">{{ date('d/M/Y', strtotime($booking->tanggal_booking)) }}</span>
                                                    </div>
                                                    <span class="text-sm">{{ $booking->nohp }}</span>
                                                </a>

                                                <form id="form-booking-{{ $booking->id }}" action="{{ route('booking.update.new', $booking->id)}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                </form>
                                            @endif
                                        @endforeach
                                        <hr>
                                        <a class="dropdown-item text-center" href="{{ route('user') }}">
                                            View All
                                        </a>
                                    @else
                                        <a class="dropdown-item text-center" href="{{ route('user') }}">
                                            No New Users
                                        </a>
                                    @endif
                                </div>
                            </li>
                        @endif
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->fullname }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>

</html>
