<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\optimumlevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class OptimumlevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $optimum = optimumlevel::all();
        $optimum = DB::table('optimumlevels')
      ->join('items','items.id','optimumlevels.item_id')
      ->join('stocks','stocks.item_id','optimumlevels.item_id')
      ->select('items.*','stocks.*','optimumlevel')
      ->orderBy('items.descriptions','asc')
        ->get();
        return response()->json($optimum);
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
            'optimum_level'=>'required',
        ]);
        $optimum = new optimumlevel;
        $optimum->department_id = $request->department_id;
        $optimum->item_id = $request->item_id;
        $optimum->optimum_level = $request->optimum_id;
        $optimum->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\optimumlevel  $optimumlevel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $optimum = DB::table('optimumlevels')->where('id',$id)->first();
        return response()->json($optimum);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\optimumlevel  $optimumlevel
     * @return \Illuminate\Http\Response
     */
    public function edit(optimumlevel $optimumlevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\optimumlevel  $optimumlevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['department_id'] = $request->department_id;
        $data['item_id'] = $request->item_id;
        $data['optimum_level'] = $request->optimum_level;
        DB::table('optimumlevels')->where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\optimumlevel  $optimumlevel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('optimumlevels')->where('id',$id)->delete();
    }
}
