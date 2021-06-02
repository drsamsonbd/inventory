<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\pku;
use Illuminate\Http\Request;
use DB;

class PkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pku= pku::all();

        $pku = DB::table('pkus')
        ->orderBy('pku','asc')
        ->get();
        return response()->json($pku);
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
            'pku'=>'required|unique:pkus',         

        ]);
        $pku = new pku();
        $pku->pku = $request->pku;
        $pku->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pku  $pku
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pku = DB::table('pkus')->where('id',$id)->first();
        return response()->json($pku);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pku  $pku
     * @return \Illuminate\Http\Response
     */
    public function edit(pku $pku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pku  $pku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['pku'] = $request->pku;
        DB::table('pkus')->where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pku  $pku
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('pkus')->where('id',$id)->delete();
    }
}
