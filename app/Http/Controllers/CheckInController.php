<?php

namespace App\Http\Controllers;

use App\CheckIn;
use App\Stock;
use Illuminate\Http\Request;

class CheckInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('librarian.checkin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = \App\Stock::where('stock', $request->stock)->first()->id;
        if(\App\CheckOut::where('stock_id', $id)->exists()){
            $t = \App\Stock::where('stock',$request->stock)->first();
            $t->status=1;
            $t->save();
            \App\CheckIn::create(['stock' => $request->stock]);
        }

        return redirect('checkins/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CheckIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function show(CheckIn $checkIn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CheckIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function edit(CheckIn $checkIn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CheckIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CheckIn $checkIn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CheckIn  $checkIn
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckIn $checkIn)
    {
        //
    }
}
