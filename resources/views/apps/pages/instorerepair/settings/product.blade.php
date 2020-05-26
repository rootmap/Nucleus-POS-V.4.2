@extends('apps.layout.master')
@section('title','Edit Price Info')
@section('content')
<section id="file-exporaat">


		<div class="row">
		<div class="col-md-12 repaireMSGPlace" id="#repaireMSGPlace"></div>
		<div class="col-md-6 offset-md-3 col-xs-12 col-xl-6 offset-xl-3">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						<i class="icon-cog3"></i> Edit Inventory Reapir Price Info 
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
						<form class="form" action="{{url('settings/instore/price/edit/'.$tab->id)}}"  method="post">
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
									<label for="userinput1">Model <span class="text-danger">*</span></label>
									<select  name="model_id" id="model_id" class="select2 form-control"> 
										<option value="">Please Select</option>
										
										@if(isset($model))
											@foreach($model as $pro)
												@if($tab->device_id==$pro->device_id)
													<option  
													@if($tab->model_id==$pro->id)
														selected="selected" 
													@endif
													value="{{$pro->id}}">
														{{$pro->name}}
													</option>
												@endif
											@endforeach
										@endif
									</select>
								</div>

								<div class="form-group step1">
									<label for="userinput1">Model <span class="text-danger">*</span></label>
									<select  name="problem_id" id="problem_id" class="select2 form-control"> 
										<option value="">Please Select</option>
										
										@if(isset($problem))
											@foreach($problem as $pro)
											<option  
											@if($tab->problem_id==$pro->id)
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
									<label for="userinput1">Price <span class="text-danger">*</span></label>
									<input type="text" value="{{$tab->price}}"  class="form-control border-green" placeholder="Enter Price Name" name="price">
								</div>

							

								<div class="form-actions center">
									
									<a href="javascript:window.location.reload();" class="btn btn-green btn-accent-2">
										<i class="icon-check2"></i> Cancel
									</a>

									<button type="submit"  class="btn btn-green btn-darken-2">
										<i class="icon-check2"></i> Save
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
<script type="text/javascript">
	var modelJson=<?php echo json_encode($model); ?>;
	var problemJson=<?php echo json_encode($problem); ?>;

	function loadingOrProcessing(sms)
    {
        var strHtml='';
            strHtml+='<div class="alert alert-icon-right alert-info alert-dismissible fade in mb-2" role="alert">';
            strHtml+='      <i class="icon-spinner10 spinner"></i> '+sms;
            strHtml+='</div>';

            return strHtml;

    }

    function warningMessage(sms)
    {
        var strHtml='';
            strHtml+='<div class="alert alert-icon-left alert-danger alert-dismissible fade in mb-2" role="alert">';
            strHtml+='<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            strHtml+='<span aria-hidden="true">×</span>';
            strHtml+='</button>';
            strHtml+=sms;
            strHtml+='</div>';
            return strHtml;
    }

    function successMessage(sms)
    {
        var strHtml='';
            strHtml+='<div class="alert alert-icon-left alert-success alert-dismissible fade in mb-2" role="alert">';
            strHtml+='<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
            strHtml+='<span aria-hidden="true">×</span>';
            strHtml+='</button>';
            strHtml+=sms;
            strHtml+='</div>';
            return strHtml;
    }
    </script>
@endsection

@include('apps.include.datatable',['selectTwo'=>1,'instorerepairajaxinfo'=>1])