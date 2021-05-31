<?php

namespace App\Http\Controllers\Api  ;
use App\Http\Controllers\Controller;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Items::all();
        return response()->json($items);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     
        $request->validate([
            'item_code'=>'required|unique:items|min:3',
            'descriptions'=>'required|min:6',
            'sku'=>'required',
            'pku'=>'required',
            'dku'=>'required',
            'avpu'=>'required',
            'image'=>'required',
            'category_id'=>'required',
        ]);
        $items = new Items();
        $items->item_code = $request->item_code;
        $items->descriptions = $request->descriptions;
        $items->sku = $request->sku;
        $items->pku = $request->pku;
        $items->dku = $request->dku;
        $items->avpu = $request->image;
        $items->category_id = $request->category_id;
        $items->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Items = DB::table('items')->where('id',$id)->first();
        return response()->json($Items);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function edit(Items $items)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['item_code'] = $request->item_code;
        $data['descriptions'] = $request->descriptions;
        $data['sku'] = $request->sku;
        $data['pku'] = $request->pku;
        $data['dku'] = $request->dku;
        $data['avpu'] = $request->avpu;
        $data['category_id'] = $request->category_id;
        DB::table('finance_categories')->where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('items')->where('id',$id)->delete();
    }
}
