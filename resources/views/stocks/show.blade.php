@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails du Stock</h1>
    <p><strong>Nom du Produit :</strong> {{ $stock->nom_produit }}</p>
    <p><strong>Stock Actuel :</strong> {{ $stock->stock_actuel }}</p>
    <p><strong>Stock Minimum :</strong> {{ $stock->stock_minimum }}</p>
    <p><strong>Rupture :</strong> {{ $stock->rupture ? 'OUI' : 'NON' }}</p>
    <a href="{{ route('stocks.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection