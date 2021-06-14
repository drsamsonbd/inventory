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
      //  $optimum = DB::table('optimumlevels')
     // ->join('items','items.id','optimumlevels.item_id')
     // ->join('stocks','stocks.item_id','optimumlevels.item_id')
     // ->join('departments','departments.id','optimumlevels.department_id')
     // ->select('items.*','stocks.*','optimumlevels.*','departments.name_department')
     // ->orderBy('items.descriptions','asc')
     //   ->get();
        return response()->json($optimum);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {   
        $optimum = DB::table('optimumlevels')->where('optimumlevels.department_id',$id)
       ->join('items','items.id','optimumlevels.item_id')
       // ->join('stocks','stocks.item_id','optimumlevels.item_id')
       // ->join('departments','departments.id','optimumlevels.department_id')
       ->select('items.descriptions','items.image','optimumlevels.*')
       ->orderBy('items.descriptions','asc')
       ->get()
       ;
          return response()->json($optimum);
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
            'current_team_id'=>'required',
            'selected'=>'required',
            'optimum_level'=>'required',
            'minimum_level'=>'required',
        ]);
        $optimum = new optimumlevel;
        $optimum->department_id = $request->current_team_id;
        $optimum->item_id = $request->selected;
        $optimum->optimum_level = $request->optimum_level;
        $optimum->minimum_level = $request->minimum_level;
        $optimum->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\optimumlevel  $optimumlevel
     * @return \Illuminate\Http\Response
     */
    public function show($id) // get item
    {
        $optimum = DB::table('optimumlevels')->where('id',$id)->first();
        return response()->json($optimum);

    }
    public function showbydept($id)// by department
    {
        $optimum = DB::table('optimumlevels')->where('optimumlevels.department_id',$id)
        ->join('items','items.id','optimumlevels.item_id')
        // ->join('stocks','stocks.item_id','optimumlevels.item_id')
        // ->join('departments','departments.id','optimumlevels.department_id')
        ->select('items.descriptions','optimumlevels.id', 'optimumlevels.optimum_level', 'optimumlevels.minimum_level')
      
        ->paginate(2);

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
        $data['optimum_level'] = $request->optimum_level;
        $data['minimum_level'] = $request->minimum_level;
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
