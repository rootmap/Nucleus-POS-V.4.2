<script type="text/javascript">
    $(document).ready(function(){
          $("input[name=device_name]").hide();
          $("input[name=model_name]").hide();
          $("input[name=problem_name]").hide();
		    //---------------------Test Ajax New Product Start---------------------//
            $("select[name=device_id]").change(function(){ 
                $("input[name=device_name]").hide();
                var device_id=$(this).val();
                if(device_id=="D000")
                {
                    $(this).parent().children("span").hide();
                    $("input[name=device_name]").show();
                }
            });

            $("select[name=model_id]").change(function(){
                $("input[name=model_name]").hide();
                var model_id=$(this).val();
                if(model_id=="M000")
                {
                    $(this).parent().children("span").hide();
                    $("input[name=model_name]").show();
                }
            });

            $("select[name=problem_id]").change(function(){
                $("input[name=problem_name]").hide();
                var problem_id=$(this).val();
                if(problem_id=="P000")
                {
                    $(this).parent().children("span").hide();
                    $("input[name=problem_name]").show();
                }
            });
            //-----------------Test Ajax New Product End------------------//

            //step 1 start
            $("#step1").click(function(){
                var device_id=$("select[name=device_id]").val();
                var device_name=$("input[name=device_name]").val();                

                var model_id=$("select[name=model_id]").val();
                var model_name=$("input[name=model_name]").val();

                var problem_id=$("select[name=problem_id]").val();
                var problem_name=$("input[name=problem_name]").val();



                var product_name_string="";
                var new_device="";
                var new_model="";
                var new_problem="";
                if(device_id.length>0)
                {
                  if(device_id=="D000")
                  {
                      if(device_name.length==0)
                      {
                          $(".repaireMSGPlace").html(warningMessage("Please Enter Your Device Name."));
                          return false;
                      }
                      else
                      {
                          new_device=device_name.trim();
                          product_name_string +=new_device;
                      }
                  }
                  else
                  {
                      device_name=$("select[name=device_id] option[value="+device_id+"]").html();
                      new_device=device_name.trim();
                      product_name_string +=new_device;
                  }
                }
                else
                {
                    $(".repaireMSGPlace").html(warningMessage("Please Select Device."));
                    return false;
                }


                if(model_id.length>0)
                {
                  if(model_id=="M000")
                  {
                      if(model_name.length==0)
                      {
                          $(".repaireMSGPlace").html(warningMessage("Please Enter Your Model Name."));
                          return false;
                      }
                      else
                      {
                          new_model=model_name.trim();
                          product_name_string +=", "+new_model;
                      }
                  }
                  else
                  {
                      model_name=$("select[name=model_id] option[value="+model_id+"]").html();
                      new_model=model_name.trim();
                      product_name_string +=", "+new_model;
                  }
                }
                else
                {
                    $(".repaireMSGPlace").html(warningMessage("Please Select Model."));
                    return false;
                }

                if(problem_id.length>0)
                {
                  if(problem_id=="P000")
                  {
                      if(problem_name.length==0)
                      {
                          $(".repaireMSGPlace").html(warningMessage("Please Enter Your Problem Name."));
                          return false;
                      }
                      else
                      {
                          new_problem=problem_name.trim();
                          product_name_string +=" - "+new_problem;
                      }
                  }
                  else
                  {
                      problem_name=$("select[name=problem_id] option[value="+problem_id+"]").html();
                      new_problem=problem_name.trim();
                      product_name_string +=" - "+new_problem;
                  }
                }
                else
                {
                    $(".repaireMSGPlace").html(warningMessage("Please Select Problem."));
                    return false;
                }

                $("input[name=name]").val(product_name_string);
                $("input[name=description]").val(product_name_string);

                $(".step1").hide();
                $("#step1").hide();
                $("#step2_step1").show();
                $("#step2").show();
                $(".step2").show();
                $("#step3").hide();
                $(".step3").hide();
                $("#step3_cancel").hide();
                $("#step3_step2").hide();



                var priceStringopt="0";    
                console.log(device_id,model_id,problem_id);
                $.each(priceJson,function(index,row){
                    console.log(row.device_name);
                    console.log(row.model_name);
                    console.log(row.problem_name);
                    if((row.device_id==device_id) && (row.model_id==model_id) && (row.problem_id==problem_id))
                    {
                        priceStringopt=row.price;
                    }
                    else if((row.device_name==device_name) && (row.model_name==model_name) && (row.problem_name==problem_name))
                    {
                        priceStringopt=row.price;
                    }
                    else if((row.device_name==new_device) && (row.model_name==new_model) && (row.problem_name==new_problem))
                    {
                        priceStringopt=row.price;
                    }

                });

                $("input[name=price]").val(priceStringopt);

                $(".repaireMSGPlace").html(successMessage("Please Enter Price For Repair ("+product_name_string+") Info."));
                
            });
            //step 1 end


            //step2 start
            $("input[name=price]").change(function(){
                var price=$("input[name=price]").val();
                if(price.length==0)
                {
                    $("input[name=price]").val("0");
                }
            });

            $("#step2").click(function(){
                var price=$("input[name=price]").val();
                if(price.length==0)
                {
                    $("input[name=price]").val("0");
                    var c=confirm("Are You Sure To Proceed With 0 price.");
                    if(!c)
                    {
                        return false;
                    }
                }

                $("input[name=retail_price]").val(price);
                $("input[name=our_cost]").val(price);

                $(".step1").hide();
                $("#step1").hide();
                $("#step2_step1").hide();
                $("#step2").hide();
                $(".step2").hide();
                $("#step3").show();
                $(".step3").show();
                $("#step3_cancel").show();
                $("#step3_step2").show();

                $(".repaireMSGPlace").html(successMessage("Please Complete Product Information."));

            });

            $("#step2_step1").click(function(){
                $(".step1").show();
                $("#step1").show();
                $("#step2_step1").hide();
                $("#step2").hide();
                $(".step2").hide();
                $("#step3").hide();
                $(".step3").hide();
                $("#step3_cancel").hide();
                $("#step3_step2").hide();
            });
            //step2 end 


            //step3 start
            $("#step3_step2").click(function(){
                $(".step1").hide();
                $("#step1").hide();
                $("#step2_step1").show();
                $("#step2").show();
                $(".step2").show();
                $("#step3").hide();
                $(".step3").hide();
                $("#step3_cancel").hide();
                $("#step3_step2").hide();
            });

            $("#step3").click(function(){
                
                var barcode=$("input[name=barcode]").val();
                var name=$("input[name=name]").val();
                var retail_price=$("input[name=retail_price]").val();
                var our_cost=$("input[name=our_cost]").val();
                var quantity=$("input[name=quantity]").val();
                var description=$("input[name=description]").val();

                if(barcode.length==0){ $(".repaireMSGPlace").html(warningMessage("Please Enter Barcode.")); return false; }
                if(name.length==0){ $(".repaireMSGPlace").html(warningMessage("Please Enter Product Name.")); return false; }
                if(retail_price.length==0){ $(".repaireMSGPlace").html(warningMessage("Please Enter Retail Price.")); return false; }
                if(our_cost.length==0){ $(".repaireMSGPlace").html(warningMessage("Please Enter Our Cost.")); return false; }
                if(quantity.length==0){ $(".repaireMSGPlace").html(warningMessage("Please Enter Quantity.")); return false; }
                if(description.length==0){ $(".repaireMSGPlace").html(warningMessage("Please Enter Description.")); return false; }

            });
            //step3 end
	});

</script>