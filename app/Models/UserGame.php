<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGame extends Model
{
    protected $fillable = [
        'user_id',
        'game_id',
        'title',
        'settings',
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function game() {
        return $this->belongsTo(Game::class);
    }

    public function entries() {
        return $this->hasMany(ThisOrThatEntry::class);
    }
}
