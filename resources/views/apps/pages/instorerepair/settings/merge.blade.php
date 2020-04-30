@extends('apps.layout.master')
@section('title','Create New Buyback')
@section('content')
<section id="file-exporaat">
<?php 
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>

		<div class="row">
		<div class="col-md-12 repaireMSGPlace" id="#repaireMSGPlace"></div>
		
		<div class="col-md-6 offset-md-6 col-xs-12 col-xl-6 offset-xl-3" id="merge" @if($userguideInit==1) data-step="1" data-intro="Please select store then select your addition device." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						<i class="icon-cog3"></i> Create New In Store Reapir
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
						<form class="form" action="{{url('settings/instore/merge/repair/store')}}"  method="post">
							<div class="form-body">
								{{ csrf_field() }}
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="userinput1">Store <span class="text-danger">*</span></label>
												<select style="width: 90%;" name="store_id" id="store_id" class="select2 form-control"> 
													<option value="">Please Select</option>
													@if(isset($store))
														@foreach($store as $pro)
														<option  value="{{$pro->store_id}}">
															{{$pro->name}}
														</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="userinput1">Device ({{$device}})</label>
												<input type="checkbox" name="device" value="1">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="userinput1">Model ({{$model}})</label>
												<input type="checkbox" name="model" value="1">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="userinput1">Problem ({{$problem}})</label>
												<input type="checkbox" name="problem" value="1">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="userinput1">Repair Category </label>
												<input type="checkbox" name="category" value="1">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="userinput1">Reapir Price ({{$price}})</label>
												<input type="checkbox" name="price" value="1">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="userinput1">Reapir Product ({{$product}})</label>
												<input type="checkbox" name="product" value="1">
											</div>
										</div>
										
									</div>

								</div>

								<div class="form-actions center">
									
									<button type="submit"  class="btn btn-green btn-accent-2" @if($userguideInit==1) data-step="2" data-intro="When you merge your product then click this button." @endif>
										<i class="icon-check2"></i> Sent To Store
									</button>

									<button type="button" id="repair_clear" class="btn btn-warning btn-accent-2" @if($userguideInit==1) data-step="3" data-intro="If you clear your information then click this button." @endif>
										<i class="icon-times-circle"></i> Clear Store Data
									</button>
									
								</div>
															
							</div>

							
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6 offset-md-6 col-xs-12 col-xl-6 offset-xl-3" id="clearmerge" style="display: none;">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						<i class="icon-cog3"></i> Clear In Store Reapir Data
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
						<form class="form" action="{{url('settings/instore/clear/repair/store')}}"  method="post">
							<div class="form-body">
								{{ csrf_field() }}
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label for="userinput1">Store <span class="text-danger">*</span></label>
												<select style="width: 90%;" name="store_id" id="store_id" class="select2 form-control"> 
													<option value="">Please Select</option>
													@if(isset($store))
														@foreach($store as $pro)
														<option  value="{{$pro->store_id}}">
															{{$pro->name}}
														</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>
									</div>



								</div>

								<div class="form-actions center">
									
									<button type="submit"  class="btn btn-green btn-accent-2">
										<i class="icon-check2"></i> Clear Store Data
									</button>

									<button type="button" id="merge_repair" class="btn btn-warning btn-accent-2">
										<i class="icon-mail-reply-all"></i> Send Repair Data To Store
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

@include('apps.include.datatable',['selectTwo'=>1,'mergeJS'=>1])