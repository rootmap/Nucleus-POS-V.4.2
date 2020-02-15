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
					<table class="table table-striped table-bordered" id="special_parts_order">
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
							{{-- @if(isset($dataTable))
							@foreach($dataTable as $row)
							<tr>
								<td>{{$row->id}}</td>
								<td>{{$row->ticket_id}}</td>
								<td>{{$row->ticket_payment_status}}</td>
								<td>{{$row->customer_name}}</td>
								<td>{{$row->description}}</td>
								<td>{{formatDate($row->ordered)}}</td>
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
                                        <a href="{{url('special/parts/delete/'.$row->id)}}" title="Delete" class="btn btn-sm btn-outline-info btn-accent-2"><i class="icon-cross"></i></a>
								</td>
							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="8">No Record Found</td>
							</tr>
							@endif --}}
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


@include('apps.include.datatablecssjs')
@section('RoleWiseMenujs')
   <script>
	
	$(document).ready(function(e){
		var customerEditLink="{{url('special/parts')}}";
		var customerDeleteLink="{{url('special/parts/delete')}}";

		function actionTemplate(id){
			var actHTml='';
				actHTml+='<a href="'+customerEditLink+'/'+id+'/edit" class="btn btn-green mr-1 btn-darken-2" >	<i class="icon-edit"></i> </a>';

				actHTml+='<a href="'+customerDeleteLink+'/'+id+'" class="btn btn-green mr-1 btn-darken-3" >	<i class="icon-trash"></i> </a>';

				return actHTml;
		}

		function replaceNull(valH){
			var returnHt='';

			if(valH !== null && valH !== '') {
					returnHt=valH;
				
				
			}

			return returnHt;
		}

		$('#special_parts_order').dataTable({
			"bProcessing": true,
         	"serverSide": true,
         	"ajax":{
	            url :"{{url('special/parts/data/json')}}",
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
						strHTML+='		<td>'+row.id+'</td>';
						strHTML+='		<td>'+row.ticket_id+'</td>';
						strHTML+='		<td>'+replaceNull(row.ticket_payment_status)+'</td>';
						strHTML+='		<td>'+replaceNull(row.customer_name)+'</td>';
						strHTML+='		<td>'+replaceNull(row.description)+'</td>';
						strHTML+='		<td>'+formatDate(replaceNull(row.ordered))+'</td>';
						strHTML+='		<td>'+replaceNull(row.order_status)+'</td>';
						strHTML+='		<td>'+actionTemplate(row.id)+'</td>';
						strHTML+='</tr>';
	            	});

	            	$("tbody").html(strHTML);

	            	$('#special_parts_order').DataTable();
	            },
	            initComplete: function(settings, json) {
				    alert( 'DataTables has finished its initialisation.' );
				  },
	            error: function(){
	              $("#special_parts_order_processing").css("display","none");
	            }
          	}
        });
	});


    </script>

@endsection