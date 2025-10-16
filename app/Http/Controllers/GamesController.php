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
        // Zoek de game ID op basis van de slug
        $gameId = $this->rawgApi->searchGameBySlug($slug);

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
