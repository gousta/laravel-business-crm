<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\User;
use App\Models\Appointment;
use App\Models\ScheduleExclusion;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    private function getMonthGraph() {
        $months = [];

        for($i = 0; $i < 12; $i++) {
            $months[] = Carbon::now()->addMonths($i);
        }

        return $months;
    }

    private function getDailySchema(string $start, string $end) {
        $start_date = Carbon::parse($start);
        $end_date = Carbon::parse($end);

        for($date = $start_date->copy(); $date->lt($end_date); $date->addDay()) {
            $dailySchema[] = [
                'date' => $date->format('Y-m-d'),
                'formatted_day' => $date->formatLocalized('%A'),
                'formatted_date' => $date->formatLocalized('%d %b %Y')
            ];
        }

        return $dailySchema;
    }

    public function index(Request $request)
    {
        $date = $request->input('date') ? Carbon::parse($request->input('date')) : Carbon::now()->startOfWeek();
        $start = Carbon::parse($date)->format('Y-m-d');
        $end = Carbon::parse($date)->addWeek()->format('Y-m-d');

        $schedule_exclusions = ScheduleExclusion::where('date', '>' , $start)
            ->where('date', '<', $end)
            ->get()
            ->keyBy(function ($row) {
                return implode([$row['user_id'], $row['date']], '|');
            });

        $users = User::where('show_in_calendar', true)
            ->orderBy('order_in_calendar', 'asc')
            ->get();

        $prevDate = Carbon::parse($date)->subWeek()->toDateString();
        $nextDate = Carbon::parse($date)->addWeek()->toDateString();

        return view('schedule.index', [
            'users' => $users,
            'week' => $this->getDailySchema($start, $end),
            'month_graph' => $this->getMonthGraph(),
            'schedule_exclusions' => $schedule_exclusions,
            'today' => Carbon::now()->format('Y-m-d'),
            'date' => $date->format('Y-m-d'),
            'date_week_formatted' => $date->formatLocalized('Eβδομάδα %W του %Y'),
            'date_prev_link' => is_null($prevDate) ? null : route('schedule.index', ['date' => $prevDate]),
            'date_next_link' => route('schedule.index', ['date' => $nextDate]),
        ]);
    }

    public function asyncUpdateScheduleExclusions(Request $request) {
        $rows = $request->input('rows');

        for($i = 0; $i < count($rows); $i++) {
            $user_id = $rows[$i]['userId'];
            $date = $rows[$i]['date'];
            $checked = $rows[$i]['checked'] == 'true';

            if($checked) {
                ScheduleExclusion::where('user_id', $user_id)
                    ->where('date', $date)
                    ->delete();
                continue;
            }

            if(!ScheduleExclusion::where('user_id', $user_id)
                ->where('date', $date)
                ->exists()) {
                ScheduleExclusion::create(
                    ['user_id' => $user_id, 'date' => $date],
                    ['user_id' => $user_id, 'date' => $date]
                );
            }
        }

        return response()->json();
    }
}
