<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\ObjekLanjut;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class ObjekLanjutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ol = ObjekLanjut::all();
        return response()->json($ol);
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
            'ol_code'=>'required|unique:objek_lanjuts|min:3',
            'ol_descriptions'=>'required|min:6',
            'finance_code_id'=>'required',
        ]);
        $ol = new ObjekLanjut();
        $ol->ol_code = $request->ol_code;
        $ol->ol_descriptions = $request->ol_descriptions;
        $ol->finance_code_id = $request->finance_code_id;
        $ol->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ObjekLanjut $ojectLanjut
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ol = DB::table('objek_lanjuts')->where('id',$id)->first();
        return response()->json($ol);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ObjekLanjut  $ojectLanjut
     * @return \Illuminate\Http\Response
     */
    public function edit(ObjekLanjut $ojectLanjut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ObjekLanjut  $ojectLanjut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['ol_code'] = $request->ol_code;
        $data['ol_descriptions'] = $request->ol_descriptions;
        $data['finance_code_id'] = $request->finance_code_id;
        DB::table('objek_lanjuts')->where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ObjekLanjut  $ojectLanjut
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('objek_lanjuts')->where('id',$id)->delete();
    }
}
