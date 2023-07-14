@extends('admin.layouts.base')
@section('contents')
<h1 class="py-3 text-light">Types:</h1>

 @if (session('delete_success'))
    @php $type = session('delete_success') @endphp
    <div class="alert alert-danger">
        The type "{{ $type->name }}" has been deleted
        <form
            action="{{ route("admin.types.restore", ['type' => $type]) }}"
                method="post"
                class="d-inline-block"
            >
            @csrf
            <button class="btn btn-warning">Restore</button>
        </form>
    </div>
@endif

@if (session('restore_success'))
    @php $type = session('restore_success') @endphp
    <div class="alert alert-success">
        Type "{{ $type->name }}" has been restored
    </div>
@endif 



<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Number of Projects</th>
            <th scope="col">Actions:</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($types as $type)
            <tr>
                <th scope="row">{{ $type->id }}</th>
                <td>{{ $type->name }}</td>
                <td><?php echo count($type->projects)?></td>
                <td>
                    <a class="btn btn-primary" href="{{ route('admin.types.show', ['type' => $type]) }}">View all</a>
                </td>
                <td>
                    <a class="btn btn-warning" href="{{ route('admin.types.edit', ['type' => $type]) }}">Edit</a>
                </td>
                <td>
                    <button type="button" class="btn btn-danger js-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="
                    {{$type->id}}">
                        Delete
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
          Do you want to delete this type?
        </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form
                        action="{{ route('admin.types.destroy', ['type' => $type]) }}"
                        data-template="{{ route('admin.types.destroy', ['type' => '*****']) }}"
                        method="post"
                        class="d-inline-block"
                        id="confirm-delete"
                    >
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Delete</button>
                    </form>
            </div>
        </div>
    </div>
</div>

{{-- {{ $types->links() }} --}}
@endsection