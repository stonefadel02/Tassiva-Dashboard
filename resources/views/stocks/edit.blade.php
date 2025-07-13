@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier le Stock</h1>
    <form action="{{ route('stocks.update', $stock->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nom_produit">Nom du Produit</label>
            <input type="text" name="nom_produit" class="form-control" value="{{ $stock->nom_produit }}" required>
        </div>
        <div class="form-group">
            <label for="stock_initial">Stock Initial</label>
            <input type="number" name="stock_initial" class="form-control" value="{{ $stock->stock_initial }}" required>
        </div>
        <div class="form-group">
            <label for="entrees">Entrées</label>
            <input type="number" name="entrees" class="form-control" value="{{ $stock->entrees }}" required>
        </div>
        <div class="form-group">
            <label for="sorties">Sorties</label>
            <input type="number" name="sorties" class="form-control" value="{{ $stock->sorties }}" required>
        </div>
        <div class="form-group">
            <label for="stock_minimum">Stock Minimum</label>
            <input type="number" name="stock_minimum" class="form-control" value="{{ $stock->stock_minimum }}" required>
        </div>
        <button type="submit" class="btn btn-warning">Mettre à jour</button>
    </form>
</div>
@endsection