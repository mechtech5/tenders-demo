@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12">
				<h1 style="font-size: 20px;">New Vendor</h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card shadow-xs">
					<div class="card-body">
						<div class=" row form-group ">
							<div class="col-md-6 mt-2">
								<label for="name" class="font-wieght-bold"><b>Name <span class="text-danger">*</span></b></label>
								<input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{old('name')}}" required> 
							</div>
							<div class="col-md-6 mt-2">
								<label for="email" ><b>Email <span class="text-danger">*</span></b></label>
								<input type="text" name="email" class="form-control" placeholder="Enter Email" value="{{old('email')}}" required> 
							</div>
							<div class="col-md-6 mt-2">
								<label for="tax_number" ><b>Tax Number</b></label>
								<input type="text" name="tax_number" class="form-control" placeholder="Enter Tax Number" value="{{old('tax_number')}}" > 
							</div>
							<div class="col-md-6 mt-2">
								<label for="phone" ><b>Phone</b></label>
								<input type="text" name="phone" class="form-control" placeholder="Enter Phone Number" value="{{old('phone')}}" > 
							</div>
							<div class="col-md-6 mt-2">
								<label for="website" ><b>Website</b></label>
								<input type="text" name="website" class="form-control" placeholder="Enter website" value="{{old('website')}}" > 
							</div>
							<div class="col-md-6 mt-2">
								<label for="enabled" ><b>Enabled</b></label>
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
								<textarea name="Note" class="form-control" rows="5" cols="10" placeholder="Enter Note"  >{{old('Note')}}</textarea>
							
							</div>
							<div class="col-md-12 mt-3">
								<button class="btn btn-md btn-success" type="submit"><span class="fa fa-save"></span> Save</button>
								<span class="ml-2" ><a href="{{route('vendors.index')}}" class="btn btn-md btn-default" style="background-color: #f4f4f4;color: #444;    border-color: #ddd;"><span class="fa fa-times-circle"></span> Cancel</a></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection