<script type="text/javascript">

    $(document).ready(function(){
        $("select[name=sales_return_customer_id]").change(function(){

            $("#salesReturnMSG").html(loadingOrProcessing("Please wait, loading customer invoices."));

            var sales_return_customer_id=$(this).val();
            if(sales_return_customer_id.length==0)
            {
                $("#salesReturnMSG").html(warningMessage("Please Select a customer."));
                return false;
            }
            //------------------------Ajax Customer Start-------------------------//
             var AddHowMowKhaoUrl="{{url('sales/return/invoice/ajax')}}";
             $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddHowMowKhaoUrl,
                'data': {'customer_id':sales_return_customer_id,'_token':"{{csrf_token()}}"},
                'success': function (data) 
                {
                    $("#salesReturnMSG").html(successMessage("Customer invoices loaded successfully, Please select a invoice."));
                    var ff="<option value=''>Select A Invoice</option>";
                    $.each(data,function(index,row){
                        //console.log(row);
                        ff+="<option data-value='"+row.total_amount+"' value='"+row.invoice_id+"'>"+row.invoice_id+" - "+row.created_at+"</option>";
                    });

                    $("select[name=sales_return_sales_invoice_id]").html(ff);
                }
            });
            //------------------------Ajax Customer End---------------------------//

        });

        $("select[name=sales_return_sales_invoice_id]").change(function(){
            $("#salesReturnMSG").html(loadingOrProcessing("Please wait, loading customer invoices."));
            var invoice_id=$(this).val();
            if(invoice_id.length==0)
            {
                $("#salesReturnMSG").html(warningMessage("Please Select a Invoice."));
                return false;
            }

            var invoiceAmount=$("select[name=sales_return_sales_invoice_id] option[value="+invoice_id+"]").attr("data-value");
            $("#salesReturnMSG").html(successMessage("Invoice Total Amount Load Successfully."));
            $("input[name=sales_return_sales_amount]").val(invoiceAmount);

        });

        $(".saveSalesReturnSave").click(function(){
            $("#salesReturnMSG").html(loadingOrProcessing("Please wait, Sales Return Information Processing."));

            var customer_id=$("select[name=sales_return_customer_id]").val();
            if(customer_id.length==0)
            {
                $("#salesReturnMSG").html(warningMessage("Please Select a customer."));
                return false;
            }

            var invoice_id=$("select[name=sales_return_sales_invoice_id]").val();
            if(invoice_id.length==0)
            {
                $("#salesReturnMSG").html(warningMessage("Please Select a invoice."));
                return false;
            }

            var sales_amount=$("input[name=sales_return_sales_amount]").val();
            if(sales_amount.length==0)
            {
                $("#salesReturnMSG").html(warningMessage("Please Enter a Sales Amount."));
                return false;
            }

            var return_amount=$("input[name=sales_return_return_amount]").val();
            if(return_amount.length==0)
            {
                $("#salesReturnMSG").html(warningMessage("Please Enter a Return Amount."));
                return false;
            }

            var sales_return_note=$("input[name=sales_return_note]").val();
            if(sales_return_note.length==0)
            {
                $("#salesReturnMSG").html(warningMessage("Please Enter a Sales Return Note."));
                return false;
            }

            //------------------------Ajax Customer Start-------------------------//
             var AddHowMowKhaoUrl="{{url('sales/return/save/ajax')}}";
             $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddHowMowKhaoUrl,
                'data': {
                            'customer_id':customer_id,
                            'invoice_id':invoice_id,
                            'sales_amount':sales_amount,
                            'return_amount':return_amount,
                            'sales_return_note':sales_return_note,
                            '_token':"{{csrf_token()}}"
                        },
                'success': function (data) 
                {
                    if(data==1)
                    {
                        $("#salesReturnMSG").html(successMessage("Customer invoices loaded successfully, Please select a invoice."));
                        $("#salesReturn").modal('hide');
                        $('select[name=sales_return_customer_id]').val('').select2();
                        $('select[name=sales_return_sales_invoice_id]').val('').select2();
                        $('input[name=sales_return_sales_amount]').val('');
                        $('input[name=sales_return_return_amount]').val('');
                        $('input[name=sales_return_note]').val('');
                    }
                    else
                    {
                        $("#salesReturnMSG").html(warningMessage("Failed, Please try again."));
                        return false;
                    }

                }
            });
            //------------------------Ajax Customer End---------------------------//
        });

    });
</script>