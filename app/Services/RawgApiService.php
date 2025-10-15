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
    }

    /**
     * Formatteer de API response naar een consistente structuur
     */
    protected function formatGames($games)
    {
        return collect($games)->map(function ($game) {
            return [
                'name' => $game['name'],
                'released' => $game['released'] ?? 'N/A',
                'rating' => round($game['rating'] ?? 0, 1),
                'background_image' => $game['background_image'] ?? 'https://via.placeholder.com/400x250?text=No+Image',
            ];
        })->toArray();
    }
}
