<?php

namespace App\Http\Controllers;

use App\CloseDrawer;
use Illuminate\Http\Request;
use App\Invoice;
use App\User;
use Mpdf\Mpdf;

class CloseDrawerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Close Store ";
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
     * @param  \App\CloseDrawer  $closeDrawer
     * @return \Illuminate\Http\Response
     */
    public function show(CloseDrawer $closeDrawer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CloseDrawer  $closeDrawer
     * @return \Illuminate\Http\Response
     */
    public function edit(CloseDrawer $closeDrawer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CloseDrawer  $closeDrawer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CloseDrawer $closeDrawer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CloseDrawer  $closeDrawer
     * @return \Illuminate\Http\Response
     */
    public function destroy(CloseDrawer $closeDrawer)
    {
        //
    }
    public function report(Request $request)
    {
        //dd(1);
        
        $user_id='';
        if(isset($request->user_id))
        {
            $user_id=$request->user_id;
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


        if(empty($user_id) && empty($dateString))
        {
            /*$tabledata=CloseDrawer::select('id','opeing_time','closing_time','opening_amount','closing_amount','cashier_name','created_at')
                     ->where('store_id',$this->sdc->storeID())
                     ->when($user_id, function ($query) use ($user_id) {
                            return $query->where('cashier_id','=', $user_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->orderBy('id','DESC')
                     ->take(100)
                     ->get();*/

            $tabledata=array();
        }
        else
        {
            $tabledata=CloseDrawer::select('id','opeing_time','closing_time','opening_amount','closing_amount','cashier_name','created_at')
                     ->where('store_id',$this->sdc->storeID())
                     ->when($user_id, function ($query) use ($user_id) {
                            return $query->where('cashier_id','=', $user_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->get();
        }

        
                     //->toSql();

        //dd($tender_id);              

        $tab_user=User::where('store_id',$this->sdc->storeID())->get();

        return view('apps.pages.report.close-store',
            [
                'user'=>$tab_user,
                'tabledata'=>$tabledata,
                'start_date'=>$start_date,
                'end_date'=>$end_date
            ]);
    }

    private function closeDrawerReportPRCount($search=''){

        $tab=CloseDrawer::select('id')
                          ->where('store_id',$this->sdc->storeID())
                          ->orderBy('id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('opeing_time','LIKE','%'.$search.'%');
                            $query->orWhere('closing_time','LIKE','%'.$search.'%');
                            $query->orWhere('opening_amount','LIKE','%'.$search.'%');
                            $query->orWhere('closing_amount','LIKE','%'.$search.'%');
                            $query->orWhere('cashier_name','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');
                            return $query;
                          })
                          ->count();
        return $tab;
    }

    private function closeDrawerReportPR($start, $length,$search=''){

        $tab=CloseDrawer::select('id','opeing_time','closing_time','opening_amount','closing_amount','cashier_name','created_at')
                          ->where('store_id',$this->sdc->storeID())
                          ->orderBy('id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('opeing_time','LIKE','%'.$search.'%');
                            $query->orWhere('closing_time','LIKE','%'.$search.'%');
                            $query->orWhere('opening_amount','LIKE','%'.$search.'%');
                            $query->orWhere('closing_amount','LIKE','%'.$search.'%');
                            $query->orWhere('cashier_name','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');
                            return $query;
                          })
                          ->skip($start)->take($length)->get();
        return $tab;
    }


    public function closeDrawerReportPRjson(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->closeDrawerReportPRCount($search); // get your total no of data;
        $members = $this->closeDrawerReportPR($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

    }

    public function profitQuery($request)
    {
        $invoice_id='';
        if(isset($request->invoice_id))
        {
            $invoice_id=$request->invoice_id;
        }        

        $keep_this_on='';
        if(isset($request->keep_this_on))
        {
            $keep_this_on=$request->keep_this_on;
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
            $dateString="CAST(created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }

        $invoice=CloseDrawer::where('store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoice_id','=', $invoice_id);
                     })
                     ->when($customer_id, function ($query) use ($customer_id) {
                            return $query->where('customer_id','=', $customer_id);
                     })
                     ->when($keep_this_on, function ($query) use ($keep_this_on) {
                            return $query->where('keep_this_on','=', $keep_this_on);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->get();
        //dd($invoice);
        return $invoice;
    }

    public function exportExcel(Request $request) 
    {
        //excel 
        $data=array();
        $array_column=array('ID','Opeing Time','Opeing Amount','Closing Time','Closing Amount','Cashier Name');
        array_push($data, $array_column);
        $inv=$this->profitQuery($request);

        foreach($inv as $voi):
            $inv_arry=array($voi->id,formatDateTime($voi->opeing_time),$voi->opening_amount,formatDateTime($voi->closing_time),$voi->closing_amount,$voi->cashier_name);
            array_push($data, $inv_arry);
        endforeach;

        $reportName="Close Store Report";
        $report_title="Close Store Report";
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

    public function exportPDF(Request $request)
    {

        $data=array();
        
       
        $reportName="Close Store Report";
        $report_title="Close Store Report";
        $report_description="Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >ID</th>
                <th class="text-center" style="font-size:12px;" >Opeing Time</th>
                <th class="text-center" style="font-size:12px;" >Opeing Amount</th>
                <th class="text-center" style="font-size:12px;" >Closing Time</th>
                <th class="text-center" style="font-size:12px;" >Closing Amount</th>
                <th class="text-center" style="font-size:12px;" >Cashier Name</th>
                </tr>
                </thead>
                <tbody>';

                    $inv=$this->profitQuery($request);
                    foreach($inv as $voi):
                        $html .='<tr>
                        <td style="font-size:12px;" class="text-center">'.$voi->id.'</td>
                        <td style="font-size:12px;" class="text-center">'.formatDateTime($voi->opeing_time).'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->opening_amount.'</td>
                        <td style="font-size:12px;" class="text-center">'.formatDateTime($voi->closing_time).'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->closing_amount.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->cashier_name.'</td>
                        </tr>';

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
}
