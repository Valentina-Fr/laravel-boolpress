@if ($errors->any())
<div class="alert alert-danger">
  Please check your input data
</div>
@endif
@if ($post->exists)
<form method="POST" action="{{ route('admin.posts.update', $post) }}">
    @method('PATCH')    
@else
<form method="POST" action="{{ route('admin.posts.store', $post) }}">
@endif
    @csrf
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter title" value="{{ old('title', $post->title) }}">
      <div class="invalid-feedback">
        @error('title') {{ $message }} @enderror
      </div>
    </div>
    <div class="form-group">
      <label for="article">Article</label>
      <textarea rows="5" class="form-control @error('article') is-invalid @enderror" id="article" name="article" placeholder="Write your post">{{ old('article', $post->article) }}</textarea>
      <div class="invalid-feedback">
        @error('article') {{ $message }} @enderror
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>