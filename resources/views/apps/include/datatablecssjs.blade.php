@section('css')
	<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
    <style type="text/css">
		div.dataTables_length{
				padding-left: 10px;
				padding-top: 15px;
		}

		.dataTables_length>label{
			margin-bottom: 0px !important;
			display:block; !important;
		}

		div.dataTables_filter
		{
			padding-right: 10px;
		}

		div.dataTables_green{
			padding-left: 10px;
		}

		div.dataTables_paginate{
			padding-right: 10px;
			padding-top: 5px;
		}
	</style>

	@if(isset($selectTwo))
    	<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/forms/selects/select2.min.css')}}">
    @endif

    @if(isset($dateDrop))
    	<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/extensions/pace.css')}}">
    	<link rel="stylesheet" type="text/css" href="{{url('theme/app-assets/vendors/css/extensions/datedropper.min.css')}}">
    @endif
	
@endsection

@section('js')
	
	@if(isset($invoiceSlip))
	<script type="text/javascript">
		function putInvoiceModal(invNo)
		{
			$(".invoice_slip_id").val(invNo);
			$("#slip").modal('show');
		}
	</script>
	@endif
	
	@if(isset($storecloseDetailReport))
    	<script type="text/javascript">
    		function openCloseStoreInfo(closingID)
    		{
    			//------------------------Ajax New Product Start-------------------------//
	            var AddProductUrl="{{url('storeclose/detail')}}";
	            $.ajax({
	                'async': true,
	                'type': "POST",
	                'global': false,
	                'dataType': 'json',
	                'url': AddProductUrl,
	                'data': {'storecloseid':closingID,'_token':"{{csrf_token()}}"},
	                'success': function (data) { 
	                    console.log("Assigning Discount : "+data);
	                    $("#storeOpenDate").html(formatDateTime(data.OpenDate));
	                    $("#storeCloseDate").html(formatDateTime(data.CloseDate));
	                    $("#storeCloseTotalCollection").html(number_format(data.totalCollection));
	                    $("#storeCloseOpeningAmount").html(number_format(data.openingAmount));
	                    $("#totalPayout").html(number_format(data.payout));
	                    $("#storeCloseTaxAmount").html(number_format(data.tax));
	                    $("#currectStoreTotal").html(number_format(data.netTotal));
	                    $("#buybackStoreClosingAmount").html(number_format(data.buyback));

	                    var tenderData=data.tnderData;

	                    var htmlStr="";
	                    if(tenderData.length)
	                    {
	                    	
	                    	$.each(tenderData,function(index,row){
	                    		htmlStr +='<tr><td align="left">'+row.tender_name+' (+) :  </td><td align="left">$'+number_format(row.tender_total)+'</td></tr>';
	                    	});

	                    }
	                    $("#storeCloseTableTenderList").html(htmlStr);
	                }
	            });
	            //------------------------Ajax New Product End---------------------------//
    			$("#close-drawer-detail").modal('show');
    		}
    		$(document).ready(function(){
    			
    		});
    	</script>
    @endif

	@if(isset($barcodejs))
		<script type="text/javascript">
		function generateBarcode(barcode){
           	//alert(barcode);
           	$("input[name=barcode]").val(barcode);
           	$("#barcodeCreate").modal("show");
		}			
		</script>


    	@include('apps.include.json.barcode')
    @endif  

	<script type="text/javascript">
    	$(document).ready(function(){
    		$(".change-action").click(function(){
				var getURL=$(this).attr("data-url");
				console.log(getURL);
				//return false;

				$("form").attr("action",getURL);
				//console.log($("select[name=customer_id]").val());
				
				$("button[type=submit]").click();
			});
    	});
    </script>

    <script type="text/javascript">
    	$(document).ready(function(){
    		$(".change-action-export-sales").click(function(){
				var getURL=$(this).attr("data-url");
				console.log(getURL);
				//return false;

				$("#salesSu").attr("action",getURL);
				//console.log($("select[name=customer_id]").val());
				
				$("#salesSUSub").click();
			});
    	});
    </script>

	@if(isset($selectTwo))
    	<script src="{{url('theme/app-assets/vendors/js/forms/select/select2.full.min.js')}}" type="text/javascript"></script>
		<script src="{{url('theme/app-assets/js/scripts/forms/select/form-select2.min.js')}}" type="text/javascript"></script>
    @endif

    @if(isset($dateDrop))
    	<script src="{{url('theme/app-assets/vendors/js/extensions/pace.min.js')}}" type="text/javascript"></script>
	    <!-- /build-->
	    <!-- BEGIN VENDOR JS-->
	    <!-- BEGIN PAGE VENDOR JS-->
	    <script src="{{url('theme/app-assets/vendors/js/extensions/datedropper.min.js')}}" type="text/javascript"></script>
	    <!-- END PAGE VENDOR JS-->

	    <!-- BEGIN PAGE LEVEL JS-->
	     <script type="text/javascript">
			$(document).ready(function() {
			    $(".DropDateWithformat").dateDropper({
			        dropWidth: 200,
			        maxYear: "<?=date('Y')?>",
			        minYear: "2010",
			        format: "Y-m-d",
			        init_animation: "bounce",
			        dropPrimaryColor: "#fa4420",
			        dropBorder: "1px solid #fa4420",
			        dropBorderRadius: "20",
			        dropShadow: "0 0 10px 0 rgba(250, 68, 32, 0.6)"
			    });
			});
	    </script>
	    <!-- END PAGE LEVEL JS-->
    @endif
	
    <script src="{{url('theme/app-assets/vendors/js/tables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js')}}" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{url('theme/app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}" type="text/javascript"></script>


    <!-- END PAGE LEVEL JS-->
    <script type="text/javascript">
    	function formatDate(data){
    		if(data !== undefined){
    			if(data=="0000-00-00"){
    				return "00/00/0000";
    			}else{
    				if(data.length==0){
		    			return "";
		    		}else{
		    			var d = new Date(data),
				        month = '' + (d.getMonth() + 1),
				        day = '' + d.getDate(),
				        year = d.getFullYear();

				    	if (month.length < 2) month = '0' + month;
				    	if (day.length < 2) day = '0' + day;

			    		return [month, day, year].join('/');
		    		}
    			}
	    		
    		}else{
    			return "";
    		}
    	}

    	function formatDateTime(data){
    		if(data !== undefined){
    			if(data=="0000-00-00 00:00:00"){
    				return "00/00/0000 00:00:00";
    			}else{
    				if(data.length==0){
		    			return "00/00/0000 00:00:00";
		    		}else{
		    			var d = new Date(data),
				        month = '' + (d.getMonth() + 1),
				        day = '' + d.getDate(),
				        year = d.getFullYear();


				        hour = d.getHours(),
				        minute = d.getMinutes(),
				        second = d.getSeconds();

				    	if (month.length < 2) month = '0' + month;
				    	if (day.length < 2) day = '0' + day;


				    	if (hour.length < 2) hour = '0' + hour;
				    	if (minute.length < 2) minute = '0' + minute;
				    	if (second.length < 2) second = '0' + second;



			    		return [month, day, year].join('/')+" "+[hour, minute, second].join(':');
		    		}
    			}
	    		
    		}else{
    			return "";
    		}
    	}

    	function number_format(str){
    		/*var drt=0;
    		drt=str.trim();
    		drt=drt.toString();*/

    		if(str==null){
    			str="0";
    		}

    		if(str !== undefined){
    			/*if(str=="0"){
    				return "0.00";
    			}else{
    				str.toFixed(2);
    			}*/
    			return parseFloat(str).toFixed(2)
    			//return drt;
    		}
    		else{
    			return "0.00";
    		}
    		
    	}
    </script>
@endsection