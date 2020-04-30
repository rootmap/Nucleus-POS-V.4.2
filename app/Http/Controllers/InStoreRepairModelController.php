<?php

namespace App\Http\Controllers;

use App\InStoreRepairModel;
use Illuminate\Http\Request;

class InStoreRepairModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="In Store Repair Model Settings ";
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
     * @param  \App\InStoreRepairModel  $inStoreRepairModel
     * @return \Illuminate\Http\Response
     */
    public function show(InStoreRepairModel $inStoreRepairModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InStoreRepairModel  $inStoreRepairModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id=0)
    {
        $device=\DB::table('in_store_repair_devices')->where('store_id',$this->sdc->storeID())->get();
        $tab=\DB::table('in_store_repair_models')->where('id',$id)->first();
        return view('apps.pages.instorerepair.settings.model',compact('tab','device'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InStoreRepairModel  $inStoreRepairModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id=0)
    {
        //echo $id; die();
        $devInfo=\DB::table('in_store_repair_devices')
                    ->where('id',$request->device_id)
                    ->first();

        $tab=\DB::table('in_store_repair_models')->where('id',$id)->update(['device_id'=>$request->device_id,
                                                                            'device_name'=>$devInfo->name,
                                                                            'name'=>$request->model_name,
                                                                            'updated_by'=>$this->sdc->UserID()]);
        return redirect('settings/instore/model/list')
                 ->with('success','Model Name Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InStoreRepairModel  $inStoreRepairModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=0)
    {
        $tab=\DB::table('in_store_repair_models')->where('id',$id)->delete();
        return redirect('settings/instore/model/list')
                 ->with('success','Model Name Deleted Successfully.');
    }
}
