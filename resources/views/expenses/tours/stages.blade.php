@extends('layouts.master')
@section('content')
	<main class="app-content">	
		@if($message = Session::get('success'))
			<div class="alert alert-success">
				{{$message}}
			</div>
		@endif 
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<div class="card shadow-xs">
					<div class="card-body">
						<h1 style="font-size: 20px">Tour Details</h1>
						<hr>
						<div class="">
							<form action="" class="row">
								<div class="form-group col-sm-6 col-xs-12">
							    <fieldset disabled="">
							      <label class="control-label" for="disabledInput">Employee</label>
							      <input class="form-control" type="text" disabled="" value="{{$tour->employee->emp_name}}">
							    </fieldset>
							  </div>
								 <div class="form-group col-sm-6 col-xs-12">
							    <fieldset disabled="">
							      <label class="control-label" for="disabledInput">Purpose</label>
							      <input class="form-control" type="text" disabled="" value="{{$tour->purpose}}">
							    </fieldset>
							  </div>
							  <div class="form-group col-sm-6 col-xs-12">
							    <fieldset disabled="">
							      <label class="control-label" for="disabledInput">Company</label>
							      <input class="form-control" type="text" disabled="" value="{{$tour->company->comp_name}}">
							    </fieldset>
							  </div>
							  <div class="form-group col-sm-6 col-xs-12">
							    <fieldset disabled="">
							      <label class="control-label" for="disabledInput">Advance Amount</label>
							      <input class="form-control" type="text" disabled="" value="{{$tour->adv_amt}}">
							    </fieldset>
							  </div>
							  <div class="form-group col-sm-6 col-xs-12">
							    <fieldset disabled="">
							      <label class="control-label" for="disabledInput">Start Location</label>
							      <input class="form-control" type="text" disabled="" value="{{$tour->start_loc}}">
							    </fieldset>
							  </div>
							  <div class="form-group col-sm-6 col-xs-12">
							    <fieldset disabled="">
							      <label class="control-label" for="disabledInput">End Location</label>
							      <input class="form-control" type="text" disabled="" value="{{$tour->end_loc}}">
							    </fieldset>
							  </div>
							  <div class="form-group col-sm-6 col-xs-12">
							    <fieldset disabled="">
							      <label class="control-label" for="disabledInput">Note</label>
							      <textarea class="form-control" type="text" disabled="">{{$tour->note}}</textarea>
							    </fieldset>
							  </div>
							</form>
						</div>
						<div class="text-right">
							@if($actions['approve'])
							<span class="">
									<a href="{{route('tour.approve',$tour->id)}}" class="btn btn-sm btn-success">
										<i class="fa fa-check-square-o" style="font-size: 12px;"></i>Approve
									</a>
							</span>
							@endif
							@if($actions['delete'])
							<span class="ml-2">
									<a href="#" class="btn btn-sm btn-danger">
										<i class="fa fa-trash" style="font-size: 12px;"></i>Delete
									</a>
							</span>
							@endif
							@if($actions['hold'])
							<span class="ml-2">
									<a href="#" class="btn btn-sm btn-primary">Hold</a>
							</span>
							@endif
							@if($actions['start'])
							<span class="ml-2">
									<a href="{{route('tour.start',$tour->id)}}" class="btn btn-sm btn-info">Start Tour</a>
							</span>
							@endif
							@if($actions['end'])
							<span class="ml-2">
									<a href="#" class="btn btn-sm btn-secondary">End Tour</a>
							</span>
							@endif
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-md-12 col-xl-12">
				<div class="card shadow-xs">
					<div class="card-body">
						<div class="card-body table-responsive">
						<h1 style="font-size: 20px">Tour Stages</h1>
						<table class="table table-striped table-bordered mt-4">
							<thead>
								<tr>
									<th>ID</th>
									<th>Note</th>
									<th>Status</th>
									<th>Created At</th>
								</tr>
							</thead>
							<tbody>
								@foreach($tour->stages as $stage)
								<tr>
									<td>{{$stage->id}}</td>
									<td>{{$stage->note}}</td>
									<td>{{$stage->status_info->title}}</td>
									<td>{{$stage->created_at}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>
		</div>

	</main>
	<style>
	.table th, .table td {
    padding: .39rem!important;
  }
  .form-control:disabled, .form-control[readonly] {
    background-color: #6b5e5e14;
    opacity: 1;
	}	
	</style>
@endsection