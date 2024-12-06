<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Labor extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'labor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'client_id',
        'catalog_id',
        'price',
        'notes',
        'pos'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'pos' => 'boolean',
    ];

    public function client()
    {
        return $this->hasOne('App\Models\Client', 'id', 'client_id');
    }

    public function item()
    {
        return $this->hasOne('App\Models\Catalog', 'id', 'catalog_id');
    }

    public function scopeLastXMonths($q, $months = 36)
    {
        $q->where('date', '>=', Carbon::now()->subMonths($months));
    }

    public function scopeLastXYears($q, $years)
    {
        $q->where('date', '>=', Carbon::now()->subYears($years));
    }

    public function scopeAveragePerDay($q)
    {
        $q->selectRaw('avg(sum(price)) over () as average')
            ->lastXMonths(36)
            ->groupBy('date');
    }

    public function scopeAverageCustomersPerDay($q)
    {
        $q->lastXMonths(36)
            ->groupBy('date')
            ->distinct('client_id');
    }

    public function scopeAveragePerDayOfWeek($q)
    {
        $q->selectRaw("count(distinct(date)) as days, sum(price), to_char(date, 'D') as dow")
            ->groupBy('dow')
            ->orderBy('dow');
    }

    public function scopeSumPerDay($q, $frame)
    {
        $q->selectRaw('sum(price) as sum, date')
            ->whereIn('date', $frame)
            ->orderBy('date')
            ->groupBy('date');
    }

    // Σύνολα ανα μήνα
    public function scopeSumPerMonth($q)
    {
        $q->selectRaw("date_trunc('month', date)::DATE AS txn_date, sum(price), count(distinct(client_id)) AS clients")
            ->lastXMonths(18)
            ->groupBy('txn_date')
            ->orderBy('txn_date', 'desc');
    }

    // Σύνολα ανά έτος
    public function scopeSumPerYear($q)
    {
        $q->selectRaw("date_trunc('year', date)::DATE AS txn_date, sum(price), count(distinct(client_id)) AS clients")
            ->lastXYears(5)
            ->groupBy('txn_date')
            ->orderBy('txn_date', 'desc');
    }

    public function scopeBestClients($query, $gender)
    {
        $query->selectRaw('sum(price) as sum, client_id')
            ->whereHas('client', function ($q) use ($gender) {
                $q->where('gender', $gender);
            })
            ->groupBy('client_id')
            ->take(10)
            ->orderBy('sum', 'desc');
    }

    public function scopeMonthlyGrossRevenueByCategory($query)
    {
        $query->selectRaw('sum(labor.price) as sum, catalog.cat')
            ->join('catalog', 'catalog.id', '=', 'labor.catalog_id')
            ->groupBy('catalog.cat')
            ->orderBy('sum', 'desc');
    }

    public static function averagePerDayForYear($year)
    {
        $res = static::selectRaw('avg(sum(price)) over () as average')
            ->whereYear('date', $year)
            ->groupBy('date')
            ->first();
        $res = $res ? $res->average : null;

        return $res ? (int) round($res) : 0;
    }

    public static function averageCustomersPerDayForYear($year)
    {
        $res = static::groupBy('date')
            ->whereYear('date', $year)
            ->distinct('client_id')
            ->count('client_id');

        return $res ? (int) round($res) : 0;
    }

    public static function getAveragePerDayYears()
    {
        $startYear = Carbon::now()->year;
        $endYear = Carbon::now()->subYears(3)->year;
        $d = [];

        for ($y = $startYear; $y > $endYear; $y--) {
            $d[$y] = [
                'amount' => static::averagePerDayForYear($y),
                'customers' => static::averageCustomersPerDayForYear($y),
            ];
        }

        return $d;
    }

    public function getTimeagoAttribute()
    {
        if (empty($this->created_at)) {
            $this->created_at = $this->date;
        }

        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function getTimeAttribute()
    {
        return $this->created_at ? Carbon::parse($this->created_at)->setTimezone('Europe/Athens')->format('H:i') : '00:00';
    }

    public function getDateTimestampAttribute()
    {
        return Carbon::parse($this->attributes['date'])->timestamp;
    }

    public function setDateAttribute($v)
    {
        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y', $v);
    }

    public function getDateAttribute($v)
    {
        return Carbon::parse($v)->format('d/m/Y');
    }

    public function getWeekDayAttribute()
    {
        switch ($this->dow) {
            case '1':
                return 'Κυριακή';
            case '2':
                return 'Δευτέρα';
            case '3':
                return 'Τρίτη';
            case '4':
                return 'Τετάρτη';
            case '5':
                return 'Πέμπτη';
            case '6':
                return 'Παρασκευή';
            case '7':
                return 'Σάββατο';
        }
    }
}
