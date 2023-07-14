@extends('admin.layouts.base')

@section('contents')
    <h1 class="main-title py-3">Edit this type</h1>
    <form method="POST" action="{{ route('admin.types.update', ['type' => $type]) }}" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Titolo</label>
            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="name"
                name="name"
                value="{{ old('name', $type->name) }}"
            >
            <div class="invalid-feedback">
                @error('name') {{ $message }} @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input
                type="text"
                class="form-control @error('description') is-invalid @enderror"
                id="description"
                name="description"
                value="{{ old('description', $type->description) }}"
            >
            <div class="invalid-feedback">
                @error('description') {{ $message }} @enderror
            </div>
        </div>

        
            
        <button class="btn btn-primary">Salva</button>
    </form>
@endsection


<style lang="scss" scoped>
    .main-title{
        color: white;
    }

    form{
        color: white;
    }
</style>