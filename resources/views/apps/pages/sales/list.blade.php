@extends('apps.layout.master')
@section('title','Sales Report')
@section('content')
<section id="form-action-layouts">
    <?php
    $userguideInit=StaticDataController::userguideInit();
    ?>
    <div class="row">
        <div class="col-md-12" @if($userguideInit==1) data-step="1" data-intro="You can see payment history by date wise or invoice or Customer or Status and generate excel or PDF." @endif>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-card-center"><i class="icon-filter_list"></i> Sales Report Filter</h4>
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
                        <form id="salesSu" method="post" action="{{url('sales/report')}}">
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
                                            type="text" id="eventRegInput1" class="form-control border-primary" placeholder="Invoice ID" name="invoice_id">
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
                                        <h4>Status</h4>
                                        <div class="input-group">
                                            <select name="invoice_status" class="form-control">
                                                <option value="">Select a Status</option>
                                                <option
                                                    @if(!empty($invoice_status) && $invoice_status=='Due')
                                                    selected="selected"
                                                    @endif
                                                value="Due">Due</option>
                                                <option
                                                    @if(!empty($invoice_status) && $invoice_status=='Partial')
                                                    selected="selected"
                                                    @endif
                                                value="Partial">Partial</option>
                                                <option
                                                    @if(!empty($invoice_status) && $invoice_status=='Paid')
                                                    selected="selected"
                                                    @endif
                                                value="Paid">Paid</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        
                                        <div class="input-group" style="margin-top:32px;">
                                            <button type="submit" id="salesSUSub" class="btn btn-green btn-darken-1 mr-1" @if($userguideInit==1) data-step="2" data-intro="If you click this button then it will generate your report." @endif>
                                            <i class="icon-check2"></i> Generate Report
                                            </button>
                                            <a href="javascript:void(0);" data-url="{{url('sales/excel/report')}}" class="btn btn-green btn-darken-2 mr-1 change-action-export-sales" @if($userguideInit==1) data-step="3" data-intro="If you click this button then it will generate excel file." @endif>
                                                <i class="icon-file-excel-o"></i> Generate Excel
                                            </a>
                                            <a href="javascript:void(0);" data-url="{{url('sales/pdf/report')}}" class="btn btn-green btn-darken-3 mr-1 change-action-export-sales" @if($userguideInit==1) data-step="4" data-intro="If you click this button then it will generate pdf file." @endif>
                                                <i class="icon-file-pdf-o"></i> Generate PDF
                                            </a>
                                            <a href="{{url('sales/report')}}" style="margin-left: 5px;" class="btn btn-green btn-darken-4" @if($userguideInit==1) data-step="5" data-intro="if you want clear all information then click the reset button." @endif>
                                                <i class="icon-refresh"></i> Reset
                                            </a>

                                            <a href="{{url('sales/partial/payment')}}" style="float: right;" class="btn btn-green btn-lighten-1" @if($userguideInit==1) data-step="6" data-intro="By clicking this button you can Add Partial Payment." @endif>
                                                <i class="icon-money"></i> Add Partial Payment
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
                    <h4 class="card-title"><i class="icon-cart4"></i> Sales Report</h4>
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
                                    <th width="250">Product</th>
                                    <th width="250">Sold To</th>
                                    <th width="200">Tender</th>
                                    <th>Status</th>
                                    <th>Total Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($dataTable))
                                @foreach($dataTable as $row)
                                <tr>
                                    <td>{{$row->id}}</td>
                                    <td>{{$row->invoice_id}}</td>
                                    <td>{{formatDate($row->created_at)}}</td>
                                    <td>{{$row->product}}</td>
                                    <td>{{$row->customer_name}}</td>
                                    <td>
                                        @if($row->invoice_status=="Due")
                                        Not Mention
                                        @else
                                        {{$row->tender_name}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($row->invoice_status=="Due")
                                        <span class="btn btn-green btn-darken-4">{{$row->invoice_status}}</span>
                                        @elseif($row->invoice_status=="Partial")
                                        <a href="{{url('sales/partial/add/payment/'.$row->invoice_id)}}" class="btn btn-green  btn-lighten-1">{{$row->invoice_status}}</a>
                                        @elseif($row->invoice_status=="Paid")
                                        <span class="btn btn-green btn-darken-1">{{$row->invoice_status}}</span>
                                        @else
                                        <span class="btn btn-green btn-darken-3">{{$row->invoice_status}}</span>
                                        @endif
                                    </td>
                                    <td>{{$row->total_amount}}</td>
                                    <td>{{$row->paid_amount}}</td>
                                    <td>
                                        <span class="dropdown">
                                            <button id="btnSearchDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-green dropdown-toggle dropdown-menu-right"><i class="icon-cog3"></i></button>
                                            <span aria-labelledby="btnSearchDrop4" class="dropdown-menu mt-1 dropdown-menu-right">
                                                <a href="{{url('sales/invoice/'.$row->id)}}" title="View Invoice" class="dropdown-item"><i class="icon-file-text"></i> View Invoice</a>
                                                <a href="javascript:putInvoiceModal('{{$row->invoice_id}}');" title="Send Invoice" class="dropdown-item"><i class="icon-email2"></i> Send Invoice</a>
                                                <a href="{{url('sales/edit/'.$row->id)}}" title="Edit" class="dropdown-item"><i class="icon-pencil22"></i> Edit</a>
                                                <a href="{{url('sales/delete/'.$row->id)}}" title="Delete" class="dropdown-item"><i class="icon-cross"></i> Delete</a>
                                            </span>
                                        </span>
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
    @include('apps.include.modal.sendSlipModal')
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

        var partialLink="{{url('sales/partial/add/payment')}}";

        function invoiceStatus(invoice_status,invoice_id){
            var strHTML='';

            if(invoice_status=="Due"){
                strHTML+='<span class="btn btn-green btn-darken-4">'+invoice_status+'</span>';
            }
            else if(invoice_status=="Partial"){
                strHTML+='<a href="'+partialLink+'/'+invoice_id+'" class="btn btn-green  btn-lighten-1">'+invoice_status+'</a>';
            }else if(invoice_status=="Paid"){
                strHTML+='<span class="btn btn-green btn-darken-1">'+invoice_status+'</span>';
            }else{
                strHTML+='<span class="btn btn-green btn-darken-3">'+invoice_status+'</span>';
            }

            return strHTML;
        }

        var InvoiceLink="{{url('sales/invoice')}}";
        var InvoiceEditLink="{{url('sales/edit')}}";
        var InvoiceDeleteLink="{{url('sales/delete')}}";

        function actionTemplate(id,invoice_id){

            var invID="'"+invoice_id+"'";

            var strHTML='';
                strHTML+='<span class="dropdown">';
                strHTML+='  <button id="btnSearchDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-green dropdown-toggle dropdown-menu-right"><i class="icon-cog3"></i></button>';
                strHTML+='  <span aria-labelledby="btnSearchDrop4" class="dropdown-menu mt-1 dropdown-menu-right">';
                strHTML+='      <a href="'+InvoiceLink+'/'+id+'" title="View Invoice" class="dropdown-item"><i class="icon-file-text"></i> View Invoice</a>';
                strHTML+='      <a href="javascript:putInvoiceModal('+invID+');" title="Send Invoice" class="dropdown-item"><i class="icon-email2"></i> Send Invoice</a>';
                strHTML+='      <a href="'+InvoiceEditLink+'/'+id+'" title="Edit" class="dropdown-item"><i class="icon-pencil22"></i> Edit</a>';
                strHTML+='      <a href="'+InvoiceDeleteLink+'/'+id+'" title="Delete" class="dropdown-item"><i class="icon-cross"></i> Delete</a>';
                strHTML+='  </span>';
                strHTML+='</span>';

                return strHTML;
        }

        @if(!empty($start_date) || !empty($end_date) || !empty($invoice_id) || !empty($invoice_status) || !empty($customer_id))
            @if(isset($dataTable))
                @if(count($dataTable)>0)
                    $('#report_table').DataTable();
                @endif
            @endif
        @else

        $('#report_table').dataTable({
            "bProcessing": true,
            "serverSide": true,
            "ajax":{
                url :"{{url('sales/data/report/json')}}",
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
                        var tender="";
                        if(row.invoice_status=="Due"){
                            tender="Not Mention";
                        }else{
                            tender=replaceNull(row.tender_name);
                        }
                                             
                        strHTML+='<tr>';
                        strHTML+='      <td>'+row.id+'</td>';
                        strHTML+='      <td>'+replaceNull(row.invoice_id)+'</td>';
                        strHTML+='      <td>'+formatDate(replaceNull(row.created_at))+'</td>'; 
                        strHTML+='      <td>'+replaceNull(row.product)+'</td>';
                        strHTML+='      <td>'+replaceNull(row.customer_name)+'</td>';
                        strHTML+='      <td>'+replaceNull(tender)+'</td>';
                        strHTML+='      <td>'+invoiceStatus(row.invoice_status,row.invoice_id)+'</td>';
                        strHTML+='      <td>'+number_format(replaceNull(row.total_amount))+'</td>';
                        strHTML+='      <td>'+number_format(replaceNull(row.paid_amount))+'</td>';
                        strHTML+='      <td>'+actionTemplate(row.id,row.invoice_id)+'</td>';
                                  
                        strHTML+='</tr>';

                        totalPrice+=number_format(replaceNull(row.amount))-0;

                    });

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