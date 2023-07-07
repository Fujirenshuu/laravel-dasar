@extends('layouts.app')
@section('title', 'register')

@section('content')

<div class="row">
    <div class="col-md-4"></div>

    <div class="card col-md-4">
        <div class="card-body">
            <h1 class="text-center">Register</h1>
            @if(session()->has('error_message'))
            <div class="alert alert-danger">
                {{session()->get('error_message')}}
            </div @endif <form action="{{url('register')}}" method="POST" class="form-control">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control">
                @if($errors->has('name'))
                <span class="text-danger">{{$errors->first('name')}} </span>
                @endif
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control">
                @if($errors->has('email'))
                <span class="text-danger">{{$errors->first('email')}} </span>
                @endif

            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                @if($errors->has('password'))
                <span class="text-danger">{{$errors->first('password')}} </span>
                @endif

            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password" class="form-control">
            </div>

            <button type="submit" class="btn btn-danger"> Register</button>

            </form>
        </div>
    </div>
</div>

@endsection
