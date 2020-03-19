@extends('layouts.adminApp')

@section('content')
<div class="container">
  <div class="list-group">
      @if (session()->has('success'))
        <div class="d-flex justify-content-center alert alert-success">
            {{ session()->get('success')}}
        </div>
      @endif
    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
      <div class="d-flex w-100 justify-content-between">
        <h1>Users</h1>
      </div>
    </a>
    @foreach ($users as $user)
      <a href="/user/{{ $user->user_name }}" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1">{{ $user->user_name }}</h5>
          <div class="float-right">
            <span class="badge badge-primary float-right badge-pill">{{ $user->questions->count() }} questions</span>
        </div>
        </div>
        <small class="text-muted font-weight-bold">{{ $user->email }}</small>
      </a>
    @endforeach
    <div class="row">
        <div class=" col-12 mt-3 d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
  </div>
</div>

@endsection
