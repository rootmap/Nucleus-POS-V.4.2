@extends('apps.layout.master')
@section('title','New Repair')
@section('content')
<section id="form-action-layouts">
	<?php 
	    $userguideInit=StaticDataController::userguideInit();
	    //dd($dataMenuAssigned);
	?>
	<div class="row">
		<div class="col-md-6 offset-md-3" @if($userguideInit==1) data-step="1" data-intro="Please select Device, Model & Problem then use next to set repair price, use system define repair price or you can override price & select your customer from drop down menu also you can search existing customer / create new customer after that click button next if you want to continue with system define  price or you can use override price and then fillup next page all addition device info and submit" @endif>
	        <div class="card">

                <style type="text/css">
                    .select2-container--default .select2-selection--single
                    {
                        border-radius: 0px !important;
                    }
                </style>
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-card-center">
	                	<i style="font-size: 25px; color: #fff;" class="fa icon-rtmat">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                        </i>
	                    New Inventory Repair
	            	</h4>
	                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
	                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-body collapse in">
	                <div class="card-block">
						<form method="post"  
						@if(isset($editData))
							action="{{url('repair-update/'.$editData->id)}}" 
						@else 
							action="{{url('repair-save')}}" 
						@endif
						class="form form-horizontal striped-labels" id="repair_new_form">
							{{csrf_field()}}

                            <div class="col-md-12" id="InstoreMSG"></div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row pb-2">
                                        <div class="col-md-12">
                                            <div class="input-group border-green" style="width: 100%;">
                                                <span style="cursor: pointer;" class="input-group-addon addNewCustomerPOS green" id="basic-addon4"><i class="icon-user-plus"></i> New Customer</span>
                                                <select style="width: 100%; font-size: 16px !important; font-weight: bolder;" class="select2 form-control" name="customer_id" id="customer_id">
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

                                        <div class="col-md-12 pt-2">
                                            <div class="input-group border-green" style="width: 100%;">
                                                <span class="input-group-addon" style="background: none;" id="basic-addon4"><i class="icon-cogs"></i> Choose Repair Options</span>
                                                <select style="width: 100%; font-size: 16px !important; font-weight: bolder;" class="select2 form-control" name="repair_option" id="repair_option">
                                                    <option value="">Select Option</option>
                                                    <option value="repair_parts">Repair with and without inventory parts</option>
                                                    <option value="repair">Repair without inventory parts</option>
                                                    <option value="parts">Repair with inventory parts</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12 pt-2 rep_parts">
                                            <div class="input-group border-green" style="width: 100%;">
                                                <span class="input-group-addon" style="background: none;" id="basic-addon4"><i class="icon-database"></i> Choose Parts</span>
                                                <select style="width: 100%; font-size: 16px !important; font-weight: bolder;" class="select2 form-control" name="parts_id" id="parts_id">
                                                    <option value="">Select Parts</option>
                                                </select>
                                                <span style="background:none; border:0px !important;" class="input-group-addon green" id="basic-addon4">
                                                    <button class="btn btn-green add_pos_parts" type="button"><i class="icon-plus"></i> Add Parts</button>
                                                </span>
                                            </div>
                                        </div>

                                        
                                        
                                    </div>
                                    
                                    <div class="row">
                                        <table class="table table-border">
                                            <thead>
                                                <tr>
                                                    <th colspan="4">
                                                        Repair Parts Required
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Parts</th>
                                                    <th>Price</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="parts_table">
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 rep_repairs">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3 class="text-xs-left">Repair Info</h3>
                                                    <hr />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 pb-2">
                                            <div class="row">
                                                <div class="col-md-6 rep_repairs">
                                                    <div class="form-group">
                                                        <label class="label-control" for="projectinput1">
                                                            Device
                                                        </label>
                                                        <input type="text"  class="form-control" placeholder="Device" name="device">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 rep_repairs">
                                                    <div class="form-group">
                                                        <label class="label-control"  for="projectinput1">
                                                            Problem Type
                                                        </label>
                                                        <input type="text"  class="form-control" placeholder="Problem Type" name="problem_type">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 rep_repairs">
                                                    <div class="form-group">
                                                        <label class="label-control" for="projectinput1">
                                                            Cost
                                                        </label>
                                                        <input type="text"  class="form-control" placeholder="Cost" name="cost">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 rep_repairs">
                                                    <div class="form-group">
                                                        <label class="label-control"  for="projectinput1">
                                                            Price
                                                        </label>
                                                        <input type="text"  class="form-control" placeholder="Price" name="price">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 rep_parts rep_repairs">
                                                    <div class="form-group">
                                                        <label class="label-control" for="projectinput1">
                                                            Password
                                                        </label>
                                                        <input type="text"  class="form-control" placeholder="Password" name="password">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 rep_parts rep_repairs">
                                                    <div class="form-group">
                                                        <label class="label-control" for="projectinput1">
                                                            Imei
                                                        </label>
                                                        <input type="text"  class="form-control" placeholder="Imei" name="imei">
                                                    </div>
                                                </div>
                                                <div class="col-md-12  pt-2 rep_parts rep_repairs">
                                                    <div class="form-group">
                                                        <label for="projectinput2">Notes</label>
                                                        <textarea name="notes" id="notes" cols="30" rows="4" class="form-control"></textarea>
                                                    </div>
                                                    <input type="hidden" name="directcart" id="directcart" value="0" />
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div> 
                                </div>
                            </div>
                            
							<div class="form-actions center">
				                  <button type="button" class="btn btn-warning"  id="savenaddtoCart" style="margin-right: 10px;">
				                      <i class="icon-cart"></i> Save & Add To Cart
				                  </button>
				                  <button type="submit" class="btn btn-green" id="finish">
				                      <i class="icon-forward"></i> Finish &amp; Add Repair List
				                  </button>
				                  <button type="reset" class="btn btn-danger" id="reset_repair">
				                      <i class="icon-trash"></i> Reset
				                  </button>

	                        </div>


							</div>
				

						</form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

</section>
<script type="text/javascript">
    var product_pos_settings_parts_url = "{{secure_url('parts-config/json')}}";
    var customer_short_json_url = "{{secure_url('customer/short/json')}}";
    var savenewcustomerAddCustomerPOSUrl="{{secure_url('sales/cart/customer')}}";
    var savenewcustomerAddNewCustomerUrl="{{secure_url('customer/pos/ajax/add')}}";
    //rep_parts
    
</script>

@include('apps.include.modal.new-customer')
@endsection



@include('apps.include.datatable',['selectTwo'=>1,'parts_js'=>1])
