<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use App\Models\User;
use App\Models\Files;
use App\Http\Requests;
use App\Models\UserFile;
use Illuminate\Http\Request;
use App\Mail\userUploadedFile;

class FilesController extends Controller
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


    public function displayFiles(){
        return view('files', ['user' => Auth::user(), 'files' => Files::all()]);
    }

    public function postFiles(Request $request){

        $this->validate($request, [
            'file' => 'required|mimes:jpeg,bmp,png,docx,doc,xls,xlsx'
        ]);

        $fileLocation = 'public/userDocs/'.md5(
            $request->user()->id.
            '7EncoeaZ'
            );

        $filename = $request->file('file')->getClientOriginalName().date('d-m-Y-H-i-s').'.'.$request->file('file')->getClientOriginalExtension();

        $path = $request->file('file')->storeAs($fileLocation, $filename);

        $userFile = new UserFile;
        $userFile->user_id = Auth::user()->id;
        $userFile->file_id = $request->input('id');
        $userFile->signature = 'unused';
        $userFile->fileLocation = $path;
        $userFile->save();

        Mail::to(env('ADMIN_EMAIL'))->send(new userUploadedFile(Auth::user()));

        return redirect('/files')->with('success', 'You\'ve successfully uploaded the document');

    }

    public function approveFile($userId, $fileId){
        $file = UserFile::where(['user_id' => $userId, 'id' => $fileId])->first();
        $file->approved = 1;
        $file->save();

        return redirect('/viewUser/'.$userId)->with('success', 'You\'ve successfully approved the document');
    }

    public function unapproveFile($userId, $fileId){
        $file = UserFile::where(['user_id' => $userId, 'id' => $fileId])->first();
        $file->approved = 0;
        $file->save();

        return redirect('/viewUser/'.$userId)->with('success', 'You\'ve successfully unapproved the document');
    }
}
