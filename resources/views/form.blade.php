@extends('layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add Share
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
      <form method="post" action="{{ route('shares.store') }}" enctype="multipart/form-data">
          <div class="form-group">
              @csrf
              <label for="name">Title:</label>
              <input type="text" class="form-control" name="title"/>
          </div>
          <div class="form-group">
              <label for="content">Content :</label>
              <textarea class="form-control" name="content"></textarea>
          </div>
          <div class="form-group">
              <label for="content">Category :
                <select class="form-control form-control-sm" name="category">
                  <option></option>
                  @foreach($news as $single)
                  <option>{{$single->category}}</option>
                  @endforeach
                </select>
              </label>

              <input type="text" class="form-control" name="categorys"/>
          </div>
          <div class="form-group">
            <input type="file" name="file" />
          </div>
          <div class="form-group">
              <input type="hidden" class="form-control" value="{{ Auth::user()->name }}" name="author"/>
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
      </form>
  </div>
</div>
@endsection
