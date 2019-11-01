@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 24px">Approval Permissions
					<span class="ml-2">
						<a href="{{route('permissions.create')}}" class="btn btn-sm btn-success" style="font-size: 13px">
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
									<th>Role Name</th>
									<th>Can Approve</th>
									<th>Can Decline</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							@foreach($approval_index as $index)
								<tr>
									<td>{{$index->id}}</td>
									<td>{{$index->designation->name}}</td>
									<td>{{$index->approve == 1 ? 'Yes' : 'No'}}</td>
									<td>{{$index->decline == 1 ? 'Yes' : 'No'}}</td>
									<td class='d-flex'>
										<span>
											<a href="{{route('approvals.edit',$approval->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit text-white" style="font-size: 12px;"></i></a>
										</span>
										<span class="ml-2">
											<form action="" method="POST" id="delform_">
												@csrf
												@method('DELETE')
												<a href="javascript:$('#delform_').submit();" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash text-white"  style="font-size: 12px;"></i></a>			
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