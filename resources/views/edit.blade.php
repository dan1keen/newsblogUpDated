@extends('layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit Share
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('shares.update', $news->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
          <label for="name">Title:</label>
          <textarea rows="1" class="form-control" name="title">{{ $news->title }}</textarea>
        </div>
        <div class="form-group">
          <label for="price">Content</label>
          <textarea rows="5" class="form-control" name="content">{{$news->content}}</textarea>
        </div>
        <div class="form-group">
          <input type="hidden" class="form-control" name="author" value={{ $news->author }} />
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
  </div>
</div>
@endsection
