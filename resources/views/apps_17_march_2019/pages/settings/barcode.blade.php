@extends('apps.layout.master')
@section('title','Category Info')
@section('content')
<section id="file-exporaat">

		<div class="row">
		<div style="margin: 0 auto; width: 50%;">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-card-center">
						<i class="icon-barcode"></i> Print Barcode
					</h4>
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
						<form class="form" method="post" action="{{url('genarate/barcode')}}">
							<div class="form-body">
								{{ csrf_field() }}
								<div class="form-group">
									<label for="eventRegInput1">Barcode No <span class="text-danger">*</span></label>
									<input type="text" id="eventRegInput1" class="form-control border-green"  autocomplete="off"  placeholder="Barcode No" name="barcode">
								</div>							
							</div>

							<div class="form-body">
								<div class="form-group">
									<label for="eventRegInput1">Quantity <span class="text-danger">*</span></label>
									<input type="number" id="eventRegInput1" class="form-control border-green"  autocomplete="off"  placeholder="Quantity" name="quantity">
								</div>							
							</div>

							<div class="form-actions center">
								<button type="submit" class="btn btn-green btn-darken-2">
									<i class="icon-barcode"></i> Genarate
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
	</div>

	


</section>
@endsection

@include('apps.include.datatable',['JDataTable'=>1])