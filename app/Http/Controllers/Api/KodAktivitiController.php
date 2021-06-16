<?php

namespace App\Http\Controllers\Api;
namespace App\Http\Controllers\Api;

use App\Models\KodAktiviti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KodAktivitiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $aktiviti = KodAktiviti::all();
        return response()->json($aktiviti);
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
            'aktiviti_code'=>'required|unique:kod_aktivitis|min:3',
            'aktiviti_descriptions'=>'required|min:6',
            'objek_lanjut_id'=>'required',
        ]);
        $aktiviti = new KodAktiviti();
        $aktiviti->aktiviti_code = $request->aktiviti_code;
        $aktiviti->aktiviti_descriptions = $request->aktiviti_descriptions;
        $aktiviti->objek_lanjut_id = $request->objek_lanjut_id;
        $aktiviti->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KodAktiviti  $kodAktiviti
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aktiviti = DB::table('kod_ativitis')->where('id',$id)->first();
        return response()->json($aktiviti);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KodAktiviti  $kodAktiviti
     * @return \Illuminate\Http\Response
     */
    public function edit(KodAktiviti $kodAktiviti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KodAktiviti  $kodAktiviti
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['aktiviti_code'] = $request->aktiviti_code;
        $data['aktiviti_descriptions'] = $request->aktiviti_descriptions;
        $data['objek_lanjut_id'] = $request->objek_lanjut_id;
        DB::table('kod_aktivitis')->where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KodAktiviti  $kodAktiviti
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        DB::table('kod_aktivitis')->where('id',$id)->delete();
    }
}
