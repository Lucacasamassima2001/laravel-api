@extends('admin.layouts.base')
@section('contents')
<h1 class="py-3 text-light">Technologies:</h1>


@if (session('delete_success'))
    @php $technology = session('delete_success') @endphp
    <div class="alert alert-danger">
        The Technology "{{ $technology->name }}" has been deleted
    </div>
@endif


<div class="container py-4 d-flex flex-wrap gap-4">
    @foreach($technologies as $technology)
    <div class="card" style="width: 12rem;">
        <div class="card-body">
          <h5 class="card-title text-center">{{$technology->name}}</h5>
          <div class="container py-2">
            <a class="btn btn-warning" href="{{ route('admin.technologies.edit', ['technology' => $technology]) }}">Edit</a>
            <button type="button" class="btn btn-danger js-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="
            {{$technology->id}}">
                Delete
            </button>
          </div>

        </div>
      </div>
      @endforeach
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Action confirmation</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
          Do you want to delete this language?
        </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form
                        action="{{ route('admin.technologies.destroy', ['technology' => $technology]) }}"
                        data-template="{{ route('admin.technologies.destroy', ['technology' => '*****']) }}"
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

{{ $technologies->links() }}

  @endsection


  