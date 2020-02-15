@extends('apps.layout.master')
@section('title','View Buyback - B'.$id)
@section('content')
<section id="file-exporaat">


		<div class="row">
		<div class="col-md-10 offset-md-1">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						<i class="icon-random"></i> Buyback Info - B{{$id}} <code style="float: right;">Double click on field to edit value.</code>
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
						
								<input type="hidden" name="buyback_id" id="buyback_id" value="{{$id}}">

								<div class="row">
									<div class="col-md-6">
										<div class="form-body">
				                    		<h4 class="form-section"><i class="icon-compress"></i> Buyback Info</h4>
				                    		<hr>
				                    		<div class="row" style="margin-bottom: 15px; margin-top: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon" style="width: 120px; background: white;" id="basic-addon11"><b>Status</b></span>
															<input readonly="readonly" name="buyback_status_name" style="background: white; " ondblclick="liveStatusSelectedit(this);" type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon6" value="{{$dataTable->buyback_status_name}}">
															<select name="buyback_status_id" class="form-control" style="display: none;">
																<option selected="selected" value="1">New</option>
														        <option value="2">In Progress</option>
														        <option value="3">Resolved</option>
														        <option value="4">Invoiced</option>
														        <option value="5">Waiting For Parts</option>
														        <option value="6">Waiting on Customer</option>
														        <option value="7">Scheduled</option>
														        <option value="8">Customer Reply</option>
															</select>
															<span class="input-group-btn" id="button-addon6" style="display: none;">
																<button onclick="liveStatusSelectsave(this)" class="btn btn-green bg-green border-green" type="button"><i class="icon-check"></i></button>
															</span>
														</div>
													</fieldset>
						                        </div>
				                    		</div>

				                    		<div class="row invoice_no" style="margin-bottom: 15px; 
				                    		@if($dataTable->invoice_id==0) 
				                    			display: none; 
				                    		@endif 
				                    		">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon"  style="width: 120px; background: white;" id="basic-addon11"><b>Invoice No</b></span>
															<select class="select2" style="width: 200px;" name="invoice_id" class="form-control">
																<option value="">Select a Invoice</option>
																@if(count($invoiceData)>0)
																	@foreach($invoiceData as $row)
																		<option 
																			@if($dataTable->invoice_id==$row->invoice_id) 
																				selected="selected" 
																			@endif 
																		value="{{$row->invoice_id}}">Invoice - {{$row->invoice_id}}</option>
																	@endforeach
														        @endif
															</select>
														</div>
													</fieldset>
						                        </div>
				                    		</div>

				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon"  style="width: 120px; background: white;" id="basic-addon11"><b>Number</b></span>
															<input readonly="readonly"  style="background: white;" type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon6" value="Buyback-{{$dataTable->id}}">
														</div>
													</fieldset>
						                        </div>
				                    		</div>

				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon"  style="width: 120px; background: white;" id="basic-addon11"><b>Created Date</b></span>
															<input readonly="readonly"  style="background: white;" type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon6" value="{{formatDateTime($dataTable->created_at)}}">
														</div>
													</fieldset>
						                        </div>
				                    		</div>

				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon"  style="width: 120px; background: white;" id="basic-addon11"><b>Created By</b></span>
															<input readonly="readonly"  style="background: white;" type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon6" value="{{$created_by}}">
														</div>
													</fieldset>
						                        </div>
				                    		</div>

				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon"  style="width: 120px; background: white;" id="basic-addon11"><b>Pre-Approved</b></span>
															<input readonly="readonly" style="background: white;"  type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon6" value="Approved">
														</div>
													</fieldset>
						                        </div>
				                    		</div>
				                    		
				                    		
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-body">
				                    		<h4 class="form-section"><i class="icon-head"></i> Customer</h4>
				                    		<hr>
				                    		<div class="row" style="margin-bottom: 15px; margin-top: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon" style="width: 120px; background: white;" id="basic-addon11"><b>Name</b></span>
															<input readonly="readonly" name="customer_name" style="background: white;" ondblclick="liveedit(this);" type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon6" value="{{$dataTable->customer_name}}">
															<span class="input-group-btn" id="button-addon6" style="display: none;">
																<button onclick="livesave(this)" class="btn btn-green bg-green border-green" type="button"><i class="icon-check"></i></button>
															</span>
														</div>
													</fieldset>
						                        </div>
				                    		</div>

				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon"  style="width: 120px; background: white;" id="basic-addon11"><b>Address</b></span>
															<input readonly="readonly"  style="background: white;" ondblclick="liveedit(this);" name="address" type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon6" value="{{$customer->address}}">
															<span class="input-group-btn" id="button-addon6" style="display: none;">
																<button onclick="livesave(this)" class="btn btn-green bg-green border-green" type="button"><i class="icon-check"></i></button>
															</span>
														</div>
													</fieldset>
						                        </div>
				                    		</div>

				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon"  style="width: 120px; background: white;" id="basic-addon11"><b>Phone</b></span>
															<input readonly="readonly"  style="background: white;" ondblclick="liveedit(this);" name="phone" type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon6" value="{{$customer->phone}}">
															<span class="input-group-btn" id="button-addon6" style="display: none;">
																<button onclick="livesave(this)" class="btn btn-green bg-green border-green" type="button"><i class="icon-check"></i></button>
															</span>
														</div>
													</fieldset>
						                        </div>
				                    		</div>

				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon"  style="width: 120px; background: white;" id="basic-addon11"><b>Email</b></span>
															<input readonly="readonly"  style="background: white;" ondblclick="liveedit(this);" name="email" type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon6" value="{{$customer->email}}">
															<span class="input-group-btn" id="button-addon6" style="display: none;">
																<button onclick="livesave(this)" class="btn btn-green bg-green border-green" type="button"><i class="icon-check"></i></button>
															</span>
														</div>
													</fieldset>
						                        </div>
				                    		</div>

				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon"  style="width: 120px; background: white;" id="basic-addon11"><b>Created At</b></span>
															<input readonly="readonly" style="background: white;" type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon6" value="{{formatDateTime($customer->created_at)}}">
														</div>
													</fieldset>
						                        </div>
				                    		</div>
				                    		
				                    		
										</div>
									</div>
								</div>

								<h4 style="margin-top: 20px;" class="form-section"><i class="icon-compress"></i> Buyback Detail</h4>
								<hr>

								<div class="row">
									<div class="col-md-6">
										<div class="form-body">
				                    		<div class="row" style="margin-bottom: 15px; margin-top: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon" style="width: 120px; background: white;" id="basic-addon11"><b>Model</b></span>
															<input readonly="readonly" name="model"  style="background: white;" ondblclick="liveedit(this);" type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon6" value="{{$dataTable->model}}">
															<span class="input-group-btn" id="button-addon6" style="display: none;">
																<button onclick="livesave(this)" class="btn btn-green bg-green border-green" type="button"><i class="icon-check"></i></button>
															</span>
														</div>
													</fieldset>
						                        </div>
				                    		</div>

				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon"  style="width: 120px; background: white;" id="basic-addon11"><b>Carrier</b></span>
															<input readonly="readonly" name="carrier"  ondblclick="liveedit(this);"    style="background: white;" type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon6" value="Buyback-{{$dataTable->carrier}}">
															<span class="input-group-btn" id="button-addon6" style="display: none;">
																<button onclick="livesave(this)" class="btn btn-green bg-green border-green" type="button"><i class="icon-check"></i></button>
															</span>
														</div>
													</fieldset>
						                        </div>
				                    		</div>

				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon"  style="width: 120px; background: white;" id="basic-addon11"><b>IMEI</b></span>
															<input readonly="readonly"  ondblclick="liveedit(this);"  style="background: white;"  name="imei" type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon6" value="{{$dataTable->imei}}">
															<span class="input-group-btn" id="button-addon6" style="display: none;">
																<button onclick="livesave(this)" class="btn btn-green bg-green border-green" type="button"><i class="icon-check"></i></button>
															</span>
														</div>
													</fieldset>
						                        </div>
				                    		</div>

				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon"  style="width: 120px; background: white;" id="basic-addon11"><b>Type & Color</b></span>
															<input readonly="readonly" name="type_and_color"  ondblclick="liveedit(this);"  style="background: white;" type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon6" value="{{$dataTable->type_and_color}}">
															<span class="input-group-btn" id="button-addon6" style="display: none;">
																<button onclick="livesave(this)" class="btn btn-green bg-green border-green" type="button"><i class="icon-check"></i></button>
															</span>
														</div>
													</fieldset>
						                        </div>
				                    		</div>
			                    		
				                    		
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-body">
				                    		<div class="row" style="margin-bottom: 15px; margin-top: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon" style="width: 140px; background: white;" id="basic-addon11"><b>Memory</b></span>
															<input readonly="readonly"  style="background: white;" ondblclick="liveedit(this);" name="memory" type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon6" value="{{$dataTable->memory}}">
															<span class="input-group-btn" id="button-addon6" style="display: none;">
																<button onclick="livesave(this)" class="btn btn-green bg-green border-green" type="button"><i class="icon-check"></i></button>
															</span>
														</div>
													</fieldset>
						                        </div>
				                    		</div>

				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon"  style="width: 140px; background: white;" id="basic-addon11"><b>Device Condition</b></span>
															<input readonly="readonly"  style="background: white;" ondblclick="liveedit(this);" name="condition" type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon6" value="{{$dataTable->condition}}">
															<span class="input-group-btn" id="button-addon6" style="display: none;">
																<button onclick="livesave(this)" class="btn btn-green bg-green border-green" type="button"><i class="icon-check"></i></button>
															</span>
														</div>
													</fieldset>
						                        </div>
				                    		</div>

				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon"  style="width: 140px; background: white;" id="basic-addon11"><b>Price</b></span>
															<input readonly="readonly" name="price" style="background: white;" ondblclick="liveedit(this);" type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon6" value="{{$dataTable->price}}">
															<span class="input-group-btn" id="button-addon6" style="display: none;">
																<button onclick="livesave(this)" class="btn btn-green bg-green border-green" type="button"><i class="icon-check"></i></button>
															</span>
														</div>
													</fieldset>
						                        </div>
				                    		</div>

				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon" style="width: 120px; background: white;" id="basic-addon11"><b>Payment Method</b></span>
															<input readonly="readonly" name="payment_method_name" style="background: white; " ondblclick="liveselectedit(this);" type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon6" value="{{$dataTable->payment_method_name}}">
															<select name="payment_method_id" class="form-control" style="display: none;">
																<option value="">Please Select</option>
																 @foreach($tender as $row)
																 	<option 
																 	@if(isset($edit))
																		@if($dataRow->payment_method_id==$row->id)
																			selected="selected" 
																		@endif
																	@endif 
																 	 value="{{$row->id}}">{{$row->name}}</option>
																 @endforeach 
																 @foreach($authorizeNettender as $row)
																 	<option 
																 	@if(isset($edit))
																		@if($dataRow->payment_method_id==$row->id)
																			selected="selected" 
																		@endif
																	@endif 
																 	value="{{$row->id}}">{{$row->name}}</option>
																 @endforeach 
																 @foreach($payPaltender as $row)
																 	<option 
																 	@if(isset($edit))
																		@if($dataRow->payment_method_id==$row->id)
																			selected="selected" 
																		@endif
																	@endif 
																 	value="{{$row->id}}">{{$row->name}}</option>
																 @endforeach 
															</select>
															<span class="input-group-btn" id="button-addon6" style="display: none;">
																<button onclick="liveSelectsave(this)" class="btn btn-green bg-green border-green" type="button"><i class="icon-check"></i></button>
															</span>
														</div>
													</fieldset>
						                        </div>
				                    		</div>

			                    		
										</div>
									</div>
								</div>
															
							
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Both borders end -->


</section>
@endsection

@include('apps.include.datatable',['selectTwo'=>1,'dateDrop'=>1,'view_buyback'=>1])