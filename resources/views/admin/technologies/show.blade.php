@extends('admin.layouts.base')

@section('contents')
    <div class="container show">
        <h1 class="text-center text-light py-3">{{$technology->name}}</h1>

        <h2>Projects in this category: <?php echo count($technology->projects)?></h2>
    <ul>
        @foreach ($technology->projects as $project)
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