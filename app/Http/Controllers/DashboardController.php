<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $dashboard = "Dashboard";
        return view('dashboard.index', compact('dashboard'));
    }
}



