@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12">
				<h1 style="font-size: 20px;">Edit Vendor</h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card shadow-xs">
					<div class="card-body">
						<form action="{{route('vendors.update',['id' => $vendor->id])}}" method="Post">
							@method('PATCH')
							@csrf
						<div class=" row form-group ">
							<div class="col-md-6 mt-2">
								<label for="name" class="font-wieght-bold"><b>Name <span class="text-danger">*</span></b></label>
								<input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{old('name') ?? $vendor->name}}" required> 

							    @error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							<div class="col-md-6 mt-2">
								<label for="email" ><b>Email <span class="text-danger">*</span></b></label>
								<input type="text" name="email" class="form-control" placeholder="Enter Email" value="{{old('email') ?? $vendor->email}}" required> 

								@error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							<div class="col-md-6 mt-2">
								<label for="comp_code"><b>Company Name <span class="text-danger">*</span></b></label>
								<select class="form-control" name="comp_code">
									<option value="0" >Select Company</option>
									@foreach($companies as $comp)
										<option value="{{$comp->comp_code}}" {{$comp->comp_code == $vendor->comp_code ? 'selected' : ''}}>{{$comp->comp_name}}</option>
									@endforeach
								</select>
								@error('comp_code')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
							</div>
							<div class="col-md-6 mt-2">
								<label for="tax_number" ><b>Tax Number</b></label>
								<input type="text" name="tax_number" class="form-control" placeholder="Enter Tax Number" value="{{old('tax_number') ?? $vendor->tax_number}}" >

								@error('tax_number')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror								 
							</div>
							<div class="col-md-6 mt-2">
								<label for="phone" ><b>Phone</b></label>
								<input type="text" name="phone" class="form-control" placeholder="Enter Phone Number" value="{{old('phone') ?? $vendor->phone}}" > 

								@error('phone')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
							</div>
							<div class="col-md-6 mt-2">
								<label for="website" ><b>Website</b></label>
								<input type="text" name="website" class="form-control" placeholder="Enter website" value="{{old('website') ?? $vendor->website}}" >

								@error('website')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
							</div>
							<div class="col-md-6 mt-2">
								<label for="acc_name" ><b>Account Holder Name</b></label>
								<input type="text" name="acc_name" class="form-control" placeholder="Enter account holder name" value="{{old('acc_name') ?? $vendor->acc_name}}" >

								@error('acc_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
							</div>
							<div class="col-md-6 mt-2">
								<label for="acc_no" ><b>Account Number</b></label>
								<input type="text" name="acc_no" class="form-control" placeholder="Enter account number" value="{{old('acc_no') ?? $vendor->acc_no}}" >

								@error('acc_no')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
							</div>

							<div class="col-md-6 mt-2">
								<label for="acc_ifsc" ><b>IFSC Code</b></label>
								<input type="text" name="acc_ifsc" class="form-control" placeholder="Enter IFSC code" value="{{old('acc_ifsc') ?? $vendor->acc_ifsc}}" >

								@error('acc_ifsc')
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
											<input type="radio" name="enabled" value="1" id="enabled"  {{$vendor->enabled =='1' ? 'checked' : ''}}>
											<span class="radiotext">Yes</span>
										</label>
										<label id="enabled_0" class="btn btn-default">
											<input type="radio" name="enabled" value="0" id="enabled" {{$vendor->enabled =='0' ? 'checked' : ''}}>
											<span class="radiotext">No</span>
										</label>
									</div>
								</div>
								@error('enabled')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
								
							</div>
							<div class="col-md-12 mt-2">
								<label for="address" ><b>Address  </b></label>
								<textarea name="address" class="form-control" rows="5" cols="10" placeholder="Enter address"  >{{old('address') ?? $vendor->address}}</textarea>
							</div>
							<div class="col-md-12 mt-2">
								<label for="note" ><b>Note </b></label>
								<textarea name="note" class="form-control" rows="5" cols="10" placeholder="Enter Note"  >{{old('note') ?? $vendor->note}}</textarea>
							
							</div>
							<div class="col-md-12 mt-3">
								<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
								<button class="btn btn-md btn-success" type="submit"><span class="fa fa-save"></span> Save</button>
								<span class="ml-2" ><a href="{{route('vendors.index')}}" class="btn btn-md btn-default" style="background-color: #f4f4f4;color: #444;    border-color: #ddd;"><span class="fa fa-times-circle"></span> Cancel</a></span>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection