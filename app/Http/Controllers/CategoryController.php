<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'main_category_id' => 'required|exists:main_categories,id',
            'name'             => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'main_category_id' => $request->main_category_id,
            'name'             => $request->name,
            'status'           => 'active',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Category added successfully');
    }
    public function getCategoriesByType(Request $request)
    {
        Log::info('📥 getCategoriesByType called');
        Log::info('➡ Request type:', [$request->type]);

        $categories = Category::where('type', $request->type)
            ->where('status', 'active')
            ->get(['id', 'name']);

        Log::info('📤 Categories found:', $categories->toArray());

        return response()->json($categories);
    }
}
