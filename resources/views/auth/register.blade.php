@extends('guests.layouts.base')

@section('contents')
<form method="post" action="{{ route('register') }}">
    @csrf
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required autofocus autocomplete="name">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{old('email')}}" required autofocus autocomplete="email" name="email">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password_confirmation">
      </div>
      <a  href="{{ route('login') }}">
          Already registered?
      </a>
      <button type="submit" class="btn btn-primary">Register</button>  
</form> 
@endsection