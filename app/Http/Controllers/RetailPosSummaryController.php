<?php

namespace App\Http\Controllers;

use App\RetailPosSummary;
use App\RetailPosSummaryDateWise;
use App\Product;
use App\LoginActivity;
use App\CashierPunch;
use Illuminate\Http\Request;
use Auth;
class RetailPosSummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Product";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }


    public function index(RetailPosSummary $dashboard)
    {


        if(\Auth::check()){

        if(count($this->sdc->dataMenuAssigned())==0)
        {
            return redirect('login')->with(Auth::logout());
        }

        $dash=$dashboard::find(1);
        //print_r($dash); die();
        $Todaydate=date('Y-m-d');
        \DB::statement("call todaySystemSummaryStatus('".$this->sdc->UserID()."','".$this->sdc->storeID()."')");

        \DB::statement("call defaultTicketNRepairCreate('".$this->sdc->UserID()."','".$this->sdc->storeID()."')");
        
        $tabToday=RetailPosSummaryDateWise::whereRaw('report_date=CAST(now() as date)')
                                            ->where('store_id',$this->sdc->storeID())
                                            ->first();

        $invTotalSales=RetailPosSummaryDateWise::where('store_id',$this->sdc->storeID())->sum('sales_amount');
        $invTotalProfit=RetailPosSummaryDateWise::where('store_id',$this->sdc->storeID())->sum('sales_profit');
        $invTotalcost=RetailPosSummaryDateWise::where('store_id',$this->sdc->storeID())->sum('sales_cost');
        //dd($invTotalcost);
        $CashierPunch=CashierPunch::select('id',
                                            'name',
                                            'in_date',
                                            'in_time',
                                            'out_date',
                                            'out_time',\DB::raw('TIMEDIFF(updated_at,created_at) as elsp'))
                                    ->where('store_id',$this->sdc->storeID())
                                    ->orderBy('id','DESC')
                                    ->limit(24)
                                    ->get();

        $LoginActivity=LoginActivity::select('name','activity','created_at')->where('store_id',$this->sdc->storeID())
                                    ->orderBy('id','DESC')
                                    ->limit(24)
                                    ->get();

        $product=Product::where('store_id',$this->sdc->storeID())->orderBy('sold_times','DESC')->limit(8)->get();
        return view('apps.pages.dashboard.index',[
            'dash'=>$dash,
            'product'=>$product,
            'tod'=>$tabToday,
            'cashier_punch'=>$CashierPunch,
            'loginactivity'=>$LoginActivity,
            'invTotalSales'=>$invTotalSales,
            'invTotalProfit'=>$invTotalProfit,
            'invTotalcost'=>$invTotalcost,
        ]);

        }
        else
        {
            return redirect(url('login'));
        }
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
     * @param  \App\RetailPosSummary  $retailPosSummary
     * @return \Illuminate\Http\Response
     */
    public function show(RetailPosSummary $retailPosSummary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RetailPosSummary  $retailPosSummary
     * @return \Illuminate\Http\Response
     */
    public function edit(RetailPosSummary $retailPosSummary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RetailPosSummary  $retailPosSummary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RetailPosSummary $retailPosSummary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RetailPosSummary  $retailPosSummary
     * @return \Illuminate\Http\Response
     */
    public function destroy(RetailPosSummary $retailPosSummary)
    {
        //
    }
}
