@extends('admin.layouts.base')
@section('contents')
<h1 class="py-3 text-light">Trash can:</h1>

 @if (session('delete_success'))
    @php $type = session('delete_success') @endphp
    <div class="alert alert-danger">
        The type "{{ $type->name }}" has been eliminated
    </div>
@endif


<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Actions:</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($trashedTypes as $type)
            <tr>
                <th scope="row">{{ $type->id }}</th>
                <td>{{ $type->name }}</td>
                <td>{{ $type->description }}</td>
                <td>
                    <form class="d-inline-block" method="POST" action="{{ route('admin.types.harddelete', ['type' => $type->id]) }}">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger hard_delete">Hard Delete</button>
                    </form>
                  </td>
                  <td>
                    <form class="d-inline-block" method="POST" action="{{ route('admin.types.restore', ['type' => $type->id]) }}">
                        @csrf
                        <button class="btn btn-warning">Restore</button>
                    </form>
                  </td>
            </tr>
        @endforeach
    </tbody>
</table>



{{ $trashedTypes->links() }}

@endsection