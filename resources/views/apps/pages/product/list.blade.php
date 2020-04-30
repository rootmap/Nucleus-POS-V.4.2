@extends('apps.layout.master')
@section('title','Product')
@section('content')
<section id="form-action-layouts">
<?php 
    $dataMenuAssigned=array();
    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
    $userguideInit=StaticDataController::userguideInit();
    //dd($dataMenuAssigned);
?>
<div class="row">
    <div class="col-md-12" @if($userguideInit==1) data-step="1" data-intro="You can see payment history by date wise or category and click generate button." @endif>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-card-center"><i class="icon-filter_list"></i> Product Filter</h4>
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
                    <form method="post" action="{{url('product/list')}}">
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
                                        <h4>Category</h4>
                                        <div class="input-group">
                                            <select name="category_id" class="select2 form-control">
                                                <option value="">Select a Category</option>
                                                @if(isset($cattab))
                                                    @foreach($cattab as $cus)
                                                    <option 
                                                     @if(!empty($category_id) && $category_id==$cus->id)
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
                                            <i class="icon-check2"></i> Generate Report
                                        </button>
                                        
                                        <a href="{{url('product/list')}}" style="margin-left: 5px;" class="btn btn-green btn-darken-4">
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
    <div class="col-xs-12" @if($userguideInit==1) data-step="2" data-intro="You are seeing your all product list." @endif>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-database"></i> Product List</h4>
                <a class="heading-elements-toggle">
                    <i class="icon-ellipsis font-medium-3"></i>
                </a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>

                <div class="card-body collapse in">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="product_list">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Barcode</th>
                                <th width="200">Name</th>
                                <th style="width: 50px;">Quantity in Stock</th>
                                <th>Price</th>
                                <th>Cost</th>
                                <th>Total price</th>
                                <th>Total cost</th>
                                <th style="width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($dataTable))
                            @foreach($dataTable as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->category_name}}</td>
                                <td>{{$row->barcode}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->quantity}}</td>
                                <td>{{$row->price}}</td>
                                <td>{{$row->cost}}</td>
                                <td>{{($row->price*$row->quantity)}}</td>
                                <td>{{($row->cost*$row->quantity)}}</td>
                                <td>
                                        @if(in_array('Product_List_Edit', $dataMenuAssigned)) 
                                            <button type="button" data-id="{{$row->barcode}}" class="btn btn-secondary btn-sm barcodeCreate" @if($userguideInit==1) data-step="5" data-intro="If you print barcode then click this button." @endif id="barcodeCreateDD"><i class="icon-barcode"></i></button>
                                        @endif
                                        @if(in_array('Product_List_Edit', $dataMenuAssigned)) 
                                            <a href="{{url('product/edit/'.$row->id)}}" title="Edit" class="btn btn-sm btn-outline-green" @if($userguideInit==1) data-step="3" data-intro="If you want you can modify your information when you click this button." @endif><i class="icon-pencil22"></i></a>
                                        @endif
                                        @if(in_array('Product_List_Delete', $dataMenuAssigned)) 
                                            <a  href="{{url('product/delete/'.$row->id)}}" title="Delete" class="btn btn-sm btn-outline-green btn-accent-2" @if($userguideInit==1) data-step="4" data-intro="If you want delect then click this button." @endif><i class="icon-cross"></i></a>
                                        @endif

                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6">No Record Found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Both borders end -->

</section>
@include('apps.include.modal.barcode-modal')
@endsection

@include('apps.include.datatablecssjs',['barcodejs'=>1,'selectTwo'=>1,'dateDrop'=>1])
@section('RoleWiseMenujs')
   <script>
    
    $(document).ready(function(e){
        var productEdit="{{url('product/edit')}}";
        var productDelete="{{url('product/delete')}}";
        function actionTemplate(id,barcode){
            var actHTml='';
                @if(in_array('Product_List_Edit', $dataMenuAssigned)) 
                    actHTml+='<button type="button" onclick="generateBarcode('+barcode+')" data-id="'+barcode+'" class="btn btn-secondary btn-sm barcodeCreate" ';
                    @if($userguideInit==1) 
                        actHTml+=' data-step="5" data-intro="If you print barcode then click this button." ';
                    @endif 
                    actHTml+=' id="barcodeCreateDD"><i class="icon-barcode"></i></button> ';
                @endif
                @if(in_array('Product_List_Edit', $dataMenuAssigned)) 
                    actHTml+='<a href="'+productEdit+'/'+id+'" title="Edit" class="btn btn-sm btn-outline-green" ';
                    @if($userguideInit==1) 
                        actHTml+=' data-step="3" data-intro="If you want you can modify your information when you click this button." ';
                    @endif
                    actHTml+='><i class="icon-pencil22"></i></a>';
                @endif
                @if(in_array('Product_List_Delete', $dataMenuAssigned)) 
                    actHTml+='<a  href="'+productDelete+'/'+id+'" title="Delete" class="btn btn-sm btn-outline-green btn-accent-2" ';
                    @if($userguideInit==1) 
                        actHTml+=' data-step="4" data-intro="If you want delect then click this button." ';
                    @endif
                    actHTml+='><i class="icon-cross"></i></a>';
                @endif

                return actHTml;
        }

        var dataObj="";
        function replaceNull(valH){
            var returnHt='';

            if(valH !== null && valH !== '') {
                    returnHt=valH;
            }

            return returnHt;
        }

        @if(!empty($category_id) || !empty($start_date) || !empty($end_date))
            @if(isset($dataTable))
                @if(count($dataTable)>0)
                    $('#product_list').DataTable({"aLengthMenu": [[25, 50, 100, 500,999999999999999999], [25, 50, 100, 500, "All"]]});
                @endif
            @endif
        @else

        $('#product_list').dataTable({
            "bProcessing": true,
            "serverSide": true,
            "aLengthMenu": [[25, 50, 100, 500,999999999999999999], [25, 50, 100, 500, "All"]],
            "ajax":{
                url :"{{url('product/fulldata/datatableProductjson')}}",
                headers: {
                    'X-CSRF-TOKEN':'{{csrf_token()}}',
                },
                type: "POST",
                complete:function(data){
                    console.log(data.responseJSON);
                    var totalData=data.responseJSON;
                    console.log(totalData.data);
                    var strHTML='';
                    //var totalPrice=0;
                    $.each(totalData.data,function(key,row){
                        console.log(row);

                        var totalPrice=row.price*row.quantity;
                        var totalCost=row.cost*row.quantity;

                        strHTML+='<tr>';
                        strHTML+='      <td>'+row.id+'</td>';
                        strHTML+='      <td>'+row.category_name+'</td>';
                        strHTML+='      <td>'+replaceNull(row.barcode)+'</td>';
                        strHTML+='      <td>'+replaceNull(row.name)+'</td>';
                        strHTML+='      <td>'+number_format(row.quantity)+'</td>';
                        strHTML+='      <td>'+number_format(row.price)+'</td>';
                        strHTML+='      <td>'+number_format(row.cost)+'</td>';
                        strHTML+='      <td>'+number_format(totalPrice)+'</td>';
                        strHTML+='      <td>'+number_format(totalCost)+'</td>';
                        strHTML+='      <td>'+actionTemplate(row.id,row.barcode)+'</td>';
                        strHTML+='</tr>';

                        //totalPrice+=replaceNull(row.price)-0;

                    });

                    //$("#totalDataAmount").html(totalPrice);

                    $("tbody").html(strHTML);
                    $('#product_list').DataTable();
                },
                initComplete: function(settings, json) {
                    alert( 'DataTables has finished its initialisation.' );
                  },
                error: function(){
                  $("#product_list_processing").css("display","none");
                }
            }
        });

        @endif
    });


    </script>

@endsection