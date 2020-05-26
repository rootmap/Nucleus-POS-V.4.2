<?php

namespace App\Http\Controllers;

use App\HigherCashierSale;
use Illuminate\Http\Request;
use App\Store;
use App\Customer;
use Auth;
use Mpdf\Mpdf;
class HigherCashierSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Highest Seller ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }
    

    private function methodToGetMembersCount($search=''){

        $tab=HigherCashierSale::select('id','created_at','cashier_name','invoice_total')
                     ->where('store_id',$this->sdc->storeID())
                     ->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                        $query->orWhere('created_at','LIKE','%'.$search.'%');
                        $query->orWhere('cashier_name','LIKE','%'.$search.'%');
                        $query->orWhere('invoice_total','LIKE','%'.$search.'%');
                        return $query;
                     })
                     ->count();
        return $tab;
    }

    private function methodToGetMembers($start, $length,$search=''){

        $tab=HigherCashierSale::select('id','created_at','cashier_name','invoice_total')
                     ->where('store_id',$this->sdc->storeID())
                     ->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                        $query->orWhere('created_at','LIKE','%'.$search.'%');
                        $query->orWhere('cashier_name','LIKE','%'.$search.'%');
                        $query->orWhere('invoice_total','LIKE','%'.$search.'%');
                        return $query;
                     })
                     ->skip($start)->take($length)->get();
        return $tab;
    }


    public function datajson(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->methodToGetMembersCount($search); // get your total no of data;
        $members = $this->methodToGetMembers($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

    }

    public function reporthighestCashierSales(Request $request)
    {
        $cashier_id='';
        if(isset($request->cashier_id))
        {
            $cashier_id=$request->cashier_id;
        }

        $start_date='';
        if(isset($request->start_date))
        {
            $start_date=$request->start_date;
        }

        $end_date='';
        if(isset($request->end_date))
        {
            $end_date=$request->end_date;
        }

        if(empty($start_date) && !empty($end_date))
        {
            $start_date=$end_date;
        }

        if(!empty($start_date) && empty($end_date))
        {
            $end_date=$start_date;
        }

        $dateString='';
        if(!empty($start_date) && !empty($end_date))
        {
            $dateString="CAST(created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }

        if(empty($cashier_id) && empty($dateString))
        {
            /*$invoice=HigherCashierSale::where('store_id',$this->sdc->storeID())
                     ->when($cashier_id, function ($query) use ($cashier_id) {
                            return $query->where('cashier_id','=', $cashier_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->orderBy('id','DESC')
                     ->take(100)
                     ->get();*/
            $invoice=array();
        }
        else
        {
            $invoice=HigherCashierSale::where('store_id',$this->sdc->storeID())
                     ->when($cashier_id, function ($query) use ($cashier_id) {
                            return $query->where('cashier_id','=', $cashier_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->get();

        }

        
                     //->toSql();

        //dd($tender_id);              

        $tab_customer=\DB::table('users')->where('store_id',$this->sdc->storeID())->get();

        return view('apps.pages.report.highestseller',
            [
                'customer'=>$tab_customer,
                'invoice'=>$invoice,
                'cashier_id'=>$cashier_id,
                'start_date'=>$start_date,
                'end_date'=>$end_date
            ]);
    }

    public function highestCashierSalesQuery($request)
    {
        

        $cashier_id='';
        if(isset($request->cashier_id))
        {
            $cashier_id=$request->cashier_id;
        }

        
        $start_date='';
        if(isset($request->start_date))
        {
            $start_date=$request->start_date;
        }

        $end_date='';
        if(isset($request->end_date))
        {
            $end_date=$request->end_date;
        }

        if(empty($start_date) && !empty($end_date))
        {
            $start_date=$end_date;
        }

        if(!empty($start_date) && empty($end_date))
        {
            $end_date=$start_date;
        }

        $dateString='';
        if(!empty($start_date) && !empty($end_date))
        {
            $dateString="CAST(created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }

        $invoice=HigherCashierSale::where('store_id',$this->sdc->storeID())
                     ->when($cashier_id, function ($query) use ($cashier_id) {
                            return $query->where('cashier_id','=', $cashier_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->get();
        //dd($invoice);
        return $invoice;
    }

    public function exportExcelhighestCashierSales(Request $request) 
    {
        //excel 
        $data=array();
        $array_column=array('ID','Date','Cashier Name','Total');
        array_push($data, $array_column);
        $inv=$this->highestCashierSalesQuery($request);
        $ik=1;
        foreach($inv as $voi):
            $inv_arry=array($ik,formatDate($voi->invoice_date),$voi->cashier_name,$voi->invoice_total);
            array_push($data, $inv_arry);
            $ik++;
        endforeach;

        $reportName="Highest Cashier Datewise Sales  Report";
        $report_title="Highest Cashier Datewise Sales  Report";
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
        
       
        $reportName="Highest Cashier Datewise Sales  Report";
        $report_title="Highest Cashier Datewise Sales  Report";
        $report_description="Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th class="text-center" style="font-size:12px;" >ID</th>
                        <th class="text-center" style="font-size:12px;" >Invoice Date</th>
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
                        <td style="font-size:12px;" class="text-center">'.formatDate($voi->invoice_date).'</td>
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

                $html .='</tbody>
                
                </table>


                ';



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
     * @param  \App\HigherCashierSale  $higherCashierSale
     * @return \Illuminate\Http\Response
     */
    public function show(HigherCashierSale $higherCashierSale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HigherCashierSale  $higherCashierSale
     * @return \Illuminate\Http\Response
     */
    public function edit(HigherCashierSale $higherCashierSale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HigherCashierSale  $higherCashierSale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HigherCashierSale $higherCashierSale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HigherCashierSale  $higherCashierSale
     * @return \Illuminate\Http\Response
     */
    public function destroy(HigherCashierSale $higherCashierSale)
    {
        //
    }
}
