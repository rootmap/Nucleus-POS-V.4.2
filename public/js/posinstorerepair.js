    var csrftLarVe = $('meta[name="csrf-token"]').attr("content");
    function addToRepairList(repairFidAr,customerID,productID,price)
    {
        //-------------Ajax Instore Repair Product POS End--------------//
         $.ajax({
            'async': true,
            'type': "POST",
            'global': true,
            'dataType': 'json',
            'url': posinstorerepair_repair_info_pos_ajax,
            'data': {'customer_id':customerID,'product_id':productID,'price':price,'repair':repairFidAr,'_token':csrftLarVe},
            'success': function (data) {
                var win = window.open(posinstorerepair_repair_list);
                if (win) {
                    //Browser has allowed it to be opened
                    win.focus();
                    window.location.href=window.location.href;
                } else {
                    alert('Please allow popups for this website');
                }
                $("#cartMessageProShow").html(successMessage("Repair info successfully added to Repair List."));
                console.log("Instore Repair Product Info Added Processing : "+data);
            }
         });
         //------------Ajax Instore Repair Product End---------------//
    }

    function addToTicketList(repairFidAr,customerID,productID,price)
    {
        //-------------Ajax Instore Repair Product POS End--------------//
         
         $.ajax({
            'async': true,
            'type': "POST",
            'global': true,
            'dataType': 'json',
            'url': posinstorerepair_ticket_info_pos_ajax,
            'data': {'customer_id':customerID,'product_id':productID,'price':price,'ticket':repairFidAr,'_token':csrftLarVe},
            'success': function (data) {
                var win = window.open(posinstorerepair_ticket_list);
                if (win) {
                    //Browser has allowed it to be opened
                    win.focus();
                    window.location.href=window.location.href;
                } else {
                    alert('Please allow popups for this website');
                }
                $("#cartMessageProShow").html(successMessage("Ticket info successfully added to Ticket List."));
                console.log("Ticket Product Info Added Processing : "+data);
            }
         });
         //------------Ajax Instore Repair Product End---------------//
    }
	//---------------------Test Ajax New Product Start---------------------//
	$(document).ready(function(){

            $("select[name=device_id]").change(function(){ 
                var device_id=$(this).val();
                if(device_id.length>0)
                {
                        var modelStringopt="";
                            modelStringopt+="<option value=''>Please Select</option>";     
                        $.each(modelJson,function(index,row){
                            console.log(row,index);
                            if(row.device_id==device_id)
                            {
                                modelStringopt+="<option value="+row.id+">"+row.name+"</option>";
                            }
                        });

                        $("select[name=model_id]").html(modelStringopt);
                }

                var problemStringopt="";
                    problemStringopt+="<option value=''>Please Select</option>";    
                $.each(problemJson,function(index,row){
                        problemStringopt+="<option value="+row.id+">"+row.name+"</option>";
                });

                $("select[name=problem_id]").html(problemStringopt);
            });

            $("select[name=model_id]").change(function(){
                var model_id=$(this).val();
                if(model_id.length>0)
                {

                }
            });

            $("select[name=problem_id]").change(function(){
                var problem_id=$(this).val();
                if(problem_id.length>0)
                { 

                }
            });


            $("#step1").click(function(){
                var device_id=$("select[name=device_id]").val();
                var model_id=$("select[name=model_id]").val();
                var problem_id=$("select[name=problem_id]").val();

                var new_device="";
                var new_model="";
                var new_problem="";
                if(device_id.length>0)
                {
                      var device_name=$("select[name=device_id] option[value="+device_id+"]").html();
                      new_device=device_name.trim();
                }
                else
                {
                    $("#InstoreMSG").html(warningMessage("Please Select Device."));
                    return false;
                }


                if(model_id.length>0)
                {
                      var model_name=$("select[name=model_id] option[value="+model_id+"]").html();
                      new_model=model_name.trim();
                }
                else
                {
                    $("#InstoreMSG").html(warningMessage("Please Select Model."));
                    return false;
                }

                if(problem_id.length>0)
                {
                      var problem_name=$("select[name=problem_id] option[value="+problem_id+"]").html();
                      new_problem=problem_name.trim();
                }
                else
                {
                    $("#InstoreMSG").html(warningMessage("Please Select Problem."));
                    return false;
                }

                var priceStringopt="0";    
                console.log(device_id,model_id,problem_id);
                $.each(estPriceJson,function(index,row){
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

                $("input[name=repair_price]").val(priceStringopt);
                $("#repair_price").html(priceStringopt);

                $("#step1").hide();
                $(".step1").hide();
                $("#step2").show();
                $("#step2_override").show();
                $(".step2").show();
                $("#step2_step1").show();
            });

            $("#step2_override").click(function(){

                if($("input[name=repairPage]"))
                {
                    var custCHeck=$('select[name=customer_id]').val();
                    if(custCHeck.length==0)
                    {
                        $("#InstoreMSG").html(warningMessage("Please Select a customer."));
                        return false;
                    }
                    else if(custCHeck=="CR000")
                    {
                        var full_name=$("input[name=full_name]").val();
                        if(full_name.length==0)
                        {
                            $("#InstoreMSG").html(warningMessage("Please Enter Customer Full Name."));
                            return false;
                        }

                        var address=$("input[name=address]").val();
                        /*if(address.length==0)
                        {
                            $("#InstoreMSG").html(warningMessage("Please Enter Customer Address."));
                            return false;
                        }*/

                        var phone=$("input[name=phone]").val();
                        if(phone.length==0)
                        {
                            $("#InstoreMSG").html(warningMessage("Please Enter Customer Phone Number."));
                            return false;
                        }

                        var email=$("input[name=email]").val();
                        /*if(email.length==0)
                        {
                            $("#InstoreMSG").html(warningMessage("Please Enter Customer Email."));
                            return false;
                        }*/
                    }
                }

                $("#step1").hide();
                $(".step1").hide();
                $("#step2").hide();
                $("#step2_override").hide();
                $(".step2").hide();
                $(".step3").show();
                $("#step3").show();
                $("#step3_list").show();
                if($("#finish"))
                {
                    $("#finish").show();
                }

                if($("#step2_step1"))
                {
                    $("#step2_step1").hide();
                }

                $("#step3_step2").show();
                $(".step2_repair_new_customer").hide();
               //$('select[name=customer_id]').val('').select2();
            });

            $("#step2").click(function(){

                if($("input[name=repairPage]"))
                {
                    var custCHeck=$('select[name=customer_id]').val();
                    if(custCHeck.length==0)
                    {
                        $("#InstoreMSG").html(warningMessage("Please Select a customer."));
                        return false;
                    }
                    else if(custCHeck=="CR000")
                    {
                        var full_name=$("input[name=full_name]").val();
                        if(full_name.length==0)
                        {
                            $("#InstoreMSG").html(warningMessage("Please Enter Customer Full Name."));
                            return false;
                        }

                        var address=$("input[name=address]").val();
                        /*if(address.length==0)
                        {
                            $("#InstoreMSG").html(warningMessage("Please Enter Customer Address."));
                            return false;
                        }*/

                        var phone=$("input[name=phone]").val();
                        if(phone.length==0)
                        {
                            $("#InstoreMSG").html(warningMessage("Please Enter Customer Phone Number."));
                            return false;
                        }

                        var email=$("input[name=email]").val();
                        /*if(email.length==0)
                        {
                            $("#InstoreMSG").html(warningMessage("Please Enter Customer Email."));
                            return false;
                        }*/
                    }
                }

                $("#step1").hide();
                $(".step1").hide();
                $("#step2").hide();
                $("#step2_override").hide();
                $(".step2").hide();
                $(".step3").show();
                $("#step3").show();
                $("#step3_list").show();
                if($("#finish"))
                {
                    $("#finish").show();
                }

                if($("#step2_step1"))
                {
                    $("#step2_step1").hide();
                }

                $("#step3_step2").show();
                $(".step2_repair_new_customer").hide();



               //$('select[name=customer_id]').val('').select2();

                
            });

            $("#step2_step1").click(function(){
                $("#step1").show();
                $(".step1").show();
                $("#step2_step1").hide();
                $("#step2").hide();
                $("#step2_override").hide();
                $(".step2").hide();
                $(".step3").hide();
                $("#step3").hide();
                $("#step3_list").hide();
                $("#step3_step2").hide();

                if($("#finish"))
                {
                    $("#finish").hide();
                }

                if($("#step2_step1"))
                {
                    $("#step2_step1").hide();
                }

                $(".step2_repair_new_customer").hide();
                $('select[name=customer_id]').val('').select2();

            });

            $("#step3_step2").click(function(){
                $("#step1").hide();
                $(".step1").hide();
                $("#step2_step1").show();
                $("#step2").show();
                $("#step2_override").show();
                $(".step2").show();
                $(".step3").hide();
                $("#step3").hide();
                $("#step3_list").hide();
                $("#step3_step2").hide();

                if($("#finish"))
                {
                    $("#finish").hide();
                }

                if($('select[name=customer_id]').val()=="CR000")
                {
                    $(".step2_repair_new_customer").show();
                }

            });

            $("#step3").click(function(){
                //alert("Working with Step 3");
                //return false;
                var device_id=$("select[name=device_id]").val();
                var model_id=$("select[name=model_id]").val();
                var problem_id=$("select[name=problem_id]").val();

                var new_device="";
                var new_model="";
                var new_problem="";
                if(device_id.length>0)
                {
                      var device_name=$("select[name=device_id] option[value="+device_id+"]").html();
                      new_device=device_name.trim();
                }


                if(model_id.length>0)
                {
                      var model_name=$("select[name=model_id] option[value="+model_id+"]").html();
                      new_model=model_name.trim();
                }

                if(problem_id.length>0)
                {
                      var problem_name=$("select[name=problem_id] option[value="+problem_id+"]").html();
                      new_problem=problem_name.trim();
                }

                var customer_id=$("select[name=customer_id]").val();
                if(customer_id.length==0)
                {
                    $("#InstoreTicketMSG").html(warningMessage("Please select a customer first."));
                    return false;
                }

                var productName=new_device+", "+new_model+" - "+new_problem;

                var repair_price=$("input[name=repair_price]").val();
                var override_repair_price=$("input[name=override_repair_price]").val();

                var proPrice=repair_price;

                if(override_repair_price.length>0)
                {
                    if(override_repair_price==0)
                    {
                        proPrice=repair_price;
                    }
                    else
                    {
                        proPrice=override_repair_price;
                    }
                    
                }

                var repairFidAr = {};
                $.each($('#repairForm').serializeArray(), function(i, field) {
                    repairFidAr[field.name] = field.value;
                });

                console.log(productName);
                console.log("checking product json");
                var x=0;
                $.each(productJson,function(index,row){
                    if(row.category_name=="Repair" && row.name==productName && x==0)
                    {
                        x=1;
                        add_pos_cart(row.id,proPrice,row.name,repairFidAr);
                        //console.log(row);
                        console.log('Found in product json');
                    }
                    
                });


                if(x==0)
                {
                     if(proPrice<=0)
                     {
                        alert("Please Mention a repair price.");
                        $("#InstoreMSG").html(warningMessage("Please Mention a repair price."));
                        return false;
                     }

                     var productID=0;
                     //-------------Ajax Instore Repair Product POS End--------------//
                     $.ajax({
                        'async': true,
                        'type': "POST",
                        'global': true,
                        'dataType': 'json',
                        'url': posinstorerepair_repair_product_ajax,
                        'data': {'name':productName,'price':proPrice,'cost_price':proPrice,'_token':csrftLarVe},
                        'success': function (data) {
                            //tmp = data;
                            productID=data;
                            console.log("Instore Repair Product Processing : "+data);
                            add_pos_cart(productID,proPrice,productName,repairFidAr);
                        }
                     });
                     //------------Ajax Instore Repair Product End---------------//
                     //repairProductAjaxUpdate
                }

                //alert(productName);
                //productJson

                $("#step1").show();
                $(".step1").show();
                $("#step2").hide();
                $("#step2_override").hide();
                $(".step2").hide();
                $(".step3").hide();
                $("#step3").hide();
                $("#step3_list").hide();
                $("#reset_repair").click();


                $('select[name=device_id]').val('').select2();
                $('select[name=model_id]').val('').select2();
                $('select[name=problem_id]').val('').select2();
                $("input[name=override_repair_price]").val("0");
                $("input[name=repair_imei]").val("");
                $("input[name=repair_tested_before_by]").val("");
                $("input[name=repair_tested_after_by]").val("");
                $("input[name=repair_tech_notes]").val("");
                $("input[name=repair_how_did_you_hear_about_us]").val("");
                $("input[name=repair_start_time]").val("");
                $("input[name=repair_end_time]").val("");

                $('.repair_checkbox').removeAttr('checked');

                $('#instoreRepairModal').modal('hide'); 

                $("html, body").animate({ scrollTop: 0 }, "slow");

            });

            

            $("#step3_list").click(function(){
                //alert("Working with Step 3");
                //return false;
                var device_id=$("select[name=device_id]").val();
                var model_id=$("select[name=model_id]").val();
                var problem_id=$("select[name=problem_id]").val();

                var new_device="";
                var new_model="";
                var new_problem="";
                if(device_id.length>0)
                {
                      var device_name=$("select[name=device_id] option[value="+device_id+"]").html();
                      new_device=device_name.trim();
                }


                if(model_id.length>0)
                {
                      var model_name=$("select[name=model_id] option[value="+model_id+"]").html();
                      new_model=model_name.trim();
                }

                if(problem_id.length>0)
                {
                      var problem_name=$("select[name=problem_id] option[value="+problem_id+"]").html();
                      new_problem=problem_name.trim();
                }

                var customer_id=$("select[name=customer_id]").val();
                if(customer_id.length==0)
                {
                    $("#InstoreTicketMSG").html(warningMessage("Please select a customer first."));
                    return false;
                }

                var productName=new_device+", "+new_model+" - "+new_problem;

                var repair_price=$("input[name=repair_price]").val();
                var override_repair_price=$("input[name=override_repair_price]").val();

                var proPrice=repair_price;

                if(override_repair_price.length>0)
                {
                    if(override_repair_price==0)
                    {
                        proPrice=repair_price;
                    }
                    else
                    {
                        proPrice=override_repair_price;
                    }
                    
                }

                var repairFidAr = {};
                $.each($('#repairForm').serializeArray(), function(i, field) {
                    repairFidAr[field.name] = field.value;
                });

                console.log(productName);
                console.log("checking product json");
                var x=0;
                $.each(productJson,function(index,row){
                    if(row.category_name=="Repair" && row.name==productName && x==0)
                    {
                        x=1;
                        //add_pos_cart(row.id,proPrice,row.name,repairFidAr);
                        //console.log(row);
                        //console.log('Found in product json');
                        addToRepairList(repairFidAr,customer_id,row.id,proPrice);
                        $("#cartMessageProShow").html(successMessage("Repair info successfully added to Repair List."));
                    }
                    
                });


                if(x==0)
                {
                     if(proPrice<=0)
                     {
                        alert("Please Mention a repair price.");
                        $("#InstoreMSG").html(warningMessage("Please Mention a repair price."));
                        return false;
                     }

                     var productID=0;
                     //-------------Ajax Instore Repair Product POS End--------------//
                     $.ajax({
                        'async': true,
                        'type': "POST",
                        'global': true,
                        'dataType': 'json',
                        'url': posinstorerepair_repair_product_ajax,
                        'data': {'name':productName,'price':proPrice,'cost_price':proPrice,'_token':csrftLarVe},
                        'success': function (data) {
                            //tmp = data;
                            productID=data;
                            //var customerID=$("select[name=customer_id]").val();
                            //console.log("Instore Repair Product Processing : "+data);
                            //addToTicketList(repairFidAr,customerID,productID,proPrice);
                            //add_pos_cart(productID,proPrice,productName,repairFidAr);
                            addToRepairList(repairFidAr,customer_id,productID,proPrice);
                            
                        }
                     });
                     //------------Ajax Instore Repair Product End---------------//
                     //repairProductAjaxUpdate
                }

                //alert(productName);
                //productJson

                $("#step1").show();
                $(".step1").show();
                $("#step2").hide();
                $("#step2_override").hide();
                $(".step2").hide();
                $(".step3").hide();
                $("#step3").hide();
                $("#step3_list").hide();
                $("#reset_repair").click();


                $('select[name=device_id]').val('').select2();
                $('select[name=model_id]').val('').select2();
                $('select[name=problem_id]').val('').select2();
                $("input[name=override_repair_price]").val("0");
                $("input[name=repair_imei]").val("");
                $("input[name=repair_tested_before_by]").val("");
                $("input[name=repair_tested_after_by]").val("");
                $("input[name=repair_tech_notes]").val("");
                $("input[name=repair_how_did_you_hear_about_us]").val("");
                $("input[name=repair_start_time]").val("");
                $("input[name=repair_end_time]").val("");

                $('.repair_checkbox').removeAttr('checked');

                $('#instoreRepairModal').modal('hide'); 

                $("html, body").animate({ scrollTop: 0 }, "slow");

            });

            

            //-----------------Test Ajax New Product End------------------//


            $("select[name=ticket_problem_id]").change(function(){

            	var ticket_problem_id=$(this).val();
            	if(ticket_problem_id=="TP0001")
            	{
            		$(this).parent().children("span").hide();
            		$("input[name=ticket_problem_name]").show();

            	}

            });

            var date = new Date();
			var timestamp = date.getTime();

			$("#label_ticket_id").html(timestamp);
			$("input[name=ticket_id]").val(timestamp);

            $("#ticketstep1").click(function(){

                var customer_id=$("select[name=customer_id]").val();
                if(customer_id.length==0)
                {
                    $("#InstoreTicketMSG").html(warningMessage("Please select a customer first."));
                    return false;
                }

            	var ticket_device_type=$("input[name=ticket_device_type]").val();
            	if(ticket_device_type.length==0)
            	{
            		$("#InstoreTicketMSG").html(warningMessage("Please type device type / Subject."));
            		return false;
            	}

            	var ticket_problem_id=$("select[name=ticket_problem_id]").val();
            	if(ticket_problem_id.length==0)
            	{
            		$("#InstoreTicketMSG").html(warningMessage("Please select a problem."));
            		return false;
            	}
            	else if(ticket_problem_id.length>0)
            	{
            		if(ticket_problem_id=="TP0001")
            		{
            			var ticket_problem_name=$("input[name=ticket_problem_name]").val();
		            	if(ticket_device_type.length==0)
		            	{
		            		$("#InstoreTicketMSG").html(warningMessage("Please type device type."));
		            		return false;
		            	}
            		}
            		
            	}

            	

            	var ticket_our_cost=$("input[name=ticket_our_cost]").val();
            	if(ticket_our_cost.length==0)
            	{
            		$("#InstoreTicketMSG").html(warningMessage("Please type our cost."));
            		return false;
            	}

            	var ticket_retail_price=$("input[name=ticket_retail_price]").val();
            	if(ticket_retail_price.length==0)
            	{
            		$("#InstoreTicketMSG").html(warningMessage("Please type retail customer price."));
            		return false;
            	}

            	

            	$(".ticketstep1").hide();
            	$("#ticketstep1").hide();            	

            	$(".ticketstep2").show();
            	$("#ticketstep2").show();
                $("#ticketstep2_list").show();
            	$("#ticketstep2_to_ticketstep1").show();
            });

            $("#ticketstep2_to_ticketstep1").click(function(){
            	$(".ticketstep1").show();
            	$("#ticketstep1").show();            	

            	$(".ticketstep2").hide();
            	$("#ticketstep2").hide();
                $("#ticketstep2_list").hide();
            	$("#ticketstep2_to_ticketstep1").hide();
            });

            $("#ticketstep2").click(function(){

            	var ticket_device_type=$("input[name=ticket_device_type]").val();
                var ticket_id=$("input[name=ticket_id]").val();
            	var customer_id=$("select[name=customer_id]").val();
                if(customer_id.length==0)
                {
                    $("#InstoreTicketMSG").html(warningMessage("Please select a customer first."));
                    return false;
                }
            	var ProductName=ticket_device_type+" - "+ticket_id;
            	var ticket_our_cost=$("input[name=ticket_our_cost]").val();
            	var ticket_retail_price=$("input[name=ticket_retail_price]").val();
            	var repairFidAr = {};
                $.each($('#TicketForm').serializeArray(), function(i, field) {
                    repairFidAr[field.name] = field.value;
                });

                var ProductID=""; 
	            $.ajax({
	                'async': false,
	                'type': "POST",
	                'global': false,
	                'dataType': 'json',
	                'url': posinstorerepair_product_ajax_ticket_save,
	                'data': {'name':ProductName,'price':ticket_retail_price,'cost_price':ticket_our_cost,'detail':ProductName,'ticketInfo':repairFidAr,'_token':csrftLarVe},
	                'success': function (data) {
	                    ProductID=data; 
	                    //console.log("Adding New Product : "+data)
	                }
	            });

	            add_pos_cart(ProductID,ticket_retail_price,ProductName,repairFidAr,'ticket');

                console.log(ProductID);
                //yreturn false;

            	$("select[name=ticket_problem_id]").parent().children("span").show();
            	$('select[name=ticket_problem_id]').val('').select2();
            	$("input[name=ticket_problem_name]").hide();


            	$(".ticketstep1").show();
            	$("#ticketstep1").show();            	

            	$(".ticketstep2").hide();
                $("#ticketstep2").hide();
            	$("#ticketstep2_list").hide();

            	$("#ticketstep2_to_ticketstep1").hide();
            	$("#reset_ticket").click();

            	var date = new Date();
				var timestamp = date.getTime();

				$("#label_ticket_id").html(timestamp);
				$("input[name=ticket_id]").val(timestamp); 

                $("html, body").animate({ scrollTop: 0 }, "slow");
            });

            $("#ticketstep2_list").click(function(){

                var customer_id=$("select[name=customer_id]").val();
                if(customer_id.length==0)
                {
                    $("#InstoreTicketMSG").html(warningMessage("Please select a customer first."));
                    return false;
                }

                var ticket_device_type=$("input[name=ticket_device_type]").val();
                var ticket_id=$("input[name=ticket_id]").val();
                var ProductName=ticket_device_type+" - "+ticket_id;
                var ticket_our_cost=$("input[name=ticket_our_cost]").val();
                var ticket_retail_price=$("input[name=ticket_retail_price]").val();
                var repairFidAr = {};
                $.each($('#TicketForm').serializeArray(), function(i, field) {
                    repairFidAr[field.name] = field.value;
                });

                var ProductID=""; 
                $.ajax({
                    'async': false,
                    'type': "POST",
                    'global': false,
                    'dataType': 'json',
                    'url': posinstorerepair_product_ajax_ticket_save,
                    'data': {'name':ProductName,'price':ticket_retail_price,'cost_price':ticket_our_cost,'detail':ProductName,'_token':csrftLarVe},
                    'success': function (data) {
                        ProductID=data; 
                        addToTicketList(repairFidAr,customer_id,ProductID,ticket_retail_price);
                    }
                });

                //add_pos_cart(ProductID,ticket_retail_price,ProductName,repairFidAr,'ticket');

                //
                //console.log(ProductID);
                //yreturn false;

                $("#instoreTicketModal").modal('hide');
                $("select[name=ticket_problem_id]").parent().children("span").show();
                $('select[name=ticket_problem_id]').val('').select2();
                $("input[name=ticket_problem_name]").hide();


                $(".ticketstep1").show();
                $("#ticketstep1").show();               

                $(".ticketstep2").hide();
                $("#ticketstep2").hide();
                $("#ticketstep2_list").hide();
                $("#ticketstep2_to_ticketstep1").hide();
                $("#reset_ticket").click();

                var date = new Date();
                var timestamp = date.getTime();

                $("#label_ticket_id").html(timestamp);
                $("input[name=ticket_id]").val(timestamp);

                $("html, body").animate({ scrollTop: 0 }, "slow");

            });

    });
    
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
            
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': punch_attendance_punch_save,
                'data': {'date':timevalue,'_token':csrftLarVe},
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

    function pushTax(taxRate)
    {
        var taxRate=taxRate;
        $.each($("#dataCart").find("tr"),function(index,row){
                //var singlePrice=$(row).find("td:eq(2)").children("span").html();
                var rowPrice=parseFloat($(row).find("td:eq(3)").children("span").html()).toFixed(2); 
                var calcTax=((rowPrice*taxRate)/100);
                $(row).find("td:eq(2)").attr("data-tax",calcTax); 
                //parseFloat().toFixed(2); 
        });
    }


    $(document).ready(function(){
        $(".apply-tax").click(function(){

            $("#cartMessageProShow").html(loadingOrProcessing("Please wait, Changing your tax status......."));

            var taxType="No Tax";
            if(document.getElementById("tax_0").checked==true)
            {
                taxType="Full Tax";
            }
            else if(document.getElementById("tax_1").checked==true)
            {
                taxType="Part Tax";
            }
            else if(document.getElementById("tax_2").checked==true)
            {
                taxType="No Tax";
            }


             //------------------------Ajax Customer Start-------------------------//
             $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': tax_settings_tax_settype,
                'data': {'setTaxType':taxType,'_token':csrftLarVe},
                'success': function (data) {
                    console.log(data.TaxRate);
                    $("#taxRate").val(data.TaxRate);
                    pushTax(data.TaxRate);
                    $("#TaxManagement").modal('hide');
                    $("#cartMessageProShow").html(successMessage("Your tax status has been chnaged successfully."));
                    genarateSalesTotalCart();
                }
            });
            //------------------------Ajax Customer End---------------------------//

        });
    });

    