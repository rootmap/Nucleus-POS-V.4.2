<script type="text/javascript">
    $(document).ready(function(){
		    //---------------------Test Ajax New Product Start---------------------//
            $(".barcodeCreate").click(function(){
                
               var barcode=$(this).attr('data-id');
               //alert(barcode);
               $("input[name=barcode]").val(barcode);
               $("#barcodeCreate").modal("show");
            });
            //-----------------Test Ajax New Product End------------------//
	});

</script>