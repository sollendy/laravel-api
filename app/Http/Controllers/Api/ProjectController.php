<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request) {
        // restituisce tutti i post nel db
        // $projects = Post::all();
        $projects = Project::with("type", "technologies")
        ->orderBy("projects.created_at", "desc")
        ->paginate(6);
            // ->orderBy('projects.created_at', 'desc')
            // ->paginate(6);

        $types = Type::all();

        if($request->has("type_id")) {

            $requestData = $request->all();
            dd($requestData);

        }

        return response()->json([
            'success' => true,
            'results' => $projects,
            'allTypes' => $types,
        ]);
    }

    public function show($slug) {
        $project = Project::where('slug', $slug)->with("type", "technologies")->first();
        
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
