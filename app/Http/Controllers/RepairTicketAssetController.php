<?php

namespace App\Http\Controllers;

use App\RepairTicketAsset;
use Illuminate\Http\Request;

class RepairTicketAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    private $moduleName="Inventory / Non-Inventory Repair Asset ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index($asset='')
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($asset='')
    {
        //dd($asset);
        if(!empty($asset))
        {
            if($asset=="repair")
            {

                $dataTable=\DB::table('repair_ticket_assets')->where('store_id',$this->sdc->storeID())->where('asset_type',$asset)->get();
                //dd($dataTable);
                return view('apps.pages.instorerepair.settings.asset',compact('asset','dataTable'));       
            }
            elseif($asset=="ticket")
            {
                $dataTable=\DB::table('repair_ticket_assets')->where('store_id',$this->sdc->storeID())->where('asset_type',$asset)->get();
                return view('apps.pages.instorerepair.settings.asset',compact('asset','dataTable'));   
            }
            else
            {
                return redirect($_SERVER['HTTP_REFERER'])->with('error','Invalid URL!!!');
            }
        }
        else
        {
            return redirect($_SERVER['HTTP_REFERER'])->with('error','Invalid URL!!!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$asset='')
    {
        $this->validate($request,[
            'name'=>'required',
        ]);


        $tab=new RepairTicketAsset;
        $tab->name=$request->name;
        $tab->asset_type=$asset;
        $tab->store_id=$this->sdc->storeID();
        $tab->created_by=$this->sdc->UserID();
        $tab->save();

        $this->sdc->log("Asset-".$asset,"Created Successfully.");

        return redirect($_SERVER['HTTP_REFERER'])->with('status', $asset.' Added Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RepairTicketAsset  $repairTicketAsset
     * @return \Illuminate\Http\Response
     */
    public function show(RepairTicketAsset $repairTicketAsset,$asset='')
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RepairTicketAsset  $repairTicketAsset
     * @return \Illuminate\Http\Response
     */
    public function edit(RepairTicketAsset $repairTicketAsset,$asset='',$id=0)
    {
        if(!empty($asset))
        {
            if($asset=="repair")
            {

                $edit=\DB::table('repair_ticket_assets')->where('store_id',$this->sdc->storeID())->where('asset_type',$asset)->where('id',$id)->first();
                $dataTable=\DB::table('repair_ticket_assets')->where('store_id',$this->sdc->storeID())->where('asset_type',$asset)->get();
                //dd($dataTable);
                return view('apps.pages.instorerepair.settings.asset',compact('asset','dataTable','edit'));       
            }
            elseif($asset=="ticket")
            {
                $edit=\DB::table('repair_ticket_assets')->where('store_id',$this->sdc->storeID())->where('asset_type',$asset)->where('id',$id)->first();
                $dataTable=\DB::table('repair_ticket_assets')->where('store_id',$this->sdc->storeID())->where('asset_type',$asset)->get();
                return view('apps.pages.instorerepair.settings.asset',compact('asset','dataTable','edit'));   
            }
            else
            {
                return redirect($_SERVER['HTTP_REFERER'])->with('error','Invalid URL!!!');
            }
        }
        else
        {
            return redirect($_SERVER['HTTP_REFERER'])->with('error','Invalid URL!!!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RepairTicketAsset  $repairTicketAsset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RepairTicketAsset $repairTicketAsset,$asset='',$id=0)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);


        $tab=\DB::table('repair_ticket_assets')->where('store_id',$this->sdc->storeID())->where('asset_type',$asset)->where('id',$id)->update(['name'=>$request->name]);

        $this->sdc->log("Asset-".$asset," Updated Successfully.");

        return redirect($_SERVER['HTTP_REFERER'])->with('status', $asset.' Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RepairTicketAsset  $repairTicketAsset
     * @return \Illuminate\Http\Response
     */
    public function destroy(RepairTicketAsset $repairTicketAsset,$asset='',$id=0)
    {
        $tab=\DB::table('repair_ticket_assets')->where('store_id',$this->sdc->storeID())->where('asset_type',$asset)->where('id',$id)->delete();
        

        $this->sdc->log("Asset ".$asset,$asset." asset deleted.");

        return redirect($_SERVER['HTTP_REFERER'])->with('status', $asset.' Deleted Successfully !');
    }
}
