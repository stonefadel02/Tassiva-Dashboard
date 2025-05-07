@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter un Stock</h1>
    <form action="{{ route('stocks.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom_produit">Nom du Produit</label>
            <input type="text" name="nom_produit" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="stock_initial">Stock Initial</label>
            <input type="number" name="stock_initial" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="entrees">Entrées</label>
            <input type="number" name="entrees" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="sorties">Sorties</label>
            <input type="number" name="sorties" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="stock_minimum">Stock Minimum</label>
            <input type="number" name="stock_minimum" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
</div>
@endsection