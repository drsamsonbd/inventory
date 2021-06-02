<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\sku;
use Illuminate\Http\Request;
use DB;
class SkuController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sku= sku::all();

        $sku = DB::table('skus')
        ->orderBy('sku','asc')
        ->get();
        return response()->json($sku);
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
            'sku'=>'required|unique:skus',         

        ]);
        $sku = new sku();
        $sku->sku = $request->sku;
        $sku->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sku  $sku
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sku = DB::table('skus')->where('id',$id)->first();
        return response()->json($sku);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sku  $sku
     * @return \Illuminate\Http\Response
     */
    public function edit(sku $sku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sku  $sku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['sku'] = $request->sku;
        DB::table('skus')->where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sku  $sku
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('skus')->where('id',$id)->delete();
    }
}
