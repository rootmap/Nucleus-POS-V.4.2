<script type="text/javascript">
	$(document).ready(function(){
		//---------------------Test Ajax New Product Start---------------------//
            var AddProductUrl="{{url('api/user')}}";
            $.ajax({
                'async': false,
                'type': "GET",
                'global': false,
                'dataType': 'json',
                'url': AddProductUrl,
                'data': {'_token':"{{csrf_token()}}"},
                'success': function (data) { 
                    console.log(data);
                }
            });
            //-----------------Test Ajax New Product End------------------//
	});
</script>