@extends('apps.layout.master')
@section('title','Point of Sales')
@section('content')

<section id="form-action-layouts">
    <?php 
        $userguideInit=StaticDataController::userguideInit();
    ?>
	<div class="row">
		<div class="col-lg-7 col-md-12 pos-product-display" style="min-height: 700px;">
            <div id="cartMessageProShow" style="display: block;"></div>
          

        <style type="text/css">
            .border-radius-button
            {
                -webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.5);
                -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.5);
                box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.5);
                -webkit-border-radius: 4px;
                -moz-border-radius: 4px;
                border-radius: 4px;
                font-weight: 600;
            }

            .add-pos-cart {
              min-height: 50px !important;
              line-height: 50px !important;
              text-align: center;
              border: 1px solid #123456;
              margin-bottom:5px;
            }
            .add-pos-cart > span {
              display: inline-block;
              vertical-align: middle;
              line-height: normal;
            }
        </style>
        <div class="row">
            <div class="col-md-12" @if($userguideInit==1) data-step="6" data-intro="Here you will have categories which you have created. Also after you click on category it will show all the product on top & after you click on product it will add on POS Cart." @endif>
                
                
                <div class="col-md-6" @if($userguideInit==1)  data-step="1" data-intro="Barcode Sales, Product could be sold by barcode." @endif>
                    <form method="post" action="javascript:loadCartProBar();" style="margin-top: -15px;">
                            <label class="col-md-12 text-xs-center"><b>Enter Barcode</b></label>
                            <input type="text"  autocomplete="off" class="form-control col-md-6" name="barcode" placeholder="Enter Your Barcode & Press Enter.">
                    </form>
                </div>
                <div class="col-md-6">
                    <h4 class="page-header"> 
                        <i class="icon-layout"></i> 
                        Categories <hr> 
                    </h4>
                </div>
            </div>

                <div class="col-md-3">
                    <div class="card mb-1">
                        <div class="card-body collapse in">
                            <div class="bg-green bg-lighten-4 height-10"></div>
                            <div class="p-1">
                                <p class="text-xs-left mb-0">
                                    <a href="javascript:void(0);"  data-toggle="modal" data-target="#General_Sale" style="text-decoration: none;">
                                        <i class="icon-database"></i> General Sale
                                    </a>
                                </p>         
                            </div>
                        </div>    
                    </div>
                </div>

            @if(isset($catInfo) && count($catInfo)>0)
                <?php $i=1; ?>
                @foreach($catInfo as $cat)
                @if($cat->name=="Repair")
                    <div class="col-md-3">
                        <div class="card mb-1">
                            <div class="card-body collapse in">
                                <div class="bg-green bg-lighten-{{$i}} height-10"></div>
                                <div class="p-1">
                                    <p class="text-xs-left mb-0">
                                        <a href="javascript:void(0);"  data-toggle="modal" data-target="#instoreRepairModal" style="text-decoration: none;">
                                            <i class="icon-cogs"></i> {{$cat->name}}
                                        </a>
                                    </p>         
                                </div>
                            </div>    
                        </div>
                    </div>
                @elseif($cat->name=="Ticket")
                    <div class="col-md-3">
                        <div class="card mb-1">
                            <div class="card-body collapse in">
                                <div class="bg-green bg-lighten-{{$i}} height-10"></div>
                                <div class="p-1">
                                    <p class="text-xs-left mb-0">
                                        <a href="javascript:void(0);"  data-toggle="modal" data-target="#instoreTicketModal" style="text-decoration: none;">
                                            <i class="icon-cogs"></i> {{$cat->name}}
                                        </a>
                                    </p>         
                                </div>
                            </div>    
                        </div>
                    </div>
                @else
                    <div class="col-md-3">
                        <div class="card mb-1">
                            <div class="card-body collapse in">
                                <div class="bg-green bg-lighten-{{$i}} height-10"></div>
                                <div class="p-1">
                                    <p class="text-xs-left mb-0">
                                        <a href="javascript:loadCatProduct({{$cat->id}});" style="text-decoration: none;">
                                            <i class="icon-chevron-circle-right"></i> {{$cat->name}}
                                        </a>
                                    </p>         
                                </div>
                            </div>    
                        </div>
                    </div>
                @endif
                <?php 
                $i++; 
                if($i==5)
                {
                    $i=1;
                }
                ?>
                @endforeach 
            @else
                <div class="col-md-12">
                    <h2  class="text-xs-center">No categories found. <br>  <br> 
                        <a href="{{url('category')}}" class="btn btn-green"><i class="icon-ios-plus-outline"></i> Create Now</a>
                    </h2>
                </div>
            @endif

            

            
        </div>
        <div class="row" id="defaultProductView">

        <script type="text/javascript">
            .height-30
            {
                height:30px !important;
            }
        </script>
        <span id="product_place"></span>

    </div>
    <hr>
            <div class="row">
                <!-- <div class="col-md-3 col-xs-6 col-sm-3" @if($userguideInit==1) data-step="2" data-intro="General Sale, allows users to create one time sale items for purchase." @endif> 
                    <a class="thumbnail btn-block  bg-green bg-lighten-1" style="line-height: 50px; color: #fff; font-weight: 500; text-align: center;" data-toggle="modal" data-target="#General_Sale"> <i class="icon-database2"></i> General Sale </a>
                </div> -->
                
                <!-- <div class="col-md-3 col-xs-6 col-sm-3 opdStore" @if($drawerStatus==1) style="display: none;" @endif @if($userguideInit==1) data-step="3" data-intro="When you click Open Drawer / Close Drawer button then popup new windows for opening amount to drawer & closing drawer will also have print & close drawer option." @endif> 
                    <a class="thumbnail btn-block bg-green bg-lighten-2"  data-toggle="modal" data-target="#open-drawer" style="line-height: 50px; color: #fff; font-weight: 500; text-align: center;"><i class="icon-hand-grab-o"></i> Open Drawer </a>
                </div>

                <div class="col-md-3 col-xs-6 col-sm-3 cldStore" @if($drawerStatus==0) style="display: none;" @endif> 
                    <a class="thumbnail btn-block bg-green bg-lighten-2" onclick="loadCloseDrawer()" style="line-height: 50px; color: #fff; font-weight: 500; text-align: center;"><i class="icon-hand-grab-o"></i> Close Drawer </a>
                </div>
              -->
                <!-- <div class="col-md-3 col-xs-6 col-sm-3" @if($userguideInit==1) data-step="4" data-intro="Payout, gives users the option to add or deduct cash from the drawer." @endif> 
                    <a class="thumbnail btn-block bg-green bg-lighen-3" style="line-height: 50px; color: #fff; font-weight: 500; text-align: center;" data-toggle="modal" data-target="#payoutModal"> <i class="icon-share-square"></i> Payout </a>
                </div>
                <div class="col-md-3 col-xs-6 col-sm-3" @if($userguideInit==1) data-step="5" data-intro="When you click Time Clock, it will show a popup & give you a option for punch-in/out. User can can see previous punch log by clicking on today punch." @endif> 
                    <a class="thumbnail btn-block bg-green bg-darken-2 btn-block" style="line-height: 50px; color: #fff; font-weight: 500; text-align: center;" data-toggle="modal" data-target="#TimeClockModal"><i class="icon-clock-o"></i> Time Clock </a>
                </div> -->
            </div>
            <style type="text/css">
                .height-10{ height: 10px !important; }
            </style>
            
        </div>
        <style type="text/css">
        /* Desktop 
        media (min-width:960px) {

            .testerPickup {
                position: fixed; top:42px;
            }   

        }*/
        .table td, .table th
        {
            padding: 0.1rem .75rem;
        }
    </style>


    <style type="text/css">
        .paper-cut:after {
          content: " ";
          display: block;
          position: relative;
          top: 0px;
          left: 0px;
          width: 100%;
          height: 36px;
          background: -webkit-linear-gradient(#FFFFFF 0%, transparent 0%), -webkit-linear-gradient(135deg, #e9ebee 33.33%, transparent 33.33%) 0 0%, #e9ebee -webkit-linear-gradient(45deg, #e9ebee 33.33%, #FFFFFF 33.33%) 0 0%;
          background: -o-linear-gradient(#FFFFFF 0%, transparent 0%), -o-linear-gradient(135deg, #e9ebee 33.33%, transparent 33.33%) 0 0%, #e9ebee -o-linear-gradient(45deg, #e9ebee 33.33%, #FFFFFF 33.33%) 0 0%;
          background: -moz-linear-gradient(#FFFFFF 0%, transparent 0%), -moz-linear-gradient(135deg, #e9ebee 33.33%, transparent 33.33%) 0 0%, #e9ebee -moz-linear-gradient(45deg, #e9ebee 33.33%, #FFFFFF 33.33%) 0 0%;
          background-repeat: repeat-x;
          background-size: 0px 100%, 14px 27px, 14px 27px;
        }
    </style>

    <div class="col-lg-5 col-md-12 mr-0 pr-0 dropableCartZone">
        <!-- CSS Classes -->
        <div class="card testerPickup paper-cut" style="margin-top: -20px; margin-bottom: 0px;">
            <div class="card-header" style="padding: 0.50rem 1.5rem !important;">
                <!-- <h4 class="card-title">CSS Classes</h4> -->
                
                <div class="row">
                        @if(isset($ps))
                            @if($ps->pos_defualt_option=="Full Tax")
                                <input type="hidden" name="taxRate" id="taxRate" value="{{$ps->sales_tax}}">
                            @elseif($ps->pos_defualt_option=="Part Tax")
                                <input type="hidden" name="taxRate" id="taxRate" value="{{$ps->sales_part_tax}}">
                            @else
                                <input type="hidden" name="taxRate" id="taxRate" value="0">
                            @endif
                        @else
                            <input type="hidden" name="taxRate" id="taxRate" value="0">
                        @endif

                        <!-- starting group menu ---->
                        
                        <div class="col-sm-4 col-xs-6">
                            <div class="btn-group">
                                <button type="button" class="btn btn-green btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="icon-settings"></i> Other Action
                                </button>
                                <div class="dropdown-menu arrow">
                                    <a href="{{url('sales/invoice/print/pdf/'.$last_invoice_id)}}" class="dropdown-item"><i class="icon-printer green"></i> Print Last Receipt</a>
                                    <button class="dropdown-item" type="button" id="counterStatusChange"><i class="icon-monitor green"></i> 
                                    @if(isset($CounterDisplay))
                                        @if($CounterDisplay==1)   
                                            <span>Turn-off Your Counter Display</span>
                                        @else
                                            <span>Start Your Counter Display</span>
                                        @endif
                                    @else
                                        <span>Start Your Counter Display</span>
                                    @endif
                                    </button>
                                    <button class="dropdown-item" type="button" id="counterPay">
                                        @if(isset($cart->AllowCustomerPayBill)) 
                                                    @if($cart->AllowCustomerPayBill>0) 
                                                        <i class='icon-checkmark green'></i> Allow pay from counter display
                                                    @else
                                                        <i class='icon-close-circled green'></i> Allow pay from counter display
                                                    @endif
                                        @else
                                            <i class='icon-close-circled green'></i> Allow pay from counter display
                                        @endif
                                        
                                    </button>
                                    <button class="dropdown-item" type="button" id="changeSalesView"><i class="icon-layout green"></i> Change Sales View</button>
                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#payoutModal"><i class="icon-share-square green"></i> Payout </button>
                                    <button class="dropdown-item" type="button"  data-toggle="modal" data-target="#TimeClockModal">
                                        <i class="icon-clock-o green"></i> Time Clock 
                                    </button>
                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#salesReturn">
                                        <i class="icon-repeat2 green"></i> Sales Return
                                    </button>
                                    <button class="dropdown-item warranty" type="button"><i class="icon-battery-half green"></i> 
                                    Create Warranty
                                    </button>
                                    <button class="dropdown-item addPartialPayment" type="button"><i class="icon-money green"></i> 
                                    Add Partial Payment
                                    </button>
                                    <button class="dropdown-item buybackpull" type="button"><i class="icon-arrow-return-left green"></i> Create Buyback</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3 col-xs-6">
                            <div class="btn-group">
                                <button type="button" class="btn btn-green  btn-block" @if($userguideInit==1) data-step="7" data-intro="The Discount button, gerenates a popup that allows you to discount an item." @endif data-toggle="modal" data-target="#Discount">
                                % Discount
                                </button>
                            </div>
                        </div>
                        <div class="col-sm-2 col-xs-6">
                            <div class="btn-group">
                                <button type="button" class="btn btn-green  btn-block"   @if($userguideInit==1) data-step="8" data-intro="In this option, you can change your tax option." @endif data-toggle="modal" data-target="#TaxManagement">
                               <i class="icon-cogs"></i> Tax
                                </button>
                            </div>
                        </div>

                        <div class="col-sm-2 col-xs-6">
                            <div class="btn-group">
                                <button type="button" class="btn btn-green  btn-block"   @if($userguideInit==1) data-step="16" data-intro="When you click clear POS button then clear the all POS screen." @endif id="clearsale">
                               <i class="icon-circle-cross"></i> Reset
                                </button>
                            </div>
                        </div>

                        <div class="clearfix"></div>                       
                        <!-- Ending group menu ----->

                </div>
            </div>

            <div class="card-header" style="padding: 0.50rem 1.5rem !important;">

                <div class="row">



                    <div class="col-sm-12 col-xs-12"  @if($userguideInit==1) data-step="12" data-intro="Here you can select your customer. " @endif>

                        <div class="input-group border-green">
                            <span class="input-group-addon addNewCustomerPOS green" id="basic-addon4"><i class="icon-user-plus"></i> New Customer</span>
                            <select style="width: 100%; font-size: 16px !important; font-weight: bolder;" class="select2 form-control" name="customer_id">
                                <option 
                                @if(!isset($cart->customerID))
                                @if(empty($cart->customerID))
                                selected="selected" 
                                @endif
                                @endif

                                value="">SELECT CUSTOMER</option>

                                <option value="0">CREATE NEW CUSTOMER</option>

              
                            </select>
                            
                        </div>


                            
                    </div>



                </div>
            </div>
            <div class="card-body collapse in" @if($userguideInit==1) data-step="11" data-intro="In this section, you see all the product you added also you can see the total, paid amount and due amount. you must be a select customer then you can access other action." @endif>
                <div class="card-blockf">
                    <div class="card-text">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                        <th width="100">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="dataCart" class="">
                                    @if(isset($cart->items))
                                    @foreach($cart->items as $index=>$row)
                                    <tr id="{{$row['item_id']}}">
                                        <td>{{$row['item']}}</td>
                                        <td ondblclick="liveRowCartEdit({{$row['item_id']}})">{{$row['qty']}}</td>
                                        <td ondblclick="liveRowCartEdit({{$row['item_id']}})" data-tax="{{$row['tax']}}"  data-price="{{$row['unitprice']}}">$<span>{{$row['unitprice']}}</span></td>
                                        <td ondblclick="liveRowCartEdit({{$row['item_id']}})">$<span>{{$row['price']}}</span></td>
                                        <td style="width: 83px;">
                                            <a href="javascript:editRowLive({{$row['item_id']}});" title="Edit" class="btn btn-sm btn-outline-green hiddenLiveSave" style="margin-right:2px; display: none;"><i class="icon-pencil22"></i></a>
                                            <a href="javascript:delposSinleRow({{$row['item_id']}});" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                                <tfoot id="posCartSummary">
                                    <tr>
                                        <th>Sub-Total</th>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Sales Tax <code style="background: none;">(+)</code></th>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Discount : <span>0%</span> <code style="color:green; background: none;">(-)</code></th>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2">$<span>0.00</span></td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2">$<span>0.00</span></td>
                                    </tr>
                                    <tr style="display: none;">
                                        <th>Paid</th>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2">$<span>
                                            @if(isset($cart->paid))
                                            {{$cart->paid}}
                                            @else
                                            0.00
                                            @endif
                                        </span></td>
                                    </tr>
                                    <tr style="display: none;">
                                        <th>Due</th>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2">$<span>0.00</span></td>
                                    </tr> 
                                    <tr>
                                        <th colspan="5" align="center">
                                            <!-- <label style="text-align: center; width: 300px; margin-left:15%;">
                                                <input type="checkbox" name="counterPay" id="counterPay" 
                                                @if(isset($cart->AllowCustomerPayBill)) 
                                                    @if($cart->AllowCustomerPayBill>0) 
                                                     checked="checked"   
                                                    @endif 
                                                @endif 
                                            >
                                            Allow Customer Pay  From Counter Display
                                            </label> -->
                                        </th>
                                    </tr>                                 
                                </tfoot>
                            </table>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                       
                        <div class="clearfix"></div>
                        
                    </div>
                </div>
            </div>

            <style type="text/css">
                .hellvetia{
                    font-family: 'Helvetica Neue', 'Nunito', sans-serif;
                    font-weight: 600;
                }
            </style>
            <div class="card-header" style="padding: 0.50rem 1.5rem !important;">

                <div class="row">
                    <div class="col-sm-6 col-xs-6 border-right-green">
                        <div class="col-md-12" style="padding:0px; margin: 0px;">
                            <h2 class="gray hellvetia text-xs-center" style="padding:0px; margin: 0px;">Total</h2>
                        </div>
                        <div class="col-md-12" style="padding:0px; margin: 0px;">
                            <h3 class="text-xs-center green" style="padding:0px;  margin: 0px;">$<span id="totalCartDueToPay">0.00</span></h3>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <div class="col-md-12"><h2 class="gray hellvetia text-xs-center">Amount Due</h2></div>
                        <div class="col-md-12" style="padding:0px; margin: 0px;">
                            <h3 class="text-xs-center yellow" style="padding:0px; margin: 0px;">$0.00</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-header" style="padding:0rem !important; display: none">
                <table class="table">
                    <tr>
                        <td><i class="icon-close-circled"></i></td>
                        <td>Cash</td>
                        <td></td>
                                        <td></td>
                        <td>$<span>0.00</span></td>
                    </tr>
                </table>
            </div>

            <div class="card-header" style="padding: 0.50rem 1.5rem !important;">

                <div class="row">
                    <style type="text/css">
                            .select2-container--default .select2-selection--single .select2-selection__rendered
                            {
                                font-weight: bolder !important;
                                text-align: center !important;
                                font-size: 16px !important;
                            }
                        </style>
                        <div class="col-xs-12 button-group">
                            @include('apps.include.modal.pos_quick_link')
                        </div>
                </div>
            </div>



        </div>
        <!--/ All Modal -->
        <!--Edit Product Start-->
          @include('apps.include.modal.editliveProduct')
          @include('apps.include.modal.editProduct')
         
<!--Edit Product End-->
<!--New Customer Start-->
        
<!--New Customer End-->

<!-- Modal for General Sale-->

<!-- Modal for Cash Out-->

           @include('apps.include.modal.new-customer')
           @include('apps.include.modal.generalsaleModal')
           @include('apps.include.modal.payout')
           @include('apps.include.modal.cash-out')
           @include('apps.include.modal.cashoutModal')
           @include('apps.include.modal.discountModal')
           @include('apps.include.modal.taxModal',compact('ps'))
           @include('apps.include.modal.CustomerCardModal')
           @include('apps.include.modal.stripeCardModal',compact('stripe'))
           @include('apps.include.modal.cardPointeCardModal')
           @include('apps.include.modal.cardPointepartialCardModal')
           {{-- @include('apps.include.modal.CustomerPartialCardModal') --}}
           @include('apps.include.modal.paymodal',compact('stripe'))
           @include('apps.include.modal.open-drawer')
           @include('apps.include.modal.close-drawer')
           @include('apps.include.modal.time_clock')
           @include('apps.include.modal.instorerepair',compact('ticketAsset'))
           @include('apps.include.modal.instoreticket',compact('ticketAsset','problem'))
           @include('apps.include.modal.salesReturn')
           @include('apps.include.modal.warranty')
           @include('apps.include.modal.buyback')
           @include('apps.include.modal.pospaymentpartial')


        </div>
    </div>
</section>
@endsection



@section('counter-display-css')
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/plugins/forms/extended/form-extended.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/toggle/switchery.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/plugins/forms/switch.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/core/colors/palette-switch.min.css')}}">
@endsection

@section('counter-display-js')
<script src="{{url('theme/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/vendors/js/forms/toggle/switchery.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/switch.min.js')}}" type="text/javascript"></script>

@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('assets/css/pos.css')}}">
<style type="text/css">
.one-make-full
{
    line-height:3.8rem !important;
}

.two-make-full
{
    line-height:1.8rem !important;
}

.third-make-full
{
    line-height:1.3rem !important;
}
</style>
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/selects/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/css/pages/invoice.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/ui/dragula.min.css')}}">
@endsection

@section('js')
<script src="{{url('theme/app-assets/vendors/js/forms/extended/card/jquery.card.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/extended/form-typeahead.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/extended/form-inputmask.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/extended/form-formatter.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/extended/form-maxlength.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/extended/form-card.min.js')}}" type="text/javascript"></script>



<script src="{{url('theme/app-assets/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{url('theme/app-assets/js/scripts/forms/select/form-select2.min.js')}}" type="text/javascript"></script>


<script src="{{url('theme/app-assets/vendors/js/extensions/dragula.min.js')}}" type="text/javascript"></script>
<!-- <script src="{{url('theme/app-assets/js/scripts/cards/draggable.min.js')}}" type="text/javascript"></script> -->
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js" ></script>
<script>
//editRowLive
    var productJson=<?php echo json_encode($product); ?>;
    var modelJson=<?php echo json_encode($model); ?>;
    var problemJson=<?php echo json_encode($problem); ?>;
    var estPriceJson=<?php echo json_encode($estPrice); ?>;
    var cusObjData=<?php echo json_encode($customerData); ?>;

    $(document).ready(function(){
        //$(".draggablePOSItem").draggable();
        //$(".dropableCartZone").droppable();



    });

  

    $('.dropableCartZone').droppable( {
        drop: handleDropEvent
    } ); 


    $('select[name=customer_id]').parent('div').children('span:eq(1)').children('span').children('span').attr('style','border-radius:0px !important;');

    function handleDropEvent( event, ui ) {
        $("#cartMessageProShow").html(loadingOrProcessing("Processing, Please Wait....!!!!"));
        var item_id=ui.draggable.attr("id");
        console.log('ItemID=',item_id);

        var data_pro_id=$("#"+item_id).attr("data-pro-id");
        var data_pro_name=$("#"+item_id).attr("data-pro-name");
        var data_pro_name=data_pro_name.replace(/'/g, "");;
        var data_pro_price=$("#"+item_id).attr("data-pro-price");
        //console.log('string in JS = ',exTasl);
        add_pos_cart(data_pro_id,data_pro_price,data_pro_name);
        //add_pos_cart
        //$("#"+item_id).trigger( "click" )
        //alert(ui.draggable.attr("id"));
       // Here I want the id of the dropped object
    }

    function loadCustomerList()
    {
        var ff="<option ";
        var fff="<option ";
    
        @if(!isset($cart->customerID))
            @if(empty($cart->customerID))
                ff+="selected='selected' "; 
                fff+="selected='selected' "; 
            @endif
        @endif

        ff+=" value=''>SELECT CUSTOMER</option>";
        fff+=" value=''>SELECT CUSTOMER</option>";
        ff+='<option value="0">CREATE NEW CUSTOMER</option>';
        var defCusID=0;
        @if(isset($cart->customerID))
                defCusID="<?php echo $cart->customerID; ?>";
        @endif

        $.each(cusObjData,function(index,row){
            //console.log(row);  

            if(defCusID==row.id)
            {
                ff+="<option selected='selected' value='"+row.id+"'>"+row.name+"</option>";
                fff+="<option selected='selected' value='"+row.id+"'>"+row.name+"</option>";
            }
            else
            {
                ff+="<option value='"+row.id+"'>"+row.name+"</option>";
                fff+="<option value='"+row.id+"'>"+row.name+"</option>";
            }

            
        });

        $("select[name=customer_id]").html(ff);
        $("select[name=sales_return_customer_id]").html(fff);
        $("select[name=buyback_customer_id]").html(fff);
        //$("select[name=partialpay_customer_id]").html(fff);

        $("select[name=sales_return_customer_id]").select2({
             dropdownParent: $("#salesReturn")
        });
        
        $("select[name=sales_return_sales_invoice_id]").select2({
             dropdownParent: $("#salesReturn")
        });


        ff="";
        fff="";
    }

    function liveRowCartEdit(rowID)
    {
        var rowData=$("#"+rowID).children("td:eq(1)").html();
        if($("#"+rowID).children("td:eq(1)").children("input").val())
        {

            console.log(rowData);
        }
        else
        {
            var rowDataPrice=$("#"+rowID).children("td:eq(2)").find("span").html();
            var inputDataQuantity='<input type="text" style="width:50px;" value="'+rowData+'" onkeyup="updateLiveCartQuantity('+rowID+')"  onchange="updateLiveCartQuantity('+rowID+')" />';
            var inputDataPrice='<input type="text"  style="width:50px;"  value="'+rowDataPrice+'" onkeyup="updateLiveCartQuantity('+rowID+')"  onchange="updateLiveCartQuantity('+rowID+')" />';
            $("#"+rowID).children("td:eq(1)").html(inputDataQuantity);
            $("#"+rowID).children("td:eq(2)").find("span").html(inputDataPrice);
            $("#"+rowID).children("td:eq(4)").children("a:eq(0)").show();
        }
        
    }

    function alignProductLine()
    {
        $.each($(".add-pos-cart"),function(index,row){
            var charStr=$.trim($(row).html()).length;
            if(charStr<=15)
            {
                $(row).addClass('one-make-full');
            }
        });
    }

    function storecloseLTTheme(name,price)
    {
        var conPrice=parseFloat(price).toFixed(2);
        var data='<tr><td align="left">'+name+' Collected (+) :  </td><td align="left">$'+conPrice+'</td></tr>';
        return data;
    }

    function loadCloseDrawer()
    {
        $("#closeStoreMsg").html("");
        $("#close-drawer").modal('show');
        //------------------------Ajax Customer Start-------------------------//
         var AddHowMowKhaoUrl="{{url('/transaction/store')}}";
         $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddHowMowKhaoUrl,
            'data': {'_token':"{{csrf_token()}}"},
            'success': function (data) {
                console.log(data);
                var salesTotal=parseFloat(data.salesTotal).toFixed(2);
                var totalTax=parseFloat(data.totalTax).toFixed(2);
                var opening_amount=parseFloat(data.opening_amount).toFixed(2);
                var totalPayout=parseFloat(data.totalPayout).toFixed(2);
                var totalbuyback=parseFloat(data.buyback).toFixed(2);

                var currectStoreTotal=(salesTotal-0)+(opening_amount-0)+(totalPayout-0)-totalbuyback;

                    currectStoreTotal=parseFloat(currectStoreTotal).toFixed(2);

                $("#storeCloseDate").html(data.opening_time);
                $("#storeCloseTotalCollection").html(salesTotal);
                $("#storeCloseOpeningAmount").html(opening_amount);
                $("#storeCloseTaxAmount").html(totalTax);
                $("#totalPayout").html(totalPayout);
                $("#buybackStoreClosingAmount").html(totalbuyback);

                //storeCloseTableTenderList
                var salesDataTendr=data.totalSalesTender;
                var salesDataTendrLength=salesDataTendr.length;
                if(salesDataTendrLength>0)
                {
                    var htmlSalesString='';
                    $("#storeCloseTableTenderList").html(htmlSalesString);
                    $.each(salesDataTendr,function(key,row){
                        console.log(row);
                        htmlSalesString+=storecloseLTTheme(row.tender_name,row.tender_total);
                    });
                    $("#storeCloseTableTenderList").html(htmlSalesString);
                }

                $("#currectStoreTotal").html(currectStoreTotal);

                $("#openStoreMsg").html("");
            }
        });
        //------------------------Ajax Customer End---------------------------//
    }


    function paginationPerfect()
    {
        $(".pagination").addClass("pagination-round");
        $.each($(".pagination").find("li"),function(index,row){
            $(row).addClass("page-item");
            $(row).children("a").addClass("page-link");
            //$(row).children("a").addClass("page-link");
            if($(row).attr("class")=="active page-item")
            {
                var getPageNumber=$.trim($(row).children("span").html());
                $(row).html('<a href="javascript:void(0);" class="page-link">'+getPageNumber+'</a>');
            }

            /*if($(row).attr("class")=="disabled page-item")
            {
                $(row).html('<a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">Next »</span><span class="sr-only">Next</span></a>');
            }*/



            if($.trim($(row).children("span").html()).length>0)
            {
                if($.trim($(row).children("span").html())=="«")
                {
                    var getPageNumber=$.trim($(row).children("span").html());
                        //console.log(getPageNumber);
                        $(row).html('<a class="page-link" href="#" aria-label="Prev"><span aria-hidden="true">« Prev</span><span class="sr-only">Prev</span></a>');
                    }
                    
                    if($.trim($(row).children("span").html())=="»")
                    {
                        var getPageNumber=$.trim($(row).children("span").html());
                        //console.log(getPageNumber);
                        $(row).html('<a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">Next »</span><span class="sr-only">Next</span></a>');
                    }
                    
                }

                if($.trim($(row).children("a").html()).length>0)
                {
                    if($.trim($(row).children("a").html())=="«")
                    {
                        var getPageNumber=$.trim($(row).children("a").append(" Prev"));
                        console.log(getPageNumber);
                        //$(row).html('<a class="page-link" href="#" aria-label="Prev"><span aria-hidden="true">« Prev</span><span class="sr-only">Prev</span></a>');
                    }
                    
                    if($.trim($(row).children("a").html())=="»")
                    {
                        var getPageNumber=$.trim($(row).children("a").html("Next »"));
                        console.log(getPageNumber);
                        //$(row).html('<a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">Next »</span><span class="sr-only">Next</span></a>');
                    }
                    
                }
                


            });
    }

    function checkerCounterST()
    {
        var counterStatus=0;
        var counterString=$("#counterStatusChange").children("span").html();
        if(counterString=="Start Your Counter Display")
        {
            counterStatus=1;
            $("#counterStatusChange").children("span").html("Turn-off Your Counter Display");
        }
        else
        {
            $("#counterStatusChange").children("span").html("Start Your Counter Display");
        }

        //------------------------Ajax Customer Start-------------------------//
         var AddHowMowKhaoUrl="{{url('counter-display-status-change')}}";
         $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddHowMowKhaoUrl,
            'data': {'counterStatus':counterStatus,'_token':"{{csrf_token()}}"},
            'success': function (data) {
                console.log("Counter Display Status : "+data)
            }
        });
        //------------------------Ajax Customer End---------------------------//
    }


    function loadingOrProcessing(sms)
    {
        var strHtml='';
            strHtml+='<div class="alert alert-icon-right alert-green alert-dismissible fade in mb-2" role="alert">';
            strHtml+='      <i class="icon-spinner10 spinner"></i> '+sms;
            strHtml+='</div>';

            return strHtml;

    }

    function warningMessage(sms)
    {
        var strHtml='';
            strHtml+='<div class="alert alert-icon-left alert-danger alert-dismissible fade in mb-2" role="alert">';
            strHtml+='<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            strHtml+='<span aria-hidden="true">×</span>';
            strHtml+='</button>';
            strHtml+=sms;
            strHtml+='</div>';
            return strHtml;
    }

    function successMessage(sms)
    {
        var strHtml='';
            strHtml+='<div class="alert alert-icon-left alert-success alert-dismissible fade in mb-2" role="alert">';
            strHtml+='<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            strHtml+='<span aria-hidden="true">×</span>';
            strHtml+='</button>';
            strHtml+=sms;
            strHtml+='</div>';
            return strHtml;
    }

    function loadCartProBar()
    {
        console.log("Action Perform");
        var barcode=$("input[name=barcode]").val();
        console.log(barcode);
        //$('.barcode').click();
        //$('#ajaxCart').click();

        if(barcode.length==0)
        {
            // alert('Please Type a Barcode No.!!!');
            $("#cartMessageProShow").html(warningMessage("Please Type a Barcode No.!!!"));
            return false;
        }
        $("#cartMessageProShow").html(loadingOrProcessing("Product adding to cart, Please Wait....!!!!"));
        var productFound=0;
        $.each(productJson,function(rindex,row){
            if(row.barcode==barcode)
            {
                console.log(row); 
                $("#qty").val(1);
                $("#stoke").val(row.quantity);
                $("#price").val(row.price);
                $("#product_name").val(row.name);
                //$("#rate").val(row.cost);
                $("#imei").val(row.imei);
                $("#brand").val(row.brand_name);
                $("#model").val(row.model_name);
                $("#pro_id").val(row.id);
                productFound=1;
                add_pos_cart(row.id,row.price,row.name);
            }
        });

        $("input[name=barcode]").val("");
        $("input[name=barcode]").focus();

        if(productFound==0)
        {
            // alert('Please Type a Barcode No.!!!');
            $("#cartMessageProShow").html(warningMessage("Please Type a Correct Barcode No.!!!"));
            return false;
        }
    }

    function loadCatProduct(cid)
    {
        var cid=parseInt(cid);
        if(cid>0)
        {
            $("#product_place").html(loadingOrProcessing("Loading Please Wait....!!!!"));
            var proHtml='';
            var productBgIn=1;
            var moveavleArray=[];
            $.each(productJson,function(rindex,row){
                if(row.category_id==cid)
                {

                    var dt = new Date();
                    var moveableID = row.id+''+dt.getHours() +''+ dt.getMinutes()+''+dt.getSeconds();
                    moveavleArray.push(moveableID);

                   /* <div class="col-md-3">
                        <a class="card mb-1" style="border-bottom-right-radius:3px; border-bottom-left-radius: 3px;">
                            <div class="card-body" style="border-top-right-radius:3px; border-top-left-radius: 3px;">
                                <img class="card-img-top img-fluid" style="height:100px; width: 100%; border-top-right-radius:3px; border-top-left-radius: 3px;" src="{{url('theme/app-assets/images/carousel/06.jpg')}}" alt="Card image cap">
                            </div>
                            <div class="card-body collapse in">

                                <div class="p-1 card-header" style="padding: 0.7rem !important;">
                                    <p style="margin-bottom: 0px !important; min-height: 40px; color: #fff;" class="text-xs-left green">green Lighten 1</p>          
                                </div>
                                <div class="text-xs-right green" style="line-height: 30px; padding-right: 10px; font-weight: bolder; height: 30px;">
                                    12.45
                                </div>
                            </div>    
                        </a>
                    </div>*/

                    var imgURL="{{url('theme/app-assets/images/carousel/06.jpg')}}";

                    var productName="'"+row.name+"'";
                    proHtml+='<div class="col-md-3">';
                        proHtml+='<a id="'+moveableID+'" data-pro-id="'+row.id+'" data-pro-price="'+row.price+'"  data-pro-name="'+productName+'" href="javascript:add_pos_cart('+row.id+','+row.price+','+productName+');" class="card mb-1" style="border-bottom-right-radius:3px; border-bottom-left-radius: 3px;">';

                            proHtml+='<div class="card-body" style="border-top-right-radius:3px; border-top-left-radius: 3px;">';
                            proHtml+='<img class="card-img-top img-fluid" style="height:100px; width: 100%; border-top-right-radius:3px; border-top-left-radius: 3px;" src="'+imgURL+'" alt="'+productName+'">';
                            proHtml+='</div>';

                            proHtml+='<div class="card-body collapse in">';
                                        
                                proHtml+='<div class="p-1 card-header" style="padding: 0.7rem !important;">';
                                    proHtml+='<p style="margin-bottom: 0px !important; min-height: 40px; color: #fff;" class="text-xs-left green" style="color: #fff;">'+row.name+'</p>';          
                                proHtml+='</div>';
                            proHtml+='<div class="text-xs-right green" style="line-height: 30px; padding-right: 10px; font-weight: bolder; height: 30px; color: #545a63;">'+row.price+'</div>';
                            proHtml+='</div>';    
                        proHtml+='</a>';
                    proHtml+='</div>';
                    console.log(row);
                }


            });

            //console.log(moveavleArray);


            $("#product_place").html("<hr>"+proHtml);

            $.each(moveavleArray,function(i,r){
                console.log(r);
                $("#"+r).draggable({revert:true});
                $("#"+r).css('z-index','100')
            });

        }
        else
        {
            console.log("Invalid Category ID");
        }
    }

    function add_pos_cart(ProductID,ProductPrice,ProductName,repairJson=null,dataType=null)
    {
            //alert(ProductName);
            $("#cartMessageProShow").html(loadingOrProcessing("Processing, Please Wait....!!!!"));
            var ProductID=parseInt(ProductID);
            if(ProductID<1)
            {
                $("#cartMessageProShow").html(warningMessage("Invalid Product, Please Try Again.")); 
                return false;
            }
            //var ProductPrice=$(this).attr('data-price');
            //var ProductName=$(this).html();
            @if(isset($ps))
            var taxRate=$("#taxRate").val();
            @else
            var taxRate=0;
            @endif


            if($("#dataCart tr").length > 0)
            {

                if($("#dataCart tr[id="+ProductID+"]").length)
                {

                    if($("#dataCart tr[id="+ProductID+"]").find("td:eq(2)").children("span").children("input").length)
                    {
                         $("#cartMessageProShow").html(warningMessage("Failed, Product in edit mode.")); 
                         return false;
                    }
                    ProductPrice=parseFloat($("#dataCart tr[id="+ProductID+"]").find("td:eq(2)").children("span").html()).toFixed(2);
                    //console.log($("#dataCart tr[id="+ProductID+"]").html());
                    var ExQuantity=$("#dataCart tr[id="+ProductID+"]").find("td:eq(1)").html();
                    var NewQuantity=(ExQuantity-0)+(1-0);
                    var NewPrice=(ProductPrice*NewQuantity).toFixed(2);
                    var taxAmount=parseFloat((NewPrice*taxRate)/100).toFixed(2);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(1)").html(NewQuantity);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(3)").children("span").html(NewPrice);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(2)").attr("data-tax",taxAmount);

                    //console.log(NewQuantity);
                    //console.log(NewPrice);

                }
                else
                {
                    var taxAmount=parseFloat(((ProductPrice*1)*taxRate)/100).toFixed(2);
                    var strHTML='<tr id="'+ProductID+'"><td>'+ProductName+'</td><td  ondblclick="liveRowCartEdit('+ProductID+')">1</td><td  ondblclick="liveRowCartEdit('+ProductID+')" data-tax="'+taxAmount+'"  data-price="'+ProductPrice+'">$<span>'+ProductPrice+'</span></td><td ondblclick="liveRowCartEdit('+ProductID+')">$<span>'+ProductPrice+'</span></td><td style="width: 81px;"><a  href="javascript:editRowLive('+ProductID+');"  title="Edit" class="btn btn-sm btn-outline-green hiddenLiveSave" style="margin-right:2px;  display: none;"><i class="icon-pencil22"></i></a><a href="javascript:delposSinleRow('+ProductID+');" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a></td></tr>';

                    $("#dataCart").append(strHTML);
                }
            }
            else
            {
                var taxAmount=parseFloat(((ProductPrice*1)*taxRate)/100).toFixed(2);
                var strHTML='<tr id="'+ProductID+'"><td>'+ProductName+'</td><td ondblclick="liveRowCartEdit('+ProductID+')">1</td><td  ondblclick="liveRowCartEdit('+ProductID+')" data-tax="'+taxAmount+'"  data-price="'+ProductPrice+'">$<span>'+ProductPrice+'</span></td><td ondblclick="liveRowCartEdit('+ProductID+')">$<span>'+ProductPrice+'</span></td><td style="width: 81px;"><a  href="javascript:editRowLive('+ProductID+');" title="Edit" class="btn btn-sm btn-outline-green hiddenLiveSave" style="margin-right:2px;  display: none;"><i class="icon-pencil22"></i></a><a href="javascript:delposSinleRow('+ProductID+');" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a></td></tr>';

                $("#dataCart").append(strHTML);
            }
            
            genarateSalesTotalCart();
            $("#cartMessageProShow").html(loadingOrProcessing("Adding To Cart, Please Wait...!!!!")); 
            //------------------------Ajax POS Start-------------------------//
            var AddPOSUrl="{{url('sales/cart/add')}}/"+ProductID;

            var postDatas={'product_id':ProductID,'price':ProductPrice,'_token':"{{csrf_token()}}"};
            //console.log(repairJson);
            if(repairJson)
            {
                if(Object.keys(repairJson).length>0)
                {
                    if(dataType==null)
                    {
                        
                        postDatas['repair'] = repairJson;
                    }
                    else
                    {
                        postDatas[dataType] = repairJson;
                    }
                    //postDatas.push(repairJson);
                }
            }
            


            console.log(postDatas);
            //$.merge( [ 0, 1, 2 ], [ 2, 3, 4 ] )

            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddPOSUrl,
                'data': postDatas,
                'success': function (data) {
                    //tmp = data;
                    $("#cartMessageProShow").html(successMessage("Product Added To Cart Successfully.")); 
                    //console.log("Processing : "+data);
                }
            });
            //------------------------Ajax POS End---------------------------//

    }

    function cc_format(value) {
      var v = value.replace(/\s+/g, '').replace(/[^0-9]/gi, '')
      var matches = v.match(/\d{4,16}/g);
      var match = matches && matches[0] || ''
      var parts = []
      for (i=0, len=match.length; i<len; i+=4) {
        parts.push(match.substring(i, i+4))
      }
      if (parts.length) {
        return parts.join(' ')
      } else {
        return value
      }
    }

    function defineCardNumPurify(num)
    {
        var resultnum = num.split('^');
        var resultNumLength=resultnum.length;
        console.log(resultnum);
        console.log(resultNumLength);
        if(resultNumLength>1)
        {
            var totalNumchar=resultnum[0];
            var perNumchar=totalNumchar.replace(/\D/g, '');

            var cliCardHName=resultnum[1];
            var arrcliCardHName=cliCardHName.split('/');
            var cliCardHNameLength=arrcliCardHName.length;
            
            var cardHolderName="";
            if(cliCardHNameLength==1)
            {
                cardHolderName=arrcliCardHName[0];
            }
            else
            {
                cardHolderName=$.trim(arrcliCardHName[1])+" "+$.trim(arrcliCardHName[0]);
            }

            var cliCardExYear=resultnum[2];
            var yearcliCard=cliCardExYear.substr(0,2);
            var monthcliCard=cliCardExYear.substr(2,2);

            var cardExpiredOn=monthcliCard+" / "+yearcliCard;

            $("#card-number-prototype").val(cc_format(perNumchar));
            $("#card-number").val(cc_format(perNumchar));
            $("#card-name").val(cardHolderName);
            $("#card-expiry").val(cardExpiredOn);
        }
        else
        {
            $("#card-number").val(cc_format(num));
        }
    }

    function readCardInfo()
    {
        var cardProtype=$("#card-number-prototype").val();
        console.log('Card Info - ',cardProtype);
        defineCardNumPurify(cardProtype);
        var changeEvent = new Event('keyup')
        document.getElementById('card-number').dispatchEvent(changeEvent);
        document.getElementById('card-name').dispatchEvent(changeEvent);
        document.getElementById('card-expiry').dispatchEvent(changeEvent);
        $("#card-number-prototype").val($("#card-number").val());
        return false;
    }

    $(document).ready(function() { 
        /*var checkTopcol=$("body").hasClass("menu-collapsed");
        if(checkTopcol==false)
        {
            $(".cash_register_collapse").click();
        }*/

        //D:\Workspace\server\htdocs\nucleusv4\public\theme\app-assets\vendors\js\forms\extended\card\jquery.card.js:

        $("#card-number-prototype").keyup(function(){
            console.log($(this).val());
            var num=$(this).val();
            $("#card-number").val(num);
            var changeEvent = new Event('keyup')
            document.getElementById('card-number').dispatchEvent(changeEvent);
        });

        loadCustomerList();
        $("body").addClass("page-sidebar-minimize menu-collapsed");

        alignProductLine();
        genarateSalesTotalCart();
        paginationPerfect();

        $("#counterPay").click(function(){
            var counterPays=$("#counterPay").html();
            var counterPay=counterPays.trim();
            console.log(counterPay);
            var counterPayStatus=0
            if(counterPay=='<i class="icon-close-circled green"></i> Allow pay from counter display')
            {
                counterPayStatus=1;
                $("#counterPay").html('<i class="icon-checkmark green"></i> Allow pay from counter display');
            }
            else
            {
                $("#counterPay").html('<i class="icon-close-circled green"></i> Allow pay from counter display');
            }

            //---------------------Ajax New Product Start---------------------//
            var AddProductUrl="{{url('cart/counter-payment/status')}}";
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddProductUrl,
                'data': {'counterPayStatus':counterPayStatus,'_token':"{{csrf_token()}}"},
                'success': function (data) { 
                    console.log(data);
                }
            });
            //-----------------Ajax New Product End------------------//
        });




        @if($drawerStatus==0) 
            $(".checkDrawer").fadeOut('fast');
        @else
            $(".checkDrawer").fadeIn('fast');
        @endif
        $("#changeSalesView").click(function(){
            var url="{{url('sales')}}";
            window.location.href=url;
        });
        $(".save-card-customer").click(function(){
            alert('ok');
        });

        $(".savePayout").click(function(){
            var amp=$("#payout_amount").val();
            if($.isNumeric($.trim(amp)))
            {
                var newAMP=amp;
            }
            else
            {
                var newAMP=0;
                $("#payout_amount").val(newAMP);
            }
            var payout_reason=$("#payout_reason").val();
            $("#payoutMSG").html(loadingOrProcessing("Saving please wait...."));
            //---------------------Ajax New Product Start---------------------//
            var AddProductUrl="{{url('cart/pos/payout')}}";
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddProductUrl,
                'data': {'payout_amount':newAMP,'payout_reason':payout_reason,'_token':"{{csrf_token()}}"},
                'success': function (data) { 
                    console.log("Saving Payout : "+data);
                    if(data==1)
                    {
                        $("#payoutMSG").html(successMessage("Payout Saved Successfully."));
                        $("#payout_amount").val("0.00");
                        $("#payout_reason").val("");
                        $("#payoutMSG").hide('slow');
                        $("#payoutModal").modal('hide');
                    }
                    else
                    {
                        $("#payoutMSG").html(warningMessage("Failed to saved payout, Please try again."));
                    }
                }
            });
            //-----------------Ajax New Product End------------------//
        });

        $(".openStore").click(function(){
            $(".openStore").fadeOut('fast');
            $("#openStoreMsg").html(loadingOrProcessing("Saving please wait...."));

            var openStoreBalance=$.trim($("input[name=openStoreBalance]").val());
            if(openStoreBalance.length==0)
            {
                openStoreBalance=0;
            }

             //------------------------Ajax Customer Start-------------------------//
             var AddHowMowKhaoUrl="{{url('open/store')}}";
             $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddHowMowKhaoUrl,
                'data': {'openStoreBalance':openStoreBalance,'_token':"{{csrf_token()}}"},
                'success': function (data) {
                    console.log("Store Opening ID : "+data)
                    if(data)
                    {
                        $("#openStoreMsg").html(successMessage("Store is open successfully."));
                        $("#open-drawer").modal('hide');
                        $(".opdStore").fadeOut('fast');
                        $(".cldStore").fadeIn('slow');

                        $(".closeStore").fadeIn('fast');

                        $(".checkDrawer").fadeIn('fast');
                    }
                    else
                    {   
                        $("#openStoreMsg").html(warningMessage("Failed, please try again...."));
                        window.location.href=window.location.href;
                    }
                }
            });
            //------------------------Ajax Customer End---------------------------//
            //$(".payModal-message-area").html(warningMessage("Please select a customer."));
        });

        $(".closeStore").click(function(){
            $(".closeStore").fadeOut('fast');
            $("#closeStoreMsg").html(loadingOrProcessing("Saving close drawer, please wait...."));
             //------------------------Ajax Customer Start-------------------------//
             var AddHowMowKhaoUrl="{{url('close/store')}}";
             $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddHowMowKhaoUrl,
                'data': {'_token':"{{csrf_token()}}"},
                'success': function (data) {
                    console.log("Store Close ID : "+data)
                    if(data)
                    {
                        $("#closeStoreMsg").html(successMessage("Drawer close successfully."));
                        $("#close-drawer").modal('hide');
                        
                        $(".cldStore").fadeOut('slow');
                        $(".opdStore").fadeIn('fast');
                        $(".openStore").fadeIn('fast');

                        $(".checkDrawer").fadeOut('fast');
                    }
                    else
                    {   
                        $("#closeStoreMsg").html(warningMessage("Failed, please try again...."));
                        window.location.href=window.location.href;
                    }
                }
            });
            //------------------------Ajax Customer End---------------------------//
            //$(".payModal-message-area").html(warningMessage("Please select a customer."));
        });

        $(".closePrintStore").click(function(){
            $(".closePrintStore").fadeOut('fast');
            $("#closeStoreMsg").html(loadingOrProcessing("Saving close drawer, please wait...."));
             //------------------------Ajax Customer Start-------------------------//
             var AddHowMowKhaoUrl="{{url('close/store')}}";
             $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddHowMowKhaoUrl,
                'data': {'_token':"{{csrf_token()}}"},
                'success': function (data) {
                    console.log("Store Close ID : "+data)
                    if(data)
                    {
                        $("#closeStoreMsg").html(successMessage("Drawer close successfully."));
                        $("#close-drawer").modal('hide');
                        
                        $(".cldStore").fadeOut('slow');
                        $(".opdStore").fadeIn('fast');
                        $(".openStore").fadeIn('fast');

                        $(".checkDrawer").fadeOut('fast'); 

                        var PrintLocation="{{url('close/print/store')}}/"+data;
                        //window.location.href=PrintLocation;

                        var win = window.open(PrintLocation);
                        if (win) {
                            //Browser has allowed it to be opened
                            win.focus();
                            window.location.href=window.location.href;
                        } else {
                            alert('Please allow popups for this website');
                        }

                    }
                    else
                    {   
                        $("#closeStoreMsg").html(warningMessage("Failed, please try again...."));
                        window.location.href=window.location.href;
                    }
                }
            });
            //------------------------Ajax Customer End---------------------------//
            //$(".payModal-message-area").html(warningMessage("Please select a customer."));
        });

        $("#counterStatusChange").click(function(){
            checkerCounterST();
        });


        /*$(".bootstrap-switch-handle-on").click(function(){
            checkerCounterST();
        });
        
        $(".bootstrap-switch-handle-off").click(function(){
            checkerCounterST();
        });

        $(".bootstrap-switch-label").click(function(){
            checkerCounterST();
        });*/

        $('#description').click(function() {
            $('#show_description').toggle("slide");
        });

        $(".close-authorize-payment-modal").click(function(){
            $("#CustomerCard").modal('hide');
        });

        $(".authorize_card_payment").click(function(){
            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                //$("#payModal").modal('hide');
                $(".payModal-message-area").html(warningMessage("Please select a customer."));
                return false;
            }
            var subTotalPrice=0;
            $.each($("#dataCart").find("tr"),function(index,row){
                var rowPrice=$(row).find("td:eq(2)").children("span").html();
                subTotalPrice+=(rowPrice-0);      
            });

            subTotalPrice=parseFloat(subTotalPrice).toFixed(2);

            if(subTotalPrice<1)
            {
                //$("#payModal").modal('hide');
               // alert("Your cart is empty");
                $(".payModal-message-area").html(warningMessage("Your cart is empty"));
                return false;
            }

            

            var amount_to_pay=$("input[name=amount_to_pay]").val();
            if($.trim(amount_to_pay)>0)
            {
                $("#payModal").modal('hide');
                $("#CustomerCard").modal('show');


                var parseNewPayment=0;

                var amount_to_pay=$("input[name=amount_to_pay]").val();                
                var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html();
                if($.trim(expaid)==0)
                {
                    var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
                }
                else
                {
                    var newpayment=(expaid-0)+(amount_to_pay-0);
                    var parseNewPayment=parseFloat(newpayment).toFixed(2);
                }

                $(".card-pay-due-amount").html(parseNewPayment);


            }
            else
            {
                $(".payModal-message-area").html(warningMessage("You don't have any due."));
            }
        });

        $(".card-pay-authorizenet").click(function(){

            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                //$("#payModal").modal('hide');
                $(".payModal-message-area").html(warningMessage("Please select a customer."));
                return false;
            }

            var parseNewPayment=0;

            var amount_to_pay=$("input[name=amount_to_pay]").val();                
            var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
            if($.trim(expaid)==0)
            {
                var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
            }
            else
            {
                var newpayment=(expaid-0)+(amount_to_pay-0);
                var parseNewPayment=parseFloat(newpayment).toFixed(2);
            }


            var cardNumber=$.trim($(".authorize-card-number").val());
            if(cardNumber.length==0)
            {
                $(".message-place-authorizenet").html(warningMessage("Please type card number."));
                return false;
            }

            var cardHName=$.trim($(".authorize-card-holder-name").val());
            if(cardHName.length==0)
            {
                $(".message-place-authorizenet").html(warningMessage("Please type card holder name."));
                return false;
            }

            var cardExpire=$.trim($(".authorize-card-expiry").val());
            if(cardExpire.length==0)
            {
                $(".message-place-authorizenet").html(warningMessage("Please type card expire month/Year."));
                return false;
            }

            var cardcvc=$.trim($(".authorize-card-cvc").val());
            if(cardcvc.length==0)
            {
                $(".message-place-authorizenet").html(warningMessage("Please type card cvc/cvc2 pin."));
                return false;
            }

            $(".message-place-authorizenet").html(loadingOrProcessing("Authorizing payment please wait...."));



            var addAuthrizePaymentURL="{{url('authorize/net/capture/pos/payment')}}";
             $.ajax({
                'async': true,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': addAuthrizePaymentURL,
                'data': {
                    'cardNumber':cardNumber,
                    'cardHName':cardHName,
                    'cardExpire':cardExpire,
                    'cardcvc':cardcvc,
                    'amountToPay':parseNewPayment,
                    '_token':"{{csrf_token()}}"},
                'success': function (data) {
                    console.log("Authrizenet Print Sales ID : "+data);
                    if(data==null)
                    {
                        $(".message-place-authorizenet").html(warningMessage("Failed to authorize payment. Please try again."));
                    }
                    else
                    {
                        console.log(data.status);
                        if(data.status==1)
                        {
                            var amount_to_pay=$("input[name=amount_to_pay]").val();
                            
                            var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
                            if($.trim(expaid)==0)
                            {
                                var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
                                $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                            }
                            else
                            {
                                var newpayment=(expaid-0)+(amount_to_pay-0);
                                var parseNewPayment=parseFloat(newpayment).toFixed(2);
                                $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                            }
                            genarateSalesTotalCart();
                            
                            var AddPOSUrl="{{url('sales/cart/payment')}}";
                            $.post(AddPOSUrl,{'paymentID':8,'paidAmount':parseNewPayment,'_token':"{{csrf_token()}}"},function(response){
                               
                            });
                            
                            $(".message-place-authorizenet").html(successMessage(data.message));

                        }
                        else
                        {
                            $(".message-place-authorizenet").html(warningMessage(data.message));
                        }
                    }
                   
                }
            });



        });

        

        $(".authorize_card_refund").click(function(){
            alert('Refund');
        });


         $(".cardpointe_bolt_payment").click(function(){

           

            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                //$("#payModal").modal('hide');
                $(".payModal-message-area").html(warningMessage("Please select a customer."));
                return false;
            }
            var subTotalPrice=0;
            $.each($("#dataCart").find("tr"),function(index,row){
                var rowPrice=$(row).find("td:eq(2)").children("span").html();
                subTotalPrice+=(rowPrice-0);      
            });

            subTotalPrice=parseFloat(subTotalPrice).toFixed(2);

            if(subTotalPrice<1)
            {
                //$("#payModal").modal('hide');
               // alert("Your cart is empty");
                $(".payModal-message-area").html(warningMessage("Your cart is empty"));
                return false;
            }

            $(".payModal-message-area").html("<div class='col-md-12'>"+loadingOrProcessing("Please wait, checking bolt device.")+"<div>");

            

            var amount_to_pay=$("input[name=amount_to_pay]").val();
            if($.trim(amount_to_pay)>0)
            {
                //$("#payModal").modal('hide');
                //$("#cardPointeCustomerCard").modal('show');

                //$(".cusStripeAm").html("$"+amount_to_pay);

                var parseNewPayment=0;

                var amount_to_pay=$("input[name=amount_to_pay]").val();                
                var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html();
                if($.trim(expaid)==0)
                {
                    var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
                }
                else
                {
                    var newpayment=(expaid-0)+(amount_to_pay-0);
                    var parseNewPayment=parseFloat(newpayment).toFixed(2);
                }

                //$(".card-pay-due-amount").html(parseNewPayment);
               
                var pingDevice="{{url('bolt/ping')}}";
                $.ajax({
                    'async': true,
                    'type': "GET",
                    'global': false,
                    'dataType': 'json',
                    'url': pingDevice,
                    'success': function (data) {

                        console.log(data);
                        //return false;
                        if(data.connected==false){
                            $(".payModal-message-area").html("<div class='col-md-12'>"+warningMessage("Please connect your Bolt device with internet.")+"<div>");
                        }
                        else
                        {
                            ///Token Start
                            $(".payModal-message-area").html("<div class='col-md-12'>"+loadingOrProcessing("Generating new session-id for transaction.")+"<div>");

                            var boltTokenCaptureURL="{{url('bolt/token')}}";
                            $.ajax({
                                'async': true,
                                'type': "POST",
                                'global': false,
                                'dataType': 'json',
                                'url': boltTokenCaptureURL,
                                'data': {
                                    'amountToPay':parseNewPayment,
                                    '_token':"{{csrf_token()}}"},
                                'success': function (data) {
                                    console.log(data);

                                    if(data.connected==false){
                                        $(".payModal-message-area").html("<div class='col-md-12'>"+warningMessage("Please connect your Bolt device with internet.")+"<div>");
                                    }
                                    else
                                    {
                                        var tokenSession=data.token;
                                        ///Capture Card Start
                                        $(".payModal-message-area").html("<div class='col-md-12'>"+loadingOrProcessing("Please Swipe/Insert your card to device & wait for PIN.")+"<div>");
                                        var boltCaptureURL="{{url('bolt/capture')}}";
                                        $.ajax({
                                            'async': true,
                                            'type': "POST",
                                            'global': false,
                                            'dataType': 'json',
                                            'url': boltCaptureURL,
                                            'data': {
                                                'amountToPay':parseNewPayment,
                                                'cardsession':tokenSession,
                                                '_token':"{{csrf_token()}}"},
                                            'success': function (data) {


                                                console.log("cardPointe Bolt Print Sales ID : "+data);
                                                if(data==null)
                                                {
                                                    $(".payModal-message-area").html(warningMessage("Failed to authorize payment. Please try again."));
                                                }
                                                else
                                                {
                                                    console.log(data.status);
                                                    if(data.status==1)
                                                    {
                                                        var amount_to_pay=$("input[name=amount_to_pay]").val();
                                                        
                                                        var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
                                                        if($.trim(expaid)==0)
                                                        {
                                                            var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
                                                            $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                                                        }
                                                        else
                                                        {
                                                            var newpayment=(expaid-0)+(amount_to_pay-0);
                                                            var parseNewPayment=parseFloat(newpayment).toFixed(2);
                                                            $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                                                        }
                                                        genarateSalesTotalCart();
                                                        
                                                        var AddPOSUrl="{{url('sales/cart/payment')}}";
                                                        $.post(AddPOSUrl,{'paymentID':3,'paidAmount':parseNewPayment,'_token':"{{csrf_token()}}"},function(response){
                                                          
                                                        });
                                                        
                                                        $(".payModal-message-area").html(successMessage(data.message));
                                                        
                                                        setTimeout(function(){
                                                                $("#payModal").modal('hide');
                                                        }, 3000);

                                                        $("#cartMessageProShow").show();
                                                        $("#cartMessageProShow").html(successMessage("Payment completed, Please click on print/complete sale."));

                                                    }
                                                    else
                                                    {
                                                        $(".payModal-message-area").html(warningMessage(data.message));
                                                    }
                                                }
                                               
                                            }
                                        });

                                        ///Capture Card End

                                    }

                                }

                            });

                            // Token End
                            
                            
                        }

                        //console.log("cardPointe Bolt Print Sales ID : "+data);
                    }
                });



                //------------------------Ajax Customer End---------------------------//
                return false;

            }
            else
            {
                $(".payModal-message-area").html(warningMessage("You don't have any due."));
            }
        });


        //cardPointe start
        $(".cardpointe_card_payment").click(function(){

           $(".cardpointeButton").show();

            $(".cardPointe-cardnumber").val("");
            $(".cardPointe-cardholder").val("");
            $(".cardPointe-month option[value='']").prop("selected",true);
            $(".cardPointe-year option[value='']").prop("selected",true);
            $(".cardPointe-cvc").val("");

            $(".cardPointe-cardholder").focus();

            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                //$("#payModal").modal('hide');
                $(".payModal-message-area").html(warningMessage("Please select a customer."));
                return false;
            }
            var subTotalPrice=0;
            $.each($("#dataCart").find("tr"),function(index,row){
                var rowPrice=$(row).find("td:eq(2)").children("span").html();
                subTotalPrice+=(rowPrice-0);      
            });

            subTotalPrice=parseFloat(subTotalPrice).toFixed(2);

            if(subTotalPrice<1)
            {
                //$("#payModal").modal('hide');
               // alert("Your cart is empty");
                $(".payModal-message-area").html(warningMessage("Your cart is empty"));
                return false;
            }

            

            var amount_to_pay=$("input[name=amount_to_pay]").val();
            if($.trim(amount_to_pay)>0)
            {
                $("#payModal").modal('hide');
                $("#cardPointeCustomerCard").modal('show');

                $(".cusStripeAm").html("$"+amount_to_pay);

                var parseNewPayment=0;

                var amount_to_pay=$("input[name=amount_to_pay]").val();                
                var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html();
                if($.trim(expaid)==0)
                {
                    var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
                }
                else
                {
                    var newpayment=(expaid-0)+(amount_to_pay-0);
                    var parseNewPayment=parseFloat(newpayment).toFixed(2);
                }

                $(".card-pay-due-amount").html(parseNewPayment);


            }
            else
            {
                $(".payModal-message-area").html(warningMessage("You don't have any due."));
            }
        });

        $("button.payCardPointe").click(function(){

            //console.log("WOrking");
            $(".cardpointeButton").hide();

            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                $(".cardpointeButton").show();
                //$("#payModal").modal('hide');
                $(".hidestripemsg").html(warningMessage("Please select a customer."));
                return false;
            }

            var parseNewPayment=0;

            var amount_to_pay=$("input[name=amount_to_pay]").val();                
            var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
            if($.trim(expaid)==0)
            {
                var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
            }
            else
            {
                var newpayment=(expaid-0)+(amount_to_pay-0);
                var parseNewPayment=parseFloat(newpayment).toFixed(2);
            }



            var cardNumber=$.trim($(".cardPointe-cardnumber").val());
            if(cardNumber.length==0)
            {
                $(".cardpointeButton").show();
                $(".hidestripemsg").show();
                $(".hidestripemsg").html(warningMessage("Please type card number."));
                return false;
            }

            var cardHName=$.trim($(".cardPointe-cardholder").val());
            if(cardHName.length==0)
            {
                $(".cardpointeButton").show();
                $(".hidestripemsg").show();
                $(".hidestripemsg").html(warningMessage("Please type card holder name."));
                return false;
            }

            var cardMonth=$.trim($(".cardPointe-month").val());
            if(cardMonth.length==0)
            {
                $(".cardpointeButton").show();
                $(".hidestripemsg").show();
                $(".hidestripemsg").html(warningMessage("Please type card expire month."));
                return false;
            }


            var cardYear=$.trim($(".cardPointe-year").val());
            if(cardYear.length==0)
            {
                $(".cardpointeButton").show();
                $(".hidestripemsg").show();
                $(".hidestripemsg").html(warningMessage("Please type card expire Year."));
                return false;
            }


            var cardcvc=$.trim($(".cardPointe-cvc").val());
            if(cardcvc.length==0)
            {
                $(".cardpointeButton").show();
                $(".hidestripemsg").show();
                $(".hidestripemsg").html(warningMessage("Please type card cvc/cvc2 pin."));
                return false;
            }

            $(".hidestripemsg").show();
            $(".hidestripemsg").html(loadingOrProcessing("CardPointe payment please wait...."));



            var addCardPointePaymentURL="{{url('cardpointe/pos/payment')}}";
             $.ajax({
                'async': true,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': addCardPointePaymentURL,
                'data': {
                    'cardNumber':cardNumber,
                    'cardHName':cardHName,
                    'cardMonth':cardMonth,
                    'cardYear':cardYear,
                    'cardcvc':cardcvc,
                    'amountToPay':parseNewPayment,
                    '_token':"{{csrf_token()}}"},
                'success': function (data) {
                    console.log("cardPointe Print Sales ID : "+data);
                    if(data==null)
                    {
                        $(".cardpointeButton").show();
                        $(".hidestripemsg").show();
                        $(".hidestripemsg").html(warningMessage("Failed to authorize payment. Please try again."));
                    }
                    else
                    {
                        console.log(data.status);
                        if(data.status==1)
                        {
                            var amount_to_pay=$("input[name=amount_to_pay]").val();
                            
                            var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
                            if($.trim(expaid)==0)
                            {
                                var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
                                $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                            }
                            else
                            {
                                var newpayment=(expaid-0)+(amount_to_pay-0);
                                var parseNewPayment=parseFloat(newpayment).toFixed(2);
                                $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                            }
                            genarateSalesTotalCart();
                            //------------------------Ajax POS Start-------------------------//
                            var AddPOSUrl="{{url('sales/cart/payment')}}";
                            $.post(AddPOSUrl,{'paymentID':25,'paidAmount':parseNewPayment,'_token':"{{csrf_token()}}"},function(response){
                               // setTimeout(function(){ $("#CustomerCard").modal('show'); }, 3000);
                            });
                            //------------------------Ajax POS End---------------------------//
                            $(".hidestripemsg").show();
                            $(".hidestripemsg").html(successMessage(data.message));
                            
                            setTimeout(function(){
                                    $("#cardPointeCustomerCard").modal('hide');
                            }, 3000);

                            $("#cartMessageProShow").show();
                            $("#cartMessageProShow").html(successMessage("Payment completed, Please click on print/complete sale."));

                        }
                        else
                        {
                            $(".hidestripemsg").show();
                            $(".cardpointeButton").show();
                            $(".hidestripemsg").html(warningMessage(data.message));
                        }
                    }
                    //$(".message-place-authorizenet").html("dddd");
                }
            });
            //------------------------Ajax Customer End---------------------------//
        });
        //cardPointe end


        //stripe start
        $(".stripe_card_payment").click(function(){


            var stripepartialURL="{{url('stripe')}}";

            $("#payment-form-stripe").attr("action",stripepartialURL);
            $("#partial_invoice_id").val(0);
            $("#partial_today_paid").val(0);


            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                //$("#payModal").modal('hide');
                $(".payModal-message-area").html(warningMessage("Please select a customer."));
                return false;
            }
            var subTotalPrice=0;
            $.each($("#dataCart").find("tr"),function(index,row){
                var rowPrice=$(row).find("td:eq(2)").children("span").html();
                subTotalPrice+=(rowPrice-0);      
            });

            subTotalPrice=parseFloat(subTotalPrice).toFixed(2);

            if(subTotalPrice<1)
            {
                //$("#payModal").modal('hide');
               // alert("Your cart is empty");
                $(".payModal-message-area").html(warningMessage("Your cart is empty"));
                return false;
            }

            

            var amount_to_pay=$("input[name=amount_to_pay]").val();
            if($.trim(amount_to_pay)>0)
            {
                $("#payModal").modal('hide');
                $("#stripeCustomerCard").modal('show');

                $(".cusStripeAm").html("$"+amount_to_pay);

                var parseNewPayment=0;

                var amount_to_pay=$("input[name=amount_to_pay]").val();                
                var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html();
                if($.trim(expaid)==0)
                {
                    var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
                }
                else
                {
                    var newpayment=(expaid-0)+(amount_to_pay-0);
                    var parseNewPayment=parseFloat(newpayment).toFixed(2);
                }

                $(".card-pay-due-amount").html(parseNewPayment);


            }
            else
            {
                $(".payModal-message-area").html(warningMessage("You don't have any due."));
            }
        });

        $(".card-pay-stripe").click(function(){

            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                //$("#payModal").modal('hide');
                $(".payModal-message-area").html(warningMessage("Please select a customer."));
                return false;
            }

            var parseNewPayment=0;

            var amount_to_pay=$("input[name=amount_to_pay]").val();                
            var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
            if($.trim(expaid)==0)
            {
                var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
            }
            else
            {
                var newpayment=(expaid-0)+(amount_to_pay-0);
                var parseNewPayment=parseFloat(newpayment).toFixed(2);
            }


            var cardNumber=$.trim($(".authorize-card-number").val());
            if(cardNumber.length==0)
            {
                $(".message-place-authorizenet").html(warningMessage("Please type card number."));
                return false;
            }

            var cardHName=$.trim($(".authorize-card-holder-name").val());
            if(cardHName.length==0)
            {
                $(".message-place-authorizenet").html(warningMessage("Please type card holder name."));
                return false;
            }

            var cardExpire=$.trim($(".authorize-card-expiry").val());
            if(cardExpire.length==0)
            {
                $(".message-place-authorizenet").html(warningMessage("Please type card expire month/Year."));
                return false;
            }

            var cardcvc=$.trim($(".authorize-card-cvc").val());
            if(cardcvc.length==0)
            {
                $(".message-place-authorizenet").html(warningMessage("Please type card cvc/cvc2 pin."));
                return false;
            }

            $(".message-place-authorizenet").html(loadingOrProcessing("Authorizing payment please wait...."));



            var addAuthrizePaymentURL="{{url('authorize/net/capture/pos/payment')}}";
             $.ajax({
                'async': true,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': addAuthrizePaymentURL,
                'data': {
                    'cardNumber':cardNumber,
                    'cardHName':cardHName,
                    'cardExpire':cardExpire,
                    'cardcvc':cardcvc,
                    'amountToPay':parseNewPayment,
                    '_token':"{{csrf_token()}}"},
                'success': function (data) {
                    console.log("Authrizenet Print Sales ID : "+data);
                    if(data==null)
                    {
                        $(".message-place-authorizenet").html(warningMessage("Failed to authorize payment. Please try again."));
                    }
                    else
                    {
                        console.log(data.status);
                        if(data.status==1)
                        {
                            var amount_to_pay=$("input[name=amount_to_pay]").val();
                            
                            var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
                            if($.trim(expaid)==0)
                            {
                                var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
                                $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                            }
                            else
                            {
                                var newpayment=(expaid-0)+(amount_to_pay-0);
                                var parseNewPayment=parseFloat(newpayment).toFixed(2);
                                $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                            }
                            genarateSalesTotalCart();
                            //------------------------Ajax POS Start-------------------------//
                            var AddPOSUrl="{{url('sales/cart/payment')}}";
                            $.post(AddPOSUrl,{'paymentID':8,'paidAmount':parseNewPayment,'_token':"{{csrf_token()}}"},function(response){
                               // setTimeout(function(){ $("#CustomerCard").modal('show'); }, 3000);
                            });
                            //------------------------Ajax POS End---------------------------//
                            $(".message-place-authorizenet").html(successMessage(data.message));

                        }
                        else
                        {
                            $(".message-place-authorizenet").html(warningMessage(data.message));
                        }
                    }
                    //$(".message-place-authorizenet").html("dddd");
                }
            });
            //------------------------Ajax Customer End---------------------------//
        });
        //stripe end






        $(".Paypal_Pay").click(function(){

            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                //$("#payModal").modal('hide');
                $(".payModal-message-area").html(warningMessage("Please select a customer."));
                return false;
            }
            
            var parseNewPayment=0;
            var amount_to_pay=$("input[name=amount_to_pay]").val();                
            var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html();
            if($.trim(expaid)==0)
            {
                var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
            }
            else
            {
                var newpayment=(expaid-0)+(amount_to_pay-0);
                var parseNewPayment=parseFloat(newpayment).toFixed(2);
            }

            if($.trim(parseNewPayment)>0)
            {
               /* $("#payModal").modal('hide');
                $("#CustomerCard").modal('show');
                var parseNewPayment=0;         
                var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
                $(".card-pay-due-amount").html(parseNewPayment);*/
                $(".modal-footer").hide('slow');
                $(".payModal-message-area").html(loadingOrProcessing("Please wait processing your invoice..."));

                window.location.href="{{url('invoice/pos/pay/paypal')}}";

            }
            else
            {
                $(".payModal-message-area").html(warningMessage("You don't have any due."));
            }
        });


        $(".printncompleteSale").click(function(){
            var printDataType=$.trim($(this).attr("data-id"));
            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                alert("Please select a customer.");
                return false;
            }

            var expaid;
            expaid=$.trim($("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html());
            if(expaid=="0")
            {
                var paid=0;
            }
            else
            {
                var paid=expaid;
            }

            if(paid<1)
            {
                alert("Please add payment.");
                return false;
            }

            console.log("Printing Type - ",printDataType);

            //return false;

             //------------------------Ajax Customer Start-------------------------//
             var AddHowMowKhaoUrl="{{url('sales/cart/complete-sales')}}";
             $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddHowMowKhaoUrl,
                'data': {'printData':1,'print_type':printDataType,'_token':"{{csrf_token()}}"},
                'success': function (data) {
                    console.log("Completing Print Sales ID : "+data)
                    if(data)
                    {
                        var PrintLocation="{{url('sales/invoice/print/media/pdf')}}/"+printDataType+"/"+data;
                        //window.location.href=PrintLocation;

                        var win = window.open(PrintLocation);
                        if (win) {
                            //Browser has allowed it to be opened
                            win.focus();
                            window.location.href=window.location.href;
                        } else {
                            alert('Please allow popups for this website');
                        }
                    }
                    else
                    {
                        window.location.href=window.location.href;
                    }
                }
            });
            //------------------------Ajax Customer End---------------------------//
        });

        $("#clearsale").click(function(){
            var c=confirm("Are you sure to clear the POS screen?");
            if(c)
            {
                var clposLink="{{url('pos/clear')}}";
                window.location.href=clposLink;
            }
        });

        $("#completesale").click(function(){
            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                alert("Please select a customer.");
                return false;
            }

            var expaid;
            expaid=$.trim($("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html());
            if(expaid=="0")
            {
                var paid=0;
            }
            else
            {
                var paid=expaid;
            }

            if(paid<1)
            {
                var c=confirm("Are you sure to create invoice without payment.!!!");
                if(c==false)
                {
                    return false;
                }
            }

             //------------------------Ajax Customer Start-------------------------//
             var AddHowMowKhaoUrl="{{url('sales/cart/complete-sales')}}";
             $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddHowMowKhaoUrl,
                'data': {'_token':"{{csrf_token()}}"},
                'success': function (data) {
                    console.log("Completing Sales : "+data)
                    if(data==1)
                    {
                        window.location.href=window.location.href;
                    }
                    else
                    {
                        window.location.href=window.location.href;
                    }
                }
            });
            //------------------------Ajax Customer End---------------------------//
        });


        $('.addNewCustomerPOS').click(function(){
            $("#NewCustomerDash").modal('show');
            return false;
        });


        $("select[name=customer_id]").change(function(){
            var customerID=$.trim($(this).val());
            console.log(customerID);
            if(customerID.length==0)
            {
                alert("Please select a customer.");
                return false;
            }
            else if(customerID==0)
            {
                $("#NewCustomerDash").modal('show');
                return false;
            }


            //------------------------Ajax Customer Start-------------------------//
            var AddCustomerUrl="{{url('sales/cart/customer')}}/"+customerID;
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddCustomerUrl,
                'data': {'_token':"{{csrf_token()}}"},
                'success': function (data) {
                    console.log("Assigning custome to cart : "+data)
                }
            });
            //------------------------Ajax Customer End---------------------------//
        });


        $(".save-new-customer").click(function(){

                    var name=$.trim($("input[name=new_customer_name]").val());
                    var phone=$.trim($("input[name=new_customer_phone]").val());
                    var email=$.trim($("input[name=new_customer_email]").val());
                    var address=$.trim($("input[name=new_customer_address]").val());
                    //console.log(name,phone,email,address);
                    if(name.length==0)
                    {
                        alert("Please select a customer Name.");
                        return false;
                    }
                    else if(phone.length==0)
                    {
                        alert("Please select a customer Phone Number.");
                        return false;
                    }
                    /*else if(email.length==0)
                    {
                        alert("Please select a customer Email.");
                        return false;
                    }
                    else if(address.length==0)
                    {
                        alert("Please select a customer Address.");
                        return false;
                    }*/
                    
                    $(".save-new-customer-parent").html(" Processing please wait.....");

                    //------------------------Ajax Customer Start-------------------------//
                    var AddNewCustomerUrl="{{url('customer/pos/ajax/add')}}";
                    $.ajax({
                        'async': false,
                        'type': "POST",
                        'global': false,
                        'dataType': 'json',
                        'url': AddNewCustomerUrl,
                        'data': {'name':name,'phone':phone,'email':email,'address':address,'_token':"{{csrf_token()}}"},
                        'success': function (data) {
                            $("select[name=customer_id]").append('<option value="'+data+'">'+name+'</option>');
                            $("select[name=customer_id] option[value='"+data+"']").prop("selected",true);

                            console.log("Saved New Customer : "+data);
                            $("#NewCustomerDash").modal('hide');

                            //------------------------Ajax Customer Start-------------------------//
                            var AddCustomerPOSUrl="{{url('sales/cart/customer')}}/"+data;
                            $.ajax({
                                'async': false,
                                'type': "POST",
                                'global': false,
                                'dataType': 'json',
                                'url': AddCustomerPOSUrl,
                                'data': {'_token':"{{csrf_token()}}"},
                                'success': function (datas) {
                                    console.log("Assigning custome to cart : "+datas)
                                }
                            });
                            //------------------------Ajax Customer End---------------------------//
                        }
                    });
                    //------------------------Ajax Customer End---------------------------//
                });






        $(".make-payment").click(function(){


            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                alert("Please select a customer to make payment.");
                return false;
            }

            var payment_id=$(this).attr("data-id");
            var payment_text=$(this).html();
            var c=confirm("Are you sure to proced with "+$.trim(payment_text)+" ?.");
            if(c)
            {
                var amount_to_pay=$("input[name=amount_to_pay]").val();
                console.log(amount_to_pay,payment_id,$.trim(payment_text));
                var expaid=$("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
                if($.trim(expaid)==0)
                {
                    var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
                    $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                }
                else
                {
                    var newpayment=(expaid-0)+(amount_to_pay-0);
                    var parseNewPayment=parseFloat(newpayment).toFixed(2);
                    $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                }
                genarateSalesTotalCart();
                $("#payModal").modal("hide");
                //------------------------Ajax POS Start-------------------------//
                var AddPOSUrl="{{url('sales/cart/payment')}}";
                $.post(AddPOSUrl,{'paymentID':payment_id,'paidAmount':parseNewPayment,'_token':"{{csrf_token()}}"},function(response){
                    console.log(response);
                });
                //------------------------Ajax POS End---------------------------//
            }
            
        });

        $(".amountextract").click(function(){
            console.log($(this).parent().html());
            var customerID=$.trim($("select[name=customer_id]").val());
            if(customerID.length==0)
            {
                alert("Please select a customer to make payment.");
                return false;
            }
            genarateSalesTotalCart();
        });

        $("#discount_amount").keyup(function(){
            var amp=$(this).val();
            if($.isNumeric($.trim(amp)))
            {
                var newAMP=amp;
            }
            else
            {
                var newAMP=0;
            }

            $(this).val(newAMP);
        });

        $(".apply-discount").click(function(){
            var amp=$("#discount_amount").val();
            if($.isNumeric($.trim(amp)))
            {
                var newAMP=amp;
            }
            else
            {
                var newAMP=0;
            }

            var discount_type=0;
            discount_type=$("select[name=discount_type]").val();
            


            genarateSalesTotalCart();
            $("#Discount").modal("hide");

            //------------------------Ajax New Product Start-------------------------//
            var AddProductUrl="{{url('sales/cart/assign/discount')}}";
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddProductUrl,
                'data': {'discount_type':discount_type,'discount_amount':newAMP,'_token':"{{csrf_token()}}"},
                'success': function (data) { 
                    console.log("Assigning Discount : "+data)
                }
            });
            //------------------------Ajax New Product End---------------------------//


        });

        $(".edit_pos_item").click(function(){
            console.log("WW");
        });



        $(".GAddProductToCart").click(function(){
            @if(isset($ps))
            var taxRate=$("#taxRate").val();
            @else
            var taxRate=0;
            @endif
            var ProductName=$.trim($("input[name=gName]").val());
            var ProductPrice=$.trim($("input[name=gPrice]").val());
            var ProductCPrice=$.trim($("input[name=CPrice]").val());
            var ProductDesc=$.trim($("textarea[name=gDetail]").val());

            if(ProductName.length==0)
            {
                alert("Please name should not be empty..");
                return false;
            }

            if(ProductPrice.length==0)
            {
                    alert("Please price should not be empty..");
                    return false;
            }

            if(ProductCPrice.length==0)
            {
                    alert("Please Cost price should not be empty..");
                    return false;
            }

         if(ProductDesc.length==0)
         {
             ProductDesc="General Sales.";
         }
         else
         {
            ProductDesc='General Sales : '+ProductDesc;
        }


        console.log(ProductName,ProductPrice,ProductDesc);
        $("#General_Sale").modal("hide");
            //------------------------Ajax New Product Start-------------------------//
            var ProductID; 
            var AddProductUrl="{{url('product/ajax/save')}}";
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddProductUrl,
                'data': {'name':ProductName,'price':ProductPrice,'cost_price':ProductCPrice,'detail':ProductDesc,'_token':"{{csrf_token()}}"},
                'success': function (data) {
                    ProductID=data; 
                    //console.log("Adding New Product : "+data)
                }
            });
            //------------------------Ajax New Product End---------------------------//
            //console.log(ProductID);

            if($("#dataCart tr").length > 0)
            {

                if($("#dataCart tr[id="+ProductID+"]").length)
                {
                    //console.log($("#dataCart tr[id="+ProductID+"]").html());
                    var ExQuantity=$("#dataCart tr[id="+ProductID+"]").find("td:eq(1)").html();
                    var NewQuantity=(ExQuantity-0)+(1-0);
                    var NewPrice=(ProductPrice*NewQuantity).toFixed(2);
                    var taxAmount=parseFloat((NewPrice*taxRate)/100).toFixed(2);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(1)").html(NewQuantity);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(3)").children("span").html(NewPrice);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(2)").attr("data-tax",taxAmount);

                    console.log(NewQuantity);
                    console.log(NewPrice);

                }
                else
                {
                    var taxAmount=parseFloat(((ProductPrice*1)*taxRate)/100).toFixed(2);
                    var strHTML='<tr id="'+ProductID+'"><td>'+ProductName+'</td><td  ondblclick="liveRowCartEdit('+ProductID+')">1</td><td  ondblclick="liveRowCartEdit('+ProductID+')" data-tax="'+taxAmount+'"  data-price="'+ProductPrice+'">$<span>'+ProductPrice+'</span></td><td  ondblclick="liveRowCartEdit('+ProductID+')">$<span>'+ProductPrice+'</span></td><td style="width: 81px;"><a href="javascript:editRowLive('+ProductID+');" title="Edit" class="btn btn-sm btn-outline-green hiddenLiveSave" style="margin-right:2px; display:none;"><i class="icon-pencil22"></i></a><a href="javascript:delposSinleRow('+ProductID+');" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a></td></tr>';

                    $("#dataCart").append(strHTML);
                }
            }
            else
            {
                var taxAmount=parseFloat(((ProductPrice*1)*taxRate)/100).toFixed(2);
                var strHTML='<tr id="'+ProductID+'"><td>'+ProductName+'</td><td>1</td><td data-tax="'+taxAmount+'"  data-price="'+ProductPrice+'">$<span>'+ProductPrice+'</span></td><td>$<span>'+ProductPrice+'</span></td><td style="width: 81px;"><a href="javascript:editRowLive('+ProductID+');" title="Edit" class="btn btn-sm btn-outline-green hiddenLiveSave" style="margin-right:2px; display:none;"><i class="icon-pencil22"></i></a><a href="javascript:delposSinleRow('+ProductID+');" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a></td></tr>';

                $("#dataCart").append(strHTML);
            }
            
            genarateSalesTotalCart();

            //------------------------Ajax POS Start-------------------------//
            var AddPOSUrl="{{url('sales/cart/add')}}/"+ProductID;
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddPOSUrl,
                'data': {'product_id':ProductID,'price':ProductPrice,'_token':"{{csrf_token()}}"},
                'success': function (data) {
                    //tmp = data;
                    console.log("Processing : "+data);
                }
            });
            //------------------------Ajax POS End---------------------------//

        });


        $(".add-pos-cart").click(function(){
            //alert('sss');
            var ProductID=$(this).attr('data-id');
            var ProductPrice=$(this).attr('data-price');
            var ProductName=$(this).html();
            @if(isset($ps))
            var taxRate=$("#taxRate").val();
            @else
            var taxRate=0;
            @endif


            if($("#dataCart tr").length > 0)
            {

                if($("#dataCart tr[id="+ProductID+"]").length)
                {
                    //console.log($("#dataCart tr[id="+ProductID+"]").html());
                    var ExQuantity=$("#dataCart tr[id="+ProductID+"]").find("td:eq(1)").html();
                    var NewQuantity=(ExQuantity-0)+(1-0);
                    var NewPrice=(ProductPrice*NewQuantity).toFixed(2);
                    var taxAmount=parseFloat((NewPrice*taxRate)/100).toFixed(2);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(1)").html(NewQuantity);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(3)").children("span").html(NewPrice);
                    $("#dataCart tr[id="+ProductID+"]").find("td:eq(2)").attr("data-tax",taxAmount);

                    console.log(NewQuantity);
                    console.log(NewPrice);

                }
                else
                {
                    var taxAmount=parseFloat(((ProductPrice*1)*taxRate)/100).toFixed(2);
                    var strHTML='<tr id="'+ProductID+'"><td>'+ProductName+'</td><td>1</td><td data-tax="'+taxAmount+'"  data-price="'+ProductPrice+'">$<span>'+ProductPrice+'</span></td><td>$<span>'+ProductPrice+'</span></td><td style="width: 81px;"><a href="javascript:edit_pos_item('+ProductID+');" title="Edit" class="btn btn-sm btn-outline-green" style="margin-right:2px;"><i class="icon-pencil22"></i></a><a href="javascript:delposSinleRow('+ProductID+');" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a></td></tr>';

                    $("#dataCart").append(strHTML);
                }
            }
            else
            {
                var taxAmount=parseFloat(((ProductPrice*1)*taxRate)/100).toFixed(2);
                var strHTML='<tr id="'+ProductID+'"><td>'+ProductName+'</td><td>1</td><td data-tax="'+taxAmount+'"  data-price="'+ProductPrice+'">$<span>'+ProductPrice+'</span></td><td style="width: 81px;"><a href="javascript:edit_pos_item('+ProductID+');" title="Edit" class="btn btn-sm btn-outline-green" style="margin-right:2px;"><i class="icon-pencil22"></i></a><a href="javascript:delposSinleRow('+ProductID+');" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a></td></tr>';

                $("#dataCart").append(strHTML);
            }
            
            genarateSalesTotalCart();

            //------------------------Ajax POS Start-------------------------//
            var AddPOSUrl="{{url('sales/cart/add')}}/"+ProductID;
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddPOSUrl,
                'data': {'product_id':ProductID,'price':ProductPrice,'_token':"{{csrf_token()}}"},
                'success': function (data) {
                    //tmp = data;
                    console.log("Processing : "+data)
                }
            });
            //------------------------Ajax POS End---------------------------//

        });

    $("input[name=amount_to_pay]").keyup(function(){
        var customerID=$.trim($("select[name=customer_id]").val());
        if(customerID.length==0)
        {
            alert("Please select a customer to make payment.");
            return false;
        }
        console.log($(this).val());
        var dues=$("#totalCartDueToPay").html();
        var amp=$(this).val();
        if($.isNumeric($.trim(amp)))
        {
            var newAMP=amp;
        }
        else
        {
            var newAMP=0;
        }

        $(this).val(newAMP);

        var mkdues=$.trim(dues)-$.trim(newAMP);
        var newdues=parseFloat(mkdues).toFixed(2);

        $("#prmDue").html(newdues);

    });

});

function editRowLive(id)
{
    @if(isset($ps))
        var taxRate=$("#taxRate").val();
    @else
        var taxRate=0;
    @endif

        var unitPrice=$("#dataCart tr[id="+id+"]").children("td:eq(2)").find("span").children("input").val();
        var edit_quantity=$("#dataCart tr[id="+id+"]").children("td:eq(1)").children("input").val();
        //console.log($("#dataCart tr[id="+id+"]").find("td:eq(2)").children("span").html());
        $("#dataCart tr[id="+id+"]").find("td:eq(2)").attr("data-price",unitPrice);
        if($.isNumeric(edit_quantity))
        {
            if(edit_quantity>=0)
            {
                var totalPrice=unitPrice*edit_quantity;    
            }
            else
            {
                edit_quantity=0;
                
                var totalPrice=unitPrice*edit_quantity;    
                $("#dataCart tr[id="+id+"]").children("td:eq(1)").children("input").val(edit_quantity);
            }
        }
        else
        {
            edit_quantity=0;
            //$("input[name=edit_quantity]").val(edit_quantity);
            $("#dataCart tr[id="+id+"]").children("td:eq(1)").children("input").val(edit_quantity);
            var totalPrice=unitPrice*edit_quantity;    
        }
        
        var taxAmount=parseFloat((totalPrice*taxRate)/100).toFixed(2);
        $("#dataCart tr[id="+id+"]").children("td:eq(2)").find("span").html(unitPrice);
        $("#dataCart tr[id="+id+"]").find("td:eq(1)").html(edit_quantity);
        $("#dataCart tr[id="+id+"]").find("td:eq(3)").children("span").html(totalPrice);
        $("#dataCart tr[id="+id+"]").find("td:eq(2)").attr("data-tax",taxAmount);
        genarateSalesTotalCart();
        //need to incorporate witth ajax

        //------------------------Ajax POS Start-------------------------//
        var AddPOSUrl="{{url('sales/cart/custom/add')}}/"+id+"/"+edit_quantity+"/"+unitPrice;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddPOSUrl,
            'data': {'_token':"{{csrf_token()}}"},
            'success': function (data) {
                //tmp = data;
                console.log("Live Edit Processing : "+data);
            }
        });
        //------------------------Ajax POS End---------------------------//
    }

    function delposSinleRow(ID)
    {
        var c=confirm("Are you sure to delete this item.");
        if(c)
        {
            $("#dataCart tr[id="+ID+"]").remove();
            genarateSalesTotalCart();
            //------------------------Ajax POS Start-------------------------//
            var AddPOSUrl="{{url('sales/cart/row/delete')}}/"+ID;
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddPOSUrl,
                'data': {'_token':"{{csrf_token()}}"},
                'success': function (data) {
                    //tmp = data;
                    console.log("Delete Processing : "+data)
                }
            });
            //------------------------Ajax POS End---------------------------//
        }

    }

    function edit_pos_item(id)
    {
        //console.log(id);
        
        //console.log($("#dataCart tr[id="+id+"]").html());
        //console.log($("#dataCart tr[id="+id+"]").find("td:eq(0)").html());
        //console.log($("#dataCart tr[id="+id+"]").find("td:eq(1)").html());
        //console.log($("#dataCart tr[id="+id+"]").find("td:eq(2)").children("span").html());
        //console.log($("#dataCart tr[id="+id+"]").find("td:eq(2)").attr("data-price"));
        var edit_product_name=$("#dataCart tr[id="+id+"]").find("td:eq(0)").html();
        var edit_quantity=$("#dataCart tr[id="+id+"]").find("td:eq(1)").html();
        //var edit_unit_price=$("#dataCart tr[id="+id+"]").find("td:eq(2)").children("span").html();
        $("input[name=edit_product_name]").val($.trim(edit_product_name));
        $("input[name=edit_quantity]").val($.trim(edit_quantity));
        $("input[name=edit_quantity]").attr("onkeyup","editRowLive("+id+")");
        $("input[name=edit_quantity]").attr("onchange","editRowLive("+id+")");
        //$("input[name=edit_unit_price]").val($.trim(edit_unit_price));
        //$("input[name=edit_unit_price]").val($.trim(edit_unit_price));
        $("input[name=edit_id]").val(id);
        $('#editProduct').modal('show');
        //$('#myModal').modal('hide');
    }

    
    function genarateSalesTotalCart()
    {
        if($("#dataCart tr").length > 0)
        {
            var subTotalPrice=0;
            var TotalTax=0;
            var priceTotal=0;
            var due=0;
            var discount=0;
            var discount_type=0;

            if($("select[name=discount_type]").length>0)
            {
                discount_type=$("select[name=discount_type]").val();
            }


            var expaid=$.trim($("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html());
            if(expaid=="0")
            {
                var paid=0;
            }
            else
            {
                var paid=expaid;
            }

            $.each($("#dataCart").find("tr"),function(index,row){
                var rowPrice=$(row).find("td:eq(3)").children("span").html();
                var rowTax=$(row).find("td:eq(2)").attr("data-tax");
                subTotalPrice+=(rowPrice-0);    
                TotalTax+=(rowTax-0);    
            });

            var calcDisc=0;
            if($("#discount_amount").length>0)
            {
                discount=$.trim($("#discount_amount").val());
                if(discount_type==1)
                {
                    calcDisc=$.trim($("#discount_amount").val());
                }
                else if(discount_type==2)
                {
                    calcDisc=((subTotalPrice*$.trim($("#discount_amount").val()))/100);
                }
                else
                {
                    calcDisc=0;
                }
            }
            else
            {
                discount=0;
            }

            var sumPriceTotal=((subTotalPrice-0)+(TotalTax-0));
            //var calcDisc=((sumPriceTotal*discount)/100);
            sumPriceTotal=sumPriceTotal-calcDisc;
            var sumdues=sumPriceTotal-paid;
            var newdues=parseFloat(sumdues).toFixed(2);
            var newPriceTotal=parseFloat(sumPriceTotal).toFixed(2);
            var newDiscount=parseFloat(calcDisc).toFixed(2);
            var newsubTotalPrice=parseFloat(subTotalPrice).toFixed(2);
            var newTotalTax=parseFloat(TotalTax).toFixed(2);

            if(newdues<0){ newdues="0.00"; }
            else if(newdues=="-0.00"){ newdues="0.00"; }



            $("#posCartSummary tr:eq(2)").find("th").children("span").html(discount+"%");

            $("#posCartSummary tr:eq(0)").find("td:eq(2)").children("span").html(newsubTotalPrice);
            $("#posCartSummary tr:eq(1)").find("td:eq(2)").children("span").html(newTotalTax);
            $("#posCartSummary tr:eq(2)").find("td:eq(2)").children("span").html(newDiscount);
            $("#posCartSummary tr:eq(3)").find("td:eq(2)").children("span").html(newPriceTotal);
            $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(paid);
            $("#posCartSummary tr:eq(5)").find("td:eq(2)").children("span").html(newdues);

            $("input[name=amount_to_pay]").val(newdues);
            console.log($("input[name=amount_to_pay]").val());
            $("#prmDue").html(newdues);
            $("#totalCartDueToPay").html(newdues);
        }
        else
        {
            $("#posCartSummary tr:eq(0)").find("td:eq(2)").children("span").html("0.00");
            $("#posCartSummary tr:eq(1)").find("td:eq(2)").children("span").html("0.00");
            $("#posCartSummary tr:eq(2)").find("td:eq(2)").children("span").html("0.00");
            $("#posCartSummary tr:eq(2)").find("th").children("span").html("0%");
            $("#posCartSummary tr:eq(3)").find("td:eq(2)").children("span").html("0.00");
            $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html("0.00");
            $("#posCartSummary tr:eq(5)").find("td:eq(2)").children("span").html("0.00");
            $("input[name=amount_to_pay]").val("0.00");
            $("#prmDue").html("0.00");
            $("#totalCartDueToPay").html("0.00");
        }


    }


</script>
{{-- Instore repair js * Start  --}}
@include('apps.include.json.posinstorerepair')
{{-- Instore repair js * End  --}}

{{-- Punch js * Start  --}}
@include('apps.include.json.punch')
{{-- Punch js * End  --}}

{{-- Punch js * Start  --}}
@include('apps.include.json.tax')
{{-- Punch js * End  --}}

{{-- Punch js * Start  --}}
@include('apps.include.json.salesreturn')
{{-- Punch js * End  --}}

{{-- Punch js * Start  --}}
@include('apps.include.json.warranty')
{{-- Punch js * End  --}}

{{-- Punch js * Start  --}}
@include('apps.include.json.posbuyback')
{{-- Punch js * End  --}}

{{-- Punch js * Start  --}}
@include('apps.include.json.pospaymentpartial',compact('addPartialPayment','partial_invoice'))
{{-- Punch js * End  --}}
@endsection

