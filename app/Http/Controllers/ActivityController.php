<?php

namespace App\Http\Controllers;

use App\Mail\taskSubmitted;
use App\Models\Activities;
use App\Models\UserActivities;
use App\Notifications\userTaskSubmitted;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use DB;
use Gate;
use App\models\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Mail;

class ActivityController extends Controller
{

    protected $date;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->date = carbon::now();
    }

    public function displayActivity($id){

        // setup some variables that we'll use later on, these are for user accounts, the activity and times etc.
        $user = Auth::user();
        $activity = Activities::find($id);

        $cUser = carbon::createFromFormat('Y-m-d H:i:s',$user->created_at);
        $cActivity = carbon::createFromFormat('Y-m-d H:i:s', $activity->month);


        // get a list of activities between the time the user started and end of last month
        $activities = Activities::whereBetween('month', [
            $cUser->firstOfMonth(),
            $cActivity->copy()->subMonth()->lastOfMonth()
        ])->get();

        // check when they sign up and send them back if they try to open an activity before they signed up
        if($cActivity->firstOfMonth() < $cUser->firstOfMonth()){
            return redirect('/calendar')->with('success', 'You do not have to complete activities before you signed up');
        }

        // check if they're trying to complete an activity for next month
        if($cActivity->firstOfMonth() >= $this->date->copy()->addMonth(1)->firstOfMonth()){
            return redirect('/calendar')->with('error', 'You cannot complete activities for next month.');
        }

        // check if they've already submitted the activity off
        $previouslySubmitted = UserActivities::where(['user_id' => $user->id, 'activity_id' => $activity->id ])->first();
        if($previouslySubmitted){
            return redirect('/calendar')->with('success', 'Thank you for being keen, looks like you\'ve already submitted that one!');
        }

        // now we query the user, to see if they've not submitted all for last month
        foreach($activities as $activityRow){

            // check if the user has completed the outstanding activities.
            $userActivity = UserActivities::where(['user_id' => $user->id, 'activity_id' => $activityRow->id ])->first();
            $cActivityRow = carbon::createFromFormat('Y-m-d H:i:s', $activityRow->month);

            if ($cActivityRow >= $cUser) {
                if(count($userActivity) == null) {
                    return redirect('/calendar')->with('error', 'you have not competed all previous months activities');
                }
            }
        }

        return view('submitActivity', ['activity' => $activity]);

    }

    public function editActivity($id){

        $userActivity = UserActivities::find($id);
        $activity = Activities::find($userActivity->activity_id);

        if (Gate::allows('update-activity', $userActivity)) {
            return view('editActivity', ['activity' => $activity, 'userAnswer' => $userActivity]);
        }

        return redirect('/completedTasks')->with('error', 'You cannot update that activity');
    }

    public function updateActivity(Request $request){

        $activity = UserActivities::find($request->input('id'));

        //dd($activity);

        if (Gate::allows('update-activity', $activity)) {
            $activity->answer = $request->input('answer');
            $activity->save();
            return redirect('/completedTasks')->with('status', 'You\'ve updated your activity');
        }

        return redirect('/completedTasks')->with('error', 'You cannot update that activity');

    }

    public function saveUserActivity(Request $request){
        $userAcivities = new UserActivities;

        $this->validate($request, [
            'answer' => 'required',
        ]);

        $userAcivities->user_id = Auth::user()->id;
        $userAcivities->answer = $request->input('answer');
        $userAcivities->activity_id = $request->input('actvity_id');
        $userAcivities->save();

        // fire off email to the user && managers
        Auth::user()->notify(new userTaskSubmitted);

        return redirect('/calendar')->with('status', 'You have saved your activity');
    }


    public function monthActivities($month){
        $this->date->month($month);
        return Activities::whereBetween('month', [
            $this->date->copy()->firstOfMonth(),
            $this->date->copy()->lastOfMonth()
        ])->get();
    }

    public function calendar(){
        return view('calendar', ['months' => $this->getMonths()]);
    }

    public function completedTasks()
    {
        return view('completedTasks', ['user' => Auth::user()]);
    }

    public function getMonths(){

        return array(
            array(
                'num' => 1,
                'month' => 'January',
                'activities' => $this->monthActivities(1)
            ),
            array(
                'num' => 2,
                'month' => 'February',
                'activities' => $this->monthActivities(2)
            ),
            array(
                'num' => 3,
                'month' => 'March',
                'activities' => $this->monthActivities(3)
            ),
            array(
                'num' => 4,
                'month' => 'April',
                'activities' => $this->monthActivities(4)
            ),
            array(
                'num' => 5,
                'month' => 'May',
                'activities' => $this->monthActivities(5)
            ),
            array(
                'num' => 6,
                'month' => 'June',
                'activities' => $this->monthActivities(6)
            ),
            array(
                'num' => 7,
                'month' => 'July',
                'activities' => $this->monthActivities(7)
            ),
            array(
                'num' => 8,
                'month' => 'August',
                'activities' => $this->monthActivities(8)
            ),
            array(
                'num' => 9,
                'month' => 'September',
                'activities' => $this->monthActivities(9)
            ),
            array(
                'num' => 10,
                'month' => 'October',
                'activities' => $this->monthActivities(10)
            ),
            array(
                'num' => 11,
                'month' => 'November',
                'activities' => $this->monthActivities(11)
            ),
            array(
                'num' => 12,
                'month' => 'December',
                'activities' => $this->monthActivities(12)
            ),
        );

    }
}
