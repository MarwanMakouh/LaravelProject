<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'birthday',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'birthday' => 'date',
            'password' => 'hashed',
        ];
    }

    /**
     * Relatie met UserProfile model
     */
    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    /**
     * Relatie met FavoriteGame model
     */
    public function favoriteGames(): HasMany
    {
        return $this->hasMany(FavoriteGame::class);
    }

    /**
     * Relatie met Game model via favorite_games pivot table
     */
    public function favoritedGames(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'favorite_games')
                    ->withTimestamps();
    }

    /**
     * Check of een game favoriet is voor deze gebruiker
     */
    public function hasFavorited(int $gameId): bool
    {
        return $this->favoritedGames()->where('game_id', $gameId)->exists();
    }

    /**
     * Geef de weergavenaam terug (username als die bestaat, anders name)
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->username ?? $this->name;
    }
}
