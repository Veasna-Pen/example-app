<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = request('perPage') ?: 5;

        $projects = Project::with('category')
            ->when(request('search'), function($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate($perPage)
            ->appends(request()->query());

        $projects = ProjectResource::collection($projects);

        $filters = request()->only(['search', 'perPage']);

        return Inertia::render('Project/Index', compact('projects', 'filters'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return Inertia::render('Project/Create', compact('categories'));
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
            'category_id' => ['required'],
            'image' => ['required', 'image'],
            'name' => ['required', 'min:3'],
            'description' => ['required']

        ]);

        if($request->hasFile('image')){
            $image = $request->file('image')->store('projects');
            Project::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'image' => $image,
                'description' => $request->description,
                'project_url' => $request->project_url
            ]);
            return Redirect::route('projects.index')->with('message', 'Project created successfully.');
        }
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $project = new ProjectResource(Project::with('category')->findOrFail($id));
    //     return Inertia::render('ProjectDetail', compact('project'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $categories = Category::all();
        return Inertia::render('Project/Edit', compact('project', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $image = $project->image;
        $request->validate([
            'name' => ['required', 'min:3'],
            'category_id' => ['required'],
            'description' => ['required']
        ]);
        if($request->hasFile('image')){
            Storage::delete($project->image);
            $image = $request->file('image')->store('projects');
        }

        $project->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'project_url' => $request->project_url,
            'image' => $image
        ]);
        return Redirect::route('projects.index')->with('message', 'Action completed.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        Storage::delete($project->image);
        $project->delete();
        return Redirect::back()->with('message', 'Project deleted successfully');
    }
}
