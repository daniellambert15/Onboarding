<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\ModuleQuestion;
use App\Models\UserModuleAnswer;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $module = Module::find($user->module);

        return view('module', ['module' => $module]);
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
        // what we want to do here is save the users answer, then email the admin that they've submitted an answer then, redirect the user to the modules page with a thank you.

        $userAnswer = new UserModuleAnswer();
        $userAnswer->answer = $request->input('answer');
        $userAnswer->module_question_id = $request->input('id');
        $userAnswer->user_id = $request->user()->id;
        $userAnswer->save();

        Mail::to(env('ADMIN_EMAIL'))->send(new taskSubmitted(Auth::user()));

        return redirect('module')->with('success', 'Thank you. You\'ve submitted that module question.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('moduleQuestion', ['question' => ModuleQuestion::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function completedModules(){
        return view('completedModules', ['modules' => Module::all()]);
    }
}
