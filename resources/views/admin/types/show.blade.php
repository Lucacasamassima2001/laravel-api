@extends('admin.layouts.base')

@section('contents')
    <div class="container show">
        <h1 class="text-center text-light py-3">{{$type->name}}</h1>
        <p>Description: {{$type->description}}</p>

        <h2>Projects in this category: <?php echo count($type->projects)?></h2>
    <ul>
        @foreach ($type->projects as $project)
            <li><a href="{{ route('admin.projects.show', ['project' => $project]) }}">{{ $project->title }}</a></li>
        @endforeach
    </ul>
    </div>
@endsection


<style lang="scss" scoped>
    .show{
        color: white;
    }
</style>