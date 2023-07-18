<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // filtro risultati 
        // gestione parametro q
        $searchString = $request->query('q', '');


        $projects = Project::with('type', 'technologies')->where('title', 'LIKE',"%${searchString}%")->paginate(6);

        return response()->json([
            'success' =>  true,
            'results' => $projects,
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $project = Project::where('slug', $slug)->first();
        return response()->json([
            'success' => $project ? true : false,
            'results' => $project,
        ]);

    }

    
}
