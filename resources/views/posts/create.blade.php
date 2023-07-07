@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<h1>buat postingan baru</h1>
<form method="POST" action="{{url("posts")}}" class="form-control" >
@csrf
<div class="mb-3">
<label for="title" class="form-label">title</label>
<input type="text" class="form-control" id="exampleFormControlInput1" name="title" >
</div>
<div class="mb-3">
<label for="content" class="form-label">content</label>
<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content" ></textarea>
</div>
<button class="btn btn-primary" type="submit" >Save</button>
</form>

@endsection