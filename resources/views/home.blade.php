@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @can('isAdmin')
            @include('admin.dashboard')
        @else
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header"> {{ Auth::user()->type }} Dashboard</div>
                  <div class="card-body">
                      @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif
                      You are logged in!
                  </div>
              </div>
          </div>
        @endcan
    </div>
</div>
@endsection