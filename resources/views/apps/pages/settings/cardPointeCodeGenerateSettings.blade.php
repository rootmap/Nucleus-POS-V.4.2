@extends('apps.layout.master')
@section('title','Cardpointe Basic Authorization Generator')
@section('content')
<section id="form-action-layouts">
	<?php 
	    $userguideInit=StaticDataController::userguideInit();
	    //dd($dataMenuAssigned);
	?>
	<div class="row">
		<div class="col-md-8 offset-md-2" @if($userguideInit==1) data-step="1" data-intro="You can add a API public id and secret key" @endif>
	        <div class="card">
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-card-center">Cardpointe Basic Authorization Generator</h4>
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
						<form method="post" action="{{url('cardpointe/genarate/encode')}}" class="form form-horizontal striped-labels">
							{{csrf_field()}}
							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">User Name </label>
	                        		<div class="col-md-7">
										<div class="form-group">
											<input type="text" id="eventRegInput1" class="form-control border-green" placeholder="Username" 
											@if(isset($edit))
												value="{{$edit->username}}"  
											@endif 
											 name="username">
										</div>
									</div>
		                        </div>
							</div>								

							<div class="form-body">
	                			<div class="form-group row last">
	                        		<label class="col-md-4 label-control">Password</label>
	                        		<div class="col-md-7">
										<div class="form-group">
											
											<input type="text" id="eventRegInput1" class="form-control border-green" placeholder="Password" 
											@if(isset($edit))
												value="{{$edit->password}}"  
											@endif 
											 name="password">
										</div>
									</div>
		                        </div>
							</div>

							<div class="form-actions center">
	                            <a href="" class="btn btn-green btn-lighten-2 mr-1">
	                            	<i class="icon-cross2"></i> Cancel
	                            </a>
	                            <button type="submit" class="btn btn-green btn-darken-2">
	                                <i class="icon-check2"></i> Generate & Save
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