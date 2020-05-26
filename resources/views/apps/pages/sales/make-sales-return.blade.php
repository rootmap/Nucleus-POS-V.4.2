@extends('apps.layout.master')
@section('title','Sales List')
@section('content')
<section id="form-action-layouts">

  
    <!-- Both borders end-->
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-cart4"></i> Available Sales Invoice</h4>
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
                        <table class="table table-striped table-bordered" id="warranty_invoice">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Invoice ID</th>
                                <th>Invoice Date</th>
                                <th>Sold To</th>
                                <th>Invoice Total Amount</th>
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
                                <td>{{$row->customer_name}}</td>
                                <td>{{$row->total_amount}}</td>
                                <td>
                                    <a href="{{url('sales/return/make/'.$row->id)}}" class="btn btn-green" style="color: #fff;">
                                        <i class="icon-share"></i> Create Sales Return 
                                    </a>
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


@include('apps.include.datatablecssjs')
@section('RoleWiseMenujs')
   <script>
    
    $(document).ready(function(e){
        var customerEditLink="{{url('sales/return/make')}}";

        function actionTemplate(id){
            var actHTml='';
                actHTml+='<a href="'+customerEditLink+'/'+id+'"  class="btn btn-green" style="color: #fff;"> <i class="icon-share"></i> Create Sales Return </a>';
                return actHTml;
        }

        function replaceNull(valH){
            var returnHt='';
            if(valH !== null && valH !== '') {
                    returnHt=valH;
            }
            return returnHt;
        }

        $('#warranty_invoice').dataTable({
            "bProcessing": true,
            "serverSide": true,
            "ajax":{
                url :"{{url('sales/return/create/json')}}",
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
                        strHTML+='      <td>'+row.invoice_id+'</td>';
                        strHTML+='      <td>'+formatDate(replaceNull(row.created_at))+'</td>';
                        strHTML+='      <td>'+replaceNull(row.customer_name)+'</td>';
                        strHTML+='      <td>'+replaceNull(row.total_amount)+'</td>';
                        strHTML+='      <td>'+actionTemplate(row.id)+'</td>';
                        strHTML+='</tr>';
                    });

                    $("tbody").html(strHTML);

                    $('#warranty_invoice').DataTable();
                },
                initComplete: function(settings, json) {
                    alert( 'DataTables has finished its initialisation.' );
                  },
                error: function(){
                  $("#warranty_invoice_processing").css("display","none");
                }
            }
        });
    });


    </script>

@endsection