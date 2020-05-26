<script type="text/javascript">
    $("#punch").click(function(){
            $(".hideDIv").hide();
            $("#punchMSG").hide();
            //------------------------Ajax POS Start-------------------------//
            var timevalue=$("#punch_time").val();
            var timeLen=timevalue.length;
            if(timeLen==19)
            {
                $("#punchMSG").show();
                $("#punchMSG").html(loadingOrProcessing("Processing Your Attendance Info, Please wait....."));
                var AddPOSUrl="{{url('attendance/punch/save')}}";
                $.ajax({
                    'async': false,
                    'type': "POST",
                    'global': false,
                    'dataType': 'json',
                    'url': AddPOSUrl,
                    'data': {'date':timevalue,'_token':"{{csrf_token()}}"},
                    'success': function (data) {
                        //tmp = data;
                        $("#punchMSG").show();
                        $("#punchMSG").html(successMessage("Your Attendance Saved Successfully."));
                        console.log("Attendance Processing : "+data);
                        
                        if(data.length>0)
                        {
                            $(".hideDIv").show();
                            $("#punchLogTimes").html("");
                            $.each(data,function(key,row){
                                var elapsed_time=row.elapsed_time;
                                if(row.out_time=="00:00:00")
                                {
                                    elapsed_time="00:00:00";
                                }
                                var htmlStr='<tr><td>'+row.in_date+'</td><td>'+row.in_time+'</td><td>'+row.out_date+'</td><td>'+row.out_time+'</td><td>'+elapsed_time+'</td></tr>';
                                $("#punchLogTimes").append(htmlStr);
                            });
                        }
                        
//punchLogTimes

                    }
                });
            }
            else
            {
                $("#punchMSG").show();
                $("#punchMSG").html(warningMessage("Invalid Time Format Please Contact With Site Administrator."));
                return false;
            }
            
            //------------------------Ajax POS End---------------------------//
            //attendance/punch/json
            //attendanceJson
    });
</script>