@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 20px">Designations
					<span class="ml-2">
						<a href="{{route('designations.create')}}" class="btn btn-sm btn-success" style="font-size: 13px">
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
									<th>Company Code</th>
									<th>Title</th>
									<th>Description</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($designations as $designation)
								<tr>
									<td>{{$designation->id}}</td>
									<td>{{$designation->company->comp_name}}</td>
									<td>{{$designation->title}}</td>
									<td>{{$designation->description}}</td>
									<td class="d-flex">
										<span>
												<a href="{{route('designations.edit',$designation->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit text-white" style="font-size: 12px;"></i></a>
										</span>
										<span class="ml-2">
											<form  action="{{route('designations.destroy',$designation->id)}}" method="POST" id="delform_{{ $designation->id}}">
													@csrf
												@method('DELETE')
												<a href="javascript:$('#delform_{{ $designation->id}}').submit();" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash text-white"  style="font-size: 12px;"></i></a>
										
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