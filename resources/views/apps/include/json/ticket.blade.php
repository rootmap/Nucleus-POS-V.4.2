<script type="text/javascript">
	$(document).ready(function(){
		$("select[name=ticket_problem_id]").change(function(){

                	var ticket_problem_id=$(this).val();
                	if(ticket_problem_id=="TP0001")
                	{
                		$(this).parent().children("span").hide();
                		$("input[name=ticket_problem_name]").show();

                	}

                });
	});
</script>