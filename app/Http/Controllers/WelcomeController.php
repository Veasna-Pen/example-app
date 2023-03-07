<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProjectResource;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $categories = CategoryResource::collection(Category::all());
        $projects = ProjectResource::collection(Project::with('category')->get());
        return Inertia::render('Welcome', compact('categories', 'projects'));
    }
}
