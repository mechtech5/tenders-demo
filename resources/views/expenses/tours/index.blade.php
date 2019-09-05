@extends('layouts.master')
@section('content')
<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 24px">Tours
					<span class="ml-2">
						<a href="{{route('tours.create')}}" class="btn btn-sm btn-success" style="font-size: 13px">
							<span class="fa fa-plus "></span> Add New</a>
					</span>
					<span class="ml-2">
						<button  class="btn btn-sm btn-info"  data-toggle="modal" data-target="#import-modal" style="font-size:13px">
							<span class="fa fa-upload"></span> Import
						</button>
					</span>
					<span class="ml-2">
						<a href="#" class="btn btn-sm btn-primary" style="font-size:13px">
							<span class="fa fa-download"></span> Export
						</a>
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
				<div class="card">
					<div class="card-body table-responsive">
						<table class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>Company</th>
									<th>Employee</th>
									<th>Purpose</th>
									<th>Current Stage</th>
									<th>Advance Amount</th>
									<th>Start Location</th>
									<th>End Location</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Note</th>
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
									<td>{{$tour->current_stage_info->title}}</td>
									<td><i class="fa fa-inr mr-1"> </i>{{$tour->adv_amt}}</td>
									<td>{{$tour->start_loc}}</td>
									<td>{{$tour->end_loc}}</td>
									<td>{{$tour->start_date}}</td>
									<td>{{$tour->end_date}}</td>
									<td>{{$tour->note}}</td>
									<td class='d-flex' style="border-bottom: 0">
										<span>
												<a href="{{route('tour.tour_stages',$tour->id)}}" class="btn btn-sm btn-info"><i class="fa fa-question-circle text-white" style="font-size: 12px;"></i></a>
										</span>
										<span class="ml-2">
											<form action="{{route('tours.destroy',$tour->id)}}" method="POST" id="delform_{{ $tour->id}}">
													@csrf
													@method('DELETE')
												<a href="javascript:$('#delform_{{$tour->id}}').submit();" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash text-white"  style="font-size: 12px;"></i></a>			
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