@extends('apps.layout.master')
@section('title','Ticket List')
@section('content')
<section id="form-action-layouts">
<?php 
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>
<!-- Both borders end-->
<div class="row">
	<div class="col-xs-12" @if($userguideInit==1) data-step="1" data-intro="You are seeing all the ticket list in this table." @endif>
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
					<table class="table table-striped table-bordered" id="ticket_list">
						<thead>
							<tr>
								<th>Id</th>
								<th>Date</th>
								<th>Customer</th>
								<th width="300">Subject</th>
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
							/*
							$invoice_total=0;
							$cost_total=0;
							$paid_amount=0;
							?>
							@if(isset($invoice))
								@foreach($invoice as $inv)
								<tr>
	                                <td>{{$inv->id}}</td>
	                                <td>{{formatDate($inv->created_at)}}</td>
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
	                                	<span class="dropdown" @if($userguideInit==1) data-step="2" data-intro="In this button You see view ticket info, print and  delete option." @endif>
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
							<?php */ ?>

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


@include('apps.include.datatablecssjs',['selectTwo'=>1,'dateDrop'=>1])
@section('RoleWiseMenujs')
   <script>
    
    $(document).ready(function(e){
        var ticketView="{{url('ticket/view')}}";
        var ticketPrint="{{url('ticket/print')}}";
        var ticketDelete="{{url('ticket/delete')}}";

        function actionTemplate(id){
             var actHTml='';
                actHTml+='<span class="dropdown" ';
                			@if($userguideInit==1) 
                actHTml+='	data-step="2" data-intro="In this button You see view repair info, print and  delete option." ';
                			@endif
                actHTml+='	>';
	            actHTml+='  <button id="btnSearchDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-green dropdown-toggle dropdown-menu-right"><i class="icon-cog3"></i></button>';
	            actHTml+='                <span aria-labelledby="btnSearchDrop4" class="dropdown-menu mt-1 dropdown-menu-right">';
	            actHTml+='                    <a href="'+ticketView+'/'+id+'" title="View Invoice" class="dropdown-item"><i class="icon-file-text"></i> View Repair Info</a>';
	            actHTml+='                    <a href="'+ticketPrint+'/'+id+'" title="Print" class="dropdown-item"><i class="icon-printer"></i> Print</a>';
	            actHTml+='                    <a href="'+ticketDelete+'/'+id+'" title="Delete" class="dropdown-item"><i class="icon-cross"></i> Delete</a>';
	            actHTml+='                </span>';
	            actHTml+='            </span>';

                return actHTml;
        }

        var ticketPOSLink="{{url('pos/ticket')}}";
        var ticketPOSPartialLink="{{url('pos/ticket/partial')}}";

        function actionStatusTemplate(id,retail_price,payment_status){

        	var actHTml='';
        	if(payment_status=="Pending"){
        		actHTml='<a href="'+ticketPOSLink+'/'+id+'" class="btn btn-green">'+number_format(retail_price)+' To POS  </a>';
        	}
        	else if(payment_status=="Partial"){
        		actHTml='<a href="'+ticketPOSPartialLink+'/'+id+'" class="btn btn-green btn-darken-4"> PAY PARTIAL</a>';
        	}
        	else{
        		actHTml='Paid';
        	}
        		
        		
            return actHTml;
        }

        function replaceNull(valH){
            var returnHt='';
            if(valH !== null && valH !== '') {
                returnHt=valH                
            }

            return returnHt;
        }

        $('#ticket_list').dataTable({
            "bProcessing": true,
            "serverSide": true,
            "aLengthMenu": [[25, 50, 100, 500,999999999999999999], [25, 50, 100, 500, "All"]],
            "ajax":{
                url :"{{url('ticket/data/json')}}",
                headers: {
                    'X-CSRF-TOKEN':'{{csrf_token()}}',
                },
                type: "POST",
                complete:function(data){
                    console.log(data.responseJSON);
                    var totalData=data.responseJSON;
                    console.log(totalData.data);
                    var strHTML='';
                    $.each(totalData.data,function(key,row){
                        console.log(row);
                        strHTML+='<tr>';
                        strHTML+='      <td>'+row.id+'</td>';
                        strHTML+='      <td>'+formatDate(row.created_at)+'</td>';
                        strHTML+='      <td>'+replaceNull(row.customer_name)+'</td>';
                        strHTML+='      <td>'+replaceNull(row.product_name)+'</td>';
                        strHTML+='      <td>'+replaceNull(row.problem_name)+'</td>';
                        strHTML+='      <td>'+number_format(replaceNull(row.our_cost))+'</td>';
                        strHTML+='      <td>'+number_format(replaceNull(row.retail_price))+'</td>';
                        strHTML+='      <td>'+actionStatusTemplate(row.id,row.price,row.payment_status)+'</td>';
                        strHTML+='      <td>'+replaceNull(row.invoice_id)+'</td>';
                        strHTML+='      <td>'+actionTemplate(row.id)+'</td>';
                        strHTML+='</tr>';
                    });
                    $("tbody").html(strHTML);
                    $('#ticket_list').DataTable();
                },
                initComplete: function(settings, json) {
                    alert( 'DataTables has finished its initialisation.' );
                },
                error: function(){
                  $("#ticket_list_processing").css("display","none");
                }
            }
        });
    });


    </script>

@endsection