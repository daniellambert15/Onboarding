<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Module;
use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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

    public function showUser()
    {
        $id = Auth::user()->id;
        return User::with('activities')->find($id);
    }

    public function showUsers()
    {
        return User::all();
    }

    public function Activities()
    {
        return Auth::user()->activities;
    }

    public function displayUser($id)
    {
        return view('admin.displayUser',
            [
                'user' => User::find($id),
                'files' => Files::all()
            ]);
    }

    public function displayEditUser($id)
    {
        return view('admin.displayEditUser', ['user' => User::find($id), 'modules' => Module::all()]);
    }

    public function postEditUser(Request $request){
        $user = User::find($request->input('id'));
        $user->salutation = $request->input('salutation');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->module = $request->input('module');
        $user->business_name = $request->input('business_name');
        $user->contact_number = $request->input('contact_number');
        if($request->input('stage1') == null){ $user->stage1 = 0;} else{ $user->stage1 = $request->input('stage1');}
        if($request->input('stage2') == null){ $user->stage2 = 0;} else{ $user->stage2 = $request->input('stage2');}
        if($request->input('stage3') == null){ $user->stage3 = 0;} else{ $user->stage3 = $request->input('stage3');}
        if($request->input('is_admin') == null){ $user->is_admin  = 0;} else{ $user->is_admin = $request->input('is_admin');}
        $user->save();
        return redirect('/userList')->with('success', 'You\'ve updated '.$request->input('name'));
    }

    public function userList(){
        return view('admin.userList', ['users' => User::all(), 'pausedUsers' => User::onlyTrashed()->get()]);
    }

    public function pause($id){

        if($id == Auth::user()->id){
            return redirect('/userList')->with('error','That\'s a bit silly and could have gone wrong!
            You tried to pause yourself.');
        }
//
//        dd($id);

        User::find($id)->delete();
        return redirect('/userList')->with('success','You\'ve paused that user');
    }

    public function unpause($id){

        User::withTrashed()->where('id',$id)->restore();
        return redirect('/userList')->with('success','You\'ve unpaused that user');
    }


}
