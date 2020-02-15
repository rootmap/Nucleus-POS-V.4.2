@extends('apps.layout.master')
@section('title','Payout Report')
@section('content')
<section id="form-action-layouts">


		<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center"><i class="icon-filter_list"></i> Payout Report Filter</h4>
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
						<form method="post" action="{{url('report/payout')}}">
							{{csrf_field()}}
							<fieldset class="form-group">
	                            <div class="row">
	                                <div class="col-md-3">
	                                    <h4>Start Date</h4>
	                                    <div class="input-group">
	                                        <span class="input-group-addon"><i class="icon-calendar3"></i></span>
	                                        <input 
	                                        @if(!empty($start_date))
	                                        	value="{{$start_date}}"  
	                                        @endif
	                                        name="start_date" type="text" class="form-control DropDateWithformat" />
	                                    </div>
	                                </div>
	                                <div class="col-md-3">
	                                    <h4>End Date</h4>
	                                    <div class="input-group">
	                                        <span class="input-group-addon"><i class="icon-calendar3"></i></span>
	                                        <input 
	                                        @if(!empty($end_date))
	                                        	value="{{$end_date}}"  
	                                        @endif 
	                                         name="end_date" type="text" class="form-control DropDateWithformat" />
	                                    </div>
	                                </div>
	                                <div class="col-md-3">
	                                    <h4>Cashier / Manager</h4>
	                                    <div class="input-group">
											<select name="cashier_id" class="select2 form-control">
												<option value="">Select a Cashier</option>
												@if(isset($customer))
													@foreach($customer as $cus)
													<option 
													 @if(!empty($cashier_id) && $cashier_id==$cus->id)
				                                        selected="selected"  
				                                     @endif 
													value="{{$cus->id}}">{{$cus->name}}</option>
													@endforeach
												@endif
											</select>
	                                    </div>
	                                </div>
	                                
	                                <div class="col-md-12">
	                                    
	                                    <div class="input-group" style="margin-top:32px;">
	                                        <button type="submit" class="btn btn-green btn-darken-1 mr-1">
												<i class="icon-check2"></i> Generate
											</button>
											<a href="javascript:void(0);" data-url="{{url('report/excel/payout')}}" class="btn btn-green btn-darken-2 mr-1 change-action">
												<i class="icon-file-excel-o"></i> Generate Excel
											</a>
											<a href="javascript:void(0);" data-url="{{url('report/pdf/payout')}}" class="btn btn-green btn-darken-3 mr-1 change-action">
												<i class="icon-file-pdf-o"></i> Generate PDF
											</a>
											<a href="{{url('report/payout')}}" style="margin-left: 5px;" class="btn btn-green btn-darken-4">
												<i class="icon-refresh"></i> Reset
											</a>
	                                    </div>
	                                </div>
	                            </div>
	                        </fieldset>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Both borders end-->
<div class="row">
	<div class="col-xs-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-clear_all"></i> Payout Report</h4>
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
								<th>Cashier Name</th>
								<th>Amount</th>
								<th>Negative Amount</th>
								<th>Reason</th>
								<th>Created</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$paid_amount=0;
							?>
							@if(isset($invoice))
								@foreach($invoice as $row)
								<tr>
	                                <td>{{$row->id}}</td>
									<td>{{$row->cashier_name}}</td>
									<td>{{$row->amount}}</td>
									<td>{{$row->negative_amount}}</td>
									<td>{{$row->reason}}</td>
									<td>{{date('Y-m-d',strtotime($row->created_at))}}</td>
	                            </tr>
	                            <?php 
								$paid_amount+=$row->amount;
								?>
	                            @endforeach
							@endif

						</tbody>
					</table>
				</div>
			</div>
		</div>




						<div class="col-lg-4 col-sm-4 border-right-green bg-green border-right-lighten-4">
                            <div class="card-block text-xs-center">
                                <h1 class="display-4 white"><i class="icon-money font-large-2"></i> ${{$paid_amount}}</h1>
                                <span class="white">Total Payout Amount</span>
                            </div>
                        </div>
                        



	</div>
</div>
<!-- Both borders end -->





</section>
@endsection


@include('apps.include.datatable',['JDataTable'=>1,'selectTwo'=>1,'dateDrop'=>1])