@extends('apps.layout.master')
@section('title','Create New Buyback')
@section('content')
<section id="file-exporaat">

<?php 
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>
	<div class="row">
		<div class="col-md-4 col-xs-4 col-xl-4" @if($userguideInit==1) data-step="1" data-intro="Please add a new asset name." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						<i class="icon-cog3"></i> 
						@if(isset($edit))
							Modify
						@else
							New 
						@endif 
						{{$asset}} Asset 
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
							action="{{url('settings/instore/asset/'.$asset.'/modify/'.$edit->id)}}"
						@else
							action="{{url('settings/instore/asset/'.$asset.'/save')}}"
						@endif 
						  method="post">
							<div class="form-body">
								{{ csrf_field() }}
								<div class="form-group step2">
									<label for="userinput1">Asset Name <span class="text-danger">*</span></label>
									<input type="text" class="form-control border-green" 
									@if(isset($edit)) 
									 value="{{$edit->name}}" 
									@endif 
									placeholder="Enter Asset Name" name="name">
								</div>
							</div>

							<div class="form-actions center">
								<button type="submit" class="btn btn-green btn-accent-2" @if($userguideInit==1) data-step="2" data-intro="When you fill up all information then click save/update button." @endif>
									<i class="icon-check2"></i> 
									@if(isset($edit))
										Update
									@else
										Save 
									@endif 
								</button>
							</div>
							</form>					
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-8 col-xs-8 col-xl-8" @if($userguideInit==1) data-step="4" data-intro="You are seeing your all assets list." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title"><i class="icon-table"></i> {{$asset}} Assets</h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
	        		<div class="heading-elements">
						<ul class="list-inline mb-0">
	                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
							<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-body collapse in">
					<div class="table-responsive">
						<table class="table table-striped table-bordered zero-configuration">
							@if(isset($dataTable))
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								
								@foreach($dataTable as $row)
								<tr>
									<td>{{$row->id}}</td>
									<td>{{$row->name}}</td>
									<td>
										<a href="{{url('settings/instore/asset/'.$asset.'/edit/'.$row->id)}}" class="btn btn-green btn-accent-1"@if($userguideInit==1) data-step="5" data-intro="If you want you can modify your information when you click this button." @endif>
											<i class="icon-edit"></i>
										</a>
									</td>
									<td>
										<a href="{{url('settings/instore/asset/'.$asset.'/delete/'.$row->id)}}" class="btn btn-green" @if($userguideInit==1) data-step="6" data-intro="If you want delect then click this button." @endif>
											<i class="icon-trash"></i>
										</a>
									</td>
								</tr>
								@endforeach
								
							</tbody>
							@else
								<thead>
									<tr>
										<th colspan="4"> (0) Record Found</th>
									</tr>
								</thead>
								
							@endif
						</table>
					</div>
				</div>
			</div>
		</div>

	</div>
<!-- Both borders end -->
</section>
@endsection

@include('apps.include.datatable',['JDataTable'=>1])