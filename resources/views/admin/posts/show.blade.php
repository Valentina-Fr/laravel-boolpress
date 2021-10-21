@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p> {{ $post->article }}</p>
        @if($post->category)
        <span class="badge badge-pill badge-success p-3">{{ $post->category->name }}</span>
        @endif
    </div>
@endsection