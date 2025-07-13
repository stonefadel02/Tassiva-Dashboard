<!doctype html>
<html lang="fr">

<head>
    <title>Profil utilisateur</title>
    @include('layouts.meta')
</head>

<body>
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center"></div>
    </div>

    <!-- loader END -->

    <!-- Wrapper Start -->
    <div class="wrapper">
        @include('layouts.sidebar')
        @include('layouts.navbar')

        <div class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                            <div>
                                <h2 class="mb-3">Profil de l'utilisateur</h2>
                                <p class="mb-0">Voici les informations de base de votre profil utilisateur.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 offset-lg-3">
                        @php
                        $user = Auth::user();
                        $name = $user?->name ?? 'Visiteur';
                        $email = $user?->email ?? 'email@exemple.com';
                        $image = asset('assets/images/user/1.png');
                        @endphp

                        <div class="card shadow border-0">
                            <div class="card-body d-flex" style="gap: 1rem;">
                                {{-- Colonne infos (75%) --}}
                                <div style="flex: 3;" class="d-flex align-items-center">
                                    <img src="{{ $image }}" alt="Photo de profil" class="rounded-circle me-4" width="90"
                                        height="90">
                                    <div>
                                        <h4 class="card-title mb-1">{{ $name }}</h4>
                                        <p class="card-text text-muted mb-0">{{ $email }}</p>
                                    </div>
                                </div>

                                {{-- Colonne bouton déconnexion (25%) --}}
                                <div style="flex: 1;" class="d-flex justify-content-center align-items-center">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-danger"
                                            title="Se déconnecter">
                                            <i class="fas fa-power-off"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- Page end -->
            </div>
        </div>
    </div>
    <!-- Wrapper End -->

    @include('layouts.footer')
    @include('layouts.modal')
</body>

</html>