<div class="form-group row">
    <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question') }}</label>

    <div class="col-md-6">
        <textarea class="form-control @error('question') is-invalid @enderror" name="question" id="question" value="{{$question->body ?? old('question') }}" required rows="3" autofocus>{{$question->body ?? old('question') }}</textarea>
    </div>
        @error('question')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
</div>
<div class="form-group row">
    <label for="explanation" class="col-md-4 col-form-label text-md-right">{{ __('Explanation') }}</label>

    <div class="col-md-6">
        <textarea class="form-control @error('explanation') is-invalid @enderror" name="explanation" id="explanation" value="{{$question->explanation->body ?? old('explanation') }}" required rows="3">{{$question->explanation->body ?? old('explanation') }}</textarea>
    </div>
        @error('explanation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
</div>

<div class="form-group row">
     <label for="user_name" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>
    <div class="col-md-6">
        <div class="card">
          <h5 class="card-header">Answers</h5>
          <div class="card-body">
              <div>
                  <label for="correct_answer" class="col-form-label">{{ __('Correct Answer (A)') }}</label>
              <input id="correct_answer" type="text" class="form-control @error('correct_answer') is-invalid @enderror" value="{{$question->answer->correct ?? old('correct_answer') }}" name="correct_answer"  required >
                @error('correct_answer')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                  <label for="incorrect_answer_1" class="col-form-label">{{ __('Incorrect answer (B)') }}</label>
            <input id="incorrect_answer_1" type="text" class="form-control @error('incorrect_answer_1') is-invalid @enderror" value="{{$question->answer->incorrect[0] ?? old('incorrect_answer_1') }}" name="incorrect_answer_1" required>
                @error('incorrect_answer_1')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                  <label for="incorrect_answer_2" class="col-form-label">{{ __('Incorrect answer (C)') }}</label>
            <input id="incorrect_answer_2" type="text" class="form-control @error('incorrect_answer_2') is-invalid @enderror" value="{{$question->answer->incorrect[1] ?? old('incorrect_answer_2') }}" name="incorrect_answer_2" required>
                @error('incorrect_answer_2')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                  <label for="incorrect_answer_3" class="col-form-label">{{ __('Incorrect answer (D)') }}</label>
            <input id="incorrect_answer_3" type="text" class="form-control @error('incorrect_answer_3') is-invalid @enderror" value="{{$question->answer->incorrect[2] ?? old('incorrect_answer_3') }}" name="incorrect_answer_3" required>
                @error('incorrect_answer_3')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

          </div>
        </div>
    </div>
</div>
