<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LivreurController extends Controller
{
    public function index()
    {
        $livreur = "Livreur";
        return view('livreurs.index', compact('livreur'));
    }
}
