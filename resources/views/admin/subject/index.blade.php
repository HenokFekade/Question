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
               Subjects
               <a href="/subject/create" class="float-right text-dark"> Add Subject</a href="{{ route('subject.create') }}">
            </p>

            @foreach ($subjects as $subject)
                <a href="{{ route('subject.show', $subject->id) }}" class="list-group-item list-group-item-action">
                    {{ $subject->name  }}
                    <div class="float-right">
                        <span class="badge badge-primary float-right badge-pill">{{ $subject->questions->count() }} questions</span>
                    </div>
                </a>
            @endforeach
            <div class="row">
                <div class=" col-12 mt-3 d-flex justify-content-center">
                    {{ $subjects->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
