@extends('apps.layout.master')
@section('title','Ticket Problem')
@section('content')
<section id="file-exporaat">
<?php 
    $dataMenuAssigned=array();
    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>  

		<div class="row">
		<div class="col-md-6" @if($userguideInit==1) data-step="1" data-intro="you can added/modify new ticket problem." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						@if(isset($edit))
						<i class="icon-user-plus"></i> Edit Ticket Problem
						@else
						<i class="icon-user-plus"></i> Add New Ticket Problem
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
						<form class="form" method="post" 
						@if(isset($edit))
							action="{{url('settings/ticket/problem/modify/'.$dataRow->id)}}"
						@else
							action="{{url('settings/ticket/problem/save')}}"
						@endif
						>
							<div class="form-body">
								{{ csrf_field() }}
								<div class="form-group">
									<label for="eventRegInput1">Name <span class="text-danger">*</span></label>
									<input type="text" 
									@if(isset($edit))
										value="{{$dataRow->name}}" 
									@endif 
									 id="eventRegInput1" class="form-control border-primary" placeholder="Problem Name" name="name">
								</div>							
							</div>

							<div class="form-actions center">
								<button type="button" class="btn btn-green btn-accent-2 mr-1">
									<i class="icon-cross2"></i> Cancel
								</button>
								@if(isset($edit))
								<button type="submit" class="btn btn-green btn-darken-2">
									<i class="icon-check2"></i> Update
								</button>
								@else
								<button type="submit" class="btn btn-green btn-darken-2">
									<i class="icon-check2"></i> Save
								</button>
								@endif
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6" @if($userguideInit==1) data-step="2" data-intro="You are seeing all the ticket problem list in this table." @endif>
				<div class="card">
				<div class="card-header">
					<h4 class="card-title"><i class="icon-users2"></i> Ticket Problem List</h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
	        		<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
							<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="card-body collapse in">
					<div class="card-block card-dashboard">
						<table class="table table-striped table-bordered zero-configuration">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th style="width: 100px;">Action</th>
								</tr>
							</thead>
							<tbody>
								@if(isset($dataTable))
								@foreach($dataTable as $row)
								<tr>
									<td>{{$row->id}}</td>
									<td>{{$row->name}}</td>
									<td>
	                                        <a href="{{url('settings/ticket/problem/edit/'.$row->id)}}" title="Edit" class="btn btn-sm btn-outline-green" @if($userguideInit==1) data-step="3" data-intro="If you want you can modify your information when you click this button." @endif>
	                                        	<i class="icon-pencil22"></i>
	                                        </a>
	                                        
	                                        <a  href="{{url('settings/ticket/problem/delete/'.$row->id)}}" title="Delete" class="btn btn-sm btn-outline-green btn-darken-1"  @if($userguideInit==1) data-step="4" data-intro="If you want delect then click this button." @endif>
	                                        	<i class="icon-cross"></i>
	                                        </a>
									</td>
								</tr>
								@endforeach
								@else
								<tr>
									<td colspan="3">No Record Found</td>
								</tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>
@endsection

@include('apps.include.datatable',['JDataTable'=>1])