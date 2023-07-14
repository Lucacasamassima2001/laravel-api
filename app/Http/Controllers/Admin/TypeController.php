<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{


    private $validations = [
        'name'=> 'required|string|min:5|max:50',
        'description' =>'required|string||min:5|max:150',
    ];

    private $validation_messages = [
        'required' => 'il campo è obbligatorio',
        'min' => 'il campo contrassegnato richiede almeno :min caratteri',
        'max' => 'il campo contrassegnato richiede almeno :max caratteri',
];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.types.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validations, $this->validation_messages);
        $data = $request->all();

        $newType = new Type();
        $newType->name          = $data['name'];
        $newType->description    = $data['description'];

        $newType->save();
        return to_route('admin.types.show', ['type' => $newType]);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {        
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        {
            return view('admin.types.edit', compact('type'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $request->validate($this->validations, $this->validation_messages);
        $data = $request->all();
        // salvare i dati se corretti
        $type->name = $data['name'];
        $type->description = $data['description'];
        $type->update();

        return to_route('admin.types.show', ['type' => $type]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return to_route('admin.types.index')->with('delete_success', $type);
    }

    public function restore($id)
    {
        Type::withTrashed()->where('id', $id)->restore();

        $type = Type::find($id);

        return to_route('admin.types.index')->with('restore_success', $type);
    }

    public function trashed()
    {
        $trashedTypes = Type::onlyTrashed()->paginate(3);

        return view('admin.types.trashed', compact('trashedTypes'));
    }

    public function harddelete($id)
    {
        $type = Type::withTrashed()->find($id);
        // foreach ($type->projects as $project) {
        //     $project->type_id = 1;
        //     $project->update();
        // }
        $type->forceDelete();

        return to_route('admin.types.index')->with('delete_success', $type);
    }
}
