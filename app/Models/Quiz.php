<?php

namespace App\Models;

use App\Models\QuizQuestions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use SoftDeletes;

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

    public function questions(){
        return $this->hasMany('App\Models\QuizQuestions', 'quiz_id', 'id');
    }
}
