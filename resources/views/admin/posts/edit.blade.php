@extends('layouts.app')
@section('content')
<div class="container">
    <form method="POST" action="{{ route('admin.posts.update', $post) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="{{ $post->title }}">
        </div>
        <div class="form-group">
          <label for="article">Article</label>
          <textarea rows="5" class="form-control" id="article" name="article" placeholder="Write your post">{{ $post->article }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection