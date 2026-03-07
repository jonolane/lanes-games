<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'slug',
        'name',
    ];

    public function userGames() {
        return $this->hasMany(UserGame::class);
    }
}
