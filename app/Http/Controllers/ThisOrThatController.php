<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\UserGame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThisOrThatController extends Controller
{
    public function create()
    {
        return view('games.this-or-that.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateGame($request);

        $count = (int) $validated['count'];
        $entries = array_slice($validated['entries'], 0, $count);

        DB::transaction(function () use ($validated, $entries, $count) {
            $game = Game::where('slug', 'this-or-that')->firstOrFail();

            $userGame = UserGame::create([
                'user_id' => auth()->id(),
                'game_id' => $game->id,
                'title' => $validated['title'],
                'settings' => [
                    'count' => $count,
                ],
            ]);

            foreach ($entries as $entry) {
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

        return view('games.this-or-that.create', compact('userGame'));
    }

    public function update(Request $request, UserGame $userGame)
    {
        abort_unless($userGame->user_id === auth()->id(), 403);

        $validated = $this->validateGame($request);

        $count = (int) $validated['count'];
        $entries = array_slice($validated['entries'], 0, $count);

        DB::transaction(function () use ($userGame, $validated, $entries, $count) {
            $userGame->update([
                'title' => $validated['title'],
                'settings' => [
                    'count' => $count,
                ],
            ]);

            $userGame->entries()->delete();

            foreach ($entries as $entry) {
                $userGame->entries()->create([
                    'label' => $entry,
                ]);
            }
        });

        return redirect()->route('dashboard');
    }

    protected function validateGame(Request $request): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'count' => ['required', 'integer', 'min:6', 'max:50'],
            'entries' => ['required', 'array'],
            'entries.*' => ['required', 'string', 'max:255'],
        ]);

        $count = (int) $validated['count'];

        if ($count % 2 !== 0) {
            return back()
                ->withErrors(['count' => 'The number of entries must be an even number.'])
                ->withInput()
                ->throwResponse();
        }

        return $validated;
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
        return view('games.this-or-that.play', [
            'userGame' => $userGame,
            'entries' => $entries,
        ]);
}
}
