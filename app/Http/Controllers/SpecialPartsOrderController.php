<?php

namespace App\Http\Controllers;

use App\SpecialPartsOrder;
use App\Product;
use App\Customer;
use App\InStoreTicket;
use Illuminate\Http\Request;

class SpecialPartsOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $moduleName="Special Parts Order";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        $tab=SpecialPartsOrder::where('store_id',$this->sdc->storeID())->orderBy('id','DESC')->take(100)->get();
        return view('apps.pages.customer.customer-lead',['existing_cus'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ticketList=InStoreTicket::where('store_id',$this->sdc->storeID())->get();
        $customerList=Customer::where('store_id',$this->sdc->storeID())->get();
        $productData=Product::select('id','name')->where('store_id',$this->sdc->storeID())->get();
        return view('apps.pages.orderparts.create',compact('productData','ticketList','customerList'));
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
            'ticket_id'=>'required',
            'ticket_payment_status'=>'required',
            'quantity'=>'required',
            'cost_price'=>'required',
            'sold_price'=>'required',
            'texable_status'=>'required',
            'ordered'=>'required',
            'received'=>'required',
        ]);
        
            $taxAble=0;
            if($request->texable_status=="Yes")
            {
                $taxAble=1;
            }

            $customer=Customer::find($request->customer_id);

            $tab=new SpecialPartsOrder;
            $tab->customer_id=$request->customer_id;
            $tab->customer_name=$customer->name;
            $tab->ticket_id=$request->ticket_id;
            $tab->ticket_payment_status=$request->ticket_payment_status;
            $tab->description=$request->description;
            $tab->part_url=$request->part_url;
            $tab->quantity=$request->quantity;
            $tab->cost_price=$request->cost_price;
            $tab->sold_price=$request->sold_price;
            $tab->texable=$taxAble;
            $tab->texable_status=$request->texable_status;
            $tab->trackingnum=$request->trackingnum;
            $tab->notes=$request->notes;
            $tab->ordered=$request->ordered;
            $tab->received=$request->received;
            $tab->store_id=$this->sdc->storeID();
            $tab->created_by=$this->sdc->UserID();
            $tab->save();
            $customer_id=$tab->id;
        
        $this->sdc->log("Special Parts Order","New Special Parts Order Has Been Created.");
        return redirect('special/parts/create')->with('status', $this->moduleName.' Created Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CustomerLead  $customerLead
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=''){

        $tab=SpecialPartsOrder::select('id','ticket_id','ticket_payment_status','customer_name','description','ordered','order_status','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                        $query->orWhere('ticket_id','LIKE','%'.$search.'%');
                        $query->orWhere('ticket_payment_status','LIKE','%'.$search.'%');
                        $query->orWhere('customer_name','LIKE','%'.$search.'%');
                        $query->orWhere('description','LIKE','%'.$search.'%');
                        $query->orWhere('ordered','LIKE','%'.$search.'%');
                        $query->orWhere('order_status','LIKE','%'.$search.'%');
                        $query->orWhere('created_at','LIKE','%'.$search.'%');

                        return $query;
                     })

                     ->count();
        return $tab;
    }

    private function methodToGetMembers($start, $length,$search=''){

        $tab=SpecialPartsOrder::select('id','ticket_id','ticket_payment_status','customer_name','description','ordered','order_status','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                        $query->orWhere('ticket_id','LIKE','%'.$search.'%');
                        $query->orWhere('ticket_payment_status','LIKE','%'.$search.'%');
                        $query->orWhere('customer_name','LIKE','%'.$search.'%');
                        $query->orWhere('description','LIKE','%'.$search.'%');
                        $query->orWhere('ordered','LIKE','%'.$search.'%');
                        $query->orWhere('order_status','LIKE','%'.$search.'%');
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


    public function show(SpecialPartsOrder $SpecialPartsOrder)
    {
        //$tab=$SpecialPartsOrder::where('store_id',$this->sdc->storeID())->orderBy('id','DESC')->take(100)->get();,['dataTable'=>$tab]
        return view('apps.pages.orderparts.list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CustomerLead  $customerLead
     * @return \Illuminate\Http\Response
     */
    public function ticketPartsOrder(SpecialPartsOrder $SpecialPartsOrder,$ticket_id=0)
    {

        $ticketPartsOrder=InStoreTicket::where('store_id',$this->sdc->storeID())->where('ticket_id',$ticket_id)->first();
        //dd($ticketPartsOrder);
        $ticketList=InStoreTicket::where('store_id',$this->sdc->storeID())->get();
        $customerList=Customer::where('store_id',$this->sdc->storeID())->get();
       // $productData=Product::select('id','name')->where('store_id',$this->sdc->storeID())->get();

        $productData=Product::select('id','name')->where('store_id',$this->sdc->storeID())->get();
       // dd($dataRow);
        $orderStatusArray=array('Order Placed','Ready for Shipment','On The Way','Received','Return Order','Cancel');
        return view('apps.pages.orderparts.create',['productData'=>$productData,'orderStatusArray'=>$orderStatusArray,'ticketList'=>$ticketList,'customerList'=>$customerList,'ticketPartsOrder'=>$ticketPartsOrder]);
    }

    public function edit(SpecialPartsOrder $SpecialPartsOrder,$id=0)
    {

        $ticketList=InStoreTicket::where('store_id',$this->sdc->storeID())->get();
        $customerList=Customer::where('store_id',$this->sdc->storeID())->get();
       // $productData=Product::select('id','name')->where('store_id',$this->sdc->storeID())->get();

        $productData=Product::select('id','name')->where('store_id',$this->sdc->storeID())->get();
        $dataRow=$SpecialPartsOrder::find($id);
       // dd($dataRow);
        $orderStatusArray=array('Order Placed','Ready for Shipment','On The Way','Received','Return Order','Cancel');
        return view('apps.pages.orderparts.create',['productData'=>$productData,'dataRow'=>$dataRow,'edit'=>$id,'orderStatusArray'=>$orderStatusArray,'ticketList'=>$ticketList,'customerList'=>$customerList]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CustomerLead  $customerLead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpecialPartsOrder $SpecialPartsOrder,$id=0)
    {
        $this->validate($request,[
            'customer_id'=>'required',
            'ticket_id'=>'required',
            'ticket_payment_status'=>'required',
            'quantity'=>'required',
            'cost_price'=>'required',
            'sold_price'=>'required',
            'texable_status'=>'required',
            'ordered'=>'required',
            'received'=>'required',
            'order_status'=>'required',
        ]);
        
            $taxAble=0;
            if($request->texable_status=="Yes")
            {
                $taxAble=1;
            }

            $customer=Customer::find($request->customer_id);

            $tab=SpecialPartsOrder::find($id);
            $tab->customer_id=$request->customer_id;
            $tab->customer_name=$customer->name;
            $tab->ticket_id=$request->ticket_id;
            $tab->ticket_payment_status=$request->ticket_payment_status;
            $tab->description=$request->description;
            $tab->part_url=$request->part_url;
            $tab->quantity=$request->quantity;
            $tab->cost_price=$request->cost_price;
            $tab->sold_price=$request->sold_price;
            $tab->texable=$taxAble;
            $tab->texable_status=$request->texable_status;
            $tab->trackingnum=$request->trackingnum;
            $tab->notes=$request->notes;
            $tab->ordered=$request->ordered;
            $tab->received=$request->received;
            $tab->order_status=$request->order_status;
            $tab->updated_by=$this->sdc->UserID();
            $tab->save();
        
        $this->sdc->log("Special Parts Order","Special Parts Order Has Been Updated.");
        return redirect('special/parts/list')->with('status', $this->moduleName.' Updated Successfully !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CustomerLead  $customerLead
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecialPartsOrder $SpecialPartsOrder,$id=0)
    {
        $tab=$SpecialPartsOrder::find($id);
        $tab->delete();
        $this->sdc->log("Special Parts Order","Special Parts Order deleted."); 
        return redirect('special/parts/list')->with('status', $this->moduleName.' Deleted Successfully !');
    }
}
