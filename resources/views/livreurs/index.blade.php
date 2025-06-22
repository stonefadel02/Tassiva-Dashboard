<!doctype html>
<html lang="fr">

<head>
    <title>Gestion des Livreurs</title>
    @include('layouts.meta')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="  ">
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
                                <h2 class="mb-3">Gestion des Livreurs</h2>
                                <p class="mb-0">Gérez efficacement vos livreurs et leurs zones de recouvrement pour optimiser les livraisons.</p>
                            </div>
                            <a href="#" class="btn btn-primary add-list" data-toggle="modal" data-target="#add-Livreur-Modal"><i class="las la-plus mr-3"></i>Ajoutez un livreur</a>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="table-responsive rounded mb-3">
                            <table class="data-tables table mb-0 tbl-server-info">
                                <thead class="bg-white text-uppercase">
                                    <tr class="ligth ligth-data">
                                        <th>ID Livreur</th>
                                        <th>Nom du livreur</th>
                                        <th>Téléphone</th>
                                        <th>Zone de recouvrement</th>
                                        <th>Date d'ajout</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($livreurs as $livreur)
                                        <tr>
                                            <td>{{ $livreur->id }}</td>
                                            <td>{{ $livreur->nom_livreur }}</td>
                                            <td>{{ $livreur->telephone ?? '-' }}</td>
                                            <td>{{ $livreur->zone_recouvrement ?? '-' }}</td>
                                            <td>{{ $livreur->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="d-flex align-items-center list-action">
                                                    <a class="badge badge-info mr-2" href="{{ route('livreurs.show', $livreur->id) }}" title="Voir"><i class="ri-eye-line mr-0"></i></a>
                                                    <a class="badge bg-success mr-2" href="{{ route('livreurs.edit', $livreur->id) }}" title="Modifier"><i class="ri-pencil-line mr-0"></i></a>
                                                    <form action="{{ route('livreurs.destroy', $livreur->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="badge bg-warning mt-0 mr-2" style="border:none;" title="Supprimer" onclick="return confirm('Confirmer la suppression ?')"><i class="ri-delete-bin-line mr-0"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Page end -->
            </div>
        </div>
    </div>
    <!-- Wrapper End -->
    @include('livreurs.modalLivreur')
    @include('layouts.footer')
    @include('layouts.modal')

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>