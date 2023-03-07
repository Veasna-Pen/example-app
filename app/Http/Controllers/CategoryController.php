<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = request('perPage') ?: 5;

        $categories = Category::query()
            ->when(request('search'), function($query, $search){
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate($perPage)
            ->appends(request()->query());

        $categories = CategoryResource::collection($categories);

        $filters = request()->only(['search', 'perPage']);

        return Inertia::render('Category/Index', compact('categories', 'filters'));

       // Code above cannot search and filter
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Category/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'image' => ['required', 'image'],
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image')->store('categories');
            Category::create([
                'name' => $request->name,
                'image' => $image,
            ]);
            return Redirect::route('categories.index')->with('message', 'Category created successfully.');
        }
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return Inertia::render('Category/Edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $image = $category->image;
        $request->validate([
            'name' => 'required|unique:categories,name'
        ]);
        if($request->hasFile('image')){
            Storage::delete($category->image);
            $image = $request->file('image')->store('categories');
        }
        $category->update([
            'name' => $request->name,
            'image' => $image
        ]);
        return Redirect::route('categories.index')->with('message', 'Action Completed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Storage::delete($category->image);
        $category->delete();
        return Redirect::back();

    }
}
