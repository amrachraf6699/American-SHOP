<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('min_products') || $request->filled('max_products')) {
            $query->withCount('products');

            if ($request->filled('min_products')) {
                $query->having('products_count', '>=', $request->input('min_products'));
            }
            if ($request->filled('max_products')) {
                $query->having('products_count', '<=', $request->input('max_products'));
            }
        } else {
            $query->withCount('products');
        }

        if ($request->filled('create_start') || $request->filled('create_end')) {
            if ($request->filled('create_start')) {
                $query->whereDate('created_at', '>=', $request->input('create_start'));
            }
            if ($request->filled('create_end')) {
                $query->whereDate('created_at', '<=', $request->input('create_end'));
            }
        }

        if ($request->filled('parent_only')) {
            $query->whereNull('parent_id');
        }

        // Pagination
        $categories = $query->paginate(10);

        return view('manage.categories.home', compact('categories'));
    }



    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $parentCategories = Category::whereNull('parent_id')->get();


        return view('manage.categories.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255|unique:categories',
                'description' => 'required|string|max:255',
                'cover' => 'required|image|max:2048',
                'parent_id' => 'nullable|exists:categories,id',
            ]
        );

        $category = Category::create(
            [
                'name' => $request->name,
                'description' => $request->description,
                'parent_id' => $request->parent_id,
            ]
        );

        if ($request->hasFile('cover')) {
            $category->file()->create(
                [
                    'name' => 'Category - '.$category->name,
                    'path' => $this->uploadImage($request->file('cover'), 'categories'),
                ]
            );
        }

        return redirect()->route('admin.categories.index')->with('success', "$category->name has been created successfully!!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        $category->load('products');

        return view('manage.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        $categories = Category::whereNull('parent_id')->get();

        return view('manage.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate(
            [
                'name' => 'required|string|max:255|unique:categories,name,'.$category->id,
                'description' => 'required|string|max:255',
                'cover' => 'nullable|image|max:2048',
                'parent_id' => 'nullable|exists:categories,id',
            ]
        );

        $category->update(
            [
                'name' => $request->name,
                'description' => $request->description,
                'parent_id' => $request->parent_id,
            ]
        );

        if ($request->hasFile('cover')) {
            if ($category->file) {
                $this->DeleteImage($category->file->path);
                $category->file()->delete();
            }

            $category->file()->create(
                [
                    'name' => 'Category - '.$category->name,
                    'path' => $this->uploadImage($request->file('cover'), 'categories'),
                ]
            );
        }

        return redirect()->route('admin.categories.index')->with('success', "$category->name has been updated successfully!!");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->file) {
            $this->DeleteImage($category->file->path);
            $category->file()->delete();
        }

        session()->flash('success', "$category->name has been deleted successfully!!");
        $category->delete();

        return redirect()->route('admin.categories.index');
    }
}
