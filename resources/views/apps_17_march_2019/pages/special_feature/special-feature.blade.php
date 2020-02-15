@extends('apps.layout.master')
@section('title','Special Feature')
@section('content')
<?php 
    $dataMenuAssigned=array();
    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
    //dd($dataMenuAssigned);
?>
<section id="file-exporaat">
		<div class="row">
		<div class="col-md-8 offset-md-2">

						    <div class="form-body">
									<div class="row">
										
										@if(in_array('specialorderparts', $dataMenuAssigned))
										<div style="height: 200px;  !important;" class="col-lg-6 col-sm-12  bg-green bg-darken-2 ">
											<div class="col-md-5">
								                <div class="card-block text-xs-center" style="padding: 3rem 0px !important;">
								                    <h1 class="display-6 white"><i class="icon-cart font-large-3"></i></h1>
								                    <span class="white text-uppercase">Special Order Parts</span>
								                </div>
							            	</div>
							            	<div class="col-md-7" style="padding-right: 0px !important;">
							            		<ul class="list-group list-group-flush" style="margin-right: 0px !important; padding-right: 0px !important; margin-top: 50px;">
							            			@if(in_array('special/parts/create', $dataMenuAssigned))
													<li class="list-group-item" style="background: none; border: 1px solid #DDD; border-left: 1px solid #DDD !important; color: #fff;">
														<a href="{{url('special/parts/create')}}" style="text-decoration: none;  color: #fff;" target="_blank">
															<i class="icon-circle-plus"></i> Add New Order
														</a>
													</li>
													@endif 
													@if(in_array('special/parts/list', $dataMenuAssigned))
													<li class="list-group-item" style="background: none; border: 1px solid #DDD; border-left: 1px solid #DDD !important;  color: #fff;">
														<a href="{{url('special/parts/list')}}" style="text-decoration: none;  color: #fff;" target="_blank">
															<i class="icon-paper"></i> List of Special Parts
														</a>
													</li>
													@endif 
												</ul>
							            	</div>
							            </div>
							            @endif

							            @if(in_array('spbuyback', $dataMenuAssigned))
							            <div style="height: 200px;"  class="col-lg-6 col-sm-12 bg-green bg-darken-1">
							                <div class="col-md-5">
								                <div class="card-block text-xs-center" style="padding: 3rem 0px !important;">
								                    <h1 class="display-6 white"><i class="icon-repeat2 font-large-3"></i></h1>
								                    <span class="white text-uppercase">Buyback</span>
								                </div>
							            	</div>
							            	<div class="col-md-7" style="padding-right: 0px !important;">
							            		<ul class="list-group list-group-flush" style="margin-right: 0px !important; padding-right: 0px !important; margin-top: 30px;">
													
													@if(in_array('buyback/create', $dataMenuAssigned))
													<li class="list-group-item" style="background: none; border: 1px solid #DDD; border-left: 1px solid #DDD !important; color: #fff;">
														<a href="{{url('buyback/create')}}" style="text-decoration: none;  color: #fff;" target="_blank">
															<i class="icon-circle-plus"></i> Add New Buyback
														</a>
													</li>
													@endif 
													@if(in_array('buyback/list', $dataMenuAssigned))
													<li class="list-group-item" style="background: none; border: 1px solid #DDD; border-left: 1px solid #DDD !important;  color: #fff;">
														<a href="{{url('buyback/list')}}" style="text-decoration: none;  color: #fff;" target="_blank">
															<i class="icon-paper"></i> List of Buyback
														</a>
													</li>
													@endif 
													@if(in_array('report/buyback', $dataMenuAssigned))
													<li class="list-group-item" style="background: none; border: 1px solid #DDD; border-left: 1px solid #DDD !important;  color: #fff;">
														<a href="{{url('report/buyback')}}" style="text-decoration: none;  color: #fff;" target="_blank">
															<i class="icon-bar-graph-2"></i> Buyback Reports
														</a>
													</li>
													@endif
												</ul>
							            	</div>
							            </div>
							            @endif

							            @if(in_array('spwarranty', $dataMenuAssigned))
							            <div style="height: 200px;"  class="col-lg-6 bg-green bg-accent-3 col-sm-12 ">
							                <div class="col-md-5">
								                <div class="card-block text-xs-center" style="padding: 3rem 0px !important;">
								                    <h1 class="display-6 white"><i class="icon-ribbon-b font-large-3"></i></h1>
								                    <span class="white text-uppercase">Warranty</span>
								                </div>
							            	</div>
							            	<div class="col-md-7" style="padding-right: 0px !important;">
							            		<ul class="list-group list-group-flush" style="margin-right: 0px !important; padding-right: 0px !important; margin-top: 30px;">
							            			@if(in_array('warranty', $dataMenuAssigned))
													<li class="list-group-item" style="background: none; border: 1px solid #DDD; border-left: 1px solid #DDD !important; color: #fff;">
														<a href="{{url('warranty')}}" style="text-decoration: none;  color: #fff;" target="_blank">
															<i class="icon-circle-plus"></i> Add New Warranty
														</a>
													</li>
													@endif 
													@if(in_array('warranty/batch-out', $dataMenuAssigned))
													<li class="list-group-item" style="background: none; border: 1px solid #DDD; border-left: 1px solid #DDD !important;  color: #fff;">
														<a href="{{url('warranty/batch-out')}}" style="text-decoration: none;  color: #fff;" target="_blank">
															<i class="icon-paper"></i> Warranty Inventory
														</a>
													</li>
													@endif 
													@if(in_array('warranty/report', $dataMenuAssigned))
													<li class="list-group-item" style="background: none; border: 1px solid #DDD; border-left: 1px solid #DDD !important;  color: #fff;">
														<a href="{{url('warranty/report')}}" style="text-decoration: none;  color: #fff;" target="_blank">
															<i class="icon-bar-graph-2"></i> Batch Out Report
														</a>
													</li>
													@endif 
												</ul>
							            	</div>
							            </div>
							            @endif

							            @if(in_array('spsalesreturn', $dataMenuAssigned))
							            <div style="height: 200px;"  class="col-lg-6 bg-green bg-lighten-1 col-sm-12" >
							                <div class="col-md-5">
								                <div class="card-block text-xs-center" style="padding: 3rem 0px !important;">
								                    <h1 class="display-6 white"><i class="icon-cart-arrow-down font-large-3"></i></h1>
								                    <span class="white text-uppercase">Sales Return </span>
								                </div>
							            	</div>
							            	<div class="col-md-7" style="padding-right: 0px !important;">
							            		<ul class="list-group list-group-flush" style="margin-right: 0px !important; padding-right: 0px !important; margin-top: 50px;">
							            			@if(in_array('sales/return/create', $dataMenuAssigned))
													<li class="list-group-item" style="background: none; border: 1px solid #DDD; border-left: 1px solid #DDD !important; color: #fff;">
														<a href="{{url('sales/return/create')}}" style="text-decoration: none;  color: #fff;" target="_blank">
															<i class="icon-circle-plus"></i> Add New Return 
														</a>
													</li>
													@endif 
													@if(in_array('sales/return/list', $dataMenuAssigned))
													<li class="list-group-item" style="background: none; border: 1px solid #DDD; border-left: 1px solid #DDD !important;  color: #fff;">
														<a href="{{url('sales/return/list')}}" style="text-decoration: none;  color: #fff;" target="_blank">
															<i class="icon-paper"></i> List of Sales Return 
														</a>
													</li>
													@endif 
												</ul>
							            	</div>
							            </div>
							            @endif

							            @if(in_array('spexpensevoucher', $dataMenuAssigned))
							            <div style="height: 200px;"  class="col-lg-6 bg-green bg-darken-1 col-sm-12" >
							                <div class="col-md-5">
								                <div class="card-block text-xs-center" style="padding: 3rem 0px !important;">
								                    <h1 class="display-6 white"><i class="icon-book3 font-large-3"></i></h1>
								                    <span class="white text-uppercase">Expense Voucher  </span>
								                </div>
							            	</div>
							            	<div class="col-md-7" style="padding-right: 0px !important;">
							            		<ul class="list-group list-group-flush" style="margin-right: 0px !important; padding-right: 0px !important; margin-top: 50px;">
							            			
													@if(in_array('expense/voucher', $dataMenuAssigned))
													<li class="list-group-item" style="background: none; border: 1px solid #DDD; border-left: 1px solid #DDD !important; color: #fff;">
														<a href="{{url('expense/voucher')}}" style="text-decoration: none;  color: #fff;" target="_blank">
															<i class="icon-circle-plus"></i> Add New Expense  
														</a>
													</li>
													@endif 

													@if(in_array('expense/voucher/report', $dataMenuAssigned))
													<li class="list-group-item" style="background: none; border: 1px solid #DDD; border-left: 1px solid #DDD !important;  color: #fff;">
														<a href="{{url('expense/voucher/report')}}" style="text-decoration: none;  color: #fff;" target="_blank">
															<i class="icon-bar-graph-2"></i> Expense   Reports
														</a>
													</li>
													@endif 
												</ul>
							            	</div>
							            </div>
										 @endif
				                        
									</div>
								</div>	

			</div>
		</div>
	</div>
<!-- Both borders end -->


</section>
@endsection
