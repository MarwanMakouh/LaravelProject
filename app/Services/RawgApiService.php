<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class RawgApiService
{
    protected $apiKey;
    protected $baseUrl = 'https://api.rawg.io/api';

    public function __construct()
    {
        $this->apiKey = env('RAWG_API_KEY');
    }

    /**
     * Haal populaire games op
     */
    public function getPopularGames($limit = 9)
    {
        // Cache de resultaten voor 1 uur
        return Cache::remember('rawg_popular_games', 3600, function () use ($limit) {
            $response = Http::get("{$this->baseUrl}/games", [
                'key' => $this->apiKey,
                'page_size' => $limit,
                'ordering' => '-rating',
                'metacritic' => '80,100', // Alleen games met hoge scores
            ]);

            if ($response->successful()) {
                return $this->formatGames($response->json()['results']);
            }

            return [];
        });
    }

    /**
     * Haal games op met paginering en optionele zoekterm
     */
    public function getGames($page = 1, $pageSize = 9, $search = null)
    {
        // Cache key gebaseerd op parameters
        $cacheKey = 'rawg_games_' . md5($page . '_' . $pageSize . '_' . ($search ?? 'default'));

        // Cache voor 10 minuten (600 seconden) - voor zoekresultaten en pagina's
        return Cache::remember($cacheKey, 600, function () use ($page, $pageSize, $search) {
            $params = [
                'key' => $this->apiKey,
                'page' => $page,
                'page_size' => $pageSize,
                'ordering' => '-rating',
            ];

            if ($search) {
                $params['search'] = $search;
                $params['search_exact'] = false;
            } else {
                $params['metacritic'] = '80,100';
            }

            $response = Http::get("{$this->baseUrl}/games", $params);

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'games' => $this->formatGames($data['results']),
                    'hasMore' => !empty($data['next']),
                    'total' => $data['count'] ?? 0,
                ];
            }

            return [
                'games' => [],
                'hasMore' => false,
                'total' => 0,
            ];
        });
    }

    /**
     * Haal gedetailleerde informatie op over een specifieke game
     */
    public function getGameDetails($gameId)
    {
        $cacheKey = "rawg_game_details_{$gameId}";

        return Cache::remember($cacheKey, 3600, function () use ($gameId) {
            $response = Http::get("{$this->baseUrl}/games/{$gameId}", [
                'key' => $this->apiKey,
            ]);

            if ($response->successful()) {
                $game = $response->json();
                return [
                    'id' => $game['id'],
                    'name' => $game['name'],
                    'description' => $game['description_raw'] ?? 'Geen beschrijving beschikbaar.',
                    'released' => $game['released'] ?? 'N/A',
                    'rating' => round($game['rating'] ?? 0, 1),
                    'rating_count' => $game['ratings_count'] ?? 0,
                    'metacritic' => $game['metacritic'] ?? 'N/A',
                    'background_image' => $game['background_image'] ?? 'https://via.placeholder.com/800x400?text=No+Image',
                    'genres' => collect($game['genres'] ?? [])->pluck('name')->toArray(),
                    'platforms' => collect($game['platforms'] ?? [])->pluck('platform.name')->toArray(),
                    'developers' => collect($game['developers'] ?? [])->pluck('name')->toArray(),
                    'publishers' => collect($game['publishers'] ?? [])->pluck('name')->toArray(),
                    'playtime' => $game['playtime'] ?? 0,
                    'website' => $game['website'] ?? null,
                ];
            }

            return null;
        });
    }

    /**
     * Zoek game ID op basis van slug
     */
    public function searchGameBySlug($slug)
    {
        $searchTerm = str_replace('-', ' ', $slug);

        // Probeer eerst met exacte match
        $response = Http::get("{$this->baseUrl}/games", [
            'key' => $this->apiKey,
            'search' => $searchTerm,
            'search_exact' => false,
            'page_size' => 5,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data['results'])) {
                // Zoek beste match op basis van naam similarity
                foreach ($data['results'] as $result) {
                    $gameName = strtolower($result['name']);
                    $searchLower = strtolower($searchTerm);

                    // Als de namen exact overeenkomen of de game naam begint met de zoekterm
                    if ($gameName === $searchLower || str_starts_with($gameName, $searchLower)) {
                        return $result['id'];
                    }
                }

                // Als geen exacte match, return eerste resultaat
                return $data['results'][0]['id'];
            }
        }

        return null;
    }

    /**
     * Formatteer de API response naar een consistente structuur
     */
    protected function formatGames($games)
    {
        return collect($games)->map(function ($game) {
            return [
                'id' => $game['id'],
                'name' => $game['name'],
                'released' => $game['released'] ?? 'N/A',
                'rating' => round($game['rating'] ?? 0, 1),
                'background_image' => $game['background_image'] ?? 'https://via.placeholder.com/400x250?text=No+Image',
            ];
        })->toArray();
    }
}
