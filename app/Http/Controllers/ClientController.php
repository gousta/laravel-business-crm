<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\CreateRequest;
use App\Http\Requests\Labor\CreateRequest as LaborCreateRequest;
use App\Models\Catalog;
use App\Models\Client;
use App\Models\Labor;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private $vehicleKeys = [
        'vehicle_brand',
        'vehicle_model',
        'vehicle_license_plate',
        'vehicle_production_year',
        'vehicle_vin',
        'vehicle_engine_displacement_cc',
        'vehicle_engine_code',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::orderBy('id', 'desc')->get();

        return view('client.index', [
            'clients' => $clients,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $client = $request->old();

        return view('client.create', [
            'client' => $client,
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
        $request->merge(['role' => 'client']);

        $vehicleData = null;
        $clientData = $request->all();

        if (config('crm.mode') === 'mechanic') {
            $vehicleData = collect($request->only($this->vehicleKeys))->mapWithKeys(function ($item, $key) {
                return [str_replace('vehicle_', '', $key) => $item];
            })->toArray();
            $clientData = $request->except($this->vehicleKeys);
        }

        $client = Client::create($clientData);

        if ($vehicleData) {
            $vehicleData['client_id'] = $client->id;
            // force one on one relationship to vehicle model
            Vehicle::updateOrCreate(['client_id' => $client->id], $vehicleData);
        }

        return redirect()->route('client.show', $client->id)->with('status', $this->ok);
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
        $client = Client::findOrFail($id);

        return view('client.show', [
            'client' => $client,
            'catalog' => Catalog::popular()->get(),
            'categories' => Catalog::orderBy('cat', 'desc')->distinct('cat')->pluck('cat'),
            'labor' => [
                'today' => $client->labor()->with('item')->where('date', '=', date('Y-m-d'))->get(),
                'old' => $client->labor()->with('item')->where('date', '<', date('Y-m-d'))->orderBy('date', 'desc')->get(),
            ],
        ]);
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
        $client = Client::findOrFail($id);

        return view('client.edit', [
            'client' => $client,
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
        $client = Client::findOrFail($id);

        $vehicleData = null;
        $clientData = $request->all();

        if (config('crm.mode') === 'mechanic') {
            $vehicleData = collect($request->only($this->vehicleKeys))->mapWithKeys(function ($item, $key) {
                return [str_replace('vehicle_', '', $key) => $item];
            })->toArray();
            $clientData = $request->except($this->vehicleKeys);
        }

        $client->update($clientData);

        if ($vehicleData) {
            $vehicleData['client_id'] = $client->id;
            // force one on one relationship to vehicle model
            $client->vehicle()->updateOrCreate(['client_id' => $client->id], $vehicleData);
        }

        return redirect()->route('client.edit', $client->id)->with('status', $this->ok);
    }

    public function delete(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        return view('client.delete', [
            'client' => $client,
        ]);
    }
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('client.index')->with('status', $this->deleted);
    }

    public function laborStore(LaborCreateRequest $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->labor()->create($request->all());

        return redirect()->route('client.show', $client->id)->with('status', $this->ok);
    }

    public function laborDestroy(Request $request, $id, $laborId)
    {
        $client = Client::findOrFail($id);
        $client->labor()->where('id', '=', $laborId)->delete();

        return redirect()->route('client.show', $client->id)->with('status', $this->deleted);
    }

    public function laborEdit(Request $request, $id, $laborId)
    {
        $client = Client::findOrFail($id);
        $labor = $client->labor()->where('id', $laborId)->first();

        return view('client.labor.edit', [
            'client' => $client,
            'labor' => $labor,
        ]);
    }

    public function laborUpdate(Request $request, $id, $laborId)
    {
        $client = Client::findOrFail($id);
        $labor = Labor::find($laborId)->update($request->all());

        return redirect()->route('client.labor.edit', ['id' => $client->id, 'lid' => $laborId])
            ->with('status', $this->ok);
    }

    public function asyncLaborUpdate(Request $request, $id, $laborId)
    {
        $labor = Labor::find($laborId);
        $labor->update($request->all());

        return response()->json([
            'status' => 'ok',
            'data' => $labor,
        ]);
    }
}
