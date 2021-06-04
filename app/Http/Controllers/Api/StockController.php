<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock = stock::all();
        $stock = DB::table('stocks')
        ->join('items','items.id','stocks.item_id')
        ->join('optimumlevels','stocks.item_id','optimumlevels.item_id')
        ->select('items.*','stocks.*','optimumlevel')
        ->orderBy('items.descriptions','asc')
        ->get();
        return response()->json($stock);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'department_id'=>'required',
            'item_id'=>'required',
            'current_level'=>'required',
            'change_type'=>'required',
            'change_details'=>'required',
            'quantity'=>'required',
            'date'=>'daterequired',

        ]);
        $optimum = new optimumlevels;
        $optimum->department_id = $request->department_id;
        $optimum->item_id = $request->item_id;
        $optimum->optimum_level = $request->optimum_id;
        $optimum->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(stock $stock)
    {
        //
    }
}
