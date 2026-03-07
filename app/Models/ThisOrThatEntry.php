<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThisOrThatEntry extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_game_id',
        'label',
    ];

    public function userGame() {
        return $this->belongsTo(UserGame::class);
    }
}
