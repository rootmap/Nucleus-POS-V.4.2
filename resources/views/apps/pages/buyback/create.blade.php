@extends('apps.layout.master')
@section('title','Create New Buyback')
@section('content')
<section id="file-exporaat">


		<div class="row">
		<div class="col-md-8 offset-md-2">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						@if(isset($edit))
						<i class="icon-random"></i> Edit Buyback green
						@else
						<i class="icon-random"></i> Create New Buyback
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
							action="{{url('buyback/'.$dataRow->id)}}"  method="post" 
						@else
							action="{{url('buyback')}}"  method="post" 
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
												<label for="userinput1">Customer <span class="text-danger">*</span></label>
												<select style="width: 90%;" name="customer_id" class="select2 form-control"> 
													<option value="">Select Customer</option>
													<option value="0">Create New Customer</option>
													@if(isset($productData))
														@foreach($productData as $pro)
														<option 
														@if(isset($edit))
															@if($dataRow->customer_id==$pro->id)
																selected="selected" 
															@endif
														@endif 
														value="{{$pro->id}}">
															{{$pro->name}}
														</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="eventRegInput3">Model <span class="text-danger">*</span></label>
												<input type="text" 
												@if(isset($edit))
												value="{{$dataRow->model}}" 
												@endif 
												 class="form-control border-green" placeholder="Model" name="model">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="eventRegInput3">Carrier</label>
												<input type="text" 
												@if(isset($edit))
												value="{{$dataRow->carrier}}" 
												@endif 
												 class="form-control border-green" placeholder="Carrier" name="carrier">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="eventRegInput3">IMEI</label>
												<input type="text" 
												@if(isset($edit))
												value="{{$dataRow->imei}}" 
												@endif 
												 class="form-control border-green" placeholder="IMEI" name="imei">
											</div>
										</div>
									</div>								

									<div class="row">
										
										<div class="col-md-6">
											<div class="form-group">
												<label for="eventRegInput3">Type and Color </label>
												<input type="text" 
												@if(isset($edit))
												value="{{$dataRow->type_and_color}}" 
												@endif 
												 class="form-control border-green" placeholder="Type and Color" name="type_and_color">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="eventRegInput3">Memory </label>
												<input type="text" 
												@if(isset($edit))
												value="{{$dataRow->memory}}" 
												@endif 
												 class="form-control border-green" placeholder="Memory" name="memory">
											</div>
										</div>
									</div>								

									<div class="row">
										
										<div class="col-md-6">
											<div class="form-group">
												<label for="eventRegInput3">Keep This ON <span class="text-danger">*</span></label>
												<select  style="width: 95%;" name="keep_this_on" class="select2 form-control">
														<option value="">Please Select</option>
														<option 
														@if(isset($edit))
															@if($dataRow->keep_this_on=='Parts')
																selected="selected" 
															@endif
														@endif 
														 value="Parts">Parts</option>
														<option 
														@if(isset($edit))
															@if($dataRow->keep_this_on=='Sale')
																selected="selected" 
															@endif
														@endif 
														value="Sale">Sale</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="eventRegInput3">Condition </label>
													<input type="text" 
													@if(isset($edit))
													value="{{$dataRow->condition}}" 
													@endif 
													 class="form-control border-green" placeholder="Condition" name="condition">
											</div>
										</div>
									</div>


									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="eventRegInput3">Price <span class="text-danger">*</span></label>
												<input type="text" 
												@if(isset($edit))
												value="{{$dataRow->price}}" 
												@endif 
												 class="form-control border-green" placeholder="Price" name="price">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="eventRegInput3">Payment Method <span class="text-danger">*</span></label>
												<select style="width: 90%;" name="payment_method_id" class="select2 form-control">
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
											</div>
										</div>
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

	@include('apps.include.modal.new-customer')
</section>
@endsection

@include('apps.include.datatable',['selectTwo'=>1,'dateDrop'=>1,'buyback_customer'=>1])