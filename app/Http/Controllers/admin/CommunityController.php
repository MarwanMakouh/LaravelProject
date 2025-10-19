<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Community;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CommunityController extends Controller
{
    /**
     * Display a listing of community posts
     */
    public function index(): View
    {
        $communities = Community::with(['user', 'comments'])
            ->withCount('comments')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.community.index', compact('communities'));
    }

    /**
     * Show the form for editing the specified community post
     */
    public function edit(Community $community): View
    {
        $community->load('user');
        return view('admin.community.edit', compact('community'));
    }

    /**
     * Update the specified community post in storage
     */
    public function update(Request $request, Community $community): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);

        $community->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()
            ->route('admin.community.index')
            ->with('success', 'Community post succesvol bijgewerkt!');
    }

    /**
     * Remove the specified community post from storage
     */
    public function destroy(Community $community): RedirectResponse
    {
        $community->delete();

        return redirect()
            ->route('admin.community.index')
            ->with('success', 'Community post succesvol verwijderd!');
    }
}
