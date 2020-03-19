{{-- done --}}
@extends('layouts.adminApp')

@section('content')
    <div class="container">
        <div class="list-group">
            @if (session()->has('success'))
                <div class="d-flex justify-content-center alert alert-success">
                    {{ session()->get('success')}}
                </div>
            @endif
            <p href="#" class="list-group-item list-group-item-action active">
               Grade {{ $grade->id }}
            </p>
            @include('utility.listQuestions',['questions' => $questions])

        </div>
    </div>
@endsection
