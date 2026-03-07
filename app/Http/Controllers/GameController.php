<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    public function create()
    {
        $games = Game::all();

        return view('games.create', compact('games'));
    }
}
