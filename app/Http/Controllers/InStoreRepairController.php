<?php

namespace App\Http\Controllers;

use App\InStoreRepair;
use Illuminate\Http\Request;
use App\InStoreRepairDevice;
use App\InStoreRepairModel;
use App\InStoreRepairProblem;
use App\InStoreRepairPrice;
use App\InStoreRepairProduct;
use App\Category;
use App\Product;
use App\Invoice;
use App\ProductStockin;
use App\RetailPosSummary;
use App\InvoicePayment;
use App\InvoiceProduct;
use App\RetailPosSummaryDateWise;
use App\Store;
use App\Customer;
use App\NonInventoryRepair;
use App\InventoryRepair;
use App\PosSetting;
use App\Pos;
use App\SessionInvoice;
use Auth;
use Mpdf\Mpdf;

class InStoreRepairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="In Store Repair Settings ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    private function datatableInstoreRepairCount($search=''){

        $tab=InStoreRepair::leftjoin('invoices','in_store_repairs.invoice_id','=','invoices.invoice_id')
                          ->select('in_store_repairs.id')
                          ->where('in_store_repairs.store_id',$this->sdc->storeID())
                          ->orderBy('in_store_repairs.id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('in_store_repairs.id','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.product_name','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.payment_status','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.price','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.imei','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.invoice_id','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.created_at','LIKE','%'.$search.'%');

                            return $query;
                          })

                          ->count();
        return $tab;
    }

    private function datatableInstoreRepair($start, $length,$search=''){

        $tab=InStoreRepair::leftjoin('invoices','in_store_repairs.invoice_id','=','invoices.invoice_id')
                          ->select('in_store_repairs.id','in_store_repairs.product_name','in_store_repairs.payment_status','in_store_repairs.customer_name','in_store_repairs.price','in_store_repairs.imei','in_store_repairs.invoice_id','in_store_repairs.created_at','invoices.invoice_status')
                          ->where('in_store_repairs.store_id',$this->sdc->storeID())
                          ->orderBy('in_store_repairs.id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('in_store_repairs.id','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.product_name','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.payment_status','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.price','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.imei','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.invoice_id','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.created_at','LIKE','%'.$search.'%');

                            return $query;
                          })

                     ->skip($start)->take($length)->get();
        return $tab;
    }


    public function datatableInstoreRepairjson(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->datatableInstoreRepairCount($search); // get your total no of data;
        $members = $this->datatableInstoreRepair($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

    }

    private function RepairInfoCount($search=''){

        $tab=InventoryRepair::leftjoin('invoices','inventory_repairs.invoice_id','=','invoices.invoice_id')
                          ->select('inventory_repairs.id')
                          ->where('inventory_repairs.store_id',$this->sdc->storeID())
                          ->orderBy('inventory_repairs.id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('inventory_repairs.id','LIKE','%'.$search.'%');
                            $query->orWhere('inventory_repairs.product_name','LIKE','%'.$search.'%');
                            $query->orWhere('inventory_repairs.payment_status','LIKE','%'.$search.'%');
                            $query->orWhere('inventory_repairs.customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('inventory_repairs.price','LIKE','%'.$search.'%');
                            $query->orWhere('inventory_repairs.imei','LIKE','%'.$search.'%');
                            $query->orWhere('inventory_repairs.invoice_id','LIKE','%'.$search.'%');
                            $query->orWhere('inventory_repairs.created_at','LIKE','%'.$search.'%');

                            return $query;
                          })

                          ->count();
        return $tab;
    }

    private function RepairQueryJson($start, $length,$search=''){

        $tab=InventoryRepair::leftjoin('invoices','inventory_repairs.invoice_id','=','invoices.invoice_id')
                          ->select('inventory_repairs.id',
                          'inventory_repairs.product_name',
                          'inventory_repairs.payment_status',
                          'inventory_repairs.customer_name',
                          'inventory_repairs.total_parts',
                          'inventory_repairs.parts_json',
                          'inventory_repairs.repair_type',
                          'inventory_repairs.price',
                          'inventory_repairs.imei',
                          'inventory_repairs.invoice_id',
                          'inventory_repairs.created_at',
                          'invoices.invoice_status')
                          ->where('inventory_repairs.store_id',$this->sdc->storeID())
                          ->orderBy('inventory_repairs.id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('inventory_repairs.id','LIKE','%'.$search.'%');
                            $query->orWhere('inventory_repairs.product_name','LIKE','%'.$search.'%');
                            $query->orWhere('inventory_repairs.payment_status','LIKE','%'.$search.'%');
                            $query->orWhere('inventory_repairs.customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('inventory_repairs.price','LIKE','%'.$search.'%');
                            $query->orWhere('inventory_repairs.imei','LIKE','%'.$search.'%');
                            $query->orWhere('inventory_repairs.invoice_id','LIKE','%'.$search.'%');
                            $query->orWhere('inventory_repairs.created_at','LIKE','%'.$search.'%');

                            return $query;
                          })
                          ->skip($start)->take($length)->get();
        return $tab;
    }


    public function RepairInfojson(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->RepairInfoCount($search); // get your total no of data;
        $members = $this->RepairQueryJson($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

    }

    public function indexR()
    {
        return view('apps.pages.repair.repair-list');
    }

    public function index()
    {


        //echo $this->sdc->storeID(); die();

        $invoice=InStoreRepair::leftjoin('invoices','in_store_repairs.invoice_id','=','invoices.invoice_id')
                              ->select('in_store_repairs.id','in_store_repairs.product_name','in_store_repairs.payment_status','in_store_repairs.customer_name','in_store_repairs.price','in_store_repairs.imei','in_store_repairs.invoice_id','in_store_repairs.created_at','invoices.invoice_status')
                              ->where('in_store_repairs.store_id',$this->sdc->storeID())
                              ->take(100)
                              ->orderBy('in_store_repairs.id','DESC')
                              ->get();

        //dd($invoice);

        return view('apps.pages.repair.list',compact('invoice'));
    }

    public function non_inventory_repair_pos($request)
    {

        $catInfoCount=Category::where('store_id',$this->sdc->storeID())->where('name','Non-Inventory Repair')->count();
        if($catInfoCount>0)
        {
            $catInfo=Category::where('store_id',$this->sdc->storeID())->where('name','Non-Inventory Repair')->first();
            $catID=$catInfo->id;
            $catName=$catInfo->name;
        }
        else
        {
            $catInfo=new Category();
            $catInfo->store_id=$this->sdc->storeID();
            $catInfo->name="Non-Inventory Repair";
            $catInfo->created_by=$this->sdc->UserID();
            $catInfo->save();
        }

        $product_name=$request->device;
        if(!empty($request->problem_type))
        {
            $product_name.=" - ".$request->problem_type;
        }

        $product_detail=$request->device;
        if(!empty($request->problem_type)){ $product_detail.=", Problem Type :".$request->problem_type; }
        if(!empty($request->password)){ $product_detail.=", Password :".$request->password; }
        if(!empty($request->imei)){ $product_detail.=", IMEI :".$request->imei; }
        if(!empty($request->notes)){ $product_detail.=", Notes :".$request->notes; }

        $tab=new Product;
        $tab->category_id=$catInfo->id;
        $tab->category_name=$catInfo->name;
        $tab->barcode=time();
        $tab->name=$product_name;
        $tab->detail=$product_detail;
        $tab->quantity=1;
        $tab->price=$request->price;
        $tab->cost=$request->cost;
        $tab->general_sale=1;
        $tab->store_id=$this->sdc->storeID();
        $tab->created_by=$this->sdc->UserID();
        $tab->save();
        $pid=$tab->id; 

        $this->sdc->log("Non-Invenotry Reapir","Non-Inventory created from POS.");
        return $pid;

    }

    public function storeR(Request $request)
    {

        if($request->ajax()==TRUE)
        {
            if(empty($request->repair_option))
            {
                $res=['status'=>0,'directcart'=>0,'repair_id'=>0,'msg'=>"Please select a repair options."];
                return response()->json($res); die();
            }

            if($request->repair_option=="repair_parts")
            {
                //dd($request);
                if(empty($request->device)){ $res=['status'=>0,'msg'=>"Please type device name."]; return response()->json($res); die(); }
                if(empty($request->problem_type)){ $res=['status'=>0,'msg'=>"Please type problem type."]; return response()->json($res); die(); }
                if(empty($request->cost)){ $res=['status'=>0,'msg'=>"Please type repair cost."]; return response()->json($res); die(); }
                if(empty($request->price)){ $res=['status'=>0,'msg'=>"Please type repair price."]; return response()->json($res); die(); }
    
                $total_parts=0;
                $parts_json='';
                if(isset($request->repair_parts_id))
                {
                    $total_parts=count($request->repair_parts_id);
                    $pro_array=[];
                    foreach ($request->repair_parts_id as $index=>$row_id) {
                        $product_row=Product::find($row_id);
                        $pro_array[]=['id'=>$row_id,'name'=>$product_row->name,'price'=>$request->repair_parts_price[$index]];
                    }
                    $parts_json=json_encode($pro_array);
                }
    
                $pid=$this->non_inventory_repair_pos($request);
    
                $customer=Customer::find($request->customer_id);
                $product=Product::find($pid);
    
                //InventoryRepair
                $tab=new InventoryRepair();
                $tab->product_id=$pid;
                $tab->product_name=$product->name;
                $tab->customer_id=$request->customer_id;
                $tab->customer_name=$customer->name;
                $tab->total_parts=$total_parts;
                $tab->parts_json=$parts_json;
                $tab->repair_type="Repair Parts";
                $tab->device=$request->device;
                $tab->problem_type=$request->problem_type;
                $tab->cost=$request->cost;
                $tab->price=$request->price;
                $tab->password=$request->password;
                $tab->imei=$request->imei;
                $tab->notes=$request->notes;
                $tab->store_id=$this->sdc->storeID();
                $tab->created_by=$this->sdc->UserID();
                $tab->save();
    

                $res=['status'=>1,'directcart'=>$request->directcart,'repair_id'=>$tab->id,'msg'=>"Reapir Detail Saved Successfully !"]; 
                return response()->json($res); 
                die();
    
            }
            elseif($request->repair_option=="repair")
            {
                if(empty($request->device)){ $res=['status'=>0,'msg'=>"Please type device name."]; return response()->json($res); die(); }
                if(empty($request->problem_type)){ $res=['status'=>0,'msg'=>"Please type problem type."]; return response()->json($res); die(); }
                if(empty($request->cost)){ $res=['status'=>0,'msg'=>"Please type repair cost."]; return response()->json($res); die(); }
                if(empty($request->price)){ $res=['status'=>0,'msg'=>"Please type repair price."]; return response()->json($res); die(); }
    
                $pid=$this->non_inventory_repair_pos($request);
    
                $customer=Customer::find($request->customer_id);
                $product=Product::find($pid);
                
                //InventoryRepair
                $tab=new InventoryRepair();
                $tab->product_id=$pid;
                $tab->product_name=$product->name;
                $tab->customer_id=$request->customer_id;
                $tab->customer_name=$customer->name;
                $tab->total_parts=0;
                $tab->repair_type="Repair";
                $tab->device=$request->device;
                $tab->problem_type=$request->problem_type;
                $tab->cost=$request->cost;
                $tab->price=$request->price;
                $tab->password=$request->password;
                $tab->imei=$request->imei;
                $tab->notes=$request->notes;
                $tab->store_id=$this->sdc->storeID();
                $tab->created_by=$this->sdc->UserID();
                $tab->save();
                
                $res=['status'=>1,'directcart'=>$request->directcart,'repair_id'=>$tab->id,'msg'=>"Reapir Detail Saved Successfully !"]; 
                return response()->json($res); 
                die();
            }
            elseif($request->repair_option=="parts")
            {
                $total_parts=0;
                $parts_json='';
                if(isset($request->repair_parts_id))
                {
                    $total_parts=count($request->repair_parts_id);
                    $pro_array=[];
                    foreach ($request->repair_parts_id as $index=>$row_id) {
                        $product_row=Product::find($row_id);
                        $pro_array[]=['id'=>$row_id,'name'=>$product_row->name,'price'=>$request->repair_parts_price[$index]];
                    }
                    $parts_json=json_encode($pro_array);
                }
    
                //echo $pro_array[0]['name']; die();
    
                if($total_parts == 0)
                {
                    $res=['status'=>0,'directcart'=>0,'repair_id'=>0,'msg'=>"Minimum 1 parts select required !"]; 
                    return response()->json($res); 
                    die();
                }
    
                
    
                $customer=Customer::find($request->customer_id);
                
                //InventoryRepair
                $tab=new InventoryRepair();
                $tab->product_id=0;
                $tab->product_name="";
                $tab->customer_id=$request->customer_id;
                $tab->customer_name=$customer->name;
                $tab->total_parts=$total_parts;
                $tab->parts_json=$parts_json;
                $tab->repair_type="Parts";
                $tab->device="";
                $tab->problem_type="";
                $tab->cost=0;
                $tab->price=0;
                $tab->password=$request->password;
                $tab->imei=$request->imei;
                $tab->notes=$request->notes;
                $tab->store_id=$this->sdc->storeID();
                $tab->created_by=$this->sdc->UserID();
                $tab->save();

                $res=['status'=>1,'directcart'=>$request->directcart,'repair_id'=>$tab->id,'msg'=>"Reapir Detail Saved Successfully !"]; 
                return response()->json($res); 
                die();
            }
            else
            {
                $res=['status'=>0,'directcart'=>0,'repair_id'=>0,'msg'=>"Failed, Please try again."]; 
                return response()->json($res); 
                die();
            }
        }
        else
        {
            $this->validate($request,[
                'customer_id'=>'required',
                'repair_option'=>'required',
            ]);
            if($request->repair_option=="repair_parts")
            {
                $this->validate($request,[
                    'device'=>'required',
                    'problem_type'=>'required',
                    'cost'=>'required',
                    'price'=>'required',
                ]);
    
                $total_parts=0;
                $parts_json='';
                if(isset($request->repair_parts_id))
                {
                    $total_parts=count($request->repair_parts_id);
                    $pro_array=[];
                    foreach ($request->repair_parts_id as $index=>$row_id) {
                        $product_row=Product::find($row_id);
                        $pro_array[]=['id'=>$row_id,'name'=>$product_row->name,'price'=>$request->repair_parts_price[$index]];
                    }
                    $parts_json=json_encode($pro_array);
                }
    
                $pid=$this->non_inventory_repair_pos($request);
    
                $customer=Customer::find($request->customer_id);
                $product=Product::find($pid);
    
                //InventoryRepair
                $tab=new InventoryRepair();
                $tab->product_id=$pid;
                $tab->product_name=$product->name;
                $tab->customer_id=$request->customer_id;
                $tab->customer_name=$customer->name;
                $tab->total_parts=$total_parts;
                $tab->parts_json=$parts_json;
                $tab->repair_type="Repair Parts";
                $tab->device=$request->device;
                $tab->problem_type=$request->problem_type;
                $tab->cost=$request->cost;
                $tab->price=$request->price;
                $tab->password=$request->password;
                $tab->imei=$request->imei;
                $tab->notes=$request->notes;
                $tab->store_id=$this->sdc->storeID();
                $tab->created_by=$this->sdc->UserID();
                $tab->save();
    
                if($request->directcart==1)
                {
                    return redirect('pos-repair/'.$tab->id)->with('status','Reapir Detail Saved & Send to Pos Successfully !');
                }
                else
                {
                    return redirect('repair-list')->with('status','Reapir Detail Saved Successfully !');
                }
    
            }
            elseif($request->repair_option=="repair")
            {
                $this->validate($request,[
                    'device'=>'required',
                    'problem_type'=>'required',
                    'cost'=>'required',
                    'price'=>'required',
                ]);
    
                $pid=$this->non_inventory_repair_pos($request);
    
                $customer=Customer::find($request->customer_id);
                $product=Product::find($pid);
                
                //InventoryRepair
                $tab=new InventoryRepair();
                $tab->product_id=$pid;
                $tab->product_name=$product->name;
                $tab->customer_id=$request->customer_id;
                $tab->customer_name=$customer->name;
                $tab->total_parts=0;
                $tab->repair_type="Repair";
                $tab->device=$request->device;
                $tab->problem_type=$request->problem_type;
                $tab->cost=$request->cost;
                $tab->price=$request->price;
                $tab->password=$request->password;
                $tab->imei=$request->imei;
                $tab->notes=$request->notes;
                $tab->store_id=$this->sdc->storeID();
                $tab->created_by=$this->sdc->UserID();
                $tab->save();
                if($request->directcart==1)
                {
                    return redirect('pos-repair/'.$tab->id)->with('status','Reapir Detail Saved & Send to Pos Successfully !');
                }
                else
                {
                    return redirect('repair-list')->with('status','Reapir Detail Saved Successfully !');
                }
            }
            elseif($request->repair_option=="parts")
            {
                $total_parts=0;
                $parts_json='';
                if(isset($request->repair_parts_id))
                {
                    $total_parts=count($request->repair_parts_id);
                    $pro_array=[];
                    foreach ($request->repair_parts_id as $index=>$row_id) {
                        $product_row=Product::find($row_id);
                        $pro_array[]=['id'=>$row_id,'name'=>$product_row->name,'price'=>$request->repair_parts_price[$index]];
                    }
                    $parts_json=json_encode($pro_array);
                }
    
                //echo $pro_array[0]['name']; die();
    
                if($total_parts == 0)
                {
                    return redirect('repair/create')->with('error','Minimum 1 parts select required !');
                }
    
                
    
                $customer=Customer::find($request->customer_id);
                
                //InventoryRepair
                $tab=new InventoryRepair();
                $tab->product_id=0;
                $tab->product_name="";
                $tab->customer_id=$request->customer_id;
                $tab->customer_name=$customer->name;
                $tab->total_parts=$total_parts;
                $tab->parts_json=$parts_json;
                $tab->repair_type="Parts";
                $tab->device="";
                $tab->problem_type="";
                $tab->cost=0;
                $tab->price=0;
                $tab->password=$request->password;
                $tab->imei=$request->imei;
                $tab->notes=$request->notes;
                $tab->store_id=$this->sdc->storeID();
                $tab->created_by=$this->sdc->UserID();
                $tab->save();
                if($request->directcart==1)
                {
                    return redirect('pos-repair/'.$tab->id)->with('status','Reapir Detail Saved & Send to Pos Successfully !');
                }
                else
                {
                    return redirect('repair-list')->with('status','Reapir Detail Saved Successfully !');
                }
            }
            else
            {
                return redirect('repair/create')->with('error','Invalid repair options !');
            }
        }
        dd($request);
    }

    public function storeRCrT(Request $request)
    {

        if(empty($request->device) && empty($request->problem_type) && empty($request->cost) && empty($request->price))
        {
            $oldCart = $request->session()->has('Pos') ?  $request->session()->get('Pos') : null;

            $cart = new Pos($oldCart);
            if(empty($oldCart->invoiceID))
            {
                $cart->genarateInvoiceID();
            }
            $cart->addCustomerID($request->customer_id);

            $total_parts=0;
            $parts_json='';
            if(isset($request->repair_parts_id))
            {
                $total_parts=count($request->repair_parts_id);
                $pro_array=[];
                foreach ($request->repair_parts_id as $row_id) {
                    $pro=Product::find($row_id);
                    $cart->add($pro, $pro->id);
                }
            }

            

            if($cart->store_id==0)
            {
                $cart->addStoreID($this->sdc->storeID());
            }

            $request->session()->put('Pos', $cart);

            //dd($cart);


            $posData=serialize(json_encode($cart));

            $checkEx=SessionInvoice::where('store_id',$this->sdc->storeID())->where('invoice_id',$cart->invoiceID)->count();

            if($checkEx==0)
            {
                $sessionInvoice=new SessionInvoice();
                $sessionInvoice->invoice_id=$cart->invoiceID;
                $sessionInvoice->session_pos_data=$posData;
                $sessionInvoice->store_id=$this->sdc->storeID();
                $sessionInvoice->created_by=$this->sdc->UserID();
                $sessionInvoice->save();
            }
            else
            {
                $sessionInvoice=SessionInvoice::where('store_id',$this->sdc->storeID())->where('invoice_id',$cart->invoiceID)->first();
                $sessionInvoice->session_pos_data=$posData;
                $sessionInvoice->updated_by=$this->sdc->UserID();
                $sessionInvoice->save();
            }

            return redirect('pos')->with('success','Repair Product Added In Cart Successfully.');
        }
        else
        {
            $this->validate($request,[
                'customer_id'=>'required',
                'device'=>'required',
                'problem_type'=>'required',
                'cost'=>'required',
                'price'=>'required'
            ]);
    
            $total_parts=0;
            $parts_json='';
            if(isset($request->repair_parts_id))
            {
                $total_parts=count($request->repair_parts_id);
                $pro_array=[];
                foreach ($request->repair_parts_id as $row_id) {
                    $product_row=Product::find($row_id);
                    $pro_array[]=['id'=>$row_id,'name'=>$product_row->name,'price'=>$product_row->price];
                }
                $parts_json=json_encode($pro_array);
            }
    
            $pid=$this->non_inventory_repair_pos($request);
    
            $customer=Customer::find($request->customer_id);
            $product=Product::find($pid);
    
            //InventoryRepair
            $tab=new InventoryRepair();
            $tab->product_id=$pid;
            $tab->product_name=$product->name;
            $tab->customer_id=$request->customer_id;
            $tab->customer_name=$customer->name;
            $tab->total_parts=$total_parts;
            $tab->parts_json=$parts_json;
            $tab->device=$request->device;
            $tab->problem_type=$request->problem_type;
            $tab->cost=$request->cost;
            $tab->price=$request->price;
            $tab->password=$request->password;
            $tab->imei=$request->imei;
            $tab->notes=$request->notes;
            $tab->store_id=$this->sdc->storeID();
            $tab->created_by=$this->sdc->UserID();
            $tab->save();
            return redirect('pos-repair/'.$tab->id)->with('status','Reapir Detail Saved & Added To Cart Successfully !');
        }
        
    }

    public function createRepairs()
    {
        return view('apps.pages.repair.repair_create');
    }

    public function createR()
    {

        $pro=Product::where('store_id',$this->sdc->storeID())->where('general_sale',0)->get();

        $catInfo=Category::where('store_id',$this->sdc->storeID())->get(); 

        $device=InStoreRepairDevice::select('id','name')->where('store_id',$this->sdc->storeID())->get();
        $model=InStoreRepairModel::select('id','name','device_id')->where('store_id',$this->sdc->storeID())->get();
        $problem=InStoreRepairProblem::select('id','name','model_id')->where('store_id',$this->sdc->storeID())->get();
        $estPrice=InStoreRepairPrice::select('id','price','device_id','model_id','problem_id','device_name','model_name','problem_name')
                                    ->where('store_id',$this->sdc->storeID())
                                    ->get();

        $tab_customer=Customer::where('store_id',$this->sdc->storeID())->get();
        $problem=InStoreRepairProblem::select('id','name','model_id')->where('store_id',$this->sdc->storeID())->get();
        $ticketAsset=\DB::table('repair_ticket_assets')->where('asset_type','repair')->where('store_id',$this->sdc->storeID())->get();

        \DB::statement("call defaultTicketNRepairCreate('".$this->sdc->UserID()."','".$this->sdc->storeID()."')");

        return view('apps.pages.repair.create',
        [
            'customer'=>$tab_customer,
            'problem'=>$problem,
            'ticketAsset'=>$ticketAsset,
            'catInfo'=>$catInfo,
            'device'=>$device,
            'product'=>$pro,
            'model'=>$model,
            'problem'=>$problem,
            'estPrice'=>$estPrice
        ]);
    }

    public function posInfostore(Request $request)
    {
        $repairArray=$request['repair'];

        $product_id=$request['product_id'];
        $customer_id=$request['customer_id'];
        $proInfo=Product::find($product_id);
        $cusInfo=Customer::find($customer_id);

        $device_id=$repairArray['device_id'];
        $model_id=$repairArray['model_id'];
        $problem_id=$repairArray['problem_id'];

        $device_info=\DB::table('in_store_repair_devices')->where('id',$device_id)->first();
        $device_name=$device_info->name;

        $model_info=\DB::table('in_store_repair_models')->where('id',$model_id)->first();
        $model_name=$model_info->name;

        $problem_info=\DB::table('in_store_repair_problems')->where('id',$problem_id)->first();
        $problem_name=$problem_info->name;

        $price=0;
        if(!empty($repairArray['override_repair_price']))
        {
            $price=$repairArray['override_repair_price'];
        }
        else
        {
            $price=$repairArray['repair_price'];
        }

        $tab=new InStoreRepair();
        $tab->customer_id=$customer_id;
        $tab->customer_name=$cusInfo->name;
        $tab->device_id=$repairArray['device_id'];
        $tab->device_name=$device_name;
        $tab->model_id=$repairArray['model_id'];
        $tab->model_name=$model_name;
        $tab->problem_id=$repairArray['problem_id'];
        $tab->problem_name=$problem_name;
        $tab->price=$price;
        $tab->repair_price=$repairArray['repair_price'];
        $tab->override_repair_price=$repairArray['override_repair_price'];
        $tab->password=$repairArray['repair_password'];
        $tab->imei=$repairArray['repair_imei'];
        $tab->tested_before_by=$repairArray['repair_tested_before_by'];
        $tab->tested_after_by=$repairArray['repair_tested_after_by'];
        $tab->tech_notes=$repairArray['repair_tech_notes'];
        $tab->how_did_you_hear_about_us=$repairArray['repair_how_did_you_hear_about_us'];
        $tab->start_time=$repairArray['repair_start_time'];
        $tab->end_time=$repairArray['repair_end_time'];
        if(isset($repairArray['repair_salvage_part']))
        {
            $tab->salvage_part=$repairArray['repair_salvage_part'];
        }
        

        unset($repairArray['device_id']);
        unset($repairArray['model_id']);
        unset($repairArray['problem_id']);
        unset($repairArray['repair_price']);
        unset($repairArray['override_repair_price']);
        unset($repairArray['repair_password']);
        unset($repairArray['repair_imei']);
        unset($repairArray['repair_tested_before_by']);
        unset($repairArray['repair_tested_after_by']);
        unset($repairArray['repair_tech_notes']);
        unset($repairArray['repair_how_did_you_hear_about_us']);
        unset($repairArray['repair_start_time']);
        unset($repairArray['repair_end_time']);
        if(isset($repairArray['repair_salvage_part']))
        {
            unset($repairArray['repair_salvage_part']);
        }
        $repair_json=json_encode($repairArray);

        $our_cost=$proInfo->cost;
        
        $tab->repair_json=$repair_json;
        $tab->product_id=$product_id;
        $tab->product_name=$proInfo->name;
        $tab->our_cost=$our_cost;
        $tab->store_id=$this->sdc->storeID();
        $tab->created_by=$this->sdc->UserID();
        $tab->save();
        $repairSysID=$tab->id;

        \DB::statement("call updateDailyRepair('".$this->sdc->UserID()."','".$this->sdc->storeID()."')");

        return response()->json($repairSysID);
    }

    private function noninventoryRepairReportPrCount($search=''){

        $tab=InventoryRepair::select('id')
                          ->where('store_id',$this->sdc->storeID())
                          ->orderBy('id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('tender_name','LIKE','%'.$search.'%');
                            $query->orWhere('device','LIKE','%'.$search.'%');
                            $query->orWhere('problem_type','LIKE','%'.$search.'%');
                            $query->orWhere('price','LIKE','%'.$search.'%');
                            $query->orWhere('cost','LIKE','%'.$search.'%');
                            $query->orWhere('imei','LIKE','%'.$search.'%');
                            $query->orWhere('password','LIKE','%'.$search.'%');
                            $query->orWhere('invoice_id','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');

                            return $query;
                          })

                          ->count();
        return $tab;
    }

    private function noninventoryRepairReportPr($start, $length,$search=''){

        $tab=InventoryRepair::select(
                        'id',
                        'customer_name',
                        'tender_name',
                        'device',
                        'problem_type',
                        'cost',
                        'price',
                        'password',
                        'imei',
                        'notes',
                        'invoice_id',
                        'created_at'
                        )
                    ->where('store_id',$this->sdc->storeID())
                    ->orderBy('id','DESC')
                    ->when($search, function ($query) use ($search) {
                    $query->where('id','LIKE','%'.$search.'%');
                    $query->orWhere('customer_name','LIKE','%'.$search.'%');
                    $query->orWhere('tender_name','LIKE','%'.$search.'%');
                    $query->orWhere('device','LIKE','%'.$search.'%');
                    $query->orWhere('problem_type','LIKE','%'.$search.'%');
                    $query->orWhere('price','LIKE','%'.$search.'%');
                    $query->orWhere('cost','LIKE','%'.$search.'%');
                    $query->orWhere('imei','LIKE','%'.$search.'%');
                    $query->orWhere('password','LIKE','%'.$search.'%');
                    $query->orWhere('invoice_id','LIKE','%'.$search.'%');
                    $query->orWhere('created_at','LIKE','%'.$search.'%');

                    return $query;
                    })


                     ->skip($start)->take($length)->get();
        return $tab;
    }


    public function noninventoryRepairReportPrjson(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->noninventoryRepairReportPrCount($search); // get your total no of data;
        $members = $this->noninventoryRepairReportPr($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

    }

    public function noninventoryrepairreport(Request $request)
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
            /*$invoice=InStoreRepair::select('id','product_name','payment_status','customer_name','price','imei','invoice_id','created_at')
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
            $invoice=InventoryRepair::select(
                                    'id',
                                    'customer_name',
                                    'tender_name',
                                    'device',
                                    'problem_type',
                                    'cost',
                                    'price',
                                    'password',
                                    'imei',
                                    'notes',
                                    'invoice_id',
                                    'created_at'
                                    )
                                ->where('store_id',$this->sdc->storeID())
                                ->orderBy('id','DESC')
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

        return view('apps.pages.report.noninventoryrepair',
            [
                'customer'=>$tab_customer,
                'invoice'=>$invoice,
                'invoice_id'=>$invoice_id,
                'customer_id'=>$customer_id,
                'start_date'=>$start_date,
                'end_date'=>$end_date
            ]);
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
            /*$invoice=InStoreRepair::select('id','product_name','payment_status','customer_name','price','imei','invoice_id','created_at')
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
            $invoice=InStoreRepair::select('id','product_name','payment_status','customer_name','price','imei','invoice_id','created_at')
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
                     ->orderBy('inventory_repairs.id','DESC')
                     ->get();
        }


        
                     //->toSql();

        //dd($tender_id);              

        $tab_customer=Customer::where('store_id',$this->sdc->storeID())->get();

        return view('apps.pages.report.repair',
            [
                'customer'=>$tab_customer,
                'invoice'=>$invoice,
                'invoice_id'=>$invoice_id,
                'customer_id'=>$customer_id,
                'start_date'=>$start_date,
                'end_date'=>$end_date
            ]);
    }





    
    public function rep_report(Request $request)
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

        $repair_option='';
        if(isset($request->repair_option))
        {
            $repair_option=$request->repair_option;
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
            $dateString="CAST(lsp_inventory_repairs.created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }

        if(empty($invoice_id) && empty($customer_id) && empty($start_date) && empty($end_date) && empty($repair_option) && empty($dateString))
        {
            $invoice=array();
        }
        else
        {
            
            $invoice=InventoryRepair::leftjoin('invoices','inventory_repairs.invoice_id','=','invoices.invoice_id')
                     ->select('inventory_repairs.id',
                     'inventory_repairs.product_name',
                     'inventory_repairs.payment_status',
                     'inventory_repairs.customer_id',
                     'inventory_repairs.customer_name',
                     'inventory_repairs.total_parts',
                     'inventory_repairs.parts_json',
                     'inventory_repairs.repair_type',
                     'inventory_repairs.cost',
                     'inventory_repairs.price',
                     'inventory_repairs.device',
                     'inventory_repairs.problem_type',
                     'inventory_repairs.imei',
                     'inventory_repairs.password',
                     'inventory_repairs.notes',
                     'inventory_repairs.invoice_id',
                     'inventory_repairs.created_at',
                     'invoices.invoice_status')
                     ->where('inventory_repairs.store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('inventory_repairs.invoice_id','=', $invoice_id);
                     })
                     ->when($customer_id, function ($query) use ($customer_id) {
                            return $query->where('inventory_repairs.customer_id','=', $customer_id);
                     })
                     ->when($repair_option, function ($query) use ($repair_option) {
                            return $query->where('inventory_repairs.repair_type','=', $repair_option);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->get();

        }          

        $tab_customer=Customer::where('store_id',$this->sdc->storeID())->get();
        $tab_parts=Product::select('id','name','cost')->where('store_id',$this->sdc->storeID())->where('category_name','Parts')->get();
        //dd($tab_parts);
        return view('apps.pages.report.repair-report',
            [
                'customer'=>$tab_customer,
                'repair_option'=>$repair_option,
                'invoice'=>$invoice,
                'invoice_id'=>$invoice_id,
                'customer_id'=>$customer_id,
                'start_date'=>$start_date,
                'end_date'=>$end_date,
                'tab_parts'=>$tab_parts,
            ]);
    }

    private function rep_RepairReportCount($search=''){
        $paramString="";
        if(!empty($search))
        {
            $paramString="(customer_name like '%".$search."%'";
            $paramString.=" OR repair_type like '%".$search."%'";
            $paramString.=" OR device like '%".$search."%'";
            $paramString.=" OR problem_type like '%".$search."%'";
            $paramString.=" OR imei like '%".$search."%'";
            $paramString.=" OR invoice_id like '%".$search."%'";
            $paramString.=" OR product_name like '%".$search."%')";
        }
        
        $tab=InventoryRepair::leftjoin('invoices','inventory_repairs.invoice_id','=','invoices.invoice_id')
                                ->select('inventory_repairs.id',
                                'inventory_repairs.product_name',
                                'inventory_repairs.payment_status',
                                'inventory_repairs.customer_id',
                                'inventory_repairs.customer_name',
                                'inventory_repairs.total_parts',
                                'inventory_repairs.parts_json',
                                'inventory_repairs.repair_type',
                                'inventory_repairs.cost',
                                'inventory_repairs.price',
                                'inventory_repairs.device',
                                'inventory_repairs.problem_type',
                                'inventory_repairs.imei',
                                'inventory_repairs.password',
                                'inventory_repairs.notes',
                                'inventory_repairs.invoice_id',
                                'inventory_repairs.created_at',
                                'invoices.invoice_status')
                                ->where('inventory_repairs.store_id',$this->sdc->storeID())
                                ->when($paramString, function ($query) use ($paramString) {
                                        return $query->whereRaw($paramString);
                                })
                                ->count();
        return $tab;
    }

    private function rep_RepairReport($start, $length,$search=''){

        $paramString="";
        if(!empty($search))
        {
            $paramString="(customer_name like '%".$search."%'";
            $paramString.=" OR repair_type like '%".$search."%'";
            $paramString.=" OR device like '%".$search."%'";
            $paramString.=" OR problem_type like '%".$search."%'";
            $paramString.=" OR imei like '%".$search."%'";
            $paramString.=" OR invoice_id like '%".$search."%'";
            $paramString.=" OR product_name like '%".$search."%')";
        }
        
        $tab=InventoryRepair::leftjoin('invoices','inventory_repairs.invoice_id','=','invoices.invoice_id')
                            ->select('inventory_repairs.id',
                            'inventory_repairs.product_name',
                            'inventory_repairs.payment_status',
                            'inventory_repairs.customer_id',
                            'inventory_repairs.customer_name',
                            'inventory_repairs.total_parts',
                            'inventory_repairs.parts_json',
                            'inventory_repairs.repair_type',
                            'inventory_repairs.cost',
                            'inventory_repairs.price',
                            'inventory_repairs.device',
                            'inventory_repairs.problem_type',
                            'inventory_repairs.imei',
                            'inventory_repairs.password',
                            'inventory_repairs.notes',
                            'inventory_repairs.invoice_id',
                            'inventory_repairs.created_at',
                            'invoices.invoice_status')
                            ->where('inventory_repairs.store_id',$this->sdc->storeID())
                            ->orderBy('inventory_repairs.id','DESC')
                            ->when($paramString, function ($query) use ($paramString) {
                                    return $query->whereRaw($paramString);
                            })
                            ->skip($start)->take($length)->get();
        return $tab;
    }

    public function rep_RepairReportjson(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->rep_RepairReportCount($search); // get your total no of data;
        $members = $this->rep_RepairReport($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

    }

    public function rep_profitQuery($request)
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

        $repair_option='';
        if(isset($request->repair_option))
        {
            $repair_option=$request->repair_option;
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
            $dateString="CAST(lsp_inventory_repairs.created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }

        

        $invoice=InventoryRepair::leftjoin('invoices','inventory_repairs.invoice_id','=','invoices.invoice_id')
                    ->select('inventory_repairs.id',
                    'inventory_repairs.product_name',
                    'inventory_repairs.payment_status',
                    'inventory_repairs.customer_id',
                    'inventory_repairs.customer_name',
                    'inventory_repairs.total_parts',
                    'inventory_repairs.parts_json',
                    'inventory_repairs.repair_type',
                    'inventory_repairs.cost',
                    'inventory_repairs.price',
                    'inventory_repairs.device',
                    'inventory_repairs.problem_type',
                    'inventory_repairs.imei',
                    'inventory_repairs.password',
                    'inventory_repairs.notes',
                    'inventory_repairs.invoice_id',
                    'inventory_repairs.created_at',
                    'invoices.invoice_status')
                    ->where('inventory_repairs.store_id',$this->sdc->storeID())
                    ->when($invoice_id, function ($query) use ($invoice_id) {
                        return $query->where('inventory_repairs.invoice_id','=', $invoice_id);
                    })
                    ->when($customer_id, function ($query) use ($customer_id) {
                        return $query->where('inventory_repairs.customer_id','=', $customer_id);
                    })
                    ->when($repair_option, function ($query) use ($repair_option) {
                        return $query->where('inventory_repairs.repair_type','=', $repair_option);
                    })
                    ->when($dateString, function ($query) use ($dateString) {
                        return $query->whereRaw($dateString);
                    })
                    ->get();
        
        //dd($invoice);
        return $invoice;
    }

    public function rep_exportExcel(Request $request) 
    {
        //excel 
        
        $data=array();
        $array_column=array(
            'Id',
            'Date',
            'Customer',
            'Repair Detail',
            'Parts Required',
            'Price',
            'Cost',
            'Profit',
            'Status',
            'Invoice ID'
        );
        array_push($data, $array_column);
        $inv=$this->rep_profitQuery($request);

        $tab_parts=Product::select('id','name','cost')->where('store_id',$this->sdc->storeID())->where('category_name','Parts')->get();
        $total_price_amount=0;
        $total_cost_amount=0;
        $total_profit_amount=0;
        foreach($inv as $voi):
            $parts_text=""; 
            $total_repair_price=$voi->price;
            $total_repair_cost=$voi->cost;
            if($voi->total_parts > 0)
            {
                $parts_json=json_decode($voi->parts_json);
                foreach($parts_json as $item)
                {
                    if(!empty($parts_text))
                    {
                        $parts_text.=", "; 
                    }
                        
                    if(!empty($item->name))
                    {
                        $parts_text.=$item->name;
                    }
                    
                    if(!empty($item->price))
                    {
                        $total_repair_price+=$item->price;
                    }   

                    foreach ($tab_parts as $df)
                    {
                        if ($df->id==$item->id)
                        {
                            $total_repair_cost+=$df->cost;													
                        }													
                    }                    
                }
                
            }
            else
            { 
                $parts_text="Special Ordered Part/No Parts Required";
            }

            $total_repair_profit=$total_repair_price-$total_repair_cost;		

            $inv_arry=array(
                $voi->id,
                formatDate($voi->created_at),
                $voi->customer_name,
                $voi->repair_type=="Parts"?"Inventory Repair":$voi->product_name,
                $parts_text,
                $total_repair_price,
                $total_repair_cost,
                $total_repair_profit,
                $voi->payment_status,
                $voi->invoice_id
            );

            $total_price_amount+=$total_repair_price;
            $total_cost_amount+=$total_repair_cost;
            $total_profit_amount+=$total_repair_profit;
            array_push($data, $inv_arry);
        endforeach;


        $array_column=array('','','','','Total = ',$total_price_amount,$total_cost_amount,$total_profit_amount);
        array_push($data, $array_column);

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

    public function rep_exportPDF(Request $request)
    {

        $data=array();
        
       
        $reportName="Repair Report";
        $report_title="Repair Report";
        $report_description="Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                    <th class="text-center" style="font-size:12px;" >Id</th>
                    <th class="text-center" style="font-size:12px;" >Date</th>
                    <th class="text-center" style="font-size:12px;" >Customer</th>
                    <th class="text-center" style="font-size:12px;" >Repair Detail</th>
                    <th class="text-center" style="font-size:12px;" >Parts Required</th>
                    <th class="text-center" style="font-size:12px;" >Price</th>
                    <th class="text-center" style="font-size:12px;" >Cost</th>
                    <th class="text-center" style="font-size:12px;" >Profit</th>
                    <th class="text-center" style="font-size:12px;" >Status</th>
                    <th class="text-center" style="font-size:12px;" >Invoice ID</th>
                </tr>
                </thead>
                <tbody>';

                
                $tab_parts=Product::select('id','name','cost')->where('store_id',$this->sdc->storeID())->where('category_name','Parts')->get();
                $total_price_amount=0;
                $total_cost_amount=0;
                $total_profit_amount=0;

                    $inv=$this->rep_profitQuery($request);
                    foreach($inv as $voi):


                        $parts_text=""; 
                        $total_repair_price=$voi->price;
                        $total_repair_cost=$voi->cost;
                        if($voi->total_parts > 0)
                        {
                            $parts_json=json_decode($voi->parts_json);
                            foreach($parts_json as $item)
                            {
                                if(!empty($parts_text))
                                {
                                    $parts_text.=", "; 
                                }
                                    
                                if(!empty($item->name))
                                {
                                    $parts_text.=$item->name;
                                }
                                
                                if(!empty($item->price))
                                {
                                    $total_repair_price+=$item->price;
                                }  
                                
                                foreach ($tab_parts as $df)
                                {
                                    if ($df->id==$item->id)
                                    {
                                        $total_repair_cost+=$df->cost;													
                                    }													
                                }     
                            }
                            
                        }
                        else
                        { 
                            $parts_text="Special Ordered Part/No Parts Required";
                        }

                        $total_repair_profit=$total_repair_price-$total_repair_cost;

                        

                        $ptr=$voi->repair_type=="Parts"?"Inventory Repair":$voi->product_name;

                        $html .='<tr>
                        <td style="font-size:12px;" class="text-center">'.$voi->id.'</td>
                        <td style="font-size:12px;" class="text-center">'.formatDate($voi->created_at).'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->customer_name.'</td>
                        <td style="font-size:12px;" class="text-center">'.$ptr.'</td>
                        <td style="font-size:12px;" class="text-center">'.$parts_text.'</td>
                        <td style="font-size:12px;" class="text-right">'.$total_repair_price.'</td>
                        <td style="font-size:12px;" class="text-right">'.$total_repair_cost.'</td>
                        <td style="font-size:12px;" class="text-right">'.$total_repair_profit.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->payment_status.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->invoice_id.'</td>
                        </tr>';

                        $total_price_amount+=number_format($total_repair_price,2);
                        $total_cost_amount+=number_format($total_repair_cost,2);
                        $total_profit_amount+=number_format($total_repair_profit,2);

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
                $html .='<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="font-size:12px;" align="right">Total =</td>
                    <td style="font-size:12px;" align="right">'.$total_price_amount.'</td>
                    <td style="font-size:12px;" align="right">'.$total_cost_amount.'</td>
                    <td style="font-size:12px;" align="right">'.$total_profit_amount.'</td>
                </tr>';
                $html .='</tfoot>';
                $html .='</table>';



                $this->sdc->PDFLayout($reportName,$html);


    }







    public function noninventoryprofitQuery($request)
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

        $invoice=InventoryRepair::select(
                                    'id',
                                    'customer_name',
                                    'tender_name',
                                    'device',
                                    'problem_type',
                                    'cost',
                                    'price',
                                    'password',
                                    'imei',
                                    'notes',
                                    'invoice_id',
                                    'created_at'
                                    )
                                ->where('store_id',$this->sdc->storeID())
                                ->orderBy('id','DESC')
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
        //dd($invoice);
        return $invoice;
    }

    public function noninventoryexportExcel(Request $request) 
    {
        //excel 
        $total_price_amount=0;
        $total_re_price_amount=0;
        $total_over_price_amount=0;
        $data=array();
        $array_column=array('Repair ID','Invoice ID','Customer Name','Device Name','Problem Type','Cost','Price','Password','IMEI','Tech Notes','Created AT');
        array_push($data, $array_column);
        $inv=$this->noninventoryprofitQuery($request);

        foreach($inv as $voi):
            $inv_arry=array($voi->id,$voi->invoice_id,$voi->customer_name,$voi->device,$voi->problem_type,$voi->cost,$voi->price,$voi->password,$voi->imei,$voi->notes,$voi->created_at);

            $total_price_amount+=$voi->price;
            $total_re_price_amount+=$voi->cost;
            array_push($data, $inv_arry);
        endforeach;


        $array_column=array('','','','','Total =',$total_re_price_amount,$total_price_amount,'','','','','','','','','','');
        array_push($data, $array_column);

        $reportName="Non-Inventory Repair Report";
        $report_title="Non-Inventory Repair Report";
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

    public function noninventoryexportPDF(Request $request)
    {

        $data=array();
        
       
        $reportName="Non-Inventory Repair Report";
        $report_title="Non-Inventory Repair Report";
        $report_description="Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >Repair ID</th>
                <th class="text-center" style="font-size:12px;" >Invoice ID</th>
                <th class="text-center" style="font-size:12px;" >Customer Name</th>
                <th class="text-center" style="font-size:12px;" >Device</th>
                <th class="text-center" style="font-size:12px;" >Problem</th>
                <th class="text-center" style="font-size:12px;" >Cost</th>
                <th class="text-center" style="font-size:12px;" >Price</th>
                <th class="text-center" style="font-size:12px;" >Password</th>
                <th class="text-center" style="font-size:12px;" >IMEI</th>
                <th class="text-center" style="font-size:12px;" >Tech Notes</th>
                <th class="text-center" style="font-size:12px;" >Created AT</th>
                </tr>
                </thead>
                <tbody>';

                $total_price_amount=0;
                $total_re_price_amount=0;
                $total_over_price_amount=0;

                    $inv=$this->noninventoryprofitQuery($request);
                    foreach($inv as $voi):
                        $html .='<tr>
                        <td style="font-size:12px;" class="text-center">'.$voi->id.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->invoice_id.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->customer_name.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->device.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->problem_type.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->cost.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->price.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->password.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->imei.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->notes.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->created_at.'</td>
                        </tr>';

                        $total_price_amount+=$voi->price;
                        $total_re_price_amount+=$voi->cost;
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
                <td></td>
                <td></td>
                <td>Total =</td>
                <td align="center">'.$total_re_price_amount.'</td>
                <td align="center">'.$total_re_price_amount.'</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>';
                $html .='</table>';



                $this->sdc->PDFLayout($reportName,$html);


    }


    private function InstoreRepairReportPrCount($search=''){

        $tab=InStoreRepair::leftjoin('invoices','in_store_repairs.invoice_id','=','invoices.invoice_id')
                          ->select('in_store_repairs.id')
                          ->where('in_store_repairs.store_id',$this->sdc->storeID())
                          ->orderBy('in_store_repairs.id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('in_store_repairs.id','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.product_name','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.payment_status','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.price','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.imei','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.invoice_id','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.created_at','LIKE','%'.$search.'%');

                            return $query;
                          })

                          ->count();
        return $tab;
    }

    private function InstoreRepairReportPr($start, $length,$search=''){

        $tab=InStoreRepair::leftjoin('invoices','in_store_repairs.invoice_id','=','invoices.invoice_id')
                          ->select('in_store_repairs.id','in_store_repairs.product_name','in_store_repairs.payment_status','in_store_repairs.customer_name','in_store_repairs.price','in_store_repairs.imei','in_store_repairs.invoice_id','in_store_repairs.created_at','invoices.invoice_status')
                          ->where('in_store_repairs.store_id',$this->sdc->storeID())
                          ->orderBy('in_store_repairs.id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('in_store_repairs.id','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.product_name','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.payment_status','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.price','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.imei','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.invoice_id','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.created_at','LIKE','%'.$search.'%');

                            return $query;
                          })

                     ->skip($start)->take($length)->get();
        return $tab;
    }


    public function InstoreRepairReportPrjson(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->InstoreRepairReportPrCount($search); // get your total no of data;
        $members = $this->InstoreRepairReportPr($start, $length,$search); //supply start and length of the table data

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
        $device=InStoreRepairDevice::select('id','name')->where('store_id',$this->sdc->storeID())->get();
        $model=InStoreRepairModel::select('id','name','device_id')->where('store_id',$this->sdc->storeID())->get();
        $problem=InStoreRepairProblem::select('id','name','model_id')->where('store_id',$this->sdc->storeID())->get();
        $estPrice=InStoreRepairPrice::select('id','price','device_id','model_id','problem_id','device_name','model_name','problem_name')->where('store_id',$this->sdc->storeID())->get();

        return view('apps.pages.instorerepair.settings.create',compact('device','model','problem','estPrice'));
    }

    public function deviceModel(Request $request)
    {
        $model=InStoreRepairModel::where('device_id',$request->device_id)->where('store_id',$this->sdc->storeID())->get();
        return response()->json($model);
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
            'device_id'=>'required',
            'model_id'=>'required',
            'problem_id'=>'required',
            'price'=>'required',
            'name'=>'required',
            'quantity'=>'required',
            'our_cost'=>'required',
        ]);

        \DB::beginTransaction();
        $creation_type="Store";
        if(Auth::user()->user_type==1)
        {
            $creation_type="Master";
        }
        
        $device_id=0;
        $device_name="";
        if($request->device_id=="D000")
        {
            $tabCount=InStoreRepairDevice::where('name',trim($request->device_name))->where('store_id',$this->sdc->storeID())->count();
            if($tabCount==0)
            {
                $tab=new InStoreRepairDevice;
                $tab->name=$request->device_name;
                $tab->used_type=$creation_type;
                $tab->store_id=$this->sdc->storeID();
                $tab->created_by=$this->sdc->UserID();
                $tab->save();
            }
            else
            {
                $tab=InStoreRepairDevice::where('name',trim($request->device_name))->where('store_id',$this->sdc->storeID())->first();
            }
            
            $device_id=$tab->id;
            $device_name=$tab->name;
        }
        else
        {
            $tab=InStoreRepairDevice::find($request->device_id);
            $device_id=$tab->id;
            $device_name=$tab->name;
        }

        $model_id=0;
        $model_name="";
        if($request->model_id=="M000")
        {
            $tabModelCount=InStoreRepairModel::where('device_id',$device_id)->where('store_id',$this->sdc->storeID())->where('name',trim($request->model_name))->count();
            if($tabModelCount==0)
            {
                $tabModel=new InStoreRepairModel;
                $tabModel->device_id=$device_id;
                $tabModel->device_name=$device_name;
                $tabModel->name=$request->model_name;
                $tabModel->used_type=$creation_type;
                $tabModel->store_id=$this->sdc->storeID();
                $tabModel->created_by=$this->sdc->UserID();
                $tabModel->save();
            }
            else
            {
                $tabModel=InStoreRepairModel::where('device_id',$device_id)->where('store_id',$this->sdc->storeID())->where('name',trim($request->model_name))->first();
            }
            
            $model_id=$tabModel->id;
            $model_name=$tabModel->name;
        }
        else
        {
            $tabModel=InStoreRepairModel::find($request->model_id);
            $model_id=$tabModel->id;
            $model_name=$tabModel->name;
        }


        $problem_id=0;
        $problem_name="";
        //dd($request->problem_id);
        
        if($request->problem_id=="P000")
        {
            $tabProblemCount=InStoreRepairProblem::where('name',trim($request->problem_name))->where('store_id',$this->sdc->storeID())->count();
            if($tabProblemCount==0)
            {
                $tabProblem=new InStoreRepairProblem;
                $tabProblem->name=$request->problem_name;
                $tabProblem->used_type=$creation_type;
                $tabProblem->store_id=$this->sdc->storeID();
                $tabProblem->created_by=$this->sdc->UserID();
                $tabProblem->save();
            }
            else
            {
                $tabProblem=InStoreRepairProblem::where('name',trim($request->problem_name))->where('store_id',$this->sdc->storeID())->first();
            }
            
            $problem_id=$tabProblem->id;
            $problem_name=$tabProblem->name;
            
        }
        else
        {
            $tabProblem=InStoreRepairProblem::find($request->problem_id);
            $problem_id=$tabProblem->id;
            $problem_name=$tabProblem->name;
        }

        $tabPriceCount=InStoreRepairPrice::where('device_id',$device_id)
                                        ->where('model_id',$model_id)
                                        ->where('problem_id',$problem_id)
                                        ->where('store_id',$this->sdc->storeID())
                                        ->count();

        if($tabPriceCount==0)
        {
            $tabPrice=new InStoreRepairPrice;
            $tabPrice->device_id=$device_id;
            $tabPrice->device_name=$device_name;            
            $tabPrice->model_id=$model_id;
            $tabPrice->model_name=$model_name;            
            $tabPrice->problem_id=$problem_id;
            $tabPrice->problem_name=$problem_name;
            $tabPrice->price=$request->price;
            $tabPrice->used_type=$creation_type;
            $tabPrice->store_id=$this->sdc->storeID();
            $tabPrice->created_by=$this->sdc->UserID();
            $tabPrice->save();
        }

        $tabProductCount=InStoreRepairProduct::where('device_id',$device_id)
                                        ->where('model_id',$model_id)
                                        ->where('problem_id',$problem_id)
                                        ->where('store_id',$this->sdc->storeID())
                                        ->count();

        $checkRepairCategory=Category::where('name','Inventory Repair')->where('store_id',$this->sdc->storeID())->count();

        if($tabProductCount==0 && $checkRepairCategory==1)
        {
            

            $RepairCategory=Category::select('id','name')->where('name','Inventory Repair')->where('store_id',$this->sdc->storeID())->first();

            $repair_cid=$RepairCategory->id;
            $cat_name=$RepairCategory->name;
            //************adding product info Start**************************//
            $tabCount=Product::where('name',$request->name)
                             ->where('category_id',$request->category_id)
                             ->where('store_id',$this->sdc->storeID())
                             ->count();
            if($tabCount>0)
            {
                \DB::rollBack();
                return redirect('settings/instorerepair')->with('error', $this->moduleName.' Failed to create, Same Product already exists on product database.');
            }

            $tab=new Product;
            $tab->category_id=$repair_cid;
            $tab->category_name=$cat_name;
            $tab->name=$request->name;
            $tab->barcode=$request->barcode;
            $tab->quantity=$request->quantity;
            $tab->price=$request->retail_price;
            $tab->cost=$request->our_cost;
            $tab->used_type=$creation_type;
            $tab->store_id=$this->sdc->storeID();
            $tab->created_by=$this->sdc->UserID();
            $tab->save();
            $pid=$tab->id;

            $tabProduct=new InStoreRepairProduct;
            $tabProduct->product_id=$pid;
            $tabProduct->device_id=$device_id;
            $tabProduct->device_name=$device_name;            
            $tabProduct->model_id=$model_id;
            $tabProduct->model_name=$model_name;            
            $tabProduct->problem_id=$problem_id;
            $tabProduct->problem_name=$problem_name;
            $tabProduct->barcode=$request->barcode;
            $tabProduct->name=$request->name;
            $tabProduct->price=$request->retail_price;
            $tabProduct->cost=$request->our_cost;
            $tabProduct->quantity=$request->quantity;
            $tabProduct->description=$request->description;
            $tabProduct->used_type=$creation_type;
            $tabProduct->store_id=$this->sdc->storeID();
            $tabProduct->created_by=$this->sdc->UserID();
            $tabProduct->save();

            $tab_stock=new ProductStockin;
            $tab_stock->product_id=$pid;
            $tab_stock->quantity=$request->quantity;
            $tab_stock->price=$request->retail_price;
            $tab_stock->cost=$request->our_cost;
            $tab_stock->used_type=$creation_type;
            $tab_stock->store_id=$this->sdc->storeID();
            $tab_stock->created_by=$this->sdc->UserID();
            $tab_stock->save();
            $this->sdc->log("product","Product created from repair system.");
            RetailPosSummary::where('id',1)
            ->update([
               'product_item_quantity' => \DB::raw('product_item_quantity + 1'),
               'product_quantity' => \DB::raw('product_quantity + '.$request->quantity),
               'stockin_product_quantity' => \DB::raw('stockin_product_quantity + '.$request->quantity),
            ]);

            $Todaydate=date('Y-m-d');
            if(RetailPosSummaryDateWise::where('report_date',$Todaydate)->count()==0)
            {
                RetailPosSummaryDateWise::insert([
                   'report_date'=>$Todaydate,
                   'product_item_quantity' => \DB::raw('1'),
                   'product_quantity' => \DB::raw($request->quantity),
                   'stockin_product_quantity' => \DB::raw($request->quantity)
                ]);
            }
            else
            {
                RetailPosSummaryDateWise::where('report_date',$Todaydate)
                ->update([
                   'product_item_quantity' => \DB::raw('product_item_quantity + 1'),
                   'product_quantity' => \DB::raw('product_quantity + '.$request->quantity),
                   'stockin_product_quantity' => \DB::raw('stockin_product_quantity + '.$request->quantity)
                ]);
            }
            //************adding product info End**************************//


        }

        

        //dd($tabProduct);
        if($checkRepairCategory==0)
        {
            \DB::rollBack();
            return redirect('settings/instorerepair')->with('error', $this->moduleName.' Failed to create, Please Create a category ( Repair ) on Category Settings.');
        }
        elseif($tabPriceCount==1)
        {
            \DB::rollBack();
            return redirect('settings/instorerepair')->with('error', $this->moduleName.' Failed to create, Similar Repair Price already available in system.');
        }
        elseif($tabProductCount==1)
        {
            \DB::rollBack();
            return redirect('settings/instorerepair')->with('error', $this->moduleName.' Failed to create, Similar Repair Product already available in system.');
        }
        elseif(!empty($device_id) && !empty($device_name) && !empty($model_id) && !empty($model_name) && !empty($problem_id) && !empty($problem_name) && $tabProductCount==0 && $tabPriceCount==0 && $checkRepairCategory==1)
        {
            \DB::commit();
            return redirect('settings/instorerepair')->with('status', $this->moduleName.' for '.$request->name.' Created Successfully. !');
        }
        else
        {
            \DB::rollBack();
            return redirect('settings/instorerepair')->with('error', $this->moduleName.' Failed to create, Please try again. !');
        }

    }

    public function deviceList()
    {
        $device=\DB::table('in_store_repair_devices')->where('store_id',$this->sdc->storeID())->get();
        
        return view('apps.pages.instorerepair.repair.instoredevicelist',compact('device'));
    }

    public function modelList()
    {
        $modelData=\DB::table('in_store_repair_models')
                      ->where('store_id',$this->sdc->storeID())
                      ->get();
        
        return view('apps.pages.instorerepair.repair.instoremodellist',compact('modelData'));
    }

    public function problemList()
    {
        $problemData=\DB::table('in_store_repair_problems')
                      ->where('store_id',$this->sdc->storeID())
                      ->get();
        
        return view('apps.pages.instorerepair.repair.instoreproblemlist',compact('problemData'));
    }

    public function priceList()
    {
        $priceData=\DB::table('in_store_repair_prices')
                        ->where('store_id',$this->sdc->storeID())
                        ->get();
        
        return view('apps.pages.instorerepair.repair.instorepricelist',compact('priceData'));
    }

    public function productList()
    {
        $productData=\DB::table('in_store_repair_products')
                      ->where('store_id',$this->sdc->storeID())
                      ->get();
        
        return view('apps.pages.instorerepair.repair.instoreproductlist',compact('productData'));
    }


    public function mergeDataTostore()
    {
        $search_type="Master";
        $store=Store::all();
        $device=InStoreRepairDevice::where('used_type',$search_type)->where('store_id',$this->sdc->storeID())->count();
        $model=InStoreRepairModel::where('used_type',$search_type)->where('store_id',$this->sdc->storeID())->count();
        $problem=InStoreRepairProblem::where('used_type',$search_type)->where('store_id',$this->sdc->storeID())->count();
        $price=InStoreRepairPrice::where('used_type',$search_type)->where('store_id',$this->sdc->storeID())->count();
        $product=InStoreRepairProduct::where('used_type',$search_type)->where('store_id',$this->sdc->storeID())->count();
        //dd($store);
        return view('apps.pages.instorerepair.settings.merge',compact('store','device','model','problem','price','product'));
    }

    public function clearstoreData(Request $request)
    {
        $this->validate($request,[
            'store_id'=>'required'
        ]);


        $search_type="Clone";
        \DB::beginTransaction();
        try{

            \DB::table('in_store_repair_devices')->where('used_type',$search_type)->where('store_id',$request->store_id)->delete();
            \DB::table('in_store_repair_models')->where('used_type',$search_type)->where('store_id',$request->store_id)->delete();
            \DB::table('in_store_repair_problems')->where('used_type',$search_type)->where('store_id',$request->store_id)->delete();
            \DB::table('in_store_repair_prices')->where('used_type',$search_type)->where('store_id',$request->store_id)->delete();
            \DB::table('in_store_repair_products')->where('used_type',$search_type)->where('store_id',$request->store_id)->delete();
            \DB::commit();

            return redirect('settings/instore/merge/repair/data')->with('status', 'Instore Repair Data Cleared Successfully. !');

        } catch (\Exception $e) {
            \DB::rollback();
            return redirect('settings/instore/merge/repair/data')->with('error', 'Instore Repair Data failed to clear. !');
        }
        
        
        
    }

    public function mergestoreData(Request $request)
    {
        $this->validate($request,[
            'store_id'=>'required'
        ]);

        //dd($request->store_id);

        $store=Store::where('store_id',$request->store_id)->first();

        if(Auth::user()->user_type==1)
        {
            \DB::beginTransaction();
            $creation_type="Clone";
            $search_type="Master";
            $deviceCount=0;
            if(isset($request->device))
            {
                $deviceCount=InStoreRepairDevice::where('used_type',$search_type)
                                                ->where('store_id',$this->sdc->storeID())
                                                ->count();
                if($deviceCount>0)
                {
                    $deviceSQL=InStoreRepairDevice::where('used_type',$search_type)
                                                  ->where('store_id',$this->sdc->storeID())
                                                  ->get();
                    foreach($deviceSQL as $row)
                    {
                        $tab=new InStoreRepairDevice;
                        $tab->name=$row->name;
                        $tab->used_type=$creation_type;
                        $tab->store_id=$request->store_id;
                        $tab->created_by=$this->sdc->UserID();
                        $tab->save();
                    }
                }
            }

            $ModelCount=0;
            if(isset($request->device))
            {
                $ModelCount=InStoreRepairModel::where('used_type',$search_type)
                                              ->where('store_id',$this->sdc->storeID())
                                              ->count();

                if($ModelCount>0)
                {
                    $ModelSQL=InStoreRepairModel::where('used_type',$search_type)
                                                ->where('store_id',$this->sdc->storeID())
                                                ->get();
                    //dd($ModelSQL);

                    foreach($ModelSQL as $row)
                    {
                        
                        $deviceSQL=InStoreRepairDevice::where('used_type',$creation_type)
                                                      ->where('name',$row->device_name)
                                                      ->where('store_id',$request->store_id)
                                                      ->first();

                        $tabModel=new InStoreRepairModel;
                        $tabModel->device_id=$deviceSQL->id;
                        $tabModel->device_name=$deviceSQL->name;
                        $tabModel->name=$row->name;
                        $tabModel->used_type=$creation_type;
                        $tabModel->store_id=$request->store_id;
                        $tabModel->created_by=$this->sdc->UserID();
                        $tabModel->save();

                    }
                }
            }


            $problemCount=0;
            if(isset($request->problem))
            {
                $problemCount=InStoreRepairProblem::where('used_type',$search_type)
                                                  ->where('store_id',$this->sdc->storeID())
                                                  ->count();
                                              
                if($problemCount>0)
                {
                    $problemSQL=InStoreRepairProblem::where('used_type',$search_type)
                                                    ->where('store_id',$this->sdc->storeID())
                                                    ->get();

                    foreach($problemSQL as $row)
                    {
                        $tabProblem=new InStoreRepairProblem;
                        $tabProblem->name=$row->name;
                        $tabProblem->used_type=$creation_type;
                        $tabProblem->store_id=$request->store_id;
                        $tabProblem->created_by=$this->sdc->UserID();
                        $tabProblem->save();
                    }
                }
            }

            $priceCount=0;
            if(isset($request->price))
            {
                $priceCount=InStoreRepairPrice::where('used_type',$search_type)
                                                  ->where('store_id',$this->sdc->storeID())
                                                  ->count();
                                              
                if($priceCount>0)
                {
                    $priceSQL=InStoreRepairPrice::where('used_type',$search_type)
                                                    ->where('store_id',$this->sdc->storeID())
                                                    ->get();

                    foreach($priceSQL as $row)
                    {



                        $deviceSQL=InStoreRepairDevice::where('used_type',$creation_type)
                                                      ->where('name',$row->device_name)
                                                      ->where('store_id',$request->store_id)
                                                      ->first();

                        

                        $ModelSQL=InStoreRepairModel::where('used_type',$creation_type)
                                                    ->where('device_id',$deviceSQL->id)
                                                    ->where('name',$row->model_name)
                                                    ->where('store_id',$request->store_id)
                                                    ->first();

                        $ProblemSQL=InStoreRepairProblem::where('used_type',$creation_type)
                                                        ->where('name',$row->problem_name)
                                                        ->where('store_id',$request->store_id)
                                                        ->first();

                        $tabPrice=new InStoreRepairPrice;
                        $tabPrice->device_id=$deviceSQL->id;
                        $tabPrice->device_name=$deviceSQL->name;            
                        $tabPrice->model_id=$ModelSQL->id;
                        $tabPrice->model_name=$ModelSQL->name;            
                        $tabPrice->problem_id=$ProblemSQL->id;
                        $tabPrice->problem_name=$ProblemSQL->name;
                        $tabPrice->price=$row->price;
                        $tabPrice->used_type=$creation_type;
                        $tabPrice->store_id=$request->store_id;
                        $tabPrice->created_by=$this->sdc->UserID();
                        $tabPrice->save();
                    }
                }
            }

            $categoryCount=0;
            if(isset($request->category))
            {

                $categoryCount=Category::where('store_id',$this->sdc->storeID())
                                             ->where('name',"Repair")
                                             ->count();
                if($categoryCount>0)
                {
                    $cat=new Category;
                    $cat->name="Repair";
                    $cat->store_id=$request->store_id;
                    $cat->created_by=$this->sdc->UserID();
                    $cat->save();
                }
            }


            $productCount=0;
            if(isset($request->product))
            {
                $productCount=InStoreRepairProduct::where('used_type',$search_type)
                                                  ->where('store_id',$this->sdc->storeID())
                                                  ->count();
                                              
                if($productCount>0)
                {
                    $productSQL=InStoreRepairProduct::where('used_type',$search_type)
                                                    ->where('store_id',$this->sdc->storeID())
                                                    ->get();

                    $categorySQL=Category::where('store_id',$request->store_id)
                                         ->where('name',"Repair")
                                         ->first();

                    $repair_cid=$categorySQL->id;
                    $cat_name=$categorySQL->name;
                    $x=0;
                    foreach($productSQL as $row)
                    {

                        


                        $tab=new Product;
                        $tab->category_id=$repair_cid;
                        $tab->category_name=$cat_name;
                        $tab->name=$row->name;
                        $tab->barcode=$row->barcode;
                        $tab->quantity=$row->quantity;
                        $tab->price=$row->price;
                        $tab->cost=$row->cost;
                        $tab->used_type=$creation_type;
                        $tab->store_id=$request->store_id;
                        $tab->created_by=$this->sdc->UserID();
                        $tab->save();
                        $pid=$tab->id;
                        //dd($productPriceSQL);
                        $productPriceSQLCount=\DB::table('in_store_repair_prices')
                                            ->where('used_type',$creation_type)
                                           ->where('device_name',$row->device_name)
                                           ->where('model_name',$row->model_name)
                                           ->where('problem_name',$row->problem_name)
                                           ->where('store_id',$request->store_id)
                                           ->count();
                        $productPriceSQL=\DB::table('in_store_repair_prices')
                                            ->where('used_type',$creation_type)
                                           ->where('device_name',$row->device_name)
                                           ->where('model_name',$row->model_name)
                                           ->where('problem_name',$row->problem_name)
                                           ->where('store_id',$request->store_id)
                                           ->first();
                                           //dd($productPriceSQL);
                        
                        /*if($productPriceSQLCount==0)
                        {
                            echo $x; 
                            echo "<br><hr>"; 
                            dd($row);

                        }

                        $x++;*/
                        //$sqlInsertInStoreRepairProduct="insert into `lsp_in_store_repair_products` (`product_id`, `device_id`, `device_name`, `model_id`, `model_name`, `problem_id`, `problem_name`, `barcode`, `name`, `price`, `cost`, `quantity`, `descsription`, `used_type`, `store_id`, `created_by`, `updated_by`, `updated_at`, `created_at`) values ('$pid','$productPriceSQL->device_id', '$productPriceSQL->device_name','$productPriceSQL->model_id','$productPriceSQL->model_name', $productPriceSQL->problem_id, '$productPriceSQL->problem_name', '$row->barcode','$row->name', '$row->price','$row->cost','$row->quantity', '$row->description','$creation_type','$request->store_id','".$this->sdc->UserID()."', '".$this->sdc->UserID()."','".date('Y-m-d H:i:s')."','".date('Y-m-d H:i:s')."')";

                        //echo $sqlInsertInStoreRepairProduct; die();
                        if($productPriceSQLCount==0)
                        {
                            $tabProduct=new InStoreRepairProduct;
                            $tabProduct->product_id=$pid;
                            $tabProduct->device_id=$row->device_id;
                            $tabProduct->device_name=$row->device_name;            
                            $tabProduct->model_id=$row->model_id;
                            $tabProduct->model_name=$row->model_name;            
                            $tabProduct->problem_id=$row->problem_id;
                            $tabProduct->problem_name=$row->problem_name;
                            $tabProduct->barcode=$row->barcode;
                            $tabProduct->name=$row->name;
                            $tabProduct->price=$row->price;
                            $tabProduct->cost=$row->cost;
                            $tabProduct->quantity=$row->quantity;
                            $tabProduct->description=$row->description;
                            $tabProduct->used_type=$creation_type;
                            $tabProduct->store_id=$request->store_id;
                            $tabProduct->created_by=$this->sdc->UserID();
                            $tabProduct->updated_by=$this->sdc->UserID();
                            $tabProduct->save();
                        }
                        else
                        {
                            $tabProduct=new InStoreRepairProduct;
                            $tabProduct->product_id=$pid;
                            $tabProduct->device_id=$productPriceSQL->device_id;
                            $tabProduct->device_name=$productPriceSQL->device_name;            
                            $tabProduct->model_id=$productPriceSQL->model_id;
                            $tabProduct->model_name=$productPriceSQL->model_name;            
                            $tabProduct->problem_id=$productPriceSQL->problem_id;
                            $tabProduct->problem_name=$productPriceSQL->problem_name;
                            $tabProduct->barcode=$row->barcode;
                            $tabProduct->name=$row->name;
                            $tabProduct->price=$row->price;
                            $tabProduct->cost=$row->cost;
                            $tabProduct->quantity=$row->quantity;
                            $tabProduct->description=$row->description;
                            $tabProduct->used_type=$creation_type;
                            $tabProduct->store_id=$request->store_id;
                            $tabProduct->created_by=$this->sdc->UserID();
                            $tabProduct->updated_by=$this->sdc->UserID();
                            $tabProduct->save();
                        }
                        

                        //dd($productPriceSQL);
                        $tab_stock=new ProductStockin;
                        $tab_stock->product_id=$pid;
                        $tab_stock->quantity=$row->quantity;
                        $tab_stock->price=$row->price;
                        $tab_stock->cost=$row->cost;
                        $tab_stock->used_type=$creation_type;
                        $tab_stock->store_id=$request->store_id;
                        $tab_stock->created_by=$this->sdc->UserID();
                        $tab_stock->save();
                        $this->sdc->log("product","Product Clone created from repair system.");
                        RetailPosSummary::where('id',1)
                        ->update([
                           'product_item_quantity' => \DB::raw('product_item_quantity + 1'),
                           'product_quantity' => \DB::raw('product_quantity + '.$row->quantity),
                           'stockin_product_quantity' => \DB::raw('stockin_product_quantity + '.$row->quantity),
                        ]);
                        //dd($productPriceSQL);
                        $Todaydate=date('Y-m-d');
                        if(RetailPosSummaryDateWise::where('report_date',$Todaydate)->count()==0)
                        {
                            RetailPosSummaryDateWise::insert([
                               'report_date'=>$Todaydate,
                               'product_item_quantity' => \DB::raw('1'),
                               'product_quantity' => \DB::raw($row->quantity),
                               'stockin_product_quantity' => \DB::raw($row->quantity)
                            ]);
                        }
                        else
                        {
                            RetailPosSummaryDateWise::where('report_date',$Todaydate)
                            ->update([
                               'product_item_quantity' => \DB::raw('product_item_quantity + 1'),
                               'product_quantity' => \DB::raw('product_quantity + '.$row->quantity),
                               'stockin_product_quantity' => \DB::raw('stockin_product_quantity + '.$row->quantity)
                            ]);
                        }

                        //dd($productPriceSQL);
                    }
                }
            }



            if(!empty($deviceCount) && !empty($ModelCount) && !empty($problemCount) && !empty($priceCount) && !empty($categoryCount) && !empty($productCount))
            {
                $smsCount="Device (".$deviceCount."), Model (".$ModelCount."), Problem (".$problemCount."), Price (".$priceCount."), Category (".$categoryCount."), Product (".$productCount.")";
                \DB::commit();
                return redirect('settings/instore/merge/repair/data')->with('status', 'Instore Repair Data Send To '.$store->name.' Created Successfully. '.$smsCount.' !');
            }
            else
            {
                \DB::rollBack();
                return redirect('settings/instore/merge/repair/data')->with('error', ' Failed to send, Please try again. !');
            }


        }
        

    }

    public function repairAjaxUpdate(Request $request,$id=0)
    {
        if($id>0)
        {
            $field=$request->fid;            
            $field_value=$request->fval; 
            
            if(isset($request->fidd))
            {
                $fieldd=$request->fidd; 
                $field_valuee=$request->fvall; 
                $tab=\DB::table('in_store_repairs')
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
                    $buy=\DB::table('in_store_repairs')
                            ->where('id',$id)->first();
                    $cus=\DB::table("customers")
                            ->where('id',$buy->customer_id)
                            ->update(['address'=>$field_value,'store_id'=>$this->sdc->storeID()]);
                }
                elseif($field=='phone')
                {
                    $buy=\DB::table('in_store_repairs')
                            ->where('id',$id)->first();
                    $cus=\DB::table("customers")
                            ->where('id',$buy->customer_id)
                            ->update(['phone'=>$field_value,'store_id'=>$this->sdc->storeID()]);
                }
                elseif($field=='email')
                {
                    $buy=\DB::table('in_store_repairs')
                            ->where('id',$id)->first();
                    $cus=\DB::table("customers")
                            ->where('id',$buy->customer_id)
                            ->update(['email'=>$field_value,'store_id'=>$this->sdc->storeID()]);
                }
                else
                {
                    $tab=\DB::table('in_store_repairs')
                    ->where('id',$id)
                    ->update([
                        $field=>$field_value,
                        'updated_by'=>$this->sdc->UserID()
                    ]);
                }
                
            }
            

            $this->sdc->log("Reapir","Reapir ID - ".$id." Info Has Been Updated.");

            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function showRepairPDF($repair_id=0)
    {
        if(!empty($repair_id))
        {

            $tab_invoice=InStoreRepair::leftjoin('invoices','in_store_repairs.invoice_id','=','invoices.invoice_id')
                                      ->select('in_store_repairs.*','invoices.invoice_status')
                                      ->where('in_store_repairs.id',$repair_id)
                                      ->where('in_store_repairs.store_id',$this->sdc->storeID())
                                      ->first();

            $invoice_status=$tab_invoice->invoice_status;

            if(!isset($tab_invoice))
            {
                return redirect('repair/view/'.$repair_id)->with('error','Invalid Request!!!!'); 
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
                    $store_logo="<img src='".public_path('company/'.$invInfo->logo)."' width='130'>";
                }

                $report_cpmpany_name = $invInfo->company_name;
                $report_cpmpany_address = $invInfo->mm_four;
                $report_cpmpany_phone = $invInfo->c_one;
                $report_cpmpany_email="";
                if(isset($storeUInfo->email))
                {
                    $report_cpmpany_email = $storeUInfo->email;
                }
                
                $report_cpmpany_fotter = $invInfo->mm_one;

    

    


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
                        DATE : " . formatDateTime($tab_invoice->created_at) . "<br />";
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
                        <td style='background:#ccc; height:50px; height:50px;'>Repair ID</td>
                        <td style='background:#ccc; height:50px;'>Product</td>

                        <td style='background:#ccc; height:50px; height:50px;' style='background:#ccc;'>Quantity</td>
                        <td style='background:#ccc; height:50px;'>Unit Cost</td>
                        <td style='background:#ccc; height:50px; height:50px;'>Tax</td>
                        <td style='background:#ccc; height:50px;'>Extended</td>
                        </tr></thead>";

                
                        $html .= "<thead><tr>
                        <td>1</td>
                        <td>" . $tab_invoice->id . "</td>";

                        $html .= "<td>" . $tab_invoice->device_name . ", " . $tab_invoice->model_name . " - " . $tab_invoice->problem_name . "</td>";
                    


                        $html .= "<td>1</td>
                        <td><button type='button' class='btn'>$" . $tab_invoice->price . "</button></td>
                        <td>$0</td>
                        <td>
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
                                <th>$" . number_format($tab_invoice->price, 2) . "</th>
                                </tr>
                                <tr>
                                <th>Tax: </th>
                                <th>$0.00</th>
                                </tr>
                                <tr>
                                <th>Total: </th>
                                <th>$" . number_format($tab_invoice->price, 2) . "</th>
                                </tr>";

                        $html .= "<tr>
                                <th>Payments : </th>
                                <th>$";

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
                                <th>Balance Due: </th>
                                <th>$";

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
                                <td align='center' style='font-size:8px;'>" . $report_cpmpany_fotter . "</td>
                                </tr>
                                <tr>
                                <td align='center'>Thank You For Your Business</td>
                                </tr>";

                             $pmt_status=$tab_invoice->payment_status;


                if (strtolower($pmt_status) == "paid") {
                    $color = "#09f;";
                    $html .= "<tr><td align='center' style='color:" . $color . "'><h1 style='width:60%; font-size:100px; display:block; margin-left:auto; margin-right:auto; border:3px " . $color . " solid;'>Paid</h1></td></tr>";
                } elseif ($pmt_status == "Partial" && $invoice_status!="Paid") {
                    $color = "#FF8C00;";
                    $html .= "<tr><td align='center' style='color:" . $color . "'><h1 style='width:60%; font-size:100px; display:block; margin-left:auto; margin-right:auto; border:3px " . $color . " solid;'>" . $pmt_status . "</h1></td></tr>";
                } elseif ($pmt_status == "Partial" && $invoice_status=="Paid") {
                    $color = "#09f;";
                    $html .= "<tr><td align='center' style='color:" . $color . "'><h1 style='width:60%; font-size:100px; display:block; margin-left:auto; margin-right:auto; border:3px " . $color . " solid;'>Paid</h1></td></tr>";
                } else {
                    $color = "#f00";
                    $html .= "<tr><td align='center' style='color:" . $color . "'><h1 style='width:60%; font-size:100px; display:block; margin-left:auto; margin-right:auto; border:3px " . $color . " solid;'>" . $pmt_status . "</h1></td></tr>";
                } 



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
     * Display the specified resource.
     *
     * @param  \App\InStoreRepair  $inStoreRepair5r\\\\\\\\\\\\\
     */
    public function show(InStoreRepair $inStoreRepair,$repair_id=0)
    {
        $ticketAsset=\DB::table('repair_ticket_assets')->where('asset_type','repair')->where('store_id',$this->sdc->storeID())->get();
        $data=InStoreRepair::leftjoin('invoices','in_store_repairs.invoice_id','=','invoices.invoice_id')
                            ->select('in_store_repairs.*','invoices.invoice_status')
                            ->where('in_store_repairs.id',$repair_id)
                            ->first();

        $customer=Customer::find($data->customer_id);
        return view('apps.pages.repair.view',compact('data','customer','ticketAsset'));
        //dd($data);
    }

    public function showR(InStoreRepair $inStoreRepair,$repair_id=0)
    {
        $data=InventoryRepair::leftjoin('invoices','inventory_repairs.invoice_id','=','invoices.invoice_id')
                                ->select('inventory_repairs.id',
                                'inventory_repairs.product_name',
                                'inventory_repairs.payment_status',
                                'inventory_repairs.customer_id',
                                'inventory_repairs.customer_name',
                                'inventory_repairs.total_parts',
                                'inventory_repairs.parts_json',
                                'inventory_repairs.repair_type',
                                'inventory_repairs.cost',
                                'inventory_repairs.price',
                                'inventory_repairs.device',
                                'inventory_repairs.problem_type',
                                'inventory_repairs.imei',
                                'inventory_repairs.password',
                                'inventory_repairs.notes',
                                'inventory_repairs.invoice_id',
                                'inventory_repairs.created_at',
                                'invoices.invoice_status')
                                ->where('inventory_repairs.store_id',$this->sdc->storeID())
                                ->where('inventory_repairs.id',$repair_id)
                                ->orderBy('inventory_repairs.id','DESC')
                                ->first();

        $customer=Customer::find($data->customer_id);
        //dd($customer);
        return view('apps.pages.repair.repair-view',compact('data','customer'));
        //dd($data);
    }

    public function showRepairPDFR($repair_id=0)
    {
        if(!empty($repair_id))
        {

            $tab_invoice=InventoryRepair::leftjoin('invoices','inventory_repairs.invoice_id','=','invoices.invoice_id')
                                        ->leftjoin('customers','inventory_repairs.customer_id','=','customers.id')
                                        ->select(
                                        'inventory_repairs.*',
                                        'invoices.invoice_status',
                                        'customers.name as customer_name',
                                        'customers.address as customer_address',
                                        'customers.phone as customer_phone',
                                        'customers.email as customer_email'
                                        )
                                        ->where('inventory_repairs.id',$repair_id)
                                        ->where('inventory_repairs.store_id',$this->sdc->storeID())
                                        ->first();

            $invoice_status=$tab_invoice->invoice_status;

            if(!isset($tab_invoice))
            {
                return redirect('repair-view/'.$repair_id)->with('error','Invalid Request!!!!'); 
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
            $ps=PosSetting::where('store_id',$this->sdc->storeID())->first();
            $tax_rate=0;
            if(isset($ps->sales_tax))
            {
                $tax_rate=floatval($ps->sales_tax);
            }

            //dd($tax_rate);
            //dd($ps);

                $html="";

                $html .= "<table id='sample-table-2' class='table table-hover'><tbody>";

                

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
                    $store_logo="<img src='".public_path('company/'.$invInfo->logo)."' width='180'>";
                }

                $report_cpmpany_name = $invInfo->company_name;
                $report_cpmpany_address = $invInfo->mm_four;
                $report_cpmpany_phone = $invInfo->c_one;
                $report_cpmpany_email="";
                if(isset($storeUInfo->email))
                {
                    $report_cpmpany_email = $storeUInfo->email;
                }
                
                $report_cpmpany_fotter = $invInfo->mm_one;

    

                $payment_status = !empty($tab_invoice->payment_status)?$tab_invoice->payment_status:'Pending';


                $html .= "
                    <tr>
                        <td style='text-align:center;' align='center'>
                                <div style='text-align:center; font-weight:bolder; font-size:25px;'>" . $store_logo . "</div>
                                <div style='text-align:center; font-weight:bolder; font-size:25px;'><b>" . $report_cpmpany_name . "</b></div>
                        </td>
                    </tr>
                    <tr>
                        <td style='height:40px; width:100px; text-align:center; padding-top:10px;' align='center'>
                                <table style='border:0px; width:100%;'>
                                <tr>
                                    <td width='25%' align='left'>
                                        <div style='text-align:center; font-weight:bolder; font-size:22px; display:block; text-align:center;'><b> Sold To </b></div>
                                        <div style='text-align:center; font-weight:bolder; font-size:18px;'>Name : " . $customer->name . "</div>
                                        <div style='text-align:center; font-weight:bolder; font-size:18px;'>Phone : " . $customer->phone . "</div>
                                    </td>
                                    <td width='50%'>
                                        <div style='text-align:center; font-weight:bolder; font-size:15px;'>Tax ID : " . $tax_id . "</div>
                                        <div style='text-align:center; font-weight:bolder; font-size:15px;'>" . $report_cpmpany_phone . "</div>
                                        <div style='text-align:center; font-weight:bolder; font-size:15px;'>" . $report_cpmpany_email . "</div>
                                        <div style='text-align:center; font-weight:bolder; font-size:12px;'>" . $report_cpmpany_address . "</div>
                                    </td>
                                    <td width='25%' align='right'>
                                    <div style='text-align:center; font-weight:bolder; font-size:22px; display:block; text-align:center;'><b> Order Info </b></div>
                                    
                                    Repair Payment Status : " . $payment_status . "<br />
                                    DATE : " . formatDateTime($tab_invoice->created_at) . "<br />";
                            
                                    $html .= "Repair No. : R" . $tab_invoice->id . "<br />";
                            
                                    
                                    if(!empty($tab_invoice->invoice_id))
                                    {
                                        $html .= "SALES REP : ".$tab_invoice->invoice_id." <br />";
                                    }
                                    else
                                    {
                                        $html .= "SALES REP : Pending <br />";
                                    }

                                $html .= "
                                    </td>
                                    
                                </tr>
                            </table>
                            
                        </td>
                      </tr>

                      <tr>
                        <td style='height:0px; width:100px; text-align:center;' align='center'>
                                <table style='border:0px; width:100%;'>
                                <tr>
                                    <td width='25%'>
                                       ";

                                        $html .= "Sales Tax Rate: ".$tax_rate."%";
                                    
                                    $html .="</td>
                                    
                                    
                                </tr>
                            </table>
                            
                        </td>
                      </tr>
                      
                      


                        <tr>
                        <td style='height:0px;' valign='top'>
                        <table style='width:960px; height:0px; border:0px;'>
                        <tr>
                        <td width='69%'>
                         
                        </td>
                        <td width='31%'>
                        
                        ";
                

               $html .= "</td>
                        </tr>
                        </table>
                        </td>
                        </tr>

                        <tr>
                        <td style='height:0px;' valign='top'>
                        
                        </td>
                        </tr>

                        <tr>
                        <td valign='top' style='margin:0; padding:0; width:100%; padding-top:30px;'>
                        <table class='table table-bordered' style='width:100%;  border:2px;  background:#ccc;'>";
              $html .= "
                    <thead>
                    <tr class='table-active'>
                        <td style='background:#ccc; height:25px; padding:10px;'>S/L</td>
                        <td style='background:#ccc; height:25px;padding:10px;'>Item Type</td>
                        <td style='background:#ccc; height:25px;padding:10px;'>Product</td>
                        <td style='background:#ccc; height:25px;padding:10px;'>Quantity</td>
                        <td style='background:#ccc; height:25px;padding:10px;'>Unit Cost</td>
                        <td style='background:#ccc; height:25px;padding:10px;'>Tax ".$tax_rate."%</td>
                        <td style='background:#ccc; height:25px;padding:10px;'>Extended</td>
                    </tr>
                    </thead>";


                        $tax_repair=number_format(floatval(($tab_invoice->price * $tax_rate) / 100),2);
                        $extendedPrice=number_format(floatval($tab_invoice->price+$tax_repair),2);
                
                        $total_tax=$tax_repair;
                        $total_repairnParts=$tab_invoice->price;
                    //@if ($data->repair_type!="Parts")
                        $html .= "
                    <thead>";
                    $sl_invoice=1;
                if ($tab_invoice->repair_type!="Parts")
                {
                    $html .= " <tr>
                        <td style=' padding:10px;'>".$sl_invoice."</td>
                        <td style=' padding:10px;'>Non-Inventory Repair</td>";
                        $html .= "<td style=' padding:10px;'>
                                                            " . $tab_invoice->product_name . "

                        </td>";
                        $html .= "<td style=' padding:10px;'>1</td>
                        <td style=' padding:10px;'><button type='button' class='btn'>$" . $tab_invoice->price . "</button></td>
                        <td style=' padding:10px;'>$".floatval($tax_repair)."</td>
                        <td style=' padding:10px;'>
                        <button type='button' class='btn'>$" . $extendedPrice . "</button>
                        </td>
                    </tr>";
                    $sl_invoice++;
                }
                

                    if($tab_invoice->total_parts > 0)
                    {
                        $itlSL=$sl_invoice;
                        foreach (json_decode($tab_invoice->parts_json) as $key => $row) {
                            //dd($row);
                            $tax_repair=number_format(floatval(($row->price * $tax_rate) / 100),2);
                            $total_tax+=$tax_repair;
                            $extendedPrice=number_format(floatval($row->price+$tax_repair),2);
                            $total_repairnParts+=$row->price;
                            $html .= "
                            <tr>
                                <td style=' padding:10px;'>".$itlSL."</td>
                                <td style=' padding:10px;'>Parts</td>";
                                $html .= "<td style=' padding:10px;'>" . $row->name . "</td>";
                                $html .= "<td style=' padding:10px;'>1</td>
                                <td style=' padding:10px;'><button type='button' class='btn'>$" . $row->price . "</button></td>
                                <td style=' padding:10px;'>$".$tax_repair."</td>
                                <td style=' padding:10px;'>
                                <button type='button' class='btn'>$" . $extendedPrice . "</button>
                                </td>
                            </tr>";
                            $itlSL++;
                        }
                        
                    }

                    $html .= "
                    </thead>";



                //echo $html;
                //exit();
                $html .= "</table></td></tr>";

                $color_font="#000";
                           $color_message="Pending";
                           if (strtolower($payment_status) == "paid") {
                                $color_font = "#09f;";
                                //$html .= "<tr><td align='center' style='color:" . $color . "'><h1 style='width:60%; font-size:100px; display:block; margin-left:auto; margin-right:auto; border:3px " . $color . " solid;'>Paid</h1></td></tr>";
                                $color_message="Paid";
                            } elseif ($payment_status == "Partial" && $invoice_status!="Paid") {
                                $color_font = "#FF8C00;";
                                //$html .= "<tr><td align='center' style='color:" . $color . "'><h1 style='width:60%; font-size:100px; display:block; margin-left:auto; margin-right:auto; border:3px " . $color . " solid;'>" . $pmt_status . "</h1></td></tr>";
                                $color_message=$payment_status;
                            } elseif ($payment_status == "Partial" && $invoice_status=="Paid") {
                                $color_font = "#09f;";
                                //$html .= "<tr><td align='center' style='color:" . $color . "'><h1 style='width:60%; font-size:100px; display:block; margin-left:auto; margin-right:auto; border:3px " . $color . " solid;'>Paid</h1></td></tr>";
                                $color_message="Paid";
                            } else {
                                $color_font = "#f00";
                                //$html .= "<tr><td align='center' style='color:" . $color . "'><h1 style='width:60%; font-size:100px; display:block; margin-left:auto; margin-right:auto; border:3px " . $color . " solid;'>" . $pmt_status . "</h1></td></tr>";
                                $color_message=$payment_status;
                            } 

                           $total_tax_and_repair=$total_repairnParts+$total_tax;

               // echo $html; die();
               $html .= "<tr>
               <td style='text-align:center;' align='center'>
                       <table style='border:0px; width:100%;'>
                       <tr>
                           <td width='33.3%' align='center'>
                                    <table class='table table-bordered' style='width:100%; margin-top:-15px; margin-left:-2px;'>
                                        <thead>";
                                        if ($tab_invoice->repair_type!="Parts")
                                        {
                                        $html .= "
                                            <tr>
                                                <td style='background:#ccc; height:20px; padding:10px;' align='left'>Device</td>
                                                <td style='padding:10px;'>". $tab_invoice->device ."</td>
                                            </tr>
                                            
                                            
                                            <tr>
                                                <td style='background:#ccc; height:20px; padding:10px;' align='left'>Problem</td>
                                                <td style='padding:10px;'>". $tab_invoice->problem_type ."</td>
                                            </tr>";
                                        }
                                        else
                                        {
                                            $html .= "
                                            <tr>
                                                <td colspan='2' style='background:#ccc; height:20px; padding:10px;' align='center'>Device Info</td>
                                            </tr>";
                                        }
                                            
                                            $html .= "
                                            <tr>
                                                <td style='background:#ccc; height:20px; padding:10px;' align='left'>IMEI</td>
                                                <td style='padding:10px;'>". $tab_invoice->imei ."</td>
                                            </tr>

                                            <tr>
                                                <td style='background:#ccc; height:20px; padding:10px;' align='left'>Password</td>
                                                <td style='padding:10px;'>". $tab_invoice->password ."</td>
                                            </tr>
                                            
                                            <tr>
                                                <td style='background:#ccc; height:20px; padding:10px;' align='left'>Notes</td>
                                                <td style='padding:10px;'>". $tab_invoice->notes ."</td>
                                            </tr>
                                            
                                            
                                        </thead>
                                    </table>      
                           </td>
                           <td width='33.3%'>&nbsp; </td>
                           <td width='33.3%' align='right' valign='top'>
                                <table class='table table-bordered' style='width:100%; margin-top:-15px; margin-right:-2px;'>
                                    <thead>
                                        <tr><td style='background:#ccc; height:20px; padding:10px;'>Payment Status</td>
                                        <td style='padding:10px;'>". $payment_status ."</td></tr>
                                        <tr><td style='background:#ccc; height:20px; padding:10px;'>Sub - Total</td>
                                        <td style='padding:10px;'>$" . number_format($total_repairnParts, 2) . "</td></tr>
                                        <tr><td style='background:#ccc; height:20px; padding:10px;'>Tax</td>
                                        <td style='padding:10px;'>$".$total_tax."</td></tr>
                                        <tr><td style='background:#ccc; height:20px; padding:10px;'>Total</td>
                                        <td style='padding:10px;'>$" . number_format($total_tax_and_repair, 2) . "</td></tr>
                                        
                                    </thead>
                                </table>
                           </td>
                       </tr>
                       <tr>
                           <td width='33.3%' align='center'>
                           
                           </td>
                           <td width='33.3%' align='center' style='padding-top:100px;'>
                                <div style='text-align:center; font-weight:bolder; font-size:12px; display:block; text-align:center;'><b> " . $report_cpmpany_fotter . " </b></div>
                                <br>
                                <div style='text-align:center; font-weight:bolder; font-size:18x; display:block; padding-top:10px; text-align:center;'><b> Thank You For Your Business </b></div>   
                                <div style='text-align:center; font-weight:bolder; font-size:100x; color:".$color_font." display:block; padding-top:10px; text-align:center;'><b> ".$color_message." </b></div>       
                           </td>
                           <td width='33.3%' align='right'>
                                
                           </td>
                       </tr>
                   </table>
                   
               </td>
             </tr>";


                  
                


               

                        $html .= "<tr><td>
                                
                                </td>
                                </tr>
                                <tr>
                                <td>

                                </td>
                                </tr>";




    


                $html .= "</tbody></table>";

                //echo $html; die();

                $stylesheet=file_get_contents(public_path('assets/css/bootstrap.min.css'));
                //$stylesheet2=file_get_contents(public_path('assets/css/style.css'));

                $mpdf->WriteHTML($stylesheet, 1);
                //$mpdf->WriteHTML($stylesheet2, 1); // The parameter 1 tells that this is css/style only and no body/html/text
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\InStoreRepair  $inStoreRepair
     * @return \Illuminate\Http\Response
     */
    public function edit(InStoreRepair $inStoreRepair)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InStoreRepair  $inStoreRepair
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InStoreRepair $inStoreRepair)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InStoreRepair  $inStoreRepair
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=0)
    {
        $tab=InStoreRepair::find($id);
        $tab->delete();

        return redirect('repair/list')->with('success', ' Deleted Successfully. !');
    }

    public function destroyR($id=0)
    {
        $tab=InventoryRepair::find($id);
        //dd($tab);
        $tab->delete();

        return redirect('repair-list')->with('success', ' Deleted Successfully. !');
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

        $invoice=InStoreRepair::where('store_id',$this->sdc->storeID())
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
        $total_price_amount=0;
        $total_re_price_amount=0;
        $total_over_price_amount=0;
        $data=array();
        $array_column=array('Repair ID','Invoice ID','Customer Name','Device Name','Model Name','Problem Name','Product Name','Price','Repair Price','Override Repair Price','Password','IMEI','Tested Before By','Tested After By','Tech Notes','How Did You Hear About Us','Start Time','End Time','Salvage Part');
        array_push($data, $array_column);
        $inv=$this->profitQuery($request);

        foreach($inv as $voi):
            $inv_arry=array($voi->id,$voi->invoice_id,$voi->customer_name,$voi->device_name,$voi->model_name,$voi->problem_name,$voi->product_name,$voi->price,$voi->repair_price,$voi->override_repair_price,$voi->password,$voi->imei,$voi->tested_before_by,$voi->tested_after_by,$voi->tech_notes,$voi->how_did_you_hear_about_us,$voi->start_time,$voi->end_time,$voi->salvage_part);

            $total_price_amount+=$voi->price;
            $total_re_price_amount+=$voi->repair_price;
            $total_over_price_amount+=$voi->override_repair_price;
            array_push($data, $inv_arry);
        endforeach;


        $array_column=array('','','','','','','Total =',$total_price_amount,$total_re_price_amount,$total_over_price_amount,'','','','','','','','','');
        array_push($data, $array_column);

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
                <th class="text-center" style="font-size:12px;" >Device Name</th>
                <th class="text-center" style="font-size:12px;" >Paid Model Name</th>
                <th class="text-center" style="font-size:12px;" >Problem Name</th>
                <th class="text-center" style="font-size:12px;" >Product Name</th>
                <th class="text-center" style="font-size:12px;" >Price</th>
                <th class="text-center" style="font-size:12px;" >Repair Price</th>
                <th class="text-center" style="font-size:12px;" >Override Repair Price</th>
                <th class="text-center" style="font-size:12px;" >Password</th>
                <th class="text-center" style="font-size:12px;" >IMEI</th>
                <th class="text-center" style="font-size:12px;" >Tested Before By</th>
                <th class="text-center" style="font-size:12px;" >Tested After By</th>
                <th class="text-center" style="font-size:12px;" >Tech Notes</th>
                <th class="text-center" style="font-size:12px;" >How Did You Hear About Us</th>
                <th class="text-center" style="font-size:12px;" >Start Time</th>
                <th class="text-center" style="font-size:12px;" >End Time</th>
                <th class="text-center" style="font-size:12px;" >Salvage Part</th>
                </tr>
                </thead>
                <tbody>';

                $total_price_amount=0;
                $total_re_price_amount=0;
                $total_over_price_amount=0;

                    $inv=$this->profitQuery($request);
                    foreach($inv as $voi):
                        $html .='<tr>
                        <td style="font-size:12px;" class="text-center">'.$voi->id.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->invoice_id.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->customer_name.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->device_name.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->model_name.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->problem_name.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->product_name.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->price.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->repair_price.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->override_repair_price.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->password.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->imei.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->tested_before_by.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->tested_after_by.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->tech_notes.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->how_did_you_hear_about_us.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->start_time.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->end_time.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->salvage_part.'</td>
                        </tr>';

                        $total_price_amount+=$voi->price;
                        $total_re_price_amount+=$voi->repair_price;
                        $total_over_price_amount+=$voi->override_repair_price;

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
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Total =</td>
                <td align="center">'.$total_price_amount.'</td>
                <td align="center">'.$total_re_price_amount.'</td>
                <td align="center">'.$total_over_price_amount.'</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>';
                $html .='</table>';



                $this->sdc->PDFLayout($reportName,$html);


    }


    public function reportLCDStatus(Request $request)
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

        $lcd_status='';
        if(isset($request->lcd_status))
        {
            $lcd_status=$request->lcd_status;
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


        if(empty($invoice_id) && empty($customer_id) && empty($lcd_status) && empty($dateString))
        {
            /*$invoice=InStoreRepair::select('id','product_name','payment_status','customer_name','price','imei','invoice_id','created_at','lcd_status')
                     ->where('store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoice_id','=', $invoice_id);
                     })
                     ->when($customer_id, function ($query) use ($customer_id) {
                            return $query->where('customer_id','=', $customer_id);
                     })
                     ->when($lcd_status, function ($query) use ($lcd_status) {
                            return $query->where('lcd_status','=', $lcd_status);
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
            $invoice=InStoreRepair::select('id','product_name','payment_status','customer_name','price','imei','invoice_id','created_at','lcd_status')
                     ->where('store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoice_id','=', $invoice_id);
                     })
                     ->when($customer_id, function ($query) use ($customer_id) {
                            return $query->where('customer_id','=', $customer_id);
                     })
                     ->when($lcd_status, function ($query) use ($lcd_status) {
                            return $query->where('lcd_status','=', $lcd_status);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->get();
        }

        
                     //->toSql();

        //dd($tender_id);              

        $tab_customer=Customer::where('store_id',$this->sdc->storeID())->get();

        return view('apps.pages.report.repairLCDStatus',
            [
                'customer'=>$tab_customer,
                'invoice'=>$invoice,
                'invoice_id'=>$invoice_id,
                'customer_id'=>$customer_id,
                'start_date'=>$start_date,
                'end_date'=>$end_date,
                'lcd_status'=>$lcd_status
            ]);
    }

    private function InstoreLCDRepairDRPCount($search=''){

        $tab=InStoreRepair::leftjoin('invoices','in_store_repairs.invoice_id','=','invoices.invoice_id')
                          ->select('in_store_repairs.id')
                          ->where('in_store_repairs.store_id',$this->sdc->storeID())
                          ->orderBy('in_store_repairs.id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('in_store_repairs.id','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.product_name','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.payment_status','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.price','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.imei','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.invoice_id','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.created_at','LIKE','%'.$search.'%');

                            return $query;
                          })

                          ->count();
        return $tab;
    }

    private function InstoreLCDRepairDRP($start, $length,$search=''){

        $tab=InStoreRepair::leftjoin('invoices','in_store_repairs.invoice_id','=','invoices.invoice_id')
                          ->select('in_store_repairs.id','in_store_repairs.product_name','in_store_repairs.payment_status','in_store_repairs.lcd_status','in_store_repairs.customer_name','in_store_repairs.price','in_store_repairs.imei','in_store_repairs.invoice_id','in_store_repairs.created_at','invoices.invoice_status')
                          ->where('in_store_repairs.store_id',$this->sdc->storeID())
                          ->orderBy('in_store_repairs.id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('in_store_repairs.id','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.product_name','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.payment_status','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.price','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.imei','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.invoice_id','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.created_at','LIKE','%'.$search.'%');

                            return $query;
                          })

                     ->skip($start)->take($length)->get();
        return $tab;
    }


    public function InstoreLCDRepairDRPjson(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->InstoreLCDRepairDRPCount($search); // get your total no of data;
        $members = $this->InstoreLCDRepairDRP($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

    }

    public function LCDStatusQuery($request)
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

        $lcd_status='';
        if(isset($request->lcd_status))
        {
            $lcd_status=$request->lcd_status;
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

        $invoice=InStoreRepair::where('store_id',$this->sdc->storeID())
                     ->when($invoice_id, function ($query) use ($invoice_id) {
                            return $query->where('invoice_id','=', $invoice_id);
                     })
                     ->when($customer_id, function ($query) use ($customer_id) {
                            return $query->where('customer_id','=', $customer_id);
                     })
                     ->when($tender_id, function ($query) use ($tender_id) {
                            return $query->where('tender_id','=', $tender_id);
                     })
                     ->when($lcd_status, function ($query) use ($lcd_status) {
                            return $query->where('lcd_status','=', $lcd_status);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->get();
        //dd($invoice);
        return $invoice;
    }

    public function exportExcelLCDStatus(Request $request) 
    {
        //excel 
        $total_price_amount=0;
        $data=array();
        $array_column=array('Repair ID','Invoice ID','Customer Name','Product Name','Price','LCD Status');
        array_push($data, $array_column);
        $inv=$this->LCDStatusQuery($request);

        foreach($inv as $voi):
            $inv_arry=array($voi->id,$voi->invoice_id,$voi->customer_name,$voi->product_name,$voi->price,$voi->lcd_status);

            $total_price_amount+=$voi->price;
            array_push($data, $inv_arry);
        endforeach;

        $array_column=array('','','','Total =',$total_price_amount,'');
        array_push($data, $array_column);

        $reportName="Repair LCD  Report";
        $report_title="Repair LCD Report";
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

    public function exportPDFLCDStatus(Request $request)
    {

        $data=array();
        
       
        $reportName="Repair LCD Report";
        $report_title="Repair LCD Report";
        $report_description="Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >Repair ID</th>
                <th class="text-center" style="font-size:12px;" >Invoice ID</th>
                <th class="text-center" style="font-size:12px;" >Customer Name</th>
                <th class="text-center" style="font-size:12px;" >Product Name</th>
                <th class="text-center" style="font-size:12px;" >Price</th>
                <th class="text-center" style="font-size:12px;" >LCD Status</th>
                </tr>
                </thead>
                <tbody>';

                $total_price_amount=0;

                    $inv=$this->LCDStatusQuery($request);
                    foreach($inv as $voi):
                        $html .='<tr>
                        <td style="font-size:12px;" class="text-center">'.$voi->id.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->invoice_id.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->customer_name.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->product_name.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->price.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->lcd_status.'</td>
                        </tr>';

                        $total_price_amount+=$voi->price;
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
                <td></td>
               <td>Total =</td>
                <td align="center">'.$total_price_amount.'</td>
                <td></td>
                </tr>';
                $html .='</table>';



                $this->sdc->PDFLayout($reportName,$html);


    }

    public function reportSalvage(Request $request)
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


        if(empty($invoice_id) && empty($customer_id) && empty($dateString))
        {
            /*$invoice=InStoreRepair::select('id','product_name','payment_status','customer_name','price','imei','invoice_id','created_at','salvage_part')
                     ->where('store_id',$this->sdc->storeID())
                     ->where('salvage_part','on')
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
            $invoice=InStoreRepair::select('id','product_name','payment_status','customer_name','price','imei','invoice_id','created_at','salvage_part')
                     ->where('store_id',$this->sdc->storeID())
                     ->where('salvage_part','on')
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

        return view('apps.pages.report.repairSalvage',
            [
                'customer'=>$tab_customer,
                'invoice'=>$invoice,
                'invoice_id'=>$invoice_id,
                'customer_id'=>$customer_id,
                'start_date'=>$start_date,
                'end_date'=>$end_date
            ]);
    }

    private function InstoreSalvageRepairDRPCount($search=''){

        $tab=InStoreRepair::leftjoin('invoices','in_store_repairs.invoice_id','=','invoices.invoice_id')
                          ->select('in_store_repairs.id')
                          ->where('in_store_repairs.store_id',$this->sdc->storeID())
                          ->orderBy('in_store_repairs.id','DESC')
                          ->where('in_store_repairs.salvage_part','on')
                          ->when($search, function ($query) use ($search) {
                            $query->where('in_store_repairs.id','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.product_name','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.payment_status','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.price','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.imei','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.invoice_id','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.created_at','LIKE','%'.$search.'%');

                            return $query;
                          })

                          ->count();
        return $tab;
    }

    private function InstoreSalvageRepairDRP($start, $length,$search=''){

        $tab=InStoreRepair::leftjoin('invoices','in_store_repairs.invoice_id','=','invoices.invoice_id')
                          ->select('in_store_repairs.id','in_store_repairs.product_name','in_store_repairs.payment_status','in_store_repairs.salvage_part','in_store_repairs.customer_name','in_store_repairs.price','in_store_repairs.imei','in_store_repairs.invoice_id','in_store_repairs.created_at','invoices.invoice_status')
                          ->where('in_store_repairs.store_id',$this->sdc->storeID())
                          ->orderBy('in_store_repairs.id','DESC')
                          ->where('in_store_repairs.salvage_part','on')
                          ->when($search, function ($query) use ($search) {
                            $query->where('in_store_repairs.id','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.product_name','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.payment_status','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.customer_name','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.price','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.imei','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.invoice_id','LIKE','%'.$search.'%');
                            $query->orWhere('in_store_repairs.created_at','LIKE','%'.$search.'%');

                            return $query;
                          })

                     ->skip($start)->take($length)->get();
        return $tab;
    }


    public function InstoreSalvageRepairDRPjson(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->InstoreSalvageRepairDRPCount($search); // get your total no of data;
        $members = $this->InstoreSalvageRepairDRP($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

    }

    public function SalvageQuery($request)
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

        $invoice=InStoreRepair::where('store_id',$this->sdc->storeID())
                     ->where('salvage_part','on')
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

    public function exportExcelSalvage(Request $request) 
    {
        //excel 
        $total_paid_amount=0;
        $data=array();
        $array_column=array('Repair ID','Invoice ID','Customer Name','Product Name','Price','Salvage Part');
        array_push($data, $array_column);
        $inv=$this->SalvageQuery($request);

        foreach($inv as $voi):
            $inv_arry=array($voi->id,$voi->invoice_id,$voi->customer_name,$voi->product_name,$voi->price,"Yes");
            $total_paid_amount+=$voi->price;

            array_push($data, $inv_arry);
        endforeach;

        $array_column=array('','','','Total =',$total_paid_amount,'');
        array_push($data, $array_column);

        $reportName="Repair Salvage  Report";
        $report_title="Repair Salvage Report";
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

    public function exportPDFSalvage(Request $request)
    {

        $data=array();
        
       
        $reportName="Repair Salvage Report";
        $report_title="Repair Salvage Report";
        $report_description="Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >Repair ID</th>
                <th class="text-center" style="font-size:12px;" >Invoice ID</th>
                <th class="text-center" style="font-size:12px;" >Customer Name</th>
                <th class="text-center" style="font-size:12px;" >Product Name</th>
                <th class="text-center" style="font-size:12px;" >Price</th>
                <th class="text-center" style="font-size:12px;" >Salvage Part</th>
                </tr>
                </thead>
                <tbody>';

                $total_paid_amount=0;
                    $inv=$this->SalvageQuery($request);
                    foreach($inv as $voi):
                        $html .='<tr>
                        <td style="font-size:12px;" class="text-center">'.$voi->id.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->invoice_id.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->customer_name.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->product_name.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->price.'</td>
                        <td style="font-size:12px;" class="text-right">Yes</td>
                        </tr>';

                        $total_paid_amount+=$voi->price;

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
                <td></td>
                <td>Total =</td>
                <td align="center">'.$total_paid_amount.'</td>
             <td></td>
                </tr>';
                $html .='</table>';



                $this->sdc->PDFLayout($reportName,$html);


    }
}
