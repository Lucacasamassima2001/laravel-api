@extends('admin.layouts.base')
@section('contents')
<h1 class="py-3 text-light">Trash can:</h1>

 @if (session('delete_success'))
    @php $project = session('delete_success') @endphp
    <div class="alert alert-danger">
        The project "{{ $project->title }}" has been eliminated
    </div>
@endif


<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Titolo</th>
            <th scope="col">Image</th>
            <th scope="col">Type</th>
            <th scope="col">Technologies</th>
            <th scope="col">Description</th>
            <th scope="col">Actions:</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($trashedProjects as $project)
            <tr>
                <th scope="row">{{ $project->id }}</th>
                <td>{{ $project->title }}</td>
                <td>{{ $project->url_image }}</td>
                <td><a href="{{ route('admin.types.show', ['type' => $project->type]) }}">{{ $project->type->name }}</a></td>
                <td>{{implode(', ' , $project->technologies->pluck('name')->all())}} </td>
                <td>{{ $project->description }}</td>
                <td>
                    <form class="d-inline-block" method="POST" action="{{ route('admin.projects.harddelete', ['project' => $project->id]) }}">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger hard_delete">Hard Delete</button>
                    </form>
                  </td>
                  <td>
                    <form class="d-inline-block" method="POST" action="{{ route('admin.projects.restore', ['project' => $project->id]) }}">
                        @csrf
                        <button class="btn btn-warning">Restore</button>
                    </form>
                  </td>
            </tr>
        @endforeach
    </tbody>
</table>



{{ $trashedProjects->links() }}
@endsection