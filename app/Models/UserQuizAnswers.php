<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserQuizAnswers extends Model
{
    use SoftDeletes;

    protected $table = 'user_quiz_answers';


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

    public function quiz()
    {
        return $this->hasOne('App\Models\UserQuiz','id', 'user_quiz');
    }

}
