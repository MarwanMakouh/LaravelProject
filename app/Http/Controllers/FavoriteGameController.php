<?php

namespace App\Http\Controllers;

use App\Models\FavoriteGame;
use App\Models\Game;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FavoriteGameController extends Controller
{
    /**
     * Voeg een game toe aan favorieten
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
            'game_slug' => 'required|string',
        ]);

        $user = auth()->user();
        $gameId = $request->game_id;

        // Check of deze game al favoriet is
        if ($user->hasFavorited($gameId)) {
            return redirect()->back()->with('info', 'Deze game staat al in je favorieten!');
        }

        // Voeg toe aan favorieten
        FavoriteGame::create([
            'user_id' => $user->id,
            'game_id' => $gameId,
        ]);

        return redirect()->back()->with('success', 'Game toegevoegd aan favorieten!');
    }

    /**
     * Verwijder een game uit favorieten
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'game_id' => 'required|exists:games,id',
        ]);

        $user = auth()->user();
        $gameId = $request->game_id;

        FavoriteGame::where('user_id', $user->id)
            ->where('game_id', $gameId)
            ->delete();

        return redirect()->back()->with('success', 'Game verwijderd uit favorieten!');
    }
}
