<?php

namespace App\Http\Controllers;

use App\Models\UserQuizAnswers;
use Auth;
use Mail;
use Carbon\Carbon;
use App\Models\Quiz;
use App\Http\Requests;
use App\Models\UserQuiz;
use App\Mail\quizSubmitted;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('quizzes', ['user' => Auth::user()]);
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
        // first we check if the user is allowed to submit
        $user_quiz = UserQuiz::find($request->input('qId'));


        if($user_quiz->user_id != Auth::user()->id)
        {
            return redirect('/logout');
        }

        foreach($request->answerId as $answerId)
        {
            $answer = UserQuizAnswers::find($answerId);
            $answer->answer = $request->input('answer-'.$answerId);
            $answer->save();
        }


        if($request->input('choice') == 1) {
            $user_quiz->submitted = carbon::Now();
            $user_quiz->save();
            Mail::to(env('ADMIN_EMAIL'))->send(new quizSubmitted(Auth::user()));

            if (env('ADMIN_EMAIL_TWO') != "") {
                Mail::to(env('ADMIN_EMAIL_TWO'))->send(new quizSubmitted(Auth::user()));
            }

            if (env('ADMIN_EMAIL_THREE') != "") {
                Mail::to(env('ADMIN_EMAIL_THREE'))->send(new quizSubmitted(Auth::user()));
            }

            if (env('ADMIN_EMAIL_FOUR') != "") {
                Mail::to(env('ADMIN_EMAIL_FOUR'))->send(new quizSubmitted(Auth::user()));
            }

            if (env('ADMIN_EMAIL_FIVE') != "") {
                Mail::to(env('ADMIN_EMAIL_FIVE'))->send(new quizSubmitted(Auth::user()));
            }
        }

        return redirect('/quizes')->with('success', 'You have saved or sent that question');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userQuiz = UserQuiz::find($id);

        if($userQuiz->user_id != Auth::user()->id)
        {
            return redirect('/quizes')->with('error','you cannot update someone elses quiz');
        }

        $quiz = UserQuizAnswers::where('user_quiz', $id)->get();

        return view('quiz', ['quizQuestions' => $quiz, 'quiz' => Quiz::find($userQuiz->quiz_id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
