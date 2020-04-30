<?php

namespace App\Http\Controllers;
use App\Invoice;
use App\Product;
use App\Customer;
use App\InvoiceProfit;
use Illuminate\Http\Request;

class InvoiceProfitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Sales";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    private function methodToGetMembersCount($search=''){

        $tab=Invoice::join('customers','invoices.customer_id','=','customers.id')
                     ->select('invoices.id','invoices.invoice_id','invoices.created_at','invoices.total_amount','invoices.total_cost','invoices.total_profit','customers.name as customer_name')
                     ->where('invoices.store_id',$this->sdc->storeID())
                     ->orderBy('invoices.id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('invoices.id','LIKE','%'.$search.'%');
                        $query->orWhere('invoices.invoice_id','LIKE','%'.$search.'%');
                        $query->orWhere('invoices.created_at','LIKE','%'.$search.'%');
                        $query->orWhere('invoices.total_amount','LIKE','%'.$search.'%');
                        $query->orWhere('invoices.total_cost','LIKE','%'.$search.'%');
                        $query->orWhere('invoices.total_profit','LIKE','%'.$search.'%');
                        $query->orWhere('customers.name as customer_name','LIKE','%'.$search.'%');
                        return $query;
                     })
                     ->count();
        return $tab;
    }

    private function methodToGetMembers($start, $length,$search=''){

        $tab=Invoice::join('customers','invoices.customer_id','=','customers.id')
                     ->select('invoices.id','invoices.invoice_id','invoices.created_at','invoices.total_amount','invoices.total_cost','invoices.total_profit','customers.name as customer_name',\DB::Raw("(SELECT GROUP_CONCAT((SELECT p.name FROM lsp_products AS p WHERE p.id=d.product_id) SEPARATOR ', ')
FROM lsp_invoice_products AS d WHERE d.invoice_id=lsp_invoices.invoice_id
GROUP BY d.invoice_id) as product"))
                     ->where('invoices.store_id',$this->sdc->storeID())
                     ->orderBy('invoices.id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('invoices.id','LIKE','%'.$search.'%');
                        $query->orWhere('invoices.invoice_id','LIKE','%'.$search.'%');
                        $query->orWhere('invoices.created_at','LIKE','%'.$search.'%');
                        $query->orWhere('invoices.total_amount','LIKE','%'.$search.'%');
                        $query->orWhere('invoices.total_cost','LIKE','%'.$search.'%');
                        $query->orWhere('invoices.total_profit','LIKE','%'.$search.'%');
                        $query->orWhere('customers.name as customer_name','LIKE','%'.$search.'%');
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

    public function index(Request $request)
    {
        $invoice_id='';
        if(isset($request->invoice_id))
        {
            $invoice_id=$request->invoice_id;
        }

        $customer_id='';
        if(isset($request->customer_id))
        {
            $customer_id=$request->customer_id;
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
            $dateString="CAST(lsp_invoices.created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }

        if(empty($invoice_id) && empty($customer_id) && empty($dateString))
        {
            /*$invoice=Invoice::join('customers','invoices.customer_id','=','customers.id')
                     ->select('invoices.*','customers.name as customer_name')
                     ->where('invoices.store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoices.invoice_id','=', $invoice_id);
                     })
                     ->when($customer_id, function ($query) use ($customer_id) {
                            return $query->where('invoices.customer_id','=', $customer_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->orderBy('invoices.id','DESC')
                     ->take(100)
                     ->get();*/

            $invoice=array();
        }
        else
        {
            $invoice=Invoice::join('customers','invoices.customer_id','=','customers.id')
                     ->select('invoices.*','customers.name as customer_name',\DB::Raw("(SELECT GROUP_CONCAT((SELECT p.name FROM lsp_products AS p WHERE p.id=d.product_id) SEPARATOR ', ')
FROM lsp_invoice_products AS d WHERE d.invoice_id=lsp_invoices.invoice_id
GROUP BY d.invoice_id) as product"))
                     ->where('invoices.store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoices.invoice_id','=', $invoice_id);
                     })
                     ->when($customer_id, function ($query) use ($customer_id) {
                            return $query->where('invoices.customer_id','=', $customer_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->orderBy('invoices.id','DESC')
                     ->get();
        }


        

        $tab_customer=Customer::where('store_id',$this->sdc->storeID())->get();
   

        return view('apps.pages.report.profit',
            [
                'customer'=>$tab_customer,
                'invoice'=>$invoice,
                'invoice_id'=>$invoice_id,
                'customer_id'=>$customer_id,
                'start_date'=>$start_date,
                'end_date'=>$end_date
            ]);
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


    public function profitQuery($request)
    {
        $invoice_id='';
        if(isset($request->invoice_id))
        {
            $invoice_id=$request->invoice_id;
        }

        $customer_id='';
        if(isset($request->customer_id))
        {
            $customer_id=$request->customer_id;
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
            $dateString="CAST(lsp_invoices.created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }




        $invoice=Invoice::join('customers','invoices.customer_id','=','customers.id')
                     ->select('invoices.*','customers.name as customer_name',\DB::Raw("(SELECT GROUP_CONCAT((SELECT p.name FROM lsp_products AS p WHERE p.id=d.product_id) SEPARATOR ', ')
FROM lsp_invoice_products AS d WHERE d.invoice_id=lsp_invoices.invoice_id
GROUP BY d.invoice_id) as product"))
                     ->where('invoices.store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoices.invoice_id','=', $invoice_id);
                     })
                     ->when($customer_id, function ($query) use ($customer_id) {
                            return $query->where('invoices.customer_id','=', $customer_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->get();

        return $invoice;
    }

    public function export(Request $request) 
    {

        //excel 
        $data=array();
        $array_column=array('Invoice ID','Product','Customer Name','Total Amount','Total Cost','Total Profit','Invoice Date');
        array_push($data, $array_column);
        $inv=$this->profitQuery($request);
        foreach($inv as $voi):
            $inv_arry=array($voi->invoice_id,$voi->product,$voi->customer_name,$voi->total_amount,$voi->total_cost,$voi->total_profit,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $reportName="Profit Report";
        $report_title="Profit Report";
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

        $this->sdc->ExcelLayout($excelArray);
        
    }

    public function invoicePDF(Request $request)
    {

        $data=array();
        
       
        $reportName="Profit Report";
        $report_title="Profit Report";
        $report_description="Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >Invoice ID</th>
                <th class="text-center" style="font-size:12px;" >Invoice Date</th>
                <th class="text-center" style="font-size:12px;" >Product</th>
                <th class="text-center" style="font-size:12px;" >Sold To</th>
                <th class="text-center" style="font-size:12px;" >Invoice Total Amount</th>
                <th class="text-center" style="font-size:12px;" >Total Cost Amount</th>
                <th class="text-center" style="font-size:12px;" >Profit</th>
                </tr>
                </thead>
                <tbody>';



                    $inv=$this->profitQuery($request);
                    foreach($inv as $index=>$voi):
    
                        $html .='<tr>
                        <td>'.$voi->invoice_id.'</td>
                        <td>'.formatDate($voi->created_at).'</td>
                        <td>'.$voi->product.'</td>
                        <td>'.$voi->customer_name.'</td>
                        <td>'.$voi->total_amount.'</td>
                        <td>'.$voi->total_cost.'</td>
                        <td>'.$voi->total_profit.'</td>
                        </tr>';

                    endforeach;



                        

             
                /*html .='<tr style="border-bottom: 5px #000 solid;">
                <td style="font-size:12px;">Subtotal </td>
                <td style="font-size:12px;">Total Item : 4</td>
                <td></td>
                <td></td>
                <td style="font-size:12px;" class="text-right">00</td>
                </tr>';*/

                $html .='</tbody></table>';

                //echo $html; die();



                $this->sdc->PDFLayout($reportName,$html);


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
     * @param  \App\InvoiceProfit  $invoiceProfit
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceProfit $invoiceProfit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvoiceProfit  $invoiceProfit
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceProfit $invoiceProfit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvoiceProfit  $invoiceProfit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceProfit $invoiceProfit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvoiceProfit  $invoiceProfit
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceProfit $invoiceProfit)
    {
        //
    }
}
