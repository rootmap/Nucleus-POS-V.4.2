@extends('apps.layout.master')
@section('title','Stockin Order Report')
@section('content')
<section id="form-action-layouts">
    <?php
    $userguideInit=StaticDataController::userguideInit();
    ?>
    <div class="row">
        <div class="col-md-12" @if($userguideInit==1) data-step="1" data-intro="You can see payment history by date wise or Order ID or Vendor and generate excel or PDF." @endif>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-card-center"><i class="icon-filter_list"></i> Stock In Order Report Filter</h4>
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
                        <form method="post" action="{{url('product/stock/in/report')}}">
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
                                    <div class="col-md-2">
                                        <h4>Order ID</h4>
                                        <div class="input-group">
                                        <input 
                                         @if(!empty($order_no))
                                                value="{{$order_no}}"  
                                         @endif 
                                         type="text" id="eventRegInput1" class="form-control border-green" placeholder="Order ID" name="order_no">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <h4>Vendor</h4>
                                        <div class="input-group">
                                            <select name="vendor_id" class="select2 form-control">
                                                <option value="">Select a Vendor</option>
                                                @if(isset($vendor))
                                                    @foreach($vendor as $ven)
                                                    <option 
                                                     @if(!empty($vendor_id) && $vendor_id==$ven->id)
                                                        selected="selected"  
                                                     @endif 
                                                    value="{{$ven->id}}">{{$ven->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        
                                        <div class="input-group" style="margin-top:32px;">
                                            <button type="submit" class="btn btn-green btn-darken-1 mr-1" @if($userguideInit==1) data-step="2" data-intro="If you click this button then it will generate your report." @endif>
                                                <i class="icon-check2"></i> Generate Report
                                            </button>
                                            <a href="javascript:void(0);" data-url="{{url('product/stock/in/excel/report')}}" class="btn btn-green btn-darken-2 mr-1 change-action" @if($userguideInit==1) data-step="3" data-intro="If you click this button then it will generate excel file." @endif>
                                                <i class="icon-file-excel-o"></i> Generate Excel
                                            </a>
                                            <a href="javascript:void(0);" data-url="{{url('product/stock/in/pdf/report')}}" class="btn btn-green btn-darken-3 mr-1 change-action" @if($userguideInit==1) data-step="4" data-intro="If you click this button then it will generate pdf file." @endif>
                                                <i class="icon-file-pdf-o"></i> Generate PDF
                                            </a>
                                            <a href="{{url('product/stock/in/report')}}" style="margin-left: 5px;" class="btn btn-green btn-darken-4" @if($userguideInit==1) data-step="5" data-intro="if you want clear all information then click the reset button." @endif>
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
                <h4 class="card-title"><i class="icon-stack"></i> Stock In Order Report</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a href="{{url('product/stock/in/excel/report')}}"><i class="icon-file-excel" style="font-size: 20px;"></i></a></li>
                        <li><a href="{{url('product/stock/in/pdf/report')}}"><i class="icon-file-pdf"  style="font-size: 20px;"></i></a></li>
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>

                <div class="card-body collapse in">
                    <div class="table-responsive" style="min-height: 360px;">
                        <table class="table table-striped table-bordered" id="report_table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Order ID</th>
                                <th>Order Date</th>
                                <th>Invoice Total Quantity</th>
                                <th>Created At</th>
                                <th>Vendor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total_quantity=0;
                            ?>
                            @if(isset($dataTable))
                            @foreach($dataTable as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->order_no}}</td>
                                <td>{{formatDate($row->order_date)}}</td>
                                <td>{{$row->total_quantity}}</td>
                                <td>{{formatDateTime($row->created_at)}}</td>
                                <td>{{$row->vendor_name}}</td>
                            </tr>
                            <?php $total_quantity+=$row->total_quantity; ?>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4">No Record Found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12 border-right-pink bg-green border-right-lighten-3">
            <div class="card-block text-xs-center">
                <h1 class="display-3 white"><i class="icon-stack font-large-2"></i> <span id="totalWER_quantity">{{$total_quantity}}</span></h1>
                <span class="white">Total Stockin Quantity</span>
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


        @if(!empty($start_date) || !empty($end_date) || !empty($order_no) || !empty($vendor_id))
            @if(isset($dataTable))
                @if(count($dataTable)>0)
                    $('#report_table').DataTable({"aLengthMenu": [[25, 50, 100, 500,999999999999999999], [25, 50, 100, 500, "All"]]});
                @endif
            @endif
        @else

        $('#report_table').dataTable({
            "bProcessing": true,
            "serverSide": true,
            "aLengthMenu": [[25, 50, 100, 500,999999999999999999], [25, 50, 100, 500, "All"]],
            "ajax":{
                url :"{{url('product/stock/in/data/report/json')}}",
                headers: {
                    'X-CSRF-TOKEN':'{{csrf_token()}}',
                },
                type: "POST",
                complete:function(data){
                    console.log(data.responseJSON);
                    var totalData=data.responseJSON;
                    console.log(totalData.data);
                    var strHTML='';
                    var totalQRT=0;
                    var totalClosing=0;
                    $.each(totalData.data,function(key,row){
                        console.log(row);
                        strHTML+='<tr>';
                        strHTML+='      <td>'+row.id+'</td>';
                        strHTML+='      <td>'+replaceNull(row.order_no)+'</td>';
                        strHTML+='      <td>'+formatDate(replaceNull(row.order_date))+'</td>';
                        strHTML+='      <td>'+number_format(replaceNull(row.total_quantity))+'</td>';
                        strHTML+='      <td>'+formatDate(replaceNull(row.created_at))+'</td>';
                        strHTML+='      <td>'+replaceNull(row.vendor_name)+'</td>';                                        
                        strHTML+='</tr>';

                        totalQRT+=row.total_quantity-0;
                    });

                    $("#totalWER_quantity").html(number_format(totalQRT));

                    $("#report_table").find("tbody").html(strHTML);
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