<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Appointment;
use App\Models\ScheduleExclusion;
use Illuminate\Http\Request;
use App\Http\Requests\Appointment\CreateRequest;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date') ? Carbon::parse($request->input('date')) : Carbon::now();

        $hours = config('crm.appointment_hours');
        $prevDate = Carbon::parse($date)->subDay();
        $nextDate = Carbon::parse($date)->addDay();

        $scheduleExclusions = ScheduleExclusion::whereDate('date', $date->toDateString())
            ->get()
            ->pluck('user_id');

        $users = User::where('show_in_calendar', true)
            ->whereNotIn('id', $scheduleExclusions)
            ->orderBy('order_in_calendar', 'asc')
            ->get();


        return view('appointment.index', [
            'date_prev_link' => route('appointment.index', ['date' => $prevDate->toDateString()]),
            'date_next_link' => route('appointment.index', ['date' => $nextDate->toDateString()]),
            'hours' => $hours,
            'users' => $users,
            'date' => $date->toDateString(),
            'date_formatted' => $date->formatLocalized(config('crm.date_format')),
            'date_formatted_short' => $date->formatLocalized(config('crm.date_format_short')),
        ]);
    }

    public function asyncIndexAppointments(Request $request)
    {
        $date = Carbon::parse($request->input('date'));

        $appointments = Appointment::whereDate('date', $date->toDateString())->get();

        return response()->json([
            'appointments' => $appointments,
        ]);
    }

    public function asyncUpdateAnyAppointment(CreateRequest $request)
    {
        $data = $request->all();

        $existing = Appointment::whereDate('date', $data['date'])
            ->where('hour', $data['hour'])
            ->where('user_id', $data['user_id'])
            ->get();

        if ($existing->count() > 0) {
            $model = $existing->first();
            $model->update(['description' => $data['description']]);
        } else {
            Appointment::create([
                'user_id' => $data['user_id'],
                'description' => $data['description'],
                'date' => $data['date'],
                'hour' => $data['hour'],
            ]);
        }

        return response()->json();
    }
}
