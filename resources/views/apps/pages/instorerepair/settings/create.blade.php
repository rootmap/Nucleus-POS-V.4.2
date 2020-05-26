@extends('apps.layout.master')
@section('title','Create New Inventory Reapir')
@section('content')
<section id="file-exporaat">

<?php 
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>
		<div class="row">
		<div class="col-md-12 repaireMSGPlace" id="#repaireMSGPlace"></div>
		<div class="col-md-6 offset-md-3 col-xs-12 col-xl-6 offset-xl-3" @if($userguideInit==1) data-step="1" data-intro="Please select Device, Model & Problem then use next to set in store repair price click button next then fillup next page all addition device info and submit & finish." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						<i class="icon-cog3"></i> Create New Inventory Reapir
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
						<form class="form" action="{{url('settings/instorerepair')}}"  method="post">
							<div class="form-body">
								{{ csrf_field() }}
								<div class="form-group step1">
									<label for="userinput1">Device <span class="text-danger">*</span></label>
									<select  name="device_id" id="device_id" class="select2 form-control"> 
										<option value="">Please Select</option>
										<option value="D000">Create New Device</option>
										@if(isset($device))
											@foreach($device as $pro)
											<option  value="{{$pro->id}}">
												{{$pro->name}}
											</option>
											@endforeach
										@endif
									</select>
									<input type="text"   class="form-control border-green" placeholder="Enter Device Name" name="device_name">
								</div>

								<div class="form-group step1">
									<label for="userinput1">Model <span class="text-danger">*</span></label>
									<select  name="model_id" class="select2 form-control"> 
										<option value="">Please Select</option>
										<option value="M000">Create New Model</option>
										@if(isset($productData))
											@foreach($productData as $pro)
											<option  value="{{$pro->id}}">
												{{$pro->name}}
											</option>
											@endforeach
										@endif
									</select>
									<input type="text" class="form-control border-green" placeholder="Enter Model Name" name="model_name">
								</div>

								<div class="form-group step1">
									<label for="userinput1">Problem <span class="text-danger">*</span></label>
									<select name="problem_id" class="select2 form-control"> 
										<option value="">Please Select</option>
										<option value="P000">Create New Model</option>
										@if(isset($productData))
											@foreach($productData as $pro)
											<option  value="{{$pro->id}}">
												{{$pro->name}}
											</option>
											@endforeach
										@endif
									</select>
									<input type="text" class="form-control border-green" placeholder="Enter Problem Name" name="problem_name">
								</div>

								<div class="form-group step2" style="display: none;">
									<label for="userinput1">Price <span class="text-danger">*</span></label>
									<input type="text" class="form-control border-green" placeholder="Enter Price Name" name="price" value="0">
								</div>

								<div class="form-group step3" style="display: none;">
									<label for="userinput1">Barcode <span class="text-danger">*</span></label>
									<input type="text" class="form-control border-green" placeholder="Enter Barcode Name" name="barcode" value="{{time()}}">
								</div>

								<div class="form-group step3" style="display: none;">
									<label for="userinput1">Product Name <span class="text-danger">*</span></label>
									<input type="text" class="form-control border-green"  readonly="readonly" placeholder="Enter Product Name" name="name">
								</div>
								<div class="row step3" style="display: none;">
									<div class="col-md-6">
										<div class="form-group step3" style="display: none;">
											<label for="userinput1">Retail Price <span class="text-danger">*</span></label>
											<input type="text" class="form-control border-green" readonly="readonly" placeholder="Enter Retail Price" name="retail_price">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group step3" style="display: none;">
											<label for="userinput1">Our Cost <span class="text-danger">*</span></label>
											<input type="text" class="form-control border-green" placeholder="Enter Our Cost" name="our_cost">
										</div>
									</div>
								</div>
													

								<div class="form-group step3" style="display: none;">
									<label for="userinput1">Quantity <span class="text-danger">*</span></label>
									<input type="text" class="form-control border-green" placeholder="Enter Quantity" name="quantity" value="1">
								</div>

								<div class="form-group step3" style="display: none;">
									<label for="userinput1">Description <span class="text-danger">*</span></label>
									<input type="text" class="form-control border-green" placeholder="Enter Description" name="description">
								</div>
															

								</div>

								<div class="form-actions center">
									<button type="button" id="step1" class="btn btn-green btn-accent-2">
										<i class="icon-check2"></i> Next
									</button>

									<button type="button" style="display: none;" id="step2_step1" class="btn btn-warning btn-accent-2">
										<i class="icon-check2"></i> Back
									</button>

									<button type="button" style="display: none;" id="step2" class="btn btn-green btn-accent-2">
										<i class="icon-check2"></i> Next
									</button>

									<a style="display: none;" id="step3_cancel" href="javascript:window.location.reload();" class="btn btn-danger btn-accent-2">
										<i class="icon-check2"></i> Cancel
									</a>

									<button type="button" style="display: none;" id="step3_step2" class="btn btn-warning btn-accent-2">
										<i class="icon-check2"></i> Back
									</button>
									<button type="submit" style="display: none;" id="step3" class="btn btn-green btn-accent-2">
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
<script type="text/javascript">
	var modelJson=<?php echo json_encode($model); ?>;
	var problemJson=<?php echo json_encode($problem); ?>;
	var priceJson=<?php echo json_encode($estPrice); ?>;

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

@include('apps.include.datatable',['selectTwo'=>1,'instorerepairjson'=>1,'instorerepairajax'=>1])