<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @if (config('app.env') === 'local')
        <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ secure_asset('images/logo.png') }}">
    @endif


    <title>Ortoprotesia</title>



    <!-- Styles -->
    @if (config('app.env') === 'local')
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @else
        <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />




    <link rel="stylesheet" href="/css/animate.css" type="text/css">
    <link rel="stylesheet" href="/css/nprogress.css">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" /> --}}

    <link href="https://unpkg.com/nprogress@0.2.0/nprogress.css" rel="stylesheet" />
    <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js" defer></script>
    {{-- <script src="js/nprogress.js" defer></script> --}}



    <!-- Scripts -->
    @if (config('app.env') === 'local')
        <script src="{{ asset('js/app.js') }}" defer></script>
    @else
        <script src="{{ secure_asset('js/app.js') }}" defer></script>
    @endif

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/hanken-grotesk" rel="stylesheet">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500&display=swap" rel="stylesheet">
</head>

<body class="antialiased">
    <div id="app">
    </div>

    {{-- <script src="/js/dark-mode-switch.min.js"></script> --}}

</body>

</html>
