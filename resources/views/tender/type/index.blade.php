@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="app-title">
			<div class="div">
				<h1><i class="fa fa-laptop"></i> Tender Type</h1>
			</div>
			<ul class="app-breadcrumb breadcrumb">
				<span class="ml-2">
					<a href="{{route('tender_type.create')}}" class="btn btn-outline-success" style="font-size: 13px">
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
		<div class="row ">
			<div class="col-md-12 col-xl-12">
				<div class="card shadow-xs">
					
					<div class="card-body table-responsive">
						<table class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Description</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							@foreach($tender_types as $tender_type)
							<tr>
								<td>{{$tender_type->id}}</td>
								<td>{{$tender_type->name}}</td>
								<td>{{$tender_type->description}}</td>
								<td class="d-flex">
									<span>
										<a href="{{route('tender_type.edit',$tender_type->id)}}" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit"></i> Edit</a>
									</span>
									<span class="ml-2">
										<form  action="{{route('tender_type.destroy',$tender_type->id)}}" method="POST" id="delform_{{ $tender_type->id}}">
												@csrf
											@method('DELETE')
											<a href="javascript:$('#delform_{{ $tender_type->id}}').submit();" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</a>
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