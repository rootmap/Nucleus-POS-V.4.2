@extends('apps.layout.master')
@section('title','Inventory Reapir Device List')
@section('content')
<section id="file-exporaat">
<?php 
    $dataMenuAssigned=array();
    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>

	<!-- Both borders end-->
<div class="row">
	<div class="col-xs-12" @if($userguideInit==1) data-step="1" data-intro="You are seeing your all inventory reapir device list." @endif>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-users2"></i> Inventory Reapir Device List</h4>
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
						<thead>
							<tr>
								<th>ID</th>
								<th>Device</th>
								<th>Created</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($device))
								@foreach($device as $row)
									<tr>
										<td>{{$row->id}}</td>
										<td>{{$row->name}}</td>
										<td>{{formatDate($row->created_at)}}</td>
										<td>
											<a href="{{url('settings/instore/device/edit/'.$row->id)}}" class="btn btn-green btn-lighten-1" @if($userguideInit==1) data-step="2" data-intro="If you want you can modify your information when you click this button." @endif>
												<i class="icon-edit"></i>
											</a>
											<a href="{{url('settings/instore/device/delete/'.$row->id)}}" class="btn btn-green btn-darken-1"@if($userguideInit==1) data-step="3" data-intro="If you want delect then click this button." @endif>
												<i class="icon-trash"></i>
											</a>
										</td>
									</tr>
								@endforeach
							@else
							<tr>
								<td colspan="2">No Record Found</td>
							</tr>
							@endif
						</tbody>
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