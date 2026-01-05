<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::withCount('topics')->latest()->get();

        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        Category::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'slug' => Str::slug($validated['name']),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');

    }

    public function show(Category $category){

        $topics = $category->topics();

        if(request()->filled('search')){
            $search = request()->query('search');

            $topics->where('title', 'LIKE', "%{$search}%");
        }

        $topics = $topics->with(['user' , 'category'])->withCount('replies')->latest()->paginate(10)->withQueryString();

        return view('admin.categories.show', ['category' => $category, 'topics' => $topics]);
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category )
    {

        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $category->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'slug' => Str::slug($validated['name']),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }
}
