
@extends('admin.layouts.base')

@section('contents')
<div class="container dashboard">
    <h1 class="text-center py-5 main-title">Welcome to your dashboard!</h1>
    <h2 class="text-center">This is your staging area for all your projects.</h2>
    <p class="text-center">This current version is an early build, it's still on development...</p>
    <h3 class="py-3">Here you can:</h3>
    <ul class="capabilities">
        <li>Stage your works.</li>
        <li>Edit your works.</li>
        <li>Delete your works.</li>
    </ul>
</div>   
@endsection

<style lang="scss" scoped>

.dashboard{
    color: white;
}

.main-title{
    color: white;
    font-size: 4em;
}

.capabilities{
    font-size: 1.5em;
}





</style>