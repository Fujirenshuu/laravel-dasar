@extends('layouts.app')
@section('title', 'login')

@section('content')

<div class="row">
    <div class="col-md-4"></div>

    <div class="card col-md-4">
        <div class="card-body">
            <h1 class="text-center">Login</h1>
            @if(session()->has('error_message'))
            <div class="alert alert-danger">
                {{session()->get('error_message')}}
            </div @endif <form action="{{url('login')}}" method="POST" class="form-control">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-danger"> Login</button>
            <div class="container flex my-3">
                <span> Belum punya akun? Daftar dulu di </span>
                <a href="{{url('register')}}">sini</a>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
