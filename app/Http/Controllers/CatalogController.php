<?php

namespace App\Http\Controllers;

use App\Http\Requests\Catalog\CreateRequest;
use App\Models\Catalog;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalog = Catalog::orderBy('id', 'desc')->get();

        return view('catalog.index', [
            'catalog' => $catalog,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $item = $request->old();

        return view('catalog.create', [
            'item'       => $item,
            'categories' => Catalog::orderBy('cat', 'desc')->distinct('cat')->pluck('cat'),
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
        $item = Catalog::create($request->all());

        if (empty($item->id)) {
            dump($item);
        }

        return redirect()->route('catalog.index')->with('status', $this->ok);
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
        $item = Catalog::findOrFail($id);

        return view('catalog.show', [
            'item'       => $item,
            'categories' => Catalog::orderBy('cat', 'desc')->distinct('cat')->pluck('cat'),
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
        $item = Catalog::findOrFail($id);

        return view('catalog.edit', [
            'item'       => $item,
            'categories' => Catalog::orderBy('cat', 'desc')->distinct('cat')->pluck('cat'),
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
        $item = Catalog::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('catalog.edit', $item->id)->with('status', $this->ok);
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
}
