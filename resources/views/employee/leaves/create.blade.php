@extends('layouts.master')
@push('styles')
  <script src="{{asset('themes/vali/js/plugins/bootstrap-datepicker.min.js')}}"></script>
@endpush
@section('content')
<main class="app-content">
	<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 24px">Leave Application</h1>
			</div>
		</div>
	<div style="margin-top: 1.5rem; padding: 1.5rem; border: 1px solid grey;">
		@if($message = Session::get('success'))
		<div class="alert alert-success alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
			{{$message}}
		</div>
		@endif 
			<form action="{{url('employee/leaves')}}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="row">
					<div class="col-6 form-group">
							<label for="leave_type">Leave</label>
							<select name="leave_type_id" id="leave_type" class="custom-select">
								<option value="">Select</option>
								@foreach($leave_type as $leave_type)
								<option value="{{$leave_type->id}}">{{$leave_type->name}}</option>
								@endforeach
							</select>
							@error('leave_type_id')
							<span class="text-danger" role="alert">
								<strong>* {{ $message }}</strong>
							</span>
							@enderror
						</div>
						<div class="col-6 form-group">
							<label for="tlead">Team Leader</label>
							<select name="teamlead" id="tlead" class="custom-select">
								<option value="">Select </option>
								@foreach($dept_name as $tlead)
								<option value="{{$tlead->id}}">{{$tlead->emp_name}}</option>
								@endforeach
							</select>
							@error('teamlead')
							<span class="text-danger" role="alert">
								<strong>* {{ $message }}</strong>
							</span>
							@enderror
						</div>
						<div class="col-3 form-group">
						<label for="start_date">Start Date</label>
						<input type="text" class="form-control datepicker" name="start_date" autocomplete="off">
						@error('start_date')
				          <span class="text-danger" role="alert">
				            <strong>* {{ $message }}</strong>
				          </span>
				      	@enderror
					</div>
					<div class="col-3 form-group">
						<label for="end_date">End Date</label>
						<input type="text" class="form-control datepicker" name="end_date"
							value="" autocomplete="off">
						@error('end_date')
				          <span class="text-danger" role="alert">
				            <strong>* {{ $message }}</strong>
				          </span>
				      	@enderror
					</div>
					
					<div class="col-7 form-group">
						<label for="reason">Reason</label>
						<textarea  class="form-control" id="reason" name="reason" value=""></textarea>
						@error('reason')
				          <span class="text-danger" role="alert">
				            <strong>* {{ $message }}</strong>
				          </span>
				      	@enderror
					</div>
					<div class="col-5 form-group">
						<label for="contact_no">Contact no</label>
						<input type="text" id="contact_no" class="form-control" name="contact_no"
						value="">
						@error('contact_no')
				          <span class="text-danger" role="alert">
				            <strong>* {{ $message }}</strong>
				          </span>
				      	@enderror
					</div>
					<div class="col-7 form-group">
						<label for="file_path">Upload Documents</label>
    					<input type="file" name="file_path" class="form-control-file" id="file_path" value="">
					</div>
					<div class="col-6 form-group">
						<label for="address_leave">Address During Leave</label>
						<textarea class="form-control" id="address_leave" name="address_leave"	value=""></textarea>
						@error('address_leave')
				          <span class="text-danger" role="alert">
				            <strong>* {{ $message }}</strong>
				          </span>
				      	@enderror
					</div>
					<div class="col-6 form-group">
						<label for="applicant_remark">Applicant's Remark</label>
						<textarea class="form-control" id="applicant_remark" name="applicant_remark"	value=""></textarea>
						@error('applicant_remark')
				          <span class="text-danger" role="alert">
				            <strong>* {{ $message }}</strong>
				          </span>
				      	@enderror
					</div>
					{{-- <div class="col-6 form-group">
						<label for="approver_remark">Approver Remark</label>
						<textarea class="form-control" id="approver_remark" name="approver_remark"	value=""></textarea> 
						@error('approver_remark')
				          <span class="text-danger" role="alert">
				            <strong>* {{ $message }}</strong>
				          </span>
				      	@enderror
					</div>
					<div class="col-6 form-group">
						<label for="hr_remark">HR Remark</label>
						<textarea class="form-control" id="hr_remark" name="hr_remark"	value=""></textarea> 
						@error('hr_remark')
				          <span class="text-danger" role="alert">
				            <strong>* {{ $message }}</strong>
				          </span>
				      	@enderror
					</div> --}}
					<div class="col-12 form-group text-center">
						<button class="btn btn-info btn-sm m-2">Save</button>
						<a class="btn btn-danger btn-sm" href="javascript:location.reload()">Cancel</a>
					</div>
				</div>
			</form>
	</main>
	<script>
		$(document).ready(function(){
			$('.experience').addClass('active');
			$('.datepicker').datepicker({
				orientation: "bottom",
				format: "yyyy-mm-dd",
				autoclose: true,
				todayHighlight: true
			});
		});
	</script>
@endsection
