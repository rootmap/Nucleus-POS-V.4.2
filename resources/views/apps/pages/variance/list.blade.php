@extends('apps.layout.master')
@section('title','Variance List')
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
    <div class="col-xs-12" @if($userguideInit==1) data-step="1" data-intro="You are seeing all the variance list in this table. You see view report or edit or delete." @endif>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-tab"></i> Variance List</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a href="{{url('variance/excel/report')}}"><i class="icon-file-excel" style="font-size: 20px;"></i></a></li>
                        <li><a href="{{url('variance/pdf/report')}}"><i class="icon-file-pdf"  style="font-size: 20px;"></i></a></li>
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                    </ul>
                </div>
            </div>

                <div class="card-body collapse in">
                    <div class="table-responsive" style="overflow:visible;">
                        <table class="table table-striped table-bordered" id="variance_report_list">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Variance ID</th>
                                <th>Variance Date</th>
                                <th>Variance Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @if(isset($dataTable))
                            @foreach($dataTable as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->variance_id}}</td>
                                <td>{{formatDate($row->created_at)}}</td>
                                <td>{{$row->total_variance_quantity}}</td>
                                <td>
                                    <span class="dropdown" @if($userguideInit==1) data-step="2" data-intro="In this button You see view report or edit or delete option." @endif>
                                        <button id="btnSearchDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-green dropdown-toggle dropdown-menu-right"><i class="icon-cog3"></i></button>
                                        <span aria-labelledby="btnSearchDrop4" class="dropdown-menu mt-1 dropdown-menu-right">
                                            
                                            @if(in_array('Variance_List_View_Detail', $dataMenuAssigned)) 
                                            <a href="{{url('variance/products/report/'.$row->id)}}" title="View Report" class="dropdown-item"><i class="icon-clipboard2"></i> View Report</a> 
                                            @endif 
                                            
                                            @if(in_array('Variance_List_View_Edit', $dataMenuAssigned))
                                            <a href="{{url('variance/edit/'.$row->id)}}" title="Edit" class="dropdown-item"><i class="icon-pencil22"></i> Edit</a>
                                            @endif

                                            @if(in_array('Variance_List_View_Delete', $dataMenuAssigned))
                                            <a href="{{url('variance/delete/'.$row->id)}}" title="Delete" class="dropdown-item"><i class="icon-cross"></i> Delete</a>
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

        var varianceReportView="{{url('variance/products/report')}}";
        var varianceReportEdit="{{url('variance/edit')}}";
        var varianceReportDelete="{{url('variance/delete')}}";

        function actionTemplate(id){
            var actHTml='';
               
                actHTml+='<span class="dropdown" ';
                   @if($userguideInit==1) 
                actHTml+='   data-step="2" data-intro="In this button You see view report or edit or delete option." ';
                   @endif
                actHTml+='   >';
                actHTml+='        <button id="btnSearchDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-green dropdown-toggle dropdown-menu-right"><i class="icon-cog3"></i></button>';
                actHTml+='        <span aria-labelledby="btnSearchDrop4" class="dropdown-menu mt-1 dropdown-menu-right">';
                            
                            @if(in_array('Variance_List_View_Detail', $dataMenuAssigned)) 
                actHTml+='  <a href="'+varianceReportView+'/'+id+'" title="View Report" class="dropdown-item"><i class="icon-clipboard2"></i> View Report</a> ';
                            @endif 
                            
                            @if(in_array('Variance_List_View_Edit', $dataMenuAssigned))
                actHTml+='  <a href="'+varianceReportEdit+'/'+id+'" title="Edit" class="dropdown-item"><i class="icon-pencil22"></i> Edit</a>';
                            @endif

                            @if(in_array('Variance_List_View_Delete', $dataMenuAssigned))
                actHTml+='  <a href="'+varianceReportDelete+'/'+id+'" title="Delete" class="dropdown-item"><i class="icon-cross"></i> Delete</a>';
                            @endif

                actHTml+='        </span>';
                actHTml+='    </span>';

                return actHTml;
        }

        
        function replaceNull(valH){
            var returnHt='';
            if(valH !== null && valH !== '') {
                    returnHt=valH;
            }

            return returnHt;
        }

        $('#variance_report_list').dataTable({
            "bProcessing": true,
            "serverSide": true,
            "ajax":{
                url :"{{url('variance/data/report/json')}}",
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
                        strHTML+='      <td>'+replaceNull(row.variance_id)+'</td>';
                        strHTML+='      <td>'+formatDate(replaceNull(row.created_at))+'</td>';
                        strHTML+='      <td>'+number_format(replaceNull(row.total_variance_quantity))+'</td>';
                        strHTML+='      <td>'+actionTemplate(row.id)+'</td>';
                        strHTML+='</tr>';
                    });

                    $("tbody").html(strHTML);

                    $('#variance_report_list').DataTable();
                },
                initComplete: function(settings, json) {
                    alert( 'DataTables has finished its initialisation.' );
                  },
                error: function(){
                  $("#variance_report_list_processing").css("display","none");
                }
            }
        });
    });


    </script>

@endsection