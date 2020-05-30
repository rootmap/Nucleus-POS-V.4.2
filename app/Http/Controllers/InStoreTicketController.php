<?php

namespace App\Http\Controllers;

use App\InStoreTicket;
use App\Customer;
use App\Category;
use App\Invoice;
use App\InvoicePayment;
use App\TicketProblem;
use App\Product;
use App\InStoreRepairProblem;
use App\RetailPosSummaryDateWise;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class InStoreTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Ticket Report ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }


    private function datatableInstoreTicketCount($search=''){

        $tab=InStoreTicket::select('id','product_name','customer_name','problem_name','payment_status','our_cost','retail_price','imei','invoice_id','created_at')
                          ->where('store_id',$this->sdc->storeID())
                          ->orderBy('id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('product_name','LIKE','%'.$search.'%');
                            $query->orWhere('customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('problem_name','LIKE','%'.$search.'%');
                            $query->orWhere('payment_status','LIKE','%'.$search.'%');
                            $query->orWhere('our_cost','LIKE','%'.$search.'%');
                            $query->orWhere('retail_price','LIKE','%'.$search.'%');
                            $query->orWhere('imei','LIKE','%'.$search.'%');
                            $query->orWhere('invoice_id','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');

                            return $query;
                          })
                          ->count();
        return $tab;
    }

    private function datatableInstoreTicket($start, $length,$search=''){

        $tab=InStoreTicket::select('id','product_name','customer_name','problem_name','payment_status','our_cost','retail_price','imei','invoice_id','created_at')
                          ->where('store_id',$this->sdc->storeID())
                          ->orderBy('id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('product_name','LIKE','%'.$search.'%');
                            $query->orWhere('customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('problem_name','LIKE','%'.$search.'%');
                            $query->orWhere('payment_status','LIKE','%'.$search.'%');
                            $query->orWhere('our_cost','LIKE','%'.$search.'%');
                            $query->orWhere('retail_price','LIKE','%'.$search.'%');
                            $query->orWhere('imei','LIKE','%'.$search.'%');
                            $query->orWhere('invoice_id','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');

                            return $query;
                          })
                          ->skip($start)->take($length)->get();
        return $tab;
    }


    public function datatableInstoreTicketjson(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->datatableInstoreTicketCount($search); // get your total no of data;
        $members = $this->datatableInstoreTicket($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

    }

    public function index()
    {
        /*$invoice=InStoreTicket::select('id','product_name','customer_name','problem_name','payment_status','our_cost','retail_price','imei','invoice_id','created_at')
                              ->where('store_id',$this->sdc->storeID())
                              ->orderBy('id','DESC')
                              ->take(100)
                              ->get();,compact('invoice')*/

        return view('apps.pages.ticket.list');
    }
    public function report(Request $request)
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
            $dateString="CAST(created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }

        if(empty($invoice_id) && empty($customer_id) && empty($start_date) && empty($end_date) && empty($dateString))
        {
            /*$invoice=InStoreTicket::select('id','product_name','customer_name','payment_status','our_cost','retail_price','imei','invoice_id','created_at')
                     ->where('store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoice_id','=', $invoice_id);
                     })
                     ->when($customer_id, function ($query) use ($customer_id) {
                            return $query->where('customer_id','=', $customer_id);
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
            $invoice=InStoreTicket::select('id','product_name','customer_name','payment_status','our_cost','retail_price','imei','invoice_id','created_at')
                     ->where('store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoice_id','=', $invoice_id);
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

        return view('apps.pages.report.ticket',
            [
                'customer'=>$tab_customer,
                'invoice'=>$invoice,
                'invoice_id'=>$invoice_id,
                'customer_id'=>$customer_id,
                'start_date'=>$start_date,
                'end_date'=>$end_date
            ]);
    }

    private function inStoreTicketPRCount($search=''){

        $tab=InStoreTicket::select('id','product_name','customer_name','payment_status','our_cost','retail_price','imei','invoice_id','created_at')
                          ->where('store_id',$this->sdc->storeID())
                          ->orderBy('id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('product_name','LIKE','%'.$search.'%');
                            $query->orWhere('customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('payment_status','LIKE','%'.$search.'%');
                            $query->orWhere('our_cost','LIKE','%'.$search.'%');
                            $query->orWhere('retail_price','LIKE','%'.$search.'%');
                            $query->orWhere('imei','LIKE','%'.$search.'%');
                            $query->orWhere('invoice_id','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');
                            return $query;
                          })
                          ->count();
        return $tab;
    }

    private function inStoreTicketPR($start, $length,$search=''){

        $tab=InStoreTicket::select('id','product_name','customer_name','payment_status','our_cost','retail_price','imei','invoice_id','created_at')
                          ->where('store_id',$this->sdc->storeID())
                          ->orderBy('id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('product_name','LIKE','%'.$search.'%');
                            $query->orWhere('customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('payment_status','LIKE','%'.$search.'%');
                            $query->orWhere('our_cost','LIKE','%'.$search.'%');
                            $query->orWhere('retail_price','LIKE','%'.$search.'%');
                            $query->orWhere('imei','LIKE','%'.$search.'%');
                            $query->orWhere('invoice_id','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');
                            return $query;
                          })
                          ->skip($start)->take($length)->get();
        return $tab;
    }


    public function inStoreTicketPRjson(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->inStoreTicketPRCount($search); // get your total no of data;
        $members = $this->inStoreTicketPR($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tab_customer=Customer::where('store_id',$this->sdc->storeID())->get();
        $problem=TicketProblem::select('id','name')->where('store_id',$this->sdc->storeID())->get();
        $ticketAsset=\DB::table('repair_ticket_assets')->where('asset_type','ticket')->where('store_id',$this->sdc->storeID())->get(); 

        \DB::statement("call defaultTicketNRepairCreate('".$this->sdc->UserID()."','".$this->sdc->storeID()."')");
        
        return view('apps.pages.ticket.create',
        [
            'customer'=>$tab_customer,
            'problem'=>$problem,
            'ticketAsset'=>$ticketAsset
        ]);
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
            'ticket_device_type'=>'required',
            'ticket_problem_id'=>'required',
            'ticket_retail_price'=>'required',
            'ticket_our_cost'=>'required',
            'ticket_customer_id'=>'required'
        ]);
        
            $ticket_id=time();
            $problem_id=$request->ticket_problem_id;
            if($problem_id=="TP0001")
            {

                $checkExProb=TicketProblem::where('store_id',$this->sdc->storeID())
                                          ->where('name',$request->ticket_problem_name)
                                          ->count();
                if($checkExProb==0)
                {
                    $tab=new TicketProblem();
                    $tab->name=$request->ticket_problem_name;
                    $tab->store_id=$this->sdc->storeID();
                    $tab->created_by=$this->sdc->UserID();
                    $tab->save();
                }
                else
                {
                    $tab=TicketProblem::where('store_id',$this->sdc->storeID())
                                      ->where('name',$request->ticket_problem_name)
                                      ->first();
                }
                

                $problem_id=$tab->id;
            }

            $problem_info=TicketProblem::where('id',$problem_id)->first();
            $problem_name=$problem_info->name;

            //InStoreTicket

            $reqArr=$request;

            $product_name=$request->ticket_device_type." - ".$ticket_id;

            $catID=0;
            $catName="";
            $catInfoCount=Category::where('store_id',$this->sdc->storeID())->where('name','Non-Inventory Repair')->count();
            if($catInfoCount>0)
            {
                $catInfo=Category::where('store_id',$this->sdc->storeID())->where('name','Non-Inventory Repair')->first();
                $catID=$catInfo->id;
                $catName=$catInfo->name;
            }

            $ticketDescription='';
            $ticketDescription .='Device Type : '.$request->ticket_device_type;
            if(!empty($problem_name))
            {
                $ticketDescription .=', ';
                $ticketDescription .='Problem : '.$problem_name;
            }

            if(!empty($request->ticket_password))
            {
                $ticketDescription .=', ';
                $ticketDescription .='Password : '.$request->ticket_password;
            }

            if(!empty($request->ticket_type_n_color))
            {
                $ticketDescription .=', ';
                $ticketDescription .='Type & Color : '.$request->ticket_type_n_color;
            }
            
            if(!empty($request->ticket_carrier))
            {
                $ticketDescription .=', ';
                $ticketDescription .='Carrier : '.$request->ticket_carrier;
            }

            if(!empty($request->ticket_imei))
            {
                $ticketDescription .=', ';
                $ticketDescription .='IMEI : '.$request->ticket_imei;
            }

            if(!empty($request->ticket_how_did_you_hear_about_us))
            {
                $ticketDescription .=', ';
                $ticketDescription .='How did you hear aboutus : '.$request->ticket_how_did_you_hear_about_us;
            }

            if(!empty($request->isdropoff))
            {
                $ticketDescription .=', ';
                $ticketDescription .='Is Drop Off : '.$request->isdropoff;
            }

            if(!empty($request->ticket_tested_before_by))
            {
                $ticketDescription .=', ';
                $ticketDescription .='Tested before by : '.$request->ticket_tested_before_by;
            }
            
            if(!empty($request->ticket_tested_after_by))
            {
                $ticketDescription .=', ';
                $ticketDescription .='Tested after by : '.$request->ticket_tested_after_by;
            }

            if(!empty($request->ticket_tech_notes))
            {
                $ticketDescription .=', ';
                $ticketDescription .='Tech Notes : '.$request->ticket_tech_notes;
            }


            $checkExProduct=Product::where('name',$ticketDescription)
                                   ->where('general_sale',1)
                                    ->where('category_id',$catID)
                                   ->where('category_name',$catName)
                                   ->where('store_id',$this->sdc->storeID())
                                   ->count();

            if($checkExProduct>0)
            {
                $tab=Product::where('name',$ticketDescription)
                            ->where('general_sale',1)
                            ->where('category_id',$catID)
                            ->where('category_name',$catName)
                            ->where('store_id',$this->sdc->storeID())
                            ->first();
            }
            else
            {


                $tab=new Product;
                $tab->name=$ticketDescription;
                $tab->detail=$ticketDescription;
                $tab->quantity=1;
                $tab->category_id=$catID;
                $tab->category_name=$catName;
                $tab->price=$request->ticket_retail_price;
                $tab->cost=$request->ticket_our_cost;
                $tab->general_sale=1;
                $tab->store_id=$this->sdc->storeID();
                $tab->created_by=$this->sdc->UserID();
                $tab->save();
            }

            $pid=$tab->id;

            $customer_id=$request->ticket_customer_id;
            $cusInfo=Customer::find($customer_id);
            $customerName=$cusInfo->name;

            $reqArr=$_POST;    


            

            
            $tic=new InStoreTicket();
            $tic->customer_id=$customer_id;
            $tic->customer_name=$customerName;
            $tic->ticket_id=$ticket_id;
            $tic->device_type=$request->ticket_device_type;
            $tic->problem_id=$problem_id;
            $tic->problem_name=$problem_name;
            $tic->our_cost=$request->ticket_our_cost;
            $tic->retail_price=$request->ticket_retail_price;
            $tic->password=$request->ticket_password;
            $tic->type_n_color=$request->ticket_type_n_color;
            $tic->carrier=$request->ticket_carrier;
            $tic->imei=$request->ticket_imei;
            $tic->how_did_you_hear_about_us=$request->ticket_how_did_you_hear_about_us;
            $tic->isdropoff=$request->isdropoff;
            $tic->tested_before_by=$request->ticket_tested_before_by;
            $tic->tested_after_by=$request->ticket_tested_after_by;
            $tic->tech_notes=$request->ticket_tech_notes;

            unset($reqArr['ticket_customer_id']);
            unset($reqArr['ticket_device_type']);
            unset($reqArr['ticket_problem_name']);
            unset($reqArr['ticket_problem_id']);
            unset($reqArr['ticket_our_cost']);
            unset($reqArr['ticket_retail_price']);
            unset($reqArr['ticket_password']);
            unset($reqArr['ticket_type_n_color']);
            unset($reqArr['ticket_carrier']);
            unset($reqArr['ticket_imei']);
            unset($reqArr['ticket_how_did_you_hear_about_us']);
            unset($reqArr['isdropoff']);
            unset($reqArr['ticket_tested_before_by']);
            unset($reqArr['ticket_tested_after_by']);
            unset($reqArr['ticket_tech_notes']);
            unset($reqArr['_token']);


            $ticket_json=json_encode($reqArr);

            $tic->ticket_json=$ticket_json;
            $tic->product_id=$pid;
            $tic->product_name=$ticketDescription;
            $tic->ticket_status="Pending";
            $tic->payment_status="Pending";
            $tic->store_id=$this->sdc->storeID();
            $tic->created_by=$this->sdc->UserID();
            $tic->save(); 
            $ticketID=$tic->id; 

            $Todaydate=date('Y-m-d');
            \DB::statement("call updateDailyTicket('".$this->sdc->UserID()."','".$this->sdc->storeID()."')");
            return redirect('ticket/view/'.$ticketID)->with('status', 'Ticket Added Successfully !');

            //dd($request);
    }

    public function posInfostore(Request $request)
    {
        //dd($request);
        $ticketArray=$request['ticket'];
        $product_id=$request['product_id'];
        $customer_id=$request['customer_id'];
        $proInfo=Product::find($product_id);
        $cusInfo=Customer::find($customer_id);

        $problem_id=$ticketArray['ticket_problem_id'];
        if($problem_id=="TP0001")
        {

            $checkExProb=TicketProblem::where('store_id',$this->sdc->storeID())
                                        ->where('name',$ticketArray['ticket_problem_name'])
                                        ->count();
            if($checkExProb==0)
            {
                $tab=new TicketProblem();
                $tab->name=$ticketArray['ticket_problem_name'];
                $tab->store_id=$this->sdc->storeID();
                $tab->created_by=$this->sdc->UserID();
                $tab->save();
            }
            else
            {
                $tab=TicketProblem::where('store_id',$this->sdc->storeID())
                                ->where('name',$ticketArray['ticket_problem_name'])
                                ->first();
            }
            

            $problem_id=$tab->id;
        }

        $problem_info=TicketProblem::where('id',$problem_id)->first();
        $problem_name=$problem_info->name;

        //InStoreTicket



        $tic=new InStoreTicket();
        $tic->customer_id=$customer_id;
        $tic->customer_name=$cusInfo->name;
        $tic->ticket_id=$ticketArray['ticket_id'];
        $tic->device_type=$ticketArray['ticket_device_type'];
        $tic->problem_id=$problem_id;
        $tic->problem_name=$problem_name;
        $tic->our_cost=$ticketArray['ticket_our_cost'];
        $tic->retail_price=$ticketArray['ticket_retail_price'];
        $tic->password=$ticketArray['ticket_password'];
        $tic->type_n_color=$ticketArray['ticket_type_n_color'];
        $tic->carrier=$ticketArray['ticket_carrier'];
        $tic->imei=$ticketArray['ticket_imei'];
        $tic->how_did_you_hear_about_us=$ticketArray['ticket_how_did_you_hear_about_us'];
        $tic->isdropoff=$ticketArray['isdropoff'];
        $tic->tested_before_by=$ticketArray['ticket_tested_before_by'];
        $tic->tested_after_by=$ticketArray['ticket_tested_after_by'];
        $tic->tech_notes=$ticketArray['ticket_tech_notes'];

        unset($ticketArray['ticket_id']);
        unset($ticketArray['ticket_device_type']);
        unset($ticketArray['ticket_problem_name']);
        unset($ticketArray['ticket_problem_id']);
        unset($ticketArray['ticket_our_cost']);
        unset($ticketArray['ticket_retail_price']);
        unset($ticketArray['ticket_password']);
        unset($ticketArray['ticket_type_n_color']);
        unset($ticketArray['ticket_carrier']);
        unset($ticketArray['ticket_imei']);
        unset($ticketArray['ticket_how_did_you_hear_about_us']);
        unset($ticketArray['isdropoff']);
        unset($ticketArray['ticket_tested_before_by']);
        unset($ticketArray['ticket_tested_after_by']);
        unset($ticketArray['ticket_tech_notes']);

        $ticket_json=json_encode($ticketArray);

        $tic->ticket_json=$ticket_json;
        $tic->product_id=$product_id;
        $tic->product_name=$proInfo->name;
        $tic->store_id=$this->sdc->storeID();
        $tic->created_by=$this->sdc->UserID();
        $tic->save();
        $ticketSysid=$tic->id;

        \DB::statement("call updateDailyTicket('".$this->sdc->UserID()."','".$this->sdc->storeID()."')");

        return response()->json($ticketSysid);
    }

    public function ticketAjaxUpdate(Request $request,$id=0)
    {
        if($id>0)
        {
            $field=$request->fid;            
            $field_value=$request->fval; 
            
            if(isset($request->fidd))
            {
                $fieldd=$request->fidd; 
                $field_valuee=$request->fvall; 
                $tab=\DB::table('in_store_tickets')
                    ->where('id',$id)
                    ->update([
                        $field=>$field_value,
                        'updated_by'=>$this->sdc->UserID()
                    ]);
            }
            else
            {
                if($field=='address')
                {
                    $buy=\DB::table('in_store_tickets')
                            ->where('id',$id)->first();
                    $cus=\DB::table("customers")
                            ->where('id',$buy->customer_id)
                            ->update(['address'=>$field_value,'store_id'=>$this->sdc->storeID()]);
                }
                elseif($field=='phone')
                {
                    $buy=\DB::table('in_store_tickets')
                            ->where('id',$id)->first();
                    $cus=\DB::table("customers")
                            ->where('id',$buy->customer_id)
                            ->update(['phone'=>$field_value,'store_id'=>$this->sdc->storeID()]);
                }
                elseif($field=='email')
                {
                    $buy=\DB::table('in_store_tickets')
                            ->where('id',$id)->first();
                    $cus=\DB::table("customers")
                            ->where('id',$buy->customer_id)
                            ->update(['email'=>$field_value,'store_id'=>$this->sdc->storeID()]);
                }
                else
                {
                    $tab=\DB::table('in_store_tickets')
                    ->where('id',$id)
                    ->update([
                        $field=>$field_value,
                        'updated_by'=>$this->sdc->UserID()
                    ]);
                }
                
            }
            

            $this->sdc->log("Ticket","Ticket ID - ".$id." Info Has Been Updated.");

            return 1;
        }
        else
        {
            return 0;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InStoreTicket  $inStoreTicket
     * @return \Illuminate\Http\Response
     */
    public function show(InStoreTicket $inStoreTicket,$ticket_id=0)
    {
        $ticketAsset=\DB::table('repair_ticket_assets')->where('asset_type','ticket')->where('store_id',$this->sdc->storeID())->get();

        $data=InStoreTicket::where('id',$ticket_id)->select('*',\DB::Raw('(SELECT name FROM lsp_users WHERE lsp_users.id=lsp_in_store_tickets.created_by) as created_by_name'))->first();
        //dd($data);
        $customer=Customer::find($data->customer_id);
        return view('apps.pages.ticket.view',compact('data','customer','ticketAsset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InStoreTicket  $inStoreTicket
     * @return \Illuminate\Http\Response
     */
    public function edit(InStoreTicket $inStoreTicket)
    {
        //
    }

    public function showTicketPDF($ticket_id=0)
    {
        if(!empty($ticket_id))
        {

            $tab_invoice=InStoreTicket::where('id',$ticket_id)
                                      ->where('store_id',$this->sdc->storeID())
                                      ->first();

            if(!isset($tab_invoice))
            {
                return redirect('ticket/view/'.$ticket_id)->with('error','Invalid Request!!!!'); 
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
                $report_cpmpany_email ="";
                if(isset($storeUInfo->email))
                {
                    $report_cpmpany_email = $storeUInfo->email;
                }
                
                $report_cpmpany_fotter = $invInfo->mm_one;

    //logo and tax id end

    


                $html .= "<tr>
                        <td style='height:40px; background:rgba(0,51,153,1);'>
                            <table style='width:100%; height:40px; border:0px;'>
                                <tr>
                                    <td width='57%' style='background:rgba(0,51,153,1);  color:#FFF; font-size:30px;'>" . $report_cpmpany_name . "</td><td width='13%' style='background:rgba(0,51,153,1);  color:#FFF; font-size:30px;'><span style='float:left; text-align:left;'>".$tab_invoice->payment_status." Invoice</span></td>
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
                        DATE : " . $tab_invoice->created_at . "<br />";
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
                        //
                if(!empty($tab_invoice->invoice_id))
                {
                    $html .= "Sales Tax Rate: ".$invoiceData->tax_rate."%";
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
                        <td style='background:#ccc; height:50px; height:50px;'>Ticket ID</td>
                        <td style='background:#ccc; height:50px;'>Ticket Detail</td>

                        <td style='background:#ccc; height:50px; height:50px;' style='background:#ccc;'>Quantity</td>
                        <td style='background:#ccc; height:50px;'>Unit Cost</td>
                        <td style='background:#ccc; height:50px; height:50px;'>Tax</td>
                        <td style='background:#ccc; height:50px;'>Extended</td>
                        </tr></thead>";

                
                        $html .= "<thead><tr>
                        <td>1</td>
                        <td>" . $tab_invoice->ticket_id . "</td>";

                        $html .= "<td>" . $tab_invoice->product_name. "</td>";
                    


                        $html .= "<td>1</td>
                        <td><button type='button' class='btn'>$" . $tab_invoice->retail_price . "</button></td>
                        <td>$0</td>
                        <td>
                        <button type='button' class='btn'>$" . $tab_invoice->retail_price . "</button>
                        </td>
                        </tr></thead>";



                //echo $html;
                //exit();
                $html .= "</table></td></tr>";

               // echo $html; die();


                    $deposithtml = '<tr><td><b>Deposit Amount</b></td><td><b>$' . number_format($tab_invoice->retail_price, 2) . '</b></td></tr>';
                


               

                        $html .= "<tr><td>
                                <table style='width:100%;'>
                                <tr>
                                    <td valign='top'>
                                    <br>
                                    <table style='width:300px;border:1px; margin-left:-4px; font-size:12px; background:#ccc;'>
                                    <thead>
                                    <tr>
                                    <th>IMEI of Device being repair: </th>
                                    <th>" . $tab_invoice->imei . " </th>
                                    </tr>";


                            $html .= "<tr>
                                    <th>Problem: </th>
                                    <th>" . $tab_invoice->problem_name . " </th>
                                    </tr>
                                    </thead>
                                    </table>
                                    </td>
                                <td style='text-align:right;'>";


                    $html .= "<table align='right' style='width:250px;border:1px; float:right; font-size:12px; background:#ccc;'>
                                <thead>
                                <tr>
                                <th>Payment Status: </th>
                                <th>" . $tab_invoice->payment_status . "</th>
                                </tr>
                                <tr>
                                <th>Sub - Total: </th>
                                <th>$" . number_format($tab_invoice->retail_price, 2) . "</th>
                                </tr>
                                <tr>
                                <th>Tax: </th>
                                <th>$0.00</th>
                                </tr>
                                <tr>
                                <th>Total: </th>
                                <th>$" . number_format($tab_invoice->retail_price, 2) . "</th>
                                </tr>";

                        $html .= "<tr>
                                <th>Payments : </th>
                                <th>$";

                        if(!empty($tab_invoice->invoice_id))
                        {
                            $html .= number_format($tab_invoice->retail_price, 2);
                        }
                        else
                        {
                            $html .= "0.00";
                        }

                        $html .= "</th>
                                </tr>
                                <tr>
                                <th>Balance Due: </th>
                                <th>$";

                        if(!empty($tab_invoice->invoice_id))
                        {
                            $html .= "0.00";
                        }
                        else
                        {
                            $html .= number_format($tab_invoice->retail_price, 2);
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
                                <td align='center' style='font-size:8px;'>" . $report_cpmpany_fotter . "</td>
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

                $stylesheet=file_get_contents(public_path('assets/css/bootstrap.min.css'));
                $stylesheet2=file_get_contents(public_path('assets/css/style.css'));

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InStoreTicket  $inStoreTicket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InStoreTicket $inStoreTicket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InStoreTicket  $inStoreTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(InStoreTicket $inStoreTicket,$id=0)
    {
        //InStoreTicket
        $sessionInvoiceCount=InStoreTicket::where('store_id',$this->sdc->storeID())
                                      ->where('id',$id)
                                      ->count();
        if($sessionInvoiceCount==1){
            $sessionInvoice=InStoreTicket::where('store_id',$this->sdc->storeID())
                                      ->where('id',$id)
                                      ->delete();

            return redirect(url('ticket/list'))->with('success','Ticket info deleted successfully.');
        }else{
            return redirect(url('ticket/list'))->with('error','Ticket info deletion failed.');
        }

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

        $tender_id='';
        if(isset($request->tender_id))
        {
            $tender_id=$request->tender_id;
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

        $invoice=InStoreTicket::where('store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoice_id','=', $invoice_id);
                     })
                     ->when($customer_id, function ($query) use ($customer_id) {
                            return $query->where('customer_id','=', $customer_id);
                     })
                     ->when($tender_id, function ($query) use ($tender_id) {
                            return $query->where('tender_id','=', $tender_id);
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
        $array_column=array('Repair ID','Invoice ID','Customer Name','Device Type','Problem Name','Product Name','Our Cost','Retail Price','Color Type','Carrier','Password','IMEI','Tested Before By','Tested After By','Tech Notes','How Did You Hear About Us','isdropoff');
        array_push($data, $array_column);
        $inv=$this->profitQuery($request);

        foreach($inv as $voi):
            $inv_arry=array($voi->id,$voi->invoice_id,$voi->customer_name,$voi->device_type,$voi->problem_name,$voi->product_name,$voi->our_cost,$voi->retail_price,$voi->type_n_color,$voi->carrier,$voi->password,$voi->imei,$voi->tested_before_by,$voi->tested_after_by,$voi->tech_notes,$voi->how_did_you_hear_about_us,$voi->isdropoff,);
            array_push($data, $inv_arry);
        endforeach;

        $reportName="Repair Report";
        $report_title="Repair Report";
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
        
       
        $reportName="Repair Report";
        $report_title="Repair Report";
        $report_description="Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >Repair ID</th>
                <th class="text-center" style="font-size:12px;" >Invoice ID</th>
                <th class="text-center" style="font-size:12px;" >Customer Name</th>
                <th class="text-center" style="font-size:12px;" >Device Type</th>
                <th class="text-center" style="font-size:12px;" >Problem Name</th>
                <th class="text-center" style="font-size:12px;" >Product Name</th>
                <th class="text-center" style="font-size:12px;" >Our Cost</th>
                <th class="text-center" style="font-size:12px;" >Retail Price</th>
                <th class="text-center" style="font-size:12px;" >Color type</th>
                <th class="text-center" style="font-size:12px;" >Carrier</th>
                <th class="text-center" style="font-size:12px;" >Password</th>
                <th class="text-center" style="font-size:12px;" >IMEI</th>
                <th class="text-center" style="font-size:12px;" >Tested Before By</th>
                <th class="text-center" style="font-size:12px;" >Tested After By</th>
                <th class="text-center" style="font-size:12px;" >Tech Notes</th>
                <th class="text-center" style="font-size:12px;" >How Did You Hear About Us</th>
                <th class="text-center" style="font-size:12px;" >isdropoff</th>
                </tr>
                </thead>
                <tbody>';

                    $inv=$this->profitQuery($request);
                    foreach($inv as $voi):
                        $html .='<tr>
                        <td style="font-size:12px;" class="text-center">'.$voi->id.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->invoice_id.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->customer_name.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->device_type.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->problem_name.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->product_name.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->our_cost.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->retail_price.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->type_n_color.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->carrier.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->password.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->imei.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->tested_before_by.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->tested_after_by.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->tech_notes.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->how_did_you_hear_about_us.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->isdropoff.'</td>
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
