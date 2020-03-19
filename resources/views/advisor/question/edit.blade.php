{{-- done --}}
@extends('layouts.advisorApp')

@section('content')
	<div class="container">
		<div class="card-body">
                    <form method="POST" action="{{ route('question.update', $question->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="grade_id" class="col-md-4 col-form-label text-md-right">{{ __('Grade') }}</label>
                            <div class="col-md-6">
                            	 <select class="form-control  @error('grade_id') is-invalid @enderror" name="grade_id" id="grade_id" value="{{ old('grade_id') }}" required>
                                    @foreach($grades as $grade)
                                        <option value="{{$grade->id}}" {{($question->grade_id == $grade->id) ? 'selected' : ''}}>{{$grade->id}}</option>
                                    @endforeach
							    </select>
                                @error('grade_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="subject_id" class="col-md-4 col-form-label text-md-right">{{ __('Subject') }}</label>
                            <div class="col-md-6">
                            	 <select class="form-control @error('subject_id') is-invalid @enderror" name="subject_id" id="subject_id" value="{{ old('subject_id') }}" required>
							      @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}" {{($question->subject_id == $subject->id) ? 'selected' : ''}}>{{$subject->name}}</option>
                                    @endforeach
							    </select>
                                @error('subject_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @include('utility.questionForm', ['question' => $question])
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Update') }}
                                </button>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
	</div>
@endsection
