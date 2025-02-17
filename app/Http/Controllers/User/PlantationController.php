<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Plantation;
use Illuminate\Http\Request;

class PlantationController extends Controller
{
    public function index()
    {
        return view('user.plantation.index', [
            'plantations' => Plantation::with('specie', 'location')->get(),
        ]);  
    }

    public function show(Plantation $plantation)
    {
        return view('user.plantation.show', [
            'plantation' => $plantation->load('specie.media', 'location')
        ]);
    }
}