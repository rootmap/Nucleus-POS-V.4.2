@extends('apps.layout.master')
@section('title','Ticket List')
@section('content')
<section id="form-action-layouts">

<!-- Both borders end-->
<div class="row">
	<div class="col-xs-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-clear_all"></i> Ticket List</h4>
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
								<th>Id</th>
								<th>Date</th>
								<th>Customer</th>
								<th>Subject</th>
								<th>Problem</th>
								<th>Cost</th>
								<th>Price</th>
								<th>Status</th>
								<th>Invoice ID</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$invoice_total=0;
							$cost_total=0;
							$paid_amount=0;
							?>
							@if(isset($invoice))
								@foreach($invoice as $inv)
								<tr>
	                                <td>{{$inv->id}}</td>
	                                <td>{{date('Y-m-d',strtotime($inv->created_at))}}</td>
	                                <td>{{$inv->customer_name}}</td>
	                                <td>{{$inv->product_name}}</td>
	                                <td>{{$inv->problem_name}}</td>
	                                <td>{{number_format($inv->our_cost,2)}}</td>
	                                <td>{{number_format($inv->retail_price,2)}}</td>
	                                <td>
	                                	@if($inv->payment_status=="Pending")
	                                		<a href="{{url('pos/ticket/'.$inv->id)}}" class="btn btn-green"> {{number_format($inv->retail_price,2)}} To POS  </a>
	                                	@elseif($inv->payment_status=="Partial")
	                                		<a href="{{url('pos/ticket/partial/'.$inv->id)}}" class="btn btn-green btn-darken-4"> PAY PARTIAL</a>
	                                	@else
	                                		Paid
	                                	@endif
	                                </td>
	                                <td>{{$inv->invoice_id}}</td>
	                                <td>
	                                	<span class="dropdown">
                                        <button id="btnSearchDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-green dropdown-toggle dropdown-menu-right"><i class="icon-cog3"></i></button>
                                        <span aria-labelledby="btnSearchDrop4" class="dropdown-menu mt-1 dropdown-menu-right">
                                            <a href="{{url('ticket/view/'.$inv->id)}}" title="View ticket" class="dropdown-item"><i class="icon-file-text"></i> View Ticket Info</a>
                                            <a href="{{url('ticket/print/'.$inv->id)}}" title="Delete" class="dropdown-item"><i class="icon-printer"></i> Print</a>
                                            <a href="{{url('ticket/delete/'.$inv->id)}}" title="Delete" class="dropdown-item"><i class="icon-cross"></i> Delete</a>
                                        </span>
                                    </span>
	                                </td>
	                            </tr>
	                            <?php 
								$paid_amount+=$inv->price;
								?>
	                            @endforeach
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


@include('apps.include.datatable',['JDataTable'=>1,'selectTwo'=>1,'dateDrop'=>1])