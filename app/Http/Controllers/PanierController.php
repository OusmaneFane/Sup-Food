<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanierController extends Controller
{
     public function index()
    {
        return view('panier');
    }
}
