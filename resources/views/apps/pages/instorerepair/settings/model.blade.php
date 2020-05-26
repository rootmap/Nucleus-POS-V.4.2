@extends('apps.layout.master')
@section('title','Edit Model Info')
@section('content')
<section id="file-exporaat">


		<div class="row">
		<div class="col-md-12 repaireMSGPlace" id="#repaireMSGPlace"></div>
		<div class="col-md-6 offset-md-3 col-xs-12 col-xl-6 offset-xl-3">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						<i class="icon-cog3"></i> Edit Inventory Reapir Model Info 
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
						<form class="form" action="{{url('settings/instore/model/edit/'.$tab->id)}}"  method="post">
							<div class="form-body">
								{{ csrf_field() }}
								<div class="form-group step1">
									<label for="userinput1">Device <span class="text-danger">*</span></label>
									<select  name="device_id" id="device_id" class="select2 form-control"> 
										<option value="">Please Select</option>
										
										@if(isset($device))
											@foreach($device as $pro)
											<option  
											@if($tab->device_id==$pro->id)
												selected="selected" 
											@endif
											value="{{$pro->id}}">
												{{$pro->name}}
											</option>
											@endforeach
										@endif
									</select>
								</div>

								<div class="form-group step1">
									<label for="userinput1">Device <span class="text-danger">*</span></label>
									<input type="text" value="{{$tab->name}}"  class="form-control border-green" placeholder="Enter Model Name" name="model_name">
								</div>

							

								<div class="form-actions center">
									
									<a href="javascript:window.location.reload();" class="btn btn-green btn-accent-2">
										<i class="icon-check2"></i> Cancel
									</a>

									<button type="submit"  class="btn btn-green btn-darken-2">
										<i class="icon-check2"></i> Save & Finish
									</button>
									
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
@include('apps.include.datatable',['selectTwo'=>1])