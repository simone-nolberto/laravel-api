<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('type', 'technologies')->paginate(3);

        return response()->json([

            'success' => true,
            'projects' => $projects,
        ]);
    }


    public function show($id)
    {
        $project = Project::with('type', 'technologies')->where('id', $id)->first();

        if ($project) {
            return response()->json([

                'success' => true,
                'response' => $project,
            ]);
        } else {

            return response()->json([

                'success' => false,
                'response' => 'Sorry, nothing found here',
            ]);
        }
    }
}
