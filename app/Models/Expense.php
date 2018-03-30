<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'expenses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'amount',
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

    public function scopeSumPerMonth($q)
    {
        $q->selectRaw("date_trunc('month', created_at)::DATE AS txn_date, sum(amount)")
            ->groupBy('txn_date')
            ->orderBy('txn_date', 'desc');
    }

    public function scopeSumPerYear($q)
    {
        $q->selectRaw("date_trunc('year', created_at)::DATE AS txn_date, sum(amount)")
            ->groupBy('txn_date')
            ->orderBy('txn_date', 'desc');
    }

    public function getCreatedAtAttribute($v)
    {
        return Carbon::parse($v)->setTimezone('Europe/Athens')->format('d/m/Y');
    }

    public function scopeAnalyze($q) {
        $data = $q->get();
        $rawData = [];
        $result = [];

        foreach($data as $row) {
            $lines = explode("\n", $row->description);

            if(count($lines) > 0) {
                foreach($lines as $line) {
                    if($line != '' && strlen($line) > 0) {
                        $lineData = explode(' ', str_replace('  ', ' ', trim($line)));
                        $amount = array_shift($lineData);

                        if(count($lineData) > 0) {
                            $rawData[] = [
                                'amount' => (float) $amount,
                                'reason' => join(' ', $lineData)
                            ];
                        }
                    }
                }
            } else {
                $rawData[] = [
                    'amount' => (float) $row->amount,
                    'reason' => $row->description
                ];
            }
        }

        foreach(collect($rawData)->groupBy('reason') as $reason => $items) {
            $result[] = [
                'reason' => $reason,
                'amount' => $items->sum('amount'),
            ];
        }

        $sorted = collect($result)->sortByDesc('amount');
        return $sorted->values()->take(20)->all();
    }
}
