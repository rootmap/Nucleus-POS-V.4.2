<script type="text/javascript">

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
             var AddHowMowKhaoUrl="{{url('settings/tax/settype')}}";
             $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': AddHowMowKhaoUrl,
                'data': {'setTaxType':taxType,'_token':"{{csrf_token()}}"},
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
</script>