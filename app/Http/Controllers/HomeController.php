<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $with = [
        //     'clients' => Client::orderBy('id', 'desc')->get(),
        //     'catalog' => Catalog::orderBy('id', 'asc')->get(),
        //     'categories' => Catalog::orderBy('cat', 'desc')->distinct('cat')->pluck('cat'),
        // ];

        // return view('home', $with);

        return redirect()->route('client.index');
    }
}
