<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;

use App\Models\Quiz;
use App\Http\Requests;
use App\Models\UserQuiz;
use App\Mail\taskSubmitted;
use Illuminate\Http\Request;
use App\Notifications\userTaskSubmitted;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('quizes', [
            'user' => Auth::user(),
            'quizes' => Quiz::all()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userQuizList()
    {
        return view('completedQuizes', [
            'user' => User::find(Auth::user()->id)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $quiz = new UserQuiz();
        $quiz->user_id = $request->user()->id;
        $quiz->quiz_id = $request->input('quiz_id');
        $quiz->answer = $request->input('answer');
        $quiz->save();

        Auth::user()->notify(new userTaskSubmitted);

        return redirect('/quizes')->with('success', 'You\'ve successfully submitted the quiz');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('quiz', [
            'user' => Auth::user(),
            'quiz' => Quiz::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('updateQuiz', ['quiz' => UserQuiz::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $quiz = UserQuiz::find($request->input('id'));
        $quiz->answer = $request->input('answer');
        $quiz->save();

        return redirect('/completedQuizes')->with('success', 'You\'ve successfully updated your quiz');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
