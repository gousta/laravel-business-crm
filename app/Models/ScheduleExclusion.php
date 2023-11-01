<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ScheduleExclusion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'schedule_exclusions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public $timestamps = false;

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
