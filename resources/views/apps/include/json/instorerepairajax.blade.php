<script type="text/javascript">
    $(document).ready(function(){
		    //---------------------Test Ajax New Product Start---------------------//
            $("select[name=device_id]").change(function(){ 
                var device_id=$(this).val();
                if(device_id.length>0)
                {
                    if(device_id!="D000")
                    {
                        var modelStringopt="";
                            modelStringopt+="<option value=''>Please Select</option>";
                            modelStringopt+="<option value='M000'>Create New Model</option>";      
                        $.each(modelJson,function(index,row){
                            console.log(row,index);
                            if(row.device_id==device_id)
                            {
                                modelStringopt+="<option value="+row.id+">"+row.name+"</option>";
                            }
                        });

                        $("select[name=model_id]").html(modelStringopt);
                    }
                    else
                    {
                        console.log("Executing nEW");
                    }
                }
                else
                {
                    $(".repaireMSGPlace").html(warningMessage("Please select device."));
                }

                var problemStringopt="";
                    problemStringopt+="<option value=''>Please Select</option>";
                    problemStringopt+="<option value='P000'>Create New Problem</option>";      
                $.each(problemJson,function(index,row){
                        problemStringopt+="<option value="+row.id+">"+row.name+"</option>";
                });

                $("select[name=problem_id]").html(problemStringopt);
            });

            $("select[name=model_id]").change(function(){
                var model_id=$(this).val();
                if(model_id.length>0)
                {
                    if(model_id!="M000")
                    {
                        
                    }
                    else
                    {
                        console.log("Executing nEW");
                    }
                }
                else
                {
                    $(".repaireMSGPlace").html(warningMessage("Please select model."));
                }
            });

            $("select[name=problem_id]").change(function(){
                var device_id=$("select[name=device_id]").val();
                var model_id=$("select[name=model_id]").val();
                var problem_id=$(this).val();

                var device_name=$("input[name=device_name]").val();                
                var model_name=$("input[name=model_name]").val();
                var problem_name=$("input[name=problem_name]").val();

                


                if(problem_id.length>0)
                {
                    if(problem_id!="P000")
                    {
                        
                    }
                    else
                    {
                        console.log("Executing nEW");
                    }
                }
                else
                {
                    $(".repaireMSGPlace").html(warningMessage("Please select problem."));
                }
            });
            //-----------------Test Ajax New Product End------------------// 


	});

</script>