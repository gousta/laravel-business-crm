<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vehicles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'license_plate',
        'production_year',
        'engine_code',
        'engine_displacement_cc',
        'vin',
        'brand',
        'model',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public $timestamps = false;

    public function client()
    {
        return $this->hasOne('App\Models\Client', 'id', 'client_id');
    }
}
