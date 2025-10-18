<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Public news views
    public function index()
    {
        $news = News::orderBy('published_at', 'desc')
            ->whereNotNull('published_at')
            ->get();

        return view('news.index', compact('news'));
    }

    public function show($id)
    {
        $newsItem = News::findOrFail($id);

        return view('news.show', compact('newsItem'));
    }

    // Admin news management
    public function adminIndex()
    {
        // Check if user is admin
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $news = News::orderBy('created_at', 'desc')->get();

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        // Check if user is admin
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        // Check if user is admin
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'published_at' => ['nullable', 'date'],
        ], [
            'title.required' => 'Titel is verplicht.',
            'title.max' => 'Titel mag maximaal 255 tekens zijn.',
            'content.required' => 'Inhoud is verplicht.',
            'image_url.url' => 'Afbeelding URL moet een geldige URL zijn.',
            'published_at.date' => 'Publicatiedatum moet een geldige datum zijn.',
        ]);

        News::create($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'Nieuwsbericht succesvol aangemaakt!');
    }

    public function edit($id)
    {
        // Check if user is admin
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $newsItem = News::findOrFail($id);

        return view('admin.news.edit', compact('newsItem'));
    }

    public function update(Request $request, $id)
    {
        // Check if user is admin
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $newsItem = News::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'published_at' => ['nullable', 'date'],
        ], [
            'title.required' => 'Titel is verplicht.',
            'title.max' => 'Titel mag maximaal 255 tekens zijn.',
            'content.required' => 'Inhoud is verplicht.',
            'image_url.url' => 'Afbeelding URL moet een geldige URL zijn.',
            'published_at.date' => 'Publicatiedatum moet een geldige datum zijn.',
        ]);

        $newsItem->update($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'Nieuwsbericht succesvol bijgewerkt!');
    }

    public function destroy($id)
    {
        // Check if user is admin
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $newsItem = News::findOrFail($id);
        $newsItem->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Nieuwsbericht succesvol verwijderd!');
    }
}
