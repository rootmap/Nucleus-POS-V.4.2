<?php

namespace App\Http\Controllers;

use App\InStoreRepairPrice;
use Illuminate\Http\Request;

class InStoreRepairPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="In Store Repair Price Settings ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InStoreRepairPrice  $inStoreRepairPrice
     * @return \Illuminate\Http\Response
     */
    public function show(InStoreRepairPrice $inStoreRepairPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InStoreRepairPrice  $inStoreRepairPrice
     * @return \Illuminate\Http\Response
     */
    public function edit($id=0)
    {
        $device=\DB::table('in_store_repair_devices')->where('store_id',$this->sdc->storeID())->get();
        $model=\DB::table('in_store_repair_models')->where('store_id',$this->sdc->storeID())->get();
        $problem=\DB::table('in_store_repair_problems')->where('store_id',$this->sdc->storeID())->get();
        $tab=\DB::table('in_store_repair_prices')->where('id',$id)->first();
        return view('apps.pages.instorerepair.settings.price',compact('tab','device','model','problem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InStoreRepairPrice  $inStoreRepairPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id=0)
    {
        
        $device=\DB::table('in_store_repair_devices')
                   ->where('id',$request->device_id)
                   ->first();

        $model=\DB::table('in_store_repair_models')
                  ->where('id',$request->model_id)
                   ->first();

        $problem=\DB::table('in_store_repair_problems')
                    ->where('id',$request->problem_id)
                    ->first();

        $tabInfo=\DB::table('in_store_repair_prices')
                    ->where('id',$id)
                    ->first();
        
        $oldProductName=$tabInfo->device_name.", ".$tabInfo->model_name." - ".$tabInfo->problem_name;

        $tabInfoProduct=\DB::table('in_store_repair_products')
                           ->where('device_id',$tabInfo->device_id)
                           ->where('model_id',$tabInfo->model_id)
                           ->where('problem_id',$tabInfo->problem_id)
                           ->first();

        $pid=$tabInfoProduct->id;
        $product_id=$tabInfoProduct->product_id;

        $newProductName=$device->name.", ".$model->name." - ".$problem->name;

        \DB::table('in_store_repair_products')
                           ->where('id',$pid)
                           ->update([
                                        'device_id'=>$request->device_id,
                                        'device_name'=>$device->name,
                                        'model_id'=>$request->model_id,
                                        'model_name'=>$model->name,
                                        'problem_id'=>$request->problem_id,
                                        'problem_name'=>$problem->name,
                                        'name'=>$newProductName,
                                        'price'=>$request->price,
                                        'cost'=>$request->price
                                    ]);

        \DB::table('products')
                           ->where('id',$product_id)
                           ->update([
                                        'name'=>$newProductName,
                                        'price'=>$request->price,
                                        'cost'=>$request->price
                                    ]);

        $tab=\DB::table('in_store_repair_prices')
                ->where('id',$id)
                ->update([
                          'device_id'=>$request->device_id,
                          'device_name'=>$device->name,
                          'model_id'=>$request->model_id,
                          'model_name'=>$model->name,
                          'problem_id'=>$request->problem_id,
                          'problem_name'=>$problem->name,
                          'price'=>$request->price,
                          'updated_by'=>$this->sdc->UserID()
                        ]);

        return redirect('settings/instore/price/list')
                 ->with('success','Repair Price Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InStoreRepairPrice  $inStoreRepairPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=0)
    {
        $tab=\DB::table('in_store_repair_prices')->where('id',$id)->delete();
        return redirect('settings/instore/price/list')
                 ->with('success','Repair Price Deleted Successfully.');
    }
}
