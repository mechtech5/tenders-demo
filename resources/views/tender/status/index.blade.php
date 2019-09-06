@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 20px">Tender Status
					<span class="ml-2">
						<a href="{{route('tender_status.create')}}" class="btn btn-sm btn-success" style="font-size: 13px">
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
									<th>Name</th>
									<th>Description</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							@foreach($tender_statuses as $tender_status)
							<tr>
								<td>{{$tender_status->id}}</td>
								<td>{{$tender_status->status_name}}</td>
								<td>{{$tender_status->status_desc}}</td>
								<td class="d-flex">
										<span>
												<a href="{{route('tender_status.edit',$tender_status->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit text-white" style="font-size: 12px;"></i></a>
										</span>
										<span class="ml-2">
											<form  action="{{route('tender_status.destroy',$tender_status->id)}}" method="POST" id="delform_{{ $tender_status->id}}">
													@csrf
												@method('DELETE')
												<a href="javascript:$('#delform_{{ $tender_status->id}}').submit();" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash text-white"  style="font-size: 12px;"></i></a>
										
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