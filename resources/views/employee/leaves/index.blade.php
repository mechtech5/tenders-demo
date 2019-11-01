@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 24px">Leaves
					<span class="ml-2">
						<button  class="btn btn-sm btn-info"  data-toggle="modal" data-target="#import-modal" style="font-size:13px">
							{{-- <span class="fa fa-upload"> --}}</span>
							<form action="{{route('employees.import')}}" method="POST" enctype="multipart/form-data">
								@csrf
								<input type="file" onchange="this.form.submit()" name="import" class="hidden">
							</form>
						</button>
					</span>
					<span class="ml-2">
						<a href="{{route('employees.export')}}" class="btn btn-sm btn-primary" style="font-size:13px">
							<span class="fa fa-download"></span> Export
						</a>
					</span>
					<span class="ml-2" style="float: right">
						<a href="{{url('employee/leaves/create')}}" class="btn btn-sm btn-success" style="font-size: 13px">
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
				<div class="card">
			{{--<div class="card-header">
					<ul class="nav nav-pills">
					  <li class="nav-item">
					    <a class="nav-link {{call_user_func_array('Request::is', (array)['*/employees']) ? 'active' : ''}}" href="{{route('employees.index')}}">Active Employees</a>
					  </li>
					  <li class="nav-item">
					    <a class="nav-link {{call_user_func_array('Request::is', (array)['*inactiveEmployees*']) ? 'active' : ''}}"  href="{{route('employees.inactiveEmployees')}}">Inactive Employees</a>
					  </li>
					</ul>
				</div>--}}
					<div class="card-body table-responsive">
						<table class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>#</th>
									<th>Leave Type</th>	
									<th>Leave starts</th>
									<th>Leave ends</th>
									<th>Duration</th>
									<th>Status</th>
									<th>Posted on</th>
									{{-- <th>Approver Remark</th> --}}
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							@foreach($employee->leaveapplies as $leaveapply)
							<tr>
								<td>#</td>
								<td>{{$leaveapply['leavetype']->name}}</td>
								<td>{{date('d M Y' , strtotime($leaveapply->from))}}</td>
								<td>{{date('d M Y' , strtotime($leaveapply->to))}}</td>
								<td>1 day</td>
								@if($leaveapply->status == 1)
									<td>Approved</td>
								@elseif($leaveapply->status == 2)
								<td>Declined</td>
								@elseif($leaveapply->status == 3)
								<td>Hold</td>
								@else
								<td>Pending</td>
								@endif
								{{-- <td>{{ $leaveapply->status }}</td> --}}
								<td>{{date('d M Y' , strtotime($leaveapply->created_at))}}</td>
								
								@if(!($leaveapply->status == 1 || $leaveapply->status == 2 || $leaveapply->status == 3 ))
								<td class='d-flex' style="border-bottom:none">
									<span>
										<a href="{{route('leaves.edit',$employee->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit text-white" style="font-size: 12px;"></i></a>
									</span>
									<span class="ml-2">
										<a href="{{url('employee/leaves/'.$employee->id)}}" class="btn btn-sm btn-info"><i class="fa fa-eye text-white" style="font-size: 12px;"></i></a>
									</span>
									<span class="ml-2">
										<form action="{{route('employees.destroy',$employee->id)}}" method="POST" id="delform_{{ $employee->id}}">
												@csrf
												@method('DELETE')
											<a href="javascript:$('#delform_{{$employee->id}}').submit();" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash text-white"  style="font-size: 12px;"></i></a>
										</form>
									</span> 
								</td>
								@endif
								</tr>
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