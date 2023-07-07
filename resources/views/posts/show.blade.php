@extends('layouts.app')

@section('title', "Blog ||$post->title")

@section('content')
    <div class="container">
        <article class="blog-post">
        <h2 class="display-5 link-body-emphasis mb-1">{{$post->title}}</h2>
                <p class="card-text">{{ $post->content }}</p>
            <p>{{ date("d-M-Y H:i:s", strtotime($post->updated_at)) }}</p>
            
            <small class="text-muted">{{$totalComments}} Comment</small>
            @foreach ($comments as $comment)

                <div class="card mb-3">
                    <div class="card-body">
                        <p style="font-size: 8pt">
                        {{$comment->comment}}
                        </p>
                    </div>
                </div>
            @endforeach
        </article>
      <a href="{{url("posts")}}">Back</a>
    </div>
    
@endsection