<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;
use App\RetailPosSummary;
use App\RetailPosSummaryDateWise;
use App\ProductStockin;
use App\ProductSettings;
use App\TicketProblem;
use Illuminate\Http\Request;
use Excel;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Product";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        $existing_cat=Category::where('store_id',$this->sdc->storeID())->get();
        //$tab=Product::where('store_id',$this->sdc->storeID())->where('general_sale',0)->orderBy('id','DESC')
                     //->take(100)->get();
        //return view('apps.pages.product.product',['dataTable'=>$tab,'existing_cat'=>$existing_cat]);
        $chk=ProductSettings::where('store_id',$this->sdc->storeID())->count();
        if($chk==0)
        {
            return view('apps.pages.product.product',['existing_cat'=>$existing_cat]);
        }
        else
        {
            $chkPS=ProductSettings::where('store_id',$this->sdc->storeID())->first();
            return view('apps.pages.product.product',['chkPS'=>$chkPS,'existing_cat'=>$existing_cat]);
        }

        
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
        $invoice=Product::where('store_id',$this->sdc->storeID())->get();

        return $invoice;
    }

    public function exportExcel(Request $request) 
    {
        //echo "string"; die();
        //excel 
        $data=array();
        $array_column=array('Product ID','Product Name','Quantity IN Stock','Price','Cost','Total Price','Total Cost','Product Date');
        array_push($data, $array_column);
        $inv=$this->profitQuery($request);
        foreach($inv as $voi):
            $inv_arry=array($voi->id,$voi->name,$voi->quantity,$voi->price,$voi->cost,$voi->price*$voi->quantity,$voi->cost*$voi->quantity,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $reportName="Product Report";
        $report_title="Product Report";
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
        
       
        $reportName="Product Report";
        $report_title="Product Report";
        $report_description="Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >Product ID</th>
                <th class="text-center" style="font-size:12px;" >Product Name</th>
                <th class="text-center" style="font-size:12px;" >Quantity IN Stock</th>
                <th class="text-center" style="font-size:12px;" >Price</th>
                <th class="text-center" style="font-size:12px;" >Cost</th>
                <th class="text-center" style="font-size:12px;" >Total Price</th>
                <th class="text-center" style="font-size:12px;" >Total Cost</th>
                <th class="text-center" style="font-size:12px;" >Product Date</th>
                </tr>
                </thead>
                <tbody>';

                    $inv=$this->profitQuery($request);
                    foreach($inv as $voi):
                        $html .='<tr>
                        <td style="font-size:12px;" class="text-center">'.$voi->id.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->name.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->quantity.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->price.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->cost.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->price*$voi->quantity.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->cost*$voi->quantity.'</td>
                        <td style="font-size:12px;" class="text-right">'.formatDate($voi->created_at).'</td>
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
    public function dataTable(Product $product)
    {
        $json =$product::where('store_id',$this->sdc->storeID())->get();

        $retarray=array("draw"=>1,"recordsTotal"=>count($json),"recordsFiltered"=>count($json),"data"=>$json);

        return response()->json($retarray)->header('Content-Type','application/json');

        //application/json
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
            'category_id'=>'required|integer',
            'name'=>'required',
            'barcode'=>'required',
            'quantity'=>'required|integer',
            'price'=>'required|numeric',
            'cost'=>'required|numeric',
        ]);

        $chk=ProductSettings::where('store_id',$this->sdc->storeID())->count();

        $pro_image=0;

        if($chk>0)
        {
            $chkPS=ProductSettings::where('store_id',$this->sdc->storeID())->first();
            $pro_image=$chkPS->product_image_status;
        }

        $filename_slider_0='';
        if($pro_image==1)
        {
            if ($request->hasFile('product_image')) {
                $img_slider = $request->file('product_image');
                $upload_slider = 'upload/product';
                $filename_slider_0 = time() . '.' . $img_slider->getClientOriginalExtension();
                $img_slider->move($upload_slider, $filename_slider_0);
            }
        }
        

        $tabCount=Product::where('name',$request->name)
                         ->where('category_id',$request->category_id)
                         ->where('store_id',$this->sdc->storeID())
                         ->count();
        if($tabCount>0)
        {
            return redirect('product')->with('error', $this->moduleName.' Already Exists !');
        }

        $cat_name='';
        $catInfo=Category::find($request->category_id);
        if(isset($catInfo))
        {
            $cat_name=$catInfo->name;
            $catInfo->product=$catInfo->product+1;
            $catInfo->save();
        }


        $tab=new Product;
        $tab->category_id=$request->category_id;
        $tab->category_name=$cat_name;
        $tab->name=$request->name;
        $tab->barcode=$request->barcode;
        $tab->quantity=$request->quantity;
        $tab->price=$request->price;
        $tab->cost=$request->cost;
        if($pro_image==1)
        {
            $tab->image=$filename_slider_0;
        }
        $tab->store_id=$this->sdc->storeID();
        $tab->created_by=$this->sdc->UserID();
        $tab->save();
        $pid=$tab->id;

        $tab_stock=new ProductStockin;
        $tab_stock->product_id=$pid;
        $tab_stock->quantity=$request->quantity;
        $tab_stock->price=$request->price;
        $tab_stock->cost=$request->cost;
        $tab_stock->store_id=$this->sdc->storeID();
        $tab_stock->created_by=$this->sdc->UserID();
        $tab_stock->save();
        $this->sdc->log("product","Product created");
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

        return redirect('product')->with('status', $this->moduleName.' Added Successfully !');
    }

    public function storeAjax(Request $request)
    {
        $checkExProduct=Product::where('name',$request->name)
                               ->where('general_sale',1)
                               ->where('store_id',$this->sdc->storeID())
                               ->count();

        if($checkExProduct>0)
        {
            $tab=Product::where('name',$request->name)
                        ->where('general_sale',1)
                        ->where('store_id',$this->sdc->storeID())
                        ->first();
        }
        else
        {
            $tab=new Product;
            $tab->name=$request->name;
            $tab->detail=$request->detail;
            $tab->quantity=1;
            $tab->price=$request->price;
            $tab->cost=$request->cost_price;
            $tab->general_sale=1;
            $tab->store_id=$this->sdc->storeID();
            $tab->created_by=$this->sdc->UserID();
            $tab->save();
        }
        
        $pid=$tab->id;
        $this->sdc->log("product","Product created from POS for general sale..");
        return response()->json($pid);
    }

    public function storeTicketAjax(Request $request)
    {
        $catID=0;
        $catName="";
        $catInfoCount=Category::where('store_id',$this->sdc->storeID())->where('name','Ticket')->count();
        if($catInfoCount>0)
        {
            $catInfo=Category::where('store_id',$this->sdc->storeID())->where('name','Ticket')->first();
            $catID=$catInfo->id;
            $catName=$catInfo->name;
        }

        $ticketInfo=$request->ticketInfo;

        $problem_id=$ticketInfo['ticket_problem_id'];
            if($problem_id=="TP0001")
            {

                $checkExProb=TicketProblem::where('store_id',$this->sdc->storeID())
                                          ->where('name',$ticketInfo['ticket_problem_name'])
                                          ->count();
                if($checkExProb==0)
                {
                    $tab=new TicketProblem();
                    $tab->name=$ticketInfo['ticket_problem_name'];
                    $tab->store_id=$this->sdc->storeID();
                    $tab->created_by=$this->sdc->UserID();
                    $tab->save();
                }
                else
                {
                    $tab=TicketProblem::where('store_id',$this->sdc->storeID())
                                      ->where('name',$ticketInfo['ticket_problem_name'])
                                      ->first();
                }
                

                $problem_id=$tab->id;
            }

            $problem_info=TicketProblem::where('id',$problem_id)->first();
            $problem_name=$problem_info->name;

        $ticketDescription='';
        $ticketDescription .='Device Type : '.$ticketInfo['ticket_device_type'];
        if(!empty($problem_name))
        {
            $ticketDescription .=', ';
            $ticketDescription .='Problem : '.$problem_name;
        }

        if(!empty($ticketInfo['ticket_password']))
        {
            $ticketDescription .=', ';
            $ticketDescription .='Password : '.$ticketInfo['ticket_password'];
        }

        if(!empty($ticketInfo['ticket_type_n_color']))
        {
            $ticketDescription .=', ';
            $ticketDescription .='Type & Color : '.$ticketInfo['ticket_type_n_color'];
        }
        
        if(!empty($ticketInfo['ticket_carrier']))
        {
            $ticketDescription .=', ';
            $ticketDescription .='Carrier : '.$ticketInfo['ticket_carrier'];
        }

        if(!empty($ticketInfo['ticket_imei']))
        {
            $ticketDescription .=', ';
            $ticketDescription .='IMEI : '.$ticketInfo['ticket_imei'];
        }

        if(!empty($ticketInfo['ticket_how_did_you_hear_about_us']))
        {
            $ticketDescription .=', ';
            $ticketDescription .='How did you hear aboutus : '.$ticketInfo['ticket_how_did_you_hear_about_us'];
        }

        if(!empty($ticketInfo['isdropoff']))
        {
            $ticketDescription .=', ';
            $ticketDescription .='Is Drop Off : '.$ticketInfo['isdropoff'];
        }

        if(!empty($ticketInfo['ticket_tested_before_by']))
        {
            $ticketDescription .=', ';
            $ticketDescription .='Tested before by : '.$ticketInfo['ticket_tested_before_by'];
        }
        
        if(!empty($ticketInfo['ticket_tested_after_by']))
        {
            $ticketDescription .=', ';
            $ticketDescription .='Tested after by : '.$ticketInfo['ticket_tested_after_by'];
        }

        if(!empty($ticketInfo['ticket_tech_notes']))
        {
            $ticketDescription .=', ';
            $ticketDescription .='Tech Notes : '.$ticketInfo['ticket_tech_notes'];
        }

        //echo $ticketDescription; die();

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
            $tab->price=$request->price;
            $tab->cost=$request->cost_price;
            $tab->general_sale=1;
            $tab->store_id=$this->sdc->storeID();
            $tab->created_by=$this->sdc->UserID();
            $tab->save();
        }

        $pid=$tab->id;
        $this->sdc->log("product","Ticket Product created from POS for general sale.");
        return response()->json($pid);
    }

    public function storeRepairAjax(Request $request)
    {
        $catID=0;
        $catName="";
        $catInfoCount=Category::where('store_id',$this->sdc->storeID())->where('name','Repair')->count();
        if($catInfoCount>0)
        {
            $catInfo=Category::where('store_id',$this->sdc->storeID())->where('name','Repair')->first();
            $catID=$catInfo->id;
            $catName=$catInfo->name;
        }

        $checkExProduct=Product::where('name',$request->name)
                               //->where('general_sale',1)
                               ->where('category_id',$catID)
                               ->where('category_name',$catName)
                               ->where('store_id',$this->sdc->storeID())
                               ->count();


        if($checkExProduct==0)
        {
            $checkExProduct_wcid=Product::where('name',$request->name)
                               //->where('category_id',$catID)
                               ->where('category_name',$catName)
                               ->where('store_id',$this->sdc->storeID())
                               ->count();

            if($checkExProduct_wcid>0)
            {
                $checkExProduct_wcid_data=Product::where('name',$request->name)
                                           //->where('category_id',$catID)
                                           ->where('category_name',$catName)
                                           ->where('store_id',$this->sdc->storeID())
                                           ->first();
                $checkExProduct_wcid_data->category_id=$catID;
                $checkExProduct_wcid_data->save();


                $checkExProduct=$checkExProduct_wcid;
            }
        }

        if($checkExProduct>0)
        {
            $tab=Product::where('name',$request->name)
                        //->where('general_sale',1)
                        ->where('category_id',$catID)
                        ->where('category_name',$catName)
                        ->where('store_id',$this->sdc->storeID())
                        ->first();
        }
        else
        {
            $prodetail=$request->name;
            if(isset($request->detail))
            {
                $prodetail=$request->detail;
            }

            $tab=new Product;
            $tab->name=$request->name;
            $tab->detail=$prodetail;
            $tab->quantity=1;
            $tab->category_id=$catID;
            $tab->category_name=$catName;
            $tab->price=$request->price;
            $tab->cost=$request->cost_price;
            $tab->general_sale=1;
            $tab->store_id=$this->sdc->storeID();
            $tab->created_by=$this->sdc->UserID();
            $tab->save();
        }

        $pid=$tab->id;
        $this->sdc->log("product","Repair Product created from POS for general sale.");
        return response()->json($pid);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    private function datatableProductCount($search=''){

        $tab=Product::select('id','category_name','barcode','name','quantity','price','cost','created_at')
                          ->where('store_id',$this->sdc->storeID())
                          ->where('general_sale',0)
                          ->orderBy('id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('category_name','LIKE','%'.$search.'%');
                            $query->orWhere('barcode','LIKE','%'.$search.'%');
                            $query->orWhere('name','LIKE','%'.$search.'%');
                            $query->orWhere('quantity','LIKE','%'.$search.'%');
                            $query->orWhere('price','LIKE','%'.$search.'%');
                            $query->orWhere('cost','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');

                            return $query;
                          })
                          ->count();
        return $tab;
    }

    private function datatableProduct($start, $length,$search=''){

        $tab=Product::select('id','category_name','barcode','name','quantity','price','cost','created_at')
                          ->where('store_id',$this->sdc->storeID())
                          ->where('general_sale',0)
                          ->orderBy('id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('category_name','LIKE','%'.$search.'%');
                            $query->orWhere('barcode','LIKE','%'.$search.'%');
                            $query->orWhere('name','LIKE','%'.$search.'%');
                            $query->orWhere('quantity','LIKE','%'.$search.'%');
                            $query->orWhere('price','LIKE','%'.$search.'%');
                            $query->orWhere('cost','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');

                            return $query;
                          })
                          ->skip($start)->take($length)->get();
        return $tab;
    }


    public function datatableProductjson(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->datatableProductCount($search); // get your total no of data;
        $members = $this->datatableProduct($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

    }



    public function show(Request $request,Product $product)
    {

        $category_id='';
        if(isset($request->category_id))
        {
            $category_id=$request->category_id;
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
            $dateString="CAST(lsp_products.created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }

        $cattab=Category::where('store_id',$this->sdc->storeID())->get();

        if(empty($category_id) && empty($start_date) && empty($end_date) && empty($dateString))
        {
            /*$tab=$product::where('store_id',$this->sdc->storeID())
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->when($category_id, function ($query) use ($category_id) {
                            return $query->where('category_id',$category_id);
                     })
                     ->where('general_sale',0)
                     ->orderBy('id','DESC')
                     ->take(100)
                     ->get();*/
            $tab=array();
        }
        else
        {
            $tab=$product::where('store_id',$this->sdc->storeID())
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->when($category_id, function ($query) use ($category_id) {
                            return $query->where('category_id',$category_id);
                     })
                     ->where('general_sale',0)
                     ->get();

            //dd($tab);
        }

        
        return view('apps.pages.product.list',[
                                                'dataTable'=>$tab,
                                                'cattab'=>$cattab,
                                                'start_date'=>$start_date,
                                                'end_date'=>$end_date,
                                                'category_id'=>$category_id
                                              ]);
    }

    public function report(Product $product, request $request)
    {
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
            $dateString="CAST(lsp_products.created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }

        if(empty($start_date) && empty($end_date) && empty($dateString))
        {
            /*$invoice = Product::where('products.store_id',$this->sdc->storeID())
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->orderBy("products.id","DESC")
                     ->take(100)
                     ->get();*/

            $invoice=array();
        }
        else
        {
            $invoice = Product::where('products.store_id',$this->sdc->storeID())
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->orderBy("products.id","DESC")
                     ->get();
        }

        
         // dd($invoice);            
        return view('apps.pages.product.report',
            [
                'dataTable'=>$invoice,
                'start_date'=>$start_date,
                'end_date'=>$end_date
            ]);
    }

    private function productStatusReportCount($search=''){

        $tab=Product::select('id','name','quantity','price','cost','created_at')
                          ->where('store_id',$this->sdc->storeID())
                          ->orderBy('id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('name','LIKE','%'.$search.'%');
                            $query->orWhere('quantity','LIKE','%'.$search.'%');
                            $query->orWhere('price','LIKE','%'.$search.'%');
                            $query->orWhere('cost','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');
                            return $query;
                          })
                          ->count();
        return $tab;
    }

    private function productStatusReport($start, $length,$search=''){

        $tab=Product::select('id','name','quantity','price','cost','created_at')
                          ->where('store_id',$this->sdc->storeID())
                          ->orderBy('id','DESC')
                          ->when($search, function ($query) use ($search) {
                            $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('name','LIKE','%'.$search.'%');
                            $query->orWhere('quantity','LIKE','%'.$search.'%');
                            $query->orWhere('price','LIKE','%'.$search.'%');
                            $query->orWhere('cost','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');
                            return $query;
                          })
                          ->skip($start)->take($length)->get();
        return $tab;
    }


    public function productStatusReportjson(Request $request){

        

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->productStatusReportCount($search); // get your total no of data;
        $members = $this->productStatusReport($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

    }

    public function ExportReport(request $request){
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
            $dateString="CAST(lsp_products.created_at as date) BETWEEN '".$start_date."' AND '".$end_date."'";
        }

        $invoice = Product::where('products.store_id',$this->sdc->storeID())
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->orderBy("products.id","DESC")
                     ->get();
        return $invoice;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function ExcelReport(Request $request) 
    {
        // dd($request);
        //excel 
        $data=array();
        $array_column=array('Product ID','Product Name','Quantity IN Stock','Price','Cost','Total Price','Total Cost','Product Date');
        array_push($data, $array_column);
        $inv=$this->ExportReport($request);
        foreach($inv as $voi):
            $inv_arry=array($voi->id,$voi->name,$voi->quantity,$voi->price,$voi->cost,$voi->price*$voi->quantity,$voi->cost*$voi->quantity,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $reportName="Product Report";
        $report_title="Product Report";
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


    public function PdfReport(Request $request)
    {

        $data=array();
        
       
        $reportName="Product Report";
        $report_title="Product Report";
        $report_description="Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >Product ID</th>
                <th class="text-center" style="font-size:12px;" >Product Name</th>
                <th class="text-center" style="font-size:12px;" >Quantity IN Stock</th>
                <th class="text-center" style="font-size:12px;" >Price</th>
                <th class="text-center" style="font-size:12px;" >Cost</th>
                <th class="text-center" style="font-size:12px;" >Total Price</th>
                <th class="text-center" style="font-size:12px;" >Total Cost</th>
                <th class="text-center" style="font-size:12px;" >Product Date</th>
                </tr>
                </thead>
                <tbody>';

                    $inv=$this->ExportReport($request);
                    foreach($inv as $voi):
                        $html .='<tr>
                        <td style="font-size:12px;" class="text-center">'.$voi->id.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->name.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->quantity.'</td>
                        <td style="font-size:12px;" class="text-center">'.$voi->price.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->cost.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->price*$voi->quantity.'</td>
                        <td style="font-size:12px;" class="text-right">'.$voi->cost*$voi->quantity.'</td>
                        <td style="font-size:12px;" class="text-right">'.formatDateTime($voi->created_at).'</td>
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
    
    public function edit(Product $product,$id=0)
    {
        $existing_cat=Category::where('store_id',$this->sdc->storeID())->get();
        $tab=$product::find($id);
        //dd($tab);
        //$tabData=$product::where('store_id',$this->sdc->storeID())->get();
        $chk=ProductSettings::where('store_id',$this->sdc->storeID())->count();
        if($chk==0)
        {
            return view('apps.pages.product.product',['existing_cat'=>$existing_cat,'dataRow'=>$tab,'edit'=>true]);
        }
        else
        {
            $chkPS=ProductSettings::where('store_id',$this->sdc->storeID())->first();
            return view('apps.pages.product.product',['existing_cat'=>$existing_cat,'dataRow'=>$tab,'chkPS'=>$chkPS,'edit'=>true]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product,$id=0)
    {
         $this->validate($request,[
            'category_id'=>'required|integer',
            'name'=>'required',
            'barcode'=>'required',
            'quantity'=>'required|integer',
            'price'=>'required|numeric',
            'cost'=>'required|numeric',
        ]);

        $pro=$product::find($id);
        $catInfo=Category::find($pro->category_id);
        if(isset($catInfo))
        {
            $catInfo->product=$catInfo->product-1;
            $catInfo->save();
        }

        RetailPosSummary::where('id',1)
        ->update([
           'product_item_quantity' => \DB::raw('product_item_quantity - 1'),
           'product_quantity' => \DB::raw('product_quantity - '.$pro->quantity),
           'stockin_product_quantity' => \DB::raw('stockin_product_quantity - '.$pro->quantity),
        ]);
        
        $invoice_date=date('Y-m-d',strtotime($pro->created_at));
        $Todaydate=date('Y-m-d');
        if((RetailPosSummaryDateWise::where('report_date',$Todaydate)->count()==1) && ($invoice_date==$Todaydate))
        {
            RetailPosSummaryDateWise::where('report_date',$Todaydate)
            ->update([
               'product_item_quantity' => \DB::raw('product_item_quantity - 1'),
               'product_quantity' => \DB::raw('product_quantity - '.$pro->quantity),
               'stockin_product_quantity' => \DB::raw('stockin_product_quantity - '.$pro->quantity)
            ]);
        }

        $this->sdc->log("product","Product updated"); 

        $cat_name='';
        $catInfo=Category::find($request->category_id);
        if(isset($catInfo))
        {
            $cat_name=$catInfo->name;
            $catInfo->product=$catInfo->product+1;
            $catInfo->save();
        }

        $tab=$product::find($id);
        $tab->category_id=$request->category_id;
        $tab->category_name=$cat_name;
        $tab->name=$request->name;
        $tab->barcode=$request->barcode;
        $tab->quantity=$request->quantity;
        $tab->price=$request->price;
        $tab->cost=$request->cost;
        $tab->updated_by=$this->sdc->UserID();
        $tab->save();

        $tab_stock=new ProductStockin;
        $tab_stock->product_id=$id;
        $tab_stock->quantity=$request->quantity;
        $tab_stock->price=$request->price;
        $tab_stock->cost=$request->cost;
        $tab_stock->updated_by=$this->sdc->UserID();
        $tab_stock->save();

        RetailPosSummary::where('id',1)
        ->update([
           'product_item_quantity' => \DB::raw('product_item_quantity + 1'),
           'product_quantity' => \DB::raw('product_quantity + '.$request->quantity),
           'stockin_product_quantity' => \DB::raw('stockin_product_quantity + '.$request->quantity),
        ]);

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

        return redirect('product')->with('status', $this->moduleName.' updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product,$id=0)
    {
        $pro=$product::find($id);

        RetailPosSummary::where('id',1)
        ->update([
           'product_item_quantity' => \DB::raw('product_item_quantity - 1'),
           'product_quantity' => \DB::raw('product_quantity - '.$pro->quantity),
           'stockin_product_quantity' => \DB::raw('stockin_product_quantity - '.$pro->quantity),
        ]);

        $invoice_date=date('Y-m-d',strtotime($pro->created_at));
        $Todaydate=date('Y-m-d');
        if((RetailPosSummaryDateWise::where('report_date',$Todaydate)->count()==1) && ($invoice_date==$Todaydate))
        {
            RetailPosSummaryDateWise::where('report_date',$Todaydate)
            ->update([
               'product_item_quantity' => \DB::raw('product_item_quantity - 1'),
               'product_quantity' => \DB::raw('product_quantity - '.$pro->quantity),
               'stockin_product_quantity' => \DB::raw('stockin_product_quantity - '.$pro->quantity)
            ]);
        }
        $this->sdc->log("product","Product deleted");
        $tab=$product::find($id);
        $tab->delete();
        return redirect('product')->with('status', $this->moduleName.' Deleted Successfully !');
    }
    public function importProduct(){
        return view('apps.pages.product.import');
    }
    
    public function importProductSave(request $request){
        ini_set('max_execution_time', '0');
        $filename="";
        if (!empty($request->file('importfile'))) {
            $img = $request->file('importfile');
            $upload = 'upload/product_import';
            //$filename=$img->getClientOriginalName();
            $filename = time() . "." . $img->getClientOriginalExtension();
            $success = $img->move($upload, $filename);

            $rows = Excel::load($upload.'/'. $filename)->get();
            $count_insert=0;
            if(isset($rows))
            {
                foreach ($rows as $key => $row) 
                {
                    $catInfoCount=Category::where('name',trim($row->category_name))->where('store_id',$this->sdc->storeID())->count();
                    if($catInfoCount==0)
                    {
                        $catInfo=new Category();
                        $catInfo->name=trim($row->category_name);
                        $catInfo->store_id=$this->sdc->storeID();
                        $catInfo->created_by=$this->sdc->UserID();
                        $catInfo->save();
                    }
                    
                    $catInfo=Category::where('name',trim($row->category_name))->where('store_id',$this->sdc->storeID())->first();
                    
                    if(isset($catInfo))
                    {
                        $cat_name=$catInfo->name;
                        $catInfo->product=$catInfo->product+1;
                        $catInfo->save(); 

                        $tab=new Product;
                        $tab->category_id=$catInfo->id;
                        $tab->category_name=$cat_name;
                        $tab->name=$row->product_name;
                        $tab->barcode=$row->barcode;
                        $tab->quantity=$row->quantity_in_stock;
                        $tab->price=$row->price_per_item;
                        $tab->cost=$row->cost_per_item;
                        $tab->store_id=$this->sdc->storeID();
                        $tab->created_by=$this->sdc->UserID();
                        $tab->save();
                        $count_insert+=1;
                    }

                    
                }
            }

            if($count_insert>0)
            {
                return redirect('product/import')->with('status', $this->moduleName.' all data ('.$count_insert.') Added Successfully !');
            }
            else
            {
                return redirect('product/import')->with('error', $this->moduleName.' no record inserted !');
            }
        }
        else
        {
         return redirect('product/import')->with('error', $this->moduleName.' failed to upload !');
        }
    }

    public function productProfitSQL($request)
    {
        $product_id='';
        if(isset($request->product_id))
        {
            $product_id=$request->product_id;
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

        if(empty($product_id) && empty($dateString))
        {
            $invoice=Product::where('store_id',$this->sdc->storeID())
                     ->when($product_id, function ($query) use ($product_id) {
                            return $query->where('id','=', $product_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->orderBy('id','DESC')
                     ->take(100)
                     ->get();
        }
        else
        {
            $invoice=Product::where('store_id',$this->sdc->storeID())
                     ->when($product_id, function ($query) use ($product_id) {
                            return $query->where('id','=', $product_id);
                     })
                     ->when($dateString, function ($query) use ($dateString) {
                            return $query->whereRaw($dateString);
                     })
                     ->get();
        }


        

        return $invoice;
    }

    public function indexProfit(Request $request)
    {
        $product_id='';
        if(isset($request->product_id))
        {
            $product_id=$request->product_id;
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

        if(empty($product_id) && empty($start_date) && empty($end_date)){
            $invoice=array();
        }else{
            $invoice=$this->productProfitSQL($request);
        }

        

        $tab_customer=Product::where('store_id',$this->sdc->storeID())->get();
   

        return view('apps.pages.report.product-profit',
            [
                'product_id'=>$product_id,
                'product'=>$tab_customer,
                'invoice'=>$invoice,
                'start_date'=>$start_date,
                'end_date'=>$end_date
            ]);
    }

    private function methodToProductProfitCount($search=''){

        $tab=Product::select('id','name','sold_times','cost','price','created_at')
                     ->where('store_id',$this->sdc->storeID())
                     ->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                        $query->orWhere('name','LIKE','%'.$search.'%');
                        $query->orWhere('sold_times','LIKE','%'.$search.'%');
                        $query->orWhere('cost','LIKE','%'.$search.'%');
                        $query->orWhere('price','LIKE','%'.$search.'%');
                        $query->orWhere('created_at','LIKE','%'.$search.'%');
                        return $query;
                     })
                     ->count();
        return $tab;
    }

    private function methodToProductProfit($start, $length,$search=''){

        $tab=Product::select('id','name','sold_times','cost','price','created_at')
                     ->where('store_id',$this->sdc->storeID())
                     ->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                        $query->orWhere('name','LIKE','%'.$search.'%');
                        $query->orWhere('sold_times','LIKE','%'.$search.'%');
                        $query->orWhere('cost','LIKE','%'.$search.'%');
                        $query->orWhere('price','LIKE','%'.$search.'%');
                        $query->orWhere('created_at','LIKE','%'.$search.'%');
                        return $query;
                     })
                     ->skip($start)->take($length)->get();
        return $tab;
    }


    public function dataProductProfitjson(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->methodToProductProfitCount($search); // get your total no of data;
        $members = $this->methodToProductProfit($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

    }

    public function exportProfit(Request $request) 
    {

        //excel 
        $data=array();
        $array_column=array('Product ID','Name','Sold Quantity','Total Cost','Total Sales Amount','Total Profit','Created Date');
        array_push($data, $array_column);
        $inv=$this->productProfitSQL($request);
        foreach($inv as $voi):
            $inv_arry=array($voi->id,$voi->name,$voi->sold_times,($voi->sold_times*$voi->cost),($voi->sold_times*$voi->price),(($voi->sold_times*$voi->price)-($voi->sold_times*$voi->cost)),formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $reportName="Product Profit Report";
        $report_title="Product Profit Report";
        $report_description="Product Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));
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


    public function invoicePDFProfit(Request $request)
    {

        $data=array();
        
       
        $reportName="Product Profit Report";
        $report_title="Product Profit Report";
        $report_description="Product Report Genarated : ".formatDateTime(date('d-M-Y H:i:s a'));

        $html='<table class="table table-bordered" style="width:100%;">
                <thead>
                <tr>
                <th class="text-center" style="font-size:12px;" >ID</th>
                <th class="text-center" style="font-size:12px;" >Name</th>
                <th class="text-center" style="font-size:12px;" >Sold Quantity</th>
                <th class="text-center" style="font-size:12px;" >Total Cost</th>
                <th class="text-center" style="font-size:12px;" >Total Sales Amount</th>
                <th class="text-center" style="font-size:12px;" >Total Profit</th>
                <th class="text-center" style="font-size:12px;" >Created AT</th>
                </tr>
                </thead>
                <tbody>';



                    $inv=$this->productProfitSQL($request);
                    foreach($inv as $index=>$voi):
    
                        $html .='<tr>
                        <td>'.$voi->id.'</td>
                        <td>'.$voi->name.'</td>
                        <td>'.$voi->sold_times.'</td>
                        <td>'.$voi->sold_times*$voi->cost.'</td>
                        <td>'.$voi->sold_times*$voi->price.'</td>
                        <td>'.(($voi->sold_times*$voi->price)-($voi->sold_times*$voi->cost)).'</td>
                        <td>'.formatDateTime($voi->created_at).'</td>
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

}
