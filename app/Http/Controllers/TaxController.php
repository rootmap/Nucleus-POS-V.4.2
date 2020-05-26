<?php

namespace App\Http\Controllers;
use App\PosSetting;
use App\InvoiceLayoutOne;
use App\InvoiceLayoutTwo;
use App\Customer;
use App\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Tax Rate ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        $store_id=$this->sdc->storeID();
        $user_id=$this->sdc->UserID();
        $InvoiceLayout=1;
        $countInvoiceLayout=PosSetting::where('store_id',$store_id)->count();
        if($countInvoiceLayout<1)
        {
            $tab=new PosSetting;
            $tab->invoice_layout="1";
            $tab->pos_item="16";
            $tab->sales_tax="3.00";
            $tab->sales_part_tax="1.50";
            $tab->sales_discount="5.00";
            $tab->discount_type="2";
            $tab->store_id=$store_id;
            $tab->created_by=$user_id;
            $tab->save();
            $InvoiceLayout=$tab->invoice_layout;
        }

        $ps=PosSetting::where('store_id',$store_id)->orderBy("id","DESC")->first();

            return view('apps.pages.settings.tax',['ps'=>$ps]);
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
        $sales_tax=$request->sales_tax?$request->sales_tax:0;
        $sales_part_tax=$request->sales_part_tax?$request->sales_part_tax:0;
        
        $tab=new PosSetting;
        $tab->sales_tax=$sales_tax;
        $tab->sales_part_tax=$sales_part_tax;
        $tab->pos_defualt_option="Full Tax";
        $tab->store_id=$this->sdc->storeID();
        $tab->created_by=$this->sdc->UserID();
        $tab->save();

        $this->sdc->log("sales","Tax settings Successfully Set.");

        return redirect('tax/settings')->with('status', $this->moduleName.' Info Saved Successfully !'); 
        
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PosSetting  $posSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PosSetting $posSetting,$id=0)
    {
        $sales_tax=$request->sales_tax?$request->sales_tax:0;
        $sales_part_tax=$request->sales_part_tax?$request->sales_part_tax:0;
       
        $tab=$posSetting::find($id);
        $tab->sales_tax=$sales_tax;
        $tab->sales_part_tax=$sales_part_tax;
        $tab->pos_defualt_option=$request->tax_st;
        $tab->store_id=$this->sdc->storeID();
        $tab->updated_by=$this->sdc->UserID();
        $tab->save();
        $this->sdc->log("sales","Tax Rate settings updated.");
        return redirect('tax/settings')->with('status', $this->moduleName.' Info Modified Successfully !'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PosSetting  $posSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosSetting $posSetting)
    {
        //
    }
}
