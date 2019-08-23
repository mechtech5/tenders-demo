@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12">
				<h1 style="font-size: 20px;">Edit Payment</h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card shadow-xs">
					<div class="card-body">
						<form action="{{route('payments.update',['id'=>$payment->id])}}" method="Post">
							@csrf
						@method('PATCH')
						<div class=" row form-group ">
							<div class="col-md-6 mt-2">
								<label for="comp_code"><b>Company Name <span class="text-danger">*</span></b></label>

								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-university"></i></span>
									</div>
									<select class="selectpicker form-control border" name="comp_code" data-live-search="true">
										<option value="0" >Select Company</option>
										@foreach($companies as $comp)
											<option value="{{$comp->comp_code}}" {{$payment->comp_code== $comp->comp_code ? 'selected' : ''}}>{{$comp->comp_name}}</option>
										@endforeach
									</select>

								</div>
								
								@error('comp_code')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ "The selected company name is invalid." }}</strong>
                                    </span>
                                @enderror
							</div>
							

							<div class="col-md-6 mt-2">
								<label for="amount" class="font-wieght-bold"><b>Amount <span class="text-danger">*</span></b></label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-money"></i></span>
									</div>
									<input type="text" name="amount" class="form-control" placeholder="Enter Amount" value="{{old('amount') ?? $payment->amount}}" required> 
								</div>

							    @error('amount')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ "The entered amount is invalid." }}</strong>
                                    </span>
                                @enderror
							</div>
							<div class="col-md-6 mt-2">
								<label for="account_id"><b>Account <span class="text-danger">*</span></b></label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-bank"></i></span>
									</div>
									<select class="selectpicker form-control border" name="account_id" data-live-search="true">
									<option value="0" >Select Account</option>
									@foreach($accounts as $account)
											<option value="{{$account->id}}" {{$payment->account_id == $account->id ? 'selected' :''}}>{{$account->name}}</option>
										@endforeach
									</select>
								</div>
								@error('account_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ "The selected account is invalid." }}</strong>
                                    </span>
                                @enderror
							</div>
							
							<div class="col-md-6 mt-2">
								<label for="vendor_id" ><b>Vendor </b></label>
								<div class="input-group">

										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-user"></i></span>
										</div>
									<select class="selectpicker form-control border" name="vendor_id" data-live-search="true">
										<option value="0" >Select Vendor</option>
										@foreach($vendors as $vendor)
										  <option value="{{$vendor->id}}" {{$payment->vendor_id == $vendor->id ? 'selected' : ''}}>{{$vendor->name}}</option>
										@endforeach
									</select>
									<div class="input-group-append">
										<span class="input-group-text"><a href="{{route('vendors.create')}}"><i class="fa fa-plus"></i></a></span>
									</div>
								</div>
								

								@error('vendor_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ "The selected vendor is invalid." }}</strong>
                                    </span>
                                @enderror 
							</div>

							<div class="col-md-6 mt-2">
								<label for="paid_at" ><b>Date</b></label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-calendar"></i></span>
									</div>
									<input type="text" name="paid_at" class="form-control" placeholder="Enter Date" value="{{ date('Y-m-d',strtotime($payment->paid_at))}}"  id="paid_at"  autocomplete="dob" autofocus  data-date-format="yyyy-mm-dd" placeholder="{{date('Y-m-d')}}"  >
								</div>
						
								@error('paid_at')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ "The entered date is invalid" }}</strong>
                                    </span>
                                @enderror								 
							</div>
							<div class="col-md-6 mt-2">
								<label for="narration" ><b>Narration <span class="text-danger">*</span></b></label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-pencil-square-o"></i></span>
									</div>
									<input type="text" name="narration" class="form-control" placeholder="Enter Narration" value="{{old('narration') ?? $payment->narration}}" > 
								</div> 

								@error('narration')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
							</div>
							<div class="col-md-6 mt-2">
								<label for="exp_in_user"><b>Expense In User</b></label>

								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-user"></i></span>
									</div>
									<select class="selectpicker form-control border" name="exp_in_user" data-live-search="true">
										<option value="0" >Select expense in user </option>
										@foreach($exp_in_users as $exp_in_user)
											<option value="{{$exp_in_user->emp_id}}" {{$payment->exp_in_user == $exp_in_user->emp_id ? 'selected' : '' }}>{{$exp_in_user->emp_name}}</option>
										@endforeach
									</select>

								</div>
								
								@error('exp_in_user')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ "The selected expense in user is invalid." }}</strong>
                                    </span>
                                @enderror
							</div>

							<div class="col-md-6 mt-2">
								<label for="exp_permit_user"><b>Expense Permit </b></label>

								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-user"></i></span>
									</div>
									<select class="selectpicker form-control border" name="exp_permit_user" data-live-search="true">
										<option value="0" >Select expense permit </option>
										@foreach($exp_permit_users as $exp_permit_user)
											<option value="{{$exp_permit_user->emp_id}}" {{ $payment->exp_permit_user == $exp_permit_user->emp_id ? 'selected' : ''}}>{{$exp_permit_user->emp_name}}</option>
										@endforeach
									</select>

								</div>
								
								@error('exp_permit_user')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ "The selected permit user is invalid" }}</strong>
                                    </span>
                                @enderror
							</div>

							<div class="col-md-6 mt-2">
								<label for="email" ><b>Email </b></label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-envelope"></i></span>
									</div>
										<input type="text" name="email" class="form-control" placeholder="Enter Email" value="{{old('email') ?? $payment->email}}" >
								</div>
								@error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
							</div>

							{{-- <div class="col-md-6 mt-2">
								<label for="website" ><b>Website</b></label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-globe"></i></span>
									</div>
										<input type="text" name="website" class="form-control" placeholder="Enter website" value="{{old('website')}}" >
								</div>
								@error('website')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
							</div> --}}

							<div class="col-md-6 mt-2">
								<label for="mode_id" ><b>Payment Method <span class="text-danger">*</span></b></label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-credit-card"></i></span>
									</div>
									<select class="selectpicker form-control border" name="mode_id" data-live-search="true">
										<option value="0" >Select Payment Method</option>
										@foreach($exp_mode as $exp_mod)
											<option value="{{$exp_mod->id}}" {{$payment->mode_id == $exp_mod->id ? 'selected' : ''}}>{{$exp_mod->name}}</option>
										@endforeach
									</select>
								</div>
								@error('mode_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ "The selected payment method is invalid." }}</strong>
                                    </span>
                                @enderror 								 
							</div>

							<div class="col-md-6 mt-2">
								<label for="status" ><b>Payment Status <span class="text-danger">*</span></b></label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-credit-card"></i></span>
									</div>
									<select class="selectpicker form-control border" name="status" data-live-search="true">
										
										<option value="A" selected="" {{$payment->status =='A' ? 'selected' : '' }}>Approved</option>
										<option value="H" {{$payment->status =='H' ? 'selected' : '' }}>Hold</option>
										<option value="P" {{$payment->status =='P' ? 'selected' : '' }}>Pending</option>
										<option value="D" {{$payment->status =='D' ? 'selected' : '' }}>Declined</option>
										
									</select>
								</div>
								@error('status')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ "The selected payment status is invalid." }}</strong>
                                    </span>
                                @enderror 								 
							</div>
							
							<div class="col-md-6 mt-2">
								<label for="catg_id" ><b>Category <span class="text-danger">*</span></b></label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-folder-open-o"></i></span>
									</div>
									<select class="selectpicker form-control border" name="catg_id" data-live-search="true">
										
										@foreach($exp_catg as $exp_cat)
										<option value="{{$exp_cat->id}}" {{$payment->catg_id == $exp_cat->id ? 'selected' : ''}}>{{$exp_cat->name}}</option>									
										@endforeach
									</select>
								</div>
								@error('catg_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ "The selected expense category is invalid." }}</strong>
                                    </span>
                                @enderror 								 
							</div>

						{{-- 	<div class="col-md-6 mt-2">
								<label for="reccuring_id" ><b>Recurring </b></label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa fa-refresh"></i></span>
									</div>
									<select class="selectpicker form-control border" name="reccuring_id" data-live-search="true">
										<option value="0" >No</option>
										<option value="D" {{$payment->reccuring_id == 'A' ? 'selected' : '' }}>Daily</option>
										<option value="M" {{$payment->reccuring_id == 'M' ? 'selected' : '' }}>Monthly</option>
										<option value="W" {{$payment->reccuring_id == 'W' ? 'selected' : '' }}>Weekly</option>
										<option value="Y" {{$payment->reccuring_id == 'Y' ? 'selected' : '' }}>Yearly</option>
										
									</select>
								</div>
								@error('reccuring_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ "The selected recurring is invalid." }}</strong>
                                    </span>
                                @enderror 								 
							</div> --}}
							
							<div class="col-md-6 mt-2">
								<label for="req_approval" ><b>Request Approval <span class="text-danger">*</span></b></label>
								<div class="input-group">
									<div class="btn-group radio-inline">
										<label id="enabled_1" class="btn btn-default ">
											<input type="radio" name="req_approval" value="1" id="req_approval" {{$payment->req_approval == '1' ? 'checked' : '' }}>
											<span class="radiotext">Yes</span>
										</label>
										<label id="req_approval_0" class="btn btn-default">
											<input type="radio" name="req_approval" value="0" id="req_approval" {{$payment->req_approval == '0' ? 'checked' : '' }} >
											<span class="radiotext" >No</span>
										</label>
									</div>
								</div>
							</div>

						
							<div class="col-md-12 mt-2">
								<label for="note" ><b>Note </b></label>
								<textarea name="note" class="form-control" rows="5" cols="10" placeholder="Enter Note"  >{{old('note') ?? $payment->note}}</textarea>
							
							</div>
							<div class="col-md-12 mt-3">
								
								<button class="btn btn-md btn-success" type="submit"><span class="fa fa-save"></span> Save</button>
								<span class="ml-2" ><a href="{{route('payments.index')}}" class="btn btn-md btn-default" style="background-color: #f4f4f4;color: #444;    border-color: #ddd;"><span class="fa fa-times-circle"></span> Cancel</a></span>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>
	<script type="text/javascript">
		$(document).ready(function(){
			 $(function () {
		      $("#paid_at").datepicker({ 
		        singleDatePicker: true,
		        showDropdowns: true,
		      });
		    });
		});
	</script>
@endsection