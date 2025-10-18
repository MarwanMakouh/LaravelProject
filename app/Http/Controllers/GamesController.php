<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Comment;
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

        // Voeg slug toe aan game array
        $game['slug'] = $slug;

        // Zoek of maak Game record in database voor comments
        $gameModel = Game::firstOrCreate(
            ['rawg_id' => $gameId],
            [
                'name' => $game['name'] ?? 'Unknown',
                'slug' => $slug,
            ]
        );

        // Haal comments uit de database met eager loading van user relatie
        // Limit tot 50 meest recente comments voor snellere load
        $comments = $gameModel->comments()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get()
            ->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'author' => $comment->author,
                    'user_id' => $comment->user_id,
                    'content' => $comment->content,
                    'created_at' => $comment->created_at->diffForHumans(),
                ];
            })
            ->toArray();

        return view('games.show', compact('game', 'gameModel', 'comments'));
    }

    public function storeComment(Request $request, $slug)
    {
        // Haal game ID uit slug
        $gameId = null;

        if (preg_match('/^(\d+)-/', $slug, $matches)) {
            $gameId = $matches[1];
        } else {
            $gameId = $this->rawgApi->searchGameBySlug($slug);
        }

        if (!$gameId) {
            abort(404, 'Game niet gevonden');
        }

        // Zoek of maak Game record
        $gameModel = Game::firstOrCreate(
            ['rawg_id' => $gameId],
            [
                'name' => $request->input('game_name', 'Unknown'),
                'slug' => $slug,
            ]
        );

        // Als gebruiker ingelogd is, gebruik hun naam en user_id
        if (auth()->check()) {
            $validated = $request->validate([
                'content' => ['required', 'string', 'max:1000'],
            ], [
                'content.required' => 'Reactie is verplicht.',
                'content.max' => 'Reactie mag maximaal 1000 tekens zijn.',
            ]);

            $gameModel->comments()->create([
                'user_id' => auth()->id(),
                'author' => auth()->user()->name,
                'content' => $validated['content'],
            ]);
        } else {
            // Voor niet-ingelogde gebruikers, vraag om naam
            $validated = $request->validate([
                'author' => ['required', 'string', 'max:255'],
                'content' => ['required', 'string', 'max:1000'],
            ], [
                'author.required' => 'Naam is verplicht.',
                'content.required' => 'Reactie is verplicht.',
                'content.max' => 'Reactie mag maximaal 1000 tekens zijn.',
            ]);

            $gameModel->comments()->create([
                'author' => $validated['author'],
                'content' => $validated['content'],
            ]);
        }

        return redirect()->route('games.show', $slug)
            ->with('success', 'Reactie succesvol geplaatst!');
    }
}
