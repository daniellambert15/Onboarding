<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserModuleAnswer extends Model
{
    use SoftDeletes;
    protected $table = 'user_module_answer';


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

    public function moduleQuestion(){
        return $this->hasOne('App\Models\ModuleQuestion', 'id', 'module_question_id');
    }
}