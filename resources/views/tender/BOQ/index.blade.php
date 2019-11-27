@extends('layouts.master')

@section('content')

	<main class="app-content">
		<div class="app-title">
			<div class="div">
				<h1><i class="fa fa-laptop"></i> Tenders BOQ Creation</h1>
			</div>
			<ul class="app-breadcrumb breadcrumb">
				<span class="ml-2">
					<a href="{{route('tender_boq.create')}}" class="btn btn-outline-success">
					<span class="fa fa-plus"></span> Add New</a>
				</span>
			</ul>
		</div>
		
		@if($message = Session::get('success'))
			<div class="alert alert-success">
				{{$message}}
			</div>
		@endif 
		@if($message = Session::get('error'))
			<div class="alert alert-danger">
				{{$message}}
			</div>
		@endif 
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<div class="card shadow-xs">
					
					<div class="card-body table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr class="text-center">
									<th>Tender No.</th>
									<th>Name</th>
									<th>Category</th>
									<th>Type</th>
									<th>Publish Date</th>
									<th>Priority</th>
									<th>Eligible?</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							
							<tr class="text-center">
							
							</tr>
							
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

	</main>
@endsection

@push('scripts')
	<script src="{{ asset('themes/vali/js/plugins/bootstrap-datepicker.min.js') }}"></script>
	<script>
		$('#demoDate1').datepicker({
			format: "dd/mm/yyyy",
			autoclose: true,
			todayHighlight: true
		});
		$('#demoDate2').datepicker({
			format: "dd/mm/yyyy",
			autoclose: true,
			todayHighlight: true
		});
	</script>
@endpush