<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Vat extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vat';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cashier',
        'invoice',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function scopeFilterMonth($q, $month) {
        $boom = explode('-', $month);
        $q->whereYear('created_at', $boom[0])->whereMonth('created_at', $boom[1]);
    }

    // public function scopeSumPerMonth($q)
    // {
    //     $q->selectRaw("date_trunc('month', created_at)::DATE AS txn_date, sum(amount)")
    //         ->groupBy('txn_date')
    //         ->orderBy('txn_date', 'desc');
    // }

    // public function scopeSumPerYear($q)
    // {
    //     $q->selectRaw("date_trunc('year', created_at)::DATE AS txn_date, sum(amount)")
    //         ->groupBy('txn_date')
    //         ->orderBy('txn_date', 'desc');
    // }

    public function getCreatedAtAttribute($v)
    {
        return Carbon::parse($v)->setTimezone('Europe/Athens')->format('d/m/Y');
    }

    public function getResultAttribute()
    {
        return $this->cashier - $this->invoice;
    }
}
