<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Toon alle gepubliceerde FAQs (publiek)
     */
    public function index()
    {
        $faqs = Faq::published()->ordered()->get();

        // Groepeer FAQs per categorie
        $faqsByCategory = $faqs->groupBy('category');

        return view('faq.index', compact('faqsByCategory'));
    }

    /**
     * Admin: Toon alle FAQs
     */
    public function adminIndex()
    {
        $faqs = Faq::ordered()->get();

        return view('admin.faq.index', compact('faqs'));
    }

    /**
     * Admin: Toon create form
     */
    public function create()
    {
        $categories = ['Algemeen', 'Account', 'Games', 'Community', 'Technisch'];

        return view('admin.faq.create', compact('categories'));
    }

    /**
     * Admin: Sla nieuwe FAQ op
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'required|string|max:100',
            'order' => 'nullable|integer|min:0',
            'is_published' => 'required|in:0,1',
        ]);

        // Zet order op 0 als niet ingevuld
        $validated['order'] = $validated['order'] ?? 0;

        Faq::create($validated);

        return redirect()->route('admin.faq.index')->with('success', 'FAQ succesvol aangemaakt!');
    }

    /**
     * Admin: Toon edit form
     */
    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        $categories = ['Algemeen', 'Account', 'Games', 'Community', 'Technisch'];

        return view('admin.faq.edit', compact('faq', 'categories'));
    }

    /**
     * Admin: Update FAQ
     */
    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);

        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'required|string|max:100',
            'order' => 'nullable|integer|min:0',
            'is_published' => 'required|in:0,1',
        ]);

        // Zet order op 0 als niet ingevuld
        $validated['order'] = $validated['order'] ?? 0;

        $faq->update($validated);

        return redirect()->route('admin.faq.index')->with('success', 'FAQ succesvol bijgewerkt!');
    }

    /**
     * Admin: Verwijder FAQ
     */
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('admin.faq.index')->with('success', 'FAQ succesvol verwijderd!');
    }
}
