@extends('layouts.master')

@section('content')

	<main class="app-content">
		<div class="app-title">
			<div class="div">
				<h1><i class="fa fa-laptop"></i> Tender Items</h1>
			</div>
			<ul class="app-breadcrumb breadcrumb">
				<span class="ml-2">
					<a href="{{route('tender_item.create')}}" class="btn btn-outline-success">
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
									<th>SNo.</th>
									<th>Name</th>
									<th>Unit Name</th>
									<th>Remarks</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@php $count = 0; @endphp
								@foreach($item as $items)
									<tr class="text-center">
										<td>{{++$count}}</td>
										<td>{{$items->name}}</td>
										<td>{{$items->unit->name}}</td>
										<td>{{$items->remarks}}</td>			
										<td>
										<span>
											<a href="{{route('tender_item.edit',$items->id)}}" class="btn btn-sm btn-outline-warning fa fa-edit"></a>
										</span>
										<span class="ml-2">
										<a href="{{url('tender_item_delete',$items->id)}}" class="btn btn-sm btn-outline-danger fa fa-trash" onclick="return confirm('Are you sure?')"></a>
										
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