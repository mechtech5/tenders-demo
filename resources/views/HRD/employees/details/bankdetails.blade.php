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
			<form action="{{ route('employees.bankdetails', ['id'=> $employee->id]) }}" method="POST" enctype="multipart/form-data" id="delbank_{{$employee->id}}">
				@csrf
				<div class="row">
					<div class="col-5 form-group offset-1">
						<label for="">Account Holder</label>
						<input type="text" class="form-control" name="acc_holder" value="{{old('acc_holder')}}">
						@error('acc_holder')
							<span class="text-danger" role="alert">
								<strong>* {{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-5 form-group">
						<label for="">Account Number</label>
						<input type="text" class="form-control" name="acc_no" value="{{old('acc_no')}}">
						@error('acc_no')
							<span class="text-danger" role="alert">
								<strong>* {{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-5 form-group offset-1">
						<label for="">Bank Name</label>
						<input type="text" class="form-control" name="bank_name" value="{{old('bank_name')}}">
						@error('bank_name')
							<span class="text-danger" role="alert">
								<strong>* {{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-5 form-group">
						<label for="">IFSC Code </label>
						<input type="text" class="form-control" name="ifsc" value="{{old('ifsc')}}">
						@error('ifsc')
							<span class="text-danger" role="alert">
								<strong>* {{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-5 form-group offset-1">
						<label for="">Branch</label>
						<input type="text" class="form-control" name="branch" value="{{old('branch')}}">
						@error('branch')
							<span class="text-danger" role="alert">
								<strong>* {{ $message }}</strong>
							</span>
						@enderror
					</div>
					
					
					<div class="col-1 form-group check">
						<div class="form-check">
						<label class="form-check-label">
						  <input class="form-check-input" type="checkbox">Check me out
						</label>
						</div>
					</div>
					<div class="col-10 offset-1">
						<div class="col-12 form-group ">
	    					<label for="">Note</label>
	    					<textarea name="note" id="remark" class="form-control" cols="10" rows="5" value="old('note')"></textarea>
	    				</div>
					</div>
					<div class="col-12 form-group text-center">
						<button class="btn btn-info btn-sm">Save</button>
						<a class="btn btn-danger btn-sm" href="javascript:location.reload()">Cancel</a>
					</div>
				</div>
				<input type="hidden" id="form_type" value="bankdetails">
			</form>
			<hr>
			<table class="table table-striped table-hover table-bordered">
				<thead class="thead-dark">
					<tr>
						<th>#</th>
						<th>Account Holder</th>
						<th>Account Number</th>
						<th>Bank Name</th>
						<th>IFSC Code</th>
						<th>Branch</th>
						<th>Primary</th>
						<th>Attachment</th>
						<th>Note</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody id="experiencesTbody">
					@foreach($employee->bankdetails as $bank_details)
				<tr>
					<td>{{ $bank_details->id }}</td>
					<td>{{ $bank_details->acc_holder }}</td>
					<td>{{ $bank_details->acc_no }}</td>
					<td>{{ $bank_details->bank_name }}</td>
					<td>{{ $bank_details->ifsc }}</td>
					<td>{{ $bank_details->branch_name }}</td>
					<td>{{ $bank_details->is_primary }}</td>
					<td>Download</td>
					<td>{{ $bank_details->note }}</td>
					<td><span class="ml-2">
			<form action="{{ route('employee.delete_row', ['db_table' => 'emp_bank_details', $bank_details->id]) }}" method="GET" id="delform_{{$bank_details->id}}">
				<a href="javascript:$('#delform_{{$bank_details->id}}').submit();" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</a>
			</form>
		</span></td>
				</tr>
			@endforeach
				</tbody>
			</table>
		</div>
	</main>
<script>
$(document).ready(function(){
	$('.bankdetails').addClass('active');
	$('.datepicker').datepicker({
		orientation: "bottom",
		format: "yyyy-mm-dd",
		autoclose: true,
		todayHighlight: true
	});
});
</script>
@endsection
