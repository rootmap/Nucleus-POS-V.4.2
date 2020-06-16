<?php

namespace App\Http\Controllers;

use App\Tender;
use App\Invoice;
use App\Customer;
use App\InvoicePayment;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
class TenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Tender";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        $tab=Tender::where('store_id',$this->sdc->storeID())->get();
        return view('apps.pages.tender.tender',['dataTable'=>$tab]);
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
    public function profitQuery($request)
    {
        $invoice=Tender::where('store_id',$this->sdc->storeID())->get();

        return $invoice;
    }

    public function exportExcel(Request $request) 
    {
        //echo "string"; die();
        //excel 
        $data=array();
        $array_column=array('ID','Name');
        array_push($data, $array_column);
        $inv=$this->profitQuery($request);
        foreach($inv as $voi):
            $inv_arry=array($voi->id,$voi->name);
            array_push($data, $inv_arry);
        endforeach;

        $reportName="Tender Report";
        $report_title="Tender Report";
        $report_description="Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));
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
        $reportName="Tender Report";
        $report_title="Tender Report";
        $report_description="Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >ID</th>
                <th class="text-center" style="font-size:12px;" >Name</th>
                </tr>
                </thead>
                <tbody>';

                    $inv=$this->profitQuery($request);
                    foreach($inv as $voi):
                        $html .='<tr>
                        <td style="font-size:12px;" class="text-center">'.$voi->id.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->name.'</td>
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
    public function store(Request $request)
    {
         $this->validate($request,[
            'name'=>'required',
        ]);


        $tab=new Tender;
        $tab->name=$request->name;
        $tab->store_id=$this->sdc->storeID();
        $tab->created_by=$this->sdc->UserID();
        $tab->save();

        $this->sdc->log("tender","Tender Type created");
        return redirect('tender')->with('status', $this->moduleName.' Added Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function show(Tender $tender)
    {
        $tab=$tender::where('store_id',$this->sdc->storeID())->get();
        return view('apps.pages.tender.list',['dataTable'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function edit(Tender $tender,$id=0)
    {
        $tab=$tender::find($id);
        $tabData=$tender::where('store_id',$this->sdc->storeID())->get();
        return view('apps.pages.tender.tender',['dataRow'=>$tab,'dataTable'=>$tabData,'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tender $tender, $id=0)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);

        $tab=$tender::find($id);
        $tab->name=$request->name;
        $tab->updated_by=$this->sdc->UserID();
        $tab->save();
        $this->sdc->log("tender","Tender Type updated");
        return redirect('tender')->with('status', $this->moduleName.' Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tender  $tender
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tender $tender, $id=0)
    {
        $tab=$tender::find($id);
        $tab->delete();
        $this->sdc->log("tender","Tender Type deleted");
        return redirect('tender')->with('status', $this->moduleName.' Deleted Successfully !');
    }


    public function Report(Invoice $invoice,request $request)
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
        // dd($customer_id);
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

        $tender_id='';
        if(isset($request->tender_id))
        {
            $tender_id=$request->tender_id;
        }

        $dateString='';
        if(!empty($start_date) && !empty($end_date))
        {
            $dateString="CAST(created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }

        if(empty($invoice_id) && empty($tender_id) && empty($customer_id) && empty($dateString))
        {
            /*$tab=InvoicePayment::where('store_id',$this->sdc->storeID())
                             ->when($invoice_id, function ($query) use ($invoice_id) {
                                    return $query->where('invoice_id','=', $invoice_id);
                             })
                             ->when($tender_id, function ($query) use ($tender_id) {
                                    return $query->where('tender_id','=', $tender_id);
                             })
                             ->when($customer_id, function ($query) use ($customer_id) {
                                    return $query->where('customer_id','=', $customer_id);
                             })
                             ->when($dateString, function ($query) use ($dateString) {
                                    return $query->whereRaw($dateString);
                             })
                             ->orderBy("id","DESC")
                             ->take(100)
                             ->get();*/

            $tab=array();
        }
        else
        {
            $tab=InvoicePayment::where('store_id',$this->sdc->storeID())
                             ->when($invoice_id, function ($query) use ($invoice_id) {
                                    return $query->where('invoice_id','=', $invoice_id);
                             })
                             ->when($tender_id, function ($query) use ($tender_id) {
                                    return $query->where('tender_id','=', $tender_id);
                             })
                             ->when($customer_id, function ($query) use ($customer_id) {
                                    return $query->where('customer_id','=', $customer_id);
                             })
                             ->when($dateString, function ($query) use ($dateString) {
                                    return $query->whereRaw($dateString);
                             })
                             ->orderBy("id","DESC")
                             ->get();
        }

        
         //dd($tab);      
        $tab_customer=Customer::where('store_id',$this->sdc->storeID())->get();            
        $tab_tender=Tender::whereRaw("store_id='".$this->sdc->storeID()."' OR store_id='0'")->get();            
        return view('apps.pages.report.tander',
            [
                'dataTable'=>$tab,
                'customer' =>$tab_customer,
                'invoice_id'=>$invoice_id,
                'tab_tender'=>$tab_tender,
                'customer_id'=>$customer_id,
                'start_date'=>$start_date,
                'end_date'=>$end_date,
                'tender_id'=>$tender_id
            ]);
    }    


    private function tenderDataReportCount($search=''){

        $tab=InvoicePayment::select('id','invoice_id','created_at','customer_name','tender_name','paid_amount')
                          ->where('store_id',$this->sdc->storeID())
                          ->orderBy('id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('invoice_id','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');
                            $query->orWhere('customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('tender_name','LIKE','%'.$search.'%');
                            $query->orWhere('paid_amount','LIKE','%'.$search.'%');
                            return $query;
                          })
                          ->count();
        return $tab;
    }

    private function tenderDataReport($start, $length,$search=''){

        $tab=InvoicePayment::select('id','invoice_id','created_at','customer_name','tender_name','paid_amount')
                          ->where('store_id',$this->sdc->storeID())
                          ->orderBy('id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('invoice_id','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');
                            $query->orWhere('customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('tender_name','LIKE','%'.$search.'%');
                            $query->orWhere('paid_amount','LIKE','%'.$search.'%');
                            return $query;
                          })
                          ->skip($start)->take($length)->get();
        return $tab;
    }


    public function tenderDataReportjson(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->tenderDataReportCount($search); // get your total no of data;
        $members = $this->tenderDataReport($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

    }

     public function TenderReport(Request $request)
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
        // dd($customer_id);
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

        $tender_id='';
        if(isset($request->tender_id))
        {
            $tender_id=$request->tender_id;
        }
        // dd($invoice_status);
        $dateString='';
        if(!empty($start_date) && !empty($end_date))
        {
            $dateString="CAST(created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }

        $tab=InvoicePayment::where('store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoice_id','=', $invoice_id);
                     })
                     ->when($tender_id, function ($query) use ($tender_id) {
                            return $query->where('tender_id','=', $tender_id);
                     })
                     ->when($customer_id, function ($query) use ($customer_id) {
                            return $query->where('customer_id','=', $customer_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->get();

      // dd($tab);
        return $tab;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductStockin  $productStockin
     * @return \Illuminate\Http\Response
     */
    
    public function ExcelReportTender(Request $request) 
    {
        // dd($request);
        //excel 
        $total_paid_amount=0;
        $data=array();
        $array_column=array('Invoice ID','Sold To','Tender','Paid Amount','Invoice Date');
        array_push($data, $array_column);
        $inv=$this->TenderReport($request);
        foreach($inv as $voi):
            $inv_arry=array($voi->invoice_id,$voi->customer_name,$voi->tender_name,$voi->paid_amount,formatDate($voi->created_at));

            $total_paid_amount+=$voi->paid_amount;
            array_push($data, $inv_arry);
        endforeach;

        $array_column=array('','','Total =',$total_paid_amount,'');
        array_push($data, $array_column);

        $reportName="Tender Report";
        $report_title="Tender Report";
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


    public function PdfReportTender(Request $request)
    {

        $data=array();
        
       
        $reportName="Tender Report";
        $report_title="Tender Report";
        $report_description="Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >Invoice ID</th>
                <th class="text-center" style="font-size:12px;" >Sold To</th>
                <th class="text-center" style="font-size:12px;" >Tender</th>
                <th class="text-center" style="font-size:12px;" >Paid Amount</th>
                <th class="text-center" style="font-size:12px;" >Invoice Date</th>
                </tr>
                </thead>
                <tbody>';

                $total_paid_amount=0;

                    $inv=$this->TenderReport($request);
                    foreach($inv as $index=>$voi):
    
                        $html .='<tr>
                        <td>'.$voi->invoice_id.'</td>
                        <td>'.$voi->customer_name.'</td>
                        <td>'.$voi->tender_name.'</td>
                        <td align="center">'.$voi->paid_amount.'</td>
                        <td>'.formatDate($voi->created_at).'</td>
                        </tr>';
                        $total_paid_amount+=$voi->paid_amount;
                    endforeach;



                        

             
                /*html .='<tr style="border-bottom: 5px #000 solid;">
                <td style="font-size:12px;">Subtotal </td>
                <td style="font-size:12px;">Total Item : 4</td>
                <td></td>
                <td></td>
                <td style="font-size:12px;" class="text-right">00</td>
                </tr>';*/

                $html .='</tbody>';
                    $html .='<tfoot>';
                    $html .='<tfoot>';
                    $html .='<tr>
                    <td></td>
                    <td></td>
                    
                    <td>Total =</td>
                    <td align="center">'.$total_paid_amount.'</td>
                    <td></td>
                    </tr>';
                    $html .='</table>';

                //echo $html; die();



                $this->sdc->PDFLayout($reportName,$html);


    }    
}
