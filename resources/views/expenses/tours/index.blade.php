<?php
//This function will fetch all rows of stages and return latest stages(the stage having largest id is latest)
function fetch_status($stages){
	$index = -1;  //-1 because the index can be 0
	foreach($stages as $k=>$v){
		if($index < $v->id){
			$index = $k;
		}
	}
	return $index < 0 ? 'NULL' : $stages[$index]->status_info->title;
}
?>
@extends('layouts.master')
@section('content')
	<main class="app-content">	
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 20px">Tours
					<span class="ml-2">
						<a href="{{route('tours.create')}}" class="btn btn-sm btn-success" style="font-size: 13px">
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
		@elseif($message = Session::get('error'))
			<div class="alert alert-danger">
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
									<th>Company Code</th> 
									<th>Employee Name</th>
									<th>Purpose</th>
									<th>Advance amount</th>
									<th>Start Location</th>
									<th>End Location</th>
									<th>Note</th>
									<th>Created At</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($tours as $tour)
								<tr>
									<td>{{$tour->id}}</td>
									<td>{{$tour->company->comp_name}}</td>
									<td>{{$tour->employee->emp_name}}</td>
									<td>{{$tour->purpose}}</td>
									<td><i class="fa fa-inr"></i> {{$tour->adv_amt}} /-</td>
									<td>{{$tour->start_loc}}</td>
									<td>{{$tour->end_loc}}</td>
									<td>{{$tour->note}}</td>
									<td>{{$tour->created_at}}</td>
									<td><?php print_r(fetch_status($tour->stages)) ?></td>
									<td class="d-flex" style="border-bottom: 0;">
										{{-- <span class="">
												<a href="{{route('tours.edit',$tour->id)}}" title="Edit" class="btn btn-sm btn-success"><i class="fa fa-edit text-white" style="font-size: 12px;"></i></a>
													<a href="#" title="Edit" class="btn btn-sm btn-success"><i class="fa fa-edit text-white" style="font-size: 12px;"></i></a>
										</span> --}}
										<span class="ml-2">
												<a href="{{route('tour.show_stages',$tour->id)}}" class="btn btn-sm btn-info"><i class="fa fa-question-circle" style="font-size: 12px;"></i></a>
										</span>
									{{-- 	<span class="ml-2">
											<form  action="{{route('tours.destroy',$tour->id)}}" method="POST" id="delform_{{ $tour->id}}">
													@csrf
												@method('DELETE')
												<a title="Delete" href="javascript:$('#delform_{{ $tour->id}}').submit();" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash text-white"  style="font-size: 12px;"></i></a>
										
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