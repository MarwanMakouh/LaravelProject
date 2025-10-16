<?php

namespace App\Http\Controllers;

use App\Services\RawgApiService;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    protected $rawgApi;

    public function __construct(RawgApiService $rawgApi)
    {
        $this->rawgApi = $rawgApi;
    }

    public function show($slug)
    {
        // Probeer eerst de ID uit de slug te halen (format: "123-game-name")
        $gameId = null;

        if (preg_match('/^(\d+)-/', $slug, $matches)) {
            // ID gevonden in de slug
            $gameId = $matches[1];
        } else {
            // Geen ID in slug, probeer te zoeken op basis van naam
            $gameId = $this->rawgApi->searchGameBySlug($slug);
        }

        if (!$gameId) {
            abort(404, 'Game niet gevonden');
        }

        // Haal gedetailleerde informatie op
        $game = $this->rawgApi->getGameDetails($gameId);

        if (!$game) {
            abort(404, 'Game niet gevonden');
        }

        return view('games.show', compact('game'));
    }
}
