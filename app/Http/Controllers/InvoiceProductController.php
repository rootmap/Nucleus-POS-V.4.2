<?php

namespace App\Http\Controllers;
use App\Pos;
use App\Product;
//use Session;
use App\InvoiceProduct;
use App\InvoicePayment;
use App\Invoice;
use App\Tender;
use App\InStoreTicket;
use App\InStoreRepair;
use App\SessionInvoice;
use App\Customer;
use App\PosSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InvoiceProductController extends Controller
{
    private $moduleName="In Store Repair Settings ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function getDBCart(Request $request)
    {
        $datas=\DB::table('sessions')->where('user_id',\Auth::user()->id)->first();
        // /$data = Session::where('user_id',\Auth::user()->id)->first();
        dd(unserialize(base64_decode($datas->payload)));
    }

    public function setTaxType(Request $request)
    {
        $setTaxType=$request->setTaxType;
        $oldCart = $request->session()->has('Pos') ?  $request->session()->get('Pos') : null;
        $cart = new Pos($oldCart);
        if(empty($oldCart->invoiceID))
        {
            $cart->genarateInvoiceID();
        }
        $cart->assignNewTaxType($setTaxType);

        $request->session()->put('Pos', $cart); 

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
        
        return response()->json($cart);
    }

    public function partialRepairPOS(Request $request, $repair_id=0)
    {
        $data=InStoreRepair::leftjoin('invoices','in_store_repairs.invoice_id','=','invoices.invoice_id')
                            ->select('in_store_repairs.*','invoices.invoice_status')
                            ->where('in_store_repairs.id',$repair_id)
                            ->first();

        if($data->payment_status=="Partial" && $data->invoice_status=="Paid")
        {
            \DB::table('in_store_repairs')->where('id',$repair_id)->update(['payment_status'=>'Paid']);

            return redirect('repair/list')->with('status','Sorry, Repair payment already paid.');
        }
        elseif($data->payment_status=="Partial" && $data->invoice_status=="Partial")
        {
            Session::put('addPartialPayment',1);
            Session::put('partial_invoice',$data->invoice_id);
            return redirect('pos')->with('status','Partial payment initiating.');
        }
        else
        {
            return redirect('repair/list')->with('error','Failed, Something went wrong, Please contact with system admin.');
        }


        //dd($data);
        //echo $repair_id; die();
    }

    public function RepairPOS(Request $request, $repair_id=0)
    {
        //echo 1; die();

        $tab_invoice=InStoreRepair::where('id',$repair_id)
                                  ->where('store_id',$this->sdc->storeID())
                                  ->first();

        $product = \DB::table('products')->where('id',$tab_invoice->product_id)->first();
        $oldCart = $request->session()->has('Pos') ?  $request->session()->get('Pos') : null;

        $cart = new Pos($oldCart);
        if(empty($oldCart->invoiceID))
        {
            $cart->genarateInvoiceID();
        }
        $cart->addCustomerID($tab_invoice->customer_id);
        $cart->addCustomRepairPrice($product, $product->id,$tab_invoice->price,$repair_id);

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

    public function TicketPOS(Request $request, $ticket_id=0)
    {

        $tab_invoice=InStoreTicket::where('id',$ticket_id)
                                  ->where('store_id',$this->sdc->storeID())
                                  ->first();

        //dd($tab_invoice);

        $product=\DB::table('products')->where('id',$tab_invoice->product_id)->first();
        //dd($product);
        if(empty($product))
        {
            $checkTicketCat=\DB::table('categories')->where('name','Ticket')->where('store_id',$this->sdc->storeID())->count();
            if($checkTicketCat==0)
            {
                \DB::table('categories')->insert([
                    'name'=>'Ticket',
                    'store_id'=>$this->sdc->storeID(),
                    'created_by'=>$this->sdc->UserID()
                ]);
            }

            $ticketCat=\DB::table('categories')->where('name','Ticket')->where('store_id',$this->sdc->storeID())->first();

            $product=new Product();
            $product->name=$tab_invoice->product_name;
            $product->detail=$tab_invoice->product_name;
            $product->quantity=1;
            $product->general_sale=1;
            $product->price=$tab_invoice->retail_price;
            $product->cost=$tab_invoice->our_cost;
            $product->category_id=$ticketCat->id;
            $product->category_name=$ticketCat->name;
            $product->name=$tab_invoice->product_name;
            $product->store_id=$this->sdc->storeID();
            $product->created_by=$this->sdc->UserID();
            $product->save();
            $pid=$product->id;

            $tab_invoice->product_id=$pid;
            $tab_invoice->save();
        }

        $oldCart = $request->session()->has('Pos') ?  $request->session()->get('Pos') : null;
        $cart = new Pos($oldCart);
        if(empty($oldCart->invoiceID))
        {
            $cart->genarateInvoiceID();
        }
        $cart->addCustomerID($tab_invoice->customer_id);
        $cart->addCustomTicketPrice($product, $product->id,$tab_invoice->retail_price,$ticket_id);
        $request->session()->put('Pos', $cart); 
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

    public function TicketPartialPOS(Request $request, $ticket_id=0)
    {

        $tab_invoice=InStoreTicket::where('id',$ticket_id)
                                  ->where('store_id',$this->sdc->storeID())
                                  ->first();

        
        $request->session()->put('partial_invoice', $tab_invoice->invoice_id);
        $request->session()->put('addPartialPayment', 1);
        return redirect('pos');
    }


    public function getAddToCart(Request $request, $pid) {

        if(isset($request->repair))
        {
            $product = Product::find($pid);
            $oldCart = $request->session()->has('Pos') ?  $request->session()->get('Pos') : null;
            $cart = new Pos($oldCart);
            $cart->addCustomPriceRepair($product, $product->id,$request->price,$request->repair);
        }
        elseif(isset($request->ticket))
        {
            $product = Product::find($pid);
            $oldCart = $request->session()->has('Pos') ?  $request->session()->get('Pos') : null;
            $cart = new Pos($oldCart);
            $cart->addCustomPriceTicket($product, $product->id,$request->price,$request->ticket);
        }
        else
        {
            if(isset($request->price))
            {
                $product = Product::find($pid);
                $oldCart = $request->session()->has('Pos') ?  $request->session()->get('Pos') : null;
                $cart = new Pos($oldCart);
                $cart->addCustomPrice($product, $product->id,$request->price);
            }
            else
            {
                $product = Product::find($pid);
                $oldCart = $request->session()->has('Pos') ?  $request->session()->get('Pos') : null;
                $cart = new Pos($oldCart);
                $cart->add($product, $product->id);
            }
        }

        if(empty($oldCart->invoiceID))
        {
            $cart->genarateInvoiceID();
        }
        

        
        $request->session()->put('Pos', $cart);

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


        return response()->json(1);
    }

    public function getCustomQuantityToCart(Request $request,$pid=0,$quantity=0,$price=0) {

        $product = Product::find($pid);
        $oldCart = $request->session()->has('Pos') ? $request->session()->get('Pos') : null;
        $cart = new Pos($oldCart);
        $cart->addCustomQuantityPrice($product, $product->id,$quantity,$price);
        //$cart->addCustomQuantity($product, $product->id,$quantity);
        if(empty($oldCart->invoiceID))
        {
            $cart->genarateInvoiceID();
        }
        $request->session()->put('Pos', $cart); 

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

        return response()->json(1);

    }

    public function getAssignDiscountToCart(Request $request)
    {
        $discountType=$request->discount_type?$request->discount_type:0;
        $discount_amount=$request->discount_amount?$request->discount_amount:0;
        $oldCart = $request->session()->has('Pos') ? $request->session()->get('Pos') : null;
        $cart = new Pos($oldCart);
        $cart->getAssignDiscountToCart($discountType,$discount_amount);
        if(empty($oldCart->invoiceID))
        {
            $cart->genarateInvoiceID();
        }
        $request->session()->put('Pos', $cart); 

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

        return response()->json(1);
    }

   public function getCusAssignToCart(Request $request,$cusid)
   {
        $oldCart = $request->session()->has('Pos') ? $request->session()->get('Pos') : null;
        $cart = new Pos($oldCart);
        $cart->addCustomerID($cusid);
        if(empty($oldCart->invoiceID))
        {
            $cart->genarateInvoiceID();
        }
        $request->session()->put('Pos', $cart);

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

        return response()->json(1);
   }

    public function getPaidCart(Request $request) {

        $paidAmount=$request->paidAmount;
        $paymentID=$request->paymentID;
        $oldCart = $request->session()->has('Pos') ? $request->session()->get('Pos') : null;
        $cart = new Pos($oldCart);
        if(empty($oldCart->invoiceID))
        {
            $cart->genarateInvoiceID();
        }
        $cart->addPayment($paidAmount, $paymentID);
        $request->session()->put('Pos', $cart);



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

        


        return response()->json(1);
    }

    public function getPaidCartPublic(Request $request) {

        $paidAmount=$request->paidAmount;
        $paymentID=$request->paymentID;
        $invoice_id=$request->invoice_id;


        $Tender=Tender::find($paymentID);

        $invoice=Invoice::where('invoice_id',$invoice_id)->first();
        $invoice->tender_id=$paymentID;
        $invoice->save();

        $Customer=Customer::find($invoice->customer_id);

        $ChkInvoicePayment=InvoicePayment::where('invoice_id',$invoice_id)->count();
        if($ChkInvoicePayment>0)
        {
            $InvoicePayment=InvoicePayment::where('invoice_id',$invoice_id)->first();
            $InvoicePayment->invoice_id=$invoice_id;

            $InvoicePayment->tender_id=$Tender->id;
            $InvoicePayment->tender_name=$Tender->name;

            $InvoicePayment->customer_id=$Customer->id;
            $InvoicePayment->customer_name=$Customer->name;

            $InvoicePayment->total_amount=$invoice->total_amount;
            $InvoicePayment->paid_amount=$paidAmount;


            $InvoicePayment->store_id=$invoice->store_id;
            $InvoicePayment->created_by=$invoice->created_by;
            $InvoicePayment->save();
        }
        else
        {
            $InvoicePayment=new InvoicePayment;
            $InvoicePayment->invoice_id=$invoice_id;

            $InvoicePayment->tender_id=$Tender->id;
            $InvoicePayment->tender_name=$Tender->name;

            $InvoicePayment->customer_id=$Customer->id;
            $InvoicePayment->customer_name=$Customer->name;

            $InvoicePayment->total_amount=$invoice->total_amount;
            $InvoicePayment->paid_amount=$paidAmount;


            $InvoicePayment->store_id=$invoice->store_id;
            $InvoicePayment->created_by=$invoice->created_by;
            $InvoicePayment->save();
        }
        


        return response()->json(1);
    }

    public function getDelRowFRMCart(Request $request,$pid)
    {
        $product = Product::find($pid);
        $oldCart = $request->session()->has('Pos') ? $request->session()->get('Pos') : null;
        $cart = new Pos($oldCart);
        $cart->delProductRow($product, $product->id);
        $request->session()->put('Pos', $cart);
        return response()->json(1);
    }

    public function changeCounterPayStatus(Request $request)
    {
        $oldCart = $request->session()->has('Pos') ? $request->session()->get('Pos') : null;
        $cart = new Pos($oldCart);
        $cart->AllowCustomerPayBill($request->counterPayStatus);
        $request->session()->put('Pos', $cart);
        return response()->json(1);
    }

    public function getCart(Request $request)
    {
        $oldCart = $request->session()->has('Pos') ? $request->session()->get('Pos') : null;
        
        echo "<pre>";
        print_r($oldCart); die();
    }

    public function getClearCart(Request $request)
    {
        $oldCart = $request->session()->has('Pos') ? $request->session()->get('Pos') : null;
        $cart = new Pos($oldCart);
        $cart->ClearCart();
        Session::put('Pos', $cart);
    }

}
