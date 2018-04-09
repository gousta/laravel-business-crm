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
        'date',
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
        'date',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function scopeFilterDate($q, $date) {
        $s = explode('-', $date);
        $q->whereYear('date', $s[0])->whereMonth('date', $s[1]);
    }

    public function scopeTotal($q) {
        $q->selectRaw('sum(cashier) as cashier, sum(invoice) as invoice');
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

    public function getResultAttribute()
    {
        return $this->cashier - $this->invoice;
    }

    public function setDateAttribute($v)
    {
        $this->attributes['date'] = $v . '-01'; // appends 01 as day for Y-m-d format of date in postgres
    }

    public function getCashierPercentageAttribute()
    {
        $total = $this->cashier + $this->invoice;
        return $total > 0 ? ($this->cashier / $total) * 100 : 0;
    }

    public function getInvoicePercentageAttribute()
    {
        $total = $this->cashier + $this->invoice;
        return $total > 0 ? ($this->invoice / $total) * 100 : 0;
    }
}
