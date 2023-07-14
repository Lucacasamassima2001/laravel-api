<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    // validazioni racchiuse in variabili private

    private $validations = [
            'title'=> 'required|string|min:5|max:100',
            'type_id' =>'required|integer|exists:types,id',
            'url_image'=> 'nullable|required|url|max:200',
            // 'image' => 'nullable|image|max:512',
            'repo'=> 'required|string|min:5|max:100',
            'description'=> 'required|string|min:5',
            // 'technologies' => 'nullable|array',
            // 'technologies.*' => 'integer|exists:technologies:id',
    ];

    private $validation_messages = [
            'required' => 'il campo è obbligatorio',
            'min' => 'il campo contrassegnato richiede :min caratteri',
            'max' => 'il campo contrassegnato richiede :max caratteri',
            'url' => 'il campo contrassegnato deve essere un url valido',
            'exists' => 'il campo non è valido',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $projects = Project::paginate(10);
       return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // richiedere($data) e validare i dati del form
        $request->validate($this->validations, $this->validation_messages);
        $data = $request->all();

        // salvare immagine nella cartella uploads
        // prendere il percorso dell'immagine salvata

        $imagePath = Storage::put('uploads', $data['image']);
        // salvare i dati se corretti
        $newProject = new Project();
        $newProject->title          = $data['title'];
        $newProject->type_id        = $data['type_id'];
        $newProject->url_image      = $data['url_image'];
        $newProject->image      = $imagePath;

        $newProject->repo           = $data['repo'];
        $newProject->description    = $data['description'];
        $newProject->save();

        // associare i tag
        $newProject->technologies()->sync($data['technologies'] ?? []);


        // ridirezionare su una rotta di tipo get
        return to_route('admin.projects.show', ['project' => $newProject]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
       return view('admin.projects.show', compact('project'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {

        $request->validate($this->validations, $this->validation_messages);
        // richiedere($data) e validare i dati del form
        $data = $request->all();


        if($data['image']){
        // salvare eventuale img nuova
        $imagePath = Storage::put('uploads', $data['image']);

        if($project->image)
        // eliminare eventuale img vecchia
        Storage::delete($project->image);

        // aggiorno valore nella colonna
        $project->image      = $imagePath;

        }
        

        // salvare i dati se corretti
        $project->title = $data['title'];
        $project->type_id = $data['type_id'];
        $project->url_image = $data['url_image'];
        $project->repo = $data['repo'];
        $project->description = $data['description'];
        $project->update();

        // associare i tag
        $project->technologies()->sync($data['technologies'] ?? []);



        // ridirezionare su una rotta di tipo get
        return to_route('admin.projects.show', ['project' => $project]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('admin.projects.index')->with('delete_success', $project);
    }

    public function restore($id)
    {
        Project::withTrashed()->where('id', $id)->restore();

        $project = Project::find($id);

        return to_route('admin.projects.index')->with('restore_success', $project);
    }

    public function trashed()
    {
        $trashedProjects = Project::onlyTrashed()->paginate(6);

        return view('admin.projects.trashed', compact('trashedProjects'));
    }

    public function harddelete($id)
    {
        

        $project = Project::withTrashed()->find($id);

        if($project->image)
        // eliminare eventuale img vecchia
        Storage::delete($project->image);
        // disassociare tutti i tag dal post
        $project->technologies()->detach();
        // $project->technologies()->sync([]);

        $project->forceDelete();

        


        return to_route('admin.projects.trashed')->with('delete_success', $project);
    }
}
