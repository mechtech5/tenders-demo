@extends('layouts.master')

@push('styles')
	<link rel="stylesheet" href="{{ asset('themes/vali/css/') }}">
@endpush

@section('content')
	<main class="app-content">
		<div class="app-title">
			<div class="div">
				<h1><i class="fa fa-laptop"></i> Tenders</h1>
			</div>
			<ul class="app-breadcrumb breadcrumb">
				<span class="ml-2">
					<a href="{{route('tender_responsible.create')}}" class="btn btn-outline-success">
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
						<table  class="table table-stripped table-bordered">
							<thead>
								<tr class="text-center">
									<th>SoNo.</th>
									<th>Name</th>								
									<th>Email</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@php $count = 0; @endphp
								@foreach($respons as $repon)
									<tr>
										<td>{{++$count}}</td>
										<td>{{$repon->name}}</td>										
										<td>{{$repon->email}}</td>
										<td class="d-flex">
											<span>
											<a href="{{route('tender_responsible.edit',$repon->id)}}" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit"></i> Edit</a>
											</span>
											<span class="ml-2">
											<a href="{{url('responsible_delete',$repon->id)}}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</a>									
											</span>
										</td>
									</tr>
								@endforeach	
								
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