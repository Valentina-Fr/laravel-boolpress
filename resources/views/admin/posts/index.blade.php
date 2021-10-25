@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
          <h1>My Blog</h1>
          <a href="{{ route('admin.posts.create') }}" class="btn btn-success align-self-center">Write new post</a>
        </div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Title</th>
                <th scope="col">Written on</th>
                <th scope="col">Author</th>
                <th scope="col" class="text-center">Category</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @forelse ($posts as $post)
              <tr>
                <th>{{ $post->title }}</th>
                <td>{{ $post->getFormattedDate('created_at') }}</td>
                <td>@if($post->author){{ $post->author->name }} @else Anonymous @endif</td>
                <td class="text-center">@if($post->category) <span class="badge badge-pill badge-success p-2">{{ $post->category->name }}</span> @else - @endif</td>
                <td class="d-flex justify-content-around">
                  <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-primary">Read</a>
                  <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-secondary">Edit</a>
                  <form method="POST" action="{{ route('admin.posts.destroy', $post->id) }}">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                  <td colspan="3" class="text-center">No posts</td>
              </tr>
              @endforelse
            </tbody>
        </table>
        <section class="pb-2">
          {{ $posts->links() }}
        </section>
        <hr>
        <h3>Posts by category</h3>
        <div class="row">
          @foreach ($categories as $category)
            <div class="col-3 pt-5">
              <h4>{{ $category->name }}</h4>
                @forelse($category->posts as $post) 
                <a href="{{ route('admin.posts.show', $post->id) }}" class="d-block">{{ $post->title }}</a>
                @empty
                <p>No posts yet</p>
                @endforelse
            </div>
          @endforeach
          </div>
        </div>
    </div>
@endsection