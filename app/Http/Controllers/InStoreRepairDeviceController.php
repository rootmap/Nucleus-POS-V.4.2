<?php

namespace App\Http\Controllers;

use App\InStoreRepairDevice;
use Illuminate\Http\Request;

class InStoreRepairDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="In Store Repair Device Settings ";
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
     * @param  \App\InStoreRepairDevice  $inStoreRepairDevice
     * @return \Illuminate\Http\Response
     */
    public function show(InStoreRepairDevice $inStoreRepairDevice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InStoreRepairDevice  $inStoreRepairDevice
     * @return \Illuminate\Http\Response
     */
    public function edit($id=0)
    {
        $tab=\DB::table('in_store_repair_devices')->where('id',$id)->first();
        return view('apps.pages.instorerepair.settings.device',compact('tab'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InStoreRepairDevice  $inStoreRepairDevice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id=0)
    {
        //echo $id; die();
        $tab=\DB::table('in_store_repair_devices')->where('id',$id)->update(['name'=>$request->device_name,'updated_by'=>$this->sdc->UserID()]);
        return redirect('settings/instore/device/list')
                 ->with('success','Device Name Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InStoreRepairDevice  $inStoreRepairDevice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=0)
    {
        $tab=\DB::table('in_store_repair_devices')->where('id',$id)->delete();
        return redirect('settings/instore/device/list')
                 ->with('success','Device Name Deleted Successfully.');
    }
}
