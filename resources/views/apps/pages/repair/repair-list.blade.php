@extends('apps.layout.master')
@section('title','Repair Data')
@section('content')
<section id="form-action-layouts">
<?php 
    $userguideInit=StaticDataController::userguideInit();
?>
<!-- Both borders end-->
<div class="row">
	<div class="col-xs-12" @if($userguideInit==1) data-step="1" data-intro="You are seeing all the repair list in this table." @endif>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-database"></i> Repair Data</h4>
				<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        		<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
						<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
					</ul>
				</div>
            </div>
            <style type="text/css">
            .price_column::before{
                content: '$';

            }
            </style>
			<div class="card-body collapse in">
				<div class="table-responsive">
					<table class="table table-striped table-bordered" id="repair_list">
						<thead>
							<tr>
								<th>Id</th>
								<th>Date</th>
								<th>Customer</th>
								<th>Repair Detail</th>
								<th>Parts Required</th>
								<th>Price</th>
								<th>Status</th>
								<th>Invoice ID</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						 <?php  /*
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
	                                <td>{{number_format($inv->price,2)}}</td>
	                                <td>
	                                	@if($inv->payment_status=="Pending" && $inv->invoice_status!="Paid")
	                                		<a href="{{url('pos/repair/'.$inv->id)}}" class="btn btn-green"> {{number_format($inv->price,2)}} To POS</i> </a>
	                                	@elseif($inv->payment_status=="Partial" && $inv->invoice_status!="Paid")
	                                		<a href="{{url('pos/repair/partial/'.$inv->id)}}" class="btn btn-green btn-darken-4"> PAY PARTIAL</i> </a>
	                                	@elseif($inv->payment_status=="Partial" && $inv->invoice_status=="Paid")
	                                		Paid
	                                	@else
	                                		Paid
	                                	@endif
	                                </td>
	                                <td>{{$inv->invoice_id}}</td>
	                                <td>
	                                	<span class="dropdown" @if($userguideInit==1) data-step="2" data-intro="In this button You see view repair info, print and  delete option." @endif>
	                                        <button id="btnSearchDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-green dropdown-toggle dropdown-menu-right"><i class="icon-cog3"></i></button>
	                                        <span aria-labelledby="btnSearchDrop4" class="dropdown-menu mt-1 dropdown-menu-right">
	                                            <a href="{{url('repair/view/'.$inv->id)}}" title="View Invoice" class="dropdown-item"><i class="icon-file-text"></i> View Repair Info</a>
	                                            <a href="{{url('repair/print/'.$inv->id)}}" title="Print" class="dropdown-item"><i class="icon-printer"></i> Print</a>
	                                            <a href="{{url('repair/delete/'.$inv->id)}}" title="Delete" class="dropdown-item"><i class="icon-cross"></i> Delete</a>
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
        var repairView="{{url('repair-view')}}";
        var repairPrint="{{url('repair-print')}}";
        var repairDelete="{{url('repair-delete')}}";

        function actionTemplate(id){
            var actHTml='';
                actHTml+='<span class="dropdown" ';
                			@if($userguideInit==1) 
                 actHTml+='	data-step="2" data-intro="In this button You see view repair info, print and  delete option." ';
                			@endif

	             actHTml+=' > <button id="btnSearchDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-green dropdown-toggle dropdown-menu-right"><i class="icon-cog3"></i></button>';
	             actHTml+='                <span aria-labelledby="btnSearchDrop4" class="dropdown-menu mt-1 dropdown-menu-right">';
	             actHTml+='                <a href="'+repairView+'/'+id+'" title="View Invoice" class="dropdown-item"><i class="icon-file-text"></i> View Repair Info</a>';
	             actHTml+='                <a href="'+repairPrint+'/'+id+'" title="Print" class="dropdown-item"><i class="icon-printer"></i> Print</a>';
	             actHTml+='                <a href="'+repairDelete+'/'+id+'" title="Delete" class="dropdown-item"><i class="icon-cross"></i> Delete</a>';
	              actHTml+='           </span>';
	               actHTml+='      </span>';

                return actHTml;
        }

        var repairPOSLink="{{url('pos-repair')}}";
        var repairPOSPartialLink="{{url('pos-repair')}}";

        function actionStatusTemplate(id,price,payment_status,invoice_status){

        	var actHTml='';
        		if(payment_status=="Pending" && invoice_status!="Paid"){
        				actHTml='<a href="'+repairPOSLink+'/'+id+'" class="btn btn-green"> $'+number_format(price)+' To POS</i> </a>';
        		}else if(payment_status=="Partial" && invoice_status!="Paid"){
        				actHTml='<a href="'+repairPOSPartialLink+'/'+id+'" class="btn btn-green btn-darken-4"> PAY PARTIAL</i> </a>';
        		}else if(payment_status=="Paid" && invoice_status=="Paid"){
        				actHTml='Paid';
        		}
        		else{
        				actHTml='Pending';
        		}
        		
                return actHTml;
        }

        function replaceNull(valH){
            var returnHt='';

            if(valH !== null && valH !== '') {
                    returnHt=valH;
                
                
            }

            return returnHt;
        }

        $('#repair_list').dataTable({
            "bProcessing": true,
            "serverSide": true,
            "aLengthMenu": [[25, 50, 100, 500,999999999999999999], [25, 50, 100, 500, "All"]],
            "ajax":{
                url :"{{url('repair-data/json')}}",
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
                        strHTML+='      <td>'+formatDate(replaceNull(row.created_at))+'</td>';
                        strHTML+='      <td>'+replaceNull(row.customer_name)+'</td>';

						if(row.repair_type=="Parts")
						{
							strHTML+='      <td>'+replaceNull("Inventory Repair")+'</td>';
						}
						else
						{
							strHTML+='      <td>'+replaceNull(row.product_name)+'</td>';
						}

                        
                        var parts_text='';
                        var total_repair_price=row.price;
                        if(row.total_parts>0)
                        {
                            $.each($.parseJSON(row.parts_json),function(r,k){
                                if(parts_text.length > 0)
                                {
                                    parts_text+=', ';
                                }

                                if(k.name!=undefined)
                                {
                                    parts_text+=k.name;
                                }

                                if(k.price!=undefined)
                                {
                                    total_repair_price+=(k.price-0);
                                }
                                
                            });
						}
						else
						{
							parts_text="Special Ordered Part/No Parts Required";
						}

                        
                        
                        strHTML+='      <td>'+replaceNull(parts_text)+'</td>';
                        strHTML+='      <td class="price_column">'+number_format(replaceNull(total_repair_price))+'</td>';
                        strHTML+='      <td>'+actionStatusTemplate(row.id,total_repair_price,row.payment_status,row.invoice_status)+'</td>';
                        strHTML+='      <td>'+replaceNull(row.invoice_id)+'</td>';
                        strHTML+='      <td>'+actionTemplate(row.id)+'</td>';
                        strHTML+='</tr>';
                    });

                    $("tbody").html(strHTML);

                    $('#repair_list').DataTable();
                },
                initComplete: function(settings, json) {
                    alert( 'DataTables has finished its initialisation.' );
                  },
                error: function(){
                  $("#repair_list_processing").css("display","none");
                }
            }
        });
    });


    </script>

@endsection