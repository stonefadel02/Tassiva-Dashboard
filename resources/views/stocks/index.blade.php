@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestion des Stocks</h1>
    <a href="{{ route('stocks.create') }}" class="btn btn-primary mb-3">Ajouter un Produit</a>

    <!-- Tableau des stocks -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom du Produit</th>
                <th>Stock Initial</th>
                <th>Entrées</th>
                <th>Sorties</th>
                <th>Stock Actuel</th>
                <th>Stock Minimum</th>
                <th>Rupture ?</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $stock)
                <tr>
                    <td>{{ $stock->id }}</td>
                    <td>{{ $stock->nom_produit }}</td>
                    <td>{{ $stock->stock_initial }}</td>
                    <td>{{ $stock->entrees }}</td>
                    <td>{{ $stock->sorties }}</td>
                    <td>{{ $stock->stock_actuel }}</td>
                    <td>{{ $stock->stock_minimum }}</td>
                    <td>{{ $stock->rupture ? 'OUI' : 'NON' }}</td>
                    <td>
                        <a href="{{ route('stocks.show', $stock->id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Graphique des stocks -->
    <div class="mt-5">
        <h2>Graphique des Stocks</h2>
        <canvas id="stockChart"></canvas>
    </div>
</div>

<!-- Script pour Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('stockChart').getContext('2d');
    const stockChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($stocks->pluck('nom_produit')) !!},
            datasets: [{
                label: 'Stock Actuel',
                data: {!! json_encode($stocks->pluck('stock_actuel')) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }, {
                label: 'Stock Minimum',
                data: {!! json_encode($stocks->pluck('stock_minimum')) !!},
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection