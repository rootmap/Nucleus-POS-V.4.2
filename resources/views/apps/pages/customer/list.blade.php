@extends('apps.layout.master')
@section('title','Customer')
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
	<div class="col-xs-12" @if($userguideInit==1) data-step="1" data-intro="You are seeing all customer in this table and see customer report." @endif>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><i class="icon-users2"></i> Customer List</h4>
				<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        		<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li><a href="{{url('customer/excel/report')}}"><i class="icon-file-excel" style="font-size: 20px;"></i></a></li>
                        <li><a href="{{url('customer/pdf/report')}}"><i class="icon-file-pdf"  style="font-size: 20px;"></i></a></li>
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
						<li><a data-action="expand"><i class="icon-expand2"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="card-body collapse in">
				<div class="table-responsive">
					<table id="post_list" class="dataTable table table-bordered" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Address</th>
								<th>Phone</th>
								<th>Email</th>
								<th>Invoice ID</th>
								@if(in_array('list_customer_report', $dataMenuAssigned))
									<th>Report</th>
								@endif
							</tr>
						</thead>
						<tbody>
							
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


@section('css')
	<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
    <style type="text/css">
		div.dataTables_length{
				padding-left: 10px;
				padding-top: 15px;
		}

		.dataTables_length>label{
			margin-bottom: 0px !important;
			display:block; !important;
		}

		div.dataTables_filter
		{
			padding-right: 10px;
		}

		div.dataTables_green{
			padding-left: 10px;
		}

		div.dataTables_paginate{
			padding-right: 10px;
			padding-top: 5px;
		}
	</style>
	
@endsection

@section('js')
	
    <script src="{{url('theme/app-assets/vendors/js/tables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{url('theme/app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
   <script>
	
	$(document).ready(function(e){
		var customerReportLink="{{url('customer/report')}}";
		var customerEditLink="{{url('customer/edit')}}";
		var customerDeleteLink="{{url('customer/delete')}}";

		function actionTemplate(id){
			var actHTml='';
			    actHTml+='<a href="'+customerReportLink+'/'+id+'" class="btn btn-green mr-1 change-action"'; 
			    @if($userguideInit==1) 
			    actHTml+='	data-step="2" data-intro="When you see report then click view report button."'; 
			    @endif
				actHTml+=' >	<i class="icon-file-o"></i> View Report	</a>';

				actHTml+='<a href="'+customerEditLink+'/'+id+'" class="btn btn-green mr-1 btn-darken-2" ';
				@if($userguideInit==1) 
				actHTml+=' data-step="3" data-intro="When you see modify then click edit button." ';
				@endif
				actHTml+=' >	<i class="icon-edit"></i> </a>';

				actHTml+='<a href="'+customerDeleteLink+'/'+id+'" class="btn btn-green mr-1 btn-darken-3" ';
				@if($userguideInit==1) 
					actHTml+='data-step="4" data-intro="When you delete report then click delete button." ';
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

		$('#post_list').dataTable({
			"bProcessing": true,
         	"serverSide": true,
         	"aLengthMenu": [[25, 50, 100, 500,9999999999999999], [25, 50, 100, 500, "All"]],
         	"ajax":{
	            url :"{{url('customer/data/json')}}",
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
						strHTML+='		<td>'+replaceNull(row.address)+'</td>';
						strHTML+='		<td>'+replaceNull(row.phone)+'</td>';
						strHTML+='		<td>'+replaceNull(row.email)+'</td>';
						strHTML+='		<td>'+replaceNull(row.last_invoice_no)+'</td>';
						@if(in_array('list_customer_report', $dataMenuAssigned))
							strHTML+='		<td width="550">'+actionTemplate(row.id)+'</td>';
						@endif
						strHTML+='</tr>';
	            	});

	            	$("tbody").html(strHTML);

	            	$('#post_list').DataTable();
	            },
	            initComplete: function(settings, json) {
				    alert( 'DataTables has finished its initialisation.' );
				  },
	            error: function(){
	              $("#post_list_processing").css("display","none");
	            }
          	}
        });
	});


    </script>

@endsection