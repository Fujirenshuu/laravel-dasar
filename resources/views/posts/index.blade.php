@extends('layouts.app')

@section('title', 'Blogs')

@section('content')
<h1>halo bang ini post</h1>
<a href="{{ url('posts/create') }}" class="btn btn-success">buat postingan +</a>
@foreach ($posts as $post)
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        <p class="card-text">{{ $post->content }}</p>
        <p class="card-text"><small class="text-body-secondary">last updated at: {{ date("d-M-Y H:i:s", strtotime($post->updated_at)) }}</small></p>
            <a href="{{ url("posts/$post->id") }}" class="btn btn-primary" >read more
        </a>
            <a href="{{ url("posts/$post->id/edit") }}" class="btn btn-warning" > edit</a>
    </div>
</div>
@endforeach
@endsection