@extends('apps.layout.master')
@section('title','Calculate Variance')
@section('content')
<section id="form-action-layouts">
	<div class="row match-height">
<?php 
	 $userguideInit=StaticDataController::userguideInit();
?>

		<div class="col-md-12" @if($userguideInit==1) data-step="1" data-intro="In this section, you can add a quantity in hand for each item." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="from-actions-bottom-right"><i class="icon-tab"></i> Enter Quantity in hand for each item</h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-body collapse in">
					<div class="card-block">
						<form method="post" class="form form-horizontal striped-labels form-bordered" action="{{url('variance/save')}}">
	                    	<div class="form-body">
	                    		<div class="form-group row">
									<label class="col-md-3 label-control" for="projectinput1">Choose Product Category</label>
									<div class="col-md-3">
										<select name="category_id" id="category_id"  class="select2 form-control" style="width: 100%;"> 
											<option value="">Please Select</option>
								            @if(isset($category))
												@foreach($category as $pro)
													<option value="{{$pro->id}}">{{$pro->name}}</option>
												@endforeach
											@endif
										</select>
									</div>
								</div>
							</div>
							{{ csrf_field() }}
							<div class="form-body" id="pro_variance">	
								<div class="form-group row">
									<label class="col-md-3 label-control" for="projectinput1"></label>
									<div class="col-md-9">
										<code>Please choose your category to load products and create variance</code>
									</div>
								</div>
							</div>
							<div class="form-body">	    
								<div class="form-actions center " style="border-top: 0px;">
									<button type="button" class="btn btn-green btn-accent-2 mr-1" @if($userguideInit==1) data-step="3" data-intro="if you want clear all information then click the clear button." @endif>
										<i class="icon-cross2"></i> Cancel
									</button>
									<button type="submit" class="btn btn-green btn-darken-2" @if($userguideInit==1) data-step="2" data-intro="When you fill up all information then click save button." @endif>
										<i class="icon-check2"></i> Save
									</button>
								</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/selects/select2.min.css')}}">
@endsection

@section('js')
	<script src="{{url('theme/app-assets/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
	<script src="{{url('theme/app-assets/js/scripts/forms/select/form-select2.min.js')}}" type="text/javascript"></script>
	<script>
		$("#category_id").select2();
		var product=<?=$product?>;
		//pro_variance
		$("select[name=category_id]").change(function(){
			var category_id=$(this).val();
			//console.log('category_id', category_id);
			$("#pro_variance").html("");
			var rowHtml='';
			$.each(product,function(key,row){
				//console.log('row',row);
				if(category_id==row.category_id)
				{
					rowHtml+='<div class="form-group row">';
					rowHtml+='	<label class="col-md-3 label-control" for="projectinput1">'+row.name+'</label>';
					rowHtml+='	<div class="col-md-9">';
					rowHtml+='		<input type="hidden" name="pid[]" value="'+row.id+'">';
					rowHtml+='		<input type="number" id="projectinput1" class="form-control" placeholder="Enter quantity | Leave it empty if you dont want it on variance report." name="quantity[]">';
					rowHtml+='	</div>';
					rowHtml+='</div>';
				}
			});
			$("#pro_variance").html(rowHtml);
		});
	</script>
@endsection
