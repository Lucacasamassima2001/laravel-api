@extends('admin.layouts.base')

@section('contents')
    <div class="container show">
        <h1 class="text-center text-light py-3">{{$project->title}}</h1>
        <h2 class="text-center text-light py-3">{{$project->repo}}</h2>
        <h3>Technologies: {{implode(', ' , $project->technologies->pluck('name')->all())}} </h3>
        <h5 class="text-light">Type: {{$project->type->name}} </h5>
        <h4>What is this project about?</h4>
        <p>"{{$project->description}}"</p>
        <h4 class="py-3">See the project:</h4>
        <div class="container d-flex justify-content-center">
            <img class="py-3" src="{{$project->url_image}}" alt="">
        </div>
        <div class="container d-flex justify-content-center">
            <img class="py-3" src="{{asset('storage/' . $project->image)}}" alt="">
        </div>
    </div>
@endsection


<style lang="scss" scoped>
    .show{
        color: white;
    }
</style>