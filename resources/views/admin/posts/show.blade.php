@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p> {{ $post->article }}</p>
        <div class="d-flex justify-content-between align-items-center">
            @if($post->category)
            <div class="text-secondary">Category: 
                <span class="badge badge-pill p-2 text-white" style="background-color: {{ $post->category->color }}">{{ $post->category->name }}</span>
            </div>
            @endif
            <div class="text-secondary">@if(count($post->tags)) Tags: @endif
                @foreach ($post->tags as $tag)
                <span class="badge badge-pill text-white p-2" style="background-color: {{ $tag->color }}">{{ $tag->name }}</span>
                @endforeach
            </div>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Go to Posts</a>
        </div>
    </div>
@endsection