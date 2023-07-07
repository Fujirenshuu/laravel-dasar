@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<h1>buat postingan baru</h1>
<form method="POST" action="{{url("posts/$post->id")}}" class="form-control" >
  @method('PATCH')
  @csrf
  <div class="mb-3">
<label for="title" class="form-label">
Judul
</label>
<input type="text" class="form-control" id="exampleFormControlInput1" name="title" value="    {{$post->title}}" >
</div>
<div class="mb-3">
<label for="content" class="form-label">content</label>
<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content" >
  {{$post->content}}
</textarea>
</div>
<button class="btn btn-primary" type="submit" >Save</button>
</form>
<form method="POST" class="mt-3" action="{{url("posts/$post->id")}}"  >
@method('DELETE')
@csrf
<button class="btn btn-danger" type="submit" >
delete
</button>
</form>
  @endsection