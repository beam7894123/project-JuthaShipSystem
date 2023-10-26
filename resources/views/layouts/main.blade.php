<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jutha Maritime</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="{{ asset('images/JUTHA_fav.png') }}">

</head>
<body class="bg-hex-color-010066">

    @include('layouts.subviews.navbar')

    <main class="mt-2 p-4 h-screen">
        @yield('content')
    </main>
</body>
</html>
