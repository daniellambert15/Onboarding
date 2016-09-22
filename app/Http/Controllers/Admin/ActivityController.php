<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activities;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.listActivities', ['activities' => Activities::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createActivity');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = Carbon::now();
        $date->month = $request->input('month');

        $activity = new Activities;
        $activity->name = $request->input('name');
        $activity->month = $date;
        $activity->description = $request->input('description');
        $activity->save();

        return redirect('/adminActivities')->with('success', 'You\'ve added in that activity');
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
        return view('admin.editActivity', ['activity' => Activities::find($id)]);
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
        $date = Carbon::now();
        $date->month = $request->input('month');

        $activity = Activities::find($request->input('id'));
        $activity->name = $request->input('name');
        $activity->month = $date;
        $activity->description = $request->input('description');
        $activity->save();
        return redirect('/adminActivities')->with('success', 'You\'ve edited that activity');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Activities::find($id)->delete();
        return redirect('/adminActivities')->with('success', 'You\'ve deleted that activity');
    }
}
