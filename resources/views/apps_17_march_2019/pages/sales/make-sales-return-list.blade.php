@extends('apps.layout.master')
@section('title','Sales List')
@section('content')
<section id="form-action-layouts">

  <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-card-center"><i class="icon-filter_list"></i> Sales Return Report Filter</h4>
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
                        <form id="salesSu" method="post" action="{{url('sales/return/list')}}">
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
                                    
                                    <div class="col-md-12">
                                        
                                        <div class="input-group" style="margin-top:32px;">
                                            <button type="submit" id="salesSUSub" class="btn btn-green btn-darken-1 mr-1">
                                            <i class="icon-check2"></i> Generate Report
                                            </button>
                                            <a href="javascript:void(0);" data-url="{{url('sales/return/list/excel/report')}}" class="btn btn-green btn-darken-2 mr-1 change-action-export-sales">
                                                <i class="icon-file-excel-o"></i> Generate Excel
                                            </a>
                                            <a href="javascript:void(0);" data-url="{{url('sales/return/list/pdf/report')}}" class="btn btn-green btn-darken-3 mr-1 change-action-export-sales">
                                                <i class="icon-file-pdf-o"></i> Generate PDF
                                            </a>
                                            <a href="{{url('sales/return/list')}}" style="margin-left: 5px;" class="btn btn-green btn-darken-4">
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
                <h4 class="card-title"><i class="icon-cart4"></i> Sales Return Data</h4>
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
                        <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Invoice ID</th>
                                <th>Sales Return</th>
                                <th>Return To</th>
                                <th>Sales Total</th>
                                <th>Return Amount</th>
                                <th>Return Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($dataTable))
                            @foreach($dataTable as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->invoice_id}}</td>
                                <td>{{$row->created_at}}</td>
                                <td>{{$row->customer_name}}</td>
                                <td>{{$row->invoice_total}}</td>
                                <td>{{$row->sales_return_amount}}</td>
                                <td>{{$row->sales_return_note}}</td>
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

@endsection

@include('apps.include.datatable',['JDataTable'=>1,'selectTwo'=>1])