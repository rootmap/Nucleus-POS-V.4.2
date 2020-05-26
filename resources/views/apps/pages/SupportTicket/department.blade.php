@extends('apps.layout.master')
@section('title','Department')
@section('content')
<?php 
    $userguideInit=StaticDataController::userguideInit();
?>
<section id="file-exporaat">
		<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header" @if($userguideInit==1) data-step="1" data-intro="Create & Manage department for support ticket." @endif>
					<h4 class="card-title" id="basic-layout-card-center">
						@if(isset($edit))
						<i class="icon-user-plus"></i> Edit Department
						@else
						<i class="icon-user-plus"></i> Add New Department
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
				<div class="card-body collapse in" @if($userguideInit==1) data-step="2" data-intro="Create & Update department  name using below fields." @endif>
					<div class="card-block">
						<form class="form" method="post" 
						@if(isset($edit))
							action="{{url('Department/modify/'.$dataRow->id)}}"
						@else
							action="{{url('Department/save')}}"
						@endif
						>

							{{ csrf_field() }}

							<div class="form-body">
								
								<div class="form-group">
									<label for="eventRegInput1">Name <span class="text-danger">*</span></label>
									<input type="text" 
									@if(isset($edit))
										value="{{$dataRow->name}}" 
									@endif 
									 id="eventRegInput1" class="form-control border-green" placeholder="Department Name" name="name">
								</div>							
							</div>

							<div class="form-actions center">
								<button type="reset" class="btn btn-green btn-accent-1 mr-1" @if($userguideInit==1) data-step="4" data-intro="Reset department using click this button." @endif>
									<i class="icon-cross2"></i> Cancel
								</button>
								@if(isset($edit))
								<button type="submit" class="btn btn-green">
									<i class="icon-check2"></i> Update
								</button>
								@else
								<button type="submit" class="btn btn-green" @if($userguideInit==1) data-step="3" data-intro="Save department using submit this button." @endif>
									<i class="icon-check2"></i> Save
								</button>
								@endif
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6" @if($userguideInit==1) data-step="5" data-intro="Department list will show below list." @endif>
			<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-users2"></i> Department List</h4>
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
							@if(isset($role))
							@foreach($role as $row)
							<tr>
								<td>{{$row->id}}</td>
								<td>{{$row->name}}</td>
								<td>
                                        <a href="{{url('Department/edit/'.$row->id)}}" title="Edit" class="btn btn-sm btn-outline-green" @if($userguideInit==1) data-step="6" data-intro="Edit department using click on this button." @endif><i class="icon-pencil22"></i></a>
                                        <a  href="{{url('Department/delete/'.$row->id)}}" title="Delete" class="btn btn-sm btn-outline-green" @if($userguideInit==1) data-step="7" data-intro="Delete department using click on this button." @endif><i class="icon-cross"></i></a>
                                </div>
								</td>
							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="6">No Record Found</td>
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