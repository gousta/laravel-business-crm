<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Expense;
use App\Models\Labor;

class StatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    private function getFrame($format, $days, $flow = 'desc', $inverse = false, $step = 'day')
    {
        $out = [];

        if ($flow == 'desc') {
            for ($i = $days; $i >= 0; $i--) {
                $out[] = date($format, strtotime("-{$i} {$step}"));
            }
        } else {
            for ($i = 0; $i < $days; $i++) {
                $out[] = date($format, strtotime("+{$i} {$step}"));
            }
        }

        if ($inverse) {
            $out = array_reverse($out);
        }

        return $out;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $with = [
            'data' => [
                'all' => [
                    'sum' => Labor::shop()->sum('price'),
                    'customers' => Labor::shop()->distinct('client_id')->count('client_id'),

                    'average_per_day' => Labor::averagePerDay()->first()->average ?? 0,
                    'average_customers_per_day' => Labor::averageCustomersPerDay()->count('client_id') ?? 0,

                    'average_per_day_yearly' => Labor::getAveragePerDayYears(),

                    'average_per_dayofweek' => Labor::averagePerDayOfWeek()->get(),
                ],

                'sum_per_year'     => Labor::sumPerYear()->take(10)->get(),
                'expense_per_year' => Expense::sumPerYear()->take(5)->get()->keyBy('txn_date'),

                'sum_per_month'     => Labor::sumPerMonth()->get(),
                'expense_per_month' => Expense::sumPerMonth()->get()->keyBy('txn_date'),

                'this_week' => Labor::whereBetween('date', [date('Y-m-d', strtotime('-6 day')), date('Y-m-d')])->groupBy('date')->orderBy('date', 'desc')->selectRaw('date, sum(price), count(distinct(client_id)) AS clients')->get()->groupBy('date'),
                'best_days' => Labor::groupBy('date')->orderBy('sum', 'desc')->selectRaw('date, sum(price) as sum')->take(1)->get(),

                'expenses_analysis' => Expense::analyze(),
            ],
            'frame' => [
                'unix' => $this->getFrame('U', 25, 'desc', false),
                'date' => $this->getFrame('d/m/Y', 25, 'desc', false),
                'week' => $this->getFrame('d/m/Y', 6, 'desc', true),
            ],
        ];

        return view('stat.index', $with);
    }
}
