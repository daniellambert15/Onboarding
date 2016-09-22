<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activities extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'month',
        'updated_at',
        'deleted_at'
    ];

    public function selectActivitiesByMonth($month){
        return $this->where('month', $month)->get();
    }
}
