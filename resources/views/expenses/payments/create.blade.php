@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12">
				<h1 style="font-size: 20px;">New Payments</h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card shadow-xs">
					<div class="card-body">
						<form action="{{route('payments.store')}}" method="Post">
							@csrf
						<div class=" row form-group ">
							<div class="col-md-6 mt-2">
								<label for="comp_code"><b>Company Name <span class="text-danger">*</span></b></label>
								<select class="form-control" name="comp_code">
									<option value="0" >Select Company</option>
									
								</select>
								@error('comp_code')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>

							<div class="col-md-6 mt-2">
								<label for="amount" class="font-wieght-bold"><b>Amount <span class="text-danger">*</span></b></label>
								<input type="text" name="amount" class="form-control" placeholder="Enter Amount" value="{{old('amount')}}" required> 

							    @error('amount')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							<div class="col-md-6 mt-2">
								<label for="account_id"><b>Account Type <span class="text-danger">*</span></b></label>
								<select class="selectpicker form-control border" name="account_id" data-live-search="true">
									<option value="0" >Select Account</option>
									
								</select>
								@error('account_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							
							<div class="col-md-6 mt-2">
								<label for="vendor_id" ><b>Vendor <span class="text-danger">*</span></b></label>
							
								<select class="selectpicker form-control border" name="vendor_id" data-live-search="true">
									<option value="0" >Select Vendor</option>
									@foreach($vendors as $vendor)
									  <option value="{{$vendor->id}}">{{$vendor->name}}</option>
									  @endforeach
								</select>

								@error('vendor_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
							</div>

							<div class="col-md-6 mt-2">
								<label for="paid_at" ><b>Date <span class="text-danger">*</span></b></label>
								<input type="text" name="paid_at" class="form-control" placeholder="Enter Date" value="{{old('paid_at')}}"  id="paid_at"  autocomplete="dob" autofocus  data-date-format="yyyy-mm-dd" placeholder="{{date('Y-m-d')}}" required>

								@error('paid_at')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror								 
							</div>
							<div class="col-md-6 mt-2">
								<label for="narration" ><b>Narration</b></label>
								<input type="text" name="narration" class="form-control" placeholder="Enter Narration" value="{{old('narration')}}" > 

								@error('narration')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
							</div>
							<div class="col-md-6 mt-2">
								<label for="website" ><b>Website</b></label>
								<input type="text" name="website" class="form-control" placeholder="Enter website" value="{{old('website')}}" >

								@error('website')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
							</div>
							<div class="col-md-6 mt-2">
								<label for="acc_name" ><b>Account Holder Name</b></label>
								<input type="text" name="acc_name" class="form-control" placeholder="Enter account holder name" value="{{old('acc_name')}}" >

								@error('acc_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
							</div>
							<div class="col-md-6 mt-2">
								<label for="acc_no" ><b>Account Number</b></label>
								<input type="text" name="acc_no" class="form-control" placeholder="Enter account number" value="{{old('acc_no')}}" >

								@error('acc_no')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
							</div>

							
							<div class="col-md-6 mt-2">
								<label for="enabled" ><b>Enabled <span class="text-danger">*</span></b></label>
								<div class="input-group">
									<div class="btn-group radio-inline">
										<label id="enabled_1" class="btn btn-default ">
											<input type="radio" name="enabled" value="1" id="enabled" checked >
											<span class="radiotext">Yes</span>
										</label>
										<label id="enabled_0" class="btn btn-default">
											<input type="radio" name="enabled" value="0" id="enabled" >
											<span class="radiotext">No</span>
										</label>
									</div>
								</div>
								
							</div>
							<div class="col-md-12 mt-2">
								<label for="address" ><b>Address  </b></label>
								<textarea name="address" class="form-control" rows="5" cols="10" placeholder="Enter address"  >{{old('address')}}</textarea>
							</div>
							<div class="col-md-12 mt-2">
								<label for="note" ><b>Note </b></label>
								<textarea name="note" class="form-control" rows="5" cols="10" placeholder="Enter Note"  >{{old('note')}}</textarea>
							
							</div>
							<div class="col-md-12 mt-3">
								<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
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