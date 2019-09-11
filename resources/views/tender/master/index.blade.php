@extends('layouts.master')
@section('content')
<?php
function display_priority_text($int){
	switch($int){
		case 1:
			return 'Very Low';
			break;
		case 2:
			return 'Low';
			break;
		case 3:
			return 'Medium';
			break;
		case 4:
			return 'High';
			break;
		case 5:
			return 'Very High';
			break;
	}
}
function display_priority_class($int){
	switch($int){
		case 1:
			return 'bg-dark';
			break;
		case 2:
			return 'bg-secondary';
			break;
		case 3:
			return 'bg-info';
			break;
		case 4:
			return 'bg-warning';
			break;
		case 5:
			return 'bg-danger';
			break;
	}
}
?>
	<main class="app-content">
		<div class="app-title">
			<div class="div">
				<h1><i class="fa fa-laptop"></i> Tenders</h1>
			</div>
			<ul class="app-breadcrumb breadcrumb">
				<span class="ml-2">
					<a href="{{route('tender_master.create')}}" class="btn btn-outline-success">
					<span class="fa fa-plus"></span> Add New</a>
				</span>
			</ul>
		</div>
		<div class="row">
			<div class="col-2">
				<div class="form-group">
					<select class="form-control" name="" id="">
						<option value="">Category</option>
					</select>
				</div>
			</div>
			<div class="col-2">
				<div class="form-group">
					<select class="form-control" name="" id="">
						<option value="">Type</option>
					</select>
				</div>
			</div>
			<div class="col-2">
				<div class="form-group">
					<select class="form-control" name="" id="">
						<option value="">Priority</option>
					</select>
				</div>
			</div>
			<div class="col-2">
				<div class="form-group">
					<select class="form-control" name="" id="">
						<option value="">Eligibility</option>
					</select>
				</div>
			</div>
			<div class="col-2">
				<div class="form-group">
						<input class="form-control" id="demoDate1" type="text" placeholder="After Date">
				</div>
			</div>
			<div class="col-2">
				<div class="form-group">
						<input class="form-control" id="demoDate2" type="text" placeholder="Before Date">
				</div>
			</div>
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
							@foreach($tenders as $row)
							<tr class="text-center">
								<td>{{$row->id}}</td>
								<td>{{$row->title}}</td>
								<td>{{$row->status->status_name}}</td>
								<td>{{$row->type->type_name}}</td>
								<td>{{$row->created_at}}</td>
								<td class="text-white font-weight-bold {{ display_priority_class($row->priority) }}">
									{{ display_priority_text($row->priority) }}
								</td>
								<td class="text-white font-weight-bold {{ $row->is_eligible == 1 ? 'bg-success' : 'bg-danger' }}">
									{{ $row->is_eligible == 1 ? 'Yes' : 'No' }}
								</td>
								<td class="d-flex">
									<span>
										<a href="{{route('tender_master.show',$row->id)}}" class="btn btn-sm btn-outline-primary">View Details</a>
									</span>
									{{-- <span>
										<a href="{{route('tender_master.edit',$row->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit text-white" style="font-size: 12px;"></i></a>
									</span> --}}
									{{-- <span class="ml-2">
										<a href="{{route('tender_master.show',$row->id)}}" class="btn btn-sm btn-info"><i class="fa fa-eye text-white" style="font-size: 12px;"></i></a>
									</span> --}}
									{{-- <span class="ml-2">
										<form  action="{{route('tender_master.destroy',$row->id)}}" method="POST" id="delform_{{ $row->id}}">
												@csrf
											@method('DELETE')
											<a href="javascript:$('#delform_{{ $row->id}}').submit();" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash text-white"  style="font-size: 12px;"></i></a>
										</form>
									</span> --}}
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