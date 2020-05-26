@extends('apps.layout.master')
@section('title','New Inventory Repair')
@section('content')
<section id="form-action-layouts">
	<?php 
	    $userguideInit=StaticDataController::userguideInit();
	    //dd($dataMenuAssigned);
	?>
	<div class="row">
		<div class="col-md-6 offset-md-3" @if($userguideInit==1) data-step="1" data-intro="Please select Device, Model & Problem then use next to set repair price, use system define repair price or you can override price & select your customer from drop down menu also you can search existing customer / create new customer after that click button next if you want to continue with system define  price or you can use override price and then fillup next page all addition device info and submit" @endif>
	        <div class="card">

	 
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
							action="{{url('repair/update/'.$editData->id)}}" 
						@else 
							action="{{url('repair/save')}}" 
						@endif
						class="form form-horizontal striped-labels">
							{{csrf_field()}}

							<div class="col-md-12" id="InstoreMSG"></div>
							
							<div class="row">
								
								<input type="hidden" name="repairPage" value="1">

								<div class="col-md-12 step1">
					                <div class="form-group row">
					                    <label for="userinput1" class="col-md-2 label-control" style="text-align: right;">Device <span class="text-danger">*</span></label>
					                    <div class="col-md-8">
					                        <select  name="device_id" id="device_id" class="select2 form-control" style="width: 100%;"> 
					                          <option value="">Please Select</option>
					                          @if(isset($device))
					                            @foreach($device as $pro)
					                            <option  value="{{$pro->id}}">
					                              {{$pro->name}}
					                            </option>
					                            @endforeach
					                          @endif
					                      </select>
					                    </div>
					                    
					                </div>
					              </div>
					              <div class="col-md-12 step1">
					                  <div class="form-group row">
					                      <label for="userinput1" class="col-md-2 label-control" style="text-align: right;">
					                        Model <span class="text-danger">*</span>
					                      </label>
					                      <div class="col-md-8">
					                        <select  name="model_id" class="select2 form-control" style="width: 100%;"> 
					                          <option value="">Please Select</option>
					                          @if(isset($productData))
					                            @foreach($productData as $pro)
					                            <option  value="{{$pro->id}}">
					                              {{$pro->name}}
					                            </option>
					                            @endforeach
					                          @endif
					                        </select>
					                        
					                      </div>
					                </div>
					              </div>
					              
					              <div class="col-md-12 step1">
					                  <div class="form-group row">
					                      <label for="userinput1" class="col-md-2 label-control" style="text-align: right;">Problem <span class="text-danger">*</span></label>
					                      <div class="col-md-8">
					                            <select name="problem_id" class="select2 form-control" style="width: 100%;"> 
					                                <option value="">Please Select</option>
					                                @if(isset($productData))
					                                  @foreach($productData as $pro)
					                                  <option  value="{{$pro->id}}">
					                                    {{$pro->name}}
					                                  </option>
					                                  @endforeach
					                                @endif
					                          </select>
					                      </div>
					                      
					                </div>
					              </div>

					              <div class="col-md-12 step2" style="display: none;">
					                  <div class="form-group row">
					                      <label for="userinput1" class="col-md-12 label-control" style="text-align: center; ">
					                          <h4 class="subtitle align-left" style="padding-left:10px;">
					                            <i class="icon-eye-open"></i> Repair Price : $<span id="repair_price">0.00</span> </h4>
					                      </label>                      
					                </div>
					              </div>
					              <div class="col-md-12 step2" style="display: none;">
					                  <div class="form-group row">
					                      <label for="userinput1" class="col-md-4 label-control" style="text-align: right;">Override Price 
					                        <span class="text-danger">*</span>
					                      </label>
					                      <div class="col-md-6">
					                            <input type="text" class="form-control" name="override_repair_price" value="0">
					                            <input type="hidden" class="form-control" name="repair_price" value="0">
					                      </div>
					                      
					                </div>
					              </div>

					              <div class="col-md-12 step2" style="display: none;">
					                  <div class="form-group row">
					                      <label for="userinput1" class="col-md-4 label-control" style="text-align: right;">Customer <span class="text-danger">*</span></label>
					                      <div class="col-md-6">
					                            <select name="customer_id" class="select2 form-control" style="width: 100%;"> 
					                                <option value="">Please Select</option>
					                                <option value="CR000">Create New Customer</option>
					                                @if(isset($customer))
					                                  @foreach($customer as $pro)
					                                  <option  value="{{$pro->id}}">
					                                    {{$pro->name}}
					                                  </option>
					                                  @endforeach
					                                @endif
					                          </select>
					                      </div>
					                      
					                </div>
					              </div>

					              <div class="col-md-12 step2_repair_new_customer" style="display: none;">
					                  <div class="form-group row">
					                      <label for="userinput1" class="col-md-4 label-control" style="text-align: right;">Full Name 
					                        <span class="text-danger">*</span>
					                      </label>
					                      <div class="col-md-6">
					                            <input type="text" class="form-control"  name="full_name" placeholder="Enter Customer Full Name">
					                      </div>
					                      
					                </div>
					              </div>

					              <div class="col-md-12 step2_repair_new_customer" style="display: none;">
					                  <div class="form-group row">
					                      <label for="userinput1" class="col-md-4 label-control" style="text-align: right;">Address 
					                        <span class="text-danger">*</span>
					                      </label>
					                      <div class="col-md-6">
					                            <input type="text" class="form-control"  name="address" placeholder="Enter Address">
					                      </div>
					                      
					                </div>
					              </div>

					              <div class="col-md-12 step2_repair_new_customer" style="display: none;">
					                  <div class="form-group row">
					                      <label for="userinput1" class="col-md-4 label-control" style="text-align: right;">Phone 
					                        <span class="text-danger">*</span>
					                      </label>
					                      <div class="col-md-6">
					                            <input type="text" class="form-control" name="phone" placeholder="Enter Phone">
					                      </div>
					                      
					                </div>
					              </div>

					              <div class="col-md-12 step2_repair_new_customer" style="display: none;">
					                  <div class="form-group row">
					                      <label for="userinput1" class="col-md-4 label-control" style="text-align: right;">Email 
					                        <span class="text-danger">*</span>
					                      </label>
					                      <div class="col-md-6">
					                            <input type="text" class="form-control" name="email" placeholder="Enter Email">
					                      </div>
					                      
					                </div>
					              </div>

					              <div class="row step3" style="display: none;"> 
                

					                <div class="col-md-12 mb-1">
					                    <div class="col-md-6">
					                      <div class="form-group">
					                        <label for="projectinput1">Password</label>
					                        <input type="text" id="projectinput1" class="form-control" placeholder="Password" name="repair_password">
					                      </div>
					                    </div>
					                    <div class="col-md-6">
					                      <div class="form-group">
					                        <label for="projectinput2">IMEI</label>
					                        <input type="text" id="projectinput2" class="form-control" placeholder="IMEI Number" name="repair_imei">
					                      </div>
					                    </div>
					                </div>

					                <div class="col-md-12 mb-1">
					                    <div class="col-md-6">
					                      <div class="form-group">
					                        <label for="projectinput1">Tested Before By</label>
					                        <input type="text" id="projectinput1" class="form-control" placeholder="Tested Before By Name" name="repair_tested_before_by">
					                      </div>
					                    </div>
					                    <div class="col-md-6">
					                      <div class="form-group">
					                        <label for="projectinput2">Tested After By </label>
					                        <input type="text" id="projectinput2" class="form-control" placeholder="Tested After By Name" name="repair_tested_after_by">
					                      </div>
					                    </div>
					                </div>

					                <div class="col-md-12 mb-1">
					                    <div class="col-md-6">
					                      <div class="form-group">
					                        <label for="projectinput1">Tech Notes</label>
					                        <input type="text" id="projectinput1" class="form-control" placeholder="Tech Notes" name="repair_tech_notes">
					                      </div>
					                    </div>
					                    <div class="col-md-6">
					                      <div class="form-group">
					                        <label for="projectinput2">How did you hear about us ? </label>
					                        <input type="text" id="projectinput2" class="form-control" placeholder="How did you hear about us" name="repair_how_did_you_hear_about_us">
					                      </div>
					                    </div>
					                </div>

					                <div class="col-md-12 mb-1">
					                    <div class="col-md-6">
					                      <div class="form-group">
					                        <label for="projectinput1">Start Time</label>
					                        <input type="text" id="projectinput1" class="form-control" placeholder="Start Time" name="repair_start_time">
					                      </div>
					                    </div>
					                    <div class="col-md-6">
					                      <div class="form-group">
					                        <label for="projectinput2">End Time </label>
					                        <input type="text" id="projectinput2" class="form-control" placeholder="End Time" name="repair_end_time">
					                      </div>
					                    </div>
					                </div>

					                <div class="col-md-12">
					                    
					                    <div class="col-md-6">
					                      <div class="form-group">
					                        <label for="projectinput1"><input type="checkbox" id="projectinput1" name="repair_salvage_part"  /> Salvage Part </label>
					                      </div>
					                    </div>

					                    <div class="col-md-6">
					                      <div class="form-group">
					                        <label for="projectinput2"><i class="icon-check"></i> Please Check The Additional Info</label>
					                        <div class="form-control" style="clear: both; display: block; height: 150px; overflow-x: auto;">
					                            @if(isset($ticketAsset))
					                              @foreach($ticketAsset as $rep)
					                                <div class="col-md-12">
					                                  <input type="checkbox" id="projectinput2" name="repair_{{strtolower(preg_replace('/[^a-zA-Z0-9]/', "",$rep->name))}}"> {{$rep->name}}
					                                  <div class="clearfix"></div>
					                                </div>
					                              @endforeach
					                            @endif
					                        </div>
					                      </div>
					                    </div>
					                </div>


					         

					              </div>
																
								
							</div>





							
							


						



							<div class="form-actions center">

	                              <button type="button" class="btn btn-green" id="step1" @if($userguideInit==1) data-step="2" data-intro="Click next for getting information." @endif>
				                      <i class="icon-forward"></i> Next
				                  </button>
				                  <button type="button" class="btn btn-warning" id="step2_step1" style="display: none; margin-right: 10px;">
				                      <i class="icon-backward"></i> Back
				                  </button>
				                  <button type="button" class="btn btn-green" @if($userguideInit==1) data-step="4" data-intro="When you select all option then click the button next and it will be shown another option." @endif id="step2" style="display: none; margin-right: 10px;">
				                      <i class="icon-forward"></i> Next as Recomended
				                  </button>
				                  <button type="button" class="btn btn-green" id="step2_override" style="display: none;">
				                      <i class="icon-forward"></i> Override Price
				                  </button>
				                  <button type="button" class="btn btn-warning" id="step3_step2" style="display: none; margin-right: 10px;">
				                      <i class="icon-backward"></i> Back
				                  </button>
				                  <button type="submit" class="btn btn-green" id="finish" style="display: none; ">
				                      <i class="icon-forward"></i> Finish To Invenotry Repair List
				                  </button>
				                  <button type="reset" class="btn btn-green" id="reset_repair" style="display: none; ">
				                      <i class="icon-clear"></i>Reset
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
	var productJson=<?php echo json_encode($product); ?>;
    var modelJson=<?php echo json_encode($model); ?>;
    var problemJson=<?php echo json_encode($problem); ?>;
    var estPriceJson=<?php echo json_encode($estPrice); ?>;
</script>
@endsection



@include('apps.include.datatable',['dateDrop'=>1,'selectTwo'=>1,'ticket'=>1,'posinstorerepair'=>1])