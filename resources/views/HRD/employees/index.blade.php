@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 24px">Employees
					<span class="ml-2">
						<button  class="btn btn-sm btn-info"  data-toggle="modal" data-target="#import-modal" style="font-size:13px">
							{{-- <span class="fa fa-upload"> --}}</span>
							<form action="{{route('employees.import')}}" method="POST" enctype="multipart/form-data">
								@csrf
								<input type="file" onchange="this.form.submit()" name="import">
							</form>
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
		@if($message = Session::get('success'))
			<div class="alert alert-success">
				{{$message}}
			</div>
		@endif 
			<div class="row ">
			<div class="col-md-12 col-xl-12">
				<div class="card">
			{{-- 	<div class="card-header">
					<ul class="nav nav-pills">
					  <li class="nav-item">
					    <a class="nav-link {{call_user_func_array('Request::is', (array)['*/employees']) ? 'active' : ''}}" href="{{route('employees.index')}}">Active Employees</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link {{call_user_func_array('Request::is', (array)['*inactiveEmployees*']) ? 'active' : ''}}"  href="{{route('employees.inactiveEmployees')}}">Inactive Employees</a>
					  </li>
					</ul>
				</div> --}}
					<div class="card-body table-responsive">
						<table class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>Employee ID</th>
									<th>Employee Name</th>
									<th>Employee Code</th>									
									<th>Company Name</th>
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
									<td>{{$employee->id}}</td>
									<td>{{$employee->emp_name}}</td>
									<td>{{$employee->emp_code}}</td>
									<td>@if($employee->company!=null) {{$employee->company->comp_name}} @endif</td>
									<td>@if($employee->grade!=null) {{$employee->grade->name}} @endif</td>
									<td>{{$employee->emp_gender}}</td>
									<td>{{$employee->dobFormated($employee->emp_dob)}}</td>
									<td>{{$employee->designation['desg_name']}}</td>
									<td>{{$employee->active ==1 ? 'Active' : 'Inactive'}}</td>
									<td class='d-flex' style="border-bottom:none">
										<span>
												<a href="{{route('employees.edit',$employee->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit text-white" style="font-size: 12px;"></i></a>
										</span>
										<span class="ml-2">
												<a href="{{route('employee.show_page',['id'=>$employee->id,'tab'=>'official'])}}" class="btn btn-sm btn-info"><i class="fa fa-eye text-white" style="font-size: 12px;"></i></a>
										</span>
										<span class="ml-2">
											<form action="{{route('employees.destroy',$employee->id)}}" method="POST" id="delform_{{ $employee->id}}">
													@csrf
													@method('DELETE')
												<a href="javascript:$('#delform_{{$employee->id}}').submit();" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash text-white"  style="font-size: 12px;"></i></a>			
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