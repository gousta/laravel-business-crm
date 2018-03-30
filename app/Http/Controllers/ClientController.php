<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\CreateRequest;
use App\Http\Requests\Labor\CreateRequest as LaborCreateRequest;
use App\Models\Catalog;
use App\Models\Client;
use App\Models\Labor;
use Illuminate\Http\Request;

class ClientController extends Controller
{
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
        $client = Client::create($request->all());

        if (empty($client->id)) {
            dump($client);
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
            'client'     => $client,
            'catalog'    => Catalog::popular()->get(),
            'categories' => Catalog::orderBy('cat', 'desc')->distinct('cat')->pluck('cat'),
            'labor'      => [
                'today' => $client->labor()->with('item')->where('date', '=', date('Y-m-d'))->get(),
                'old'   => $client->labor()->with('item')->where('date', '<', date('Y-m-d'))->orderBy('date', 'desc')->get(),
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
        $client->update($request->all());

        return redirect()->route('client.edit', $client->id)->with('status', $this->ok);
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
        //
    }

    public function laborStore(LaborCreateRequest $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->labor()->create($request->all());

        return redirect()->route('client.show', $client->id)->with('status', $this->ok);
    }

    public function laborDestroy(Request $request, $id, $lid)
    {
        $client = Client::findOrFail($id);
        $client->labor()->where('id', '=', $lid)->delete();

        return redirect()->route('client.show', $client->id)->with('status', $this->deleted);
    }

    public function laborEdit(Request $request, $id, $lid)
    {
        $client = Client::findOrFail($id);
        $labor = $client->labor()->where('id', $lid)->first();

        return view('client.labor.edit', [
            'client' => $client,
            'labor'  => $labor,
        ]);
    }

    public function laborUpdate(Request $request, $id, $lid)
    {
        $client = Client::findOrFail($id);
        $labor = Labor::find($lid)->update($request->all());

        return redirect()->route('client.labor.edit', ['id' => $client->id, 'lid' => $lid])
            ->with('status', $this->ok);
    }
}
