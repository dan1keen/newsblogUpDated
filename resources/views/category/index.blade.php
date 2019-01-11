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

                        <select class="form-control form-control-sm" name="sort" placeholder="Input">
                          <option disabled selected>Select category</option>
                          @foreach($category as $single)
                          <option>{{$single->category}}</option>
                          @endforeach
                        </select>



                      </div>
                      <hr>
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
                    <!-- <div class="justify-content-center">

                                <form method="get" role="search" action="/sort">
                                    <div class="input-group">
                                        <input type="search" class="form-control" name="search">
                                        <span class="form-group-btn">
                                            <button type="submit" class="btn btn-search btn-default">
                                            SEARCH
                                            </button>
                                        </span>

                                    </div>
                                </form>

                            </div> -->

                  </div>

                    <div class="card-header">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="content">
                          @foreach($news as $single)
                          <div class="row">
                            <div class="card col-md-12 p-3">
                              <div class="row">
                                <div class="col-md-4">
                                  <img src="{{ asset('storage/upload/'. $single->image) }}" alt="{{$single->image}}" class="card-img-top">
                                </div>
                                <div class="col-md-8">
                                  <div class="card-block">
                                  <h1 class="card-title"><a href="/news/{{$single->id}}">{{$single->title}}</a></h1>
                                  <p class="card-text text-justify">
                                    {{ str_limit($single->content, $limit = 150, $end = '...') }}
                                  </p>
                                  <hr>
                                    <p class="card-text">
                                      <div class="row">
                                        <div class="col">
                                        <small class="d-flex justify-content-start">
                                          Category: {{$single->category}}
                                        </small>
                                        </div>
                                        <div class="col">
                                          <small class="d-flex justify-content-end">
                                            Published by {{$single->author}} {{$single->updated_at->diffForHumans()}}
                                          </small>
                                        </div>
                                      </div>
                                    </p>
                                  </div>
                                </div>
                              </div>
                          </div>
                        </div>
                        @endforeach
                        <br>
                        <div class="row">
                          <div class="col justify">
                          <span class=" row justify-content-center">{{$news->onEachSide(2)->appends(Request::except('page'))->links()}}</span>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
