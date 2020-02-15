<script type="text/javascript">

    $(document).ready(function(){
        $(".warranty").click(function(){

            $("#warranty").modal("show");
            $('select[name=warranty_ex_product_id]').val('').select2();
            $('select[name=warranty_new_product_id]').val('').select2();
            $("#warrantyMSG").html(loadingOrProcessing("Please wait, loading invoices."));

            //------------------------Ajax Customer Start-------------------------//
             var AddHowMowKhaoUrl="{{url('warranty/invoice/ajax')}}";
             $.ajax({
                'async': true,
                'type': "GET",
                'global': true,
                'dataType': 'json',
                'url': AddHowMowKhaoUrl,
                'data': {'_token':"{{csrf_token()}}"},
                'success': function (data) 
                {
                    $("#warrantyMSG").html(successMessage("Invoices loaded successfully, Please select a invoice."));
                    var ff="<option value=''>Select A Invoice</option>";
                    $.each(data,function(index,row){
                        //console.log(row);
                        ff+="<option data-value='"+row.total_amount+"' value='"+row.invoice_id+"'>"+row.invoice_id+" - "+row.created_at+"</option>";
                    });

                    $("select[name=warranty_sales_invoice_id]").html(ff);
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
             var AddHowMowKhaoUrl="{{url('warranty/invoice/product/ajax')}}";
             $.ajax({
                'async': true,
                'type': "POST",
                'global': true,
                'dataType': 'json',
                'url': AddHowMowKhaoUrl,
                'data': {'invoice_id':invoice_id,'_token':"{{csrf_token()}}"},
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

                        ff="";

                        var fff="<option value=''>Select A New Product</option>";
                        $.each(data.product,function(index,row){
                            //console.log(row);
                            fff+="<option value='"+row.id+"'>"+row.name+"</option>";
                        });

                        $("select[name=warranty_new_product_id]").html(fff);

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
            var postURL="{{url('warranty/cart/add')}}/"+invoice_id;
            $.post(postURL,{'old_product':old_product,'new_product':new_product,'_token':"{{csrf_token()}}"},function(retData){
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
</script>