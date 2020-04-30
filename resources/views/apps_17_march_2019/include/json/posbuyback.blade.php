<script type="text/javascript">
    $(document).ready(function(){
        $(".buybackpull").click(function(){
            $("#buyback").modal("show");



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

                var AddPOSUrl="{{url('buyback/pos/ajax')}}";
                 $.ajax({
                    'async': true,
                    'type': "POST",
                    'global': true,
                    'dataType': 'json',
                    'url': AddPOSUrl,
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
                        '_token':"{{csrf_token()}}"},
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

</script>