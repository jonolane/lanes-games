<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\UserGame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BracketsController extends Controller
{
    public function create()
    {
        return view('games.brackets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'entries' => ['required', 'array', 'size:16'],
            'entries.*' => ['required', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($validated) {
            $game = Game::where('slug', 'brackets')->firstOrFail();

            $userGame = UserGame::create([
                'user_id' => auth()->id(),
                'game_id' => $game->id,
                'title' => $validated['title'],
                'settings' => [
                    'count' => 16,
                ],
            ]);

            foreach ($validated['entries'] as $entry) {
                $userGame->entries()->create([
                    'label' => $entry,
                ]);
            }
        });

        return redirect()->route('dashboard');
    }

    public function edit(UserGame $userGame)
    {
        abort_unless($userGame->user_id === auth()->id(), 403);
        $userGame->load('entries');
        return view('games.brackets.create', compact('userGame'));
    }

    public function update(Request $request, UserGame $userGame)
    {
        abort_unless($userGame->user_id === auth()->id(), 403);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'entries' => ['required', 'array', 'size:16'],
            'entries.*' => ['required', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($userGame, $validated) {
            $userGame->update([
                'title' => $validated['title'],
                'settings' => [
                    'count' => 16,
                ],
            ]);

            $userGame->entries()->delete();

            foreach ($validated['entries'] as $entry) {
                $userGame->entries()->create([
                    'label' => $entry,
                ]);
            }
        });

        return redirect()->route('dashboard');
    }

    public function destroy(UserGame $userGame)
    {
        abort_unless($userGame->user_id === auth()->id(), 403);
        $userGame->delete();
        return redirect()->route('dashboard');
    }

    public function play(UserGame $userGame)
    {
        abort_unless($userGame->user_id === auth()->id(), 403);
        $entries = $userGame->entries->pluck('label')->values()->toArray();
        return view('games.brackets.play', [
            'userGame' => $userGame,
            'entries' => $entries,
        ]);
    }
}