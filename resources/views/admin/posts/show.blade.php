@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p> {{ $post->article }}</p>
        <div class="d-flex justify-content-between">
            @if($post->category)
            <span class="badge badge-pill badge-success p-3">{{ $post->category->name }}</span>
            @endif
            <a href="{{ route('admin.posts.index') }}" class="btn btn-primary align-self-center">Go to Posts</a>
        </div>
    </div>
@endsection