<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::all();
        return view('faq-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('faq-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        FaqCategory::create($request->all());

        return redirect()->route('faq-categories.index')
                         ->with('success', 'Category created successfully.');
    }

    public function edit(FaqCategory $faqCategory)
    {
        return view('faq-categories.edit', compact('faqCategory'));
    }

    public function update(Request $request, FaqCategory $faqCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $faqCategory->update($request->all());

        return redirect()->route('faq-categories.index')
                         ->with('success', 'Category updated successfully.');
    }

    public function destroy(FaqCategory $faqCategory)
    {
        $faqCategory->delete();

        return redirect()->route('faq-categories.index')
                         ->with('success', 'Category deleted successfully.');
    }
}

