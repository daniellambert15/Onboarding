<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModuleQuestion extends Model
{
    use SoftDeletes;

    protected $table = 'module_questions';


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

    public function Module(){
        return $this->hasOne('App\Models\Module', 'id', 'module_id');
    }

    public function userAnswer(){


        if(Auth::user()->is_admin){
            return $this->hasMany('App\Models\UserModuleAnswer', 'module_question_id', 'id');
        }

        return $this->hasMany('App\Models\UserModuleAnswer', 'module_question_id', 'id')->where('approved', 1);

    }

}
