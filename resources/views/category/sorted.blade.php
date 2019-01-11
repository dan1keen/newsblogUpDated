@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                  <div class="card-header">

                    <div class="justify-content-center">
                      <form class="" action="/sort" method="get">
                        <div class="input-group">

                        <select class="form-control form-control-sm" name="sort" onchange="this.form.submit();">
                          <option></option>
                          @foreach($category as $single)
                          <option>{{$single->category}}</option>
                          @endforeach
                        </select>



                      </div>
                      </form>
                      <hr>
                    </div>
                    <div class="justify-content-center">

                                <form method="get" role="search" action="/search">
                                    <div class="input-group">
                                        <input type="search" class="form-control" name="search">
                                        <span class="form-group-btn">
                                            <button type="submit" class="btn btn-search btn-default">
                                            SEARCH
                                            </button>
                                        </span>

                                    </div>
                                </form>

                            </div>

                  </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="content">
                            @foreach($news as $single)
                                <h1><a href="/news/{{$single->id}}">{{$single->title}}</a></h1>
                                <small class="d-flex justify-content-start">
                                  Category: {{$single->category}}
                                </small>
                                <small class="d-flex justify-content-end">
                                  Published by {{$single->author}} {{$single->updated_at->diffForHumans()}}
                                </small>
                                <hr>

                            @endforeach
                        </div>


                        <span class=" row justify-content-center">{{$news->onEachSide(2)->appends(Request::except('page'))->links()}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
