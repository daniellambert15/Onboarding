<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\QuizQuestions;
use App\Models\UserQuiz;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\UserQuizAnswers;
use App\Notifications\newQuiz;

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
        $quiz = new Quiz;
        $quiz->name = $request->input('name');
        $quiz->description = $request->input('description');
        $quiz->save();

        return redirect('/adminQuiz/'.$quiz->id)
            ->with('success', 'You\'ve successfully added a quiz, now add questions');
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
        return view('admin.quizEdit', ['quiz' => quiz::findOrFail($id)]);
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
        Quiz::find($id)->delete();

        return redirect('/adminQuizzes')->with('success', 'You\'ve removed that quiz');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyQuestion($id,$qId)
    {
        QuizQuestions::find($id)->delete();

        return redirect('/adminQuiz/'.$qId)->with('success', 'You\'ve removed that question');
    }

    public function adminAddQuizQuestion(Request $request)
    {
        $question = new QuizQuestions;
        $question->name = $request->input('newName');
        $question->quiz_id = $request->input('id');
        $question->question = $request->input('newQuestion');
        $question->save();

        return redirect('/adminQuiz/'.$request->input('id'))->with('success', 'You\'ve added a new question');
    }

    public function updateQuizQuestion($id, $qId){
        return view('admin.quizQuestionEdit', ['question' => QuizQuestions::find($id), 'qId' => $qId]);
    }

    public function adminUpdateQuizQuestion(Request $request){
        $question = QuizQuestions::find($request->input('id'));
        $question->name = $request->input('name');
        $question->question = $request->input('question');
        $question->save();

        return redirect('/adminQuiz/'.$request->input('qId'))
            ->with('success', 'you have edited that question');
    }

    public function quizUser($id){
        return view('admin.quizUser', ['user' => User::find($id), 'quizzes' => Quiz::all()]);
    }

    public function sendQuizUser($uId, $qId){
        // first we want to create a "user_quiz" entry
        $user_quiz = new UserQuiz;
        $user_quiz->user_id = $uId;
        $user_quiz->quiz_id = $qId;
        $user_quiz->save();

        // now we need to add all the questions into "user_quiz_answers" as we dont want the user
        // to submit some answers to a dynamic question, then in the future their correct answer
        // will be wrong as the question could have changed, or the parameters could have changed.

        $quizQuestions = quiz::find($qId);

        foreach($quizQuestions->questions as $question){
            $user_quiz_answers = new UserQuizAnswers;
            $user_quiz_answers->user_quiz = $user_quiz->id;
            $user_quiz_answers->question = $question->question;
            $user_quiz_answers->name = $question->name;
            $user_quiz_answers->answer = ' ';
            $user_quiz_answers->save();
        }

        // now we want to send an email to the user saying that they've got a new quiz to complete
        // and send them to the link.
        User::find($uId)->notify(new newQuiz());

        // now we send the admin back to the users quiz page.
        return redirect('/quizUser/'.$uId)->with('success', 'You have sent that quiz!');
    }

}
