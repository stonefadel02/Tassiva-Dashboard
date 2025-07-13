<!doctype html>
<html lang="fr">

<head>
    <title>Gestion des Clients</title>
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
                                <h2 class="mb-3">Gestion des clients</h2>
                                <p class="mb-0">Gérez efficacement vos clients, suivez leurs informations et leurs
                                    interactions.</p>
                            </div>
                            <a href="#" class="btn btn-primary add-list" data-toggle="modal"
                                data-target="#add-Client-Modal"><i class="las la-plus mr-3"></i>Ajouter un client</a>
                        </div>
                    </div>
                    <div class="col-lg-12 mb-3">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="table-responsive rounded mb-3">
                            <table class="data-tables table mb-0 tbl-server-info">
                                <thead class="bg-white text-uppercase">
                                    <tr class="ligth ligth-data">
                                        <th>ID Client</th>
                                        <th>Nom du Client</th>
                                        <th>Catégorie</th>
                                        <th>Téléphone</th>
                                        <th>Adresse</th>
                                        <th>Date d'Ajout</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($clients as $client)
                                        <tr>
                                            <td>{{ $client->id_client }}</td>
                                            <td>{{ $client->nom_client }}</td>
                                            <td>{{ $client->categorie ?? '-' }}</td>
                                            <td>{{ $client->telephone ?? '-' }}</td>
                                            <td>{{ $client->adresse ?? '-' }}</td>
                                            <td>{{ $client->date_ajout?->format('d/m/Y') ?? '-' }}</td>
                                            <td>
                                                <div class="d-flex align-items-center list-action">
                                                    <a class="badge badge-info mr-2" data-toggle="modal" data-target="#edit-Client-Modal-{{ $client->id_client }}"
                                                        href="#"
                                                        title="Éditer"><i class="ri-pencil-line mr-0"></i></a>
                                                    <form action="{{ route('clients.destroy', $client->id_client) }}"
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
                                    @include('clients.modalClients')

                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Aucun client trouvé.</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modals -->
    @include('layouts.footer')
    @include('layouts.modal')

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

<!-- Modal d'ajout -->
<div class="modal fade" id="add-Client-Modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un Client</h4>
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
                        <form action="{{ route('clients.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">ID Client</label>
                                    <input type="text" name="id_client" class="form-control @error('id_client') is-invalid @enderror" value="{{ old('id_client') }}" required>
                                    @error('id_client')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="mb-2">Nom du Client</label>
                                    <input type="text" name="nom_client" class="form-control @error('nom_client') is-invalid @enderror" value="{{ old('nom_client') }}" required>
                                    @error('nom_client')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Téléphone</label>
                                    <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone') }}">
                                    @error('telephone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="mb-2">Catégorie</label>
                                    <select name="categorie" class="custom-select @error('categorie') is-invalid @enderror">
                                        <option value="">Sélectionner une catégorie</option>
                                        <option value="Particulier" {{ old('categorie') == 'Particulier' ? 'selected' : '' }}>Particulier</option>
                                        <option value="Entreprise" {{ old('categorie') == 'Entreprise' ? 'selected' : '' }}>Entreprise</option>
                                    </select>
                                    @error('categorie')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Adresse</label>
                                    <textarea name="adresse" class="form-control @error('adresse') is-invalid @enderror" rows="2">{{ old('adresse') }}</textarea>
                                    @error('adresse')
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

<!-- Modal d'ajout -->
<div class="modal fade" id="add-Client-Modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ajouter un client</h4>
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
                        <form action="{{ route('clients.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">ID Client</label>
                                    <input type="text" name="id_client" class="form-control @error('id_client') is-invalid @enderror" value="{{ old('id_client') }}" required>
                                    @error('id_client')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="mb-2">Nom du Client</label>
                                    <input type="text" name="nom_client" class="form-control @error('nom_client') is-invalid @enderror" value="{{ old('nom_client') }}" required>
                                    @error('nom_client')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Téléphone</label>
                                    <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone') }}">
                                    @error('telephone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="mb-2">Catégorie</label>
                                    <select name="categorie" class="custom-select @error('categorie') is-invalid @enderror">
                                        <option value="">Sélectionner une catégorie</option>
                                        <option value="Particulier" {{ old('categorie') == 'Particulier' ? 'selected' : '' }}>Particulier</option>
                                        <option value="Entreprise" {{ old('categorie') == 'Entreprise' ? 'selected' : '' }}>Entreprise</option>
                                    </select>
                                    @error('categorie')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label class="mb-2">Adresse</label>
                                    <textarea name="adresse" class="form-control @error('adresse') is-invalid @enderror" rows="2">{{ old('adresse') }}</textarea>
                                    @error('adresse')
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