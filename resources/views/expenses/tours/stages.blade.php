@extends('layouts.master')
@section('content')
<?php
function check_visibility($users, $tour, $action){
	$current_stage = $tour->current_stage;
	$detail = array();
	foreach($tour->activity->approval->details as $row){
		if($current_stage == $row->id){
			$detail = JSON_decode($row);
		}
	}
	$allowed_emp = json_decode($detail->$action);
	foreach($users as $user){
		if(auth()->user()->id == $user->id && in_array($user->employee->emp_id,$allowed_emp)){
			return True;
		}
	}
	return false;
}
?>
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
							<p><?php echo '<pre>'; print_r(check_visibility($users, $tour,'approve')); ?></p>
						</div>
						<div class="text-right d-flex pull-right">
							@if(check_visibility($users, $tour,'approve'))
							<span class="">
								<a href="#" class="btn btn-sm btn-success">
									<i class="fa fa-check-square-o" style="font-size: 12px;"></i>Approve
								</a>
							</span>
							@endif

							@if(check_visibility($users, $tour,'approve'))
							<span class="ml-2">
								<a href="#" class="btn btn-sm btn-danger">
									<i class="fa fa-check-square-o" style="font-size: 12px;"></i>Decline
								</a>
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
									<th>Creator</th>
									<th>Status</th>
									<th>Note</th>
									<th>Created At</th>
								</tr>
							</thead>
							<tbody>
								@foreach($tour->stages as $stage)
								<tr>
									<td>{{$stage->id}}</td>
									<td>{{$stage->employee->emp_name}}</td>
									<td>{{$stage->approval_detail->title}}</td>
									<td>{{$stage->note}}</td>
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