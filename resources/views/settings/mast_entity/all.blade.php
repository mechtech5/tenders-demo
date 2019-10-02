@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="app-title">
			<div class="div">
				<h4><i class="fa fa-asterisk"></i> Entity :  {{ $table_name }}</h4>
			</div>
			<ul class="app-breadcrumb breadcrumb">
				<span class="ml-2">
					<a href="{{ route('mast_entity.get', ['create', $db_table]) }}" class="btn btn-outline-success" style="font-size: 13px">
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
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Description</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							@foreach($data as $row)
							<tr>
								<td>{{$row->id}}</td>
								<td>{{$row->name}}</td>
								<td>{{$row->description}}</td>
								<td class="d-flex">
									<span>
										<a href="{{route('mast_entity.get', ['edit', $db_table, $row->id])}}" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit"></i> Edit</a>
									</span>
									<span class="ml-2">
										<form action="{{route('mast_entity.delete', [$db_table, $row->id])}}" method="POST" id="delform_{{ $row->id}}">
											@csrf
											@method('DELETE')
											<a href="javascript:$('#delform_{{ $row->id }}').submit();" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</a>
										</form>
									</span>
								</td>
							</tr>
							@endforeach
							</tbody>
						</table>

						@php
							//dd($db_table);
						@endphp
					</div>
				</div>
			</div>
		</div>

	</main>
@endsection