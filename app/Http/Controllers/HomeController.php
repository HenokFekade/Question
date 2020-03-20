<?php

namespace App\Http\Controllers;

use App\Question;
use App\User;
use App\Utilities\ControllerUtility;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Gate::allows('isAdmin')) {
            $users = User::whereType('advisor')->with('questions')->orderBy('user_name', 'asc')->paginate(25);
            return view('admin.home', compact('users'));
        }
        elseif(Gate::allows('isAdvisor')) {
            $questions = Question::whereUserId(auth()->user()->id)->with(['answer', 'explanation'])
                                                        ->orderBy('body', 'asc')->paginate(25);
            $questions = ControllerUtility::decodeAnswerJsonFile($questions);
            return view('advisor.home', compact('questions'));
        }
    }
}
