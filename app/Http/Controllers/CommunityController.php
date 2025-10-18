<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Community;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function index()
    {
        // Haal alle communities uit de database
        $posts = Community::with('user')
            ->withCount('comments')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($community) {
                return [
                    'id' => $community->id,
                    'author' => $community->user ? $community->user->display_name : 'Onbekend',
                    'title' => $community->title,
                    'content' => $community->content,
                    'likes' => $community->likes,
                    'comments_count' => $community->comments_count,
                    'created_at' => $community->created_at->diffForHumans(),
                ];
            })
            ->toArray();

        return view('community.index', compact('posts'));
    }

    public function show($id)
    {
        $community = Community::with('user')->findOrFail($id);

        // Haal comments uit de database met polymorphic relationship
        $comments = $community->comments()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'author' => $comment->user ? $comment->user->display_name : $comment->author,
                    'user_id' => $comment->user_id,
                    'content' => $comment->content,
                    'created_at' => $comment->created_at->diffForHumans(),
                ];
            })
            ->toArray();

        $post = [
            'id' => $community->id,
            'author' => $community->user ? $community->user->display_name : 'Onbekend',
            'title' => $community->title,
            'content' => $community->content,
            'likes' => $community->likes,
            'comments' => $comments,
            'comments_count' => count($comments),
            'created_at' => $community->created_at->diffForHumans(),
        ];

        return view('community.show', compact('post'));
    }

    public function create()
    {
        // Alleen ingelogde gebruikers mogen een community aanmaken
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Je moet ingelogd zijn om een community te maken.');
        }

        return view('community.create');
    }

    public function store(Request $request)
    {
        // Alleen ingelogde gebruikers mogen een community aanmaken
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Je moet ingelogd zijn om een community te maken.');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:communities,title'],
            'content' => ['required', 'string', 'max:5000'],
        ], [
            'title.required' => 'Titel is verplicht.',
            'title.max' => 'Titel mag maximaal 255 tekens zijn.',
            'title.unique' => 'Er bestaat al een community post met deze titel.',
            'content.required' => 'Inhoud is verplicht.',
            'content.max' => 'Inhoud mag maximaal 5000 tekens zijn.',
        ]);

        Community::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
            'likes' => 0,
        ]);

        return redirect()->route('community.index')
            ->with('success', 'Community post succesvol aangemaakt!');
    }

    public function storeComment(Request $request, $id)
    {
        $community = Community::findOrFail($id);

        // Als gebruiker ingelogd is, gebruik hun naam en user_id
        if (auth()->check()) {
            $validated = $request->validate([
                'content' => ['required', 'string', 'max:1000'],
            ], [
                'content.required' => 'Reactie is verplicht.',
                'content.max' => 'Reactie mag maximaal 1000 tekens zijn.',
            ]);

            $community->comments()->create([
                'user_id' => auth()->id(),
                'author' => auth()->user()->display_name,
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

            $community->comments()->create([
                'author' => $validated['author'],
                'content' => $validated['content'],
            ]);
        }

        return redirect()->route('community.show', $id)
            ->with('success', 'Reactie succesvol geplaatst!');
    }
}
