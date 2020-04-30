@extends('apps.layout.master')
@section('title','Customer Lead')
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
	<div class="col-xs-12" @if($userguideInit==1) data-step="1" data-intro="You are seeing all customer lead in this table. You can edit and delete in this table" @endif>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-users2"></i> Customer Lead List</h4>
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
					<table class="table table-striped table-bordered" id="customer_lead">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Phone</th>
								<th>Email</th>
								<th>Lead Info</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							{{-- @if(isset($dataTable))
							@foreach($dataTable as $row)
							<tr>
								<td>{{$row->id}}</td>
								<td>{{$row->name}}</td>
								<td>{{$row->phone}}</td>
								<td>{{$row->email}}</td>
								<td>{{$row->lead_info}}</td>
								<td>
                                        <a href="{{url('customer/lead/edit/'.$row->id)}}" title="Edit" class="btn btn-sm btn-outline-green"  @if($userguideInit==1) data-step="2" data-intro="If you want you can modify your information when you click this button." @endif ><i class="icon-pencil22"></i></a>
                                        <a  href="{{url('customer/lead/delete/'.$row->id)}}" title="Delete" class="btn btn-sm btn-outline-green btn-darken-1"  @if($userguideInit==1) data-step="3" data-intro="If you want delect then click this button." @endif><i class="icon-cross"></i></a>
								</td>
							</tr>
							@endforeach
							@else
							<tr>
								<td colspan="6">No Record Found</td>
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
		var customerEditLink="{{url('customer/lead/edit')}}";
		var customerDeleteLink="{{url('customer/lead/delete')}}";

		function actionTemplate(id){
			var actHTml='';
				actHTml+='<a href="'+customerEditLink+'/'+id+'" class="btn btn-green mr-1 btn-darken-2" ';
				@if($userguideInit==1) 
				actHTml+=' data-step="2" data-intro="If you want you can modify your information when you click this button." ';
				@endif
				actHTml+=' >	<i class="icon-edit"></i> </a>';

				actHTml+='<a href="'+customerDeleteLink+'/'+id+'" class="btn btn-green mr-1 btn-darken-3" ';
				@if($userguideInit==1) 
					actHTml+='data-step="3" data-intro="If you want delect then click this button." ';
				@endif
				actHTml+=' >	<i class="icon-trash"></i> </a>';

				return actHTml;
		}

		function replaceNull(valH){
			var returnHt='';

			if(valH !== null && valH !== '') {
					returnHt=valH;
				
				
			}

			return returnHt;
		}

		$('#customer_lead').dataTable({
			"bProcessing": true,
         	"serverSide": true,
         	"aLengthMenu": [[25, 50, 100, 500,900000000000000], [25, 50, 100, 500, "All"]],
         	"ajax":{
	            url :"{{url('customer/lead/data/json')}}",
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
						strHTML+='		<td>'+row.name+'</td>';
						strHTML+='		<td>'+replaceNull(row.phone)+'</td>';
						strHTML+='		<td>'+replaceNull(row.email)+'</td>';
						strHTML+='		<td>'+replaceNull(row.lead_info)+'</td>';
						strHTML+='		<td>'+actionTemplate(row.id)+'</td>';
						strHTML+='</tr>';
	            	});

	            	$("tbody").html(strHTML);

	            	$('#customer_lead').DataTable();
	            },
	            initComplete: function(settings, json) {
				    alert( 'DataTables has finished its initialisation.' );
				  },
	            error: function(){
	              $("#customer_lead_processing").css("display","none");
	            }
          	}
        });
	});


    </script>

@endsection