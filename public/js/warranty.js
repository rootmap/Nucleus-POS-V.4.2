    var csrftLarVe = $('meta[name="csrf-token"]').attr("content");
    $(document).ready(function(){
        $(".warranty").click(function(){
            $("#warranty").modal("show");
            $('select[name=warranty_ex_product_id]').val('').select2();
            $('select[name=warranty_new_product_id]').val('').select2();
            $("#warrantyMSG").html(loadingOrProcessing("Please wait, loading invoices."));
            //------------------------Ajax Customer Start-------------------------//
             $.ajax({
                'async': true,
                'type': "GET",
                'global': true,
                'dataType': 'json',
                'url': warranty_warranty_invoice_ajax,
                'data': {'_token':csrftLarVe},
                'success': function (data) 
                {
                    $("#warrantyMSG").html(successMessage("Invoices loaded successfully, Please select a invoice."));
                    var ff="<option value=''>Select A Invoice</option>";
                    $.each(data,function(index,row){
                        //console.log(row);
                        ff+="<option data-value='"+row.total_amount+"' value='"+row.invoice_id+"'>"+row.invoice_id+" - "+row.created_at+"</option>";
                    });

                    $("select[name=warranty_sales_invoice_id]").html(ff);

                    $("select[name=warranty_sales_invoice_id]").select2({
                         dropdownParent: $("#warranty")
                    });


                }
            });
            //------------------------Ajax Customer End---------------------------//

        });

        $("select[name=warranty_sales_invoice_id]").change(function(){
            $("#warrantyMSG").html(loadingOrProcessing("Please wait, loading customer invoices."));
            var invoice_id=$(this).val();
            if(invoice_id.length==0)
            {
                $("#warrantyMSG").html(warningMessage("Please Select a Invoice."));
                return false;
            }

            var invoiceAmount=$("select[name=warranty_sales_invoice_id] option[value="+invoice_id+"]").attr("data-value");
            $("#warrantyMSG").html(successMessage("Invoice Total Amount Load Successfully."));
            $("input[name=warranty_sales_amount]").val(invoiceAmount);

            $("#warrantyMSG").html(loadingOrProcessing("Please wait, Loading invoice old & replaceable product."));
            //------------------------Ajax Customer Start-------------------------//
             $.ajax({
                'async': true,
                'type': "POST",
                'global': true,
                'dataType': 'json',
                'url': warranty_warranty_invoice_product_ajax,
                'data': {'invoice_id':invoice_id,'_token':csrftLarVe},
                'success': function (data) 
                {
                    if(data.status==1)
                    {
                        $("#warrantyMSG").html(successMessage("Old & Replaceable Product Loaded Successfully."));

                        var ff="<option value=''>Select A Old Product</option>";
                        $.each(data.invProduct,function(index,row){
                            //console.log(row);
                            ff+="<option value='"+row.product_id+"'>"+row.product_name+"</option>";
                        });

                        $("select[name=warranty_ex_product_id]").html(ff);

                        $("select[name=warranty_ex_product_id]").select2({
                             dropdownParent: $("#warranty")
                        });


                        ff="";

                        var fff="<option value=''>Select A New Product</option>";
                        $.each(data.product,function(index,row){
                            //console.log(row);
                            fff+="<option value='"+row.id+"'>"+row.name+"</option>";
                        });

                        $("select[name=warranty_new_product_id]").html(fff);

                        $("select[name=warranty_new_product_id]").select2({
                             dropdownParent: $("#warranty")
                        });

                        //

                    }
                    else
                    {
                        $("#warrantyMSG").html(warningMessage("Something Went Wrong, Please Reload Page & Try Again."));
                    }
                    
                    
                }
            });
            //------------------------Ajax Customer End---------------------------//

        });

        $(".saveWarrantySave").click(function(){
            var old_product=$("select[name=warranty_ex_product_id]").val();
            var new_product=$("select[name=warranty_new_product_id]").val();
            var invoice_id=$("select[name=warranty_sales_invoice_id]").val();
            //console.log(old_product,new_product);
            if(invoice_id.length==0)
            {
                $("#warrantyMSG").html(warningMessage("Please Select a Invoice."));
                return false;
            }

            if(invoice_id==0)
            {
                $("#warrantyMSG").html(warningMessage("Please Select a Invoice."));
                return false;
            }

            if(old_product.length==0)
            {
                $("#warrantyMSG").html(warningMessage("Please Select Old Product For Replace."));
                return false;
            }
            if(old_product==0)
            {
                $("#warrantyMSG").html(warningMessage("Please Select Old Product For Replace."));
                return false;
            }

            if(new_product.length==0)
            {
                $("#warrantyMSG").html(warningMessage("Please Select New Product For Replace."));
                return false;
            }
            if(new_product==0)
            {
                $("#warrantyMSG").html(warningMessage("Please Select New Product For Replace."));
                return false;
            }

            var old_product_html=$("select[name=warranty_ex_product_id] option[value="+old_product+"]").html();
            var new_product_html=$("select[name=warranty_new_product_id] option[value="+new_product+"]").html();


            $("select[name=ex_product_id] option[value="+old_product+"]").remove();


            var timeStamp = Math.floor(Date.now() / 1000);

            $(".ShowMessage").html(loadingOrProcessing("Processing please wait...."));
            var postURL=warranty_warranty_cart_add_invoice_id+"/"+invoice_id;
            $.post(postURL,{'old_product':old_product,'new_product':new_product,'_token':csrftLarVe},function(retData){
                if(retData==1)
                {
                    $("#warrantyMSG").html(successMessage("Saved to warranty inventory successfully."));
                    $('select[name=warranty_sales_invoice_id]').val('').select2();
                    $('input[name=warranty_sales_amount]').val('0');
                    $('select[name=warranty_ex_product_id]').val('').select2();
                    $('select[name=warranty_new_product_id]').val('').select2();

                    $("#warranty").animate({ scrollTop: 0 }, "slow");
                }
                else
                {
                    $("#warrantyMSG").html(warningMessage("Failed, Please try again."));
                }
            });

        });


        

    });

    $(document).ready(function(){
        $(".buybackpull").click(function(){
            $("#buyback").modal("show");

            $("select[name=buyback_customer_id]").select2({
                 dropdownParent: $("#buyback")
            });


        });

        $(".saveBuybackSave").click(function(){
                var buyback_customer_id=$("select[name=buyback_customer_id]").val();
                var buyback_model=$("input[name=buyback_model]").val();
                var buyback_carrier=$("input[name=buyback_carrier]").val();
                var buyback_imei=$("input[name=buyback_imei]").val();
                var buyback_type_and_color=$("input[name=buyback_type_and_color]").val();
                var buyback_memory=$("input[name=buyback_memory]").val();
                var buyback_keep_this_on=$("select[name=buyback_keep_this_on]").val();
                var buyback_condition=$("input[name=buyback_condition]").val();
                var buyback_price=$("input[name=buyback_price]").val();
                var buyback_payment_method=$("select[name=buyback_payment_method]").val();

                if(buyback_customer_id.length==0)
                {
                    $("#buybackMSG").html(warningMessage("Please Select a Buyback Customer."));
                    return false;
                }
                if(buyback_customer_id==0)
                {
                    $("#buybackMSG").html(warningMessage("Please Select a Buyback Customer."));
                    return false;
                }

                if(buyback_model.length==0)
                {
                    $("#buybackMSG").html(warningMessage("Please Type a Buyback Model."));
                    return false;
                }

                if(buyback_keep_this_on.length==0)
                {
                    $("#buybackMSG").html(warningMessage("Please Select Keep This On."));
                    return false;
                }
                if(buyback_keep_this_on==0)
                {
                    $("#buybackMSG").html(warningMessage("Please Select Keep This On."));
                    return false;
                }

                if(buyback_price.length==0)
                {
                    $("#buybackMSG").html(warningMessage("Please Type a Buyback Price."));
                    return false;
                }

                if($.isNumeric(buyback_price)==false)
                {
                    $("#buybackMSG").html(warningMessage("Please Type a Buyback Price."));
                    return false;
                }

                if(buyback_payment_method.length==0)
                {
                    $("#buybackMSG").html(warningMessage("Please Select Payment Method."));
                    return false;
                }
                if(buyback_payment_method==0)
                {
                    $("#buybackMSG").html(warningMessage("Please Select Payment Method."));
                    return false;
                }


                $("#buybackMSG").html(loadingOrProcessing("Please wait, Processing Buyback Info."));

                 $.ajax({
                    'async': true,
                    'type': "POST",
                    'global': true,
                    'dataType': 'json',
                    'url': buyback_buyback_pos_ajax,
                    'data': {
                        'buyback_customer_id':buyback_customer_id,
                        'buyback_model':buyback_model,
                        'buyback_carrier':buyback_carrier,
                        'buyback_imei':buyback_imei,
                        'buyback_type_and_color':buyback_type_and_color,
                        'buyback_memory':buyback_memory,
                        'buyback_keep_this_on':buyback_keep_this_on,
                        'buyback_condition':buyback_condition,
                        'buyback_price':buyback_price,
                        'buyback_payment_method':buyback_payment_method,
                        '_token':csrftLarVe},
                    'success': function (data) {
                        //tmp = data;
                        if(data.status==0)
                        {
                            $("#buybackMSG").html(warningMessage(data.msg));
                        }
                        else if(data.status==1)
                        {
                            $("#buybackMSG").html(successMessage("buyback info successfully Saved."));

                            console.log("buyback info successfully Saved.");

                            $("select[name=buyback_customer_id]").val('').select2();
                            $("input[name=buyback_model]").val("");
                            $("input[name=buyback_carrier]").val("");
                            $("input[name=buyback_imei]").val("");
                            $("input[name=buyback_type_and_color]").val("");
                            $("input[name=buyback_memory]").val("");
                            $("select[name=buyback_keep_this_on]").val('').select2();
                            $("input[name=buyback_condition]").val("");
                            $("input[name=buyback_price]").val("0");
                            $("select[name=buyback_payment_method]").val('').select2();
                        }
                        else
                        {
                            $("#buybackMSG").html(warningMessage("Something Went Wrong, Please reload Page & Try again."));
                        }
                        

                        $("#buyback").animate({ scrollTop: 0 }, "slow");
                    }
                 });
                 //------------Ajax Instore Repair Product End---------------//
            });

	});