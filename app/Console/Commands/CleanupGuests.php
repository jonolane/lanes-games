<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CleanupGuests extends Command
{
    protected $signature = 'guests:cleanup';
    protected $description = 'Delete guest accounts older than 24 hours';

    public function handle()
    {
        $count = User::where('is_guest', true)
            ->where('created_at', '<', now()->subHours(24))
            ->each(function ($user) {
                $user->games()->each(function ($game) {
                    $game->entries()->delete();
                    $game->delete();
                });
                $user->delete();
            });

        $this->info("Cleaned up guest accounts.");
    }
}