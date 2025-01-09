<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Show the category details
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.dashboard', compact('category'));
    }

    // Store the new category in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
        ], [
            'name.required' => 'The category name is required.',
            'name.string' => 'The category name must be a string.',
            'name.max' => 'The category name cannot exceed 255 characters.',
            'name.unique' => 'This category name already exists. Please choose a different name.',
            'description.string' => 'The description must be a valid string.',
        ]);

        // Insert the new category into the database
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        // Redirect back with success message
        return redirect()->route('dashboard')->with('success', 'Category added successfully!');
    }

    // Update the category details
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('dashboard')->with('success', 'Category updated successfully!');
    }

    // Delete tha category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('dashboard')->with('success', 'Category deleted successfully!');
    }

    public function showSearchModal()
{
    $categories = Category::all(['id', 'name']); // Fetch all categories
    return view('layouts.frontend', compact('categories')); // Pass categories to the view
}
    


}
