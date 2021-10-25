@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p> {{ $post->article }}</p>
        <div class="d-flex justify-content-between">
            @if($post->category)
            <div class="text-secondary">Category: 
                <span class="badge badge-pill badge-success p-3">{{ $post->category->name }}</span>
            </div>
            @endif
            <div class="text-secondary">Tags: 
                @forelse ($post->tags as $tag)
                <span class="badge badge-pill text-white p-3" style="background-color: {{ $tag->color }}">{{ $tag->name }}</span>
                @empty 0
                @endforelse
            </div>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-primary align-self-center">Go to Posts</a>
        </div>
    </div>
@endsection