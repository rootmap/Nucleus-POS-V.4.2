<?php

namespace App\Http\Controllers;

use App\Buyback;
use App\Customer;
use App\Tender;
use App\Invoice;
use App\InvoicePayment;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class BuybackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Buyback ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    

    public function index()
    {
        $tab=Buyback::where('store_id',$this->sdc->storeID())->orderBy('id','DESC')->take(100)->get();
        return view('apps.pages.buyback.customer-lead',['existing_cus'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tender=Tender::where('store_id',$this->sdc->storeID())->get();
        $authorizeNettender=Tender::where('authorizenet',1)->get();
        $payPaltender=Tender::where('paypal',1)->get();

        $productData=Customer::select('id','name')->where('store_id',$this->sdc->storeID())->get();
        return view('apps.pages.buyback.create',compact('productData','tender','authorizeNettender','payPaltender'));
    }

    public function createBarcode()
    {
        return view('apps.pages.settings.barcode');
    }

    public function genarateBarcode(Request $request)
    {
        $this->validate($request,[
            'barcode'=>'required',
            'quantity'=>'required'
        ]);

        $barcodedata=$this->sdc->GenarateBarcode($request->barcode);

        $htmlBarcode='<table width="100%" cellpadding="3" cellspacing="3">';
        $d=1;
        for($i=1; $i<=$request->quantity; $i++)
        {
            if($d==1)
            {
                $htmlBarcode .='<tr>';
                $htmlBarcode .='<td><img src="data:image/png;base64,'.$barcodedata.'" /></td>';
            }
            else
            {
                $htmlBarcode .='<td><img src="data:image/png;base64,'.$barcodedata.'" /></td>';
            }

            if($d==3)
            {
                $htmlBarcode .='</tr>';
                $d=0;
            }
            else
            {
                if($i==$request->quantity)
                {
                    if($d==1)
                    {
                        $htmlBarcode .='<td></td>';
                        $htmlBarcode .='<td></td>';
                    }
                    elseif($d==2)
                    {
                        $htmlBarcode .='<td></td>';
                    }

                    $htmlBarcode .='</tr>';
                }
            }
            

            $d++;
        }

        $htmlBarcode .='</table>';

        $this->sdc->PDFLayout("Print Barcode",$htmlBarcode);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'customer_id'=>'required',
            'model'=>'required',
            'keep_this_on'=>'required',
            'price'=>'required',
            'payment_method_id'=>'required'
        ]);
        
            $cus=Customer::find($request->customer_id);
            $ten=Tender::find($request->payment_method_id);
            //dd($request->payment_method_id);
            $tab=new Buyback;
            $tab->customer_id=$request->customer_id;
            $tab->customer_name=$cus->name;
            $tab->model=$request->model;
            $tab->carrier=$request->carrier;
            $tab->imei=$request->imei;
            $tab->type_and_color=$request->type_and_color;
            $tab->memory=$request->memory;
            $tab->keep_this_on=$request->keep_this_on;
            $tab->condition=$request->condition;
            $tab->price=$request->price;
            $tab->payment_method_id=$request->payment_method_id;
            $tab->payment_method_name=$ten->name;
            $tab->store_id=$this->sdc->storeID();
            $tab->created_by=$this->sdc->UserID();
            $tab->save();

            \DB::statement("call updateDailyBuyback('".$this->sdc->UserID()."','".$this->sdc->storeID()."')");
        
        $this->sdc->log("Buyback","New Buyback Has Been Created.");
        return redirect('buyback/create')->with('status', $this->moduleName.' Created Successfully !');
    }

    public function storeFromPOS(Request $request)
    {

            if(empty($request->buyback_customer_id))
            {
                $arrayReturn=array('status'=>0,'msg'=>'Please Select a Customer.');
            }
            elseif(empty($request->buyback_model))
            {
                $arrayReturn=array('status'=>0,'msg'=>'Please Type Model.');
            }
            elseif(empty($request->buyback_keep_this_on))
            {
                $arrayReturn=array('status'=>0,'msg'=>'Please Select Keep this on Parts/Sale.');
            }
            elseif(empty($request->buyback_price))
            {
                $arrayReturn=array('status'=>0,'msg'=>'Please Type Price.');
            }
            elseif(empty($request->buyback_payment_method))
            {
                $arrayReturn=array('status'=>0,'msg'=>'Please Select Payment Method.');
            }
            else
            {
                $cus=Customer::find($request->buyback_customer_id);
                $ten=Tender::find($request->buyback_payment_method);
                //dd($request->payment_method_id);
                $tab=new Buyback;
                $tab->customer_id=$request->buyback_customer_id;
                $tab->customer_name=$cus->name;
                $tab->model=$request->buyback_model;
                $tab->carrier=$request->buyback_carrier;
                $tab->imei=$request->buyback_imei;
                $tab->type_and_color=$request->buyback_type_and_color;
                $tab->memory=$request->buyback_memory;
                $tab->keep_this_on=$request->buyback_keep_this_on;
                $tab->condition=$request->buyback_condition;
                $tab->price=$request->buyback_price;
                $tab->payment_method_id=$request->buyback_payment_method;
                $tab->payment_method_name=$ten->name;
                $tab->store_id=$this->sdc->storeID();
                $tab->created_by=$this->sdc->UserID();
                $tab->save();

                \DB::statement("call updateDailyBuyback('".$this->sdc->UserID()."','".$this->sdc->storeID()."')");
            
                $this->sdc->log("Buyback","New Buyback Has Been Created.");
                $arrayReturn=array('status'=>1);
            }

            return response()->json($arrayReturn);
        
            
        //return redirect('buyback/create')->with('status', $this->moduleName.' Created Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CustomerLead  $customerLead
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=''){

        $tab=\DB::table('buybacks')
                     ->select('id','customer_name','model','carrier','imei','condition','price','payment_method_name','keep_this_on','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                        $query->orWhere('customer_name','LIKE','%'.$search.'%');
                        $query->orWhere('model','LIKE','%'.$search.'%');
                        $query->orWhere('carrier','LIKE','%'.$search.'%');
                        $query->orWhere('imei','LIKE','%'.$search.'%');
                        $query->orWhere('condition','LIKE','%'.$search.'%');
                        $query->orWhere('price','LIKE','%'.$search.'%');
                        $query->orWhere('payment_method_name','LIKE','%'.$search.'%');
                        $query->orWhere('keep_this_on','LIKE','%'.$search.'%');
                        $query->orWhere('created_at','LIKE','%'.$search.'%');

                        return $query;
                     })

                     ->count();
        return $tab;
    }

    private function methodToGetMembers($start, $length,$search=''){

        $tab=\DB::table('buybacks')
                     ->select('id','customer_name','model','carrier','imei','condition','price','payment_method_name','keep_this_on','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                        $query->orWhere('customer_name','LIKE','%'.$search.'%');
                        $query->orWhere('model','LIKE','%'.$search.'%');
                        $query->orWhere('carrier','LIKE','%'.$search.'%');
                        $query->orWhere('imei','LIKE','%'.$search.'%');
                        $query->orWhere('condition','LIKE','%'.$search.'%');
                        $query->orWhere('price','LIKE','%'.$search.'%');
                        $query->orWhere('payment_method_name','LIKE','%'.$search.'%');
                        $query->orWhere('keep_this_on','LIKE','%'.$search.'%');
                        $query->orWhere('created_at','LIKE','%'.$search.'%');

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


    public function show($id=0)
    {
        if($id>0)
        {
           // $invoiceData=Invoice::select('invoice_id')->where('store_id',$this->sdc->storeID())->get();
            $tender=Tender::where('store_id',$this->sdc->storeID())->get();
            $authorizeNettender=Tender::where('authorizenet',1)->get();
            $payPaltender=Tender::where('paypal',1)->get();

            $invoiceData=Invoice::select('invoice_id')->where('store_id',$this->sdc->storeID())->get();

            $tab=\DB::table('buybacks')
                    ->where('id',$id)
                    ->where('store_id',$this->sdc->storeID())
                    ->first();

            $createdBY=\DB::table('users')->select("name")->where('id',$tab->created_by)->first();
            $createdByName=$createdBY->name;

            $productData=Customer::where('id',$tab->customer_id)->where('store_id',$this->sdc->storeID())->first();

            return view('apps.pages.buyback.view',['dataTable'=>$tab,'customer'=>$productData,'created_by'=>$createdByName,'tender'=>$tender,'authorizeNettender'=>$authorizeNettender,'payPaltender'=>$payPaltender,'id'=>$id,'invoiceData'=>$invoiceData]);
        }
        else
        {
            //$tab=\DB::table('buybacks')->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')->take(100)->get();,['dataTable'=>$tab]
            return view('apps.pages.buyback.list');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CustomerLead  $customerLead
     * @return \Illuminate\Http\Response
     */
    public function edit($id=0)
    {

        
        $tender=Tender::where('store_id',$this->sdc->storeID())->get();
        $authorizeNettender=Tender::where('authorizenet',1)->get();
        $payPaltender=Tender::where('paypal',1)->get();

        $productData=Customer::select('id','name')->where('store_id',$this->sdc->storeID())->get();
        $dataRow=\DB::table('buybacks')->where('id',$id)->first();
       //dd($dataRow);
        $orderStatusArray=array('Order Placed','Ready for Shipment','On The Way','Received','Return Order','Cancel');
        return view('apps.pages.buyback.create',['productData'=>$productData,'dataRow'=>$dataRow,'edit'=>$id,'orderStatusArray'=>$orderStatusArray,'tender'=>$tender,'authorizeNettender'=>$authorizeNettender,'payPaltender'=>$payPaltender]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CustomerLead  $customerLead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id=0)
    {
        $this->validate($request,[
            'customer_id'=>'required',
            'model'=>'required',
            'keep_this_on'=>'required',
            'price'=>'required',
            'payment_method_id'=>'required'
        ]);
        
            $cus=Customer::find($request->customer_id);
            $ten=Tender::find($request->payment_method_id);
            //dd($request->payment_method_id);
            $tab=\DB::table('buybacks')
                    ->where('id',$id)
                    ->update([
                        'customer_id'=>$request->customer_id,
                        'customer_name'=>$cus->name,
                        'model'=>$request->model,
                        'carrier'=>$request->carrier,
                        'imei'=>$request->imei,
                        'type_and_color'=>$request->type_and_color,
                        'memory'=>$request->memory,
                        'keep_this_on'=>$request->keep_this_on,
                        'condition'=>$request->condition,
                        'price'=>$request->price,
                        'payment_method_id'=>$request->payment_method_id,
                        'payment_method_name'=>$ten->name,
                        'updated_by'=>$this->sdc->UserID()
                    ]);
        
        $this->sdc->log("Buyback","Buyback Info Has Been Updated.");
        return redirect('buyback/list')->with('status', $this->moduleName.' Updated Successfully !');

    }

    public function buybackAjaxUpdate(Request $request,$id=0)
    {
        if($id>0)
        {
            $field=$request->fid;            
            $field_value=$request->fval; 
            
            if(isset($request->invoice_id))
            {
                $fieldd=$request->fidd; 
                $field_valuee=$request->fvall; 
                $tab=\DB::table('buybacks')
                    ->where('id',$id)
                    ->update([
                        $field=>$field_value,
                        $fieldd=>$field_valuee,
                        'invoice_id'=>$request->invoice_id,
                        'updated_by'=>$this->sdc->UserID()
                    ]);
            }
            elseif(isset($request->fidd))
            {
                $fieldd=$request->fidd; 
                $field_valuee=$request->fvall; 
                $tab=\DB::table('buybacks')
                    ->where('id',$id)
                    ->update([
                        $field=>$field_value,
                        $fieldd=>$field_valuee,
                        'updated_by'=>$this->sdc->UserID()
                    ]);
            }
            else
            {
                if($field=='address')
                {
                    $buy=\DB::table('buybacks')
                            ->where('id',$id)->first();
                    $cus=\DB::table("customers")
                            ->where('id',$buy->customer_id)
                            ->update(['address'=>$field_value,'store_id'=>$this->sdc->storeID()]);
                }
                elseif($field=='phone')
                {
                    $buy=\DB::table('buybacks')
                            ->where('id',$id)->first();
                    $cus=\DB::table("customers")
                            ->where('id',$buy->customer_id)
                            ->update(['phone'=>$field_value,'store_id'=>$this->sdc->storeID()]);
                }
                elseif($field=='email')
                {
                    $buy=\DB::table('buybacks')
                            ->where('id',$id)->first();
                    $cus=\DB::table("customers")
                            ->where('id',$buy->customer_id)
                            ->update(['email'=>$field_value,'store_id'=>$this->sdc->storeID()]);
                }
                else
                {
                    $tab=\DB::table('buybacks')
                    ->where('id',$id)
                    ->update([
                        $field=>$field_value,
                        'updated_by'=>$this->sdc->UserID()
                    ]);
                }
                
            }
            

            $this->sdc->log("Buyback","Buyback ID - ".$id." Info Has Been Updated.");

            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function buybackPrint($buyback_id=0)
    {
        if(!empty($buyback_id))
        {

            $tab_invoice=Buyback::where('id',$buyback_id)
                                ->where('store_id',$this->sdc->storeID())
                                ->first();

            if(!isset($tab_invoice))
            {
                return redirect('buyback/view/'.$buyback_id)->with('error','Invalid Request!!!!'); 
            }

            if(!empty($tab_invoice->invoice_id))
            {
                $invoiceData=Invoice::where('invoice_id',$tab_invoice->invoice_id)->first();
            }
            
                                 
            $invoice_payment=InvoicePayment::where('invoice_id',$tab_invoice->invoice_id)
                                 ->where('store_id',$this->sdc->storeID())
                                 //->groupBy("invoice_id")
                                 ->sum('paid_amount');                     

            $customer=Customer::find($tab_invoice->customer_id);


            $storeUInfo=\DB::table('stores')->where('store_id',$this->sdc->storeID())->first();
            if(!isset($storeUInfo))
            {
                $storeUInfo=\DB::table('stores')->where('id',8)->first();
            }
            //dd($storeUInfo);

                $html="";

                $html .= "<table id='sample-table-2' class='table table-hover' border='1'><tbody>";

                

                //logo tax id start
                $tax_id = 1;
                $store_photo = "Photo / Logo";

                $invInfo=$this->sdc->Invlayout();
                $mpdf=new Mpdf;
                $mpdf->SetTitle('INV-'.$tab_invoice->id);


                if(empty($invInfo->company_name))
                {
                    return redirect('pos')->with('error','Please configure your invoice settings.'); 
                }

                $store_logo="";

                if(!file_exists('company/'.$invInfo->logo))
                {
                    return redirect()->back()->with('error', ' Invoice failed to load, Please Set Invoice/Report Logo. !');
                }
                else
                {
                    $store_logo="<img src='".url('company/'.$invInfo->logo)."' width='130'>";
                }

                $report_cpmpany_name = $invInfo->company_name;
                $report_cpmpany_address = $invInfo->mm_four;
                $report_cpmpany_phone = $invInfo->c_one;
                $report_cpmpany_email = $storeUInfo->email;
                $report_cpmpany_fotter = $invInfo->mm_one;
                $report_cpmpany_terms = $invInfo->terms;

    //logo and tax id end

                $html .= "<tr>
                        <td style='height:40px; background:rgba(0,51,153,1);'>
                            <table style='width:100%; height:40px; border:0px;'>
                                <tr>
                                    <td width='57%' style='background:rgba(0,51,153,1);  color:#FFF; font-size:20px;'>" . $report_cpmpany_name . "</td><td width='13%' style='background:rgba(0,51,153,1);  color:#FFF; font-size:20px;'><span style='float:left; text-align:left;'>".$tab_invoice->payment_method_name." Invoice</span></td>
                                </tr>
                            </table>
                        </td>
                      </tr>
                      <tr>
                        <td style='height:40px;' valign='top'>
                            <table style='width:960px; height:40px; font-size:12px; border:0px;'>
                                <tr>
                                    <td width='69%'>
                                                            Tax ID : " . $tax_id . "<br>
                                    " . $report_cpmpany_address . "
                                    </td>
                                    <td width='31%'>
                                    DIRECT ALL INQUIRIES TO:<br />
                                    " . $report_cpmpany_name . "<br />
                                    " . $report_cpmpany_phone . "<br />
                                    " . $report_cpmpany_email . "<br />
                                    </td>
                                </tr>
                            </table>
                        </td>
                      </tr>
                      <tr>
                        <td style='height:30px;' valign='top'>
                            <table style='width:960px; height:40px; border:0px; font-size:18px;'>
                                <tr>
                                    <td width='69%'> Sold To : </td>
                                                            <td rowspan='2' style='height:30px; text-align:left;' valign='top'>
                                                                " . $store_logo . "
                                                            </td>
                                </tr>
                                                    <tr>
                                                        <td width='69%'>
                                                            Name : " . $customer->name . "<br />
                                                            Phone : " . $customer->phone . "<br />
                                                        </td>
                                                    </tr>
                            </table>
                        </td>
                      </tr>


                        <tr>
                        <td style='height:40px;' valign='top'>
                        <table style='width:960px; height:40px; border:0px;'>
                        <tr>
                        <td width='69%'>
                        Phone Repair Center <br />
                        We Repair | We Buy | We Sell <br />
                        </td>
                        <td width='31%'>
                        DATE : " . formatDate($tab_invoice->created_at) . "<br />";

                        if(!empty($tab_invoice->invoice_id))
                        {
                            $html .= "ORDER NO. : " . $invoiceData->id . "<br />";
                        }
                        else
                        {
                            $html .= "ORDER NO. : Pending<br />";
                        }
                        
                        if(!empty($tab_invoice->invoice_id))
                        {
                            $html .= "SALES REP : ".$tab_invoice->invoice_id." <br />";
                        }
                        else
                        {
                            $html .= "SALES REP : Pending <br />";
                        }

               //tax_rate

               $html .= "</td>
                        </tr>
                        </table>
                        </td>
                        </tr>

                        <tr>
                        <td style='height:40px;' valign='top'>
                        <table style='width:100%; height:40px; border:0px;'>
                        <tr>
                        <td width='79%'>";
                        
                        if(!empty($tab_invoice->invoice_id))
                        {
                            //$html .= "Sales Tax Rate: ".$invoiceData->tax_rate."%";
                            $html .= "Sales Tax Rate: 0%";
                        }
                        else
                        {
                            $html .= "Sales Tax Rate: Pending";
                        }
                

                $html .= "</td>
                        </tr>
                        </table>
                        </td>
                        </tr>

                        <tr>
                        <td valign='top' style='margin:0; padding:0; width:100%;'>
                        <table style='width:100%; height:100px; border:2px;  background:#ccc;'>";
                $html .= "<thead><tr>
                        <td style='background:#ccc; height:50px;'> S/L</td>
                        <td style='background:#ccc; height:50px; height:50px;'>Buyback ID</td>
                        <td style='background:#ccc; height:50px;'>Buyback Detail</td>

                        <td style='background:#ccc; height:50px; height:50px;' style='background:#ccc;'>Quantity</td>
                        <td style='background:#ccc; height:50px;'>Unit Price</td>
                        <td style='background:#ccc; height:50px;'>Total Amount</td>
                        </tr></thead>";

                        $product_name="Model : ".$tab_invoice->model."<br>";
                        $product_name.="Carrier : ".$tab_invoice->carrier."<br>";
                        $product_name.="IMEI : ".$tab_invoice->imei."<br>";
                        $product_name.="Type &amp; Color : ".$tab_invoice->type_and_color."<br>";
                        $product_name.="Memory : ".$tab_invoice->memory."<br>";
                        $product_name.="Keep This On : ".$tab_invoice->keep_this_on."<br>";
                        $product_name.="Condition : ".$tab_invoice->condition;

                
                        $html .= "<thead><tr>
                        <td style='background:#F8F8FF;' valign='top'>1</td>
                        <td style='background:#F8F8FF;' valign='top'>Buyback - " . $tab_invoice->id . "</td>";

                        $html .= "<td style='background:#F8F8FF;' valign='top'>" . $product_name. "</td>";
                    


                        $html .= "<td style='background:#F8F8FF;' valign='top'>1</td>
                        <td style='background:#F8F8FF;' valign='top'>$" . $tab_invoice->price . "</td>
                        <td style='background:#F8F8FF;' valign='top'>
                        <button type='button' class='btn'>$" . $tab_invoice->price . "</button>
                        </td>
                        </tr></thead>";



                //echo $html;
                //exit();
                $html .= "</table></td></tr>";

               // echo $html; die();


                    $deposithtml = '<tr><td><b>Deposit Amount</b></td><td><b>$' . number_format($tab_invoice->price, 2) . '</b></td></tr>';
                


               

                        $html .= "<tr><td>
                                <table style='width:100%;'>
                                <tr>
                                    <td valign='top'>
                                        <table align='left' style='width:300px;border:1px; float:left; font-size:12px; background:#ccc;'>
                                <thead>
                                <tr>
                                <th style='background:#F5FFFA; height:25px; font-size:15px;'>&nbsp;IMEI of Device being repair </th>
                                <th style='background:#F5FFFA; height:25px; font-size:15px;'>&nbsp;" . $tab_invoice->imei . "</th>
                                </tr>
                                <tr>
                                <th style='background:#F5FFFA; height:25px; font-size:15px;'>&nbsp;Carrier </th>
                                <th style='background:#F5FFFA; height:25px; font-size:15px;'>&nbsp;" . $tab_invoice->carrier . "</th>
                                </tr>
                                <tr>
                                <th style='background:#F5FFFA; height:25px; font-size:15px;'>&nbsp;Type &amp; Color </th>
                                <th style='background:#F5FFFA; height:25px; font-size:15px;'>&nbsp;".$tab_invoice->type_and_color."</th>
                                </tr>
                                <tr>
                                <th style='background:#F5FFFA; height:25px; font-size:15px;'>&nbsp;Memory </th>
                                <th style='background:#F5FFFA; height:25px; font-size:15px;'>&nbsp;" . $tab_invoice->memory . "</th>
                                </tr> 
                                <tr>
                                <th style='background:#F5FFFA; height:25px; font-size:15px;'>&nbsp;Condition </th>
                                <th style='background:#F5FFFA; height:25px; font-size:15px;'>&nbsp;" . $tab_invoice->condition . "</th>
                                </tr> 
                                </thead>
                                </table>
                                    </td>
                                <td style='text-align:right;'>";


                    $html .= "<table align='right' style='width:250px;border:1px; float:right; font-size:12px; background:#ccc;'>
                                <thead>
                                <tr>
                                <th style='background:#F5FFFA; height:25px; font-size:15px;'>&nbsp;Payment Status: </th>
                                <th style='background:#F5FFFA; height:25px; font-size:15px;'>&nbsp;" . $tab_invoice->payment_method_name . "</th>
                                </tr>
                                <tr>
                                <th style='background:#F5FFFA; height:25px; font-size:15px;'>&nbsp;Sub - Total: </th>
                                <th style='background:#F5FFFA; height:25px; font-size:15px;'>&nbsp;$" . number_format($tab_invoice->price, 2) . "</th>
                                </tr>
                                <tr>
                                <th style='background:#F5FFFA; height:25px; font-size:15px;'>&nbsp;Tax: </th>
                                <th style='background:#F5FFFA; height:25px; font-size:15px;'>&nbsp;$0.00</th>
                                </tr>
                                <tr>
                                <th style='background:#F5FFFA; height:25px; font-size:15px;'>&nbsp;Total: </th>
                                <th style='background:#F5FFFA; height:25px; font-size:15px;'>&nbsp;$" . number_format($tab_invoice->price, 2) . "</th>
                                </tr>";

                        $html .= "<tr>
                                <th style='background:#F5FFFA; height:25px; font-size:15px;'>&nbsp;Payments : </th>
                                <th style='background:#F5FFFA; height:25px; font-size:15px;'>&nbsp;$";

                                if(!empty($tab_invoice->invoice_id))
                                {
                                    $html .= number_format($tab_invoice->price, 2);
                                }
                                else
                                {
                                    $html .= "0.00";
                                }

                        $html .= "</th>
                                </tr>
                                <tr>
                                <th style='background:#F5FFFA; height:25px; font-size:15px;'>&nbsp;Balance Due: </th>
                                <th style='background:#F5FFFA; height:25px; font-size:15px;'>&nbsp;$";

                                if(!empty($tab_invoice->invoice_id))
                                {
                                    $html .= "0.00";
                                }
                                else
                                {
                                    $html .= number_format($tab_invoice->price, 2);
                                }

                                $html .= '</th></tr>';
                        

                        
                    

                    $html .= "
                                </thead>
                                </table>
                                </td>
                                </tr>
                                </table>
                                </td>
                                </tr>
                                <tr>
                                <td>

                                </td>
                                </tr>";




                    $html .= "<tr>
                                <td align='center' style='font-size:12px; text-align:justify;'><br><br>".$report_cpmpany_terms."<br><br><br><br>" . $report_cpmpany_fotter . "</td>
                                </tr>
                                <tr>
                                <td align='center'>Thank You For Your Business</td>
                                </tr>";

                            $pmt_status=$tab_invoice->payment_status;

                if (strtolower($pmt_status) == "paid") {
                    $color = "#09f;";
                } elseif ($pmt_status == "Partial") {
                    $color = "#FF8C00;";
                } else {
                    $color = "#f00";
                } $html .= "<tr><td align='center' style='color:" . $color . "'><h1 style='width:60%; font-size:100px; display:block; margin-left:auto; margin-right:auto; border:3px " . $color . " solid;'>" . $pmt_status . "</h1></td></tr>";

                $html .= "</tbody></table>";

                //echo $html; die();

                $stylesheet=file_get_contents(url('assets/css/bootstrap.min.css'));
                $stylesheet2=file_get_contents(url('assets/css/style.css'));

                $mpdf->WriteHTML($stylesheet, 1);
                $mpdf->WriteHTML($stylesheet2, 1); // The parameter 1 tells that this is css/style only and no body/html/text
                $mpdf->WriteHTML($html, 2);
                $mpdf->Output('invoice_' . time() . '.pdf', 'I');
                die();
           
        }
        else
        {
            return redirect('sales/report')->with('error', $this->moduleName.' Invoice failed to load, Please try again. !'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CustomerLead  $customerLead
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=0)
    {
        $tab=\DB::table('buybacks')->where('id',$id)->delete();
        $this->sdc->log("Buyback","Buyback Order deleted."); 
        return redirect('buyback/list')->with('status', $this->moduleName.' Deleted Successfully !');
    }

    private function methodToGetReportMembersCount($search=''){

        $tab=\DB::table('buybacks')
                     ->select('id','customer_name','model','carrier','imei','condition','price','payment_method_name','keep_this_on','invoice_id','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                        $query->orWhere('customer_name','LIKE','%'.$search.'%');
                        $query->orWhere('model','LIKE','%'.$search.'%');
                        $query->orWhere('carrier','LIKE','%'.$search.'%');
                        $query->orWhere('imei','LIKE','%'.$search.'%');
                        $query->orWhere('condition','LIKE','%'.$search.'%');
                        $query->orWhere('price','LIKE','%'.$search.'%');
                        $query->orWhere('payment_method_name','LIKE','%'.$search.'%');
                        $query->orWhere('keep_this_on','LIKE','%'.$search.'%');
                        $query->orWhere('invoice_id','LIKE','%'.$search.'%');
                        $query->orWhere('created_at','LIKE','%'.$search.'%');

                        return $query;
                     })

                     ->count();
        return $tab;
    }

    private function methodToGetReportMembers($start, $length,$search=''){

        $tab=\DB::table('buybacks')
                     ->select('id','customer_name','model','carrier','imei','condition','price','payment_method_name','keep_this_on','invoice_id','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                        $query->orWhere('customer_name','LIKE','%'.$search.'%');
                        $query->orWhere('model','LIKE','%'.$search.'%');
                        $query->orWhere('carrier','LIKE','%'.$search.'%');
                        $query->orWhere('imei','LIKE','%'.$search.'%');
                        $query->orWhere('condition','LIKE','%'.$search.'%');
                        $query->orWhere('price','LIKE','%'.$search.'%');
                        $query->orWhere('payment_method_name','LIKE','%'.$search.'%');
                        $query->orWhere('keep_this_on','LIKE','%'.$search.'%');
                        $query->orWhere('invoice_id','LIKE','%'.$search.'%');
                        $query->orWhere('created_at','LIKE','%'.$search.'%');

                        return $query;
                     })
                     ->skip($start)->take($length)->get();
        return $tab;
    }


    public function dataReportjson(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->methodToGetReportMembersCount($search); // get your total no of data;
        $members = $this->methodToGetReportMembers($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

    }
    
    public function report(Request $request)
    {
        //dd(1);
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

        if(empty($invoice_id) && empty($keep_this_on) && empty($customer_id) && empty($start_date) && empty($end_date) && empty($dateString))
        {
            $invoice=array();
            /*$invoice=Buyback::select('id','customer_name','model','carrier','imei','price','condition','payment_method_name','keep_this_on','invoice_id','created_at')
                     ->where('store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoice_id','=', $invoice_id);
                     })
                     ->when($keep_this_on, function ($query) use ($keep_this_on) {
                            return $query->where('keep_this_on','=', $keep_this_on);
                     })                     
                     ->when($customer_id, function ($query) use ($customer_id) {
                            return $query->where('customer_id','=', $customer_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->take(100)
                     ->orderBy('id','DESC')
                     ->get();*/
        }
        else
        {
            $invoice=Buyback::select('id','customer_name','model','carrier','imei','price','condition','payment_method_name','keep_this_on','invoice_id','created_at')
                     ->where('store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoice_id','=', $invoice_id);
                     })
                     ->when($keep_this_on, function ($query) use ($keep_this_on) {
                            return $query->where('keep_this_on','=', $keep_this_on);
                     })                     
                     ->when($customer_id, function ($query) use ($customer_id) {
                            return $query->where('customer_id','=', $customer_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->get();
        }


        
                     //->toSql();

        //dd($tender_id);              

        $tab_customer=Customer::where('store_id',$this->sdc->storeID())->get();

        return view('apps.pages.report.buyback',
            [
                'customer'=>$tab_customer,
                'invoice'=>$invoice,
                'keep_this_on'=>$keep_this_on,
                'invoice_id'=>$invoice_id,
                'customer_id'=>$customer_id,
                'start_date'=>$start_date,
                'end_date'=>$end_date
            ]);
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

        $invoice=Buyback::where('store_id',$this->sdc->storeID())
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
        $total_price_amount=0;
        $data=array();
        $array_column=array('Buyback ID','Invoice ID','Customer Name','Model Name','Carrier','IMEI','Price','Condition','Tender','Parts | Sale');
        array_push($data, $array_column);
        $inv=$this->profitQuery($request);

        foreach($inv as $voi):
            $inv_arry=array($voi->id,$voi->invoice_id,$voi->customer_name,$voi->model,$voi->carrier,$voi->imei,$voi->price,$voi->condition,$voi->payment_method_name,$voi->keep_this_on);
            array_push($data, $inv_arry);
            $total_price_amount+=$voi->price;
        endforeach;

       

        $array_column=array('','','','','','Total =',$total_price_amount,'','','');
        array_push($data, $array_column);
        $reportName="Buyback Report";
        $report_title="Buyback Report";
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
        
       
        $reportName="Buyback Report";
        $report_title="Buyback Report";
        $report_description="Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >Buyback ID</th>
                <th class="text-center" style="font-size:12px;" >Invoice ID</th>
                <th class="text-center" style="font-size:12px;" >Customer Name</th>
                <th class="text-center" style="font-size:12px;" >Model Name</th>
                <th class="text-center" style="font-size:12px;" >Carrier</th>
                <th class="text-center" style="font-size:12px;" >IMEI</th>
                <th class="text-center" style="font-size:12px;" >Condition</th>
                <th class="text-center" style="font-size:12px;" >Price</th>
                <th class="text-center" style="font-size:12px;" >Tender</th>
                <th class="text-center" style="font-size:12px;" >Parts | Sale</th>
                </tr>
                </thead>
                <tbody>';

                    $total_price_amount=0;
                    $inv=$this->profitQuery($request);
                    foreach($inv as $voi):
                        $html .='<tr>
                        <td style="font-size:12px;" class="text-center">'.$voi->id.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->invoice_id.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->customer_name.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->model.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->carrier.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->imei.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->condition.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->price.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->payment_method_name.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->keep_this_on.'</td>
                        </tr>';
                        $total_price_amount+= $voi->price;
                    endforeach;


                        

             
                /*html .='<tr style="border-bottom: 5px #000 solid;">
                <td style="font-size:12px;">Subtotal </td>
                <td style="font-size:12px;">Total Item : 4</td>
                <td></td>
                <td></td>
                <td style="font-size:12px;" class="text-right">00</td>
                </tr>';*/

                $html .= '</tbody>';

                $html .='<tfoot>';
                $html .='<tfoot>';
                $html .='<tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total =</td>
                                <td align="center">'.$total_price_amount .'</td>
                                <td></td>
                                <td></td>
                            </tr>';
                $html .='</table>';



                $this->sdc->PDFLayout($reportName,$html);


    }
}
