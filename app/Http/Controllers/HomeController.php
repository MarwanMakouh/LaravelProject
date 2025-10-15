<?php

namespace App\Http\Controllers;

use App\Services\RawgApiService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $rawgApi;

    public function __construct(RawgApiService $rawgApi)
    {
        $this->rawgApi = $rawgApi;
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $result = $this->rawgApi->getGames(1, 9, $search);

        return view('home', [
            'games' => $result['games'],
            'hasMore' => $result['hasMore'],
            'search' => $search,
        ]);
    }

    public function loadMore(Request $request)
    {
        $page = $request->get('page', 1);
        $search = $request->get('search');

        $result = $this->rawgApi->getGames($page, 9, $search);

        return response()->json($result);
    }
}
