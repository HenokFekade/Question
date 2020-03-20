<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Question;
use App\Utilities\ControllerUtility;
use Illuminate\Http\Request;

class GradeController extends Controller
{

    public function index()
    {
        $grades = Grade::with('questions')->get();

        return view('admin.grade.index', compact('grades'));
    }

    public function show(Grade $grade)
    {
        $questions = Question::whereGradeId($grade->id)->with(['answer', 'explanation'])->orderby('body', 'asc')->paginate(25);
        $questions = ControllerUtility::decodeAnswerJsonFile($questions);
        return view('admin.grade.show', compact('questions', 'grade'));
    }

}
