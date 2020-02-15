@extends('apps.layout.master')
@section('title','Buyback List')
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
				<h4 class="card-title"><i class="icon-random"></i> Buyback List</h4>
				<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        		<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li><a href="{{url('buyback/excel/report')}}"><i class="icon-file-excel" style="font-size: 20px;"></i></a></li>
                        <li><a href="{{url('buyback/pdf/report')}}"><i class="icon-file-pdf"  style="font-size: 20px;"></i></a></li>
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
						<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="card-body collapse in">
				<div class="table-responsive" style="min-height: 400px;">
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
								<th>Created</th>
								<th width="100">Action</th>
							</tr>
						</thead>
						<tbody>
							{{-- @if(isset($dataTable))
							@foreach($dataTable as $row)
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
								<td>{{formatDate($row->created_at)}}</td>
								<td>

									<span class="dropdown">
                                        <button id="btnSearchDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-green dropdown-toggle dropdown-menu-right"><i class="icon-cog3"></i></button>
                                        <span aria-labelledby="btnSearchDrop4" class="dropdown-menu mt-1 dropdown-menu-right">
                                            <a href="{{url('buyback/'.$row->id)}}" title="View Buyback" class="dropdown-item"><i class="icon-file-text"></i> View Buyback</a>
                                            <a href="{{url('buyback/print/'.$row->id)}}" title="Edit" class="dropdown-item"><i class="icon-printer"></i> Print</a>
                                            <a href="{{url('buyback/'.$row->id.'/edit')}}" title="Edit" class="dropdown-item"><i class="icon-pencil22"></i> Edit</a>
                                            <a href="{{url('buyback/delete/'.$row->id)}}" title="Edit" class="dropdown-item"><i class="icon-cross"></i> Delete</a>
                                        </span>
                                    </span>
									
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

{{-- @include('apps.include.datatable',['JDataTable'=>1]) --}}

@include('apps.include.datatablecssjs')
@section('RoleWiseMenujs')
   <script>
	
	$(document).ready(function(e){
		var buybackLink="{{url('buyback')}}";
		var buybackPrintLink="{{url('buyback/print')}}";
		var customerDeleteLink="{{url('buyback/delete')}}";

		function actionTemplate(id){
			var actHTml='';
				actHTml+='<span class="dropdown">';
                actHTml+='<button id="btnSearchDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-green dropdown-toggle dropdown-menu-right"><i class="icon-cog3"></i></button>';
                actHTml+='<span aria-labelledby="btnSearchDrop4" class="dropdown-menu mt-1 dropdown-menu-right">';
                actHTml+='    <a href="'+buybackLink+'/'+id+'" title="View Buyback" class="dropdown-item"><i class="icon-file-text"></i> View Buyback</a>';
                actHTml+='    <a href="'+buybackPrintLink+'/'+id+'" title="Edit" class="dropdown-item"><i class="icon-printer"></i> Print</a>';
                actHTml+='    <a href="'+buybackLink+'/'+id+'/edit" title="Edit" class="dropdown-item"><i class="icon-pencil22"></i> Edit</a>';
                actHTml+='    <a href="'+customerDeleteLink+'/'+id+'" title="Edit" class="dropdown-item"><i class="icon-cross"></i> Delete</a>';
                actHTml+='</span>';
            actHTml+='</span>';

				return actHTml;
		}

		function replaceNull(valH){
			var returnHt='';

			if(valH !== null && valH !== '') {
					returnHt=valH;
				
				
			}

			return returnHt;
		}

		$('#buyback_list').dataTable({
			"bProcessing": true,
         	"serverSide": true,
         	"ajax":{
	            url :"{{url('buyback/data/json')}}",
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
						strHTML+='		<td>'+row.customer_name+'</td>';
						strHTML+='		<td>'+replaceNull(row.model)+'</td>';
						strHTML+='		<td>'+replaceNull(row.carrier)+'</td>';
						strHTML+='		<td>'+replaceNull(row.imei)+'</td>';
						strHTML+='		<td>'+replaceNull(row.condition)+'</td>';
						strHTML+='		<td>'+replaceNull(row.price)+'</td>';
						strHTML+='		<td>'+replaceNull(row.payment_method_name)+'</td>';
						strHTML+='		<td>'+replaceNull(row.keep_this_on)+'</td>';
						strHTML+='		<td>'+formatDate(replaceNull(row.created_at))+'</td>';
						strHTML+='		<td>'+actionTemplate(row.id)+'</td>';
						strHTML+='</tr>';
	            	});

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
	});


    </script>

@endsection