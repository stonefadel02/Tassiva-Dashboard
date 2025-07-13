<!doctype html>
<html lang="fr">

<head>
    <title>Gestion des Livreurs</title>
    @include('layouts.meta')
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
                                <h2 class="mb-3">Gestion des livreurs</h2>
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
                                    @forelse ($livreurs as $livreur)
                                        <tr>
                                            <td>{{ $livreur->id }}</td>
                                            <td>{{ $livreur->nom_livreur }}</td>
                                            <td>{{ $livreur->telephone ?? '-' }}</td>
                                            <td>{{ $livreur->zone_recouvrement ?? '-' }}</td>
                                            <td>{{ $livreur->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="d-flex align-items-center list-action">
                                                    <a class="badge badge-info mr-2" data-toggle="modal" data-target="#edit-Livreur-Modal-{{ $livreur->id }}"
                                                        href="#"
                                                        title="Éditer"><i class="ri-pencil-line mr-0"></i></a>
                                                    <form action="{{ route('livreurs.destroy', $livreur->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="badge bg-warning mt-0 mr-2"
                                                            style="border:none;" title="Supprimer"
                                                            onclick="return confirm('Confirmer la suppression ?')"><i
                                                                class="ri-delete-bin-line mr-0"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @include('livreurs.modalLivreur')
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Aucun livreur trouvé.</td>
                                        </tr>
                                    @endforelse
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
    
    @include('layouts.footer')
    @include('layouts.modal')

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
<!-- Ajouter un livreur -->
<div class="modal fade" id="add-Livreur-Modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un livreur</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="popup text-left">
                    <div class="content create-workform bg-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('livreurs.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Nom du livreur</label>
                                    <input type="text" name="nom_livreur" class="form-control @error('nom_livreur') is-invalid @enderror" value="{{ old('nom_livreur') }}" required>
                                    @error('nom_livreur')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="mb-2">Téléphone</label>
                                    <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone') }}" required>
                                    @error('telephone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Zone de recouvrement</label>
                                    <textarea class="form-control @error('zone_recouvrement') is-invalid @enderror" name="zone_recouvrement" rows="2">{{ old('zone_recouvrement') }}</textarea>
                                    @error('zone_recouvrement')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <div class="d-flex flex-wrap align-items-center justify-content-center">
                                    <button type="button" class="btn btn-primary mr-4" data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-outline-primary">Ajouter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</html>