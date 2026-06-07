<?php

namespace App\Http\Controllers;

use App\Models\CategoryAZU;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

///Controller responsible for category management.//
/*Handles creation, updating, listing and deletion of task categories.
Categories are used to organize and group tasks within the system.*/
class CategoryControllerAZU extends Controller
{
    //Displays a paginated list of categories.//
    //Each category includes a count of related tasks.//
    public function index(): View
    {
        return view('categories.index', [
            'categories' => CategoryAZU::withCount('tasks')->orderBy('name')->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('categories.create', ['category' => new CategoryAZU()]);
    }


    //Creates a new category.//
    //Validates input, generates a URL friendly slug and stores the category in the database.//
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
        ]);


        //Generates a URL friendly slug from category name.//
        $data['slug'] = Str::slug($data['name']);

        CategoryAZU::create($data);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(CategoryAZU $category): View
    {
        return view('categories.edit', compact('category'));
    }



    //Updates an existing category.//
    /* Ensures unique name validation excluding current record and regenerates slug based on updated name.*/
    public function update(Request $request, CategoryAZU $category): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,'.$category->id],
        ]);

        //Regenerate slig when category name changes.//
        $data['slug'] = Str::slug($data['name']);

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    //Deletes a category from the system.//
    /*Removes category permanently.*/
    public function destroy(CategoryAZU $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
