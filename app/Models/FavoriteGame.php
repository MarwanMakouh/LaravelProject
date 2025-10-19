<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FavoriteGame extends Model
{
    protected $fillable = [
        'user_id',
        'game_id',
    ];

    /**
     * Get the user that owns this favorite.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the game that is favorited.
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
