<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Question;
use App\Subject;
use App\Utilities\ControllerUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class QuestionController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        $this->middleware('auth');
        if (Gate::allows('isAdvisor')) {
            return view('advisor.question.create');
        }
    }

    public function store(Request $request)
    {
        $this->middleware('auth');
        if (Gate::allows('isAdvisor')) {
            $validatedData = $this->validateRequest();
            DB::beginTransaction();
            try {
                $question = Question::create([
                    'user_id' => auth()->user()->id,
                    'grade_id' => $validatedData['grade_id'],
                    'subject_id' => $validatedData['subject_id'],
                    'body' => $validatedData['question'],
                ]);
                $question->answer()->create([
                    'correct' => $validatedData['correct_answer'],
                    'incorrect' => $this->convertToJson($validatedData),
                ]);

                $question->explanation()->create([
                    'body' => $validatedData['explanation'],
                ]);
                DB::commit();
                return redirect('/home')->with('success', 'Question add successfuly.');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect('/home')->with('error', 'Something went wrong please retry again.');
            }
        }
    }

    private function convertToJson($validatedData)
    {
        $temporaryArray = array();
        $temporaryArray[0] = $validatedData['incorrect_answer_1'];
        $temporaryArray[1] = $validatedData['incorrect_answer_2'];
        $temporaryArray[2] = $validatedData['incorrect_answer_3'];
        return json_encode($temporaryArray);
    }

    public function show(Question $question)
    {
        //
    }


    public function edit($question)
    {
        $question = Question::whereId($question)->with(['answer', 'explanation'])->get();
        $question = ControllerUtility::decodeAnswerJsonFile($question)[0];
        return view('advisor.question.edit', compact('question'));
    }


    public function update(Request $request, Question $question)
    {
        $this->middleware('auth');
        if (Gate::allows('canUpdate', $question)) {
            $validatedData = $this->validateRequest();
            DB::beginTransaction();
            try {
                $question->update([
                    'user_id' => auth()->user()->id,
                    'grade_id' => $validatedData['grade_id'],
                    'subject_id' => $validatedData['subject_id'],
                    'body' => $validatedData['question'],
                ]);
                $question->answer()->update([
                    'correct' => $validatedData['correct_answer'],
                    'incorrect' => $this->convertToJson($validatedData),
                ]);

                $question->explanation()->update([
                    'body' => $validatedData['explanation'],
                ]);
                DB::commit();
                return redirect('/home')->with('success', 'Question Updated successfuly.');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect('/home')->with('error', 'Something went wrong please retry again.');
            }
        }
    }


    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->back()->with('success', 'Question deleted successfuly.');
    }

    private function validateRequest()
    {

        $validatedData = request()->validate([
            'grade_id' => 'required|integer',
            'subject_id' => 'required|integer',
            'question' => 'required|string',
            'explanation' => 'required|string',
            'correct_answer' => 'required|string',
            'incorrect_answer_1' => 'required|string',
            'incorrect_answer_2' => 'required|string',
            'incorrect_answer_3' => 'required|string',

            ]);

        return $validatedData;
    }
}
