<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vat\CreateRequest;
use App\Models\Vat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VatController extends Controller
{
    private function getDateRange() {
        $dt = Carbon::now();
        $range = [];

        for ($i = 0; $i <= 6; $i++) {
            $range[] = [
                'value' => (string) $dt->format('Y-m'),
                'label' => (string) $dt->formatLocalized('%B %Y'),
            ];
            $dt->subMonth();
        }

        return $range;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = $request->input('date', date('Y-m'));

        return view('vat.index', [
            'vats' => Vat::filterDate($date)->orderBy('id', 'desc')->get(),
            'filter' => [
                'date' => (string) $date,
                'range' => $this->getDateRange()
            ],
            'total' => Vat::filterDate($date)->total()->first(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('vat.create', [
            'range' => $this->getDateRange(),
            'vat' => $request->old(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $vat = Vat::create($request->all());

        return redirect()->route('vat.index')->with('status', $this->ok);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('vat.edit', [
            'range' => $this->getDateRange(),
            'vat' => Vat::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vat = Vat::findOrFail($id);
        $vat->update($request->all());

        return redirect()->route('vat.index')->with('status', $this->ok);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vat = Vat::findOrFail($id);
        $vat->delete();

        return redirect()->route('vat.index')->with('status', $this->deleted);
    }
}
