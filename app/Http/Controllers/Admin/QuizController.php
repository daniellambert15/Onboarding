<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\UserQuiz;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.quizzes', ['quizzes' => Quiz::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quizCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'questions' => 'required',
            'answers' => 'required',
        ]);

        $quiz = new Quiz();
        $quiz->title = $request->input('title');
        $quiz->questions = $request->input('questions');
        $quiz->answers = $request->input('answers');
        $quiz->save();


        return redirect('/adminQuizzes')->with('success', 'Quiz created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.quizEdit', ['quiz' => Quiz::find($id)]);
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
        $this->validate($request, [
            'title' => 'required',
            'questions' => 'required',
            'answers' => 'required',
        ]);

        $quiz = Quiz::find($request->input('id'));
        $quiz->title = $request->input('title');
        $quiz->questions = $request->input('questions');
        $quiz->answers = $request->input('answers');
        $quiz->save();

        return redirect('/adminQuizzes')->with('success', 'Quiz updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Quiz::find($id)->delete();
        return redirect('/adminQuizzes')->with('success','You\'ve deleted that quiz');
    }

    public function approveQuiz($uId,$id)
    {
        $quiz = UserQuiz::find($id);
        $quiz->approved = 1;
        $quiz->save();

        return redirect('/viewUser/'.$uId)->with('success','You\'ve approved that quiz');
    }

    public function unapproveQuiz($uId,$id)
    {
        $quiz = UserQuiz::find($id);
        $quiz->approved = 0;
        $quiz->save();

        return redirect('/viewUser/'.$uId)->with('success','You\'ve unapproved that quiz');
    }

}
