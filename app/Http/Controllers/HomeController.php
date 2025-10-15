<?php

namespace App\Http\Controllers;

use App\Services\RawgApiService;

class HomeController extends Controller
{
    protected $rawgApi;

    public function __construct(RawgApiService $rawgApi)
    {
        $this->rawgApi = $rawgApi;
    }

    public function index()
    {
        $games = $this->rawgApi->getPopularGames(9);

        return view('home', compact('games'));
    }
}
