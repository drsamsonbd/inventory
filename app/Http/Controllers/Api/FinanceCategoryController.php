<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FinanceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $financeCode = FinanceCategory::all();
        return response()->json($financeCode);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'finance_code'=>'required|unique:finance_categories|min:3',
            'descriptions'=>'required|min:6'
        ]);
        $financeCategory = new FinanceCategory();
        $financeCategory->finance_code = $request->finance_code;
        $financeCategory->descriptions = $request->descriptions;
        $financeCategory->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FinanceCategory  $financeCategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $financeCategory = DB::table('finance_categories')->where('id',$id)->first();
        return response()->json($financeCategory);
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FinanceCategory  $financeCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['finance_code'] = $request->finance_code;
        $data['descriptions'] = $request->descriptions;
        DB::table('finance_categories')->where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FinanceCategory  $financeCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('finance_categories')->where('id',$id)->delete();
    }
}   //

