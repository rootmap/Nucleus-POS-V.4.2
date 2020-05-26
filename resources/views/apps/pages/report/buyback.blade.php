@extends('apps.layout.master')
@section('title','Buyback Report')
@section('content')
<section id="form-action-layouts">
<?php
$userguideInit=StaticDataController::userguideInit();
?>

		<div class="row">
		<div class="col-md-12" @if($userguideInit==1) data-step="1" data-intro="You can see Buyback by date wise or invoice or customer or part | sale and generate excel or PDF." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center"><i class="icon-filter_list"></i> Buyback Report Filter</h4>
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
						<form method="post" action="{{url('report/buyback')}}">
							{{csrf_field()}}
							<fieldset class="form-group">
	                            <div class="row">
	                                <div class="col-md-2">
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
	                                <div class="col-md-2">
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
	                                <div class="col-md-2">
	                                    <h4>Invoice ID</h4>
	                                    <div class="input-group">
										<input 
										 @if(!empty($invoice_id))
	                                        	value="{{$invoice_id}}"  
	                                     @endif 
										 type="text" id="eventRegInput1" class="form-control border-green" placeholder="Invoice ID" name="invoice_id">
	                                    </div>
	                                </div>
	                                <div class="col-md-2">
	                                    <h4>Customer</h4>
	                                    <div class="input-group">
											<select name="customer_id" class="select2 form-control">
												<option value="">Select a customer</option>
												@if(isset($customer))
													@foreach($customer as $cus)
													<option 
													 @if(!empty($customer_id) && $customer_id==$cus->id)
				                                        selected="selected"  
				                                     @endif 
													value="{{$cus->id}}">{{$cus->name}}</option>
													@endforeach
												@endif
											</select>
	                                    </div>
	                                </div>
	                                <div class="col-md-2">
	                                    <h4>Parts | Sale</h4>
	                                    <div class="input-group">
											<select name="keep_this_on" class="select2 form-control">
												<option value="">Select a Parts | Sale</option>
													<option 
													 @if(!empty($keep_this_on)) 
													 	@if($keep_this_on=="Parts")
				                                        	selected="selected"  
				                                        @endif
				                                     @endif 
													value="Parts">Parts</option>
													<option 
													 @if(!empty($keep_this_on)) 
													 	@if($keep_this_on=="Sale")
				                                        	selected="selected"  
				                                        @endif
				                                     @endif 
													value="Sale">Sale</option>
											</select>
	                                    </div>
	                                </div>
	                                <div class="col-md-12">
	                                    
	                                    <div class="input-group" style="margin-top:32px;">
	                                        <button type="submit" class="btn btn-green btn-darken-1 mr-1" @if($userguideInit==1) data-step="2" data-intro="If you click this button then it will generate your report." @endif>
												<i class="icon-check2"></i> Generate
											</button>
											<a href="javascript:void(0);" data-url="{{url('report/excel/buyback')}}" class="btn btn-green btn-darken-2 mr-1 change-action" @if($userguideInit==1) data-step="3" data-intro="If you click this button then it will generate excel file." @endif>
												<i class="icon-file-excel-o"></i> Generate Excel
											</a>
											<a href="javascript:void(0);" data-url="{{url('report/pdf/buyback')}}" class="btn btn-green btn-darken-3 mr-1 change-action" @if($userguideInit==1) data-step="4" data-intro="If you click this button then it will generate pdf file." @endif>
												<i class="icon-file-pdf-o"></i> Generate PDF
											</a>
											<a href="{{url('report/buyback')}}" style="margin-left: 5px;" class="btn btn-green btn-darken-4" @if($userguideInit==1) data-step="5" data-intro="if you want clear all information then click the reset button." @endif>
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
				<h4 class="card-title"><i class="icon-clear_all"></i> Buyback Report</h4>
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
					<table class="table table-striped table-bordered" id="buyback_list">
						<thead>
							<tr>
								<th>ID</th>
								<th>Customer</th>
								<th>Model</th>
								<th>Carrier</th>
								<th>IMEI</th>
								<th>Condition</th>
								<th>Price</th>
								<th>Tender</th>
								<th>Parts | Sale</th>
								<th>Invoice ID</th>
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
									<td>{{$row->customer_name}}</td>
									<td>{{$row->model}}</td>
									<td>{{$row->carrier}}</td>
									<td>{{$row->imei}}</td>
									<td>{{$row->condition}}</td>
									<td>{{number_format($row->price,2)}}</td>
									<td>{{$row->payment_method_name}}</td>
									<td>{{$row->keep_this_on}}</td>
									<td>{{$row->invoice_id}}</td>
									<td>{{formatDate($row->created_at)}}</td>
	                            </tr>
	                            <?php 
								$paid_amount+=$row->price;
								?>
	                            @endforeach
							@endif

						</tbody>
					</table>
				</div>
			</div>
		</div>




						<div class="col-lg-4 col-sm-4 border-right-blue bg-blue border-right-lighten-4">
                            <div class="card-block text-xs-center">
                                <h1 class="display-4 white"><i class="icon-money font-large-2"></i>  $<span id="totalDataAmount">{{$paid_amount}}</span></h1>
                                <span class="white">Total Paid Amount</span>
                            </div>
                        </div>
                        



	</div>
</div>
<!-- Both borders end -->





</section>
@endsection


@include('apps.include.datatablecssjs',['selectTwo'=>1,'dateDrop'=>1])
@section('RoleWiseMenujs')
   <script>
	
	$(document).ready(function(e){

		var dataObj="";
		function replaceNull(valH){
			var returnHt='';

			if(valH !== null && valH !== '') {
					returnHt=valH;
			}

			return returnHt;
		}

		@if(!empty($start_date) || !empty($end_date) || !empty($invoice_id) || !empty($customer_id) || !empty($keep_this_on))
			@if(isset($invoice))
        		@if(count($invoice)>0)
        			$('#buyback_list').DataTable({"aLengthMenu": [[25, 50, 100, 500,999999999999999999], [25, 50, 100, 500, "All"]]});
        		@endif
        	@endif
        @else

		$('#buyback_list').dataTable({
			"bProcessing": true,
         	"serverSide": true,
         	"aLengthMenu": [[25, 50, 100, 500,999999999999999999], [25, 50, 100, 500, "All"]],
         	"ajax":{
	            url :"{{url('report/buyback/data/json')}}",
	            headers: {
			        'X-CSRF-TOKEN':'{{csrf_token()}}',
			    },
	            type: "POST",
	            complete:function(data){
	            	console.log(data.responseJSON);
	            	var totalData=data.responseJSON;
	            	console.log(totalData.data);
	            	var strHTML='';
	            	var totalPrice=0;
	            	$.each(totalData.data,function(key,row){
	            		console.log(row);

	            		strHTML+='<tr>';
						strHTML+='		<td>'+row.id+'</td>';
						strHTML+='		<td>'+row.customer_name+'</td>';
						strHTML+='		<td>'+replaceNull(row.model)+'</td>';
						strHTML+='		<td>'+replaceNull(row.carrier)+'</td>';
						strHTML+='		<td>'+replaceNull(row.imei)+'</td>';
						strHTML+='		<td>'+replaceNull(row.condition)+'</td>';
						strHTML+='		<td>'+replaceNull(row.price)+'</td>';
						strHTML+='		<td>'+replaceNull(row.payment_method_name)+'</td>';
						strHTML+='		<td>'+replaceNull(row.keep_this_on)+'</td>';
						strHTML+='		<td>'+replaceNull(row.invoice_id)+'</td>';
						strHTML+='		<td>'+formatDate(replaceNull(row.created_at))+'</td>';
						strHTML+='</tr>';

						totalPrice+=replaceNull(row.price)-0;

	            	});

	            	$("#totalDataAmount").html(totalPrice);

	            	$("tbody").html(strHTML);
	            	$('#buyback_list').DataTable();
	            },
	            initComplete: function(settings, json) {
				    alert( 'DataTables has finished its initialisation.' );
				  },
	            error: function(){
	              $("#buyback_list_processing").css("display","none");
	            }
          	}
        });

        @endif
	});


    </script>

@endsection