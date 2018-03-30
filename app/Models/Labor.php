<?php

namespace App\Models;

use App\Models\Traits\Shop;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Labor extends Model
{
    use SoftDeletes;
    use Shop;

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
        'deleted_at',
    ];

    public function client()
    {
        return $this->hasOne('App\Models\Client', 'id', 'client_id');
    }

    public function item()
    {
        return $this->hasOne('App\Models\Catalog', 'id', 'catalog_id');
    }

    public function scopeAveragePerDay($q)
    {
        $res = $q->selectRaw('avg(sum(price)) over () as average')
            ->where('date', '>=', $this->dateStart)
            ->groupBy('date')
            ->first();

        return (int) round($res->average);
    }

    public function scopeAverageCustomersPerDay($q)
    {
        $res = $q->where('date', '>=', $this->dateStart)
            ->groupBy('date')
            ->distinct('client_id')
            ->count('client_id');

        return (int) round($res);
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

    public function scopeSumPerMonth($q)
    {
        $q->selectRaw("date_trunc('month', date)::DATE AS txn_date, sum(price), count(distinct(client_id)) AS clients")
            ->where('date', '>=', $this->dateStart)
            ->groupBy('txn_date')
            ->orderBy('txn_date', 'desc');
    }

    public function scopeSumPerYear($q)
    {
        $q->selectRaw("date_trunc('year', date)::DATE AS txn_date, sum(price), count(distinct(client_id)) AS clients")
            ->where('date', '>=', $this->dateStart)
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
            case '1': return 'Κυριακή'; break;
            case '2': return 'Δευτέρα'; break;
            case '3': return 'Τρίτη'; break;
            case '4': return 'Τετάρτη'; break;
            case '5': return 'Πέμπτη'; break;
            case '6': return 'Παρασκευή'; break;
            case '7': return 'Σάββατο'; break;
        }
    }
}
