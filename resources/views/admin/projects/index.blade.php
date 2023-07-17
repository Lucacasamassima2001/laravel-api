@extends('admin.layouts.base')
@section('contents')
<h1 class="py-3 text-light">My Projects:</h1>

 @if (session('delete_success'))
    @php $project = session('delete_success') @endphp
    <div class="alert alert-danger">
        The project "{{ $project->title }}" has been moved to trash can
        <form
            action="{{ route("admin.projects.restore", ['project' => $project]) }}"
                method="post"
                class="d-inline-block"
            >
            @csrf
            <button class="btn btn-warning">Restore</button>
        </form>
    </div>
@endif

@if (session('restore_success'))
    @php $project = session('restore_success') @endphp
    <div class="alert alert-success">
        Project "{{ $project->title }}" has been restored
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
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($projects as $project)
            <tr>
                <th scope="row">{{ $project->id }}</th>
                <td>{{ $project->title }}</td>
                <td>{{ $project->url_image }}</td>
                <td>
                    @if($project->type)
                    <a href="{{ route('admin.types.show', ['type' => $project->type]) }}">{{ $project->type->name }}</a>
                    @else
                    uncategorized
                    @endif
                </td>
                {{-- <td>{{implode(', ' , $project->technologies->pluck('name')->all())}}</td> --}}
                <td>
                    @foreach($project->technologies as $technology)
                    @if($project->technologies)
                    <a href="{{ route('admin.technologies.show', ['technology' => $technology]) }}">{{ $technology->name }}</a>
                    @else
                    uncategorized
                    @endif  
                    @if (!$loop->last),  @endif
                    @endforeach
                </td>
                <td>{{ $project->description }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('admin.projects.show', ['project' => $project]) }}">View</a>
                    
                </td>
                <td>
                    <a class="btn btn-warning" href="{{ route('admin.projects.edit', ['project' => $project]) }}">Edit</a>
                </td>
                <td>
                    <button type="button" class="btn btn-danger js-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="
                    {{$project->id}}">
                        Trash
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>



<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Action confirmation</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
          Do you want to move this project to trash?
        </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form
                        action="{{ route('admin.projects.destroy', ['project' => $project]) }}"
                        data-template="{{ route('admin.projects.destroy', ['project' => '*****']) }}"
                        method="post"
                        class="d-inline-block"
                        id="confirm-delete"
                    >
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Trash</button>
                    </form>
            </div>
        </div>
    </div>
</div>

{{ $projects->links() }}
@endsection