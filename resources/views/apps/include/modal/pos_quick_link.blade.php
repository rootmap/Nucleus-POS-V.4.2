<style type="text/css">
    .dropdown-toggle::after
    {
        top: -7px !important;
    }

    .spfontcartfotter
    {
        font-size: 28px !important; font-weight: 700;
    }

</style>


<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 button button6 checkDrawer" @if($userguideInit==1) data-step="13" data-intro="When you click Make Payment button then popup new payment screen to pay via customer credit card/other card or paypal or cash." @endif>
    
    <button id="btn-payment-modal_init" data-toggle="modal" data-target="#payModal"  type="button" class="btn btn-green btn-darken-2 btn-responsive btn1  spfontcartfotter" style="font-size: 15px !important; font-weight: 600;">     
       <i class="icon-cash"></i> Make Payment
    </button>
</div>

<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 button button1 btn-group checkDrawer" @if($userguideInit==1) data-step="15" data-intro="After paid payment then click print invoice button and you print this invoice." @endif>
    <button  type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-green btn-darken-3 btn-responsive btn1  dropdown-toggle spfontcartfotter" style="font-size: 15px !important; font-weight: 600;"><i class="icon-printer4"></i> Print Invoice &nbsp;</button>      
        <div class="dropdown-menu">
            <a class="dropdown-item printncompleteSale" data-id="pos" href="javascript:void(0);"><i class="icon-printer4"></i> Default Print</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item printncompleteSale"  data-id="thermal"  href="javascript:void(0);"><i class="icon-ios-printer-outline"></i> Thermal Print</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item printncompleteSale"  data-id="barcode" href="javascript:void(0);"><i class="icon-barcode2"></i> Barcode Print</a>
        </div>

</div>   

<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 button button6 checkDrawer"  @if($userguideInit==1) data-step="14" data-intro="After paid payment then click complete sale button and create a new invoice." @endif>
    <button id="completesale" type="button" class="btn btn-block btn1 btn-green btn-darken-4 btn-responsive btn1 spfontcartfotter" style="font-size: 15px !important; font-weight: 600;">     
       <i class="icon-circle-check"></i>  Complete Sale
    </button>
</div>

<div @if($drawerStatus==1)  style="display: none;" @endif class="col-xs-6 col-sm-6 col-md-6 col-lg-6 button button6 opdStore"  @if($userguideInit==1) data-step="14" data-intro="After paid payment then click complete sale button and create a new invoice." @endif>
    <button id="completesale" type="button" class="btn btn-block btn1 btn-green btn-darken-4 btn-responsive btn1 spfontcartfotter"   data-toggle="modal" data-target="#open-drawer" style="font-size: 15px !important; font-weight: 600;">     
       <i class="icon-hand-grab-o"></i> Open Drawer
    </button>
</div>

<div @if($drawerStatus==0)  style="display: none;"  @endif class="col-xs-6 col-sm-6 col-md-6 col-lg-6 button button6 cldStore"  @if($userguideInit==1) data-step="14" data-intro="After paid payment then click complete sale button and create a new invoice." @endif>
    <button id="completesale" type="button" class="btn btn-block btn1 btn-green btn-darken-4 btn-responsive btn1 spfontcartfotter"  onclick="loadCloseDrawer()" style="font-size: 15px !important; font-weight: 600;">     
       <i class="icon-hand-grab-o"></i> Close Drawer
    </button>
</div>

<!-- <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 button button6"  @if($userguideInit==1) data-step="17" data-intro="When you click change sales view button then redirect to add product for sale page." @endif>
    <button id="changeSalesView" type="button" class="btn btn-green btn-responsive btn1 spfontcartfotter" style="font-size: 15px !important; font-weight: 600;">     
        <i class="icon-stack3"></i> Change Sales View
    </button>
</div>

<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 button button6"  @if($userguideInit==1) data-step="18" data-intro="In this button you can start / turn off your counter display." @endif>
    <button  type="button" class="btn btn-green btn-darken-2 btn-responsive btn1 spfontcartfotter" style="font-size: 14px !important; font-weight: 600;"> <i class="icon-air-play"></i>  
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
</div> -->

<!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button button6"  @if($userguideInit==1) data-step="20" data-intro="When you click sales return then popup new window." @endif>
    <button type="button" class="btn btn-green btn-darken-1 btn-responsive btn1 spfontcartfotter"  data-toggle="modal" data-target="#salesReturn" style="font-size: 15px !important; font-weight: 600;">     
        <i class="icon-document"></i> Sales Return
    </button>
</div> -->

<!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button button6"  @if($userguideInit==1) data-step="21" data-intro="When you click create warranty then it will go to warranty page." @endif>
    <button type="button" class="btn btn-green btn-darken-3 warranty btn-responsive btn1 spfontcartfotter" style="font-size: 15px !important; font-weight: 600;">     
        <i class="icon-ribbon-b"></i> Create Warranty
    </button>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button button6"  @if($userguideInit==1) data-step="19" data-intro="When you click add partial payment then popup new window." @endif>
    <button type="button" class="btn btn-green btn-darken-4 btn-responsive btn1 addPartialPayment spfontcartfotter" style="font-size: 15px !important; font-weight: 600;">     
        <i class="icon-money"></i> Add Partial Payment
    </button>
</div>



<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 button button6" @if($userguideInit==1) data-step="22" data-intro="When you click create buyback then it will go to buyback page." @endif>
    <button type="button" class="btn btn-green buybackpull btn-darken-2 btn-responsive btn1 spfontcartfotter"  style="font-size: 15px !important; font-weight: 600;">     
        <i class="icon-random"></i> Create Buyback
    </button>
</div>
 -->



