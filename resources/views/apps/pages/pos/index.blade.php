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

            .height-30
            {
                height:30px !important;
            }

            .height-10{ height: 10px !important; }
            .table td, .table th
            {
                padding: 0.1rem .75rem;
            }
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

            table tbody tr td
            {
                line-height: 35px;
                font-weight: 600;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 12px;
            }

            table tbody tr td div span
            {
                cursor: pointer;
            }

            table tfoot tr td
            {
                font-weight: 600;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 14px;
            }

            table thead tr th
            {
                font-weight: 600;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 16px;
            }

            .hellvetia{
                font-family: 'Helvetica Neue', 'Nunito', sans-serif;
                font-weight: 600;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered
            {
                font-weight: bolder !important;
                text-align: center !important;
                font-size: 16px !important;
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
                <?php 
                $repandticket=[];
                ?>
                @if(isset($catInfo) && count($catInfo)>0)
                    <?php $i=1; ?>
                    @foreach($catInfo as $cat)
                    @if(trim($cat->name)=="Inventory Repair")
                    <?php 
                        $repandticket[]=$cat->name;
                    ?>
                    @elseif(trim($cat->name)=="Non-Inventory Repair")
                    <?php 
                        $repandticket[]=$cat->name;
                    ?>
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

                    @if(count($repandticket))
                        <div class="col-md-3">
                            <div class="card mb-1">
                                <div class="card-body collapse in">
                                    <div class="bg-green bg-lighten-2 height-10"></div>
                                    <div class="p-1">
                                        <p class="text-xs-left mb-0">
                                            <a href="javascript:void(0);"  data-toggle="modal" data-target="#ChooseRepairButton" style="text-decoration: none;">
                                                <i class="icon-cogs"></i> Repair
                                            </a>
                                        </p>         
                                    </div>
                                </div>    
                            </div>
                        </div>
                    @endif

                @else
                    <div class="col-md-12">
                        <h2  class="text-xs-center">No categories found. <br>  <br> 
                            <a href="{{url('category')}}" class="btn btn-green"><i class="icon-ios-plus-outline"></i> Create Now</a>
                        </h2>
                    </div>
                @endif

            

            
                            </div>
        <div class="row" id="defaultProductView">
        <span id="product_place"></span>

                        </div>    
    <hr>

        </div>

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
                            <span style="cursor: pointer;" class="input-group-addon addNewCustomerPOS green" id="basic-addon4"><i class="icon-user-plus"></i> New Customer</span>
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
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th align="center" style="text-align: center; width: 150px;">Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="dataCart" class="">
                                    @if(isset($cart->items))
                                        @if(count($cart->items)>0)
                                    @foreach($cart->items as $index=>$row)
                                    <tr id="{{$row['item_id']}}">
                                                <td valign="center">{{$row['item']}}</td>
                                                <td>
                                                    <div class="input-group" style="border-spacing: 0px !important;">
                                                        <span class="input-group-addon dedmoreqTv4Ex"><i class="{{($row['qty']==1)?'icon-remove':'icon-minus'}}"></i></span>
                                                        <input style="text-align: center;" type="text" class="form-control directquantitypos" placeholder="Addon On Both Side" aria-label="Amount (to the nearest dollar)" value="{{$row['qty']}}">
                                                        <span class="input-group-addon addmoreqTv4"><i class="icon-plus"></i></span>
                                                    </div>
                                        </td>
                                                <td class="priceEdit" valign="center"  style="line-height: 35px;" data-tax="{{$row['tax']}}"  data-price="{{$row['unitprice']}}">$<span>{{number_format($row['unitprice'],2)}}</span></td>
                                                <td  class="priceEdit" valign="center"  style="line-height: 35px;">$<span>{{number_format($row['price'],2)}}</span></td>
                                    </tr>
                                    @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5">
                                                    <h3 style="height: 50px; text-align: center; line-height: 50px;">
                                                        No Item on Cart
                                                    </h3>
                                                </td>
                                            </tr>
                                        @endif
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
                                    <tr style="display: none;">
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
                                </tfoot>
                            </table>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                       
                        <div class="clearfix"></div>
                        
                    </div>
                </div>
            </div>
            <div class="card-header" style="padding: 0.50rem 1.5rem !important;">

                <div class="row">
                    <div class="col-sm-6 col-xs-6 border-right-green">
                        <div class="col-md-12" style="padding:0px; margin: 0px;">
                            <h2 class="gray hellvetia text-xs-center" style="padding:0px; margin: 0px;">Total</h2>
                        </div>
                        <div class="col-md-12" style="padding:0px; margin: 0px;">
                            <h3 class="text-xs-center green" style="padding:0px;  margin: 0px;">$<span id="cartTotalAmount">0.00</span></h3>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <div class="col-md-12"><h2 class="gray hellvetia text-xs-center">Amount Due</h2></div>
                        <div class="col-md-12" style="padding:0px; margin: 0px;">
                            <h3 class="text-xs-center yellow" style="padding:0px; margin: 0px;">$<span id="totalCartDueToPay">0.00</span></h3>
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
                        <div class="col-xs-12 button-group">
                            @include('apps.include.modal.pos_quick_link')
                        </div>
                    </div>
                </div>



        </div>
        <!--/ All Modal -->
        <!--Edit Product Start-->
         
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
           @include('apps.include.modal.squareup')
           @include('apps.include.modal.squareupPartial')
           @include('apps.include.modal.manager-approval')
           @include('apps.include.modal.product-edit')
           @include('apps.include.modal.paymodal',compact('stripe'))
           @include('apps.include.modal.open-drawer')
           @include('apps.include.modal.close-drawer')
           @include('apps.include.modal.time_clock')
           @include('apps.include.modal.repairButtonModal',compact('repandticket'))
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
<link rel="stylesheet" type="text/css" href="{{asset('theme/app-assets/css/plugins/forms/extended/form-extended.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('theme/app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('theme/app-assets/vendors/css/forms/toggle/switchery.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('theme/app-assets/css/plugins/forms/switch.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('theme/app-assets/css/core/colors/palette-switch.min.css')}}">
@endsection

@section('counter-display-js')
<script src="{{asset('theme/app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<script src="{{asset('theme/app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js')}}" type="text/javascript"></script>
<script src="{{asset('theme/app-assets/vendors/js/forms/toggle/switchery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('theme/app-assets/js/scripts/forms/switch.min.js')}}" type="text/javascript"></script>

@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{secure_url('theme/app-assets/vendors/css/extensions/pace.css')}}">
<link rel="stylesheet" type="text/css" href="{{secure_url('theme/app-assets/vendors/css/extensions/datedropper.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{secure_url('assets/css/pos.css')}}">
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
<link rel="stylesheet" type="text/css" href="{{asset('theme/app-assets/vendors/css/forms/selects/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('theme/app-assets/css/pages/invoice.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('theme/app-assets/vendors/css/ui/dragula.min.css')}}">
<script>

var squareupPaymentFormload="{{secure_url('intregation/squareup/form')}}";
</script>
@endsection

@section('js')
<script src="{{secure_url('theme/app-assets/vendors/js/extensions/pace.min.js')}}" type="text/javascript"></script>
<!-- /build-->
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{secure_url('theme/app-assets/vendors/js/extensions/datedropper.min.js')}}" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script type="text/javascript">    
    $(document).ready(function() {
        $(".DropDateWithformat").dateDropper({
            dropWidth: 200,
            maxYear: "<?=date('Y')?>",
            minYear: "2010",
            format: "Y-m-d",
            init_animation: "bounce",
            dropPrimaryColor: "#fa4420",
            dropBorder: "1px solid #fa4420",
            dropBorderRadius: "20",
            dropShadow: "0 0 10px 0 rgba(250, 68, 32, 0.6)"
        });
    });
</script>
<!-- END PAGE LEVEL JS-->
<!-- Stripe Start ---------------------->
<script type="text/javascript" src="https://js.stripe.com/v2/" crossorigin="anonymous" SameSite="none Secure"></script>
<script type="text/javascript" src="{{secure_url('js/stripe.js')}}"></script>
<!-- Stripe End ---------------------->

<script src="{{asset('theme/app-assets/vendors/js/forms/extended/card/jquery.card.js')}}" type="text/javascript"></script>
<script src="{{asset('theme/app-assets/js/scripts/forms/extended/form-typeahead.min.js')}}" type="text/javascript"></script>
{{-- <script src="{{asset('theme/app-assets/js/scripts/forms/extended/form-inputmask.min.js')}}" type="text/javascript"></script>
<script src="{{asset('theme/app-assets/js/scripts/forms/extended/form-formatter.min.js')}}" type="text/javascript"></script>
<script src="{{asset('theme/app-assets/js/scripts/forms/extended/form-maxlength.min.js')}}" type="text/javascript"></script> --}}
<script src="{{asset('theme/app-assets/js/scripts/forms/extended/form-card.min.js')}}" type="text/javascript"></script>



<script src="{{asset('theme/app-assets/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('theme/app-assets/js/scripts/forms/select/form-select2.min.js')}}" type="text/javascript"></script>


<script src="{{asset('theme/app-assets/vendors/js/extensions/dragula.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery-ui.js')}}" ></script>

<script>
//editRowLive
    var product_pos_settings_product_url = "{{secure_url('product-config/json')}}";
</script>
<script src="{{secure_url('js/product-config.js')}}"></script>
<script>
    //var modelJson=<?php //echo json_encode($model); ?>;
    //var problemJson=<?php //echo json_encode($problem); ?>;
    //var estPriceJson=<?php //echo json_encode($estPrice); ?>;
    //var cusObjData=<?php //echo json_encode($customerData); ?>;

    var selectedDefCusPOSSCRvFour="";
    var defCusIDCusPOSSCRvFour=0;
        @if(!isset($cart->customerID))
            @if(empty($cart->customerID))
        selectedDefCusPOSSCRvFour=" selected='selected'  ";
            @endif
        @endif

        @if(isset($cart->customerID))
        defCusIDCusPOSSCRvFour="<?php echo $cart->customerID; ?>";
        @endif



        var transactionStoreAddHowMowKhaoUrlCartPOSvfour="{{secure_url('/transaction/store')}}";
        var AddHowMowKhaoUrlcounterdisplaystatuschangeCartPOSvfour="{{secure_url('counter-display-status-change')}}";
        var defaultProductimgURLCartPOSvfour="{{secure_url('images/product-avater-2.jpg')}}";

        var CounterCartPaymentStatusAddProductUrlCartPOSvfour="{{secure_url('cart/counter-payment/status')}}";

        @if($drawerStatus==0) 
            $(".checkDrawer").fadeOut('fast');
        @else
            $(".checkDrawer").fadeIn('fast');
        @endif

        var payoutFromPOSScreenCartPOSvfour="{{secure_url('cart/pos/payout')}}";
        var changeSalesViewTwoCartPOSvfour="{{secure_url('sales')}}";
        var OpenStoreAddHowMowKhaoUrlUrlCartPOSvfour="{{secure_url('open/store')}}";
        var closeStorePrintLocationAddHowMowKhaoUrlCartPOSvfour="{{secure_url('close/print/store')}}";
        var closeStoreAddHowMowKhaoUrlCartPOSvfour="{{secure_url('close/store')}}";
        var addAuthrizePaymentURLCartPOSvfour="{{secure_url('authorize/net/capture/pos/payment')}}";
        var paPaymentypaHowMawHkhawl="{{secure_url('invoice/pos/pay/paypal')}}";
        var clposLinkClearPOSScreen="{{secure_url('pos/clear')}}";
        


    @if(isset($ps))
        var taxRatePOSCartInit=$("#taxRate").val();
    @else
        var taxRatePOSCartInit=0;
    @endif

        var pingDeviceURLCartPOSvfour="{{secure_url('bolt/ping')}}";
        var boltTokenCaptureURLCartPOSvfour="{{secure_url('bolt/token')}}";
        var boltCaptureURLCartPOSvfour="{{secure_url('bolt/capture')}}";
        var addCardPointePaymentURLCartPOSvfour="{{secure_url('cardpointe/pos/payment')}}";
        var savenewcustomerAddNewCustomerUrl="{{secure_url('customer/pos/ajax/add')}}";
        var savenewcustomerAddCustomerPOSUrl="{{secure_url('sales/cart/customer')}}";
        var AddHowMowKhaoUrlCartPOSvfour="{{secure_url('sales/cart/complete-sales')}}";
        var AddHowMowKhaoUrlCartPOSvfourPrintPDFSalesRec="{{secure_url('sales/invoice/print/media/pdf')}}";

           // sales/cart/payment
        var addAuthrizePaymentURLauthorizenetcapturepospayment="{{secure_url('authorize/net/capture/pos/payment')}}";

        var makePaymentInitialDefaultAddPOSUrl="{{secure_url('sales/cart/payment')}}";
        var ApplyDiscountInCartAddProductUrl="{{secure_url('sales/cart/assign/discount')}}";
        var GAddProductToCartAddProductUrl="{{secure_url('product/ajax/save')}}";
        var GAddProductToCartAddPOSUrl="{{secure_url('sales/cart/add')}}";
        var editRowLiveAddPOSUrl="{{secure_url('sales/cart/custom/add')}}";
        var delposSinleRowAddPOSUrl="{{secure_url('sales/cart/row/delete')}}";
        var verifyManagerLogin="{{secure_url('ma/verify')}}";
        var cartProductImgUrl="{{secure_url('upload/product')}}";
        var product_image_status=0;
        @if(isset($product_image_status))
            @if($product_image_status->product_image_status==1)
                product_image_status=1;
            @endif
        @endif
</script>

<script src="{{secure_url('js/pos.js')}}" type="text/javascript"></script>
<script src="{{secure_url('js/intregation.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    var sales_return_invoice_detail = "{{secure_url('sales/return/invoice/detail')}}";
    var sales_return_item = "{{secure_url('sales/return/item')}}";
    var sales_return_invoice_ajax="{{secure_url('sales/return/invoice/ajax')}}";
    var sales_return_save_ajax="{{secure_url('sales/return/save/ajax')}}";
    var posinstorerepair_repair_info_pos_ajax = "{{secure_url('repair/info/pos/ajax')}}";
    var posinstorerepair_repair_list = "{{secure_url('repair/list')}}";
    var posinstorerepair_ticket_list = "{{secure_url('ticket/list')}}";
    var posinstorerepair_ticket_info_pos_ajax = "{{secure_url('ticket/info/pos/ajax')}}";
    var posinstorerepair_repair_product_ajax = "{{secure_url('repair/product/ajax')}}";
    var posinstorerepair_product_ajax_ticket_save = "{{secure_url('product/ajax/ticket/save')}}";
    var punch_attendance_punch_save="{{secure_url('attendance/punch/save')}}";
    var tax_settings_tax_settype="{{secure_url('settings/tax/settype')}}";
    var warranty_warranty_invoice_ajax = "{{secure_url('warranty/invoice/ajax')}}";
    var warranty_warranty_invoice_product_ajax = "{{secure_url('warranty/invoice/product/ajax')}}";
    var warranty_warranty_cart_add_invoice_id = "{{secure_url('warranty/cart/add')}}";
    var buyback_buyback_pos_ajax="{{secure_url('buyback/pos/ajax')}}";
    var partialpayment_partialpay_invoice_ajax = "{{secure_url('partialpay/invoice/ajax')}}";
    var partialpayment_partial_pay_paypal = "{{secure_url('partial/pay/paypal')}}";
    var partialpayment_cardpointe_partial_payment="{{secure_url('cardpointe/partial/payment')}}";
    var partialpayment_bolt_pingDevice = "{{secure_url('bolt/ping')}}";
    var partialpayment_bolt_token="{{secure_url('bolt/token')}}";
    var partialpayment_bolt_partial_capture="{{secure_url('bolt/partial/capture')}}";
    var partialpayment_stripepartialURL="{{secure_url('stripepartial')}}";
    var partialpayment_authorize_net_capture_pos_partial_payment = "{{secure_url('authorize/net/capture/pos/partial/payment')}}";
    var partialpayment_addPartialPayment_env = "{{$addPartialPayment}}";
    var partialpayment_partial_invoice_invoiceID = "{{$partial_invoice}}";
</script>
<script src="{{secure_url('js/sales-return.js')}}"></script>
<script src="{{secure_url('js/posinstorerepair.js')}}"></script>
<script src="{{secure_url('js/warranty.js')}}"></script>
<script src="{{secure_url('js/partial-payment.js')}}"></script>
@endsection

