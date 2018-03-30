<?php

namespace App\Http\Controllers;

use App\Models\Labor;
use Illuminate\Http\Request;

class LaborController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $with = [
            'data' => Labor::with('client', 'item')
                ->orderBy('created_at', 'desc')
                ->where('date', $request->get('date', date('Y-m-d')))
                ->get(),
        ];

        return view('labor.index', $with);
    }
}
