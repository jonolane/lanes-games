<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $games = auth()->user()->games()->with(['game', 'entries'])->latest()->get();

        return view('dashboard', compact('games'));
    }
}
