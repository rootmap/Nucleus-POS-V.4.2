@extends('apps.layout.master')
@section('title','Stockin Order List')
@section('content')
<section id="form-action-layouts">

<?php 
    $dataMenuAssigned=array();
    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>  
    <!-- Both borders end-->
<div class="row">
    <div class="col-xs-12" @if($userguideInit==1) data-step="1" data-intro="You are seeing all the stock in order list in this table. You see product detail or edit or delete option." @endif>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-stack"></i> Stock In Order List</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>

                <div class="card-body collapse in">
                    <div class="table-responsive" style="min-height: 360px;">
                        <table class="table table-striped table-bordered" id="product_stockin_list">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Invoice Total Quantity</th>
                                <th>Supplier / Vendor</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @if(isset($dataTable))
                            @foreach($dataTable as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->order_no}}</td>
                                <td>{{formatDate($row->order_date)}}</td>
                                <td>{{$row->total_quantity}}</td>
                                <td>{{$row->vendor_name}}</td>
                                <td>
                                    <span class="dropdown" @if($userguideInit==1) data-step="2" data-intro="In this button You see product detail or edit or delete option." @endif>
                                        <button id="btnSearchDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-green dropdown-toggle dropdown-menu-right"><i class="icon-cog3"></i></button>
                                        <span aria-labelledby="btnSearchDrop4" class="dropdown-menu mt-1 dropdown-menu-right">
                                            @if(in_array('Stock_In_Order_List_Single_Order_View', $dataMenuAssigned))
                                            <a href="{{url('product/stock/in/receipt/'.$row->id)}}" title="View Detail" class="dropdown-item"><i class="icon-clipboard2"></i> View Detail</a>
                                            @endif
                                            @if(in_array('Stock_In_Order_List_Single_Order_edit', $dataMenuAssigned))
                                            <a href="{{url('product/stock/in/edit/'.$row->id)}}" title="Edit" class="dropdown-item"><i class="icon-pencil22"></i> Edit</a>
                                            @endif
                                            @if(in_array('Stock_In_Order_List_Single_Order_Delete', $dataMenuAssigned))
                                            <a href="{{url('product/stock/in/delete/'.$row->id)}}" title="Delete" class="dropdown-item"><i class="icon-cross"></i> Delete</a>
                                            @endif
                                        </span>
                                    </span>
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
        var productStockInView="{{url('product/stock/in/receipt')}}";
        var productStockInEdit="{{url('product/stock/in/edit')}}";
        var productStockInDelete="{{url('product/stock/in/delete')}}";

        function actionTemplate(id){
            var actHTml='';
                actHTml+='<span class="dropdown" ';
                @if($userguideInit==1) 
                    actHTml+='data-step="2" data-intro="In this button You see product detail or edit or delete option." ';
                @endif
                actHTml+='>';
                actHTml+='            <button id="btnSearchDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-green dropdown-toggle dropdown-menu-right"><i class="icon-cog3"></i></button>';
                actHTml+='            <span aria-labelledby="btnSearchDrop4" class="dropdown-menu mt-1 dropdown-menu-right">';
                                @if(in_array('Stock_In_Order_List_Single_Order_View', $dataMenuAssigned))
                actHTml+='       <a href="'+productStockInView+'/'+id+'" title="View Detail" class="dropdown-item"><i class="icon-clipboard2"></i> View Detail</a>';
                                @endif
                                @if(in_array('Stock_In_Order_List_Single_Order_edit', $dataMenuAssigned))
                actHTml+='      <a href="'+productStockInEdit+'/'+id+'" title="Edit" class="dropdown-item"><i class="icon-pencil22"></i> Edit</a>';
                                @endif
                                @if(in_array('Stock_In_Order_List_Single_Order_Delete', $dataMenuAssigned))
                actHTml+='      <a href="'+productStockInDelete+'/'+id+'" title="Delete" class="dropdown-item"><i class="icon-cross"></i> Delete</a>';
                                @endif
                actHTml+='  </span>';
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

        $('#product_stockin_list').dataTable({
            "bProcessing": true,
            "serverSide": true,
            "ajax":{
                url :"{{url('product/stock/in/data/json')}}",
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
                        strHTML+='      <td>'+replaceNull(row.order_no)+'</td>';
                        strHTML+='      <td>'+formatDate(replaceNull(row.order_date))+'</td>';
                        strHTML+='      <td>'+number_format(replaceNull(row.total_quantity))+'</td>';
                        strHTML+='      <td>'+replaceNull(row.vendor_name)+'</td>';
                        strHTML+='      <td>'+actionTemplate(row.id)+'</td>';
                        strHTML+='</tr>';
                    });

                    $("tbody").html(strHTML);

                    $('#product_stockin_list').DataTable();
                },
                initComplete: function(settings, json) {
                    alert( 'DataTables has finished its initialisation.' );
                  },
                error: function(){
                  $("#product_stockin_list_processing").css("display","none");
                }
            }
        });
    });


    </script>

@endsection