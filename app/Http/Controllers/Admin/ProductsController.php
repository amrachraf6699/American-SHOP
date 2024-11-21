<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateProductRequest;
use App\Jobs\SendToNewsLetterJob;
use App\Models\Category;
use App\Models\File;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $query = Product::with('categories', 'files', 'categories.file')
            ->withCount('orders');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%')
            ->orWhere('description', 'like' , '%' . $request->input('name'));
        }
        if ($request->filled('category_id')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('id', $request->input('category_id'));
            });
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('min_orders')) {
            $query->having('orders_count', '>=', $request->min_orders);
        }
        if ($request->filled('max_orders')) {
            $query->having('orders_count', '<=', $request->max_orders);
        }


        if ($request->filled('min_orders') && $request->filled('max_orders')) {
            $query->having('orders_count', '>=', $request->input('min_orders'))
                  ->having('orders_count', '<=', $request->input('max_orders'));
        }

        if ($request->filled('home_slider')) {
            $query->where('home_slider', 1);
        }

        if ($request->filled('discount')) {
            $query->wherenotnull('discount');
        }

        $products = $query->latest()->paginate(10);

        $categories = Category::all();

        return view('manage.products.home', compact('products', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $categories = Category::all();
        return view('manage.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(CreateProductRequest $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'home_slider' => $request->home_slider,
        ]);

        $product->categories()->attach($request->categories);

        foreach ($request->images as $image) {
            $product->files()->create([
                'name' => 'Category - '.$product->name,
                'path' => $this->uploadImage($image, 'products'),
            ]);
        }

        if ($request->send_to_newsletter)
        {
            SendToNewsLetterJob::dispatch($product);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $product = Product::with('categories','files', 'categories.file')->findOrFail($id);

        return view('manage.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $product = Product::with('categories' , 'files')->findOrFail($id);
        $categories = Category::all();

        return view('manage.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'discount' => 'nullable|numeric|lte:price',
            'home_slider' => 'required|boolean',
            'categories' => 'required|array',
            'categories.*' => 'required|exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'home_slider' => $request->home_slider,
        ]);

        $product->categories()->sync($request->categories);

        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                $product->files()->create([
                    'name' => 'Category - '.$product->name,
                    'path' => $this->uploadImage($image, 'products'),
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->files->count() > 0) {
            foreach ($product->files as $file) {
                $this->deleteImage($file->path);
                $file->delete();
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    public function home_slider(Product $product)
    {
        $product->update([
            'home_slider' => !$product->home_slider,
        ]);

        return back()->with('success', 'Home slider status updated successfully.');
    }


}
