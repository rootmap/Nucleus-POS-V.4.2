<?php

namespace App\Http\Controllers;

use App\HigherCashierSaleSummary;
use Illuminate\Http\Request;
use App\Store;
use App\Customer;
use Auth;
use Mpdf\Mpdf;
class HigherCashierSaleSummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Highest Seller ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }
    
    public function reporthighestCashierSales(Request $request)
    {
        $cashier_id='';
        if(isset($request->cashier_id))
        {
            $cashier_id=$request->cashier_id;
        }

        
                     //->toSql();

        if(empty($cashier_id))
        {
            $invoice=HigherCashierSaleSummary::where('store_id',$this->sdc->storeID())
                     ->when($cashier_id, function ($query) use ($cashier_id) {
                            return $query->where('cashier_id','=', $cashier_id);
                     })
                     ->orderBy('id','DESC')
                     ->take(100)
                     ->get();
        }
        else
        {
            $invoice=HigherCashierSaleSummary::where('store_id',$this->sdc->storeID())
                     ->when($cashier_id, function ($query) use ($cashier_id) {
                            return $query->where('cashier_id','=', $cashier_id);
                     })
                     ->get();
        }

        //dd($tender_id);              

        $tab_customer=\DB::table('users')->where('store_id',$this->sdc->storeID())->get();

        return view('apps.pages.report.highestsellerSummary',
            [
                'customer'=>$tab_customer,
                'invoice'=>$invoice,
                'cashier_id'=>$cashier_id
            ]);
    }

    public function highestCashierSalesQuery($request)
    {
        

        $cashier_id='';
        if(isset($request->cashier_id))
        {
            $cashier_id=$request->cashier_id;
        }

        

        $invoice=HigherCashierSaleSummary::where('store_id',$this->sdc->storeID())
                     ->when($cashier_id, function ($query) use ($cashier_id) {
                            return $query->where('cashier_id','=', $cashier_id);
                     })
                     ->get();
        //dd($invoice);
        return $invoice;
    }

    public function exportExcelhighestCashierSales(Request $request) 
    {
        //excel 
        $data=array();
        $array_column=array('ID','Cashier Name','Total');
        array_push($data, $array_column);
        $inv=$this->highestCashierSalesQuery($request);
        $ik=1;
        foreach($inv as $voi):
            $inv_arry=array($ik,$voi->cashier_name,$voi->invoice_total);
            array_push($data, $inv_arry);
            $ik++;
        endforeach;

        $reportName="Highest Cashier Sales  Report";
        $report_title="Highest Cashier Sales  Report";
        $report_description="Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));
        /*$data = array(
            array('data1', 'data2'),
            array('data3', 'data4')
        );*/

        //array_unshift($data,$array_column);

       // dd($data);

        $excelArray=array(
            'report_name'=>$reportName,
            'report_title'=>$report_title,
            'report_description'=>$report_description,
            'data'=>$data
        );
        // dd($excelArray);
        $this->sdc->ExcelLayout($excelArray);
        
    }

    public function exportPDFhighestCashierSales(Request $request)
    {

        $data=array();
        
       
        $reportName="Highest Cashier Sales  Report";
        $report_title="Highest Cashier Sales  Report";
        $report_description="Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th class="text-center" style="font-size:12px;" >ID</th>
                        <th class="text-center" style="font-size:12px;" >Cashier Name</th>
                        <th class="text-center" style="font-size:12px;" >Total</th>
                    </tr>
                </thead>
                <tbody>';

                    $inv=$this->highestCashierSalesQuery($request);
                    $ik=1;
                    foreach($inv as $voi):
                        $html .='<tr>
                        <td style="font-size:12px;" class="text-center">'.$ik.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->cashier_name.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->invoice_total.'</td>
                        </tr>';
                        $ik++;
                    endforeach;


                        

             
                /*html .='<tr style="border-bottom: 5px #000 solid;">
                <td style="font-size:12px;">Subtotal </td>
                <td style="font-size:12px;">Total Item : 4</td>
                <td></td>
                <td></td>
                <td style="font-size:12px;" class="text-right">00</td>
                </tr>';*/

                $html .='</tbody></table>';



                $this->sdc->PDFLayout($reportName,$html);


    }

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
     * @param  \App\HigherCashierSaleSummary  $higherCashierSaleSummary
     * @return \Illuminate\Http\Response
     */
    public function show(HigherCashierSaleSummary $higherCashierSaleSummary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HigherCashierSaleSummary  $higherCashierSaleSummary
     * @return \Illuminate\Http\Response
     */
    public function edit(HigherCashierSaleSummary $higherCashierSaleSummary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HigherCashierSaleSummary  $higherCashierSaleSummary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HigherCashierSaleSummary $higherCashierSaleSummary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HigherCashierSaleSummary  $higherCashierSaleSummary
     * @return \Illuminate\Http\Response
     */
    public function destroy(HigherCashierSaleSummary $higherCashierSaleSummary)
    {
        //
    }
}
