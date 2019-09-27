@extends('layouts.master')
@push('styles')
  <script src="{{asset('themes/vali/js/plugins/bootstrap-datepicker.min.js')}}"></script>
@endpush
@section('content')
<main class="app-content">
	@include ('HRD/employees/tabs')
	<div style="margin-top: 1.5rem; padding: 1.5rem; border: 1px solid grey;">
		@if($message = Session::get('success'))
		<div class="alert alert-success">
			{{$message}}
		</div>
		@endif 
			<form action="{{route('employees.experience', ['id'=>$employee->id])}}" method="POST">
				@csrf
				<div class="row">
					<div class="col-3 form-group">
						<label for="">Company Name</label>
						<input type="text" class="form-control" name="company_name" 
								value="{{old('company_name',isset($exp->comp_name) ? $exp->comp_name : '')}}">
						@error('company_name')
		          <span class="text-danger" role="alert">
		            <strong>* {{ $message }}</strong>
		          </span>
		      	@enderror
					</div>
					<div class="col-2 form-group">
						<label for="">Monthly CTC</label>
						<input type="text" class="form-control" name="monthly_ctc"
							value="{{old('monthly_ctc',isset($exp->monthly_ctc) ? $exp->monthly_ctc : '')}}">
						@error('monthly_ctc')
		          <span class="text-danger" role="alert">
		            <strong>* {{ $message }}</strong>
		          </span>
		      	@enderror
					</div>
					<div class="col-3 form-group">
						<label for="">Designation</label>
						<input type="text" class="form-control" name="designation"
						value="{{old('designation',isset($exp->desg) ? $exp->desg : '')}}">
						@error('designation')
		          <span class="text-danger" role="alert">
		            <strong>* {{ $message }}</strong>
		          </span>
		      	@enderror
					</div>
					<div class="col-2 form-group">
						<label for="">Start Date</label>
						<input type="text" class="form-control datepicker" name="start_date"
							value="{{old('start_date',isset($exp->start_dt) ? $exp->start_dt : '')}}">
						@error('start_date')
		          <span class="text-danger" role="alert">
		            <strong>* {{ $message }}</strong>
		          </span>
		      	@enderror
					</div>
					<div class="col-2 form-group">
						<label for="">End Date</label>
						<input type="text" class="form-control datepicker" name="end_date"
							value="{{old('end_date',isset($exp->end_dt) ? $exp->end_dt : '')}}">
						@error('end_date')
		          <span class="text-danger" role="alert">
		            <strong>* {{ $message }}</strong>
		          </span>
		      	@enderror
					</div>
					<div class="w-100"></div>
					<div class="col-3">
						<div class="form-group">
							<label for="">Job Type</label>
							<input type="text" class="form-control" name="job_type"
							value="{{old('job_type',isset($exp->job_type) ? $exp->job_type : '')}}">
							@error('job_type')
			          <span class="text-danger" role="alert">
			            <strong>* {{ $message }}</strong>
			          </span>
			      	@enderror
						</div>
					</div>
						<div class="col-3">
						<div class="form-group">
							<label for="">Company Email</label>
							<input type="text" class="form-control" name="comp_email"
							value="{{old('comp_email',isset($exp->comp_email) ? $exp->comp_email : '')}}">
							@error('comp_email')
			          <span class="text-danger" role="alert">
			            <strong>* {{ $message }}</strong>
			          </span>
			      	@enderror
						</div>
					</div>
						<div class="col-3">
						<div class="form-group">
							<label for="">Company Location</label>
							<input type="text" class="form-control" name="comp_loc"
							value="{{old('comp_loc',isset($exp->comp_loc) ? $exp->comp_loc : '')}}">
							@error('comp_loc')
			          <span class="text-danger" role="alert">
			            <strong>* {{ $message }}</strong>
			          </span>
			      	@enderror
						</div>
					</div>
						<div class="col-3">
						<div class="form-group">
							<label for="">Company Website</label>
							<input type="text" class="form-control" name="comp_website"
							value="{{old('comp_website',isset($exp->comp_website) ? $exp->comp_website : '')}}">
							@error('comp_website')
			          <span class="text-danger" role="alert">
			            <strong>* {{ $message }}</strong>
			          </span>
			      	@enderror
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<label for="">Reason of Leaving</label>
							<textarea name="reason_of_leaving" class="form-control" id="" cols="30" rows="2">
								{{old('reason_of_leaving',isset($exp->reason_of_leaving) ? $exp->reason_of_leaving : '')}}
							</textarea>
							@error('reason_of_leaving')
			          <span class="text-danger" role="alert">
			            <strong>* {{ $message }}</strong>
			          </span>
			      	@enderror
						</div>
					</div>
					<div class="col-12 form-group text-center">
						<button class="btn btn-info btn-sm">Save</button>
						<a class="btn btn-danger btn-sm" href="javascript:location.reload()">Cancel</a>
					</div>
				</div>
				<input type="hidden" id="form_type" value="experiences">
			</form>
			<hr>
			<table class="table table-striped table-hover table-bordered">
				<thead class="thead-dark">
					<tr>
						<th>#</th>
						<th>Company Name</th>
						<th>Monthly CTC</th>
						<th>Designation</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Reason of Leaving</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody id="experiencesTbody">
					@foreach($employee->experiences as $exp)
					<tr>
						<td>{{$exp->id}}</td>
						<td>{{$exp->comp_name}}</td>
						<td>{{$exp->monthly_ctc}}</td>
						<td>{{$exp->desg}}</td>
						<td>{{$exp->start_dt}}</td>
						<td>{{$exp->end_dt}}</td>
						<td>{{$exp->reason_of_leaving	}}</td>
						<td></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
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
