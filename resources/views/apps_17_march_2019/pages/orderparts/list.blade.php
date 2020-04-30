@extends('apps.layout.master')
@section('title','Special Parts Order List')
@section('content')
<section id="file-exporaat">
<?php 
    $dataMenuAssigned=array();
    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
    //dd($dataMenuAssigned);
?>

	<!-- Both borders end-->
<div class="row">
	<div class="col-xs-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-shopping-bag"></i> Special Parts Order List</h4>
				<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        		<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li><a href="{{url('special/parts/excel/report')}}"><i class="icon-file-excel" style="font-size: 20px;"></i></a></li>
                        <li><a href="{{url('special/parts/pdf/report')}}"><i class="icon-file-pdf"  style="font-size: 20px;"></i></a></li>
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
								<th>Ticket ID</th>
								<th>Payment</th>
								<th>Customer</th>
								<th>Order Detail</th>
								<th>Ordered</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@if(isset($dataTable))
							@foreach($dataTable as $row)
							<tr>
								<td>{{$row->id}}</td>
								<td>{{$row->ticket_id}}</td>
								<td>{{$row->ticket_payment_status}}</td>
								<td>{{$row->customer_name}}</td>
								<td>{{$row->description}}</td>
								<td>{{$row->ordered}}</td>
								<td>{{$row->order_status}}</td>
								<td>
									
                                        <a href="{{url('special/parts/'.$row->id.'/edit')}}" title="Edit" class="btn btn-sm btn-outline-green"><i class="icon-pencil22"></i></a>
                                        <a title="Delete" class="btn btn-sm  btn-accent-2">
                                        	<form method="POST" action="{{url('special/parts/'.$row->id)}}">
                                        		{{ method_field('DELETE') }}
                                        		{{ csrf_field() }}
                                        		<button type="submit" class="btn btn-sm btn-outline-green btn-accent-2"><i class="icon-cross"></i></button>	
                                        	</form>
                                        </a>
                                        {{-- <a href="{{url('special/parts/delete/'.$row->id)}}" title="Delete" class="btn btn-sm btn-outline-info btn-accent-2"><i class="icon-cross"></i></a> --}}
								</td>
							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="8">No Record Found</td>
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