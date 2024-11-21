<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use Illuminate\Http\Request;

class HomeSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $home_sliders = HomeSlider::query()
            ->when($request->search , function ($query , $search) {
                return $query->where('title' , 'like' , '%' . $search . '%')
                    ->orWhere('description' , 'like' , '%' . $search . '%')
                    ->orWhere('link' , 'like' , '%' . $search . '%');
            })
            ->when($request->opens_new_tab , function ($query , $opens_new_tab) {
                return $query->where('opens_new_tab' , $opens_new_tab);
            })
            ->paginate(10);

        return view('manage.home_sliders.home' , compact('home_sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manage.home_sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'link' => 'required|url',
            'opens_new_tab' => 'required|boolean',
            'cover' => 'required|image|max:2048|mimes:jpg,jpeg,png',
        ]);

        $slider = HomeSlider::create($request->except('cover'));

        $slider->file()->create([
            'name' => 'Cover of ' . $slider->title . ' slider',
            'path' => $request->file('cover')->store('home_sliders' , 'public'),
        ]);

        return redirect()->route('admin.home_sliders.index')->with('success' , 'Slider created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = HomeSlider::findOrFail($id);

        return view('manage.home_sliders.edit' , compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'link' => 'required|url',
            'opens_new_tab' => 'required|boolean',
            'cover' => 'nullable|image|max:2048|mimes:jpg,jpeg,png',
        ]);

        $slider = HomeSlider::findOrFail($id);

        $slider->update($request->except('cover'));

        if($request->cover)
        {
            $slider->file->delete();

            $slider->file()->create([
                'name' => 'Cover of ' . $slider->title . ' slider',
                'path' => $request->file('cover')->store('home_sliders' , 'public'),
            ]);
        }

        return redirect()->route('admin.home_sliders.index')->with('success' , 'Slider updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = HomeSlider::findOrFail($id);

        if($slider->file){
            $slider->file->delete();
        }
        $slider->delete();

        return redirect()->route('admin.home_sliders.index')->with('success' , 'Slider deleted successfully');
    }
}
