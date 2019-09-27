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
		<div id="form-area">

			<form action="{{route('employees.official', ['id'=>$employee->id])}}" method="POST">
				@csrf
				<div class="container-fluid">

					<div class="row">

						<div class="col-4 form-group">
							<label for="">Emp Code</label>
							<input type="text" class="form-control" name="emp_code" value="{{old('emp_code',$employee->emp_code)}}" />
							@error('emp_code')
			          <span class="text-danger" role="alert">
			            <strong>* {{ $message }}</strong>
			          </span>
			      	@enderror
						</div>

						<div class="col-4 form-group">
							<label for="">Emp Status</label>
								<select name="emp_status" id="" class="form-control">
									<option value="">-- Select Status --</option>
									@foreach($meta['emp_statuses'] as $emp_status)
										<option value="{{$emp_status->id}}" {{old('emp_status',$employee->emp_status) == $emp_status->id ? 'selected' : ''}}>{{$emp_status->name}}</option>
									@endforeach
								</select>
							@error('emp_status')
			          <span class="text-danger" role="alert">
			            <strong>* {{ $message }}</strong>
			          </span>
			      	@enderror
						</div>

						<div class="col-4 form-group">
							<label for="">Emp Type</label>
							<select name="emp_type" id="" class="form-control">
									<option value="">-- Select Type --</option>
									@foreach($meta['emp_types'] as $emp_type)
										<option value="{{$emp_type->id}}">{{$emp_type->name}}</option>
									@endforeach
							</select>
							@error('emp_type')
			          <span class="text-danger" role="alert">
			            <strong>* {{ $message }}</strong>
			          </span>
			      	@enderror
						</div>

						<div class="W-100"></div>

						<div class="col-4 form-group">
							<label for="">Joining Date</label>
							<input type="text" class="form-control datepicker" name="join_date" value="" />
				
						@error('join_date')
		          <span class="text-danger" role="alert">
		            <strong>* {{ $message }}</strong>
		          </span>
		      	@enderror
		      	</div>

						<div class="col-4 form-group">
							<label for="">Confirmation Date</label>
							<input type="text" class="form-control datepicker" name="confirm_date" value="" />
							@error('confirm_date')
			          <span class="text-danger" role="alert">
			            <strong>* {{ $message }}</strong>
			          </span>
			      	@enderror
						</div>
					{{-- <div class="col-12"></div>
						<div class="col-3 form-group">
							<label for="">Bank Account Name</label>
							<input type="text" name="bank_acc_name" value="" class="form-control">
							@error('bank_acc_name')
			          <span class="text-danger" role="alert">
			            <strong>* {{ $message }}</strong>
			          </span>
			      	@enderror
						</div>

						<div class="W-100"></div>
						<div class="col-3 form-group">
							<label for="">Bank Account No.</label>
							<input type="text" name="bank_acc_no" value="" class="form-control">
							@error('bank_acc_no')
			          <span class="text-danger" role="alert">
			            <strong>* {{ $message }}</strong>
			          </span>
			      	@enderror
						</div>
						<div class="col-3 form-group">
							<label for="">IFSC Code</label>
							<input type="text" name="bank_ifsc" value="" class="form-control">
							@error('bank_ifsc')
			          <span class="text-danger" role="alert">
			            <strong>* {{ $message }}</strong>
			          </span>
			      	@enderror
						</div>
						<div class="col-3 form-group">
							<label for="">Branch Name</label>
							<input type="text" name="bank_branch" value="" class="form-control">
							@error('bank_branch')
			          <span class="text-danger" role="alert">
			            <strong>* {{ $message }}</strong>
			          </span>
			      	@enderror
						</div> --}}
						<div class="W-100"></div>
						<div class="col-3 form-group">
							<label for="">Aadhar Card</label>
							<input type="text" name="aadhar_no" value="" class="form-control">
						</div>
						<div class="col-3 form-group">
							<label for="">PAN Card</label>
							<input type="text" name="pan_no" value="" class="form-control">
						</div>
						<div class="col-3 form-group">
							<label for="">Voter ID</label>
							<input type="text" name="voter_id" value="" class="form-control">
						</div>
						<div class="col-3 form-group">
							<label for="">PF No.</label>
							<input type="text" name="pf_no" value="" class="form-control">
						</div>
						<div class="W-100"></div>
						<div class="col-3 form-group">
							<label for="">UAN No.</label>
							<input type="text" name="uan_no" value="" class="form-control">
						</div>
						<div class="W-100"></div>
						<div class="col-3 form-group">
							<label for="">Company's Reference Name</label>
							<input type="text" class="form-control" value="" name="co_ref_name">
						</div>
						<div class="col-3 form-group">
							<label for="">Company's Reference Contact</label>
							<input type="text" class="form-control" value="" name="co_ref_contact">
						</div>
						<div class="W-100"></div>
						<div class="col-4 form-group">
							<label for="">Nominee Name</label>
							<input type="text" class="form-control" value="" name="nominee_name">
						</div>
						<div class="col-4 form-group">
							<label for="">Nominee Aadhar</label>
							<input type="text" class="form-control" value="" name="nominee_aadhar">
						</div>
						<div class="col-4 form-group">
							<label for="">Nominee Contact</label>
							<input type="text" class="form-control" value="" name="nominee_contact">
						</div>
						<div class="col-12 form-group text-center">
								<button class="btn btn-info btn-sm">Update</button>
								<a class="btn btn-danger btn-sm" href="javascript:location.reload()">Cancel</a>
							</div>
					</div>
				</div>
				<input type="hidden" name="form_type" id="form_type" value="official">
			</form>
			
		</div>
	</div>
	<div class="img_parent d-none">
		<img src="{{asset('images/loading1.gif')}}" alt="">
	</div>

</main>
<script type="text/javascript">
	$(document).ready(function(){
		$('.official').addClass('active');
		$('.datepicker').datepicker({
				orientation: "bottom",
				format: "yyyy-mm-dd",
				autoclose: true,
				todayHighlight: true
			});
	});
</script>
@endsection
