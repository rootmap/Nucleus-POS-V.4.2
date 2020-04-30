@extends('apps.layout.master')
@section('title','Create New Special Parts Order')
@section('content')
<section id="file-exporaat">


		<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						@if(isset($edit))
						<i class="icon-shopping-bag"></i> Edit Special Parts Order
						@else
						<i class="icon-shopping-bag"></i> Create New Special Parts Order
						@endif
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
						<form class="form"
						@if(isset($edit))
							action="{{url('special/parts/'.$dataRow->id)}}"  method="post" 
						@else
							action="{{url('special/parts')}}"  method="post" 
						@endif
						>
							<div class="form-body">
								{{ csrf_field() }}
								@if(isset($edit))
									{{ method_field('PATCH') }}
								@endif
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="userinput1">Select Customer</label>
												<select name="customer_id" class="select2 form-control">
													@if(isset($customerList))
														@foreach($customerList as $pro)
															<option value="{{$pro->id}}">{{$pro->name}}</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="userinput1">Select Ticket</label>
												<select name="ticket_id" class="select2 form-control">
													@if(isset($ticketList))
														@foreach($ticketList as $pro)
														<option data-value="{{$pro->payment_status}}" value="{{$pro->ticket_id}}">
															{{$pro->ticket_id}}-{{$pro->device_type}}-{{$pro->problem_name}}
														</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="eventRegInput3">Payment Status <span class="text-danger">*</span></label>
												<input type="text" 
												@if(isset($edit))
												value="{{$dataRow->ticket_payment_status}}" readonly="readonly" 
												@else 
												readonly="readonly" 
												@endif 
												 class="form-control border-green" placeholder="Ticket Payment Status" name="ticket_payment_status">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="eventRegInput3">Description <span class="text-danger">*</span></label>
												<input type="text" 
												@if(isset($edit))
												value="{{$dataRow->description}}" 
												@endif 
												 class="form-control border-green" placeholder="Description" name="description">
											</div>
										</div>
									</div>	
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="eventRegInput3">Parts URL <span class="text-danger">*</span></label>
												<input type="text" 
												@if(isset($edit))
												value="{{$dataRow->part_url}}" 
												@endif 
												 class="form-control border-green" placeholder="Parts URL" name="part_url">
											</div>
										</div>
									</div>								

									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="eventRegInput3">Quantity <span class="text-danger">*</span></label>
												<input type="text" 
												@if(isset($edit))
												value="{{$dataRow->quantity}}" 
												@endif 
												 class="form-control border-green" placeholder="Quuantity" name="quantity">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="eventRegInput3">Cost Price <span class="text-danger">*</span></label>
												<input type="text" 
												@if(isset($edit))
												value="{{$dataRow->cost_price}}" 
												@endif 
												 class="form-control border-green" placeholder="Cost Price" name="cost_price">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="eventRegInput3">Sold Price <span class="text-danger">*</span></label>
												<input type="text" 
												@if(isset($edit))
												value="{{$dataRow->sold_price}}" 
												@endif 
												 class="form-control border-green" placeholder="Sold Price" name="sold_price">
											</div>
										</div>
									</div>								

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="eventRegInput3">Taxable Status <span class="text-danger">*</span></label>
												<select name="texable_status" class="select2 form-control">
														<option value="Yes">Yes</option>
														<option value="No">No</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="eventRegInput3">Trackingnum <span class="text-danger">*</span></label>
												<input type="text" 
												@if(isset($edit))
												value="{{$dataRow->trackingnum}}" 
												@endif 
												 class="form-control border-green" placeholder="Trackingnum" name="trackingnum">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="eventRegInput3">Notes <span class="text-danger">*</span></label>
													<input type="text" 
													@if(isset($edit))
													value="{{$dataRow->notes}}" 
													@endif 
													 class="form-control border-green" placeholder="Notes" name="notes">
												</div>
											</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="eventRegInput3">Ordered <span class="text-danger">*</span></label>
												<input type="text" 
												@if(isset($edit))
												value="{{$dataRow->ordered}}" 
												@endif 
												 class="form-control border-green DropDateWithformat" placeholder="Ordered" name="ordered">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="eventRegInput3">Received <span class="text-danger">*</span></label>
												<input type="text" 
												@if(isset($edit))
												value="{{$dataRow->received}}" 
												@endif 
												 class="form-control border-green DropDateWithformat" placeholder="Received" name="received">
											</div>
										</div>

										@if(isset($edit))
										<div class="col-md-6">
											<div class="form-group">
												<label for="eventRegInput3">Order Status <span class="text-danger">*</span></label>
												<select name="order_status" class="select2 form-control">
														<option value="">Select Status</option>
														@foreach($orderStatusArray as $row)
														<option 
														@if($dataRow->order_status==$row)
															selected="selected" 
														@endif
														 value="{{$row}}">{{$row}}</option>
														@endforeach
												</select>
											</div>
										</div>
										@endif
									</div>
								</div>

								<div class="form-actions center">
									<button type="button" class="btn btn-green btn-darken-2 mr-1">
										<i class="icon-cross2"></i> Cancel
									</button>
									@if(isset($edit))
									<button type="submit" class="btn btn-green btn-accent-2">
										<i class="icon-check2"></i> Update
									</button>
									@else
									<button type="submit" class="btn btn-green btn-accent-2">
										<i class="icon-check2"></i> Save
									</button>
									@endif
								</div>
															
							</div>

							
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Both borders end -->


</section>
@endsection

@include('apps.include.datatable',['selectTwo'=>1,'dateDrop'=>1,'testJsonApi'=>1,'order_parts'=>1])