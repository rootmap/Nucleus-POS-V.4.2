@extends('apps.layout.master')
@section('title','Developer Console')
@section('content')
<section id="form-action-layouts">
	<div class="row">
		<div class="col-md-8 offset-md-2">
	        <div class="card">

	 
	            <div class="card-header">
	                <h4 class="card-title" id="striped-label-layout-card-center">Developer Console</h4>
	                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
        			<div class="heading-elements">
	                    <ul class="list-inline mb-0">
	                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
	                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
	                    </ul>
	                </div>
	            </div>
	            <div class="card-body collapse in">
	                <div class="card-block">
	                	<form method="post" action="javascript:submitForm();">
	                		<input type="text" name="card" id="card">
	                		<button type="submit">Test</button>
	                	</form>
						

						</div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

</section>
@endsection

@section('js')
	<script type="text/javascript">
		function submitForm()
		{
			console.log('Key form',1);
			return false;
		}

		$(document).ready(function(){
			$("#card").keyup(function(){
				console.log('Key',$(this).val());
			});
		});
	</script>
@endsection