<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    // Mock data voor community posts
    private function getPosts()
    {
        return [
            [
                'id' => 1,
                'author' => 'GameMaster2024',
                'title' => 'Welkom in de GamePortal Community!',
                'content' => 'Hé gamers! Dit is de plek om je favoriete games te bespreken, tips te delen en nieuwe gaming vrienden te maken. Wat speel jij momenteel?',
                'likes' => 24,
                'comments_count' => 12,
                'created_at' => '2 uur geleden',
                'comments' => [
                    ['author' => 'PlayerOne', 'content' => 'Geweldige community! Ik speel momenteel veel RPG games.', 'created_at' => '1 uur geleden'],
                    ['author' => 'GamerGirl', 'content' => 'Super blij om hier te zijn! Heeft iemand tips voor beginners?', 'created_at' => '1 uur geleden'],
                    ['author' => 'ProGamer99', 'content' => 'Welkom allemaal! Laten we samen gamen!', 'created_at' => '45 min geleden'],
                ]
            ],
            [
                'id' => 2,
                'author' => 'ProGamer99',
                'title' => 'Beste multiplayer games van 2024?',
                'content' => 'Ik ben op zoek naar nieuwe multiplayer games om met vrienden te spelen. Wat zijn jullie aanbevelingen?',
                'likes' => 18,
                'comments_count' => 32,
                'created_at' => '5 uur geleden',
                'comments' => [
                    ['author' => 'FPSMaster', 'content' => 'Probeer zeker de nieuwe shooters uit! Echt geweldig.', 'created_at' => '4 uur geleden'],
                    ['author' => 'TeamPlayer', 'content' => 'Voor co-op zijn er veel goede indie games beschikbaar.', 'created_at' => '3 uur geleden'],
                    ['author' => 'StrategyKing', 'content' => 'Als je van strategy houdt, check de nieuwste RTS games!', 'created_at' => '2 uur geleden'],
                    ['author' => 'CasualGamer', 'content' => 'Party games zijn altijd leuk met vrienden!', 'created_at' => '1 uur geleden'],
                ]
            ],
            [
                'id' => 3,
                'author' => 'CasualGamer',
                'title' => 'Gaming setup tips',
                'content' => 'Zojuist mijn gaming setup ge-upgrade! Deel hier je setup en laten we elkaar inspireren 🎮✨',
                'likes' => 45,
                'comments_count' => 28,
                'created_at' => '1 dag geleden',
                'comments' => [
                    ['author' => 'TechGuru', 'content' => 'Wat voor monitor gebruik je? Ik zoek een nieuwe!', 'created_at' => '1 dag geleden'],
                    ['author' => 'RGBLover', 'content' => 'RGB lighting maakt alles beter! 🌈', 'created_at' => '22 uur geleden'],
                    ['author' => 'BudgetGamer', 'content' => 'Hoe houd je de kosten onder controle bij upgraden?', 'created_at' => '20 uur geleden'],
                    ['author' => 'ErgonomicPlayer', 'content' => 'Vergeet een goede stoel niet! Belangrijk voor lange sessies.', 'created_at' => '18 uur geleden'],
                ]
            ],
        ];
    }

    public function index()
    {
        $posts = $this->getPosts();
        return view('community.index', compact('posts'));
    }

    public function show($id)
    {
        $posts = $this->getPosts();
        $post = collect($posts)->firstWhere('id', $id);

        if (!$post) {
            abort(404, 'Post niet gevonden');
        }

        // Haal echte comments uit de database
        $dbComments = Comment::where('post_id', $id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($comment) {
                return [
                    'author' => $comment->author,
                    'content' => $comment->content,
                    'created_at' => $comment->created_at->diffForHumans(),
                ];
            })
            ->toArray();

        // Combineer mock comments met database comments
        $post['comments'] = array_merge($dbComments, $post['comments']);
        $post['comments_count'] = count($post['comments']);

        return view('community.show', compact('post'));
    }

    public function storeComment(Request $request, $id)
    {
        // Als gebruiker ingelogd is, gebruik hun naam
        if (auth()->check()) {
            $validated = $request->validate([
                'content' => ['required', 'string', 'max:1000'],
            ], [
                'content.required' => 'Reactie is verplicht.',
                'content.max' => 'Reactie mag maximaal 1000 tekens zijn.',
            ]);

            Comment::create([
                'post_id' => $id,
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

            Comment::create([
                'post_id' => $id,
                'author' => $validated['author'],
                'content' => $validated['content'],
            ]);
        }

        return redirect()->route('community.show', $id)
            ->with('success', 'Reactie succesvol geplaatst!');
    }
}
