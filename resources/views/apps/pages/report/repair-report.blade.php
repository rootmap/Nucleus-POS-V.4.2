@extends('apps.layout.master')
@section('title','Repair Report')
@section('content')
<section id="form-action-layouts">
	<?php
	$userguideInit=StaticDataController::userguideInit();
	?>
		<div class="row">
		<div class="col-md-12" @if($userguideInit==1) data-step="1" data-intro="You can see Repair by date wise or invoice or Customer and generate excel or PDF." @endif>
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center"><i class="icon-filter_list"></i> Repair Report Filter</h4>
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
						<form method="post" action="{{url('repair-report')}}">
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
	                                    <h4>Invoice ID</h4>
	                                    <div class="input-group">
										<input 
										 @if(!empty($invoice_id))
	                                        	value="{{$invoice_id}}"  
	                                     @endif 
										 type="text" id="eventRegInput1" class="form-control border-green" placeholder="Invoice ID" name="invoice_id">
	                                    </div>
	                                </div>
	                                <div class="col-md-3">
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
	                                <div class="col-md-4">
	                                    <h4>Repair Options</h4>
	                                    <div class="input-group">
											<select name="repair_option" class="select2 form-control">
												<option value="">Select a options</option>
                                                <option 
                                                @isset($repair_option)
                                                    @if ($repair_option=="Repair Parts")
                                                        selected="selected" 
                                                    @endif
                                                @endisset 
                                                value="Repair Parts">Repair with and without inventory parts</option>
                                                <option 
                                                @isset($repair_option)
                                                    @if ($repair_option=="repair")
                                                        selected="selected" 
                                                    @endif
                                                @endisset 
                                                value="repair">Repair without inventory parts</option>
                                                <option 
                                                @isset($repair_option)
                                                    @if ($repair_option=="Parts")
                                                        selected="selected" 
                                                    @endif
                                                @endisset 
                                                value="Parts">Repair with inventory parts</option>
											</select>
	                                    </div>
	                                </div>
	                                <div class="col-md-6">
	                                    
	                                    <div class="input-group" style="margin-top:32px;">
	                                        <button type="submit" class="btn btn-green btn-darken-1 mr-1" @if($userguideInit==1) data-step="2" data-intro="If you click this button then it will generate your report." @endif>
												<i class="icon-check2"></i> Generate
											</button>
											<a href="javascript:void(0);" data-url="{{url('repair-report/excel/report')}}" class="btn btn-green btn-darken-2 mr-1 change-action" @if($userguideInit==1) data-step="3" data-intro="If you click this button then it will generate excel file." @endif>
												<i class="icon-file-excel-o"></i> Generate Excel
											</a>
											<a href="javascript:void(0);" data-url="{{url('repair-report/pdf/report')}}" class="btn btn-green btn-darken-3 mr-1 change-action" @if($userguideInit==1) data-step="4" data-intro="If you click this button then it will generate pdf file." @endif>
												<i class="icon-file-pdf-o"></i> Generate PDF
											</a>
											<a href="{{url('repair-report')}}" style="margin-left: 5px;" class="btn btn-green btn-darken-4" @if($userguideInit==1) data-step="5" data-intro="if you want clear all information then click the reset button." @endif>
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
				<h4 class="card-title"><i class="icon-clear_all"></i> Repair List</h4>
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
					<table class="table table-striped table-bordered" id="report_table">
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
							<?php 
							$invoice_total=0;
							$cost_total=0;
                            $paid_amount=0;
                            //dd($invoice);
							?>
							@if(isset($invoice))
								@foreach($invoice as $inv)
								<tr>
	                                <td>{{$inv->id}}</td>
	                                <td>{{formatDate($inv->created_at)}}</td>
	                                <td>{{$inv->customer_name}}</td>
	                                <td>{{$inv->repair_type=="Parts"?"Inventory Repair":$inv->product_name}}</td>
	                                <td>
                                        <?php $parts_text=""; 
                                        $total_repair_price=$inv->price;
                                        ?>
                                        @if($inv->total_parts > 0)
                                            <?php 
                                                $parts_json=json_decode($inv->parts_json);
                                                
                                                
                                            ?>
                                            @foreach($parts_json as $item)
                                                @if(!empty($parts_text))
                                                    <?php $parts_text.=", "; ?>
                                                @endif

                                                @if(!empty($item->name))
                                                    <?php $parts_text.=$item->name; ?>
                                                @endif

                                                @if(!empty($item->price))
                                                    <?php $total_repair_price+=$item->price; ?>
                                                @endif
                                            @endforeach
                                        @else 
                                            <?php $parts_text="Special Ordered Part/No Parts Required"; ?>
                                        @endif
                                        {{$parts_text}}
                                    </td>
	                                <td>${{$total_repair_price}}</td>
	                                <td>{{$inv->payment_status}}</td>
	                                <td>{{$inv->invoice_id}}</td>
	                                <td>
                                        <span class="dropdown"> <button id="btnSearchDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-green dropdown-toggle dropdown-menu-right"><i class="icon-cog3"></i></button>
                                            <span aria-labelledby="btnSearchDrop4" class="dropdown-menu mt-1 dropdown-menu-right">
                                                <a href="{{url('repair-view/'.$inv->id)}}" title="View Invoice" class="dropdown-item"><i class="icon-file-text"></i> View Repair Info</a>
                                                <a href="{{url('repair-print/'.$inv->id)}}" title="Print" class="dropdown-item"><i class="icon-printer"></i> Print</a>
                                            </span>
                                        </span>
                                    </td>
	                            </tr>
	                            <?php 
								$paid_amount+=$total_repair_price;
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
                                <h1 class="display-4 white"><i class="icon-money font-large-2"></i> $<span id="totalDataAmount">{{number_format($paid_amount,2)}}</span></h1>
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
                //actHTml+='                <a href="'+repairDelete+'/'+id+'" title="Delete" class="dropdown-item"><i class="icon-cross"></i> Delete</a>';
                actHTml+='           </span>';
                actHTml+='      </span>';

            return actHTml;
    }

    var repairPOSLink="{{url('pos-repair')}}";
    var repairPOSPartialLink="{{url('pos-repair')}}";
	
	$(document).ready(function(e){
        

		var dataObj="";
		function replaceNull(valH){
			var returnHt='';

			if(valH !== null && valH !== '') {
					returnHt=valH;
			}

			return returnHt;
		}

		@if(!empty($start_date) || !empty($end_date) || !empty($invoice_id) || !empty($customer_id) || !empty($repair_option))
			@if(isset($invoice))
        		@if(count($invoice)>0)
        			$('#report_table').DataTable({"aLengthMenu": [[25, 50, 100, 500,999999999999999999], [25, 50, 100, 500, "All"]]});
        		@endif
        	@endif
        @else

		$('#report_table').dataTable({
			"bProcessing": true,
         	"serverSide": true,
         	"aLengthMenu": [[25, 50, 100, 500,999999999999999999], [25, 50, 100, 500, "All"]],
         	"ajax":{
	            url :"{{url('repair-report/data/json')}}",
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

                        
                        totalPrice+=total_repair_price-0;
                        strHTML+='      <td>'+replaceNull(parts_text)+'</td>';
                        strHTML+='      <td class="price_column">$'+number_format(replaceNull(total_repair_price))+'</td>';
                        strHTML+='      <td>'+replaceNull(row.payment_status)+'</td>';
                        strHTML+='      <td>'+replaceNull(row.invoice_id)+'</td>';
                        strHTML+='      <td>'+actionTemplate(row.id)+'</td>';
                        strHTML+='</tr>';
                    });

	            	$("#totalDataAmount").html(number_format(totalPrice));

	            	$("tbody").html(strHTML);
	            	$('#report_table').DataTable();
	            },
	            initComplete: function(settings, json) {
				    alert( 'DataTables has finished its initialisation.' );
				  },
	            error: function(){
	              $("#report_table_processing").css("display","none");
	            }
          	}
        });

        @endif
	});


    </script>

@endsection