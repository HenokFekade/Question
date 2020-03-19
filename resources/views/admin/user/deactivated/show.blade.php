{{-- done --}}
@extends('layouts.adminApp')
  @section('content')
    <div class="container">
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">User Detail</h5>
                <small class="">{{ date('d-m-Y', strtotime($user->created_at))}}</small>

              </div>
            </a>

            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1 text-muted">User Name</h5>
              </div>

              <h4 class="">{{ $user->user_name }}</h4>
            </a>

            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1 text-muted">email</h5>

              </div>
              <h4 class="">{{ $user->email }}</h4>
            </a>

        </div>
          <a href="{{ route('user.activate', $user->user_name) }}" class="btn btn-success mt-3 mb-2"> Activate</a>
      </form>

        <br>
        @include('utility.listQuestions', ['questions' => $questions])

    </div>
  @endsection
