@extends('layouts.master')
@section('content')
<?php
function display_priority($int){
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
?>
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 20px">Tenders
					<span class="ml-2">
						<a href="{{route('tender_master.create')}}" class="btn btn-sm btn-success" style="font-size: 13px">
							<span class="fa fa-plus "></span> Add New</a>
					</span>
					
				</h1>
				<hr>
			</div>
		</div>
		@if($message = Session::get('success'))
			<div class="alert alert-success">
				{{$message}}
			</div>
		@endif 
		<div class="row ">
			<div class="col-md-12 col-xl-12">
				<div class="card shadow-xs">
					
					<div class="card-body table-responsive">
						<table class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>Account Code</th>
									<th>Title</th>
									<th>Is eligible</th>
									<th>Status</th>
									<th>Type</th>
									<th>Priority</th>
									<th>Created At</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							@foreach($tenders as $row)
							<tr>
								<td>{{$row->id}}</td>
								<td>{{$row->account_code}}</td>
								<td>{{$row->title}}</td>
								<td>{{$row->is_eligible == 1 ? 'Yes' : 'No'}}</td>
								<td>{{$row->status->status_name}}</td>
								<td>{{$row->type->type_name}}</td>
								<td>{{ display_priority($row->priority) }}</td>
								<td>{{$row->created_at}}</td>
								<td class="d-flex">
										<span>
												<a href="{{route('tender_master.edit',$row->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit text-white" style="font-size: 12px;"></i></a>
										</span>
										<span class="ml-2">
											<form  action="{{route('tender_master.destroy',$row->id)}}" method="POST" id="delform_{{ $row->id}}">
													@csrf
												@method('DELETE')
												<a href="javascript:$('#delform_{{ $row->id}}').submit();" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash text-white"  style="font-size: 12px;"></i></a>
											</form>
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