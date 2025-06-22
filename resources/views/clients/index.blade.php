<!doctype html>
<html lang="fr">

<head>
    <title>Gestion des Clients</title>
    @include('layouts.meta')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
                                <h2 class="mb-3">Gestion des Clients</h2>
                                <p class="mb-0">Gérez efficacement vos clients, suivez leurs informations et leurs
                                    interactions.</p>
                            </div>
                            <a href="#" class="btn btn-primary add-list" data-toggle="modal"
                                data-target="#add-Client-Modal"><i class="las la-plus mr-3"></i>Ajouter un Client</a>
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
                                                    <a class="badge badge-info mr-2"
                                                        href="{{ route('clients.edit', $client->id_client) }}"
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
    @include('clients.modalClients')
    @include('layouts.footer')
    @include('layouts.modal')

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>