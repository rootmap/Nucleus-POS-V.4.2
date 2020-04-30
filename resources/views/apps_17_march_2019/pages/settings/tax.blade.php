@extends('apps.layout.master')
@section('title','Tax Setting')
@section('content')
<section id="form-action-layouts">
	<div class="row">
		<div class="col-md-8 offset-md-2">
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-card-center">Tax Setting</h4>
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
						@if(isset($ps))
							action="{{url('tax/settings/update/'.$ps->id)}}" 
						@else 
							action="{{url('tax/settings/save')}}" 
						@endif
						class="form form-horizontal striped-labels">
							{{csrf_field()}}
							
							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">Sales Tax Rate (%)</label>
	                        		<div class="col-md-7">
										<div class="form-group">
											<input type="text" id="eventRegInput1" class="form-control border-green" placeholder="Sales Tax Rate(%)" 
											@if(isset($ps))
												value="{{$ps->sales_tax}}"  
											@endif 
											 name="sales_tax">
										</div>
									</div>
		                        </div>
							</div>
							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">Sales Part Tax Rate (%)</label>
	                        		<div class="col-md-7">
										<div class="form-group">
											<input type="text" id="eventRegInput1" class="form-control border-green" placeholder="Sales Part Tax Rate(%)" 
											@if(isset($ps))
												value="{{$ps->sales_part_tax?$ps->sales_part_tax:0}}"  
											@endif 
											 name="sales_part_tax">
										</div>
									</div>
		                        </div>
							</div>
							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">Default Tax</label>
	                        		<div class="col-md-7">
										<div class="form-group">
											<label class="col-md-4" style="text-align: center;">
												<input 
												@if(isset($ps))
													@if($ps->pos_defualt_option=="Full Tax")
														checked="checked"  
													@endif
												@endif 
												 value="Full Tax" type="radio" id="tax_0" class="form-control" name="tax_st"> Full Tax</label>
						                    <label class="col-md-4" style="text-align: center;">
						                    	<input 
						                    	@if(isset($ps))
													@if($ps->pos_defualt_option=="Part Tax")
														checked="checked"  
													@endif
												@endif  
						                    	value="Part Tax" type="radio" id="tax_1" class="form-control" name="tax_st"> Part Tax</label>
						                    <label class="col-md-4" style="text-align: center;">
						                    	<input 
						                    	@if(isset($ps))
													@if($ps->pos_defualt_option=="No Tax")
														checked="checked"  
													@endif 
												@endif  
						                    	value="No Tax" type="radio" id="tax_2" class="form-control" name="tax_st"> No Tax</label>
										</div>
									</div>
		                        </div>
							</div>


							<div class="form-actions center">
	                            <button type="button" class="btn btn-green btn-lighten-2 mr-1">
	                            	<i class="icon-cross2"></i> Cancel
	                            </button>
	                            <button type="submit" class="btn btn-green btn-darken-2">
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
