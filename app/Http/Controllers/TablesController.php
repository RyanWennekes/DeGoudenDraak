<?php

namespace App\Http\Controllers;

use App\Order;
use App\Table;
use Illuminate\Http\Request;

class TablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        return Table::allTables();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Table $table
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Table $table
     * @return \Illuminate\Http\Response
     */
    public function edit(Table $table)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Table               $table
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $order = Order::where('table_id', $request->get('tableNo'))->orderBy('created_at', 'desc')->first();
            $order->needs_help = 1;
            $order->save();
        } catch(\Exception $exception) {
            return response('Tafelnummer of order niet gevonden', 500);
        }
        return response($order, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Table $table
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        //
    }
}
