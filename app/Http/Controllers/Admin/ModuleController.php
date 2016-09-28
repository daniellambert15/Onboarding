<?php

namespace App\Http\Controllers\Admin;

use App\Models\Module;
use App\Models\ModuleQuestion;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.listModules', ['modules' => Module::all()]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.editModuleQuestion', ['question' => ModuleQuestion::find($id)]);
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
        $question = ModuleQuestion::find($request->input('id'));
        $question->name = $request->input('name');
        $question->question = $request->input('question');
        $question->save();

        return redirect('adminModules')->with('success', 'You\'ve updated that question');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ModuleQuestion::find($id)->delete();
        return redirect('adminModules')->with('success','You\'ve deleted the question');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyModule($id)
    {
        Module::find($id)->delete();
        return redirect('adminModules')->with('success','You\'ve deleted the module');
    }

    public function addModuleQuestion($id){
        return view('admin.addModuleQuestion', ['id' => $id]);
    }

    public function postAddModuleQuestion(Request $request){
        $question = new ModuleQuestion();
        $question->name = $request->input('name');
        $question->question = $request->input('question');
        $question->module_id = $request->input('id');
        $question->save();

        return redirect('adminModules')->with('success', 'You\'ve added a question');
    }

    public function postAddModule(Request $request){
        $module = new Module();
        $module->name = $request->input('name');
        $module->save();

        return redirect('adminModules')->with('success', 'You\'ve added a module');
    }

    public function addModule(){
        return view('admin.addModule');
    }

    public function editModule($id){
        return view('admin.editModule', ['module' => Module::find($id)]);
    }

    public function postEditModule(Request $request){
        $module = Module::find($request->input('id'));
        $module->name = $request->input('name');
        $module->save();
        return redirect('adminModules')->with('success', 'You\'ve successfully updated the module');
    }
}
