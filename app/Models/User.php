<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModuleAnswer;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'salutation',
        'business_name',
        'contact_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'admin'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * This is to link the users to the completed user activities
     *
     * @var array
     */
    public function activities(){
        return $this->hasMany('App\Models\UserActivities', 'user_id', 'id')->with('activity');
    }

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_admin' => 'boolean',
        'stage1' => 'boolean',
        'stage2' => 'boolean',
        'stage3' => 'boolean',
    ];

    public function UserFiles(){
        return $this->hasMany('App\Models\UserFile', 'user_id', 'id');
    }

    public function quizzes(){


        if(Auth::user()->is_admin){
            return $this->hasMany('App\Models\UserQuiz', 'user_id', 'id');
        }

        return $this->hasMany('App\Models\UserQuiz', 'user_id', 'id')->where('approved', 1);


    }

    public function modules(){
        return $this->hasMany('App\Models\UserModuleAnswer', 'user_id', 'id');
    }

    public function userModule(){
        return $this->hasOne('App\Models\Module', 'id', 'module');
    }

    public function userFile($id)
    {

        if(Auth::user()->is_admin){
            return UserFile::where(
                [
                    'user_id' => $this->id,
                    'file_id' => $id
                ])->get();
        }

        return UserFile::where(
            [
                'user_id' => $this->id,
                'file_id' => $id,
                'approved' => 1
            ])->get();
    }

    public function userQuiz($id)
    {

        if(Auth::user()->is_admin){
            return UserQuiz::where(
                [
                    'user_id' => $this->id,
                    'quiz_id' => $id
                ])->get();
        }

        return UserQuiz::where(
            [
                'user_id' => $this->id,
                'quiz_id' => $id,
                'approved' => 1
            ])->get();
    }


    public function completedQuestion($question){

        // has user completed this question?
        $completedQuestion = UserModuleAnswer::
            where('module_question_id' , $question->id)
            ->where('user_id', Auth::user()->id)
            ->get();

        // now we need to get the questions that are under 6 months old, as we dont want
        // to pick up las years answers

        $today = carbon::now();

        $count = 0;

        foreach($completedQuestion as $question) {
            $questionDate = Carbon::createFromFormat('Y-m-d H:i:s', $question->updated_at);
            // USER MODULE - HAS TO BE COMPLETED WITHIN 6 MONTHS!!
            if ($today->diffInMonths($questionDate) < 6) {
                $count++;
            }
        }


        if($count > 0)
        {
            return true;

        }

        return false;
    }

    public function completedQuestionId($id)
    {
        $question = UserModuleAnswer::where('module_question_id', $id)->
            where('user_id', Auth::user()->id)->first();

        return $question->id;

    }

}
