@extends('apps.layout.master')
@section('title','View Inventory Repair Detail - R'.$data->id)
@section('content')
<section id="file-exporaat">
<?php 
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>

		<div class="row">
		<div class="col-md-12" @if($userguideInit==1) data-step="1" data-intro="You are seeing all the repair information. when you click double click any item then you can edit your information." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						<i class="icon-random"></i> {{$data->repair_type=="Parts"?"Repair with and without inventory parts":"Repair Info"}} - R{{$data->id}} 
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
						
								<input type="hidden" name="repair_id" id="repair_id" value="{{$data->id}}">

								<div class="row">
									<div class="col-md-4">
										<div class="form-body">
				                    		<h4 class="form-section"><i class="icon-cogs2"></i> {{$data->repair_type=="Parts"?"Device Info":"Repair Info"}}</h4>
				                    		<hr>
				                    		
											@if ($data->repair_type!="Parts")
												<div class="row" style="margin-bottom: 15px;  margin-top: 15px;">
													<div class="col-md-12">
														<fieldset class="">
															<div class="input-group">
																<span class="input-group-addon"  style="width: 120px; text-align: left; background: white;" id="basic-addon11"><b>Device</b></span>
																<input readonly="readonly"  style="background: white;" type="text" class="form-control"  aria-describedby="button-addon6" value="{{$data->device}}">
															</div>
														</fieldset>
													</div>
												</div>

												<div class="row" style="margin-bottom: 15px;">
													<div class="col-md-12">
														<fieldset class="">
															<div class="input-group">
																<span class="input-group-addon"  style="width: 120px; text-align: left; background: white;" id="basic-addon11"><b>Problem</b></span>
																<input readonly="readonly"  style="background: white;" type="text" class="form-control"  aria-describedby="button-addon6" value="{{$data->problem_type}}">
															</div>
														</fieldset>
													</div>
												</div>
											@endif
				                    		

				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon"  style="width: 120px; text-align: left; background: white;" id="basic-addon11"><b>Password</b></span>
															<input readonly="readonly"  style="background: white;" type="text" class="form-control"  aria-describedby="button-addon6" value="{{$data->password}}">
														</div>
													</fieldset>
						                        </div>
				                    		</div>

				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon"  style="width: 120px; text-align: left; background: white;" id="basic-addon11"><b>IMEI</b></span>
															<input readonly="readonly"  style="background: white;" type="text" class="form-control"  aria-describedby="button-addon6" value="{{$data->imei}}">
														</div>
													</fieldset>
						                        </div>
				                    		</div> 
				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon"  style="width: 120px; text-align: left; background: white;" id="basic-addon11"><b>Notes</b></span>
															<input readonly="readonly"  style="background: white;" type="text" class="form-control"  aria-describedby="button-addon6" value="{{$data->notes}}">
														</div>
													</fieldset>
						                        </div>
											</div>
				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon"  style="width: 120px; text-align: left; background: white;" id="basic-addon11"><b>Payment Status</b></span>
															<input readonly="readonly"  style="background: white;" type="text" class="form-control"  aria-describedby="button-addon6" value="{{$data->payment_status?$data->payment_status:'Pending'}}">
														</div>
													</fieldset>
						                        </div>
											</div>
											
											<?php 
												$data_parts_price=$data->price;
											?>
											@if ($data->total_parts > 0)
												@foreach (json_decode($data->parts_json) as $row)
												<?php 
													$data_parts_price+=$row->price;
												?>
												@endforeach
											@endif

				                    		


										</div>
									</div>
									
									<div class="col-md-4">
										<div class="form-body">
				                    		<h4 class="form-section"><i class="icon-head"></i> Customer</h4>
				                    		<hr>
				                    		<div class="row" style="margin-bottom: 15px; margin-top: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon" style="width: 120px; text-align: left; background: white;" id="basic-addon11"><b>Name</b></span>
															<input readonly="readonly" name="customer_name" style="background: white;" type="text" class="form-control"  aria-describedby="button-addon6" value="{{$customer->name}}">
														</div>
													</fieldset>
						                        </div>
				                    		</div>

				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon"  style="width: 120px; text-align: left; background: white;" id="basic-addon11"><b>Address</b></span>
															<input readonly="readonly"  style="background: white;" ondblclick="liveedit(this);" name="address" type="text" class="form-control"  aria-describedby="button-addon6" value="{{$customer->address?$customer->address:'NA'}}">
														</div>
													</fieldset>
						                        </div>
				                    		</div>

				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon"  style="width: 120px; text-align: left; background: white;" id="basic-addon11"><b>Phone</b></span>
															<input readonly="readonly"  style="background: white;" ondblclick="liveedit(this);" name="phone" type="text" class="form-control"  aria-describedby="button-addon6" value="{{$customer->phone}}">
														</div>
													</fieldset>
						                        </div>
				                    		</div>

				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon"  style="width: 120px; text-align: left; background: white;" id="basic-addon11"><b>Email</b></span>
															<input readonly="readonly"  style="background: white;" ondblclick="liveedit(this);" name="email" type="text" class="form-control"  aria-describedby="button-addon6" value="{{$customer->email}}">
														</div>
													</fieldset>
						                        </div>
				                    		</div>	
				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
				                    				<a  class="btn btn-green btn-block" href="{{url('repair-print/'.$data->id)}}"><i class="icon-printer"></i> Print Repair</a>
						                    	</div>
											</div>
											@if ($data->payment_status!="Paid")
												<div class="row" style="margin-bottom: 15px;">
													<div class="col-md-12">
														<fieldset class="">
															<div class="input-group">
																<span class="input-group-addon" style="width: 50%;" id="basic-addon11"><b> Pay </b></span>
																<a class="btn btn-green btn-block" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" href="{{url('pos-repair/'.$data->id)}}"> 
																		<i class="icon-dollar"></i>{{$data_parts_price}} to POS
																</a>
																
															</div>
														</fieldset>
													</div>
												</div>
											@endif
												
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-body">
				                    		<h4 class="form-section"><i class="icon-cogs"></i> Require Parts</h4>
											<hr>
											<?php 
													$data_parts_loop=1;
													$data_parts_price=$data->price;
												?>
											@if ($data->total_parts > 0)
												
												@foreach (json_decode($data->parts_json) as $row)
												<div class="row" style="margin-bottom: 15px; margin-top: 15px;">
													<div class="col-md-12">
														<fieldset class="">
															<div class="input-group">
																<span class="input-group-addon" style="text-align: left; background: white;" id="basic-addon11"><b>{{$data_parts_loop}}.</b></span>
																<input readonly="readonly" name="customer_name" style="background: white;" type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon6" value="{{$row->name}}">
																<span class="input-group-addon" style="text-align: left; background: white;" id="basic-addon11">$<b>{{$row->price}}</b></span>
															</div>
														</fieldset>
													</div>
												</div>
												<?php 
													$data_parts_price+=$row->price;
													$data_parts_loop++; //01793298093
												?>
												@endforeach
											@endif
				                    		

											@if ($data->repair_type!="Parts")
												<div class="row" style="margin-bottom: 15px;">
													<div class="col-md-12">
														<fieldset class="">
															<div class="input-group">
																<span class="input-group-addon"  style="width: 150px; text-align: left; background: white;" id="basic-addon11"><b>Repair Cost</b></span>
																<input readonly="readonly"  style="background: white;" ondblclick="liveedit(this);" name="address" type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon6" value="${{$data->cost}}">
															</div>
														</fieldset>
													</div>
												</div>
												<div class="row" style="margin-bottom: 15px;">
													<div class="col-md-12">
														<fieldset class="">
															<div class="input-group">
																<span class="input-group-addon"  style="width: 150px; text-align: left; background: white;" id="basic-addon11"><b>Repair Price</b></span>
																<input readonly="readonly"  style="background: white;" ondblclick="liveedit(this);" name="address" type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon6" value="${{$data->price}}">
															</div>
														</fieldset>
													</div>
												</div>
											@endif
				                    		
											
				                    		<div class="row" style="margin-bottom: 15px;">
				                    			<div class="col-md-12">
					                    			<fieldset class="">
														<div class="input-group">
															<span class="input-group-addon"  style="width: 150px; text-align: left; background: white;" id="basic-addon11"><b>Total {{$data->repair_type=="Parts"?"Parts":"Repair"}} Price</b></span>
															<input readonly="readonly"  style="background: white;" name="address" type="text" class="form-control" placeholder="Button on right" aria-describedby="button-addon6" value="${{$data_parts_price}}">
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

@include('apps.include.datatable',['selectTwo'=>1,'dateDrop'=>1,'view_repair'=>1])