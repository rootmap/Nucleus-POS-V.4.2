@extends('apps.layout.master')
@section('title','Tender Report')
@section('content')
<section id="form-action-layouts">
    <?php
    $userguideInit=StaticDataController::userguideInit();
    ?>
<div class="row">
    <div class="col-md-12" @if($userguideInit==1) data-step="1" data-intro="You can see Tender by date wise or invoice or Customer or Tander and generate excel or PDF." @endif>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-card-center"><i class="icon-filter_list"></i> Tender Report Filter</h4>
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
                    <form id="salesSu" method="post" action="{{url('report/tender')}}">
                        {{csrf_field()}}
                        <fieldset class="form-group">
                            <div class="row">
                                <div class="col-md-2">
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
                                <div class="col-md-2">
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
                                <div class="col-md-2">
                                    <h4>Tander</h4>
                                    <div class="input-group">
                                        <select name="tender_id" class="select2 form-control">
                                            <option value="">Select a Tender</option>
                                            @if(isset($tab_tender))
                                                @foreach($tab_tender as $ten)
                                                <option 
                                                 @if(!empty($tender_id) && $tender_id==$ten->id)
                                                    selected="selected"  
                                                 @endif 
                                                value="{{$ten->id}}">{{$ten->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    
                                    <div class="input-group" style="margin-top:32px;">
                                        <button type="submit" id="salesSUSub" class="btn btn-green btn-darken-1 mr-1" @if($userguideInit==1) data-step="2" data-intro="If you click this button then it will generate your report." @endif>
                                            <i class="icon-check2"></i> Generate Report
                                        </button>
                                        <a href="javascript:void(0);" data-url="{{url('report/excel/tender')}}" class="btn btn-green btn-darken-2 mr-1 change-action-export-sales" @if($userguideInit==1) data-step="3" data-intro="If you click this button then it will generate excel file." @endif>
                                            <i class="icon-file-excel-o"></i> Generate Excel
                                        </a>
                                        <a href="javascript:void(0);" data-url="{{url('report/pdf/tender')}}" class="btn btn-green btn-darken-3 mr-1 change-action-export-sales" @if($userguideInit==1) data-step="4" data-intro="If you click this button then it will generate pdf file." @endif>
                                            <i class="icon-file-pdf-o"></i> Generate PDF
                                        </a>
                                        <a href="{{url('report/tender')}}" style="margin-left: 5px;" class="btn btn-green btn-darken-4" @if($userguideInit==1) data-step="5" data-intro="if you want clear all information then click the reset button." @endif>
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
                <h4 class="card-title"><i class="icon-cart4"></i> Tender Report</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        {{-- <li><a href="{{url('sales/excel/report')}}"><i class="icon-file-excel" style="font-size: 20px;"></i></a></li>
                        <li><a href="{{url('sales/pdf/report')}}"><i class="icon-file-pdf"  style="font-size: 20px;"></i></a></li> --}}
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
                                <th>Invoice ID</th>
                                <th>Invoice Date</th>
                                <th width="250">Sold To</th>
                                <th width="200">Tender</th>
                                <th>Paid Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $paid_amount=0;
                            ?>
                            @if(isset($dataTable))
                            @foreach($dataTable as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->invoice_id}}</td>
                                <td>{{formatDate($row->created_at)}}</td>
                                <td>{{$row->customer_name}}</td>
                                <td>{{$row->tender_name}}</td>
                                <td>{{number_format($row->paid_amount,2)}}</td>
                            </tr>
                            <?php 
                                $paid_amount+=$row->paid_amount;
                                ?>
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
        <div class="col-lg-4 col-sm-4 border-right-green bg-green border-right-lighten-4">
            <div class="card-block text-xs-center">
                <h1 class="display-4 white"><i class="icon-money font-large-2"></i> $<span id="totalDataAmount">{{$paid_amount}}</span></h1>
                <span class="white">Total Paid Amount</span>
            </div>
        </div>
    </div>
</div>
<!-- Both borders end -->
</section>

@endsection


@include('apps.include.datatablecssjs',['selectTwo'=>1,'dateDrop'=>1,'invoiceSlip'=>1])
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

        

        @if(!empty($start_date) || !empty($end_date) || !empty($invoice_id) || !empty($tender_id) || !empty($customer_id))
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
                url :"{{url('report/data/tender/json')}}",
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
                                                     
                        strHTML+='<tr>';
                        strHTML+='      <td>'+row.id+'</td>';
                        strHTML+='      <td>'+replaceNull(row.invoice_id)+'</td>';
                        strHTML+='      <td>'+formatDate(replaceNull(row.created_at))+'</td>'; 
                        strHTML+='      <td>'+replaceNull(row.customer_name)+'</td>';
                        strHTML+='      <td>'+replaceNull(row.tender_name)+'</td>';
                        strHTML+='      <td>'+number_format(replaceNull(row.paid_amount))+'</td>';
                        strHTML+='</tr>';

                        totalPrice+=number_format(replaceNull(row.paid_amount))-0;

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