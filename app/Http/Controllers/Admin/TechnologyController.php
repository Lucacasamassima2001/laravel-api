<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technology;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TechnologyController extends Controller
{

    private $validation = [
        'name'=> 'required|string|min:2|max:50',
    ];

    private $validation_message = [
        'required' => 'il campo è obbligatorio',
        'min' => 'il campo contrassegnato richiede almeno :min caratteri',
        'max' => 'il campo contrassegnato richiede massimo :max caratteri',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::paginate(10);
       return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $technologies = Technology::all();

        return view('admin.technologies.create', compact('technologies'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validation, $this->validation_message);

        $data = $request->all();
        // salvare i dati se corretti
        $newTechnology = new Technology();
        $newTechnology->name          = $data['name'];
        
        $newTechnology->save();

        // ridirezionare su una rotta di tipo get
        return to_route('admin.technologies.index', ['technology' => $newTechnology]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        $technologies = Technology::all();

        return view('admin.technologies.edit', compact('technology'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology $technology)
    {
        // richiedere($data) e validare i dati del form
        $request->validate($this->validation, $this->validation_message);

        $data = $request->all();
        // salvare i dati se corretti
        $technology->name = $data['name'];
        
        $technology->update();

        // ridirezionare su una rotta di tipo get
        return to_route('admin.technologies.index', ['technology' => $technology]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology->projects()->detach();
        // technology_id in cui mandare i post
        $defaultTech = Technology::find(1);

        // seleziono i post da spostare nel nuovo technology_id
        $projectsId = $technology->projects->pluck('id')->all();

        //dissociare tutti i tag dal technology
        $technology->projects()->detach();

        // associo i post al nuovo technology_id
        foreach ($projectsId as $project) {
            $defaultTech->projects()->attach($project);
        }

        // $project->technologies()->sync([]);
        $technology->delete();
        
        return to_route('admin.technologies.index')->with('delete_success', $technology);
    }
}
