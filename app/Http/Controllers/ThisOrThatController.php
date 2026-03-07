<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThisOrThatController extends Controller
{
    public function create()
    {
        return view('games.this-or-that.create');
    }

    public function store(Request $request)
    {
        //
    }
}
