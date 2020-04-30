@extends('apps.layout.master')
@section('title','Vendor List')
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
    <div class="col-xs-12" @if($userguideInit==1) data-step="1" data-intro="You are seeing all the vendor list in this table. You can edit and delete." @endif>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><i class="icon-database"></i>Vendor List</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                        
                    </ul>
                </div>
            </div>
            <div class="card-body collapse in">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="vendor_list">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th style="width: 50px;">Email</th>
                                <th>Phone</th>
                                <th>Vendor Added</th>
                                <th style="width: 100px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @if(isset($dataTable))
                            @foreach($dataTable as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->phone}}</td>
                               <td>{{formatDateTime($row->created_at)}}</td>
                                <td>
                                        @if(in_array('Vendor_List_Edit', $dataMenuAssigned))
                                            <a href="{{url('vendor/edit/'.$row->id)}}" title="Edit" class="btn btn-sm btn-outline-green" @if($userguideInit==1) data-step="2" data-intro="If you want you can modify your information when you click this button." @endif><i class="icon-pencil22"></i></a> 
                                        @endif
                                        @if(in_array('Vendor_List_Delete', $dataMenuAssigned))
                                            <a  href="{{url('vendor/delete/'.$row->id)}}" title="Delete" class="btn btn-sm btn-outline-green btn-accent-2" @if($userguideInit==1) data-step="3" data-intro="If you want delect then click this button." @endif><i class="icon-cross"></i></a>
                                        @endif
                                </div>
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

        var vendorEdit="{{url('vendor/edit')}}";
        var vendorDelete="{{url('vendor/delete')}}";

        function actionTemplate(id){
            var actHTml='';
               
                @if(in_array('Vendor_List_Edit', $dataMenuAssigned))
                 actHTml+='    <a href="'+vendorEdit+'/'+id+'" title="Edit" class="btn btn-sm btn-outline-green" ';
                 @if($userguideInit==1) 
                    actHTml+='data-step="2" data-intro="If you want you can modify your information when you click this button." ';
                 @endif
                 actHTml+='><i class="icon-pencil22"></i></a> ';
                @endif
                @if(in_array('Vendor_List_Delete', $dataMenuAssigned))
                 actHTml+='    <a  href="'+vendorDelete+'/'+id+'" title="Delete" class="btn btn-sm btn-outline-green btn-accent-2" ';
                 @if($userguideInit==1) 
                    actHTml+='    data-step="3" data-intro="If you want delect then click this button." ';
                 @endif
                 actHTml+='><i class="icon-cross"></i></a>';
                @endif

                return actHTml;
        }

        
        function replaceNull(valH){
            var returnHt='';
            if(valH !== null && valH !== '') {
                    returnHt=valH;
            }

            return returnHt;
        }

        $('#vendor_list').dataTable({
            "bProcessing": true,
            "serverSide": true,
            "ajax":{
                url :"{{url('vendor/data/json')}}",
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
                        strHTML+='      <td>'+replaceNull(row.name)+'</td>';
                        strHTML+='      <td>'+replaceNull(row.email)+'</td>';
                        strHTML+='      <td>'+replaceNull(row.phone)+'</td>';
                        strHTML+='      <td>'+formatDate(replaceNull(row.created_at))+'</td>';
                        strHTML+='      <td>'+actionTemplate(row.id)+'</td>';
                        strHTML+='</tr>';
                    });

                    $("tbody").html(strHTML);

                    $('#vendor_list').DataTable();
                },
                initComplete: function(settings, json) {
                    alert( 'DataTables has finished its initialisation.' );
                  },
                error: function(){
                  $("#vendor_list_processing").css("display","none");
                }
            }
        });
    });


    </script>

@endsection