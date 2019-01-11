@extends('layouts.app')
@section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                          <div class="row">
                          <div class="col-md-7">
                          <h1 class="card-title">{{$single->title}}</h1>
                          </div>
                          <div class="col">
                          <small class="d-flex justify-content-end">
                            Category: {{$single->category}}
                          </small>
                          </div>
                          </div>
                        </div>
                        <div class="card-body">
                          <img src="{{ asset('storage/upload/'. $single->image) }}" alt="{{$single->image}}" class="card-img-top">
                            <hr>
                            <p class="card-text">{{$single->content}}</p>
                            <div class="card-footer">
                              <div class="row">
                              <p class="card-text">
                              <div class="col">
                              <small class="d-flex justify-content-end">
                                Published by {{$single->author}} {{$single->updated_at->diffForHumans()}}
                              </small>
                              </p>
                            </div>
                            </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
