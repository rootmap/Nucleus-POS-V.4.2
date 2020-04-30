@extends('apps.layout.master')
@section('title','Tender Report')
@section('content')
<section id="form-action-layouts">
<div class="row">
    <div class="col-md-12">
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
                                        <button type="submit" id="salesSUSub" class="btn btn-green btn-darken-1 mr-1">
                                            <i class="icon-check2"></i> Generate Report
                                        </button>
                                        <a href="javascript:void(0);" data-url="{{url('report/excel/tender')}}" class="btn btn-green btn-darken-2 mr-1 change-action-export-sales">
                                            <i class="icon-file-excel-o"></i> Generate Excel
                                        </a>
                                        <a href="javascript:void(0);" data-url="{{url('report/pdf/tender')}}" class="btn btn-green btn-darken-3 mr-1 change-action-export-sales">
                                            <i class="icon-file-pdf-o"></i> Generate PDF
                                        </a>
                                        <a href="{{url('report/tender')}}" style="margin-left: 5px;" class="btn btn-green btn-darken-4">
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
                        <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Invoice ID</th>
                                <th>Invoice Date</th>
                                <th>Sold To</th>
                                <th>Tender</th>
                                {{-- <th>Status</th> --}}
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
                                <td>{{date('Y-m-d',strtotime($row->created_at))}}</td>
                                <td>{{$row->customer_name}}</td>
                                <td>{{$row->tender_name}}</td>
                                {{-- <td>{{$row->invoice_status}}</td> --}}
                                {{-- <td>
                                    @if($row->invoice_status=="Paid")
                                        <span class="btn btn-green btn-lighten-1">{{$row->invoice_status}}</span>
                                    @endif
                                </td> --}}
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
                <h1 class="display-4 white"><i class="icon-money font-large-2"></i> ${{$paid_amount}}</h1>
                <span class="white">Total Paid Amount</span>
            </div>
        </div>
    </div>
</div>
<!-- Both borders end -->
@include('apps.include.modal.sendSlipModal')
</section>

@endsection

@include('apps.include.datatable',['JDataTable'=>1,'selectTwo'=>1,'dateDrop'=>1,'invoiceSlip'=>1])