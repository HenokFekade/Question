<?php

namespace App\Http\Controllers;

use App\Question;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        return view('admin.user.create');
    }


    public function store(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            $editingMode = false;
            $validatedData = $this->validateRequest($editingMode);
            $validatedData['type'] = 'advisor';
            $user = User::create($validatedData);
            return redirect('/home')->with('success', ucwords($user->user_name).' add successfuly.');
        }
    }

    public function show(User $user)
    {
        $questions = Question::whereUserId($user->id)->with(['answer', 'explanation'])->orderBy('body', 'asc')->paginate(25);
        $questions = ControllerUtility::decodeAnswerJsonFile($questions);
        return view('admin.user.show', compact('user', 'questions'));
    }

    public function edit(User $user)
    {

    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/home')->with('success', $user->user_name.' deactivated successfuly.');
    }

    private function validateRequest($editingMode, $user = null)
    {
         if ($editingMode) {
             $validatedData = request()->validate([
                'user_name' => 'required|string|max:255|unique:users,user_name,'.auth()->user()->user_name,
                'email' => 'required|string|max:255|unique:users|email,email,'.auth()->user()->email,
                'password' => 'sometimes|min:8|string',
             ]);
         }
         else {
            $validatedData = request()->validate([
                'user_name' => 'required|string|max:255|unique:users',
                'email' => 'required|email|string|max:255|unique:users',
                'password' => 'sometimes|min:8|string',
            ]);
         }
         return $validatedData;
    }

    public function deactivatedUsers()
    {
        $users = User::onlyTrashed()->with('questions')->orderBy('user_name', 'asc')->paginate(25);
        return view('admin.user.deactivated.index', compact('users'));
    }

    public function showDeactivatedUser($user_name)
    {
        $user = User::withTrashed()->whereUserName($user_name)->first();
        $questions = Question::whereUserId($user->id)->with(['answer', 'explanation'])->orderBy('body', 'asc')->paginate(25);
        $questions = ControllerUtility::decodeAnswerJsonFile($questions);
        return view('admin.user.deactivated.show', compact('user', 'questions'));
    }

    public function activateUser($user_name)
    {
        $user = User::withTrashed()->whereUserName($user_name)->first();
        $user->restore();
        return redirect('/user/deactivated')->with('success', ucwords($user->user_name).' activated successfuly.');
    }
}
