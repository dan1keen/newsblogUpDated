@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                      <div class="col">
                        Admin panel
                      <a class="float-right" href="/form">Add new post</a>
                      </div>
                      <div class="col">
                      <small  class="d-flex justify-content-center">{{$news->onEachSide(2)->appends(Request::except('page'))->links()}}</small>
                    </div>
                    </div>

                    <div class="card-body">
                      <div class="nav nav-justified navbar-nav">

                        <form class="" action="/sort" method="get">
                          <div class="row">
                            <div class="col">
                          <select class="form-control form-control-sm" name="sort" placeholder="Input">
                            <option disabled selected>Select category</option>
                            @foreach($category as $single)
                            <option>{{$single->category}}</option>
                            @endforeach
                          </select>
                        </div>
                        <hr>
                        <div class="col">
                          <input type="search" class="form-control form-control-sm" name="search">
                        </div>
                        <div class="col">
                          <button type="submit" class="btn btn-search btn-default mb-2 form-control-sm">
                              SEARCH
                          </button>
                        </div>

                              </div>
                        </form>

                              </div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="content">
                            <table class="table table-bordered table-hover">
                                <tr>
                                <th>Title</th>
                                <th>Conent</th>
                                <th>Created at</th>
                                <th>Category</th>
                                <th>Author</th>
                                <td colspan="2">Action</td>
                                </tr>
                                 @foreach($news as $single)
                                 <tr>
                                     <td>
                                        <a href="/news/{{$single->id}}">{{$single->title}}</a>
                                     </td>
                                     <td>
                                         {{ str_limit($single->content, $limit = 12, $end = '...') }}
                                     </td>
                                     <td>{{ $single->updated_at }}</td>
                                     <td>{{ $single->category }}</td>
                                     <td>
                                         {{$single->author}}
                                     </td>
                                     <td><a href="/edit/{{$single->id}}" class="btn btn-primary">Edit</a></td>
                                     <td>
                                          <form action="{{ route('shares.destroy', $single->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                          </form>
                                      </td>
                                 </tr>
                                 @endforeach

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
