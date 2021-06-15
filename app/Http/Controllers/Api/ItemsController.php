<?php

namespace App\Http\Controllers\Api  ;
use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

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
       // $items = DB::table('items')
       //->join('categories','items.category_id','categories.id')
      //->join('skus','items.category_id','skus.id')
      // ->join('pkus','items.category_id','pkus.id')
      // ->select('items.*','categories.category_name','skus.sku','pkus.pku')
      //  ->orderBy('descriptions','asc')
      //  ->get();
      
        return response()->json($items);

   

        
    }
    public function view($id)
    {
        $items = DB::table('items')->where('items.id',$id)
       ->join('categories','items.category_id','categories.id')
      ->join('skus','items.sku','skus.id')
      // ->join('pkus','items.category_id','pkus.id')
       ->select('items.*','categories.category_name','skus.sku')
      //  ->orderBy('descriptions','asc')
       ->get();
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
        $validateData = $request->validate([
            'item_code'=>'required|unique:items|min:3',
            'descriptions'=>'required|unique:items|min:6',           
            'category_id'=>'required',
        ]);

        if ($request->image){
            $position = strpos($request->image, ';');
            $sub = substr($request->image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->image)->resize(240,200);
            $upload_path = 'asset/img/item/';
            $image_url = $upload_path.$name;
            $img ->save($image_url);

            $items = new Items;
            $items->item_code = $request->item_code;
            $items->descriptions = $request->descriptions;
            $items->sku = $request->sku;
            $items->pku = $request->pku;
            $items->dku = $request->dku;
            $items->avpu = $request->avpu;
            $items->category_id = $request->category_id;
            $items->image = $image_url;
            $items->save();
            } else {

            $items = new Items;
            $items->item_code = $request->item_code;
            $items->descriptions = $request->descriptions;
            $items->sku = $request->sku;
            $items->pku = $request->pku;
            $items->dku = $request->dku;
            $items->avpu = $request->avpu;
            $items->category_id = $request->category_id;
            
            $items->save();

        }
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
     
       

        if ($request->newimage){
        $image =  $request->newimage;         
        $position = strpos($image, ';');
        $sub = substr($image, 0, $position);
        $ext = explode('/', $sub)[1];

        $name = time().".".$ext;
        $img = Image::make($image)->resize(240,200);
        $upload_path = 'asset/img/item/';
        $image_url = $upload_path.$name;  
        $img ->save($image_url); 




        $data = array();
        $data['item_code'] = $request->item_code;
        $data['descriptions'] = $request->descriptions;
        $data['sku'] = $request->sku;
        $data['pku'] = $request->pku;
        $data['dku'] = $request->dku;
        $data['avpu'] = $request->avpu;
        $data['category_id'] = $request->category_id;
      
            $data['image'] = $image_url;
         
            DB::table('items')->where('id',$id)->update($data);
          }  else {
            $data = array();
            $data['item_code'] = $request->item_code;
            $data['descriptions'] = $request->descriptions;
            $data['sku'] = $request->sku;
            $data['pku'] = $request->pku;
            $data['dku'] = $request->dku;
            $data['avpu'] = $request->avpu;
            $data['category_id'] = $request->category_id;
             
                DB::table('items')->where('id',$id)->update($data);

          }

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
