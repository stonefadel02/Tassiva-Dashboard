<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Tassiva Dashboard')</title>
    <meta name="description" content="@yield('description', 'Sain avec les produits de chez nous')">

    <meta property="og:title" content="@yield('title', 'Tassiva Dashboard')" />
    <meta property="og:description" content="@yield('description', 'Sain avec les produits de chez nous)" />
    <meta property="og:image" content="@yield('image', asset('assets/images/tassiva.jpg'))" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/backend-plugin.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/backend.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/loading.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    @include('partials.navbar')

    <div class="container mt-5">
        @yield('content')
    </div>
</body>

</html>
