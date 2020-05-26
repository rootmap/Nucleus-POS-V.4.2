<script type="text/javascript">
    function liveedit(data)
    {
        //var field=$(data).val();
        //$(data).parent().parent().addClass("has-success");
        //$(data).parent().addClass("form-control-success");
        //$(data).parent().children("span:eq(0)").removeAttr("style");
        $(data).parent().children("span:eq(1)").show();
        $(data).removeAttr("readonly");
        $(data).removeAttr("style");
        $(data).focus();
        //alert(field);
    }

    function livesave(data)
    {
        //$(data).parent().parent().children("span:eq(0)").css("background","white");
        //$(data).parent().parent().children("span:eq(0)").css("border","0px");
        $(data).parent().parent().children("span:eq(1)").hide();
        $(data).parent().parent().children("input").attr("readonly");
        var fieldName=$(data).parent().parent().children("input").attr("name");
        var fieldValue=$(data).parent().parent().children("input").val();
        
        $(data).parent().parent().children("input").css("background","white");
        //$(data).parent().parent().children("input").css("border","0px");
        //console.log($(data).parent().parent().html());

        var dataArray={'fid':fieldName,'fval':fieldValue,'_token':"{{csrf_token()}}"};
        var buyback_id=$("#buyback_id").val();
        var AddProductUrl="{{url('buyback/ajax')}}/"+buyback_id;
        buybackAjacRequest(AddProductUrl,dataArray,dataArray);
    }

    $(document).ready(function(){
        $("select[name=buyback_status_id]").change(function(){
            var buyback_status_id=$(this).val();
            if(buyback_status_id==4)
            {
                $(".invoice_no").show();
            }
            else if(buyback_status_id>4)
            {
                $(".invoice_no").show();
            }
            else
            {
                $(".invoice_no").hide();
            }
        });
    });

    function liveStatusSelectedit(data)
    {
        //var field=$(data).val();
        //$(data).parent().parent().addClass("has-success");
        //$(data).parent().addClass("form-control-success");
        //$(data).parent().children("span:eq(0)").removeAttr("style");
        $(data).parent().children("span:eq(1)").show();
        $(data).removeAttr("readonly");
        $(data).removeAttr("style");
        $(data).hide();
        $(data).parent().children("select").show();
        //alert(field);
    }

    function liveStatusSelectsave(data)
    {
        //$(data).parent().parent().children("span:eq(0)").css("background","white");
        //$(data).parent().parent().children("span:eq(0)").css("border","0px");

        var exData=$(data).parent().parent().children("select").val();
        var exDataText=$(data).parent().parent().children("select").children("option[value="+exData+"]").html();
        //alert(exDataText);
        if(exData==4)
        {
            var invoice_id=$("select[name=invoice_id]").val();
            if(invoice_id.length==0)
            {
                alert("Please Enter Invoice ID");
                return false;
            }
        }
        else
        {
            if(exData>4)
            {
                var invoice_id=$("select[name=invoice_id]").val();
                if(invoice_id.length==0)
                {
                    alert("Please select Invoice & Enter Invoice ID");
                    return false;
                }
            }
        }
        

 

        //$(data).parent().parent().children("input").css("border","0px");
        //console.log($(data).parent().parent().html());
        var fieldOne=$(data).parent().parent().children("select").attr("name");
        var fieldoneValue=$(data).parent().parent().children("select").val();

        var fieldName=$(data).parent().parent().children("input").attr("name");
        var fieldValue=$(data).parent().parent().children("input").val();

        var dataArray={'fid':fieldOne,'fval':fieldoneValue,'fidd':fieldName,'fvall':fieldValue,'_token':"{{csrf_token()}}"};

        if(exData==4)
        {
            var invoice_id=$("select[name=invoice_id]").val();
            dataArray['invoice_id']=invoice_id;
        }
        else
        {
            if(exData>4)
            {
                var invoice_id=$("select[name=invoice_id]").val();
                if(invoice_id.length==0)
                {
                    alert("Please select Invoice & Enter Invoice ID");
                    return false;
                }
                else
                {
                    var invoice_id=$("select[name=invoice_id]").val();
                    dataArray['invoice_id']=invoice_id;
                }
            }
        }

        $(data).parent().parent().children("span:eq(1)").hide();
        $(data).parent().parent().children("input").attr("readonly");
        $(data).parent().parent().children("select").hide();
        $(data).parent().parent().children("input").css("background","white");
        $(data).parent().parent().children("input").show();
        $(data).parent().parent().children("input").val(exDataText);
        $(data).parent().parent().children("input").attr("readonly","readonly");

        var buyback_id=$("#buyback_id").val();
        var AddProductUrl="{{url('buyback/ajax')}}/"+buyback_id;
        buybackAjacRequest(AddProductUrl,dataArray,dataArray);
    }

    function liveselectedit(data)
    {
        //var field=$(data).val();
        //$(data).parent().parent().addClass("has-success");
        //$(data).parent().addClass("form-control-success");
        //$(data).parent().children("span:eq(0)").removeAttr("style");
        $(data).parent().children("span:eq(1)").show();
        $(data).removeAttr("readonly");
        $(data).removeAttr("style");
        $(data).hide();
        $(data).parent().children("select").show();
        //alert(field);
    }

    function liveSelectsave(data)
    {
        //$(data).parent().parent().children("span:eq(0)").css("background","white");
        //$(data).parent().parent().children("span:eq(0)").css("border","0px");

        var exData=$(data).parent().parent().children("select").val();
        var exDataText=$(data).parent().parent().children("select").children("option[value="+exData+"]").html();
        //alert(exDataText);

        $(data).parent().parent().children("span:eq(1)").hide();
        $(data).parent().parent().children("input").attr("readonly");
        $(data).parent().parent().children("select").hide();
        $(data).parent().parent().children("input").css("background","white");
        $(data).parent().parent().children("input").show();
        $(data).parent().parent().children("input").val(exDataText);
        $(data).parent().parent().children("input").attr("readonly","readonly");

        //$(data).parent().parent().children("input").css("border","0px");
        //console.log($(data).parent().parent().html());
        var fieldOne=$(data).parent().parent().children("select").attr("name");
        var fieldoneValue=$(data).parent().parent().children("select").val();

        var fieldName=$(data).parent().parent().children("input").attr("name");
        var fieldValue=$(data).parent().parent().children("input").val();

        var dataArray={'fid':fieldOne,'fval':fieldoneValue,'fidd':fieldName,'fvall':fieldValue,'_token':"{{csrf_token()}}"};
        var buyback_id=$("#buyback_id").val();
        var AddProductUrl="{{url('buyback/ajax')}}/"+buyback_id;
        buybackAjacRequest(AddProductUrl,dataArray,dataArray);
    }

    function buybackAjacRequest(AddProductUrl,dataArray,dataText)
    {
        //---------------------Test Ajax New Product Start---------------------//
        $.ajax({
            'async': true,
            'type': "POST",
            'global': true,
            'dataType': 'json',
            'url': AddProductUrl,
            'data': dataArray,
            'success': function (data) { 
                console.log(dataText,data);
            }
        });
        //-----------------Test Ajax New Product End------------------//
    }
</script>
<script type="text/javascript">
    $(document).ready(function(){
		    //---------------------Test Ajax New Product Start---------------------//
            
            //-----------------Test Ajax New Product End------------------//
	});

</script>