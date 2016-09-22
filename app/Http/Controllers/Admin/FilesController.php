<?php

namespace App\Http\Controllers\Admin;

use App\Models\Files;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.listFiles', ['files' => Files::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addFiles');
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
            'file' => 'required|mimes:jpeg,bmp,png,docx,doc,xls,xlsx'
        ]);

        $fileLocation = 'public/docs';

        $filename = md5(
            date('d-m-Y H:i:s').
            $request->input('description').
            $request->input('name').
            $request->file('file')->getClientOriginalName().
            $request->file('file')->getClientOriginalExtension()
            ).'.'.

            $request->file('file')->getClientOriginalExtension();

        $path = $request->file('file')->storeAs($fileLocation, $filename);

        $userFile = new Files();
        $userFile->name = $request->input('name');
        $userFile->description = $request->input('description');
        $userFile->original = $path;
        $userFile->save();

        return redirect('/adminFiles')->with('success', 'You have added the file '.
            $request->file('file')->getClientOriginalName().'.'.
            $request->file('file')->getClientOriginalExtension());
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
        Files::find($id)->delete();
        return redirect('/adminFiles')->with('success','You\'ve deleted that file');
    }
}
