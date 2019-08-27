@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 24px">Emlpoyees
					<span class="ml-2">
						<button  class="btn btn-sm btn-info"  data-toggle="modal" data-target="#import-modal" style="font-size:13px">
							<span class="fa fa-upload"></span> Import
						</button>
					</span>
					<span class="ml-2">
						<a href="{{route('employees.export')}}" class="btn btn-sm btn-primary" style="font-size:13px">
							<span class="fa fa-download"></span> Export
						</a>
					</span>
				</h1>
				<hr>
			</div>
		</div>
			<div class="row ">
			<div class="col-md-12 col-xl-12">
				<div class="card">
					<div class="card-body table-responsive">
						<table class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>Employee ID</th>
									<th>Employee Name</th>
									<th>Employee Code</th>									
									<th>Company Code</th>
									<th>Grade Code</th>
									<th>Gender</th>
									<th>DOB</th>
									<th>Designation</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							@foreach($employees as $employee)
								<tr>
									<td>{{$employee->emp_id}}</td>
									<td>{{$employee->emp_name}}</td>
									<td>{{$employee->emp_code}}</td>
									<td>{{$employee->comp_code}}</td>
									<td>{{$employee->grade_code}}</td>
									<td>{{$employee->emp_gender}}</td>
									<td>{{$employee->emp_dob}}</td>
									<td>{{$employee->emp_desg}}</td>
									<td>{{$employee->active}}</td>
									<td class='d-flex'>
										<span>
												<a href="{{route('employees.edit',$employee->emp_id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit text-white" style="font-size: 12px;"></i></a>
										</span>
										<span class="ml-2">
											<form action="{{route('employees.destroy',$employee->emp_id)}}" method="POST" id="delform_{{ $employee->emp_id}}">
													@csrf
													@method('DELETE')
												<a href="javascript:$('#delform_{{$employee->emp_id}}').submit();" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash text-white"  style="font-size: 12px;"></i></a>			
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