<?php

namespace App\Http\Controllers;

use App\Table;
use Illuminate\Http\Request;

class TablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        return [
            new Table(['table_number' => '001', 'menu_id' => 1, 'check_in_time' => '12:00:00', 'waitress_id' => 2]),
            new Table(['table_number' => '002', 'menu_id' => 1, 'check_in_time' => '12:00:00', 'waitress_id' => 2]),
            new Table(['table_number' => '003', 'menu_id' => 1, 'check_in_time' => '12:00:00', 'waitress_id' => 2]),
        ];
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
    public function update(Request $request, Table $table)
    {
        //
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
