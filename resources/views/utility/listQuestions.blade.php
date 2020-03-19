<div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">Questions</h5>
</div>
<div class="list-group">

    <div class="accordion" id="accordion">

    @foreach ($questions as $question)
    @if ($questions->count() > 0)
    <div class="card">
          <div class="card-header" id="heading{{ $question->id }}">
          <h2 class="mb-0">
          <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse{{ $question->id }}" aria-expanded="false" aria-controls="collapse{{ $question->id }}">
                {{ $question->body }}
          </button>
          </h2>
          </div>
          <div id="collapse{{ $question->id }}" class="collapse" aria-labelledby="heading{{ $question->id }}" data-parent="#accordion">
          <div class="card-body">
          <div class="container">
                <p>A. {{$question->answer->correct}} <span class="ml-3 right badge badge-success">correct answer</span></p>
                                                    <p>B. {{$question->answer->incorrect[0]}}</p>
                                                    <p>C. {{$question->answer->incorrect[1]}}</p>
                                                    <p>D. {{$question->answer->incorrect[2]}}</p>
          </div>
          <div class="card-body">
                <div class="container mt-2">
                      <p class="text-primary">Explanation</p>
                      <p>{{ $question->explanation->body}}</p>
                </div>
          </div>
          <div class="row">
                <div class="col-1">
                      <form action="{{route('question.destroy', $question->id) }}" class=" ml-4" method="post">
                            <button type="submit" class="btn btn-danger">delete</button>
                            @csrf
                            {{ method_field('DELETE') }}

                      </form>
                      <br>
                </div>
                @can('canUpdate', $question)
                    <div class="col-1">
                        <a class="ml-5 btn btn-success" href="{{ route('question.edit', $question->id) }}">edit</a>
                    </div>
                @endcan
          </div>
          </div>
          </div>
    </div>
    @endif
    @endforeach
    <div class="row">
        <div class=" col-12 mt-3 d-flex justify-content-center">
            {{ $questions->links() }}
        </div>
    </div>

    </div>
</div>
