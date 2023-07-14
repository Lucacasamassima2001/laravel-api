@extends('admin.layouts.base')

@section('contents')
    <h1 class="main-title py-3">Add new Technology</h1>
    <form method="POST" action="{{ route('admin.technologies.store') }}" novalidate>
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="name"
                name="name"
                value="{{ old('name') }}"
            >
            <div class="invalid-feedback">
                @error('name') {{ $message }} @enderror
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
