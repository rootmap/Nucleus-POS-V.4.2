@extends('apps.layout.master')
@section('title','Unsaved Invoices')
@section('content')
<section id="form-action-layouts">
<?php 
    $dataMenuAssigned=array();
    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
?>  
    <!-- Both borders end-->
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-database"></i> Unsaved Invoices List</h4>
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
                        <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Invoice Id</th>
                                <th>Invoice Date</th>
                                <th>Customer Name</th>
                                <th>Invoice Total</th>
                                <th>Invoice Status</th>
                                <th style="width: 250px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($sessionInvoice))
                            @foreach($sessionInvoice as $row)
                            <tr>
                                <td>{{$row['id']}}</td>
                                <td>{{$row['invoice_id']}}</td>
                                <td>{{$row['created_at']}}</td>
                                <td>{{$row['customerName']}}</td>
                                <td>
                                    @if($row['totalPrice']>0)
                                        {{number_format($row['totalPrice'],2)}}
                                    @else
                                        0.00
                                    @endif
                                </td>
                                <td>{{$row['invoice_status']}}</td>
                                <td>
                                        <a  href="{{url('sales/unsaved/genarate/invoice/'.$row['id'])}}" title="Genarate Invoice" class="btn btn-sm btn-outline-green btn-accent-2"><i class="icon-cart"></i> Genarate Invoice</a>   
                                        <a  href="{{url('sales/unsaved/delete/invoice/'.$row['id'])}}" title="Delete Invoice" class="btn btn-sm btn-outline-red btn-accent-2"><i class="icon-delete"></i> Delete </a>
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
@endsection

@include('apps.include.datatable')