<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Question;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::with('questions')->orderBy('name', 'asc')->paginate(25);

        return view('admin.subject.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subject.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateRequest();
        $subject = Subject::create($validatedData);
        return redirect('/subject')->with('success', ucwords($subject->name).' added successfuly.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        $questions = Question::whereSubjectId($subject->id)->with(['answer', 'explanation'])
        ->orderby('body', 'asc')->paginate(25);
        $questions = $this->decodeAnswerJsonFile($questions);
        return view('admin.subject.show', compact('questions', 'subject'));
    }

    private function decodeAnswerJsonFile($questions)
    {
        foreach ($questions as $question) {
            $question->answer->incorrect = json_decode($question->answer->incorrect, true);
        }
        return $questions;
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('admin.subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $validatedData = $this->validateRequest();
        $subject->update($validatedData);
        return redirect('/subject')->with('success', 'Subject updated successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        //
    }

    public function validateRequest()
    {
        $validatedData = request()->validate([
            'name' => 'required|string|max:255',
        ]);
        return $validatedData;
    }
}
