<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        // restituisce tutti i post nel db
        // $projects = Post::all();
        $projects = Project::with("type", "technologies")->orderBy("projects.created_at", "desc")->paginate(6);
            // ->orderBy('projects.created_at', 'desc')
            // ->paginate(6);

        return response()->json([
            'success' => true,
            'results' => $projects
        ]);
    }

    public function show($slug) {
        $project = Project::where('slug', $slug)->first();
        
        // dd($project);

        if ($project) {
            return response()->json([
                'success' => true,
                'project' => $project,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => "non vi è progetto alcuno",
            ]);
        }

    }
}
