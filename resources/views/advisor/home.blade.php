{{-- done --}}
@extends('layouts.advisorApp')

@section('content')
      <div class="container">
            @if ($questions->count() > 0)
                <div class="list-group">
                    @include('utility.sessionViewer')
                    <p href="#" class="list-group-item list-group-item-action active">
                        The Questions you contributed are:-
                    </p>
                    @include('utility.listQuestions',['questions' => $questions])
                </div>
            @else
                  <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">

                              <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Questions</h5>
                              </div>
                              <div id="accordion" class="mb-4 mr-2 ml-2">
                                    <div class="card">
                                          <p class="text-danger mt-3 offset-4 font-weight-bold">No question posted yet.</p>
                                    </div>
                              </div>
                        </a>
                  </div>
            @endif
      </div>
@endsection

